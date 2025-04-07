<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit User Role</h2>
        <div class="flex justify-center items-center text-2xl div-box">
            <x-update-form uri="/admin/user/{{$user->id}}/role">
                <p>User: <b>{{ $user->email }}</b></p>

                <div class="mx-[27%]">
                    <label for="role">Select a Role:</label>
                    <select id="role" name="role" class="w-[90%]">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id === $userRole->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <div class="my-2 -mx-1.5">
                        <button type="submit" class="button2">update!</button>
                    </div>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
