@extends('auth.master')

@section('title', 'تسجيل حساب جديد')

@section('content')
    <div class="col-xl-5">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                    <div class="pt-0">
                        <form action="{{ route('admin.register') }}" method="POST" class="my-4"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">اسم المستخدم</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    placeholder="أدخل اسم المستخدم" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
                                    placeholder="أدخل كلمة المرور" value="123123123">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input class="form-control" name="phone" type="text" id="phone"
                                    placeholder="أدخل رقم الهاتف" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="form-label">اختر صورة</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')
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

                        <div class="text-center text-muted mb-4">
                            <p class="mb-0">هل لديك حساب بالفعل؟ <a class='text-primary ms-2 fw-medium'
                                    href='auth-login.html'>تسجيل الدخول هنا</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
