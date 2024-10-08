<div class="col-md-6">
    <p class="card-text">
        <strong>{{ $label }}:</strong>
        {{ $value }}
        @if ($badge ?? false)
            <span class="badge bg-{{ $badge }}">{{ $value }}</span>
        @endif
    </p>
</div>
