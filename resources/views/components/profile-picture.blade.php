@props(['photo'])

<img src="{{ $photo }}" alt="profile photo"
     onerror="this.onerror=null; this.src='https://ssl.gstatic.com/accounts/ui/avatar_2x.png';"
     {{$attributes->merge(['style' => 'border-radius:50%;width:100px;height:100px'])}}>
