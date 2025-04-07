<x-layout>
    <x-slot:heading>Register</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
        <div class="my-[5%]">
            <x-button href="/login" :active="request()->is('login')">Login</x-button>
            <x-button href="/register" :active="request()->is('register')">Register</x-button>
        </div>
    </div>

    <div class="div-box">
        <div class="left m-[2%]">
            <form action="/register" method="post">
                @csrf
                <x-form-input name="first" type="text">First name</x-form-input>
                <x-form-input name="last" type="text">Last name</x-form-input>
                <x-form-input name="email" type="email">Email</x-form-input>
                <x-form-input name="phone" type="tel">Phone number</x-form-input>
                <x-form-input name="password" type="password">Password</x-form-input>
                <x-form-input name="password_repeat" type="password">Repeat the password</x-form-input>

                <div>
                    <button class="authButton">Register</button>
                </div>
            </form>
        </div>

        <div>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo" class="right authPhoto">
        </div>
    </div>
</x-layout>
