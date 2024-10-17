@extends('dashboard.master')

@section('title', 'إضافة مشرف')

@section('page', 'المشرفين/')

@section('page-title', 'إضافة مشرف')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة مشرف</h5>

            <form id="adminForm" action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">الاسم <span class="text-danger"
                            style="font-size: 1.2em;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="ادخل اسم المشرف" required value="{{ old('name') }}" aria-describedby="nameError">
                    </div>
                    @error('name')
                        <div class="text-danger" id="nameError">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger"
                            style="font-size: 1.2em;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="ادخل بريدك الإلكتروني" required value="{{ old('email') }}"
                            aria-describedby="emailError">
                    </div>
                    @error('email')
                        <div class="text-danger" id="emailError">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="password" class="form-label">كلمة المرور <span class="text-danger"
                            style="font-size: 1.2em;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="ادخل كلمة المرور" required>
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="ti ti-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <ul class="text-muted mt-2" style="list-style-type: disc; margin-left: 20px;">
                        <li>يجب أن تحتوي على 8 أحرف على الأقل.</li>
                        <li>يجب أن تحتوي على أحرف كبيرة وصغيرة.</li>
                        <li>يجب أن تحتوي على رقم واحد على الأقل.</li>
                        <li>يجب أن تحتوي على رمز خاص واحد على الأقل (مثل !@#$%^&*).</li>
                        <li>يجب ألا تكون مسربة في اختراق سابق.</li>
                    </ul>
                </div>

                <div class="mb-3 p-3">
                    <label for="phone" class="form-label">رقم الهاتف <span class="text-danger"
                            style="font-size: 1.2em;">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                        <input type="text" name="phone" class="form-control" id="phone"
                            placeholder="ادخل رقم الهاتف (مثل: 01254789635)" required value="{{ old('phone') }}"
                            aria-describedby="phoneError">
                    </div>
                    @error('phone')
                        <div class="text-danger" id="phoneError">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="role" class="form-ِlabel">الدور <span class="text-danger"
                            style="font-size: 1.2em;">*</span></label>
                    <select name="role" class="form-select" id="role" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-3">
                    <label for="image" class="form-label">صورة المستخدم (jpg, png, jpeg)</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/*">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">الحد الأقصى لحجم الصورة 2MB.</small>
                </div>

                <button type="submit" class="btn btn-primary mx-3 mb-3">إضافة المشرف</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.getAttribute('type');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.querySelector('i').classList.remove('ti-eye');
                this.querySelector('i').classList.add('ti-eye-off');
            } else {
                passwordField.setAttribute('type', 'password');
                this.querySelector('i').classList.remove('ti-eye-off');
                this.querySelector('i').classList.add('ti-eye');
            }
        });
    </script>
@endpush
