<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Payment') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add or update credit card.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="card_number" :value="__('Card Number')" />
            <x-text-input id="card_number" name="card_number" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="flex flex-row gap-5">
            <div class="w-full">
                <x-input-label for="expire" :value="__('Expire')" />
                <x-text-input id="expire" name="expire" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="w-full">
                <x-input-label for="cvv" :value="__('CVV')" />
                <x-text-input id="cvv" name="cvv" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
