<x-layout>
    <x-slot:heading>Product</x-slot:heading>

    <div>
        <div class="flex flex-nowrap">
            <div class="yScrollbar w-[30%] h-[370px] items-end">
                @foreach($product->productImage as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" alt="product" class="smallProductPhoto">
                @endforeach
            </div>

            <div>
                <img src="{{ asset( 'storage/' . $product->image) }}" alt="product" class="productPhoto">
            </div>

            <div class="left m-[3%]">
                <h2>{{ $product->name }}</h2>
                <p class="w-3/5">{{ $product->description }}</p>

                <form action="/cart/{{ $product->id }}" method="post">
                    @csrf
                    <div class="w-[55%]">
                        <div>
                            <input type="number" name="quantity" min="1" value="1" class="w-[10%] mt-3.5 left">
                            <p class="right"><b>{{ $product->price }} $</b></p>
                        </div>
                    </div>

                    <button class="cartButton2 left"> add to cart</button>
                </form>

                <form action="/wishlist/{{ $product->id }}" method="post">
                    @csrf
                    <button class="wishlist2 left">♡</button>
                </form>
            </div>
        </div>

        <div>
            <h2>Reviews about the product</h2>

            <div class="xScrollbar">

                @foreach($product->review as $review)
                    <div class="review-box">
                        @if(!request()->is("product/" . $product->id . "/review/" . $review->id . "/edit"))
                            <div>
                                <p class="left">{{ $review->user->first . " " . $review->user->last }}</p>
                                <p class="right">{{ $review->created_at }}</p>
                            </div>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                @endfor
                            </div>

                            <div class="review">
                                {{ $review->comment }}
                            </div>
                            @if($review->user == \Illuminate\Support\Facades\Auth::user())
                                <div class="my-2 h-full flex items-end justify-end">
                                    <button class="button2">
                                        <a href="/product/{{ $product->id }}/review/{{ $review->id }}/edit"
                                           class="no-underline text-black">Edit</a>
                                    </button>
                                    <form action="/product/{{$product->id}}/review/{{ $review->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="button2">Delete</button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        @if(request()->is("product/" . $product->id . "/review/" . $review->id . "/edit"))
                            <div>
                                <form action="/product/{{$product->id}}/review/{{$review->id}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div>
                                        <p class="left">{{ $review->user->first . " " . $review->user->last }}</p>
                                        <p class="right">{{ $review->created_at }}</p>
                                    </div>
                                    <div class="star-rating left mt-10 mb-3 -ml-[18%]">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                                   @if($review->rating == $i) checked @endif>
                                            <label for="star{{ $i }}">★</label>
                                        @endfor
                                    </div>
                                    <div class="review mr-2">
                                        <textarea name="comment" rows="10">{{$review->comment}}</textarea>
                                    </div>
                                    <div class="flex justify-end items-end h-full">
                                        <button class="button2 ">Edit</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @auth
                <div class="my-[2%] mx-0">
                    @if(request()->is('product/' . $product->id))
                        <div>
                            <a href="/product/{{$product->id}}/review" class="button right">Leave a review</a>
                        </div>
                    @elseif(request()->is('product/' . $product->id . '/review'))
                        <div>
                            <form action="/product/{{$product->id}}/review" method="post">
                                @csrf
                                <label class="green">Rate the product:</label>
                                <textarea name="comment" rows="4" placeholder="Write your review here..."
                                          class="mt-[5px]"></textarea>
                                <x-form-error name="comment"/>
                                <x-form-error name="rating"/>
                                <div class="star-rating left">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                        <label for="star{{ $i }}">★</label>
                                    @endfor
                                </div>
                                <button class="button noMargin right">Submit Review</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endauth
        </div>

        <div class="mb-[10px]">
            <h2>you may also like</h2>

            <div class="xScrollbar">
                @foreach($products as $similarProduct)
                    @if($similarProduct->category->name == $product->category->name && $similarProduct->id != $product->id)
                        <div class="relative">
                            <div>
                                <img src="{{ asset( 'storage/' . $similarProduct->image) }}" alt="photo"
                                     onclick="location.href='/product/' + {{ $similarProduct->id }};" class="category">
                                <p class="m-0 p-[1px] rounded-[5px]">{{$similarProduct->name}}</p>
                                <p class="m-0 p-[1px] rounded-[5px]">{{$similarProduct->price}} $</p>
                            </div>

                            <form action="/cart/{{ $similarProduct->id }}" method="POST">
                                @csrf
                                <button type="submit" class="cartButton">
                                    add to cart
                                </button>
                            </form>

                            <form action="/wishlist/{{ $similarProduct->id }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist right -mt-[45%] ml-[85%]">
                                    ♡
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
