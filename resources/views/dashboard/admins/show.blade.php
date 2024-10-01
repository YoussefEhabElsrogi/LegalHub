@extends('dashboard.master')

@section('title', 'عرض المشرف')

@section('page', 'المشرفين')

@section('page-title', 'عرض المشرف')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">تفاصيل المشرف</h5>
        <div class="card-body">
            <div class="mb-4">
                <h5 class="card-title">
                    <i class="ti ti-user ti-lg text-info me-2"></i>
                    <strong>الاسم:</strong> {{ $admin->name }}
                </h5>
                <p class="card-text">
                    <strong><i class="mdi mdi-email text-success me-1"></i>البريد الإلكتروني:</strong>
                    <span class="text-muted">{{ $admin->email }}</span>
                </p>
                <p class="card-text">
                    <strong><i class="mdi mdi-phone text-warning me-1"></i>رقم الهاتف:</strong>
                    <span class="text-muted">{{ $admin->phone }}</span>
                </p>
                <p class="card-text">
                    <strong><i class="mdi mdi-account-circle text-primary me-1"></i>الدور:</strong>
                    <span class="text-muted">{{ ucfirst($admin->role) }}</span>
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary">تعديل</a>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
            </div>
        </div>
    </div>
@endsection
