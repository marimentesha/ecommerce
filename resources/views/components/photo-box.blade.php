@props(['photo'])

<div {{$attributes->merge(['class' => 'left'])}}>
    <img src="{{ asset("$photo") }}" alt="photo" class="smallPhoto">
    <p>{{ $slot }}</p>
</div>
