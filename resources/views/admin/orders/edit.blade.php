<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Order</h2>

        <div class="flex justify-center items-center div-box2 p-5">
            <div class="left m-5 text-2xl">
                <x-update-form uri="/admin/order/{{ $order->id }}">
                    <x-form-input name="name" type="text" value="{{ $order->name }}">Name:</x-form-input>
                    <x-form-input name="total" type="hidden" value="{{ $total }}"/>

                    <label for="status_id">Order Status:</label>
                    <select name="status_id">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $order->status_id === $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                        @endforeach
                    </select>
                    <x-form-error name="status_id"/>

                    <label for="payment_status_id">Payment Status:</label>
                    <select name="payment_status_id">
                        @foreach($paymentStatuses as $status)
                            <option value="{{ $status->id }}" {{ $order->payment_status_id === $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                        @endforeach
                    </select>
                    <x-form-error name="payment_status_id"/>

                    <div class="my-2 -mx-1.5">
                        <button type="submit" class="button2">update!</button>
                    </div>
                </x-update-form>
            </div>

            <div class="div-box2 yScrollbar">
                <div>
                    <h2 class="ml-5 left">cart</h2>
                    <a href="/admin/order/items/{{ $order->id }}" class="right my-[7.5%] mx-5 text-black">edit the order</a>
                </div>
                <div>
                    @foreach($orderItems as $orderItem)
                        <div class="flex justify-items-start ml-5">
                            <img src="{{ asset('storage/' . $orderItem->product->image)}}" alt="photo" class="smallProductPhoto">
                            <div class="w-full mx-5">
                                <div class="-mt-5">
                                    <p class="green text-xl">{{ $orderItem->product->name }}</p>
                                </div>
                                <div class="mt-20">
                                    <p class="left">amount: {{ $orderItem->quantity }} </p>
                                    <p class="right -mb-5"> {{ $orderItem->product->price * $orderItem->quantity}} </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr class="line mx-5 my-2">
                        </div>
                    @endforeach
                </div>
                <div>
                    <h3 class="right mr-5">Total: {{ $total }}</h3>
                    <input name="total" type="hidden" value="{{ $total }}">
                </div>
            </div>
        </div>


    </div>
</x-admin-layout>
