<x-layout>
    <x-slot:heading>profile page</x-slot:heading>
    <div class="m-[0_40%]">
        <h2>My account</h2>
    </div>

    <div class="div-box2">
        <x-account-info id="{{$user->id}}" first="{{ $user->first }}" last="{{ $user->last }}"/>

        <h3 class="flex justify-center">Credit Cards</h3>
        <div class="w-[72%] text-xl yScrollbar h-[300px]">
            @foreach($cards as $card)
                @if($card->last_four_digits)
                    @if(!(request()->is('users/' . $user->id . '/card/' . $card->id)))
                        <div>
                            <div class="left ml-[5%]">
                                <b>credit card number:</b>
                                <p> **** **** **** {{ $card->last_four_digits }}</p>
                            </div>

                            <div class="right mt-7">
                                <a href="/users/{{ $user->id }}/card/{{ $card->id }}" class="button">Change</a>
                            </div>
                        </div>
                        <hr class="line w-full m-2">
                    @endif
                    @if(request()->is('users/' . $user->id . '/card/' . $card->id))
                        <div>
                            <form action="/users/{{ $user->id }}/card/{{ $card->id }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="left ml-[5%]">
                                    <x-form-input name="card_number" type="text" placeholder="**** **** **** {{ $card->last_four_digits }}">
                                        <b>credit card number:</b></x-form-input>
                                </div>

                                <div class="right mt-7">
                                    <button type="submit" class="button">Change</button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</x-layout>
