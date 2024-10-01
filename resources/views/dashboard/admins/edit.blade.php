@extends('dashboard.master')

@section('title', 'تعديل المشرف')

@section('page', 'المشرفين/')

@section('page-title', 'تعديل مشرف')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">تعديل مشرف</h5>
            <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">الاسم</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="ادخل اسم المشرف" required value="{{ old('name', $admin->name) }}">
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="ادخل بريدك الإلكتروني" required value="{{ old('email', $admin->email) }}">
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="ادخل رقم الهاتف" required value="{{ old('phone', $admin->phone) }}">
                    </div>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="role" class="form-label">الدور</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ old('role', $admin->role) == 'superadmin' ? 'selected' : '' }}>
                            Super Admin</option>
                    </select>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mx-3 mb-3">تحديث</button>
            </form>
        </div>
    </div>
@endsection
