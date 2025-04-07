@props(['active' => false])

<a {{ $attributes->class(['button', 'selected' => $active]) }}
   aria-current="{{ $active ? 'page': 'false' }}">
    {{ $slot }}
</a>
