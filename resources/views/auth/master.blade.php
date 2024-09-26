@include('auth.partials.head')

<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img') }}/illustrations/auth-login-illustration-light.png"
                    alt="صورة تسجيل الدخول" class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-login-illustration-light.png"
                    data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                <img src="{{ asset('assets/img') }}/illustrations/bg-shape-image-light.png" alt="صورة الخلفية"
                    class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                @include('auth.partials.logo')
                <h3 class="mb-1">مرحبًا بكم في {{ env('APP_NAME') }}! 👋</h3>
                <p class="mb-4">يرجى تسجيل الدخول إلى حسابك وبدء المغامرة</p>

                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('auth.partials.scripts')
