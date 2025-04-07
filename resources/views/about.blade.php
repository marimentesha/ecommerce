<x-layout>
    <x-slot:heading>About Us</x-slot:heading>

    <div class="mb-[27%]">
        <h1 class="m-0 left">WE ARE <b class="yellow">CONSCIOUSLY</b></h1>
        <h1 class="m-0 right">STRIVING FOR HELPING</h1>
        <h1 class="m-0 left">
            AND <b class="yellow">TAKING CARE</b>
            <img src="{{ asset('photos/logo.png') }}" alt="logo" class="w-[10%] -my-[2%]">
        </h1>
        <h1 class="m-0 right">OF OUR <b class="yellow">NATURE</b></h1>
    </div>

    <div>
        <div>
            <h2>About Us</h2>
            <p class="w-1/2 m-[0_6]">Sign up for our loyalty program and enjoy a world of benefits.
                Our members receive exclusive discounts, early access to sales, birthday rewards, and more.
                The more you shop, the more you save, and we want to thank you
                for choosing us for your shopping needs.</p>
            <p class="w-1/2 m-[0_6]">We care about the planet, and so should you.
                That's why we offer a range of eco-friendly and sustainable products
                designed to reduce your carbon footprint.
                From reusable bags and organic skincare to energy-efficient gadgets,
                our store makes it easy for you to shop responsibly.</p>
            <p class="w-1/2 m-[0_6]">Gone are the days of long lines and crowded stores.
                With just a few clicks, you can shop for everything you need.
                shopping online means you never have to leave home to
                find exactly what you're looking for.</p>
            <p class="w-1/2 m-[0_6]">Sign up for our loyalty program and enjoy a world of benefits.
                Our members receive exclusive discounts, early access to sales, birthday rewards, and more.
                The more you shop, the more you save, and we want to thank you
                for choosing us for your shopping needs.</p>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo" class="mainImg right">
        </div>

        <div class="m-0">
            <h2>Our volunteer work</h2>
            <div class="m-0">
                <x-photo-box photo="photos/photo1.png" class="w-[32%] m-[0_6px]">cleaning beaches from trash</x-photo-box>
                <x-photo-box photo="photos/photo1.png" class="w-[32%] m-[0_6px]">annually planting trees</x-photo-box>
                <x-photo-box photo="photos/photo1.png" class="w-[32%] m-[0_6px]">helping homeless animals</x-photo-box>
            </div>
        </div>
    </div>
</x-layout>
