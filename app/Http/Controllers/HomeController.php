<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Procuration;
use App\Models\Session;
use App\Models\Expense;
use App\Models\Company;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Collect statistics in a single step
        $statistics = [
            'numberOfAdmins'      => Admin::where('role', '!=', 'superadmin')->count(),
            'numberOfClients'     => Client::count(),
            'numberOfProcurations' => Procuration::count(),
            'numberOfSessions'    => Session::count(),
            'totalExpenses'       => Expense::count(),
            'numberOfCompanies'   => Company::count(),
        ];

        // Get current year and month
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->month;

        // Get session count for each month up to the current month
        $sessionsPerMonth = $this->getSessionsPerMonth($currentYear, $currentMonth);

        // Calculate monthly changes
        $changesPerMonth = $this->calculateChangesPerMonth($sessionsPerMonth);

        // Pass data to the view
        return view('dashboard.home', array_merge($statistics, [
            'changesPerMonth' => $changesPerMonth,
            'currentMonth'    => $currentMonth,
        ]));
    }

    /**
     * Get the number of sessions for each month in the current year.
     *
     * @param int $year
     * @param int $currentMonth
     * @return \Illuminate\Support\Collection
     */
    private function getSessionsPerMonth($year, $currentMonth)
    {
        return collect(range(1, $currentMonth))->map(function ($month) use ($year) {
            return Session::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        });
    }

    /**
     * Calculate the month-over-month changes in session count.
     *
     * @param \Illuminate\Support\Collection $sessionsPerMonth
     * @return \Illuminate\Support\Collection
     */
    private function calculateChangesPerMonth($sessionsPerMonth)
    {
        return $sessionsPerMonth->map(function ($count, $index) use ($sessionsPerMonth) {
            return $index === 0 ? 0 : $count - $sessionsPerMonth[$index - 1];
        });
    }
}
