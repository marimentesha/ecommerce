@props(['id', 'first', 'last'])
<div class="left w-1/4 h-full right-border">
    <div>
        <form action="/users/{{ $id }}/photo" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <label for="photo" class="cursor-pointer">
                <x-profile-picture :photo="asset('storage/' . auth()->user()->profile_photo)" class="w-[30%] mx-[32%] my-2 rounded-full"/>

            </label>
            <x-form-error name="photo"/>
            <input type="file" id="photo" name="photo" class="hidden" onchange="this.form.submit();">
        </form>

        <p class="mx-[35%]">{{ $first . ' ' . $last }}</p>
    </div>
    <div>
        <div>
            <form action="/logout" method="post" >
                @csrf
                <button type="submit" class="button2">Logout</button>
            </form>
        </div>
        <div class="right -mt-[22px]">
            <form action="/users/{{ auth()->id() }}" method="post">
                @csrf
                @method('delete')
                <button class="button">Delete Account</button>
            </form>
        </div>
    </div>
    <hr class="line">
    <div class="h-[50%] m-5">
        <x-profile-link uri="/users/{{ $id }}" active="{{ request()->is('users/' . $id) }}" name="Profile Info"/>
        <x-profile-link uri="/users/{{ $id }}/orders" active="{{ request()->is('users/' . $id . '/orders') }}" name="Orders"/>
        <x-profile-link uri="/users/{{ $id }}/addresses" active="{{ request()->is('users/' . $id . '/addresses') }}" name="Addresses"/>
        <x-profile-link uri="/users/{{ $id }}/cards" active="{{ request()->is('users/' . $id . '/cards') }}" name="Credit Cards"/>
        <x-profile-link uri="/users/{{ $id }}/password" active="{{ request()->is('users/' . $id . '/password') }}" name="Change Password"/>
    </div>
</div>
