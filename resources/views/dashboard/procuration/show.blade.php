@extends('dashboard.master')

@section('title', 'تفاصيل التوكيل')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل التوكيل</h5>
        <div class="card-body">
            <h5 class="card-title">رقم التوكيل: {{ $procuration->authorization_number }}</h5>
            <p class="card-text"><strong>رقم التوكيل في الدفتر:</strong> {{ $procuration->notebook_number }}</p>
            <p class="card-text"><strong>ملاحظات:</strong> {{ $procuration->notes ?? 'لا توجد ملاحظات' }}</p>

            <h6>تفاصيل العميل:</h6>
            @if ($procuration->client)
                <ul>
                    <li><strong>اسم العميل:</strong> {{ $procuration->client->name }}</li>
                    <li><strong>رقم الهاتف:</strong> {{ $procuration->client->phone ?? 'غير متوفر' }}</li>
                    <li><strong>الرقم القومي:</strong> {{ $procuration->client->national_id ?? 'غير متوفر' }}</li>
                </ul>
            @else
                <p>لا توجد تفاصيل عن العميل.</p>
            @endif

            <h6>الملفات:</h6>
            @if ($procuration->files->isEmpty())
                <p>لا توجد ملفات لهذا التوكيل.</p>
            @else
                <div class="row">
                    @foreach ($procuration->files as $index => $file)
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

            <a href="{{ route('procuration.edit', $procuration->id) }}" class="btn btn-primary mt-3">تعديل التوكيل</a>
            <a href="{{ route('procuration.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
