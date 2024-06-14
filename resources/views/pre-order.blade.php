@auth
@if(!$preOrderStatus && $orderConflict && Auth::user()->id != $user->id)
<button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'Pre-order-form')"
    class="bg-red-600 text-white w-full py-3 rounded-md max-w-64" >
        Pre-order
</button>
@else
<button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'Pre-order-form')"
    class="bg-red-200 text-white w-full py-3 rounded-md max-w-64" disabled>Pre-order</button>
@endif

<x-modal name="Pre-order-form" focusable>
    <style>label.error{color: red}</style>
    <form id="PreOrder" method="post"
     action="{{ route('pre-order') }}"
     class="p-6 space-y-6">
        @csrf

        <div>
            <h2 class="text-lg font-medium text-gray-900 text-3xl">
                {{ __('Pre-order player') }}
            </h2>
        </div>
        <input type="hidden" name="user_id" value="{{$user->id}}">

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

        <div class="flex flex-row items-center">
            <x-input-label class="w-full" for="time-pre-order" :value="__('Time to Pre-order')" />
            <select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="time" id="timePreOrder">
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

        <div class="flex flex-row items-center">
            <div class="w-full">
                <x-input-label for="" :value="__('Cost')" />
            </div>
            <div class="w-full flex flex-col">
                <input id="costPreOrder" name="cost" type="number" readonly="readonly"  class="border-0"/>
            </div>
        </div>

        <div>
            <x-input-label for="msg" :value="__('Message')" />
            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" name="msg" id="msg" cols="65" rows="10"></textarea>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ml-3">
                {{ __('Pre-order') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
<script>
    updateCostPreOrder()
    $('#timePreOrder').on('change',function () {
        updateCostPreOrder()
    })

    function updateCostPreOrder() {
        cost = $('#timePreOrder').val() * {{$user->price}};
        $('#costPreOrder').val(cost);

    }
</script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $("#PreOrder").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"cost": {
				required: true,
                max:{{Auth::user()->balance}}
			}
		}
	});
</script>
@else
    <a class="bg-red-600 text-white w-full py-3 rounded-md max-w-64 text-center" href="{{route('login')}}">Pre-order</a>
@endauth
