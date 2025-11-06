<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareholderPrivateRequest;
use App\Notifications\Shareholder\OwnerInformation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Statamic\Facades\Entry;
use ZipArchive;

class ShareholderPrivateController extends Controller
{
    public function store(ShareholderPrivateRequest $request)
    {
        $title = $request->input('firstname').' '.$request->input('name');

        // Generate unique ID for this request
        $uniqueId = Str::random(8);

        // Upload files to temporary storage
        $tempFolder = 'temp_shareholder_'.time().'_'.$uniqueId;
        $identityDocumentPath = $this->uploadFile($request, 'identity_document', $tempFolder, 'identitaetsdokument');
        $powerOfAttorneyPath = $this->uploadFile($request, 'power_of_attorney', $tempFolder, 'vollmacht');

        // Create ZIP file directly in shareholder_requests root with unique ID
        $zipPath = $this->createShareholderZip($request, $identityDocumentPath, $powerOfAttorneyPath, $uniqueId);

        // Delete temporary folder and its contents
        Storage::deleteDirectory('shareholder_requests/'.$tempFolder);

        // Build data for Statamic entry
        $data = [
            'title' => $title,
            'salutation' => $request->input('salutation'),
            'firstname' => $request->input('firstname'),
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'zip' => $request->input('zip'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'zip_file' => $zipPath,
        ];

        // Create Statamic entry
        $entry = Entry::make()
            ->collection('shareholder_private')
            ->slug(Str::slug($title.'-'.date('Y-m-d-H-i-s')))
            ->data($data);

        $entry->save();

        // Add entry ID and file info to data for notifications
        $notificationData = array_merge($data, [
            'entry_id' => $entry->id(),
            'zip_file' => $zipPath,
            'unique_id' => $uniqueId,
        ]);

        // Clear Statamic Stache to ensure the new entry is immediately available
        \Statamic\Facades\Stache::clear();

        // Send notification
        Notification::route('mail', env('MAIL_TO'))->notify(new OwnerInformation($notificationData));

        return response()->json(['message' => 'Anfrage erfolgreich übermittelt']);
    }

    /**
     * Upload a single file to private storage
     *
     * @param  ShareholderPrivateRequest  $request
     * @param  string  $fileFieldName  The form field name
     * @param  string  $folderName  The folder to store in
     * @param  string  $filePrefix  Prefix for the filename
     * @return string The path to the uploaded file
     */
    protected function uploadFile(ShareholderPrivateRequest $request, string $fileFieldName, string $folderName, string $filePrefix): string
    {
        $file = $request->file($fileFieldName);

        $filename = sprintf(
            '%s-%s-%s.%s',
            $filePrefix,
            Str::slug($request->input('firstname')),
            Str::slug($request->input('name')),
            $file->getClientOriginalExtension()
        );

        // Store in storage/app/shareholder_requests/{folderName}
        $path = $file->storeAs('shareholder_requests/'.$folderName, $filename);

        return $path;
    }

    /**
     * Create a ZIP file containing all uploaded shareholder files
     *
     * @param  ShareholderPrivateRequest  $request
     * @param  string  $identityDocumentPath  Path to identity document
     * @param  string  $powerOfAttorneyPath  Path to power of attorney
     * @param  string  $uniqueId  Unique identifier for the ZIP file
     * @return string|null The path to the created ZIP file
     */
    protected function createShareholderZip(ShareholderPrivateRequest $request, string $identityDocumentPath, string $powerOfAttorneyPath, string $uniqueId): ?string
    {
        // Collect all file paths
        $filePaths = array_filter([
            $identityDocumentPath,
            $powerOfAttorneyPath,
        ]);

        // If no files, return null
        if (empty($filePaths)) {
            return null;
        }

        // Create ZIP filename with unique ID
        $zipFilename = sprintf(
            'aktionaer-privat-%s-%s-%s-%s.zip',
            Str::slug($request->input('firstname')),
            Str::slug($request->input('name')),
            date('Y-m-d_H-i-s'),
            $uniqueId
        );

        $zipPath = 'shareholder_requests/'.$zipFilename;
        $zipFullPath = Storage::path($zipPath);

        // Create ZIP archive
        $zip = new ZipArchive;

        if ($zip->open($zipFullPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($filePaths as $filePath) {
                $fullPath = Storage::path($filePath);
                if (file_exists($fullPath)) {
                    $zip->addFile($fullPath, basename($filePath));
                }
            }
            $zip->close();

            return $zipPath;
        }

        return null;
    }
}
