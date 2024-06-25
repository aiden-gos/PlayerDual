<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-gray-100 fixed h-screen w-60 shadow flex flex-col gap-4 p-4 pt-20">
            <h2 class="text-xl font-bold w-full text-center">Game list</h2>
            <hr>
            <div class="flex flex-col justify-center items-start w-full">
                <button id="all" name="ALL PLAYERS"
                    class="filter-game py-2 flex flex-row gap-2 items-center hover:bg-rose-100 rounded-md w-full">
                    <img class="w-8 h-8 rounded-md"
                        src="https://image.winudf.com/v2/image1/Y29tLmJsYWNrb2Nlbi5hbGxpbm9uZV9uZXdnYW1lc19zY3JlZW5fMF8xNjgxMzQ4ODQ2XzA2Mw/screen-0.jpg?fakeurl=1&type=.jpg"
                        alt="">
                    <div> All </div>
                </button>
                @foreach ($games as $item)
                    <button id="{{ $item->id }}" name="{{ $item->name }}"
                        class="filter-game py-2 flex flex-row gap-2 items-center hover:bg-rose-100 rounded-md w-full">
                        <img class="w-8 h-8 rounded-md" src="{{ $item->img }}" alt="">
                        <div> {{ $item->name }} </div>
                    </button>
                @endforeach
            </div>
        </div>
    </x-slot>
    <div class="py-5 bg-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-row flex-wrap gap-5">
                        {{-- Pan  --}}
                        <div class="w-full">
                            <img class="object-fill h-40 w-full rounded-xl"
                                src="https://res.cloudinary.com/dsicdcjye/image/upload/v1719282549/715867c6-698f-411a-b4f9-1e9093130b60__ff5aee00-79ee-11ed-a19f-23a3b10d190e__admin_banner_vfm7xy.png"
                                alt="">
                        </div>
                        {{-- Pan  --}}
                        <div
                            class="overflow-auto flex flex-row gap-3" style="-ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($stories as $story)
                                <button class="flex flex-col border rounded-xl story" href=""
                                    x-data=""
                                    x-on:click.prevent='$dispatch("open-modal",{name : "story-detail", story: {
                                    id: "{{ $story->id }}",
                                    video_link: "{{ $story->video_link }}",
                                    view: "{{ $story->view }}",
                                    content: "{{ $story->content }}",
                                    like: {{ $story->like }},
                                    is_liked_by_user: "{{ $story->is_liked_by_user }}",
                                    comment_count: "{{ $story->comment_count }}",
                                    user: {
                                        id: "{{ isset($story->user->id) ? $story->user->id : '' }}",
                                        name: "{{ isset($story->user->name) ? $story->user->name : '' }}",
                                        avatar: "{{ isset($story->user->avatar) ? $story->user->avatar : '' }}",
                                    },
                                }})'>
                                    <div>
                                        <video class="min-w-48 h-60 rounded-t-xl object-cover"
                                            src="{{ $story->video_link }}" alt=""></video>
                                        <div class="text-white mt-[-20px] flex w-full justify-end text-sm px-2">
                                            <svg width="20" height="20" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M5.20513 12.5C6.66296 14.7936 8.9567 16.9 12.5 16.9C16.0433 16.9 18.3371 14.7936 19.7949 12.5C18.3371 10.2064 16.0433 8.1 12.5 8.1C8.9567 8.1 6.66296 10.2064 5.20513 12.5ZM3.98551 12.1913C5.53974 9.60093 8.20179 6.9 12.5 6.9C16.7982 6.9 19.4603 9.60093 21.0145 12.1913L21.1997 12.5L21.0145 12.8087C19.4603 15.3991 16.7982 18.1 12.5 18.1C8.20179 18.1 5.53974 15.3991 3.98551 12.8087L3.80029 12.5L3.98551 12.1913ZM12.5 9.4C10.7879 9.4 9.4 10.7879 9.4 12.5C9.4 14.2121 10.7879 15.6 12.5 15.6C14.2121 15.6 15.6 14.2121 15.6 12.5C15.6 10.7879 14.2121 9.4 12.5 9.4Z"
                                                    fill="#FFFFFF" />
                                            </svg>
                                            {{ $story->view }}
                                        </div>
                                    </div>
                                    <div class="p-2 flex flex-row gap-2 items-center">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ isset($story->user->avatar) ? $story->user->avatar : '' }}"
                                            alt="">
                                        <span
                                            class="text-xs">{{ isset($story->user->name) ? $story->user->name : '' }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        {{-- Filter game  --}}
                        <div class="mt-5 hidden game-container w-full">

                            <h1 id="name-game" class="text-xl text-rose-500 font-bold"></h1>

                            <div
                                class="filter-game-container w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">
                            </div>
                            <div class="w-full flex flex-row- justify-center gap-3 mt-10" id="paginate">

                            </div>
                        </div>
                        {{-- Filter game  --}}

                        <div id="home">
                            {{-- Search  --}}
                            @include('home.search')
                            <div class="search "></div>
                            {{-- Search  --}}

                            {{-- vip player  --}}
                            <div class="mt-5">
                                <h1 class="text-xl text-rose-500 font-bold">VIP PLAYERS</h1>

                                <div
                                    class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">
                                    @foreach ($vip_user as $item)
                                        <a href="/user/{{ $item->id }}" class="rounded-xl border mt-5">
                                            <div>
                                                <img class="rounded-t-xl h-40 w-full object-cover"
                                                    src="{{ $item->avatar ?? '' }}">
                                                <div class="w-full flex justify-end">
                                                    <span
                                                        class="text-white p-2 rounded-full bg-rose-500 text-xs mr-2 mb-[10px] mt-[-40px]">${{ number_format($item->price) }}/h</span>
                                                </div>
                                            </div>
                                            <div class="p-2 overflow-hidden truncate">
                                                <span
                                                    class="text-lg font-bold whitespace-nowrap">{{ $item->name ?? '' }}</span>
                                                <br>
                                                <div class="text-gray-400 h-5">{{ $item->title ?? '' }}</div>
                                                <div class="mt-5 flex flex-row justify-between">
                                                    <div class="flex flex-row items-center gap-1">
                                                        @foreach ($item->games as $index => $game)
                                                            @if ($index < 3)
                                                                <img class="w-5 h-5 rounded-full"
                                                                    src="{{ $game->img ?? '' }}" alt="">
                                                            @endif
                                                            @if ($index >= 3 && $index == count($item->games) - 1)
                                                                <span
                                                                    class="text-xs">+{{ count($item->games) - 3 }}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="flex flex-row items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            class="h-6 w-6 text-yellow-500">
                                                            <path fill="currentColor"
                                                                d="M10 1.36l1.45 4.46h4.69l-3.79 2.75 1.45 4.46-3.79-2.75-3.79 2.75 1.45-4.46-3.79-2.75h4.69z" />
                                                        </svg>
                                                        {{ $item->average_rating ?? '0' }}
                                                        ({{ $item->count_rating ?? '0' }})
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Hot player  --}}
                            <div class="mt-10">
                                <h1 class="text-xl text-rose-500 font-bold">HOT PLAYERS</h1>

                                <div
                                    class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">
                                    @foreach ($hot_user as $item)
                                        <a href="/user/{{ $item->id }}" class="rounded-xl border mt-5">
                                            <div>
                                                <img class="rounded-t-xl h-40 w-full object-cover"
                                                    src="{{ $item->avatar ?? '' }}">
                                                <div class="w-full flex justify-end">
                                                    <span
                                                        class="text-white p-2 rounded-full bg-rose-500 text-xs mr-2 mb-[10px] mt-[-40px]">${{ number_format($item->price) }}/h</span>
                                                </div>
                                            </div>
                                            <div class="p-2 overflow-hidden truncate">
                                                <span
                                                    class="text-lg font-bold whitespace-nowrap">{{ $item->name ?? '' }}</span>
                                                <br>
                                                <div class="text-gray-400 h-5">{{ $item->title ?? '' }}</div>
                                                <div class="mt-5 flex flex-row justify-between">
                                                    <div class="flex flex-row items-center gap-1">
                                                        @foreach ($item->games as $index => $game)
                                                            @if ($index < 3)
                                                                <img class="w-5 h-5 rounded-full"
                                                                    src="{{ $game->img ?? '' }}" alt="">
                                                            @endif
                                                            @if ($index >= 3 && $index == count($item->games) - 1)
                                                                <span
                                                                    class="text-xs">+{{ count($item->games) - 3 }}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="flex flex-row items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            class="h-6 w-6 text-yellow-500">
                                                            <path fill="currentColor"
                                                                d="M10 1.36l1.45 4.46h4.69l-3.79 2.75 1.45 4.46-3.79-2.75-3.79 2.75 1.45-4.46-3.79-2.75h4.69z" />
                                                        </svg>
                                                        {{ $item->average_rating ?? '0' }}
                                                        ({{ $item->count_rating ?? '0' }})
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('stories.stories-show')

    <script>
        $(document).ready(function() {
            $(".filter-game").click(function() {
                $(".filter-game").removeClass('bg-rose-400 hover:bg-rose-400');
                if ($(this).hasClass('active')) {
                    $('#home').show();
                    $(".game-container").addClass('hidden');
                    $(this).removeClass('active');
                } else {

                    $(this).addClass('bg-rose-400 hover:bg-rose-400 active');
                    $('#home').hide();
                    var game = $(this).attr('id')
                    var name = $(this).attr('name');
                    var img = $(this).children('img').attr('src');

                    $('#name-game').text(name);

                    $.ajax({
                        url: "{{ route('home.game', '') }}/" + game,
                        type: 'GET',

                        success: function(result) {
                            handleSuccessAjaxFilterGame(result);
                        }
                    });
                }
            })

            function handleSuccessAjaxFilterGame(result) {
                $(".game-container").removeClass('hidden');

                $(".filter-game-container").empty();

                var script = ``;

                if (result?.data?.length > 0) {
                    script +=
                        ``;
                    result.data.forEach(e => {
                        script += `<a href="/user/${e.id}" class="rounded-xl border mt-5">
                            <div>
                                <img class="rounded-t-xl h-40 w-full object-cover" src="${e.avatar}">
                                <div class="w-full flex justify-end">
                                    <span
                                        class="text-white p-2 rounded-full bg-rose-500 text-xs mr-2 mb-[10px] mt-[-40px]">$ ${e.price}/h</span>
                                </div>
                            </div>
                            <div class="p-2 overflow-hidden truncate">
                                <span
                                    class="text-lg font-bold whitespace-nowrap">${e.name}</span>
                                <br>
                                <div class="text-gray-400 h-5">${e.title ?? ""}</div>
                                <div class="mt-5 flex flex-row justify-between">
                                 <div class="flex flex-row items-center gap-1">`;
                        e.games.forEach((game, index) => {
                            if (index < 3) {
                                script += `<img class="w-5 h-5 rounded-full" src="${game.img}" alt="">`;
                            }
                            if (index >= 3 && index == e.games.length - 1) {
                                script += `<span class="text-xs">+${e.games.length - 3}</span>`;
                            }
                        });

                        script += `</div><div class="flex flex-row items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            class="h-6 w-6 text-yellow-500">
                                            <path fill="currentColor"
                                                d="M10 1.36l1.45 4.46h4.69l-3.79 2.75 1.45 4.46-3.79-2.75-3.79 2.75 1.45-4.46-3.79-2.75h4.69z" />
                                        </svg>
                                        ${e.average_rating ?? "0"} (${e.count_rating ?? "0"})
                                    </div>
                                </div>
                            </div>
                        </a>`;
                    });
                    var paginate = ``;
                    if (result?.links.length > 3) {
                        result?.links.forEach(e => {
                            if (e.url != null)
                                if (e.active == true) {
                                    paginate +=
                                        `<button disabled class="border bg-rose-500 text-white p-2 rounded-full min-h-10 min-w-10" href="${e.url}">${e.label}</button>`
                                } else {
                                    paginate +=
                                        `<button class="btn-paginate border text-rose-500 border-rose-500 p-2 rounded-full min-h-10 min-w-10" href="${e.url}">${e.label}</button>`
                                }
                        });
                    }

                } else {
                    script += `
                        <div class="mt-5">
                            <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">
                                <h4 class="p-5 text-nowrap" >
                                    No result
                                </h4>
                            </div>
                        </div>
                        `;
                }
                $("#paginate").empty();
                $("#paginate").append(paginate);
                $(".filter-game-container").append(script);
            }

            $(document).on('click', '.btn-paginate', function() {
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(result) {
                        handleSuccessAjaxFilterGame(result);
                        window.scrollTo(0, 0);
                    }
                });
            })
        });
    </script>
</x-app-layout>
