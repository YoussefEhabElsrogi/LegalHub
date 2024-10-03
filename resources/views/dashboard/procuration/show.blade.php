@extends('dashboard.master')

@section('title', 'تفاصيل التوكيل')

@section('page', 'التوكيلات/')

@section('page-title', 'عرض التوكيل')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">تفاصيل التوكيل</h5>
            <div class="card-body">
                <h5 class="card-title">رقم التوكيل: <span class="text-primary">{{ $procuration->authorization_number }}</span>
                </h5>
                <p class="card-text"><strong>رقم التوكيل في الدفتر:</strong> {{ $procuration->notebook_number }}</p>
                <p class="card-text"><strong>ملاحظات:</strong> {{ $procuration->notes ?? 'لا توجد ملاحظات' }}</p>

                <h6 class="mt-4">تفاصيل العميل:</h6>
                @if ($procuration->client)
                    <ul class="list-unstyled">
                        <li><strong>اسم العميل:</strong> {{ $procuration->client->name }}</li>
                        <li><strong>رقم الهاتف:</strong> {{ $procuration->client->phone ?? 'غير متوفر' }}</li>
                        <li><strong>الرقم القومي:</strong> {{ $procuration->client->national_id ?? 'غير متوفر' }}</li>
                    </ul>
                @else
                    <p>لا توجد تفاصيل عن العميل.</p>
                @endif

                <h6 class="mt-4">الملفات:</h6>
                @if ($procuration->files->isEmpty())
                    <p>لا توجد ملفات لهذا التوكيل.</p>
                @else
                    <div class="row">
                        @foreach ($procuration->files as $index => $file)
                            <x-file-card :file="$file" />
                        @endforeach
                    </div>
                @endif

                <x-file-upload-form :action="route('attachments.upload', ['entityType' => 'Procuration', 'entityId' => $procuration->id])" />

                <div class="mt-4">
                    <a href="{{ route('procurations.edit', $procuration->id) }}" class="btn btn-primary">تعديل التوكيل</a>
                    <a href="{{ route('procurations.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
                </div>
            </div>
        </div>
    </div>
@endsection
