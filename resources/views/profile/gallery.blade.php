<x-app-layout>
    <x-slot name="header">
        @include('profile.partials.sidebar-profile')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="pb-5 flex flex-row justify-between w-full">
                    <h1 class="text-2xl">Gallery</h1>
                    <x-primary-button>{{ __('Add') }}</x-primary-button>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @if (empty($gallery))
                    <div class="text-gray-600">Empty gallery</div>
                @else
                    @foreach ($gallery as $ele)
                        @if (isset($ele->type) && $ele->type == 'image')
                            <div>
                                <img class="w-[340px] h-[200px] rounded-lg object-cover" src="{{$ele->link}}" alt="">
                            </div>
                        @elseif (isset($ele->type) && $ele->type == 'video')
                            <video controls class="w-[340px] h-[200px] rounded-lg object-cover">
                                <source src="{{$ele->link}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
