<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }} </title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<nav>
    <x-dropdown-menu>
        <x-slot:name>☰</x-slot:name>
        <a href="/about">About us</a>
        <a href="/contacts">Our contacts</a>
        <a href="/feedback">Leave Feedback</a>
    </x-dropdown-menu>

    <x-dropdown-menu>
        <x-slot:name>Catalog ▾ </x-slot:name>
        @foreach(\App\Models\Category::all() as $category)
            <a href="/catalog/{{ $category->id }}">{{ $category->name }}</a>
        @endforeach
    </x-dropdown-menu>

    <x-nav-link href="javascript:void(0)" style="margin:0 250px 0 150px;padding:0;" >+555 55 55 55</x-nav-link>
    <x-nav-link href="/"><img src="{{ asset('photos/logo.png') }}" alt="logo" class="mt-5"></x-nav-link>

    <x-right-nav-link href="/cart" :active="request()->is('cart')">Cart</x-right-nav-link>
    <x-right-nav-link href="/wishlist" :active="request()->is('wishlist')">Wishlist</x-right-nav-link>
    @guest
        <x-right-nav-link href="/register" :active="request()->is('register', 'login')">Account</x-right-nav-link>
    @endguest

    @auth
        <x-right-nav-link href="/users/{{ Auth::user()->id }}" :active="request()->is('users/' . Auth::user()->id)">Account</x-right-nav-link>
    @endauth
    <form class="-mt-4" action="/search" method="GET">
        <button type="submit" class="right bg-[#f0e4d5] border-none mr-3 -mt-0.5"><i class="material-icons">search</i></button>
        <input type="text" name="search" class="w-[20%] right" placeholder="search product...">
    </form>
</nav>
<body>

<main>
    {{$slot}}
</main>

@if(!request()->is('register', 'login'))
    <footer>
        <ul class="text-white">
            <li>
                <img src="{{ asset('photos/logo.png') }}" alt="logo">
            </li>
            <li style="margin-top:30px;width:100px">
                From Our Store to Your Door!
            </li>
        </ul>

        <x-footer-content>
            <x-slot:name>Menu</x-slot:name>
            <li><a href="/catalog" class="footer-link">Catalog</a></li>
            <li><a href="/about" class="footer-link">About Us</a></li>
            <li><a href="/contacts" class="footer-link">Contacts</a></li>
        </x-footer-content>

        <x-footer-content>
            <x-slot:name>Contacts</x-slot:name>
            <li>phone: 555 55 55 55</li>
            <li>email: online.shop@gmail.com</li>
        </x-footer-content>

        <x-footer-content>
            <x-slot:name>Socials</x-slot:name>
            <li>instagram</li>
            <li>telegram</li>
        </x-footer-content>

    </footer>
@endif

</body>

</html>
