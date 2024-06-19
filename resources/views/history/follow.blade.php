<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-gray-100 fixed h-screen w-60 shadow flex flex-col gap-4 p-4 pt-20">
            <div class="text-xl">
                {{ __('History') }}
            </div>

            <x-nav-link :href="route('following.list')" :active="request()->routeIs('following.list')">
                {{ __('Following players') }}
            </x-nav-link>

            <x-nav-link :href="route('donating.list')" :active="request()->routeIs('donating.list')">
                {{ __('Donate history') }}
            </x-nav-link>

            <x-nav-link :href="route('renting.list')" :active="request()->routeIs('renting.list')">
                {{ __('Rent history') }}
            </x-nav-link>
        </div>

    </x-slot>
    <div class="py-5 bg-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col gap-5 w-full justify-between h-full">
                        {{-- User follwing --}}
                        @forelse ($follow as $item)
                            <div class="py-1  flex flex-row w-full justify-between">
                                <div class="flex flex-row gap-2">
                                    <img src="{{ $item->avatar ?? '' }}" class="w-12 h-12 object-cover rounded-full">
                                    <div class="flex items-start justify-center flex-col">
                                        <p class="font-bold">{{ $item->name ?? '' }}</p>
                                        @if (!empty($item->title))
                                            <p class="text-[14px] text-stone-600">{{ $item->title ?? '' }}</p>
                                        @endif
                                    </div>
                                </div>
                                <form method="post" action="{{ route('follow.destroy') }}">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $item->id ?? '' }}">
                                    <x-primary-button class="ml-3 flex flex-nowrap">
                                        <svg version="1.1" width="20" height="20"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 256 256" enable-background="new 0 0 256 256"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path fill="#FFFFFF"
                                                            d="M121.6,10c-28.9,3.7-50.7,26.7-52.4,55.4l-0.3,5.2L67,72.4c-2.4,2.3-3.9,5.7-4.8,10.2c-1.8,10.4,0.3,19.6,6,25.9c2.4,2.6,6,4.7,8.2,4.7c1.1,0,1.4,0.4,3,3.9c1,2.1,2.8,5.4,4,7.2c1.7,2.6,2.4,4.2,3,7.5c1.6,7.3,4.6,25.4,4.2,25.7c-0.5,0.5-9.5,2.9-28.3,7.6c-20.7,5.2-29.4,7.8-33.2,9.6c-5.9,2.9-10,8.6-12,16.7c-1.4,5.7-5.9,28-6.7,33.9c-0.9,6.1-0.7,8.8,0.9,12.2c1.5,3.4,3.6,5.6,6.7,7.1l2.6,1.3L94,246l73.4,0.1l-2.4-2.6c-4.5-5-7.4-12.7-7.4-19.5s2.9-14.5,7.4-19.5l2.4-2.6l-2.4-2.7c-4.5-5-7.4-12.6-7.4-19.5c0-6.7,2.9-14.4,7.2-19.3c1.4-1.6,1.9-2.4,1.4-2.4c-0.4,0-0.8-0.2-0.9-0.4c-0.3-0.5,2.3-16.2,4-24.5c0.9-4.5,1.4-5.8,3-8.3c1.1-1.7,2.9-4.9,4.1-7.3c1.9-3.9,2.2-4.2,3.4-4.2c5.4,0,12.3-8.1,14-16.5c1.3-6.1,0.5-15.2-1.8-20.1c-0.6-1.3-1.9-3.2-3-4.2l-1.8-1.8l-0.3-5.2c-0.6-10.5-4-20.7-9.6-29.1c-2.6-3.8-3.6-5-7.8-9.4c-7.7-7.8-17.7-13.3-28.9-15.8C136.7,10.2,125.2,9.6,121.6,10z" />
                                                        <path fill="#FFFFFF"
                                                            d="M182.5,165.6c-6.6,2.4-10.6,8.4-10.1,15.1c0.4,4.8,1.7,6.7,9.1,14.3l6.7,6.8l-6.7,6.8c-8.1,8.3-9,9.7-9,15.4c0,4.6,1.1,7.4,4.2,10.4c3,3,5.8,4.2,10.4,4.2c5.7,0,7.1-0.8,15.4-9l6.8-6.7l6.8,6.7c7.5,7.4,9.5,8.7,14.2,9.1c5.8,0.5,11.1-2.4,14-7.8c1.5-2.8,1.7-3.3,1.7-6.9c0-5.7-0.8-7.1-9-15.4l-6.7-6.8l6.5-6.6c8.1-8.2,9.1-9.9,9.1-15.6c0-4.6-1.1-7.3-4.1-10.4c-3-3-5.8-4.2-10.4-4.2c-5.7,0-7.1,0.8-15.3,9l-6.8,6.7l-6.8-6.7c-4.7-4.6-7.5-7-9.1-7.8C190.4,164.9,185.4,164.5,182.5,165.6z" />
                                                        <path fill="#000000"
                                                            d="M207.8,245l-1.3,1.2h2.6h2.6l-1.1-1.2C209.3,243.6,209.4,243.6,207.8,245z" />
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <div class="max-sm:hidden">{{ __('Unfollow') }}</div>
                                    </x-primary-button>
                                </form>
                            </div>
                        @empty
                        @endforelse
                        <div class="py-5 px-20 ">
                            {{ $follow->links() }}
                        </div>
                        {{-- User follwing --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('stories.stories-show')
</x-app-layout>
