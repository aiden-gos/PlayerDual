<x-modal name="rank-modal" focusable>
    <div class="p-6 space-y-6">
        <h2 class="text-lg">{{ __('Rank') }}</h2>
        <div id="contain">
        </div>
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
<script>
    $.ajax({
        url: "{{ route('rank.income') }}",
        type: 'GET',
        success: function(result) {
            console.log(result);
            result.forEach((element, index) => {
                $('#contain').append(`
                    <div class="flex flex-row justify-between py-2">
                        <div class="flex flex-row gap-5 items-center">
                            <div class="w-5">#${index + 01}</div>
                            <img class="rounded-[50%]" src="${element.avatar}" alt="" height="50" width="50">
                            <div>${element.name}</div>
                        </div>
                        <div>$${element.income}</div>
                    </div>
                `);
            });
        }
    });
</script>
