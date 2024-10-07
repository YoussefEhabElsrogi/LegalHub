<li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti {{ $icon }}"></i>
        <div>{{ $title }}</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs($createRoute) ? 'active' : '' }}">
            <a href="{{ route($createRoute) }}" class="menu-link">
                <div>{{ $createLabel }}</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs($indexRoute) ? 'active' : '' }}">
            <a href="{{ route($indexRoute) }}" class="menu-link">
                <div>{{ $indexLabel }}</div>
            </a>
        </li>
    </ul>
</li>
