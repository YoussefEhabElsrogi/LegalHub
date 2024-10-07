<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionStatausController extends Controller
{
    private const STATUS_SAVED = 'محفوظة';

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $savedSessions = $this->getSavedSessions();

        return view('dashboard.sessions.saved', compact('savedSessions'));
    }

    /**
     * Get saved sessions with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getSavedSessions()
    {
        return Session::where('session_status', self::STATUS_SAVED)
            ->latest()
            ->paginate(10);
    }
}
