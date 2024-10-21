<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="card {{ $cardBorderClass }} shadow border-0 rounded">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                    <span class="avatar-initial rounded-circle {{ $avatarBgClass }}">
                        <i class="{{ $icon }} ti-md"></i>
                    </span>
                </div>
                <h4 class="ms-1 mb-0 text-primary">{{ $count }}</h4>
            </div>
            <p class="mb-1 text-muted">{{ $title }}</p>
            <a href="{{ $route }}" class="btn btn-primary mt-3 w-100" style="white-space: nowrap">عرض كل {{ $title }}</a>
        </div>
    </div>
</div>
