<x-layout>
    <x-slot:heading>Wishlist</x-slot:heading>
    @if($wishlistItems->isEmpty())
        <div class="grid justify-center items-center div-box">
            <div class="mt-10 -mb-10">
                <h2 class="mx-[32%]">Wishlist</h2>
                <p class="mx-[24%]">the products you liked will be here. just click on the heart on the product card</p>
            </div>
            <button onclick="location.href='/catalog'" class="catalogButton h-10 w-[200px] -mt-20 mx-[29%]">Go To Catalog</button>
        </div>
    @else
        <div>
            <h2>Wishlist</h2>

            <div class="xScrollbar">
                @foreach($wishlistItems as $wishlistItem)
                    <div class="relative">
                        <div>
                            <img src="{{ asset('storage/' . $wishlistItem->product->image) }}" alt="photo" class="category"
                                 onclick="location.href='/product/' + {{ $wishlistItem->product->id }};">
                            <p class="m-0 p-[1px] rounded-[5px]">{{$wishlistItem->product->name}}</p>
                            <p class="m-0 p-[1px] rounded-[5px]">{{$wishlistItem->product->price}} $</p>
                        </div>

                        <form action="/cart/{{ $wishlistItem->product->id }}" method="POST">
                            @csrf
                            <button type="submit" class="cartButton">
                                add to cart
                            </button>
                        </form>

                        <form action="/wishlist/{{ $wishlistItem->product->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="wishlist -mt-[130%] ml-[85%]">X</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <h2>you may also like</h2>

            <div class="xScrollbar">
                @foreach($products as $product)
                    <div class="relative">
                        @if((\App\Models\WishlistItem::get()->where('product_id', $product->id)->where('user_id', Auth::id()))->isEmpty())
                        <div>
                            <img src="{{ asset('storage/' .  $product->image) }}" alt="photo"
                                 onclick="location.href='/product/' + {{ $product->id }};" class="category">
                            <p class="m-0 p-[1px] rounded-[5px]">{{$product->name}}</p>
                            <p class="m-0 p-[1px] rounded-[5px]">{{$product->price}} $</p>
                        </div>

                        <form action="/cart/{{ $product->id }}" method="POST">
                            @csrf
                            <button type="submit" class="cartButton">add to cart</button>
                        </form>

                        <form action="/wishlist/{{ $product->id }}" method="POST">
                            @csrf
                            <button type="submit" class="wishlist right -mt-[45%] ml-[85%]">♡</button>
                        </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layout>
