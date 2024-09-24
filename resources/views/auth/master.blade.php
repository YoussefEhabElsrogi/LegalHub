@include('auth.partials.head')

<div class="account-page">
    <div class="container-fluid p-0">
        <div class="row align-items-center g-0">
            @yield('content')

            <div class="col-xl-7">
                <div class="account-page-bg p-md-5 p-4">
                    <div class="text-center">
                        <h3 class="text-dark mb-3 pera-title">سريع وفعال ومنتج مع لوحة تحكم {{ env('APP_NAME') }}
                        </h3>
                        <div class="auth-image">
                            <img src="{{ asset('assets/images/') }}/authentication.svg" class="mx-auto img-fluid"
                                alt="صور">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('auth.partials.scripts')
