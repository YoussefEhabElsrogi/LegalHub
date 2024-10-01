{{-- Include the head section --}}
@include('dashboard.partials.head')

{{-- Include the sidebar section --}}
@include('dashboard.partials.sidebar')

<div class="layout-page">

    {{-- Include the navbar --}}
    @include('dashboard.partials.navbar')

    {{-- Main content area --}}
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Breadcrumbs and Page title --}}
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">
                    الرئسية / @yield('page')
                </span>
                @yield('page-title')
            </h4>

            {{-- Dynamic content for each page --}}
            @yield('content')

        </div>

        {{-- Include the footer --}}
        @include('dashboard.partials.footer')

        <div class="content-backdrop fade"></div>
    </div>
</div>

{{-- Overlay and Drag Target --}}
<div class="layout-overlay layout-menu-toggle"></div>
<div class="drag-target"></div>

{{-- Include scripts --}}
@include('dashboard.partials.scripts')
