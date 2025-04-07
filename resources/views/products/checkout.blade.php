<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>

    <div class="flex justify-center items-center m-10 gap-10 text-xl">
        <x-checkout-steps color="yellow" step="1" name="contacts"/>
        <x-checkout-steps color="green" step="2" name="Delivery|Payment"/>
        <x-checkout-steps color="brown" step="3" name="Confirmation"/>
    </div>

    <form action="/checkout" method="post">
        @csrf
        <div class="left">
            <x-checkout-form-steps step="1" name="Contact Information">
                <x-form-input name="first" type="text" oninput="updatePreview()">First Name:</x-form-input>
                <x-form-input name="last" type="text" oninput="updatePreview()">Last Name:</x-form-input>
                <x-form-input name="phone" type="tel" oninput="updatePreview()">Phone number:</x-form-input>

                <div>
                    <h3>payment type:</h3>
                    <div class="dropCategories">
                        <input type="radio" name="payment" id="cash" value="cash" oninput="updatePreview()">
                        <label>cash with courier</label>
                    </div>

                    <div class="dropCategories">
                        <input type="radio" name="payment" id="card" value="card" oninput="updatePreview()">
                        <label>card</label>
                    </div>
                    <x-form-error name="payment"/>
                </div>

                <x-slot:button>
                    <button type="button" onclick="showStep(2)" class="button2">Continue</button>
                </x-slot:button>
            </x-checkout-form-steps>

            <x-checkout-form-steps step="2" name="Delivery & Payment" style="display: none">

                <x-form-input name="card_number" type="text" minLength="13" maxlength="19"
                              placeholder="1234 5678 9012 3456" oninput="updatePreview()" disabled>Card Number:
                </x-form-input>

                <div class="grid grid-cols-2" style="grid-template-columns: auto auto;">
                    <x-form-input name="expiry_year" type="number" min="{{ now()->year }}" placeholder="YYYY"
                                  class="w-[20%]" disabled>Expiry Year:
                    </x-form-input>
                    <x-form-input name="expiry_month" type="number" min="1" max="12" placeholder="MM" class="w-[20%]"
                                  disabled>Expiry Month:
                    </x-form-input>
                    <x-form-input name="card_type" type="text" placeholder="mastercard, visa..." class="w-[45%]"
                                  disabled>Card Type:
                    </x-form-input>
                    <x-form-input name="cvv" type="text" maxlenght="4" placeholder="123" class="w-[15%]" disabled>CVV:
                    </x-form-input>
                </div>

                <x-form-input name="country" type="text" oninput="updatePreview()">Country:</x-form-input>
                <x-form-input name="city" type="text" oninput="updatePreview()">City:</x-form-input>
                <x-form-input name="address" type="text" oninput="updatePreview()">Address:</x-form-input>
                <x-form-input name="address2" type="text" oninput="updatePreview()">Address 2:</x-form-input>
                <x-form-input name="zip_code" type="text" oninput="updatePreview()">zip code:</x-form-input>

                <x-slot:button>
                    <button type="button" onclick="showStep(1)" class="button2">Back</button>
                    <button type="button" onclick="showStep(3)" class="button2">Continue</button>
                </x-slot:button>
            </x-checkout-form-steps>

            <x-checkout-form-steps step="3" name="Order Confirmation" style="display: none">
                <x-checkout-info name="name"/>
                <x-checkout-info name="phone"/>
                <x-checkout-info name="address"/>
                <x-checkout-info name="address2"/>
                <x-checkout-info name="country"/>
                <x-checkout-info name="city"/>
                <x-checkout-info name="payment"/>
                <x-checkout-info name="zip"/>
                <x-checkout-info name="card"/>

                <x-slot:button>
                    <button type="button" class="button2" onclick="showStep(2)">Back</button>
                    <button type="submit" class="button2">Order!</button>
                </x-slot:button>
            </x-checkout-form-steps>
        </div>

        <div class="div-box yScrollbar">
            <div>
                <h2 class="ml-5 left">cart</h2>
                <a href="/cart" class="right my-[7.5%] mx-5 text-black">edit the order</a>
            </div>

            <div>
                @foreach($cartItems as $cartItem)
                    <div class="flex justify-items-start ml-5">
                        <img src="{{ asset('storage/' . $cartItem->product->image)}}" alt="photo"
                             class="smallProductPhoto">
                        <div class="w-full mx-5">
                            <div class="-mt-5">
                                <p class="green text-xl">{{ $cartItem->product->name }}</p>
                            </div>
                            <div class="mt-20">
                                <p class="left">amount: {{ $cartItem->quantity }} </p>
                                <p class="right -mb-5"> {{ $cartItem->product->price * $cartItem->quantity}} </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="line mx-5 my-2">
                        <input name="cart[{{ $cartItem->id }}][cartId]" type="hidden" value="{{ $cartItem->id }}">
                        <input name="cart[{{ $cartItem->id }}][product]" type="hidden"
                               value="{{ $cartItem->product_id }}">
                        <input name="cart[{{ $cartItem->id }}][quantity]" type="hidden"
                               value="{{ $cartItem->quantity }}">
                        <input name="cart[{{ $cartItem->id }}][price]" type="hidden"
                               value="{{ $cartItem->product->price }}">
                    </div>
                @endforeach
            </div>

            <div>
                <h3 class="right mr-5">Total: {{ round($total - $discount, 2) }}$
                    @if(session('discount'))
                        <span class="line-through text-red-800 text-[20px]">{{ $total }}$</span>
                    @endif
                </h3>
                <input name="total" type="hidden" value="{{ round($total - $discount, 2) }}">
            </div>
        </div>
    </form>

    <script>
        function showStep(step) {
            document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
            document.getElementById('step' + step).style.display = 'block';
        }

        function updatePreview() {
            const firstName = document.querySelector('[name="first"]');
            const lastName = document.querySelector('[name="last"]');
            const phone = document.querySelector('[name="phone"]');
            const address = document.querySelector('[name="address"]');
            const address2 = document.querySelector('[name="address2"]');
            const country = document.querySelector('[name="country"]');
            const city = document.querySelector('[name="city"]');
            const zip = document.querySelector('[name="zip_code"]');
            const paymentMethod = document.querySelector('input[name="payment"]:checked');
            const card = document.querySelector('[name="card_number"]');
            const card_type = document.querySelector('[name="card_type"]');
            const expiryM = document.querySelector('[name="expiry_month"]');
            const expiryY = document.querySelector('[name="expiry_year"]');
            const cvv = document.querySelector('[name="cvv"]');

            (firstName && lastName) && (document.getElementById('review-name').textContent = firstName.value + ' ' + lastName.value);
            phone && (document.getElementById('review-phone').textContent = phone.value);
            address && (document.getElementById('review-address').textContent = address.value);
            address2 && (document.getElementById('review-address2').textContent = address2.value);
            city && (document.getElementById('review-city').textContent = city.value);
            country && (document.getElementById('review-country').textContent = country.value);
            zip && (document.getElementById('review-zip').textContent = zip.value);
            paymentMethod && (document.getElementById('review-payment').textContent = paymentMethod.value);

            if (paymentMethod.value === 'card') {
                if (card && expiryM && expiryY && cvv && card_type) {
                    card.disabled = false;
                    card_type.disabled = false;
                    expiryM.disabled = false;
                    expiryY.disabled = false;
                    cvv.disabled = false;
                    document.getElementById('review-card').textContent = card_type.value + " | " + card.value + " | " + expiryM.value + '/' + expiryY.value + " | " + cvv.value;
                }
            } else {
                card.disabled = true;
                card_type.disabled = true;
                expiryM.disabled = true;
                expiryY.disabled = true;
                cvv.disabled = true;
                document.getElementById('review-card').textContent = 'NaN';
            }
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
    </script>
</x-layout>
