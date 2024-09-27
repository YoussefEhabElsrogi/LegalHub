@extends('dashboard.master')

@section('title', 'إضافة مشرف')

@section('page', 'المشرفين/')

@section('page-title', 'إضافة مشرف')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة مشرف</h5>
            <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 p-2">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="ادخل اسم المشرف"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="ادخل بريدك الإلكتروني" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="ادخل كلمة المرور">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="ادخل رقم الهاتف"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="role" class="form-label">الدور</label>
                    <select name="role" class="form-select" id="role">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="image" class="form-label">صورة المستخدم</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/*">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة المشرف</button>
            </form>
        </div>
    </div>
@endsection
