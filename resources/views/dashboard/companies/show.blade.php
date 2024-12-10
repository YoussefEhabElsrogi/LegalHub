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

            <h5 class="card-title mb-3 mt-2">
                <span class="text-muted">اسم الشركة:</span>
                <span class="text-dark">{{ $company->company_name }}</span>
            </h5>

            <div class="row mb-3">
                <x-info-box label="رسوم التأسيس" value="{{ $company->establishment_fees }} جنيهاً" />
                <x-info-box label="الأتعاب" value="{{ $company->fees }} جنيهاً" />
            </div>

            <div class="row mb-3">
                <x-info-box label="المقدم" value="{{ $company->advance_amount }} جنيهاً" />
                <x-info-box label="المؤخر" value="{{ $company->remaining_amount }} جنيهاً" />
            </div>

            @php
                $paid = $company->advance_amount;
                $remaining = $company->fees - $paid;
            @endphp

            <div class="row mb-3">
                <x-info-box label="تم سداد" value="{{ $paid }} ج.م" />
                <x-info-box label="الباقي" value="{{ $remaining > 0 ? $remaining . ' ج.م' : 'تم سداد المبلغ بالكامل' }}"
                    :badge="$remaining <= 0 ? 'success' : ''" />
            </div>

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
