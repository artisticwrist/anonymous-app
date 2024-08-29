<x-guest-layout>
    {{-- <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <form method="POST" action="{{ url('/api/feedback-form') }}">
        @csrf

        {{ $data }}
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="feedback" :value="__('Feedback')" />
            <x-text-input id="feedback" class="block mt-1 w-full" type="text" name="feedback" :value="old('feedback')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('feedback')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <button type="submit">
                <x-primary-button class="">
                    feedback
                </x-primary-button>
            </button>

        </div>
    </form>
</x-guest-layout>
