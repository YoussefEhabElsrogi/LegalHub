@extends('dashboard.master')

@section('title', 'تفاصيل الجلسة')

@section('page','الجلسات/')

@section('page-title','عرض الجلسة')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل الجلسة</h5>
        <div class="card-body">
            <h5 class="card-title">رقم الجلسة: {{ $session->session_number }}</h5>
            <p class="card-text"><strong>نوع الجلسة:</strong> {{ $session->session_type }}</p>
            <p class="card-text"><strong>اسم الخصم:</strong> {{ $session->opponent_name }}</p>
            <p class="card-text"><strong>تاريخ الجلسة:</strong> {{ $session->session_date }}</p>
            <p class="card-text"><strong>حالة الجلسة:</strong> {{ $session->session_status }}</p>
            <p class="card-text"><strong>ملاحظات:</strong> {{ $session->notes ?? 'لا توجد ملاحظات' }}</p>

            <h6>تفاصيل العميل:</h6>
            @if ($session->client)
                <ul>
                    <li><strong>اسم العميل:</strong> {{ $session->client->name }}</li>
                    <li><strong>رقم الهاتف:</strong> {{ $session->client->phone ?? 'غير متوفر' }}</li>
                    <li><strong>الرقم القومي:</strong> {{ $session->client->national_id ?? 'غير متوفر' }}</li>
                </ul>
            @else
                <p>لا توجد تفاصيل عن العميل.</p>
            @endif

            <h6>الملفات:</h6>
            @if ($session->files->isEmpty())
                <p>لا توجد ملفات لهذه الجلسة.</p>
            @else
                <div class="row">
                    @foreach ($session->files as $index => $file)
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <a href="{{ asset($file->path) }}" target="_blank">
                                        <i class="fas fa-file-pdf fa-3x" style="color: red;"></i>
                                    </a>
                                    <p class="mt-2">ملف {{ $index + 1 }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-primary mt-3">تعديل الجلسة</a>
            <a href="{{ route('sessions.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
