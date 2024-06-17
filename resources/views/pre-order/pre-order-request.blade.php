@auth
<button id="pre-order-btn" class="hidden" x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'pre-order-modal')"
    class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
</button>

<x-modal name="pre-order-modal" focusable>
    <div class="p-6">
        @csrf

        <h2 id="title-pre-order" class="text-lg font-medium text-gray-900">
            Pre-order Player
        </h2>

        <p class="mt-1 text-sm text-gray-600">
           Deposit money into your account. Please enter the amount you want to deposit.
        </p>
        <br><hr><br>
        <div class="flex flex-row gap-5 items-center">
            <div class="pt-2">
                <img id="avatar-pre-order" class="rounded-full" width="100" height="100" class="avt-1-15 avt-img">
            </div>
            <div>
                <div>
                    <p id='name-pre-order' class="font-bold"></p>
                    <p id='cost-pre-order'>$0</p>
                    <p id='time-pre-order'>4 hour</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
        <form method="post" action="{{ route('pre-order.reject') }}">
            @csrf
            <input id="accept-id-pre-order" type="hidden" name="id">
            <x-danger-button x-on:click="$dispatch('close')">
                {{ __('Reject') }}
            </x-secondary-button>
        </form>

        <form method="post" action="{{ route('pre-order.accept') }}">
            @csrf
            <input id="reject-id-pre-order" type="hidden" name="id">
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
    var channel = pusher.subscribe('{{Auth::user()->id}}-pre-order');
    channel.bind("App\\Events\\EventActionNotify", function(data) {

        var preOrder = data.message.preOrder;
        console.log(preOrder.total_price);
        var user = data.message.user;
        console.log(user.name);

        $('#accept-id-pre-order').val(preOrder.id);
        $('#reject-id-pre-order').val(preOrder.id);

        $('#name-pre-order').text(user.name);
        $('#time-pre-order').text(preOrder.duration + " hour");
        $('#cost-pre-order').text("$ " + preOrder.total_price);
        $('#avatar-pre-order').attr('src', user.avatar);

        $("#pre-order-btn").click();
    });

    $('#chat').click(function() {
        $("#pre-order-btn").click();
    })

</script>
@endauth
