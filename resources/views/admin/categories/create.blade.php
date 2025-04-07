<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Create Category!</h2>

        <div class="flex justify-center items-center text-2xl div-box">
            <form action="/admin/category" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="image">Add Photo:</label>
                    <input type="file" name="image">
                    <x-form-error name="image"/>
                </div>

                <x-form-input name="name" type="text">Category Name:</x-form-input>

                <label for="parent_id">Select a parent category:</label>
                <select id="parent_id" name="parent_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="" selected>No Parent Category!</option>
                </select>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">create Category!</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
