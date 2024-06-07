 {{-- Notification --}}
 <x-dropdown align="right" width="60">
    <x-slot name="trigger">
        <button id="btn-noti" class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <div class="ml-1">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                    <defs><linearGradient x1="24" y1="1.993" x2="24" y2="7.005" gradientUnits="userSpaceOnUse" id="color-1_z8yqcMdq4T2h_gr1"><stop offset="0" stop-color="#fede00" stop-opacity="0.72157"></stop><stop offset="1" stop-color="#ffd000"></stop></linearGradient><linearGradient x1="24" y1="33.993" x2="24" y2="39.005" gradientUnits="userSpaceOnUse" id="color-2_z8yqcMdq4T2h_gr2"><stop offset="0" stop-color="#fede00" stop-opacity="0.72157"></stop><stop offset="1" stop-color="#ffd000"></stop></linearGradient><linearGradient x1="24" y1="42.919" x2="24" y2="38.859" gradientUnits="userSpaceOnUse" id="color-3_z8yqcMdq4T2h_gr3"><stop offset="0.486" stop-color="#fbc300"></stop><stop offset="1" stop-color="#dbaa00"></stop></linearGradient><linearGradient x1="3.1893" y1="3.1705" x2="17.1588" y2="17.14" gradientUnits="userSpaceOnUse" id="color-4_z8yqcMdq4T2h_gr4"><stop offset="0" stop-color="#f44f5a"></stop><stop offset="0.4429" stop-color="#ee3d4a"></stop><stop offset="1" stop-color="#e52030"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M27,7h-6v-2c0,-1.657 1.343,-3 3,-3v0c1.657,0 3,1.343 3,3z" fill="url(#color-1_z8yqcMdq4T2h_gr1)"></path><path d="M39,21c0,-8.284 -6.716,-15 -15,-15c-8.284,0 -15,6.716 -15,15c0,0.39 0,13 0,13h30c0,0 0,-12.61 0,-13z" fill="#f5be00"></path><path d="M39,34h-30l-3.875,1.55c-0.68,0.272 -1.125,0.93 -1.125,1.661v0c0,0.988 0.801,1.789 1.789,1.789h36.422c0.988,0 1.789,-0.801 1.789,-1.789v0c0,-0.731 -0.445,-1.389 -1.125,-1.661z" fill="url(#color-2_z8yqcMdq4T2h_gr2)"></path><path d="M28,39c0,2.209 -1.791,4 -4,4c-2.209,0 -4,-1.791 -4,-4z" fill="url(#color-3_z8yqcMdq4T2h_gr3)"></path></g></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                        <g class="active-noti hidden" transform="translate(138.66667,10.66667) scale(5.33333,5.33333)" id="overlay">
                        <path d="M20,10c0,5.5 -4.5,10 -10,10c-5.5,0 -10,-4.5 -10,-10c0,-5.5 4.5,-10 10,-10c5.5,0 10,4.4 10,10" fill="url(#color-4_z8yqcMdq4T2h_gr4)"></path><g fill="#ffffff"><path d="M10.008,15.8c-0.439,0 -0.802,-0.133 -1.087,-0.399c-0.286,-0.266 -0.428,-0.589 -0.428,-0.968c0,-0.395 0.144,-0.719 0.432,-0.972c0.288,-0.253 0.649,-0.379 1.083,-0.379c0.439,0 0.799,0.128 1.079,0.383c0.28,0.255 0.42,0.578 0.42,0.968c0,0.395 -0.139,0.722 -0.416,0.98c-0.277,0.258 -0.638,0.387 -1.083,0.387zM11.342,4.233l-0.288,7.305c-0.009,0.223 -0.192,0.4 -0.416,0.4h-1.308c-0.224,0 -0.408,-0.177 -0.416,-0.401l-0.273,-7.305c-0.009,-0.236 0.18,-0.432 0.416,-0.432h1.869c0.236,0 0.425,0.196 0.416,0.433z"></path>
                        </g>
                    </g></g>
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <div class="notification-content">
        @forelse (Auth::user()->notifications()->take(15)->get() as $noti)
            <x-dropdown-link class="h-12 flex items-center border-b">
                <div>{{$noti->data[0]}}</div>
            </x-dropdown-link>
        @empty
            <x-dropdown-link class="no-noc h-12">
                Not found notification
            </x-dropdown-link>
        @endforelse
            <div>
                <input id="noti-user-id" type="hidden">
                <button class="text-center w-full">
                    {{ __('Read all') }}
                </button>
            </div>
        </div>
    </x-slot>
</x-dropdown>
{{-- Notification --}}


@if (Route::has('login'))
@auth
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script type="module">
    // Pusher.logToConsole = true;
    const key = "{{env('VITE_PUSHER_APP_KEY')}}";
    const cluster =  "{{env('VITE_PUSHER_APP_CLUSTER')}}";

    var pusher = new Pusher(key, {
        cluster: cluster
    });

    var channel = pusher.subscribe('{{Auth::user()->id}}');
    channel.bind("App\\Events\\EventActionNotify", function(data) {
        console.log(data.message);
        $('.notification-content').prepend(`
        <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            ${data.message}
        </a>
        `)
        $('.active-noti').show()
        $('.no-noc').hide()
    });

    $('#btn-noti').click(function() {
        $('.active-noti').hide()
    })

</script>
@endauth
@endif

<script>
    var id =$('#noti-user-id').val();
    $.ajax(
            {
                url: "{{route('home.search')}}",
                type: 'GET',
                data:{
                        "user_id": id,
                    } ,
                success: function(result){

                }
            }
        );
</script>
