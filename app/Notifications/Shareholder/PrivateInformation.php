<?php
namespace App\Notifications\Shareholder;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PrivateInformation extends Notification
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
            ->subject('Aktionär:in (Privat) – ' . $this->data['firstname'] . ' ' . $this->data['name'])
            ->markdown('notifications.shareholder.private.owner-information', ['data' => $this->data]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
