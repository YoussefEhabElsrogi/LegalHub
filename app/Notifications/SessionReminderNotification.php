<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionReminderNotification extends Notification
{
    use Queueable;

    protected $session;
    protected $daysRemaining;
    protected $isToday; // إضافة متغير جديد لتحديد إذا كانت الجلسة اليوم

    public function __construct($session, $daysRemaining, $isToday)
    {
        $this->session = $session;
        $this->daysRemaining = $daysRemaining;
        $this->isToday = $isToday; // حفظ قيمة إذا كانت الجلسة اليوم
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('تذكير جلسة');

        if ($this->isToday) {
            // رسالة خاصة بأن الجلسة اليوم
            $mailMessage->line('عندك جلسة اليوم.');
        } else {
            // رسالة عادية للتذكير بالجلسة قبل عدة أيام
            $mailMessage->line("عندك جلسة بعد {$this->daysRemaining} أيام.");
        }

        return $mailMessage
            ->line('تفاصيل الجلسة:')
            ->line('نوع الجلسة: ' . $this->session->session_type)
            ->line('رقم الجلسة: ' . $this->session->session_number)
            ->line('اسم الخصم: ' . $this->session->opponent_name)
            ->line('تاريخ الجلسة: ' . $this->session->session_date->format('Y-m-d'))
            ->line('ملاحظات: ' . ($this->session->notes ?? 'لا توجد ملاحظات'));
    }
}
