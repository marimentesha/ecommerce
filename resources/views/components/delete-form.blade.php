@props(['uri'])

<form method="post" action="{{ $uri }}" {{$attributes}}>
    @csrf
    @method('DELETE')
    <button type="submit" class="button2">Delete</button>
</form>
