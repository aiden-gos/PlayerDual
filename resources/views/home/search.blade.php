<div style="padding-bottom: 80px;">
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

            <select id="game" class="mt-2 block w-full rounded-md border border-gray-200 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">None</option>
                @foreach ($games as $game)
                    <option value="{{$game->id}}">{{$game->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <br><br><br>
            <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                <button id="search-btn" class="h-10 active:scale-95 rounded-lg bg-black px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
            </div>
        </div>
  </div>

  <script type="module">
    $(document).ready(function () {
    let time = 0;
    $('#name').on('input', function () {
        clearTimeout(time);
        time = setTimeout(function() {
        if($('#name').val() != "") {
            var name = $("#name").val();

            $.ajax(
                {
                    url: "{{route('home.search')}}",
                    type: 'GET',
                    data:{
                            "name": name,
                        } ,
                    success: function(result){
                        handleSuccessAjax(result);
                    }
                }
            );
        }
    }, 300);
    });

    $("#search-btn").click(function() {
        var name = $("#name").val();
        var sex = $("#sex").val();
        var priceMin = $("#price-min").val();
        var priceMax = $("#price-max").val();
        var game = $("#game").val();

        $.ajax(
            {
                url: "{{route('home.search')}}",
                type: 'GET',
                data:{
                        "name": name,
                        "sex" : sex,
                        "priceMin": priceMin,
                        "priceMax": priceMax,
                        "game": game
                    } ,
                success: function(result){
                    handleSuccessAjax(result);
                }
            }
        );
    })

    function handleSuccessAjax(result) {
            $(".search").empty();
            var script = ``;

            if(result?.length > 0){
                script += `<section class="food_section layout_padding-bottom">
            <div class="container">
              <div class="heading_container heading_center m-5">
                <h2>
                    Search result
                </h2>
              </div>

              <div class="filters-content">
                <div class="row grid">`;
                result.forEach(element => {
                    var eleScript =`
                    <div class="col-sm-4 col-lg-3 all pizza">
                        <div class="box">
                        <div>
                            <div>
                            <img src="${element.avatar}" alt="">
                            </div>
                            <div class="detail-box">
                            <h5>
                                ${element.name}
                            </h5>
                            <div class="options">
                                <h6>
                                ${element.price}/h
                                </h6>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>`;
                    script += eleScript;
                });
                script += `</div>
              </div>
            </div>
          </section>`;
            }else{
                script += `
                        <div class="container">
                            <div class="heading_container heading_center m-5">
                                <h2>
                                    Search result
                                </h2>
                                <h4 class="p-5">
                                    Not found player
                                </h4>
                            </div>
                        </div>
                        `;
            }
            $(".search").append(script);
        }
    })
    </script>
