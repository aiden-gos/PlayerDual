@auth
<?php
    $renting_pending = App\Models\Order::select(['orders.*','users.name', 'users.avatar'])
            ->where('ordering_user_id',Auth::user()->id)
            ->where('orders.status', 'pre-ordering')
            ->join('users','ordered_user_id','users.id')
            ->first();

    $rented_pending = App\Models\Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordered_user_id',Auth::user()->id)
            ->where('orders.status', 'pre-ordering')
            ->join('users','ordering_user_id','users.id')
            ->first();
?>

@if($renting_pending || $rented_pending)
<div class="">
    <div class="backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 flex flex-row items-center gap-5">
        @if($renting_pending)
            <div class="pt-2">
                <img id="avatar-rent" class="rounded-[50%]" width="70" height="70" src="{{$renting_pending->avatar}}" alt="ps" class="avt-1-15 avt-img">
            </div>
            <div class="flex flex-row gap-5">
                <div>
                    <div id='name-rent' class="font-bold">{{$renting_pending->name}}</div>
                    <div id='cost-rent'>${{$renting_pending->total_price}}</div>
                    <div i='time-rent'>{{$renting_pending->duration}} hour</div>
                </div>

                <div id="cancel-form" class="flex justify-center items-center">
                    <form method="post" action="{{ route('pre-order.end') }}">
                        @csrf
                        <input id="end-id" type="hidden" name="id" value="{{$renting_pending->id}}">
                        <x-primary-button class="ml-3">
                            {{ __('Cancel') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        @endif

        @if($rented_pending)
        <div class="pt-2">
            <img id="avatar-rent" class="rounded-[50%]" width="70" height="70" src="{{$rented_pending->avatar}}" alt="ps" class="avt-1-15 avt-img">
        </div>
        <div class="flex flex-row gap-5">
            <div>
                <div id='name-rent' class="font-bold">{{$rented_pending->name}}</div>
                <div id='cost-rent'>${{$rented_pending->total_price}}</div>
                <div i='time-rent'>{{$rented_pending->duration}} hour</div>
            </div>

            <div class="flex justify-center items-center">
                <form method="post" action="{{ route('pre-order.reject') }}">
                    @csrf
                    <input id="accept-id" type="hidden" name="id" value="{{$rented_pending->id}}">
                    <x-danger-button x-on:click="$dispatch('close')">
                        {{ __('Reject') }}
                    </x-secondary-button>
                </form>

                <form method="post" action="{{ route('pre-order.accept') }}">
                    @csrf
                    <input id="reject-id" type="hidden" name="id" value="{{$rented_pending->id}}">
                    <x-primary-button class="ml-3">
                        {{ __('Accept') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
<script type="module">

    const key = "{{env('VITE_PUSHER_APP_KEY')}}";
    const cluster =  "{{env('VITE_PUSHER_APP_CLUSTER')}}";

    var pusher = new Pusher(key, {
        cluster: cluster
    });

    var channel = pusher.subscribe('{{Auth::user()->id}}-pre-order-request');
        channel.bind("App\\Events\\EventActionNotify", function(data) {
            console.log(data.message.order);
            if(data.message.order.status == 'rejected'){
                $('#cancel-form').empty();
                $('#cancel-form').append("The request had been rejected");
            }else{
                location.reload();
            }
        });
</script>
@endif
@endauth

