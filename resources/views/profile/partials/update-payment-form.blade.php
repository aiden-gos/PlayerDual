<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Payment') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add or update credit card.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.payment') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="card_number" :value="__('Card Number')" />
            <x-text-input id="card_number" name="card_number" type="text" class="mt-1 block w-full" :value="old('card_number', $user->card_number)" />
            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
        </div>

        <div class="flex flex-row gap-5">
            <div class="w-full">
                <x-input-label for="card_expire" :value="__('Expire')" />
                <x-text-input id="card_expire" name="card_expire" type="text" class="mt-1 block w-full" :value="old('card_expire', $user->card_expire)" />
                <x-input-error :messages="$errors->get('card_expire')" class="mt-2" />
            </div>

            <div class="w-full">
                <x-input-label for="card_cvv" :value="__('CVV')" />
                <x-text-input id="card_cvv" name="card_cvv" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('card_cvv')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'payment-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
