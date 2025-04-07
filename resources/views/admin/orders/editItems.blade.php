<x-admin-layout>
    <div class="my-5">
        @foreach($orderItems as $orderItem)
            <div class="flex justify-items-start gap-5">
                <img src="{{ asset( 'storage/' . $orderItem->product->image)}}" alt="photo" class="w-[20%] smallProductPhoto">
                <div class="w-full">
                    <div class="-mt-5">
                        <p class="green text-xl">{{ $orderItem->product->name }}</p>
                        <div class="right -mt-12">
                            <form action="/admin/order/item/{{ $orderItem->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="rounded-full w-7 h-7 bg-[#f0e4d5]">X</button>
                            </form>
                        </div>
                    </div>
                    <x-update-form uri="/admin/order/item/{{ $orderItem->id }}">
                        <input type="number" name="quantity" min="1" value="{{ $orderItem->quantity }}" class="w-[3%] left mt-20" onclick="this.form.submit()">
                        <p class="right mt-20 -mb-5 ">{{ $orderItem->product->price * $orderItem->quantity}}</p>
                    </x-update-form>
                </div>
            </div>
            <hr class="line my-5">
        @endforeach
        <div class="right">
            <p class="ml-10">total: {{ $total }}</p>
            <button onclick='location.href="/admin/order/{{$order->id}}"' class="button2">update!</button>
        </div>
    </div>
</x-admin-layout>
