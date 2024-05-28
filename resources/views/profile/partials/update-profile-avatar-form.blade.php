<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's avatar.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        @if (empty(Auth::user()->avatar))
            <div class="ml-1">
                <img class="rounded-[50%] object-cover w-40 h-40" src="{{Vite::asset('resources/views/images/avatar.jpg')}}" />
            </div>
        @else
            <div class="ml-1">
                <img class="rounded-[50%] object-cover w-40 h-40" src="{{Auth::user()->avatar}}" />
            </div>
        @endif

        <div class="container">
            {{-- <input id="avatar" name="avatar" type="file" class="mt-1 block w-full" required/> --}}
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
