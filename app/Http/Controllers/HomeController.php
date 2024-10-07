<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Procuration;
use App\Models\Session;
use App\Models\Expense;
use App\Models\Company;

class HomeController extends Controller
{
    public function index()
    {
        $numberOfAdmins = Admin::where('role', '!=', 'superadmin')->count();
        $numberOfClients = Client::count();
        $numberOfProcurations = Procuration::count();
        $numberOfSessions = Session::count();
        $totalExpenses = Expense::count();
        $numberOfCompanies = Company::count();

        return view('dashboard.home', compact(
            'numberOfAdmins',
            'numberOfClients',
            'numberOfProcurations',
            'numberOfSessions',
            'totalExpenses',
            'numberOfCompanies'
        ));
    }
}
