<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <h3 class="flex justify-center">User Data</h3>
        <div class="flex justify-center items-center w-[72%] mt-[7%] text-2xl">
            <form action="/users/{{ $user->id }}" method="post">
                @csrf
                @method('patch')
                <div class="left mr-5">
                    <x-form-input name="first" type="text" value="{{ $user->first }}">First name:</x-form-input>
                    <x-form-input name="last" type="text" value="{{ $user->last }}">Last name:</x-form-input>

                    <div class="my-5">
                        <button type="submit" class="button2">save</button>
                    </div>
                </div>

                <div class="right">
                    <x-form-input type="text" name="phone" value="{{ $user->phone }}">Phone:</x-form-input>
                    <x-form-input type="email" name="email" value="{{ $user->email }}">Email:</x-form-input>
                </div>
            </form>
        </div>
    </div>
</x-layout>
