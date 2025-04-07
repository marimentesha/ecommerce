<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Category</h2>
        <div class="flex justify-center items-center text-xl div-box">
            <x-update-form uri="/admin/category/{{ $category->id }}" enctype="multipart/form-data">
                <div class="mx-[22%] my-2">
                    <label for="image" class="cursor-pointer">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="category" class="smallProductPhoto"/>
                    </label>
                    <x-form-error name="image"/>
                    <input type="file" id="image" name="image" class="hidden">
                </div>

                <x-form-input name="name" type="text" value="{{ $category->name }}">Category Name:</x-form-input>
                <label for="parent_id">Select a parent category:</label>
                <select id="parent_id" name="parent_id">
                    @foreach($categories as $item)
                        <option value="{{ $item->id }}" {{ $item->id === $category->parent_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                    <option value="" {{ $category->parent_id !== null ? "" : "selected" }}>No Parent Category!</option>
                </select>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
