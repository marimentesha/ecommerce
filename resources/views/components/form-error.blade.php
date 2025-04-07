@props(['name'])

@error($name)
<pre {{$attributes->merge(['style'=>"color: darkred; font-size: 13px;margin:0"])}}>{{ $message }}</pre>
@enderror
