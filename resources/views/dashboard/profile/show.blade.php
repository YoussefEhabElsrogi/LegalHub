@extends('dashboard.master')

@section('title', 'المعلومات الشخصية')

@section('page', 'الملف الشخصي/')

@section('page-title', 'المعلومات الشخصية')

@section('content')
    <div class="card">
        <h5 class="card-header">المعلومات الشخصية</h5>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title">اسم المستخدم: {{ $admin->name }}</h5>
                    <p class="card-text"><strong>البريد الإلكتروني:</strong> {{ $admin->email }}</p>
                    <p class="card-text"><strong>رقم الهاتف:</strong> {{ $admin->phone }}</p>
                    <p class="card-text"><strong>الدور:</strong> {{ ucfirst($admin->role) }}</p>
                </div>
                <div class="col-md-4 text-center d-flex align-items-center flex-column">
                    <p class="card-text"><strong>صورة الملف الشخصي:</strong></p>
                    @if ($admin->image && $admin->image !== 'images/default-image.jpeg')
                        <div style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%" class="photo">
                            <img style="object-fit: cover" width="100%" height="100%" src="{{ asset($admin->image) }}"
                                alt="Profile Image" style="max-width: 200px; max-height: ">
                        </div>
                    @else
                        <div style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%" class="photo">
                            <img style="object-fit: cover" width="100%" height="100%"
                                src="{{ asset('images/default-image.jpeg') }}" alt="Default Profile Image">
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('profile.edit', $admin->id) }}" class="btn btn-primary">تعديل المعلومات</a>
                <a href="{{ route('profile.update-password') }}" class="btn btn-warning">تغيير الباسورد</a>
                <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">العودة إلى لوحة التحكم</a>
            </div>
        </div>
    </div>
@endsection
