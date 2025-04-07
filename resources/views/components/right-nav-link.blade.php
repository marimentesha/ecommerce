@props(['active' => false])

<a class="{{ $active ? 'selected' : '' }}"
   aria-current="{{ $active ? 'page': 'false' }}"
   {{ $attributes->merge(["style" => "float:right;padding-top:5px;padding-bottom:5px;margin:0;"]) }}
    >{{ $slot }}</a>
