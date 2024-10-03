@extends('dashboard.master')

@section('title', 'عرض الأعدادات')

@section('page', 'الاعدادات/')

@section('page-title', 'عرض الاعدادات')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">عرض الإعدادات</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="fas fa-app fa-2x mb-2" aria-hidden="true"></i>
                            <span class="d-block">اسم التطبيق</span>
                        </h5>
                        <p class="card-text h4">{{ $setting->app_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-facebook fa-2x" style="color: #3b5998;"></i>
                                <span class="d-block">فيسبوك</span>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-instagram fa-2x" style="color: #C13584;"></i>
                                <span class="d-block">إنستجرام</span>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ $setting->twitter }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-twitter fa-2x" style="color: #1DA1F2;"></i>
                                <span class="d-block">تويتر</span>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('settings.edit') }}" class="btn btn-warning btn-lg me-2">تعديل الإعدادات</a>
            <a href="{{ route('dashboard.home') }}" class="btn btn-primary btn-lg">العودة إلى القائمة الرئيسية</a>
        </div>
    </div>
@endsection
