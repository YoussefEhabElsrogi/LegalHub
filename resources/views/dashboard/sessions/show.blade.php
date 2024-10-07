@extends('dashboard.master')

@section('title', 'تفاصيل الدعوي')

@section('page', 'الدعاوي/')

@section('page-title', 'عرض الدعوي')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header text-center">تفاصيل الدعوي</h5>
            <div class="card-body">
                <h5 class="card-title">رقم الدعوي: <span class="text-primary">{{ $session->session_number }}</span></h5>
                <p class="card-text"><strong>نوع الدعوي:</strong> {{ $session->session_type }}</p>
                <p class="card-text"><strong>اسم الخصم:</strong> {{ $session->opponent_name }}</p>
                <p class="card-text"><strong>تاريخ الدعوي:</strong> {{ $session->session_date }}</p>
                <p class="card-text"><strong>حالة الدعوي:</strong>
                    <span
                        class="badge {{ $session->session_status == 'محفوظة' ? 'bg-secondary' : 'bg-success' }}">{{ $session->session_status }}</span>
                </p>
                <p class="card-text"><strong>ملاحظات:</strong> {{ $session->notes ?? 'لا توجد ملاحظات' }}</p>

                <h6 class="mt-4">تفاصيل العميل:</h6>
                @if ($session->client)
                    <ul class="list-group">
                        <li class="list-group-item"><strong>اسم العميل:</strong> {{ $session->client->name }}</li>
                        <li class="list-group-item"><strong>رقم الهاتف:</strong>
                            {{ $session->client->phone ?? 'غير متوفر' }}</li>
                        <li class="list-group-item"><strong>الرقم القومي:</strong>
                            {{ $session->client->national_id ?? 'غير متوفر' }}</li>
                    </ul>
                @else
                    <p class="text-danger">لا توجد تفاصيل عن العميل.</p>
                @endif

                <h6 class="mt-4">التذكيرات:</h6>
                @if ($session->reminders->isEmpty())
                    <p>لا توجد تذكيرات لهذه الدعوي.</p>
                @else
                    <ul class="list-group">
                        @foreach ($session->reminders as $reminder)
                            <li class="list-group-item">
                                <strong>وقت التذكير:</strong> {{ $reminder->reminder_time->format('Y-m-d') }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <h6 class="mt-4">الملفات:</h6>
                @if ($session->files->isEmpty())
                    <p>لا توجد ملفات لهذه الدعوي.</p>
                @else
                    <div class="row">
                        @foreach ($session->files as $file)
                            <x-file-card :file="$file" />
                        @endforeach
                    </div>
                @endif

                <x-file-upload-form :action="route('attachments.upload', ['entityType' => 'Session', 'entityId' => $session->id])" />

                <div class="mt-4">
                    <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-primary">تعديل الدعوي</a>
                    <a href="{{ route('sessions.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
                </div>
            </div>
        </div>
    </div>
@endsection
