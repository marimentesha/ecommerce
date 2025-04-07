@props(['uri'])


<form method="post" action= "{{$uri}}" {{$attributes}}>
    @csrf
    @method('PATCH')

    {{$slot}}
</form>
