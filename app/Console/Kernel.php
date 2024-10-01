<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Admin;
use App\Models\Session;
use App\Notifications\SessionReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $sessions = Session::whereIn('session_date', [
                Carbon::today()->addDays(3)->toDateString(),
                Carbon::today()->addDays(2)->toDateString(),
                Carbon::today()->addDays(1)->toDateString(),
                Carbon::today()->toDateString(),
            ])->get();

            $admins = Admin::get(['id', 'email']);

            foreach ($sessions as $session) {
                $sessionDate = Carbon::parse($session->session_date);

                $daysRemaining = $sessionDate->diffInDays(Carbon::today());

                foreach ($admins as $admin) {
                    if ($daysRemaining == 0) {
                        Notification::send($admin, new SessionReminderNotification($session, $daysRemaining, true));
                    } else {
                        Notification::send($admin, new SessionReminderNotification($session, $daysRemaining, false)); 
                    }
                }
            }
        })->timezone('Africa/Cairo')->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
