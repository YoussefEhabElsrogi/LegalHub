@extends('dashboard.master')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @if (Auth::user()->hasRole('superadmin'))
            <x-stat-card title="عدد المشرفين" count="{{ $numberOfAdmins }}" icon="ti ti-users"
                route="{{ route('admins.index') }}" />
        @endif
        <x-stat-card title="عدد الموكلين" count="{{ $numberOfClients }}" icon="ti ti-user"
            route="{{ route('clients.index') }}" />
        <x-stat-card title="عدد التوكيلات" count="{{ $numberOfProcurations }}" icon="ti ti-files"
            route="{{ route('procurations.index') }}" />

        <x-stat-card title="عدد الدعاوي" count="{{ $numberOfSessions }}" icon="ti ti-calendar"
            route="{{ route('sessions.index') }}" />
        <x-stat-card title="المصروفات الإدارية" count="{{ $totalExpenses }}" icon="ti ti-coins"
            route="{{ route('expenses.index') }}" />
        <x-stat-card title="عدد الشركات" count="{{ $numberOfCompanies }}" icon="ti ti-building"
            route="{{ route('companies.index') }}" />
        </div>

    </div>
@endsection

