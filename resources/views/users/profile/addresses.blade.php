<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <h3 class="flex justify-center">User Info</h3>
        <div class="flex justify-center items-center w-[72%] text-2xl">
            <form action="/users/{{ $user->id }}/addresses" method="post">
                @csrf
                @method('patch')
                <div class="left mr-5">
                    <x-form-input type="text" name="address1" value="{{ $userDetail->address1 }}">Address:</x-form-input>
                    <x-form-input type="text" name="address2" value="{{ $userDetail->address2 }}">Address 2:</x-form-input>
                    <x-form-input type="text" name="zip_code" value="{{ $userDetail->zip_code }}">Zip Code:</x-form-input>

                    <div class="my-5">
                        <button type="submit" class="button2">save</button>
                    </div>
                </div>

                <div class="right">
                    <x-form-input type="text" name="country" value="{{ $userDetail->country }}">Country:</x-form-input>
                    <x-form-input type="text" name="city" value="{{ $userDetail->city }}">City:</x-form-input>
                    <x-form-input type="tel" name="phone" value="{{ $userDetail->phone }}">Phone:</x-form-input>
                </div>
            </form>
        </div>
    </div>
</x-layout>
