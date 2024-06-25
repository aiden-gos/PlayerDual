<x-app-layout>
    <div class="py-12 bg-white">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 flex flex-col">

            <div class="p-4 sm:p-8 bg-white  sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full flex flex-col md:items-end sm:border-r sm:pr-5">
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

                <div class="w-full flex flex-col gap-5 sm:border-r sm:pr-5">
                    <div class="flex flex-row justify-between ">
                        <div class="text-2xl font-bold">{{ $user->name }}</div>
                        @auth
                        @if($user->id != Auth::user()->id)
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
                                            <path
                                                d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                                            C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                                            c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                                        </g>
                                    </svg> &nbsp;
                                    {{ __('Follow') }}
                                </x-primary-button>
                            </form>
                        @endif
                        @endif
                        @endauth
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
                                {{ number_format($user->completed_orders_percentage, 0) }}%</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-md text-nowrap">Devices</div>
                            <div class="flex flex-row gap-2 text-orange-600 items-center">
                                @if (isset($user->micro) && $user->micro == true)
                                    <svg fill="#ea580c" height="16" width="16" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
                                        <g>
                                            <g>
                                                <path
                                                    d="m439.5,236c0-11.3-9.1-20.4-20.4-20.4s-20.4,9.1-20.4,20.4c0,70-64,126.9-142.7,126.9-78.7,0-142.7-56.9-142.7-126.9 0-11.3-9.1-20.4-20.4-20.4s-20.4,9.1-20.4,20.4c0,86.2 71.5,157.4 163.1,166.7v57.5h-23.6c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h88c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-23.6v-57.5c91.6-9.3 163.1-80.5 163.1-166.7z" />
                                                <path
                                                    d="m256,323.5c51,0 92.3-41.3 92.3-92.3v-127.9c0-51-41.3-92.3-92.3-92.3s-92.3,41.3-92.3,92.3v127.9c0,51 41.3,92.3 92.3,92.3zm-52.3-220.2c0-28.8 23.5-52.3 52.3-52.3s52.3,23.5 52.3,52.3v127.9c0,28.8-23.5,52.3-52.3,52.3s-52.3-23.5-52.3-52.3v-127.9z" />
                                            </g>
                                        </g>
                                    </svg>
                                @else
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 9.4V5C15 3.34315 13.6569 2 12 2C10.8224 2 9.80325 2.67852 9.3122 3.66593M12 19V22M8 22H16M3 3L21 21M5.00043 10C5.00043 10 3.50062 19 12.0401 19C14.51 19 16.1333 18.2471 17.1933 17.1768M19.0317 13C19.2365 11.3477 19 10 19 10M12 15C10.3431 15 9 13.6569 9 12V9L14.1226 14.12C13.5796 14.6637 12.8291 15 12 15Z"
                                            stroke="#ea580c" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                @endif

                                @if (isset($user->camera) && $user->camera == true)
                                    <svg fill="#ea580c" height="16" width="16" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 74.207 74.207" xml:space="preserve">
                                        <g>
                                            <path d="M57.746,14.658h-2.757l-1.021-3.363c-0.965-3.178-3.844-5.313-7.164-5.313H28.801c-3.321,0-6.201,2.135-7.165,5.313
                                   l-1.021,3.363h-4.153C7.385,14.658,0,22.043,0,31.121v20.642c0,9.077,7.385,16.462,16.462,16.462h41.283
                                   c9.077,0,16.462-7.385,16.462-16.462V31.121C74.208,22.043,66.823,14.658,57.746,14.658z M68.208,51.762
                                   c0,5.769-4.693,10.462-10.462,10.462H16.462C10.693,62.223,6,57.53,6,51.762V31.121c0-5.769,4.693-10.462,10.462-10.462h8.603
                                   l2.313-7.621c0.192-0.631,0.764-1.055,1.423-1.055h18.003c0.659,0,1.23,0.424,1.423,1.057l2.314,7.619h7.204
                                   c5.769,0,10.462,4.693,10.462,10.462L68.208,51.762L68.208,51.762z" />
                                            <path d="M37.228,25.406c-8.844,0-16.04,7.195-16.04,16.04c0,8.844,7.195,16.039,16.04,16.039s16.041-7.195,16.041-16.039
                                   C53.269,32.601,46.073,25.406,37.228,25.406z M37.228,51.486c-5.536,0-10.04-4.504-10.04-10.039c0-5.536,4.504-10.04,10.04-10.04
                                   c5.537,0,10.041,4.504,10.041,10.04C47.269,46.982,42.765,51.486,37.228,51.486z" />
                                        </g>
                                    </svg>
                                @else
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 3L6.00007 6.00007M21 21L19.8455 19.8221M9.74194 4.06811C9.83646 4.04279 9.93334 4.02428 10.0319 4.01299C10.1453 4 10.2683 4 10.5141 4H13.5327C13.7786 4 13.9015 4 14.015 4.01299C14.6068 4.08078 15.1375 4.40882 15.4628 4.90782C15.5252 5.00345 15.5802 5.11345 15.6901 5.33333C15.7451 5.44329 15.7726 5.49827 15.8037 5.54609C15.9664 5.79559 16.2318 5.95961 16.5277 5.9935C16.5844 6 16.6459 6 16.7688 6H17.8234C18.9435 6 19.5036 6 19.9314 6.21799C20.3077 6.40973 20.6137 6.71569 20.8055 7.09202C21.0234 7.51984 21.0234 8.0799 21.0234 9.2V15.3496M19.8455 19.8221C19.4278 20 18.8702 20 17.8234 20H6.22344C5.10333 20 4.54328 20 4.11546 19.782C3.73913 19.5903 3.43317 19.2843 3.24142 18.908C3.02344 18.4802 3.02344 17.9201 3.02344 16.8V9.2C3.02344 8.0799 3.02344 7.51984 3.24142 7.09202C3.43317 6.71569 3.73913 6.40973 4.11546 6.21799C4.51385 6.015 5.0269 6.00103 6.00007 6.00007M19.8455 19.8221L14.5619 14.5619M14.5619 14.5619C14.0349 15.4243 13.0847 16 12 16C10.3431 16 9 14.6569 9 13C9 11.9153 9.57566 10.9651 10.4381 10.4381M14.5619 14.5619L10.4381 10.4381M10.4381 10.4381L6.00007 6.00007"
                                            stroke="#ea580c" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-row gap-2 flex-wrap justify-center py-5">
                        @forelse ($user->games as $item)
                            <div class="bg-black/70 text-white p-2 rounded-md">{{ $item->name }}</div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <div class="w-full">
                    <div class="flex flex-col items-start gap-2">
                        <div class=" text-2xl text-red-600">
                            {{ $user->price == 0 ? 'Disable Rent' : '$' . $user->price . '/h' }}</div>
                        <div class="flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                class="h-6 w-6 text-yellow-500">
                                <path fill="currentColor"
                                    d="M10 1.36l1.45 4.46h4.69l-3.79 2.75 1.45 4.46-3.79-2.75-3.79 2.75 1.45-4.46-3.79-2.75h4.69z" />
                            </svg>
                            {{ $user->average_rating ?? '0' }}
                            ({{ $user->count_rating ?? '0' }})
                        </div>
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
                    @if ($user->description)
                        {!! nl2br($user->description) !!}
                    @else
                        <div class="w-full text-center">No description</div>
                    @endif
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
