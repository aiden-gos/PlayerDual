<x-modal name="rank-modal" focusable>
    <div class="p-2">

        {{-- Tab  --}}
        <div x-data="{ parentTab: 'vip_top', childTab: 'today', income1: [], income2: [], income3: [], outcome1: [], outcome2: [], outcome3: [] }" class="flex flex-col min-h-96">
            <!-- Child Tabs (Son Tabs) -->
            <div class="border-b border-gray-200">
                <!-- VIP Top Child Tabs -->
                <div class="flex justify-center">
                    <!-- Today -->
                    <button @click="childTab = 'today'"
                        :class="{ 'bg-gray-100': childTab === 'today', 'text-gray-900': childTab === 'today', 'border-b-2 border-rose-500': childTab === 'today' }"
                        class="w-full flex justify-center py-2 px-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                        Today
                    </button>

                    <!-- Last 7 Days -->
                    <button @click="childTab = 'last_7_days'"
                        :class="{ 'bg-gray-100': childTab === 'last_7_days', 'text-gray-900': childTab === 'last_7_days', 'border-b-2 border-rose-500': childTab === 'last_7_days' }"
                        class="w-full flex justify-center py-2 px-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                        Last 7 Days
                    </button>

                    <!-- Last 30 Days -->
                    <button @click="childTab = 'last_30_days'"
                        :class="{ 'bg-gray-100': childTab === 'last_30_days', 'text-gray-900': childTab === 'last_30_days', 'border-b-2 border-rose-500': childTab === 'last_30_days' }"
                        class="w-full flex justify-center py-2 px-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                        Last 30 Days
                    </button>
                </div>
            </div>

            <!-- Content Based on Parent and Child Tabs -->
            <div class="p-4">
                <div x-show="parentTab === 'vip_top'">
                    <!-- Show VIP Top - Today Content -->
                    <div x-show="childTab === 'today'"
                        x-on:open-modal.window.once="() => {
                        axios.get('{{ route('rank.outcome', 1) }}')
                            .then(response => {
                                outcome1 = response.data;
                            });
                    }">
                        <template x-for="(item, index) in outcome1" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Show VIP Top - Last 7 Days Content -->
                    <div x-show="childTab === 'last_7_days'"
                        x-on:open-modal.window.once="() => {
                        axios.get('{{ route('rank.outcome', 7) }}')
                            .then(response => {
                                outcome2 = response.data;
                            });
                    }">
                        <template x-for="(item, index) in outcome2" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Show VIP Top - Last 30 Days Content -->
                    <div x-show="childTab === 'last_30_days'"
                        x-on:open-modal.window.once="() => {
                        axios.get('{{ route('rank.outcome', 30) }}')
                            .then(response => {
                                outcome3 = response.data;
                            });
                    }">
                        <template x-for="(item, index) in outcome3" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="parentTab === 'income_top'"
                    x-on:open-modal.window.once="() => {
                    axios.get('{{ route('rank.income', 1) }}')
                        .then(response =>
                            income1 = response.data;
                        });
                }">
                    <!-- Show Income Top - Today Content -->
                    <div x-show="childTab === 'today'">
                        <template x-for="(item, index) in income1" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Show Income Top - Last 7 Days Content -->
                    <div x-show="childTab === 'last_7_days'"
                        x-on:open-modal.window.once="() => {
                        axios.get('{{ route('rank.income', 7) }}')
                            .then(response => {
                                income2 = response.data;
                            });
                    }">
                        <template x-for="(item, index) in income2" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Show Income Top - Last 30 Days Content -->
                    <div x-show="childTab === 'last_30_days'"
                        x-on:open-modal.window.once="() => {
                        axios.get('{{ route('rank.income', 30) }}')
                            .then(response => {
                                income3 = response.data;
                            });
                    }">
                        <template x-for="(item, index) in income3" :key="index">
                            <div class="flex flex-row justify-between py-2">
                                <div class="flex flex-row gap-5 items-center">
                                    <div class="w-5" x-text="'#' + (index+1)"></div>
                                    <img class="rounded-full object-cover h-12 w-12" :src="item.avatar" alt="User Avatar">
                                    <div x-text="item.name"></div>
                                </div>
                                <div x-text="'$' + item.price_all"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <!-- Parent Tabs (Top Tabs) -->
            <div class="mt-auto border-t border-gray-200 flex flex-row ">
                <!-- VIP Top Parent Tab -->
                <button @click="parentTab = 'vip_top'; childTab = 'today'"
                    :class="{ 'bg-gray-100': parentTab === 'vip_top', 'text-gray-900': parentTab === 'vip_top', 'border-b-2 border-rose-500': parentTab === 'vip_top' }"
                    class="py-2 px-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
                    VIP Top
                </button>

                <!-- Income Top Parent Tab -->
                <button @click="parentTab = 'income_top'; childTab = 'today'"
                    :class="{ 'bg-gray-100': parentTab === 'income_top', 'text-gray-900': parentTab === 'income_top', 'border-b-2 border-rose-500': parentTab === 'income_top' }"
                    class="py-2 px-4 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none w-full flex justify-center">
                    Income Top
                </button>
            </div>
        </div>
        {{-- Tab  --}}

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
{{-- <script>
    $.ajax({
        url: "{{ route('rank.income') }}",
        type: 'GET',
        success: function(result) {
            result.forEach((element, index) => {
                $('#contain').append(`
                    <div class="flex flex-row justify-between py-2">
                        <div class="flex flex-row gap-5 items-center">
                            <div class="w-5">#${index + 01}</div>
                            <img class="rounded-full" src="${element.avatar}" alt="" height="50">
                            <div>${element.name}</div>
                        </div>
                        <div>$${element.amount_price}</div>
                    </div>
                `);
            });
        }
    });
</script> --}}
