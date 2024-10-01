@extends('dashboard.master')

@section('title', 'عرض الجلسات')

@section('page', 'الجلسات/')

@section('page-title', 'عرض الجلسات')

@section('content')
    <div class="card">
        <h5 class="card-header">الجلسات</h5>
        <div class="card-body">
            <a href="{{ route('sessions.create') }}" class="btn btn-primary mb-3">إضافة جلسة جديدة</a>
            <a href="{{ route('session.saved') }}" class="btn btn-secondary mb-3">الجلسات المحفوظة</a>

            @if ($sessions->isEmpty())
                <p>لا توجد جلسات مسجلة.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>رقم الجلسة</th>
                            <th>نوع الجلسة</th>
                            <th>تاريخ الجلسة</th>
                            <th>اسم الخصم</th>
                            <th>عدد الملفات</th>
                            <th>العميل</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->session_number }}</td>
                                <td>{{ $session->session_type }}</td>
                                <td>{{ $session->session_date }}</td>
                                <td>{{ $session->opponent_name }}</td>
                                <td>{{ $session->files->count() }}</td>
                                <td>{{ $session->client->name ?? 'غير متوفر' }}</td>
                                <td>
                                    @if ($session->session_status === 'سارية')
                                        <span class="badge bg-success">{{ $session->session_status }}</span>
                                    @elseif ($session->session_status === 'محفوظة')
                                        <span class="badge bg-secondary">{{ $session->session_status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <x-action-buttons :model-id="$session->id" route-prefix="sessions" />
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $sessions->links() }} <!-- Pagination links -->
                </div>
            @endif
        </div>
    </div>
@endsection
