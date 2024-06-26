@auth
@if(!(Auth::user()->id == $user->id))
<button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'donate-form')"
    class="bg-white text-black border w-full py-3 rounded-md max-w-64">Donate</button>
@endif
<x-modal name="donate-form" focusable>
    <style>label.error{color: red}</style>
    <form id="donate" method="post" action="{{ route('donate') }}" class="p-6 space-y-6">
        @csrf

        <div>
            <h2 class="text-lg font-medium text-gray-900 text-3xl">
                {{ __('Donate money') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Please enter the amount you want to donate.') }}
            </p>
        </div>
        <br>
        <input type="hidden" name="user_id" value="{{$user->id}}">

        <div class="flex flex-row items-center">
            <div class="w-full">
                <x-input-label for="name" :value="__('Reciver')" />
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
                <div>${{number_format(Auth::user()->balance)}}</div>
            </div>
        </div>
        <hr>
        <div>
            <x-input-label for="money" :value="__('Money')" />
            <x-text-input id="money" name="money" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Display name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
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
                {{ __('Donate') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $("#donate").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"money": {
				required: true,
				min: 1,
                max:{{Auth::user()->balance}}
			}
		}
	});
</script>
@else
<a href="{{route('login')}}" class="bg-white text-black border w-full py-3 rounded-md max-w-64 text-center">Donate</a>
@endauth
