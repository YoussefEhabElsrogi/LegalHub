@extends('dashboard.master')

@section('title', 'تفاصيل الشركة')

@section('page', 'الشركات/')

@section('page-title', 'تفاصيل الشركة')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل الشركة</h5>
        <div class="card-body">
            <!-- عرض اسم الموكل المالك للشركة -->
            <h5 class="card-title">اسم الموكل المالك للشركة: {{ $company->client->name }}</h5>

            <p class="card-text"><strong>رسوم التأسيس:</strong> {{ number_format($company->establishment_fees, 2) }} جنيهاً
            </p>
            <p class="card-text"><strong>الأتعاب:</strong> {{ number_format($company->fees) }} جنيهاً</p>
            <p class="card-text"><strong>المقدم:</strong> {{ number_format($company->advance_amount) }} جنيهاً</p>
            <p class="card-text"><strong>المؤخر:</strong> {{ number_format($company->remaining_amount) }} جنيهاً</p>

            @php
                $paid = $company->advance_amount; // المبلغ المدفوع
                $remaining = $company->fees - $paid; // الباقي من الأتعاب
            @endphp

            <p class="card-text"><strong>تم سداد:</strong> {{ number_format($paid) }} ج.م</p>
            <p class="card-text">
                <strong>الباقي:</strong>
                @if ($remaining > 0)
                    {{ number_format($remaining) }} ج.م
                @else
                    تم سداد المبلغ بالكامل
                @endif
            </p>

            <h6>الملفات:</h6>
            @if ($company->files->isEmpty())
                <p>لا توجد ملفات لهذه الشركة.</p>
            @else
                <div class="row">
                    @foreach ($company->files as $index => $file)
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <a href="{{ asset($file->path) }}" target="_blank">
                                        <i class="fas fa-file-pdf fa-3x" style="color: red;"></i>
                                    </a>
                                    <p class="mt-2">اسم الملف: {{ basename($file->path) }}</p>

                                    <!-- زر لتحميل الملف -->
                                    <form action=" {{ route('attachments.download', $file->id) }}" method="GET"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">تحميل</button>
                                    </form>

                                    <!-- زر لحذف الملف -->
                                    <form action="{{ route('attachments.destroy', $file->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <h6>تحميل ملف جديد:</h6>
            <form action="{{ route('attachments.upload', ['entityType' => 'Company', 'entityId' => $company->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="files" class="form-label">اختر ملف (PDF فقط)</label>
                    <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf"
                        multiple>
                    @error('files')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تحميل</button>
            </form>

            <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
