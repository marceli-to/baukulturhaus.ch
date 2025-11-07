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
            ->replyTo(env('MAIL_REPLY_TO'))
            ->cc('m@marceli.to')
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
