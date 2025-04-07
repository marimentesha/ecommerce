@props(['active' => false, 'uri', 'name'])

<div class="m-2 text-[20px]">
    <a href="{{ $uri }}" class="no-underline text-black {{ $active ? 'selected' : '' }}">{{ $name }}</a>
    <hr class="line">
</div>
