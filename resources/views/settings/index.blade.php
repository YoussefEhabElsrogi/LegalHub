@extends('dashboard.master')

@section('title', 'عرض الأعدادات')

@section('page', 'عرض الاعدادات')

@section('content')
    <div class="container">
        <h1>عرض الإعدادات</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-app"></i> اسم التطبيق
                            </a>
                        </h5>
                        <p class="card-text">{{ $setting->app_name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ $setting->facebook }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-facebook" style="color: #3b5998;"></i> فيسبوك
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ $setting->instagram }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-instagram" style="color: #C13584;"></i> إنستجرام
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ $setting->twitter }}" target="_blank" class="text-decoration-none text-dark">
                                <i class="fab fa-twitter" style="color: #1DA1F2;"></i> تويتر
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('settings.edit') }}" class="btn btn-warning">تعديل الإعدادات</a>
            <a href="{{ route('dashboard.home') }}" class="btn btn-primary">العودة إلى قائمة الرئسية</a>
        </div>
    </div>
@endsection
