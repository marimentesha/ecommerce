<x-layout>
    <x-slot:heading>Home Page</x-slot:heading>

    <div>
        <div>
            <h1 class="left">GREEN CITY STYLE</h1>
            <button onclick="location.href='/catalog'" class="catalogButton w-[20%] h-[50px] m-[6%]">Go To Catalog</button>
        </div>
        <div>
            <p class="w-[35%]">Gone are the days of long lines and crowded stores.
                With just a few clicks, you can shop for everything you need.
                shopping online means you never have to leave home to
                find exactly what you're looking for.</p>
            <h1 class="right -mt-[9%]">ECO GOODS STORE</h1>
        </div>
        <div>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo" class="photo">
        </div>
    </div>

    <div>
        <x-box class="m-[2px_35%]">
            <x-slot:url>{{ asset('photos/rocket.png') }}</x-slot:url>
            Fast Delivery
        </x-box>

        <x-box class="m-[2px_43%]">
            <x-slot:url>{{ asset('photos/bag.png') }}</x-slot:url>
            Variety
        </x-box>

        <x-box class="m-[2px_30%]">
            <x-slot:url>{{ asset('photos/medal.png') }}</x-slot:url>
            Certified Products
        </x-box>

        <x-box class="m-[2px_37%]">
            <x-slot:url>{{ asset('photos/convenience.png') }}</x-slot:url>
            Convenience
        </x-box>
    </div>

    <div>
        <h2>Categories</h2>
        <div class="xScrollbar">
            @foreach($categories as $category)
                <div onclick="location.href='/catalog/' + {{ $category->id }};">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="photo" class="category">
                    <p class="m-0 p-[1px] rounded-[5px] bgGreen">{{$category->name}}</p>
                </div>
            @endforeach
        </div>
    </div>

    @foreach($categories as $category)
        @if($category->name == 'popular products' || $category->name == 'new items' || $category->name == 'sale')
            <div>
                <h2>{{$category->name}}</h2>
                <div class="xScrollbar">
                    @foreach($products as $product)
                        @if(optional($product->category)->name == $category->name)
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
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div class="couponBox bgGreen">
        <h1 class="left white">YOUR FIRST PURCHASE</h1>
        <div>
            <form action="/coupon" method="post">
                @csrf
                <input type="text" name="coupon" placeholder="enter a coupon code" class="bgGreen rounded-[5px] ml-[1%] whiteBorder w-1/4">
                <input type="submit" class="bgYellow white rounded-[5px] ml-[1%] h-7 w-[10%]" value="Apply!">
            </form>
        </div>
        <h1 class="white right -mt-[5%]">WITH 10% OFF</h1>
    </div>

    <div>
        <h2>About Us</h2>

        <div>
            <p class="w-1/2 m-[0_6]">We care about the planet, and so should you.
                That's why we offer a range of eco-friendly and sustainable products
                designed to reduce your carbon footprint.
                From reusable bags and organic skincare to energy-efficient gadgets,
                our store makes it easy for you to shop responsibly.</p>
            <p class="w-1/2 m-[0_6]">Gone are the days of long lines and crowded stores.
                With just a few clicks, you can shop for everything you need.
                shopping online means you never have to leave home to
                find exactly what you're looking for.</p>
            <p class="w-1/2 m-[0_6]">Sign up for our loyalty program and enjoy a world of benefits.
                Our members receive exclusive discounts, early access to sales, birthday rewards, and more.
                The more you shop, the more you save, and we want to thank you
                for choosing us for your shopping needs.</p>
            <a href="/about">read more</a>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo"
                 class="mainImg right">
        </div>

        <div>
            <x-box class="m-[2px_35%]">
                <x-slot:url>{{ asset('photos/rocket.png') }}</x-slot:url>
                Fast Delivery
            </x-box>

            <x-box class="m-[2px_43%]">
                <x-slot:url>{{ asset('photos/bag.png') }}</x-slot:url>
                Variety
            </x-box>

            <x-box class="m-[2px_30%]">
                <x-slot:url>{{ asset('photos/medal.png') }}</x-slot:url>
                Certified Products
            </x-box>

            <x-box class="m-[2px_37%]">
                <x-slot:url>{{ asset('photos/convenience.png') }}</x-slot:url>
                Convenience
            </x-box>
        </div>
    </div>
</x-layout>
