<button id="order-btn" class="hidden" x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'order-modal')"
    class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
</button>

<x-modal name="order-modal" focusable>
    <div class="p-6">
        @csrf

        <h2 id="title-rent" class="text-lg font-medium text-gray-900">
            Rent Rent Rent Rent
        </h2>

        <p class="mt-1 text-sm text-gray-600">
           Deposit money into your account. Please enter the amount you want to deposit.
        </p>
        <br><hr><br>
        <div class="flex flex-row gap-5 items-center">
            <div class="pt-2">
                <img id="avatar-rent" class="rounded-[50%]" width="100" height="100" class="avt-1-15 avt-img">
            </div>
            <div>
                <div>
                    <p id='name-rent' class="font-bold"></p>
                    <p id='cost-rent'>$0</p>
                    <p i='time-rent'>4 hour</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
        <form method="post" action="{{ route('rent.reject') }}">
            @csrf
            <input id="accept-id" type="hidden" name="id">
            <x-danger-button x-on:click="$dispatch('close')">
                {{ __('Reject') }}
            </x-secondary-button>
        </form>

        <form method="post" action="{{ route('rent.accept') }}">
            @csrf
            <input id="reject-id" type="hidden" name="id">
            <x-primary-button class="ml-3">
                {{ __('Accept') }}
            </x-primary-button>
        </form>

        </div>
    </div>
</x-modal>

<script type="module">

    const key = "{{env('VITE_PUSHER_APP_KEY')}}";
    const cluster =  "{{env('VITE_PUSHER_APP_CLUSTER')}}";

    var pusher = new Pusher(key, {
        cluster: cluster
    });

    var channel = pusher.subscribe('{{Auth::user()->id}}-rent');
    channel.bind("App\\Events\\EventActionNotify", function(data) {
        console.log(data.message);
        var order = data.message.order;
        var user = data.message.user;
        $('#accept-id').val(order.id);
        $('#reject-id').val(order.id);

        $('#name-rent').text(user.name);
        $('#time-rent').text(order.duration + "hour");
        $('#cost-rent').text("$" + order.total_price);
        $('#avatar-rent').attr('src', user.avatar);

        $("#order-btn").click();
    });

    $('#chat').click(function() {
        $("#order-btn").click();
    })


</script>
