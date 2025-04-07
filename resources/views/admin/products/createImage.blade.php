<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Add/Delete Product Images</h2>

        <div class="text-2xl div-box p-2">
            <h3 class="flex justify-center">photos</h3>
            <div class="xScrollbar">
                @foreach($images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" alt="image" class="smallProductPhoto">
                    <form action="/admin/product/image/{{ $image->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="bg-[#f0e4d5] rounded-full -ml-[170%]">X</button>
                    </form>
                @endforeach
            </div>

            <div class="flex justify-center mt-10">
                <form action="/admin/product/image/{{ $product->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="images[]">Add More Photos:</label>
                    <input type="file" name="images[]" multiple>
                    <x-form-error name="images[]"/>
                    <div class="my-2 -mx-1.5">
                        <button type="submit" class="button2">update!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
