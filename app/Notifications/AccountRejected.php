<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRejected extends Notification
{
    use Queueable;

    public $rejectionReason;

    /**
     * Create a new notification instance.
     */
    public function __construct($rejectionReason)
    {
        $this->rejectionReason = $rejectionReason;
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
            ->subject('Account Registration Rejected - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your account registration has been rejected.')
            ->line('Reason: ' . $this->rejectionReason)
            ->line('If you believe this is a mistake, please contact our support team.')
            ->line('You may reapply with corrected information if applicable.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'rejection_reason' => $this->rejectionReason
        ];
    }
}