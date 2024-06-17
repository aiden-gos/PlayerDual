@auth
    <?php
    $renting_pending = App\Models\Order::select(['orders.*', 'users.name', 'users.avatar'])
        ->where('ordering_user_id', Auth::user()->id)
        ->where('orders.status', 'pre-ordering')
        ->join('users', 'ordered_user_id', 'users.id')
        ->first();

    $rented_pending = App\Models\Order::select(['orders.*', 'users.name', 'users.avatar'])
        ->where('ordered_user_id', Auth::user()->id)
        ->where('orders.status', 'pre-ordering')
        ->join('users', 'ordering_user_id', 'users.id')
        ->get();
    ?>

    @if ($renting_pending || $rented_pending)
        <div class="">
            <div class="gap-5 flex flex-col items-end justify-end overflow-auto max-h-[450px]">
                @if ($renting_pending)
                <div class="flex flex-row items-center gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                    <div class="pt-2">
                        <img id="avatar-rent" class="rounded-full" width="70" height="70"
                            src="{{ $renting_pending->avatar }}" alt="ps" class="avt-1-15 avt-img">
                    </div>
                    <div class="flex flex-row gap-5">
                        <div>
                            <div id='name-rent' class="font-bold">{{ $renting_pending->name }}</div>
                            <div id='cost-rent'>${{ $renting_pending->total_price }}</div>
                            <div i='time-rent'>{{ $renting_pending->duration }} hour</div>
                        </div>

                        <div id="cancel-form" class="flex justify-center items-center">
                            <form method="post" action="{{ route('pre-order.end') }}">
                                @csrf
                                <input id="end-id" type="hidden" name="id" value="{{ $renting_pending->id }}">
                                <x-primary-button class="ml-3">
                                    {{ __('Cancel') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </div></div>
                @endif

                @if (count($rented_pending) > 0)
                    @foreach ($rented_pending as $item)
                    <div class="flex flex-row items-center gap-5 backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 ">
                        <div class="pt-2">
                            <img id="avatar-rent" class="rounded-full" width="70" height="70"
                                src="{{ $item->avatar ?? "" }}" alt="ps" class="avt-1-15 avt-img">
                        </div>
                        <div class="flex flex-row gap-5">
                            <div>
                                <div id='name-rent' class="font-bold">{{ $item->name ?? '' }}</div>
                                <div id='cost-rent'>${{ $item->total_price ?? '' }}</div>
                                <div i='time-rent'>{{ $item->duration ?? '' }} hour</div>
                            </div>

                            <div class="flex justify-center items-center">
                                <form method="post" action="{{ route('pre-order.reject') }}">
                                    @csrf
                                    <input id="accept-id" type="hidden" name="id" value="{{ $item->id }}">
                                    <x-danger-button x-on:click="$dispatch('close')">
                                        {{ __('Reject') }}
                                        </x-secondary-button>
                                </form>

                                <form method="post" action="{{ route('pre-order.accept') }}">
                                    @csrf
                                    <input id="reject-id" type="hidden" name="id" value="{{ $item->id }}">
                                    <x-primary-button class="ml-3">
                                        {{ __('Accept') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div></div>
                    @endforeach
                @endif
            </div>
        </div>
        <script type="module">
            const key = "{{ env('VITE_PUSHER_APP_KEY') }}";
            const cluster = "{{ env('VITE_PUSHER_APP_CLUSTER') }}";

            var pusher = new Pusher(key, {
                cluster: cluster
            });

            var channel = pusher.subscribe('{{ Auth::user()->id }}-pre-order-request');
            channel.bind("App\\Events\\EventActionNotify", function(data) {
                console.log(data.message.order);
                if (data.message.order.status == 'rejected') {
                    $('#cancel-form').empty();
                    $('#cancel-form').append("The request had been rejected");
                } else {
                    location.reload();
                }
            });
        </script>
    @endif
@endauth
