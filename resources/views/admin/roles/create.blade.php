<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Create Role</h2>

        <div class="flex justify-center items-center text-2xl div-box">
            <form action="/admin/role" method="post">
                @csrf
                <x-form-input name="name" type="text">Role Name:</x-form-input>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">create role!</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
