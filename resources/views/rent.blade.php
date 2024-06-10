@auth
@if(!$orderConflict)
<button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'Rent-form')"
    class="bg-black text-white w-full py-3 rounded-md max-w-64" >

    @if(Auth::user()->id == $user->id)
        Offline
    @else
        Rent
    @endif

</button>
@else
<button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'Rent-form')"
    class="bg-gray-300 text-white w-full py-3 rounded-md max-w-64" disabled>Rent</button>
@endif

<x-modal name="Rent-form" focusable>
    <style>label.error{color: red}</style>
    <form id="Rent" method="post"
    @if(Auth::user()->id != $user->id)
     action="{{ route('rent') }}"
    @else
        action="{{ route('off') }}"
    @endif
     class="p-6 space-y-6">
        @csrf

        <div>
            <h2 class="text-lg font-medium text-gray-900 text-3xl">
    @if(Auth::user()->id == $user->id)

                {{ __('Offline') }}
    @else
                {{ __('Rent player') }}
    @endif
            </h2>
        </div>
        <input type="hidden" name="user_id" value="{{$user->id}}">

        @if(Auth::user()->id != $user->id)
        <div class="flex flex-row items-center">
            <div class="w-full">
                <x-input-label for="name" :value="__('Player')" />
            </div>
            <div class="w-full">
                <div>{{$user->name}}</div>
            </div>
        </div>
        <hr>
        <div class="flex flex-row items-center">
            <div class="w-full">
                <x-input-label for="name" :value="__('Balance')" />
            </div>
            <div class="w-full">
                <div>${{Auth::user()->balance}}</div>
            </div>
        </div>
        <hr>
        @endif

        <div class="flex flex-row items-center">
        @if(Auth::user()->id != $user->id)
            <x-input-label class="w-full" for="time" :value="__('Time to rent')" />
        @else
            <x-input-label class="w-full" for="time" :value="__('Off time')" />
        @endif
            <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="time" id="time">
                <option value="1">1 hour</option>
                <option value="2">2 hour</option>
                <option value="3">3 hour</option>
                <option value="4">4 hour</option>
                <option value="4">4 hour</option>
                <option value="5">5 hour</option>
                <option value="6">6 hour</option>
                <option value="7">7 hour</option>
                <option value="8">8 hour</option>
                <option value="9">9 hour</option>
                <option value="10">10 hour</option>
                <option value="11">11 hour</option>
                <option value="12">12 hour</option>
                <option value="13">13 hour</option>
                <option value="14">14 hour</option>
                <option value="15">15 hour</option>
                <option value="16">16 hour</option>
                <option value="17">17 hour</option>
                <option value="18">18 hour</option>
                <option value="19">19 hour</option>
                <option value="20">20 hour</option>
                <option value="21">21 hour</option>
                <option value="22">22 hour</option>
                <option value="23">23 hour</option>
                <option value="24">24 hour</option>
            </select>
        </div>

        @if(Auth::user()->id != $user->id)
        <div class="flex flex-row items-center">
            <div class="w-full">
                <x-input-label for="" :value="__('Cost')" />
            </div>
            <div class="w-full flex flex-col">
                <input id="cost" name="cost" type="number" readonly="readonly"  class="border-0"/>
            </div>
        </div>

        <div>
            <x-input-label for="msg" :value="__('Message')" />
            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" name="msg" id="msg" cols="65" rows="10"></textarea>
        </div>
        @endif

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ml-3">
        @if(Auth::user()->id != $user->id)
                {{ __('Rent') }}
        @else
                {{ __('Off') }}
        @endif
            </x-primary-button>
        </div>
    </form>
</x-modal>
<script>

    updateCost()
    $('#time').on('change',function () {
        updateCost()
    })

    function updateCost() {
        cost = $('#time').val() * {{$user->price}};
        $('#cost').val(cost);
    }
</script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $("#Rent").validate({
        ignore:[],
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"cost": {
				required: true,
                min:0,
                max:{{Auth::user()->balance}}
			}
		}
	});
</script>
@else
    <a class="bg-black text-white w-full py-3 rounded-md max-w-64 text-center" href="{{route('login')}}">Rent</a>
@endauth
