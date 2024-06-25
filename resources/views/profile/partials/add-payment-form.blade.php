<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Payment') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add or update credit card.') }}
        </p>
    </header>

    <form method="get" action="{{ route('payment.add') }}" class="mt-6 space-y-6">
        <x-primary-button>{{ __('Add payment method') }}</x-primary-button>
    </form>

</section>
