<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit User</h2>
        <div class="flex justify-center items-center text-xl div-box pb-[10%]">
            <x-update-form uri="/admin/user/{{ $user->id }}" enctype="multipart/form-data">
                <label for="profile_photo" class="cursor-pointer">
                    <x-profile-picture :photo="asset('storage/' . auth()->user()->profile_photo)" class="w-[30%] mx-[32%] my-2 rounded-full"/>
                </label>
                <x-form-error name="profile_photo"/>
                <input type="file" id="profile_photo" name="profile_photo" class="hidden">

                <x-form-input name="first" type="text" value="{{ $user->first }}">First name:</x-form-input>
                <x-form-input name="last" type="text" value="{{ $user->last }}">Last name:</x-form-input>
                <x-form-input type="text" name="phone" value="{{ $user->phone }}">Phone:</x-form-input>
                <x-form-input type="email" name="email" value="{{ $user->email }}">Email:</x-form-input>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
