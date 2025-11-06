<?php
namespace App\Notifications\Shareholder;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyInformation extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'))
            ->replyTo($this->data['email_admin'])
            ->subject('Aktionär:in (Firma) – ' . $this->data['company_name'])
            ->markdown('notifications.shareholder.company.owner-information', ['data' => $this->data]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
