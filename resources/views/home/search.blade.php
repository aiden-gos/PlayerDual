<div>
    <div class="rounded-xl p-6">
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
            <div class="flex flex-col">
                <label for="name" class="ml-2 text-stone-600 text-sm font-medium">Player name</label>
                <input type="text" id="name" placeholder="Player name"
                    class="mt-2 block w-full rounded-3xl border text-stone-600 border-gray-200 px-5 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
            </div>

            <div class="flex flex-col">
                <label for="manufacturer" class="ml-2 text-stone-600 text-sm font-medium">Sex</label>
                <select id="sex"
                    class="mt-2 block w-full text-stone-500 rounded-3xl border border-gray-200 px-5 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">None</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="date" class="ml-2 text-stone-600 text-sm font-medium">Price</label>
                <div class="flex flex-row gap-4 items-center">
                    <input id="price-min" type="number" id="date" value="0"
                        class="mt-2 block text-stone-600 w-full rounded-3xl border border-gray-200  py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    to <input id="price-max" type="number" id="date" value="100"
                        class="mt-2 block w-full text-stone-600 rounded-3xl border border-gray-200  py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
            </div>

            <div class="flex flex-col">
                <label for="game" class="ml-2 text-stone-600 text-sm font-medium">Game</label>

                <select id="game"
                    class="mt-2 block w-full text-stone-600 rounded-3xl border border-gray-200 px-7 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">None</option>
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6 grid w-full justify-start xl:justify-end space-x-4 w-full">
                <button id="search-btn"
                    class="h-10 active:scale-95 rounded-lg bg-rose-500 px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
            </div>
        </div>

    </div>
</div>

<script type="module">
    $(document).ready(function() {
        let time = 0;
        $('#name').on('input', function() {
            clearTimeout(time);
            time = setTimeout(function() {
                if ($('#name').val() != "") {
                    var name = $("#name").val();

                    $.ajax({
                        url: "{{ route('home.search') }}",
                        type: 'GET',
                        data: {
                            "name": name,
                        },
                        success: function(result) {
                            handleSuccessAjax(result);
                        }
                    });
                }
            }, 300);
        });

        $("#search-btn").click(function() {
            var name = $("#name").val();
            var sex = $("#sex").val();
            var priceMin = $("#price-min").val();
            var priceMax = $("#price-max").val();
            var game = $("#game").val();

            $.ajax({
                url: "{{ route('home.search') }}",
                type: 'GET',
                data: {
                    "name": name,
                    "sex": sex,
                    "priceMin": priceMin,
                    "priceMax": priceMax,
                    "game": game
                },
                success: function(result) {
                    handleSuccessAjax(result);
                }
            });
        })

        function handleSuccessAjax(result) {
            $(".search").empty();
            var script = ``;

            if (result?.length > 0) {
                script +=
                    `<div class="mt-5">
                            <h1 class="text-xl text-rose-500 font-bold">RESULT</h1>
                            <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">`;
                result.forEach(e => {
                    script += `<a href="/user/${e.id}" class="rounded-xl border mt-5">
                            <div>
                                <img class="rounded-t-xl" src="${e.avatar}">
                                <div class="w-full flex justify-end">
                                    <span
                                        class="text-white p-2 rounded-full bg-rose-500 text-xs mr-2 mb-[10px] mt-[-40px]">$ ${e.price}/h</span>
                                </div>
                            </div>
                            <div class="p-2 overflow-hidden truncate">
                                <span
                                    class="text-lg font-bold whitespace-nowrap">${e.name}</span>
                                <br>
                                <span class="text-gray-400">title user player</span>
                                <div class="mt-5 flex flex-row justify-between">
                                    <div>game</div>
                                    <div class="flex flex-row items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            class="h-6 w-6 text-yellow-500">
                                            <path fill="currentColor"
                                                d="M10 1.36l1.45 4.46h4.69l-3.79 2.75 1.45 4.46-3.79-2.75-3.79 2.75 1.45-4.46-3.79-2.75h4.69z" />
                                        </svg>
                                        4.9 (420)
                                    </div>
                                </div>
                            </div>
                        </a>`;
                });

                script += `</div></div>`;
            } else {
                script += `
                        <div class="mt-5">
                            <h1 class="text-xl text-rose-500 font-bold">RESULT</h1>
                            <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-5">
                                <h4 class="p-5">
                                    No result
                                </h4>
                            </div>
                        </div>
                        `;
            }
            $(".search").append(script);
        }
    })
</script>
