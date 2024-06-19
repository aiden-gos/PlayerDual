@auth
<?php
    $renting = App\Models\Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordering_user_id',Auth::user()->id)
            ->where('orders.status', 'accepted')
            ->whereRaw('DATE_ADD(orders.updated_at, INTERVAL orders.duration HOUR) > NOW()')
            ->join('users','ordered_user_id','users.id')
            ->first();

    $rented = App\Models\Order::select(['orders.*', 'users.id', 'users.name', 'users.avatar'])
            ->where('ordered_user_id',Auth::user()->id)
            ->where('orders.status', 'accepted')
            ->whereRaw('DATE_ADD(orders.updated_at, INTERVAL orders.duration HOUR) > NOW()')
            ->join('users','ordering_user_id','users.id')
            ->first();

    $time = 0;
    $duration = 0;

    if($renting){
        $time = $renting->start_at;
        $duration = $renting->duration;
    }else if($rented){
        $time = $rented->start_at;
        $duration = $rented->duration;
    }

    $time = strtotime($time.' +'. $duration .' hour');
    $currentTime = time();
    $remainingTime = $time - $currentTime;

?>

@if($renting || $rented)
<div class="">
    <div class="backdrop-blur-3xl bg-rose-500/20 rounded-2xl p-2 px-5 flex flex-row items-center gap-5">
        @if($renting && !$rented)
            <div class="pt-2">
                <img id="avatar-rent" class="rounded-full" width="70" height="70" src="{{$renting->avatar ?? ""}}" alt="ps" class="avt-1-15 avt-img">
            </div>
            <div class="flex flex-row gap-5">
                <div>
                    <div id='name-rent' class="font-bold">{{$renting->name}}</div>
                    <div id='cost-rent'>${{$renting->total_price}}</div>
                    <div i='time-rent'>{{$renting->duration}} hour</div>
                </div>
                <div id="countdown" class="w-20 text-center content-center">00:00:00</div>
                <div class="flex justify-center items-center">
                    <form method="post" action="{{ route('rent.end') }}">
                        @csrf
                        <input id="end-id" type="hidden" name="id" value="{{$renting->id}}">
                        <x-primary-button class="ml-3">
                            {{ __('end') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        @endif

        @if($rented && !$renting)
        <div class="pt-2">
            <img id="avatar-rent" class="rounded-full" width="70" height="70" src="{{$rented->avatar}}" alt="ps" class="avt-1-15 avt-img">
        </div>
        <div class="flex flex-row gap-5">
            <div>
                <div id='name-rent' class="font-bold">{{$rented->name}}</div>
                <div id='cost-rent'>${{$rented->total_price}}</div>
                <div i='time-rent'>{{$rented->duration}} hour</div>
            </div>
            <div id="countdown" class="w-20 text-center content-center">00:00:00</div>
        </div>
        @endif

        @if($renting && $rented)
            <div class="pt-2">
                <img id="avatar-rent" class="rounded-full" width="70" height="70" src="{{$renting->avatar}}" alt="ps" class="avt-1-15 avt-img">
            </div>
            <div class="flex flex-row gap-5">
                <div>
                    <div class="font-bold">Off time</div>
                    <div i='time-rent'>{{$renting->duration}} hour</div>
                    <div id="countdown" class="w-20">00:00:00</div>
                </div>

                <div class="flex justify-center items-center">
                    <form method="post" action="{{ route('rent.end') }}">
                        @csrf
                        <input id="end-id" type="hidden" name="id" value="{{$renting->id}}">
                        <x-primary-button class="ml-3">
                            {{ __('Stop') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
<script>
var time = '{{$remainingTime}}'
startTimer(time, $('#countdown'));

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
@endif

{{-- Listening End Rent event --}}
<script type="module">

    const key = "{{env('VITE_PUSHER_APP_KEY')}}";
    const cluster =  "{{env('VITE_PUSHER_APP_CLUSTER')}}";

    var pusher = new Pusher(key, {
        cluster: cluster
    });

    var channel = pusher.subscribe('{{Auth::user()->id}}-rent-request');
        channel.bind("App\\Events\\EventActionNotify", function(data) {
            if(data.message.order.status == 'rejected'){
                $('#cancel-form').empty();
                $('#cancel-form').append("The request had been rejected");
            }else{
                location.reload();
            }
        });
</script>
{{--  --}}
@endauth
