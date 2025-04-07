<x-layout>
    <x-slot:heading>Cart</x-slot:heading>

    @if($cartItems->isEmpty())
        <div class="grid justify-center items-center div-box">
            <div class="mt-10">
                <h2>The cart is empty</h2>
                <p class="mx-[20%]">it's time to add some unique items</p>
            </div>
            <button onclick="location.href='/catalog'" class="catalogButton h-10 w-full -mt-[55%]">Go To Catalog
            </button>
        </div>
    @else
        <div>
            <h2>Cart</h2>

            @foreach($cartItems as $cartItem)
                <div class="flex justify-items-start gap-5">
                    <a href="/product/{{ $cartItem->product->id }}">
                        <img src="{{ asset('storage/' . $cartItem->product->image)}}" alt="photo" class="w-[20%] smallProductPhoto">
                    </a>
                    <div class="w-full">
                        <div class="-mt-5">
                            <p class="green text-xl">{{ $cartItem->product->name }}</p>
                            <div class="right -mt-12">
                                <x-dropdown-menu name="☰">
                                    <form action="/wishlist/{{ $cartItem->product->id }}" method="post">
                                        @csrf
                                        <button class="bgWhite border-0 m-1">add to wishlist</button>
                                    </form>
                                    <form action="/cart/{{ $cartItem->product->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="bgWhite border-0 m-1">Remove</button>
                                    </form>
                                </x-dropdown-menu>
                            </div>
                        </div>
                        <form action="/cart/{{ $cartItem->id }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="number" name="quantity" min="1" value="{{ $cartItem->quantity }}"
                                   class="w-[3%] left mt-20" onclick="this.form.submit()">
                            <p class="right mt-20 -mb-5 ">{{ $cartItem->product->price * $cartItem->quantity }} $</p>
                        </form>
                    </div>
                </div>
                <hr class="line my-5">
            @endforeach
            <div class="right">
                <div class="my-5 ml-2 text-xl">
                    total: <b>{{ round($total - $discount, 2) }}$</b>
                    @if(session('discount'))
                        <b class="line-through text-red-900 text-[17px]">{{ $total }}$</b>
                    @endif

                </div>

                <button onclick='location.href="/checkout"' class="button2">checkout</button>
            </div>
        </div>

        <div class="mb-3">
            <h2>you may also like</h2>

            <div class="xScrollbar">
                @foreach($products as $product)
                    <div class="relative">
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="photo"
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
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layout>
