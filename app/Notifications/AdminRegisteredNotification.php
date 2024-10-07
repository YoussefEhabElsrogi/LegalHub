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

    public function __construct(string $adminName)
    {
        $this->adminName = $adminName;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    public function toMail(object $notifiable): MailMessage
    {
        $superAdmin = Auth::check() ? Auth::user()->name : 'النظام';

        return (new MailMessage)
            ->greeting('مرحبا ' . $this->adminName)
            ->line("تم تسجيل دخولك بواسطة $superAdmin في موقع " . config('app.name'))
            ->action('لتسجيل الدخول', route('admin.login'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'admin_name' => $this->adminName,
            'triggered_by' => Auth::check() ? Auth::user()->name : 'النظام',
        ];
    }
}
