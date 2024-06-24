<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Player Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your player's profile information") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $user->title)" required
                autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea
                class="h-52 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                id="description" name="description" type="text" required autofocus autocomplete="description"> {{ $user->description ?? '' }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price', $user->price)"
                required autofocus autocomplete="price" />
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>

        <div>
            <x-input-label for="device" :value="__('Device')" />
            <input type='checkbox' name='micro' id="micro" {{$user->micro ? 'checked' : ""}} value='true'> <label for="micro">Micro</label> <br>
            <input type='checkbox' name='camera' id="camera" {{$user->camera ? 'checked' : ""}} value='true'> <label for="camera">Camera</label>
        </div>

        <div>
            <x-input-label :value="__('Game')" />
            @php
                $userGameIds = $user->games->pluck('id')->toArray();
            @endphp
            <div class="flex flex-row flex-wrap gap-1">
                @foreach ($games as $item)
                    <div class="bg-gray-200 p-2 rounded-xl">
                        <input type="checkbox" name="games[]" id="game{{ $item->id }}" value="{{ $item->id }}"
                            {{ in_array($item->id, $userGameIds) ? 'checked' : '' }}> <label
                            for="game{{ $item->id }}">{{ $item->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
