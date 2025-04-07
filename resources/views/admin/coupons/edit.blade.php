<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Coupon</h2>

        <div class="flex justify-center items-center text-2xl div-box">
            <x-update-form uri="/admin/coupon/{{ $coupon->id }}">
                <x-form-input name="code" type="text" value="{{ $coupon->code }}">Coupon Code:</x-form-input>
                <div>
                    <label for="discount_type">Discount Type:</label>
                    <select name="discount_type" class="bg-[#f0e4d5]">
                        <option {{$coupon->discount_type === "percentage" ? 'selected' : ''}}>percentage</option>
                        <option {{$coupon->discount_type === "fixed" ? 'selected' : ''}}>fixed</option>
                    </select>
                    <x-form-error name="discount_type"/>
                </div>
                <x-form-input name="discount_value" type="number" value="{{ $coupon->discount_value }}" class="w-[25%]">Discount Value:</x-form-input>
                <x-form-input name="expiration_date" type="date" value="{{ $coupon->expiration_date }}" class="w-[31%]">Expiration Date:</x-form-input>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update!</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
