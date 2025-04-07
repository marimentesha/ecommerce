<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Create Coupon Code</h2>

        <div class="flex justify-center items-center text-2xl div-box">
            <form action="/admin/coupon" method="post">
                @csrf
                <x-form-input name="code" type="text">Coupon Code:</x-form-input>
                <div>
                    <label for="discount_type">Discount Type:</label>
                    <select name="discount_type" class="bg-[#f0e4d5]">
                        <option>percentage</option>
                        <option>fixed</option>
                    </select>
                    <x-form-error name="discount_type"/>
                </div>
                <x-form-input name="discount_value" type="number" class="w-[25%]">Discount Value:</x-form-input>
                <x-form-input name="expiration_date" type="date" class="w-[31%]">Expiration Date:</x-form-input>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2" value="{{ now()->year }}">Create!</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
