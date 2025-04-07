<x-admin-layout>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>actions</th>
            </tr>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>

                    <td>
                        <a href="/admin/role/{{$role->id}}" class="button left">Edit</a>
                        <x-delete-form uri="/admin/role/{{ $role->id }}"/>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="mt-5 -mx-2">
            <a href="/admin/role" class="button">Add Role!</a>
        </div>
    </div>
</x-admin-layout>
