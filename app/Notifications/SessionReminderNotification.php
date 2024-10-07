<?php

namespace App\Notifications;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionReminderNotification extends Notification
{
    use Queueable;

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $formattedDate = Carbon::parse($this->session->session_date)->format('l, F j, Y');
        return (new MailMessage)
            ->subject('تذكير: لديك دعوى قادمة!')
            ->greeting('مرحبًا!')
            ->line('نود تذكيرك بأن لديك دعوى مجدولة في يوم ' . $formattedDate . '.')
            ->line('تفاصيل الدعوى:')
            ->line('رقم الدعوى: **' . $this->session->session_number . '**')
            ->line('اسم الخصم: **' . $this->session->opponent_name . '**')
            ->line('ملاحظات: ' . $this->session->notes)
            ->action('رؤية المزيد من التفاصيل', url('http://localhost:8000/sessions/' . $this->session->id))
            ->line('شكرًا لك!');
    }
}
