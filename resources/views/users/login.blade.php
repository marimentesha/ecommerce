<x-layout>
    <x-slot:heading>Login</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
        <div class="my-[5%]">
            <x-button href="/login" :active="request()->is('login')">Login</x-button>
            <x-button href="/register" :active="request()->is('register')">Register</x-button>
        </div>
    </div>
    <div class="div-box">
        <div class="left m-[16%_6%]">
            <form action="/login" method="post">
                @csrf
                <x-form-input name="email" type="email">Email</x-form-input>
                <x-form-input name="password" type="password">Password</x-form-input>

                <div>
                    <button class="authButton">
                        Login
                    </button>
                </div>
            </form>
            <div class="mt-[5%]">
                <a href="#" class="text-black">forgot the password?</a>
            </div>
        </div>
        <div>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo" class="right authPhoto">
        </div>
    </div>
</x-layout>
