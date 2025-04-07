<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <a href="/users/{{$user->id}}/orders"><h3 class="left"> ◄Order #{{$order->id}}</h3></a>
        <div class="w-[72%] text-xl yScrollbar h-[350px]">
            <div class="ml-5">
                <p><b>Order Status:</b> {{ $order->orderStatus->name}}</p>
                <p><b>Address:</b> {{$user->userDetail->city}}, {{$user->userDetail->address1}}
                    , {{$user->userDetail->address2}} </p>
            </div>
            @foreach($order->orderItem as $item)
                <div class="flex justify-items-start ml-5">
                    <a href="/product/{{ $item->product->id }}">
                        <img src="{{ asset('storage/' . $item->product->image)}}" alt="photo" class="smallProductPhoto">
                    </a>
                    <div class="w-full mx-5">
                        <div class="-mt-5">
                            <p class="green text-xl">{{ $item->product->name }}</p>
                        </div>
                        <div class="mt-20">
                            <p class="left">amount: {{ $item->quantity }} </p>
                            <p class="right -mb-5"> {{ $item->product->price * $item->quantity}} </p>
                        </div>
                    </div>
                </div>
                <hr class="line w-full m-2">
            @endforeach
            <div class="ml-5">
                <p><b>Total:</b> {{ $total }}</p>
            </div>
        </div>
    </div>
</x-layout>
