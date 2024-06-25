<div class="flex flex-col min-h-[700px]">
    <div class="flex flex-row w-full">
        <div
            class="py-2 px-4 bg-gray-100 border text-gray-900 inline-flex border-b-2 border-rose-500 items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
            Current order
        </div>
    </div>
    <div id="current-order" class="mb-10 p-2 overflow-auto text-center text-gray-500 ">
        <div id="current-no">No order</div>
    </div>

    <div class="flex flex-row ">
        <div
            class="py-2 px-4 bg-gray-100 border text-gray-900 inline-flex border-b-2 border-rose-500 items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
            Request
        </div>
    </div>
    <a href="/rent/listRequest" class="text-rose-500 w-full text-end">view all</a>
    <div id="request" class="p-2 overflow-auto text-center text-gray-500 ">
        <div id='no'>No request</div>
    </div>

</div>
<script>
    getOrderRequest();
    getPreOrderRequest();

    function getOrderRequest() {
        $.ajax({
            url: '{{ route('rent.request') }}',
            type: 'GET',
            success: function(data) {
                if (data.renting_pending) {
                    requestRenderRenting(data.renting_pending.id, data.renting_pending.ordered_user.avatar,
                        data.renting_pending.ordered_user.name, data.renting_pending.total_price,
                        data.renting_pending.duration);
                }

                if (data.rented_pending.length > 0) {
                    data.rented_pending.forEach(element => {
                        requestRenderRented(element.id, element.ordering_user.avatar,
                            element.ordering_user.name, element.total_price,
                            element.duration);
                    });
                }

                if (data.renting && !data.rented) {
                    currentOrderRender(data.renting.id, data.renting.ordered_user.avatar,
                        data.renting.ordered_user.name, data.renting.total_price,
                        data.renting.duration, data.renting.seconds_until_end, false);
                }

                if (data.rented && !data.renting) {
                    currentOrderedRender(data.rented.id, data.rented.ordering_user.avatar,
                        data.rented.ordering_user.name, data.rented.total_price,
                        data.rented.duration, data.rented.seconds_until_end);
                }

                if (data.renting && data.rented) {
                    currentOrderRender(data.renting.id, data.renting.ordered_user.avatar,
                        data.renting.ordered_user.name, data.renting.total_price,
                        data.renting.duration, data.renting.seconds_until_end, true);
                }
            }
        });
    }

    function getPreOrderRequest() {
        $.ajax({
            url: '{{ route('pre-order.request') }}',
            type: 'GET',
            success: function(data) {
                if (data.renting_pending) {
                    requestRenderRentingPreOrder(data.renting_pending.id, data.renting_pending.ordered_user.avatar,
                        data.renting_pending.ordered_user.name, data.renting_pending.total_price,
                        data.renting_pending.duration);
                }

                if (data.rented_pending.length > 0) {
                    data.rented_pending.forEach(element => {
                        requestRenderRentedPreOrder(element.id, element.ordering_user.avatar,
                            element.ordering_user.name, element.total_price,
                            element.duration);
                    });
                }

                if (data.renting) {
                    currentPreOrderRender(data.renting.id, data.renting.ordered_user.avatar,
                        data.renting.ordered_user.name, data.renting.total_price,
                        data.renting.duration,data.renting.seconds_until_end);
                }

                if (data.rented) {
                    currentPreOrderedRender(data.rented.id, data.rented.ordering_user.avatar,
                        data.rented.ordering_user.name, data.rented.total_price,
                        data.rented.duration, data.rented.seconds_until_end);
                }
            }
        });
    }

    function requestRenderRenting(id, avatar, name, total_price, duration) {
        $('#no').empty();
        $('#request').append(`
                        <div class="flex flex-col mt-2 items-start gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">

                            <div class="flex flex-row gap-5">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div class="text-black flex flex-col items-start">
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>
                             <div id="cancel-form" class="flex justify-center items-center w-full">
                                    <form method="post" action="{{ route('rent.end') }}">
                                        @csrf
                                        <input id="end-id" type="hidden" name="id" value="${id}">
                                        <button class="text-white bg-red-500 px-1 rounded-md">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                        </div>
                    `);
    }

    function requestRenderRented(id, avatar, name, total_price, duration) {
        $('#no').empty();
        $('#request').append(`
                        <div class="flex flex-col mt-2 items-start gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">

                            <div class="flex flex-row gap-5">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div class="text-black flex flex-col items-start">
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>

                                <div class="flex justify-center items-center w-full gap-5">
                                    <form method="post" action="{{ route('rent.reject') }}">
                                        @csrf
                                        <input id="accept-id" type="hidden" name="id" value="${id}">
                                       <button class="text-white bg-red-500 px-2 rounded-md">
                                            Reject
                                        </button>
                                    </form>

                                    <form method="post" action="{{ route('rent.accept') }}">
                                        @csrf
                                        <input id="reject-id" type="hidden" name="id" value="${id}">
                                        <button class="text-white bg-green-500 px-2 rounded-md">
                                            Accept
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
        `);
    }

    function currentOrderRender(id, avatar, name, total_price, duration, s, off) {
        $('#current-no').empty();
        $('#current-order').append(`
                        <div class="flex flex-col mt-2 gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">

                            <div class="flex flex-row justify-start gap-5 w-full">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div class="text-black flex flex-col items-start">
                                    ${off ? "<div id='name-rent' class='font-bold'>Off time</div>" : ""}
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                    <div id="countdown-cr-order" >00:00:00</div>
                                </div>
                            </div>
                            <hr/>
                             <div id="cancel-form" class="flex justify-center items-center">
                                    <form method="post" action="{{ route('rent.end') }}">
                                        @csrf
                                        <input id="end-id" type="hidden" name="id" value="${id}">
                                        <button class="text-white bg-red-500 px-1 rounded-md">
                                            End
                                        </button>
                                    </form>
                                </div>
                        </div>
                    `);
                    var time = s;
                    startTimer(time, $('#countdown-cr-order'));
    }

    function currentOrderedRender(id, avatar, name, total_price, duration, s) {
        $('#current-no').empty();
        $('#current-order').append(`
                        <div class="flex flex-col mt-2 gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">

                            <div class="flex flex-row justify-start gap-5 w-full">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div class="text-black flex flex-col items-start">
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>
                            <div id="countdown-cr-ordered" >00:00:00</div>
                        </div>
                    `);
                    var time = s;
                    startTimer(time, $('#countdown-cr-ordered'));
    }
    //Pre-order

    function requestRenderRentingPreOrder(id, avatar, name, total_price, duration) {
        $('#no').empty();
        $('#request').append(`
                <div class="flex flex-col items-start mt-2 gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                    <div class="flex flex-row gap-5">
                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full w-16 h-16"
                                src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                        </div>

                        <div class="text-black flex flex-col items-start">
                            <div id='name-rent' class="font-bold">Pre-order</div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$ ${total_price}</div>
                            <div i='time-rent'>${duration} hour</div>
                        </div>
                    </div>

                    <div id="cancel-form" class="flex justify-center items-center w-full">
                            <form method="post" action="{{ route('pre-order.end') }}">
                                @csrf
                                <input id="end-id" type="hidden" name="id" value="${id}">
                                <button class="text-white bg-red-500 px-1 rounded-md">
                                    {{ __('Cancel') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    `);
    }

    function requestRenderRentedPreOrder(id, avatar, name, total_price, duration) {
        $('#no').empty();
        $('#request').append(`
                        <div class="flex flex-col mt-2 items-start gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                            <div class="flex flex-row justify-start gap-5">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps">
                                </div>
                            
                                <div class="text-black flex flex-col items-start">
                                    <div id='name-rent' class="font-bold">Pre-order</div>
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$ ${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-2 w-full">
                                <form method="post" action="{{ route('pre-order.reject') }}">
                                    @csrf
                                    <input id="accept-id" type="hidden" name="id" value="${id}">
                                    <button x-on:click="$dispatch('close')" class="text-white bg-red-500 px-1 rounded-md">
                                        {{ __('Reject') }}
                                        </button>
                                </form>

                                <form method="post" action="{{ route('pre-order.accept') }}">
                                    @csrf
                                    <input id="reject-id" type="hidden" name="id" value="${id}">
                                    <button class="text-white bg-green-500 px-1 rounded-md">
                                        {{ __('Accept') }}
                                    </button>
                                </form>
                            </div>
                        </div>
        `);
    }

    function currentPreOrderRender(id, avatar, name, total_price, duration, s) {
        $('#current-no').empty();
        $('#current-order').append(`
                        <div class="flex flex-col mt-2 gap-1 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">
                    <div class="flex flex-row gap-2 justify-start w-full">

                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full w-16 h-16" src="${avatar}"
                            alt="ps" class="avt-1-15 avt-img">
                        </div>
                        <div class="flex flex-col items-start text-black">
                            <div class="font-bold">Pre-order</div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$${total_price}</div>
                            <div id='time-rent'>${duration} hour</div>
                        </div>

                    </div>
                        <div id="cancel-form" class="flex justify-center items-center">
                            <form method="post" action="{{ route('pre-order.end') }}">
                                @csrf
                                <input id="end-id" type="hidden" name="id" value="${id}">
                                <button class="text-white bg-red-500 px-1 rounded-md">
                                    {{ __('Cancel') }}
                                </button>
                            </form>
                        </div>
                            <div id="countdown-cr-pre-order" >00:00:00</div>
                    </div>
                    `);
                    var time = s;
                    startTimer(time, $('#countdown-cr-pre-order'));
    }

    function currentPreOrderedRender(id, avatar, name, total_price, duration, s) {
        $('#current-no').empty();
        $('#current-order').append(`
                <div class="flex flex-col gap-1 mt-2 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">
                    <div class="flex flex-row gap-5">
                        <div class="pt-2">
                                <img id="avatar-rent" class="rounded-full w-16 h-16" src="${avatar}"
                            alt="ps" class="avt-1-15 avt-img">
                        </div>

                        <div class="text-black flex flex-col items-start">
                            <div class="font-bold">Pre-order</div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$ ${total_price}</div>
                            <div id='time-rent'>${duration} hour</div>
                        </div>
                    </div>
                    <div id="countdown-cr-pre-ordered" >00:00:00</div>
                    <div class="flex justify-center items-center">
                        <form method="post" action="{{ route('pre-order.end') }}">
                            @csrf
                            <input id="end-id" type="hidden" name="id" value="${id}">
                            <button class="text-white bg-red-500 px-1 rounded-md">
                                {{ __('Cancel') }}
                            </button>
                        </form>
                    </div>

                </div>
                    `);
                    var time = s;
                    startTimer(time, $('#countdown-cr-pre-ordered'));
    }

    function startTimer(duration, display) {
        var timer = duration, hours, minutes, seconds;
        setInterval(function () {
            hours = parseInt(timer / 60 / 60, 10);
            minutes = parseInt(timer / 60 % 60, 10);
            seconds = parseInt(timer % 60, 10);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(hours + ":" + minutes + ":" + seconds);

            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }
</script>
