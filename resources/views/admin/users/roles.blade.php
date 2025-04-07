<x-admin-layout>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>role ID</th>
                <th>role</th>
                <th>actions</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_id }}</td>
                    <td>{{ $user->role->name }}</td>

                    <td>
                        <a href="/admin/user/{{$user->id}}/role/{{$user->role_id}}" class="button left">Edit Role</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
        <div class="mx-[6%]">
            {{$users->links()}}
        </div>
</x-admin-layout>
