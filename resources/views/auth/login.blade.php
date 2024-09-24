@extends('auth.master')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="col-xl-5">
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
    </div>
@endsection
