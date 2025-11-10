<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShareholderCompanyRequest;
use App\Notifications\Shareholder\CompanyInformation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Statamic\Facades\Entry;
use ZipArchive;

class ShareholderCompanyController extends Controller
{
    public function store(ShareholderCompanyRequest $request)
    {
        $title = $request->input('company_name');

        // Generate unique ID for this request
        $uniqueId = Str::random(8);

        // Upload files to temporary storage
        $tempFolder = 'temp_shareholder_'.time().'_'.$uniqueId;
        $commercialRegisterPath = $this->uploadFile($request, 'commercial_register', $tempFolder, 'handelsregisterauszug');
        $idCopyPath = $this->uploadFile($request, 'id_copy', $tempFolder, 'ausweiskopie');
        $powerOfAttorneyPath = $this->uploadFile($request, 'power_of_attorney', $tempFolder, 'vollmacht');

        // Create ZIP file directly in shareholder_requests root with unique ID
        $zipPath = $this->createShareholderZip($request, $commercialRegisterPath, $idCopyPath, $powerOfAttorneyPath, $uniqueId);

        // Delete temporary folder and its contents
        Storage::deleteDirectory('shareholder_requests/'.$tempFolder);

        // Build data for Statamic entry
        $data = [
            'title' => $title,
            'company_name' => $request->input('company_name'),
            'location' => $request->input('location'),
            'zip' => $request->input('zip'),
            'city' => $request->input('city'),
            'salutation_admin' => $request->input('salutation_admin'),
            'firstname_admin' => $request->input('firstname_admin'),
            'name_admin' => $request->input('name_admin'),
            'email_admin' => $request->input('email_admin'),
            'phone_admin' => $request->input('phone_admin'),
            'salutation_authorised_to_sign' => $request->input('salutation_authorised_to_sign'),
            'firstname_authorised_to_sign' => $request->input('firstname_authorised_to_sign'),
            'name_authorised_to_sign' => $request->input('name_authorised_to_sign'),
            'email_authorised_to_sign' => $request->input('email_authorised_to_sign'),
            'phone_authorised_to_sign' => $request->input('phone_authorised_to_sign'),
            'location_authorised_to_sign' => $request->input('location_authorised_to_sign'),
            'zip_authorised_to_sign' => $request->input('zip_authorised_to_sign'),
            'city_authorised_to_sign' => $request->input('city_authorised_to_sign'),
            'dob_authorised_to_sign' => $request->input('dob_authorised_to_sign'),
            'zip_file' => $zipPath,
        ];

        // Create Statamic entry
        $entry = Entry::make()
            ->collection('shareholder_company')
            ->slug(Str::slug($title.'-'.date('Y-m-d-H-i-s')))
            ->data($data);

        $entry->save();

        // Update entry with documents URL now that we have the entry ID
        if ($zipPath) {
            $entry->set('documents', route('shareholder.download-zip', $entry->id()));
            $entry->save();
        }

        // Refresh Statamic Stache to ensure the new entry is immediately available
        \Statamic\Facades\Stache::refresh();

        // Add entry ID and file info to data for notifications
        $notificationData = array_merge($data, [
            'entry_id' => $entry->id(),
            'zip_file' => $zipPath,
            'unique_id' => $uniqueId,
        ]);

        // Send notification
        Notification::route('mail', env('MAIL_TO'))->notify(new CompanyInformation($notificationData));

        return response()->json(['message' => 'Anfrage erfolgreich übermittelt']);
    }

    /**
     * Upload a single file to private storage
     *
     * @param  ShareholderCompanyRequest  $request
     * @param  string  $fileFieldName  The form field name
     * @param  string  $folderName  The folder to store in
     * @param  string  $filePrefix  Prefix for the filename
     * @return string The path to the uploaded file
     */
    protected function uploadFile(ShareholderCompanyRequest $request, string $fileFieldName, string $folderName, string $filePrefix): string
    {
        $file = $request->file($fileFieldName);

        $filename = sprintf(
            '%s-%s.%s',
            $filePrefix,
            Str::slug($request->input('company_name')),
            $file->getClientOriginalExtension()
        );

        // Store in storage/app/shareholder_requests/{folderName}
        $path = $file->storeAs('shareholder_requests/'.$folderName, $filename);

        return $path;
    }

    /**
     * Create a ZIP file containing all uploaded shareholder files
     *
     * @param  ShareholderCompanyRequest  $request
     * @param  string  $commercialRegisterPath  Path to commercial register
     * @param  string  $idCopyPath  Path to ID copy
     * @param  string  $powerOfAttorneyPath  Path to power of attorney
     * @param  string  $uniqueId  Unique identifier for the ZIP file
     * @return string|null The path to the created ZIP file
     */
    protected function createShareholderZip(ShareholderCompanyRequest $request, string $commercialRegisterPath, string $idCopyPath, string $powerOfAttorneyPath, string $uniqueId): ?string
    {
        // Collect all file paths
        $filePaths = array_filter([
            $commercialRegisterPath,
            $idCopyPath,
            $powerOfAttorneyPath,
        ]);

        // If no files, return null
        if (empty($filePaths)) {
            return null;
        }

        // Create ZIP filename with unique ID
        $zipFilename = sprintf(
            'aktionaer-firma-%s-%s-%s.zip',
            Str::slug($request->input('company_name')),
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
