<ul>
    <li class="dropdown">
        <x-nav-link href="javascript:void(0)" class="dropButton">{{ $name }}</x-nav-link>
        <div class="dropdown-content">
            {{ $slot }}
        </div>
    </li>
</ul>
