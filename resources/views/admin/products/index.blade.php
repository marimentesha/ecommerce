<x-admin-layout>
    <div>
        <div class="my-5 -mx-2">
            <a href="/admin/product" class="button">Create Product!</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>description</th>
                <th>price</th>
                <th>stock</th>
                <th>category</th>
                <th>image</th>
                <th>actions</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category ? $product->category->name : "" }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="product" class="w-20 h-20"></td>

                    @if ($product->user_id == Auth::user()->id && Auth::user()->role->name == 'seller')
                        <td>
                            <a href="/admin/product/{{$product->id}}" class="button left">Edit</a>
                            <a href="/admin/product/image/{{$product->id}}" class="button text-[13px]">Add/Delete Image</a>
                            <x-delete-form uri="/admin/product/{{ $product->id }}"/>
                        </td>
                    @elseif (Auth::user()->role->name == 'admin')
                        <td>
                            <a href="/admin/product/{{$product->id}}" class="button left">Edit</a>
                            <a href="/admin/product/image/{{$product->id}}" class="button text-[13px]">Add/Delete Image</a>
                            <x-delete-form uri="/admin/product/{{ $product->id }}"/>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
    <div class="mx-[6%]">
        {{$products->links()}}
    </div>
</x-admin-layout>
