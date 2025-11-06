<?php

namespace App\Console\Commands;

use App\Notifications\Shareholder\OwnerInformation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class TestShareholderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:shareholder-notification {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test shareholder private notification with fake data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? env('MAIL_TO');

        if (!$email) {
            $this->error('No email provided and MAIL_TO is not set in .env');
            return 1;
        }

        $this->info('Sending test notification to: ' . $email);

        // Fake data matching the shareholder_private structure
        $data = [
            'salutation' => 'Herr',
            'firstname' => 'Max',
            'name' => 'Mustermann',
            'location' => 'Musterstrasse 123',
            'zip' => '3011',
            'city' => 'Bern',
            'email' => 'max.mustermann@example.com',
            'phone' => '+41 31 123 45 67',
            'dob' => '15.03.1980',
            'entry_id' => 'test-entry-123',
            'identity_document_path' => 'shareholder_requests/max-mustermann-2025-01-15_10-30-45/identitaetsdokument-max-mustermann.pdf',
            'power_of_attorney_path' => 'shareholder_requests/max-mustermann-2025-01-15_10-30-45/vollmacht-max-mustermann.pdf',
            'zip_file' => 'shareholder_requests/max-mustermann-2025-01-15_10-30-45/aktionaer-privat-2025-01-15_10-30-45.zip',
            'folder_name' => 'max-mustermann-2025-01-15_10-30-45',
        ];

        try {
            Notification::route('mail', $email)->notify(new OwnerInformation($data));
            $this->info('✓ Test notification sent successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to send notification: ' . $e->getMessage());
            return 1;
        }
    }
}
