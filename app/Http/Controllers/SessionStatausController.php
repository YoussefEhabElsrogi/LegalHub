<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionStatausController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $savedSessions = Session::where('session_status', 'محفوظة')->latest()->paginate(10);

        return view('dashboard.sessions.saved', compact('savedSessions'));
    }
}
