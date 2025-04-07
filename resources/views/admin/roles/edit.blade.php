<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Role</h2>

        <div class="flex justify-center items-center text-2xl div-box">
            <x-update-form uri="/admin/role/{{ $role->id }}">
                <x-form-input name="name" type="text" value="{{ $role->name }}">Role Name:</x-form-input>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update!</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
