<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Create Product</h2>
        <div class="flex justify-center text-xl div-box pb-[10%] pt-[1%]">
            <form href="/admin/product" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="image">Add Photo:</label>
                    <input type="file" name="image">
                    <x-form-error name="image"/>
                </div>

                <x-form-input name="name" type="text">Product Name:</x-form-input>
                <div class="my-2">
                    <label for="description">Description:</label>
                    <textarea name="description" rows="5" type="text"></textarea>
                    <x-form-error name="description"/>
                </div>
                <x-form-input type="text" name="price">Price:</x-form-input>
                <x-form-input type="number" name="stock">stock:</x-form-input>

                <label for="category_id">Select a category:</label>
                <select id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="" selected>No Product!</option>
                </select>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
