<x-app-layout>
    <div class="py-12 bg-white">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 flex flex-col">

            <div class="p-4 sm:p-8 bg-white  sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full flex flex-col md:items-end">
                    <div class="flex flex-col items-center gap-5">
                        <img class="rounded-xl" src="{{ $user->avatar }}" width="250" height="250">
                        @if ($userStatus)
                            <div class="text-red-500 font-bold text-xl">Busy</div>
                        @else
                            <div class="text-green-500 font-bold text-xl">Ready</div>
                        @endif
                        <div>Day participation: {{ date_format($user->created_at, 'd/m/20y') }}</div>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-10">
                    <div class="flex flex-row justify-between ">
                        <div class="text-2xl font-bold">{{ $user->name }}</div>

                        @if ($follow)
                            <form method="post" action="{{ route('follow.destroy') }}">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <x-primary-button class="ml-3 flex flex-nowrap">
                                    <svg version="1.1" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256"
                                        enable-background="new 0 0 256 256" xml:space="preserve">
                                        <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
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
                                    <div> {{ __('Unfollow') }}</div>
                                </x-primary-button>
                            </form>
                        @else
                            <form method="post" action="{{ route('follow.store') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <x-primary-button class="ml-3">
                                    <svg fill="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                                        viewBox="0 0 544.582 544.582" xml:space="preserve">
                                        <g>
                                            <path d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                   C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                   c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                                        </g>
                                    </svg> &nbsp;
                                    {{ __('Follow') }}
                                </x-primary-button>
                            </form>
                        @endif
                    </div>

                    <div class="flex flex-row gap-2">
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-md text-nowrap">Followers</div>
                            <div class="flex flex-col text-[14px] text-orange-600 items-center">
                                {{ $user->follower_count }} follows</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-md text-nowrap">Total Hire</div>
                            <div class="flex flex-col text-[14px] text-orange-600 items-center">
                                {{ $user->total_rental_hours }} h</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-md text-nowrap">Percent Complete</div>
                            <div class="flex flex-col text-[14px] text-orange-600 items-center">
                                {{ $user->completed_orders_percentage }}%</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-md text-nowrap">Devices</div>
                            <div class="flex flex-col text-[14px] text-orange-600 items-center">OK</div>
                        </div>
                    </div>

                    <div class="flex flex-row gap-2 flex-wrap py-5">
                        @forelse ($user->games as $item)
                            <div class="bg-black/70 text-white p-2 rounded-md">{{ $item->name }}</div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <div class="w-full">
                    <div class="flex flex-col items-start gap-2">
                        <div class=" text-2xl text-red-600">{{ $user->price == 0 ? "Disable Rent" : '$'.$user->price.'/h' }}</div>
                        @include('rent')
                        @include('pre-order')
                        @include('donate')
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full md:px-[20%]">
                    <h1 class="text-2xl font-bold">Information</h1> <br>
                    <hr> <br>

                    {{-- Gallery --}}
                    <div ID="ngy2p"
                        data-nanogallery2='{
                        "itemsBaseURL": "http://nanogallery2.nanostudio.org/samples/",
                        "thumbnailWidth": "200",
                        "thumbnailBorderVertical": 0,
                        "thumbnailBorderHorizontal": 0,
                        "colorScheme": {
                        "thumbnail": {
                            "background": "rgba(255,255,255,1)"
                        }
                        },
                        "thumbnailLabel": {
                        "position": "overImageOnBottom"
                        },
                        "thumbnailHoverEffect2": "imageScaleIn80",
                        "thumbnailGutterWidth": 10,
                        "thumbnailGutterHeight": 10,
                        "thumbnailOpenImage": true
                    }'>
                        @foreach ($gallery as $ele)
                            <a href="{{ $ele->link }}" data-ngthumb="{{ $ele->link }}" data-ngdesc=""></a>
                        @endforeach
                    </div>
                    {{-- End Gallery --}}

                    {!! nl2br($user->description) !!}

                    <br><br>
                    <hr>
                </div>
            </div>

            @if (count($top_donate) > 0)
                <div class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                    <div class="w-full md:px-[20%]">
                        <h1 class="text-2xl font-bold">Top donate</h1> <br>
                        @foreach ($top_donate as $ele)
                            <div class="flex flex-row justify-between px-[10%] py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5">#{{ $loop->iteration }}</div>
                                    <img class="rounded-full object-cover h-12 w-12" src="{{ $ele->avatar }}"
                                        alt="">
                                    <div>{{ $ele->name }}</div>
                                </div>
                                <div>$ {{ $ele->donate_price }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @include('rating')

        </div>
    </div>
</x-app-layout>
