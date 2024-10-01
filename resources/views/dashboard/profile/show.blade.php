@extends('dashboard.master')

@section('title', 'المعلومات الشخصية')

@section('page', 'الملف الشخصي/')

@section('page-title', 'المعلومات الشخصية')

@push('css')
    <style>
        /* التأثير على صورة الملف الشخصي */
        .photo {
            transition: transform 0.3s ease-in-out;
            border: 3px solid #ddd;
        }

        .photo:hover {
            transform: scale(1.1);
            border-color: #007bff;
        }

        /* تحسين تنسيق عنوان البطاقة */
        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(45deg, #007bff, #6c757d);
            color: white;
            text-align: center;
        }

        /* تنسيق النصوص الداخلية */
        .card-title {
            font-size: 1.25rem;
            color: #343a40;
        }

        .card-text {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        /* تحسين شكل الأزرار */
        .btn {
            margin: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        /* إضافة ظل خفيف إلى البطاقة */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* تحسين تنسيق الحاوية */
        .card-body {
            padding: 30px;
        }

        .text-center {
            margin-top: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm">
        <h5 class="card-header">المعلومات الشخصية</h5>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title"><i class="fas fa-user"></i> اسم المستخدم: {{ $admin->name }}</h5>
                    <p class="card-text"><strong><i class="fas fa-envelope"></i> البريد الإلكتروني:</strong>
                        {{ $admin->email }}</p>
                    <p class="card-text"><strong><i class="fas fa-phone"></i> رقم الهاتف:</strong> {{ $admin->phone }}</p>
                    <p class="card-text"><strong><i class="fas fa-user-tag"></i> الدور:</strong> {{ ucfirst($admin->role) }}
                    </p>
                </div>
                <div class="col-md-4 text-center d-flex align-items-center flex-column">
                    <p class="card-text"><strong><i class="fas fa-image"></i> صورة الملف الشخصي:</strong></p>
                    <div class="photo"
                        style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        @if ($admin->image)
                            <img style="object-fit: cover; width: 100%; height: 100%;" src="{{ asset($admin->image) }}"
                                alt="Profile Image">
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('profile.edit', $admin->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> تعديل المعلومات
                </a>
                <a href="{{ route('profile.update-password') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-lock"></i> تغيير الباسورد
                </a>
                <a href="{{ route('dashboard.home') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> العودة إلى لوحة التحكم
                </a>
            </div>
        </div>
    </div>
@endsection
