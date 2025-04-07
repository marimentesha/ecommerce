@props(['active' => false, 'class' => ''])

<a class="{{ $active ? 'selected' : '' }} {{ $class }}"
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}>
    {{ $slot }}
</a>
