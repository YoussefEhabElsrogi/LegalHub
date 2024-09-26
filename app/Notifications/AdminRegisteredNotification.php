<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AdminRegisteredNotification extends Notification
{
    use Queueable;

    protected $adminName;

    /**
     * Create a new notification instance.
     *
     * @param string $adminName
     */
    public function __construct(string $adminName)
    {
        $this->adminName = $adminName;
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
        $superAdmin = Auth::user()->name;
        return (new MailMessage)
            ->greeting('مرحبا ' . $this->adminName)
            ->line("تم تسجيل دخولك بواسطة $superAdmin في موقع " . env('APP_NAME'))
            ->action('لتسجيل الدخول', url('/admin/login'));
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
