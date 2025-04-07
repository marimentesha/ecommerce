<x-admin-layout>
    <div>
        <div class="my-5 -mx-2">
            <a href="/admin/coupon" class="button">Add Coupon Code!</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>code</th>
                <th>type</th>
                <th>discount value</th>
                <th>expiration date</th>
                <th>actions</th>
            </tr>
            @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount_type }}</td>
                    <td>{{ $coupon->discount_value }} {{$coupon->discount_type === "percentage" ? ' %' : '$'}}</td>
                    <td>{{ $coupon->expiration_date }}</td>

                    <td>
                        <a href="/admin/coupon/{{$coupon->id}}" class="button left">Edit</a>
                        <x-delete-form uri="/admin/coupon/{{ $coupon->id }}"/>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-admin-layout>
