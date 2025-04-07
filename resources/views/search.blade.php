<x-layout>
    <x-slot:heading>search</x-slot:heading>

    <div class="container">
        @if($products->isEmpty())
            <div class=" div-box">
                <div class="ml-7 mt-[22%]">
                    <h2>Sorry, We Can't Find This Product</h2>
                </div>
                <div class="w-[70%] ml-[15%]">
                <button onclick="location.href='/catalog'" class="catalogButton h-10 w-full">Go To Catalog</button>
                </div>
            </div>
        @else
            @foreach($products as $product)
                <div>
                    <div>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="photo" onclick="location.href='/product/' + {{$product->id}}" class="category">
                        <p class="m-0">{{$product->name}}</p>
                        <p class="m-0">{{$product->price}}</p>
                    </div>
                    @auth
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
                    @endauth
                </div>
            @endforeach
        @endif
    </div>
</x-layout>
