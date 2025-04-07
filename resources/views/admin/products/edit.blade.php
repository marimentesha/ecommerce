<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Product</h2>
        <div class="flex justify-center text-xl div-box pb-[15%] pt-[2%]">
            <x-update-form uri="/admin/product/{{ $product->id }}" enctype="multipart/form-data">
                <div class="mx-[22%] my-2">
                    <label for="image" class="cursor-pointer">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="product" class="smallProductPhoto"/>
                    </label>
                    <x-form-error name="image"/>
                    <input type="file" id="image" name="image" class="hidden">
                </div>

                <x-form-input name="name" type="text" value="{{ $product->name }}">Product Name:</x-form-input>
                <div class="my-2">
                    <label for="description">Description:</label>
                    <textarea name="description" rows="5" type="text">{{ $product->description }}</textarea>
                    <x-form-error name="description"/>
                </div>
                <x-form-input type="text" name="price" value="{{ $product->price }}">Price:</x-form-input>
                <x-form-input type="number" name="stock" value="{{ $product->stock }}">stock:</x-form-input>

                <label for="category_id">Select a category:</label>
                <select id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ $category->id === optional($product->category)->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                    <option value="" {{ $product->category ? "" : "selected" }}>No Category!</option>
                </select>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
