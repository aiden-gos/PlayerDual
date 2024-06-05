<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 flex flex-row">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">

                <div class="w-full flex flex-col items-end">
                    <div class="flex flex-col items-center gap-5">
                        <img src="{{$user->avatar}}" width="250" height="250">
                        <div>Status</div>
                        <div>Create at: {{$user->created_at}}</div>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-10">
                    <div class="flex flex-row justify-between ">
                        <div class="text-2xl font-bold">{{$user->name}}</div>

                        @if ($follow)
                        <form method="post" action="{{ route('follow.destroy') }}" >
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <x-primary-button class="ml-3">
                                {{ __('Unfollow') }}
                            </x-primary-button>
                        </form>
                        @else
                        <form method="post" action="{{ route('follow.store') }}" >
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <x-primary-button class="ml-3">
                                {{ __('Follow') }}
                            </x-primary-button>
                        </form>
                        @endif




                    </div>

                    <div class="flex flex-row gap-2">
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Followers</div>
                            <div class="flex flex-col items-center">57 follows</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Total Hire</div>
                            <div class="flex flex-col items-center">2394 h</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Percent Complete</div>
                            <div class="flex flex-col items-center">96.22%</div>
                        </div>
                        <div class="w-full flex flex-col gap-2 items-center">
                            <div class="flex flex-col items-center text-xl text-nowrap">Devices</div>
                            <div class="flex flex-col items-center">OK</div>
                        </div>
                    </div>

                    <div class="flex flex-row gap-2 flex-wrap py-5">
                        <div class="bg-black text-white p-2 rounded-md">Order</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrder</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrder</div>
                        <div class="bg-black text-white p-2 rounded-md">Order</div>
                        <div class="bg-black text-white p-2 rounded-md">OrderOrderOrderOrder</div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="flex flex-col items-start gap-2">
                        <div class=" text-2xl">${{$user->price}}/h</div>
                        <button class="bg-black text-white w-full py-3 rounded-md">Hire</button>
                        @include('donate')
                        <button class="bg-white text-black border w-full py-3 rounded-md">Chat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function () {
        $('.donate-form').removeClass('hidden')
    })
</script>
