@extends('dashboard.master')

@section('title', 'تفاصيل الشركة')

@section('page', 'الشركات/')

@section('page-title', 'تفاصيل الشركة')

@section('content')
    <div class="card shadow-sm">
        <h5 class="card-header bg-primary text-white">تفاصيل الشركة</h5>
        <div class="card-body">
            <h5 class="card-title mb-3 mt-2">
                <span class="text-muted">اسم الموكل المالك للشركة:</span>
                <span class="text-dark">{{ $company->client->name }}</span>
            </h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>رسوم التأسيس:</strong>
                        {{ number_format($company->establishment_fees, 2) }} جنيهاً
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>الأتعاب:</strong>
                        {{ number_format($company->fees) }} جنيهاً
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>المقدم:</strong>
                        {{ number_format($company->advance_amount) }} جنيهاً
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>المؤخر:</strong>
                        {{ number_format($company->remaining_amount) }} جنيهاً
                    </p>
                </div>
            </div>

            @php
                $paid = $company->advance_amount;
                $remaining = $company->fees - $paid;
            @endphp

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>تم سداد:</strong>
                        {{ number_format($paid) }} ج.م
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">
                        <strong>الباقي:</strong>
                        @if ($remaining > 0)
                            {{ number_format($remaining) }} ج.م
                        @else
                            <span class="badge bg-success">تم سداد المبلغ بالكامل</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- عرض الملفات -->
            <h6 class="mt-4">الملفات:</h6>
            @if ($company->files->isEmpty())
                <p>لا توجد ملفات لهذه الشركة.</p>
            @else
                <div class="row">
                    @foreach ($company->files as $file)
                        <x-file-card :file="$file" />
                    @endforeach
                </div>

            @endif

            <x-file-upload-form :action="route('attachments.upload', ['entityType' => 'Company', 'entityId' => $company->id])" />

            <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-4">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
