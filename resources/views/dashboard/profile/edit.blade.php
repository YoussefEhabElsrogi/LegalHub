@extends('dashboard.master')

@section('title', 'تعديل المعلومات الشخصية')

@section('page', 'الملف الشخصي/')

@section('page-title', 'تعديل المعلومات الشخصية')

@section('content')
    <div class="card">
        <h5 class="card-header">تعديل المعلومات الشخصية</h5>
        <div class="card-body">
            <form action="{{ route('profile.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">اسم المستخدم</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $admin->name) }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $admin->email) }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $admin->phone) }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">الدور</label>
                    <input type="text" class="form-control" id="role" value="{{ ucfirst($admin->role) }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">تغيير صورة الملف الشخصي</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
@endsection
