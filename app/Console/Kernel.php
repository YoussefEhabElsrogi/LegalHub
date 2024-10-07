<?php

namespace App\Console;

use App\Notifications\SessionReminderNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Admin;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $admins = Admin::select(['id', 'email'])->get();

        $schedule->call(function () use ($admins) {
            try {
                $today = now()->startOfDay();
                Session::with('reminders')->chunk(100, function ($sessions) use ($today, $admins) {
                    foreach ($sessions as $session) {
                        if ($session->reminders->isNotEmpty()) {
                            foreach ($session->reminders as $reminder) {
                                $reminderTime = Carbon::parse($reminder->reminder_time);
                                if ($reminderTime->isSameDay($today)) {
                                    Notification::send($admins, new SessionReminderNotification($session));
                                    $reminder->delete();
                                }
                            }
                        }
                    }
                });
            } catch (\Exception $e) {
                Log::error('Error in scheduled task: ' . $e->getMessage());
            }
        })
            ->dailyAt('01:00')
            ->timezone('Africa/Cairo');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
