<x-layout>
    <x-slot:heading>Catalog</x-slot:heading>

    <form action="/catalog" method="get">
        @csrf
        <div class="left mt-[20px]">
            <x-dropdown-menu>
                <x-slot:name>filter ▾</x-slot:name>
                <div class="left m-1">
                    @foreach($categories as $category)
                        <div class="dropCategories">
                            <input type="checkbox" name="categories[{{$category->id}}]" value="{{ $category->id }}"
                                   onchange="this.form.submit()"
                                {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                            <label>{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </x-dropdown-menu>
        </div>

        <div class="right mt-[20px]">
            <select name="sort" onchange="this.form.submit()" class="bg-[#f0e4d5] border-0">
                <option style="display: none">Sort by</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Increasing price</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Decreasing price</option>
            </select>
        </div>
    </form>

    <div class="container">
        @foreach($products as $product)
            <div>
                <div>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="photo"
                         onclick="location.href='/product/' + {{$product->id}}" class="category">
                    <p class="m-0">{{$product->name}}</p>
                    <p class="m-0">{{$product->price}}</p>
                </div>
                <form action="/cart/{{ $product->id }}" method="post">
                    @csrf
                    <button class="cartButton">add to cart</button>
                </form>
                @if((\App\Models\WishlistItem::get()->where('product_id', $product->id)->where('user_id', Auth::id()))->isEmpty())
                    <form action="/wishlist/{{ $product->id }}" method="post">
                        @csrf
                        <button class="wishlist right -mt-[7%] ml-[210px]">♡</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mx-[6%]">
        {{ $products->links() }}
    </div>
</x-layout>
