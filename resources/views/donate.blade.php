<div class="w-full" x-data="{ 'showModal': false }"
    @keydown.escape="showModal = false" >
    <!-- Trigger for Modal -->
    <button class="bg-white text-black border w-full py-3 rounded-md" type="button" @click="showModal = true">Donate</button>

    <!-- Modal -->
    <div
        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
        x-show="showModal"
    >
        <!-- Modal inner -->
        <div
            class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
            @click.away="showModal = false"
            x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
        >
            <!-- Title / Close-->
            <div class="flex items-center justify-between">
                <h5 class="mr-3 text-black max-w-none">Donate</h5>

                <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- content -->
            <div>
                <form method="post" action="{{ route('donate') }}" class="mt-6 space-y-6">
                    @csrf

                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <div class="flex flex-row w-full">
                        <x-input-label for="name" :value="__('Reciver')" />
                        <div>{{$user->name}}</div>
                    </div>

                    <div>
                        <x-input-label for="name" :value="__('Balance')" />
                        <div>{{Auth::user()->balance}}</div>
                    </div>

                    <div>
                        <x-input-label for="money" :value="__('Money')" />
                        <x-text-input id="money" name="money" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('money')" />
                    </div>

                    <div>
                        <x-input-label for="name" :value="__('Display name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="msg" :value="__('Message')" />
                        <textarea name="msg" id="msg" cols="50" rows="10"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('msg')" />
                    </div>

                    <x-primary-button>{{ __('Donate') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>