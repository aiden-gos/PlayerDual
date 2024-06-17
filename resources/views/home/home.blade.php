<!-- Main -->
<main class="my-8">
    <div class="container mx-auto px-6">
        <!-- Panel -->
        <div class="h-72 rounded-md overflow-hidden bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
            <div class="bg-gray-900 bg-opacity-50 flex items-end h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">Panel</h2>
                    <p class="mt-2 text-gray-400">Text text text text text text text text text text text text text text text text text</p>
                </div>
            </div>
        </div>
        <!--  -->
        {{-- Stories --}}
        <h3 class="text-gray-600 text-2xl font-medium pt-16">Stories</h3>
        <div class="flex mt-8 md:-mx-4">
            @for ($i=0; $i<6;$i++)
            <div class=" w-full h-72 md:mx-4 rounded-md overflow-hidden bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
                <div class="bg-gray-900 bg-opacity-50 flex items-start justify- h-full">
                    <div class="max-w-xl flex flex-row gap-2 p-2">
                        <img src="https://res.cloudinary.com/dsicdcjye/image/upload/v1716969657/yf5ogadlqfygscsnmsco.jpg" class="w-8 h-8 rounded-full">
                        <p class="mt-2 text-gray-400">Player name</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <!--  -->

        <!-- Search  -->
        @include("home.search")
        <!--  -->

        <div id="search" class="mt-6 hidden">
            <h3 class="text-gray-600 text-2xl font-medium">SEARCH RESULTS</h3>
            <div id="search-result"></div>
        </div>

        <div class="mt-6">
            <h3 class="text-gray-600 text-2xl font-medium">VIP PLAYERS</h3>
            <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-6">
                @foreach ($vip_user as $user)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{$user->avatar}}')">
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{$user->name}}</h3>
                            <span class="text-gray-500 mt-2">${{$user->price}}/h</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">HOT PLAYER</h3>
            <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-6">
                @foreach ($hot_user as $user)
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{$user->avatar}}')">
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{$user->name}}</h3>
                        <span class="text-gray-500 mt-2">${{$user->price}}/h</span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</main>
<!--  -->
