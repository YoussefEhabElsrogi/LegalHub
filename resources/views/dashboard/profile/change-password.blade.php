@extends('dashboard.master')

@section('title', 'تغيير كلمة المرور')

@section('page', 'الملف الشخصي/')

@section('page-title', 'تغيير كلمة المرور')

@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header text-center bg-primary text-white">تغيير كلمة المرور</h5>
        <div class="card-body">
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            placeholder="أدخل كلمة المرور الحالية" >
                        <span class="input-group-text cursor-pointer"
                            onclick="togglePasswordVisibility('current_password', this)">
                            <i class="fas fa-eye" id="current_password_eye"></i>
                        </span>
                    </div>
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            placeholder="أدخل كلمة المرور الجديدة" >
                        <span class="input-group-text cursor-pointer"
                            onclick="togglePasswordVisibility('new_password', this)">
                            <i class="fas fa-eye" id="new_password_eye"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" placeholder="تأكيد كلمة المرور" >
                        <span class="input-group-text cursor-pointer"
                            onclick="togglePasswordVisibility('new_password_confirmation', this)">
                            <i class="fas fa-eye" id="new_password_confirmation_eye"></i>
                        </span>
                    </div>
                    @error('new_password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">تغيير كلمة المرور</button>
                    <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, eyeIcon) {
            const inputField = document.getElementById(inputId);
            const icon = eyeIcon.querySelector('i');

            if (inputField.type === "password") {
                inputField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                inputField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
