@extends('dashboard.master')

@section('title', 'عرض المشرف')

@section('page', 'المشرفين')

@section('page-title', 'عرض المشرف')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل المشرف</h5>
        <div class="card-body">
            <h5 class="card-title">الاسم: {{ $admin->name }}</h5>
            <p class="card-text"><strong>البريد الإلكتروني:</strong> {{ $admin->email }}</p>
            <p class="card-text"><strong>رقم الهاتف:</strong> {{ $admin->phone }}</p>
            <p class="card-text"><strong>الدور:</strong> {{ ucfirst($admin->role) }}</p>
            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary">تعديل</a>
            <a href="{{ route('admin.home') }}" class="btn btn-secondary">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
