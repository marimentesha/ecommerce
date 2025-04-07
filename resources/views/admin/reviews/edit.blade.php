<x-admin-layout>
    <div>
        <h2 class="flex justify-center my-5">Edit Review</h2>
        <div class="flex justify-center items-center text-xl div-box">
            <x-update-form uri="/admin/review/{{ $review->id }}">
                <div class="star-rating left mt-10 mb-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                               @if($review->rating == $i) checked @endif >
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>

                <textarea name="comment" rows="10" class="mt-[5px]">{{ $review->comment }}</textarea>
                <x-form-error name="comment"/>
                <x-form-error name="rating"/>

                <div class="my-2 -mx-1.5">
                    <button type="submit" class="button2">update</button>
                </div>
            </x-update-form>
        </div>
    </div>
</x-admin-layout>
