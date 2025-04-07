<x-admin-layout>
    <div>
        <div class="my-5 -mx-2">
            <a href="/admin/category" class="button">Add Category!</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>parent ID</th>
                <th>parent category</th>
                <th>actions</th>
            </tr>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->parentCategory ? $category->parentCategory->name : '' }}</td>

                    <td>
                        <a href="/admin/category/{{$category->id}}" class="button left">Edit</a>
                        <x-delete-form uri="/admin/category/{{ $category->id }}"/>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="mx-[6%]">
        {{$categories->links()}}
    </div>
</x-admin-layout>
