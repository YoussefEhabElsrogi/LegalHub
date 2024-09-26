@extends('auth.master')

@section('title', 'تسجيل الدخول')

@section('content')
    {{-- <div class="col-xl-5">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                    <div class="pt-0">
                        <form action="{{ route('admin.login') }}" method="POST" class="my-4">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input class="form-control" name="email" type="text" id="email"
                                    placeholder="أدخل البريد الإلكتروني" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input class="form-control" type="password" name="password" id="password"
                                    placeholder="أدخل كلمة المرور">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-0 row">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">تسجيل</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                placeholder="أدخل البريد الإلكتروني" />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">كلمة المرور</label>
                <a href="auth-forgot-password-cover.html">
                    <small>نسيت كلمة المرور؟</small>
                </a>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />

                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> تذكرني </label>
            </div>
        </div> --}}
        <button class="btn btn-primary d-grid w-100">تسجيل الدخول</button>
    </form>

@endsection
