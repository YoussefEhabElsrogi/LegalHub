@extends('dashboard.master')

@section('title', 'تغيير كلمة المرور')

@section('page', 'الملف الشخصي/')

@section('page-title', 'تغيير كلمة المرور')

@section('content')
    <div class="card">
        <h5 class="card-header">تغيير كلمة المرور</h5>
        <div class="card-body">
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation">
                    @error('new_password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تغيير كلمة المرور</button>
                <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
@endsection
