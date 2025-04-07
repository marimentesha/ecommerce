@props(['step', 'name'])
<div class="step -mt-5" id="step{{$step}}" {{$attributes}}>
    <h2>{{ $name }}</h2>
    {{ $slot }}

    <div class="my-5 -mx-2">
        {{ $button }}
    </div>
</div>
