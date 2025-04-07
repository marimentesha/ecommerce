@props(['name', 'type', 'value' => ''])

<div class="mt-[3%]">
    <label for="{{ $name }}">{{ $slot }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{$value}}" {{$attributes}}>
    <x-form-error name="{{ $name }}"/>
</div>
