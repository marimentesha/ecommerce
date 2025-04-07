<x-layout>
    <x-slot:heading>Contacts</x-slot:heading>
    <div>
        <h2>Our Contacts</h2>
        <div>
            <p class="-mb-[1%]">email:</p>
            <p class="mb-[2%]">email.example@gmail.com</p>
            <p class="-mb-[1%]">phone:</p>
            <p class="mb-[2%]">555 55 55 55</p>
            <p class="-mb-[1%]">twitter:</p>
            <p class="mb-[2%]">@twitter.handle</p>
            <p class="-mb-[1%]">instagram:</p>
            <p class="mb-[2%]">@instagram.handle</p>
            <img src="{{ asset('photos/photo1.png') }}" alt="photo" class="right mainImg">
        </div>
    </div>

    <div>
        <h2>Follow us on instagram</h2>
        <div>
            <x-photo-box photo="photos/photo1.png" class="m-[0_6px] w-[24%]"/>
            <x-photo-box photo="photos/photo1.png" class="m-[7%_6px] w-[24%]"/>
            <x-photo-box photo="photos/photo1.png" class="m-[0_6px] w-[24%]"/>
            <x-photo-box photo="photos/photo1.png" class="m-[7%_6px] w-[24%]"/>
        </div>
    </div>
</x-layout>
