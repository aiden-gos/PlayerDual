<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-gray-100 fixed h-screen w-60 shadow flex flex-col gap-4 p-4 pt-20">
            <div class="text-xl">
                {{ __('Player Request') }}
            </div>

            <x-nav-link :href="route('rent.list.request')" :active="request()->routeIs('rent.list.request')">
                {{ __('All') }}
            </x-nav-link>
        </div>
    </x-slot>
    <div class="py-5 bg-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col gap-5 w-full justify-between">
                        {{-- User follwing --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table x-init="getOrderRequestList(), getPreOrderRequestList()"
                                class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 ">
                                            Player name
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Duraction
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Amount of money
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Message
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id='table-content'>

                                </tbody>
                            </table>
                        </div>
                        <div class="py-5 px-20 ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getOrderRequestList() {
            $.ajax({
                url: '{{ route('rent.request') }}',
                type: 'GET',
                success: function(data) {

                    if (data.renting_pending) {
                        requestRenderRentingList(data.renting_pending.id, data.renting_pending.ordered_user
                            .avatar,
                            data.renting_pending.ordered_user.name, data.renting_pending.total_price,
                            data.renting_pending.duration,data.renting_pending.message);
                    }

                    if (data.rented_pending.length > 0) {
                        data.rented_pending.forEach(element => {
                            requestRenderRentedList(element.id, element.ordering_user.avatar,
                                element.ordering_user.name, element.total_price,
                                element.duration,element.message);
                        });
                    }
                }
            });
        }

        function getPreOrderRequestList() {
            $.ajax({
                url: '{{ route('pre-order.request') }}',
                type: 'GET',
                success: function(data) {

                    if (data.renting_pending) {
                        requestRenderRentingPreOrderList(data.renting_pending.id, data.renting_pending
                            .ordered_user.avatar,
                            data.renting_pending.ordered_user.name, data.renting_pending.total_price,
                            data.renting_pending.duration, data.renting_pending.message);
                    }

                    if (data.rented_pending.length > 0) {
                        data.rented_pending.forEach(element => {
                            requestRenderRentedPreOrderList(element.id, element.ordering_user.avatar,
                                element.ordering_user.name, element.total_price,
                                element.duration,element.message);
                        });
                    }
                }
            });
        }

        function requestRenderRentingList(id, avatar, name, total_price, duration, message) {
            $('#table-content').append(`
                        <tr
                            class="bg-white border-b">
                            <td scope="row"
                                class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex flex-row gap-2 items-center">
                                <img src="${avatar}" class="w-12 h-12 object-cover rounded-full">
                                ${name}
                            </th>
                            <td class="px-6 py-4 ">
                                Rent
                            </td>
                            <td class="px-6 py-4 ">
                                ${duration} hour
                            </td>
                            <td class="px-6 py-4 ">
                                $${total_price}
                            </td>
                            <td class="px-6 py-4 ">
                                        ${message ? message : "No message"}
                            </td>
                            <td class="px-6 py-4 ">
                                <form method="post" action="{{ route('rent.end') }}">
                                        @csrf
                                        <input id="end-id" type="hidden" name="id" value="${id}">
                                        <button class="text-white bg-red-500 px-1 rounded-md">
                                            Cancel
                                        </button>
                                </form>
                            </td>
                        </tr>
                    `);
        }

        function requestRenderRentedList(id, avatar, name, total_price, duration, message) {
            $('#table-content').append(`
                        <tr
                            class="bg-white border-b">
                            <td scope="row"
                                class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex flex-row gap-2 items-center">
                                <img src="${avatar}" class="w-12 h-12 object-cover rounded-full">
                                ${name}
                            </th>
                            <td class="px-6 py-4 ">
                                Rent
                            </td>
                            <td class="px-6 py-4 ">
                                ${duration} hour
                            </td>
                            <td class="px-6 py-4 ">
                               $${total_price}
                            </td>
                            <td class="px-6 py-4 ">
                                ${message ? message : "No message"}
                            </td>
                            <td class="px-6 py-4 ">
                                <div class="flex flex-row gap-2 items-center">
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
                            </td>
                        </tr>
        `);
        }

        function requestRenderRentingPreOrderList(id, avatar, name, total_price, duration, message) {
            $('#table-content').append(`
                <tr
                    class="bg-white border-b">
                    <td scope="row"
                        class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex flex-row gap-2 items-center">
                        <img src="${avatar}" class="w-12 h-12 object-cover rounded-full">
                        ${name}
                    </th>
                    <td class="px-6 py-4 ">
                        Pre-order
                    </td>
                    <td class="px-6 py-4 ">
                        ${duration} hour
                    </td>
                    <td class="px-6 py-4 ">
                       $${total_price}
                    </td>
                    <td class="px-6 py-4 ">
                                ${message ? message : "No message"}
                    </td>
                    <td class="px-6 py-4 ">
                        <form method="post" action="{{ route('pre-order.end') }}">
                        @csrf
                        <input id="end-id" type="hidden" name="id" value="${id}">
                        <button class="text-white bg-red-500 px-1 rounded-md">
                            {{ __('Cancel') }}
                        </button>
                    </form>
                    </td>
                </tr>
            `);
        }

        function requestRenderRentedPreOrderList(id, avatar, name, total_price, duration, message) {
            $('#table-content').append(`
                        <tr
                            class="bg-white border-b">
                            <td scope="row"
                                class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex flex-row gap-2 items-center">
                                <img src="${avatar}" class="w-12 h-12 object-cover rounded-full">
                                ${name}
                            </th>
                            <td class="px-6 py-4 ">
                                Pre-order
                            </td>
                            <td class="px-6 py-4 ">
                                ${duration} hour
                            </td>
                            <td class="px-6 py-4 ">
                               $${total_price}
                            </td>
                            <td class="px-6 py-4 ">
                                ${message ? message : "No message"}
                            </td>
                            <td class="px-6 py-4 ">
                                <div class="flex flex-row gap-2 items-center">

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
                            </td>
                        </tr>
        `);
        }
    </script>
</x-app-layout>
