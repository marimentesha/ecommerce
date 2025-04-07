<x-admin-layout>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>status</th>
                <th>total</th>
                <th>payment status</th>
                <th>actions</th>
            </tr>
            @foreach ($orders as $order)

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->orderStatus->name }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->paymentStatus->name }}</td>

                    @if ($order->User_id == Auth::user()->id && Auth::user()->role->name == 'seller')
                        <td>
                            <a href="/admin/order/{{$order->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/order/{{ $order->id }}"/>
                        </td>
                    @elseif (Auth::user()->role->name == 'admin')
                        <td>
                            <a href="/admin/order/{{$order->id}}" class="button left">Edit</a>
                            <x-delete-form uri="/admin/order/{{ $order->id }}"/>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
    <div class="mx-[6%]">
        {{$orders->links()}}
    </div>
</x-admin-layout>
