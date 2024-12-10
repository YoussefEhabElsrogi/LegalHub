@extends('auth.master')

@section('title', 'تسجيل الدخول')

@section('content')
    <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="text" value="admin@admin.com" class="form-control" id="email" name="email"
                value="{{ old('email') }}" placeholder="أدخل البريد الإلكتروني" />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">كلمة المرور</label>
            </div>
            <div class="input-group input-group-merge">
                <input value="123123123" type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />

                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary d-grid w-100">تسجيل الدخول</button>
    </form>

@endsection
