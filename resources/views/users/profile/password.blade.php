<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <h3 class="flex justify-center">Change Password</h3>
        <div class="flex justify-center items-center w-[72%]  text-2xl">
            <form action="/users/{{ $user->id }}/password" method="post">
                @csrf
                @method('patch')
                <x-form-input name="password_old" type="password">Current Password:</x-form-input>
                <x-form-input name="password" type="password">New Password:</x-form-input>
                <x-form-input name="password_again" type="password">Repeat New Password:</x-form-input>

                <div class="my-5">
                    <button type="submit" class="button2">save</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
