<div class="flex flex-col min-h-[700px]">
    <div class="flex flex-row w-full">
        <div
            class="py-2 px-4 bg-gray-100 border text-gray-900 inline-flex border-b-2 border-rose-500 items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
            Current order
        </div>
    </div>
    <div id="current-order" class="mb-10 p-2 overflow-auto text-center text-gray-500 ">
        No order
    </div>

    <div class="flex flex-row ">
        <div
            class="py-2 px-4 bg-gray-100 border text-gray-900 inline-flex border-b-2 border-rose-500 items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
            Request
        </div>
    </div>
    <a href="/rent/listRequest" class="text-rose-500 w-full text-end">view all</a>
    <div id="request" class="p-2 overflow-auto text-center text-gray-500 ">
        No request
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
                        data.renting.duration);
                }

                if (data.rented && !data.renting) {
                    currentOrderedRender(data.rented.id, data.rented.ordering_user.avatar,
                        data.rented.ordering_user.name, data.rented.total_price,
                        data.rented.duration);
                }

                if (data.renting && data.rented) {
                    currentOrderRender(data.renting.id, data.renting.ordered_user.avatar,
                        data.renting.ordered_user.name, data.renting.total_price,
                        data.renting.duration);
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
                        data.renting.duration);
                }

                if (data.rented) {
                    currentPreOrderedRender(data.rented.id, data.rented.ordering_user.avatar,
                        data.rented.ordering_user.name, data.rented.total_price,
                        data.rented.duration);
                }
            }
        });
    }

    function requestRenderRenting(id, avatar, name, total_price, duration) {
        $('#request').empty();
        $('#request').append(`
                        <div class="flex flex-col items-start gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">

                            <div class="flex flex-row gap-5">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div>
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
        $('#request').empty();
        $('#request').append(`
                        <div class="flex flex-col items-start gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">

                            <div class="flex flex-row gap-5">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div>
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

    function currentOrderRender(id, avatar, name, total_price, duration) {
        $('#current-order').empty();
        $('#current-order').append(`
                        <div class="flex flex-col gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">

                            <div class="flex flex-row justify-start gap-5 w-full">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div>
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>
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
    }

    function currentOrderedRender(id, avatar, name, total_price, duration) {
        $('#current-order').empty();
        $('#current-order').append(`
                        <div class="flex flex-col gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">

                            <div class="flex flex-row justify-start gap-5 w-full">
                                <div class="pt-2">
                                    <img id="avatar-rent" class="rounded-full w-16 h-16"
                                        src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                                </div>
                                <div>
                                    <div id='name-rent' class="font-bold">${name}</div>
                                    <div id='cost-rent'>$${total_price}</div>
                                    <div i='time-rent'>${duration} hour</div>
                                </div>
                            </div>
                        </div>
                    `);
    }

    //Pre-order

    function requestRenderRentingPreOrder(id, avatar, name, total_price, duration) {
        $('#request').empty();
        $('#request').append(`
                <div class="flex flex-row items-center gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                    <div class="flex flex-row gap-5">
                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full w-16 h-16"
                                src="${avatar}" alt="ps" class="avt-1-15 avt-img">
                        </div>

                        <div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$ ${total_price}</div>
                            <div i='time-rent'>${duration} hour</div>
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
                    </div>
                    `);
    }

    function requestRenderRentedPreOrder(id, avatar, name, total_price, duration) {
        $('#request').empty();
        $('#request').append(`
                        <div class="flex flex-row items-center gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full w-16 h-16"
                                src="${avatar}" alt="ps">
                        </div>
                        <div class="flex flex-row gap-5">
                            <div>
                                <div id='name-rent' class="font-bold">${name}</div>
                                <div id='cost-rent'>$ ${total_price}</div>
                                <div i='time-rent'>${duration} hour</div>
                            </div>

                            <div class="flex justify-center items-center">
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
                        </div></div>
        `);
    }

    function currentPreOrderRender(id, avatar, name, total_price, duration) {
        $('#current-order').empty();
        $('#current-order').append(`
                        <div class="flex flex-col gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">
                    <div class="flex flex-row gap-5 justify-start w-full">

                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full w-16 h-16" src="${avatar}"
                            alt="ps" class="avt-1-15 avt-img">
                        </div>
                        <div>
                            <div class="font-bold">Pre-order</div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$ ${total_price}</div>
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
                    </div>
                    `);
    }

    function currentPreOrderedRender(id, avatar, name, total_price, duration) {
        $('#current-order').empty();
        $('#current-order').append(`
                        <div class="flex flex-col gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 mt-1">
                    <div class="flex flex-row gap-5">
                           <div class="pt-2">
                        <img id="avatar-rent" class="rounded-full w-16 h-16" src="${avatar}"
                            alt="ps" class="avt-1-15 avt-img">
                    </div>

                        <div>
                            <div class="font-bold">Pre-order</div>
                            <div id='name-rent' class="font-bold">${name}</div>
                            <div id='cost-rent'>$ ${total_price}</div>
                            <div id='time-rent'>${duration} hour</div>
                        </div></div>

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
    }

</script>
