<x-layout>
    <x-slot:heading>Feedback</x-slot:heading>

    <div class="div-box">
        <h2 class="mx-8 mt-10">Your opinion is important to us!</h2>

        <div class="flex justify-center">
            <form action="/feedback" method="post">
                @csrf
                <x-form-input name="name" type="text">Name:</x-form-input>
                <x-form-input name="email" type="email">Email:</x-form-input>
                <div class="mt-[5%]">
                    <label for="message">Your Feedback:</label>
                    <textarea name="message" rows="5" placeholder="Write your feedback here..." class="mt-[5px]"></textarea>
                    <x-form-error name="message"/>
                </div>
                <div>
                    <button class="authButton">Send Feedback</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
