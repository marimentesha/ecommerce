<ul {{$attributes->merge(["style" => "float:left;margin:0 160px;color:white"])}}>
    <div class="mb-[10px]">
        <b class="text-[20px]">{{$name}}</b>
    </div>
    {{ $slot }}
</ul>
