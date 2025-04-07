<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <div>
            <div>
                <h3 class="left">My Orders</h3>
                <div class="right m-7">
                    <x-nav-link href="/users/{{$user->id}}/orders" :active="request()->is('users/' . $user->id . '/orders')" class="button-link">All</x-nav-link>
                    <x-nav-link href="/users/{{$user->id}}/orders/pending" :active="request()->is('users/' . $user->id . '/orders/pending')" class="button-link">Pending</x-nav-link>
                    <x-nav-link href="/users/{{$user->id}}/orders/delivered" :active="request()->is('users/' . $user->id . '/orders/delivered')" class="button-link">Delivered</x-nav-link>
                    <x-nav-link href="/users/{{$user->id}}/orders/canceled" :active="request()->is('users/' . $user->id . '/orders/canceled')" class="button-link">Canceled</x-nav-link>
                </div>
            </div>
            <div class="w-[72%] text-xl yScrollbar h-[300px]">
                @foreach($orders as $order)
                    <div>
                        <div class="left ml-[5%]">
                            <b>order</b>
                            <p>#{{ $order->id }}</p>
                        </div>
                        <div class="left ml-[10%]">
                            <b>total price</b>
                            <p>$ {{ $order->total}}</p>
                        </div>
                        <div class="left ml-[10%]">
                            <b>status</b>
                            <p>{{ $order->orderStatus->name }}</p>
                        </div>
                        <div class="right mt-8">
                            <a href="/users/{{$user->id}}/order/{{$order->id}}" class="button"> Full Order ⇨ </a>
                        </div>
                    </div>
                    <hr class="line w-full m-2">
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
