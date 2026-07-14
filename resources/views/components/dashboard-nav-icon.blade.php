@props(['name'])

<svg class="dashboard-nav-icon" viewBox="0 0 24 24" aria-hidden="true">
    @switch($name)
        @case('grid')
            <rect x="3" y="3" width="7" height="7" />
            <rect x="14" y="3" width="7" height="7" />
            <rect x="3" y="14" width="7" height="7" />
            <rect x="14" y="14" width="7" height="7" />
            @break
        @case('car')
            <path d="M5 17h14l1-5-2-5H6l-2 5 1 5Z" />
            <path d="M7 17v2M17 17v2M4 12h16M7.5 14h.01M16.5 14h.01" />
            @break
        @case('users')
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
            @break
        @case('tool')
            <path d="M14.7 6.3a4 4 0 0 0-5-5L12 3.6 9.6 6 7.3 3.7a4 4 0 0 0 5 5l-8.5 8.5a2.1 2.1 0 0 0 3 3l8.5-8.5a4 4 0 0 0 5-5L18 9l-2.4-2.4 2.3-2.3a4 4 0 0 0-3.2 2Z" />
            @break
        @case('repair')
            <path d="M14 7 7 14M5 16l3 3M16 5l3 3" />
            <path d="m14 4 6 6M4 14l6 6M12 12l8 8M4 4l5 5" />
            @break
        @case('chart')
            <path d="M3 3v18h18" />
            <path d="m7 16 4-5 4 3 5-7" />
            @break
    @endswitch
</svg>
