<x-admin-layout>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>comment</th>
                <th>rating</th>
                <th>product ID</th>
                <th>product</th>
                <th>actions</th>
            </tr>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->comment }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->product_id }}</td>
                    <td>{{ $review->product->name }}</td>

                    @if ($review->User_id == Auth::user()->id && Auth::user()->role->name == 'seller')
                        <td>
                            <a href="/admin/review/{{$review->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/review/{{ $review->id }}"/>
                        </td>
                    @elseif (Auth::user()->role->name == 'admin')
                        <td>
                            <a href="/admin/review/{{$review->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/review/{{ $review->id }}"/>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
    <div class="mx-[6%]">
        {{$reviews->links()}}
    </div>
</x-admin-layout>
