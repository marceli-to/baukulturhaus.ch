<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Statamic\Facades\Entry;

class DownloadController extends Controller
{
  /**
   * Download shareholder ZIP file
   *
   * @param string $id The entry ID
   * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\JsonResponse
   */
  public function downloadZip(string $id)
  {
    // Find the entry
    $entry = Entry::find($id);

    if (!$entry) {
      abort(404, 'Entry not found');
    }

    $collectionHandle = $entry->collection()->handle();

    // Only allow downloads from shareholder collections
    if (!in_array($collectionHandle, ['shareholder_private', 'shareholder_company'])) {
      abort(403, 'Download not allowed for this collection');
    }

    $zipPath = $entry->get('zip_file');

    if (!$zipPath) {
      abort(404, 'ZIP file not found');
    }

    // Get full path from default storage disk
    $fullPath = Storage::path($zipPath);

    if (!file_exists($fullPath)) {
      abort(404, 'ZIP file does not exist on server');
    }

    // Friendly download filename
    if ($collectionHandle === 'shareholder_private') {
      $downloadName = sprintf(
        '%s-%s-aktionaer-privat.zip',
        $entry->get('firstname') ?? 'shareholder',
        $entry->get('name') ?? 'unknown'
      );
    } else {
      $downloadName = sprintf(
        '%s-aktionaer-firma.zip',
        $entry->get('company_name') ?? 'company'
      );
    }

    return response()->download($fullPath, $downloadName);
  }

  /**
   * Delete shareholder ZIP file
   *
   * @param string $id The entry ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function deleteZip(string $id)
  {
    // Find the entry
    $entry = Entry::find($id);

    if (!$entry) {
      abort(404, 'Entry not found');
    }

    $collectionHandle = $entry->collection()->handle();

    // Only allow deletion from shareholder collections
    if (!in_array($collectionHandle, ['shareholder_private', 'shareholder_company'])) {
      abort(403, 'Delete not allowed for this collection');
    }

    $zipPath = $entry->get('zip_file');

    if ($zipPath) {
      // Get full path from default storage disk
      $fullPath = Storage::path($zipPath);

      // Delete the file if it exists
      if (file_exists($fullPath)) {
        unlink($fullPath);
      }

      // Update the entry to remove the zip_file reference
      $entry->set('zip_file', null);
      $entry->save();
    }

    return redirect()->back()->with('success', 'ZIP-Datei wurde erfolgreich gelöscht');
  }
}
