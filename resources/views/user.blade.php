<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 flex flex-col">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full flex flex-col md:items-end">
                    <div class="flex flex-col items-center gap-5">
                        <img class="rounded-xl" src="{{$user->avatar}}" width="250" height="250">
                        <div class="text-green-500 font-bold text-xl">Ready</div>
                        <div>Day participation: {{date_format($user->created_at,"d/m/20y")}}</div>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-10">
                    <div class="flex flex-row justify-between ">
                        <div class="text-2xl font-bold">{{$user->name}}</div>

                        @if ($follow)
                        <form method="post" action="{{ route('follow.destroy') }}" >
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <x-primary-button class="ml-3">
                                {{ __('Unfollow') }}
                            </x-primary-button>
                        </form>
                        @else
                        <form method="post" action="{{ route('follow.store') }}" >
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <x-primary-button class="ml-3">
                                {{ __('Follow') }}
                            </x-primary-button>
                        </form>
                        @endif
                    </div>

                    <div class="flex flex-row gap-2">
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Followers</div>
                            <div class="flex flex-col items-center">57 follows</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Total Hire</div>
                            <div class="flex flex-col items-center">2394 h</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Percent Complete</div>
                            <div class="flex flex-col items-center">96.22%</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Devices</div>
                            <div class="flex flex-col items-center">OK</div>
                        </div>
                    </div>

                    <div class="flex flex-row gap-2 flex-wrap py-5">
                        <div class="bg-black text-white p-2 rounded-md">Order</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrder</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrder</div>
                        <div class="bg-black text-white p-2 rounded-md">Order</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrderOrderOrder</div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="flex flex-col items-start gap-2">
                        <div class=" text-2xl">${{$user->price}}/h</div>
                        @include('rent')
                        @include('donate')
                        <button id="chat" class="bg-white text-black border w-full py-3 rounded-md max-w-64">Chat</button>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full md:px-[20%]">
                    <h1 class="text-2xl font-bold">Information</h1> <br> <hr> <br>

                    "Mình nhận chơi các game sau (Chơi được sever NA / OC / EU / Korea / Japan / PBE):" <br><br>

                    - LOL / ĐTCL (TFT) <br><br>

                    - VALORANT<br><br>

                    - NARAKA<br><br>

                    🌸 Game giải trí, sinh tồn, kinh dị, bla bla:<br><br>

                    - Pal World, Goose Goose Duck (zịt), Business Tour (cờ tỷ phú), Scrible it (vẽ), Agrou (ma sói), Among us, Deceit, Prop and Seek, Phasmophobia, Pummel Party, Raft, Fall Guys, Dead by Daylight, Sons Of The Forest, Green Hell, Let 4 Dead 2, Human Fall Flat, Secret Neighbor, Gartic Phone, Boo Men, Inside the Backrooms ...
                    <br><br>
                    (Mình có thể Down game trên Steam, Epic,.. theo yêu cầu nếu được hướng dẫn chơi ạ)<br><br>

                    - Ngoài ra mình còn nhận stream phim trên Netflix và mở nhạc trong Discord nữa nhoo<br><br>

                    __________________________________<br>
                    <br>
                    Cảm ơn mọi người đã đến đây, have a nice day 💜
                    <br><br>
                    <hr>
                    <br><br>
                    <iframe class="w-full" height="500" src="https://www.youtube.com/embed/womd8BFIbDY?si=gJnPguPRhBoU0CQD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
                <div class="w-full md:px-[20%]">
                    <h1 class="text-2xl font-bold">Rating</h1> <br> <hr> <br>
                        @for($i = 0; $i < 10; $i++)
                            <x-comment></x-comment>
                            <hr>
                        @endfor
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
