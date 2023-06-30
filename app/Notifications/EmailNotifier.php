<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotifier extends Notification
{
    use Queueable;

    protected $input;
    protected $subject, $phone, $data_plan;

    /**
     * Create a new notification instance.
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->subject = $input['subject'] ?? '';
        $this->phone = $input['phone'] ?? '';
        $this->data_plan = $input['data_plan'] ?? '';
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject($this->subject)
        ->greeting('Hello')
        ->line('There  is a new 9Mobile request. Kindly find details below')
        ->line('Phone number (recipient): '.$this->phone)
        ->line('Data Plan: '.$this->data_plan)
        ->line('Please check history on the 9mobile portal to ensure that the Data has not been sent already.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
