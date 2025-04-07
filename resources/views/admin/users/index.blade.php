<x-admin-layout>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>profile picture</th>
                <th>name</th>
                <th>surname</th>
                <th>email</th>
                <th>phone</th>
                <th>actions</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><x-profile-picture photo="{{ asset('storage/' . $user->profile_photo) }}"/></td>
                    <td>{{ $user->first }}</td>
                    <td>{{ $user->last }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>

                    @if ($user->id == Auth::user()->id && Auth::user()->role->name == 'seller')
                        <td>
                            <a href="/admin/user/{{$user->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/user/{{ $user->id }}"/>
                        </td>
                    @elseif (Auth::user()->role->name == 'admin')
                        <td>
                            <a href="/admin/user/{{$user->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/user/{{ $user->id }}"/>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
    <div class="mx-[6%]">
        {{$users->links()}}
    </div>
</x-admin-layout>
