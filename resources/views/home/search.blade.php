<div class="m-2 mt-10">
        <div class="rounded-xl p-6">
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="flex flex-col">
            <label for="name" class="text-stone-600 text-sm font-medium">Player name</label>
            <input type="text" id="name" placeholder="Player name" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
            </div>

            <div class="flex flex-col">
            <label for="manufacturer" class="text-stone-600 text-sm font-medium">Sex</label>
            <select id="sex" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="">None</option>
                <option value="1">Male</option>
                <option value="0">Female</option>
            </select>
            </div>

            <div class="flex flex-col">
            <label for="date" class="text-stone-600 text-sm font-medium">Price</label>
                <div class="flex flex-row gap-4 items-center">
                    <input id="price-min" type="number" id="date" value="0" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    to <input id="price-max" type="number" id="date" value="100" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
            </div>

            <div class="flex flex-col">
            <label for="game" class="text-stone-600 text-sm font-medium">Game</label>

            <select name="game" id="game" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option>Game name</option>
            </select>
            </div>
        </div>

        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
            <button id="search-btn" class="active:scale-95 rounded-lg bg-black px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
        </div>
        </div>
  </div>

<script type="module">
    $(document).ready(function () {
    $("#search-btn").click(function() {
        var name = $("#name").val();
        var sex = $("#sex").val();
        var priceMin = $("#price-min").val();
        var priceMax = $("#price-max").val();
        $.ajax(
            {
                url: "{{route('home.search')}}",
                type: 'GET',
                data:{
                        "name": name,
                        "sex" : sex,
                        "priceMin": priceMin,
                        "priceMax": priceMax
                    } ,
                success: function(result){

                    handleSuccessAjax(result);
                }
            }
        );
    })

    function handleSuccessAjax(result) {
            $("#search-result").empty();
            var script = ``;

            if(result?.length > 0){
                script += `<div class="grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-6">`
                result.forEach(element => {
                    console.log(element);
                    var eleScript =`
                            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('${element?.avatar != null ? element?.avatar:'' }')">
                                </div>
                                <div class="px-5 py-3">
                                    <h3 class="text-gray-700 uppercase">${element?.name}</h3>
                                    <span class="text-gray-500 mt-2">$${element?.price}/h</span>
                                </div>
                            </div>
                            `;
                    script += eleScript;
                });
                script += `</div>`;
            }else{
                script += `
                            <div class="w-full overflow-hidden py-5 flex justify-center">
                                <div class="p-6 text-gray-900 text-xl">
                                    {{ __("Not found player") }}
                                </div>
                            </div>
                        `;
            }
            $("#search").removeClass("hidden")
            $("#search-result").append(script);
        }
    })
</script>
