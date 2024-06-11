<div id="rating" class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
    <div class="w-full md:px-[20%]">
        <h1 class="text-2xl font-bold">Rating</h1> <br>
        <hr> <br>

        @if ($showRate)
            <div class="flex flex-row gap-5">
                <div>Comment</div>
                <form action="{{ route('rate.create') }}" method="post" class="flex flex-row gap-5 w-full">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        name="content" id="content" cols="50" rows="4"></textarea>
                    <div class="flex flex-col justify-around">
                        <input type="number" name="star" />
                        <button class="bg-black text-white w-full py-3 rounded-md max-w-64">Send</button>
                    </div>
                </form>
            </div>
        @endif

        @if($rate[0] && $rate[0]->author->id == Auth::user()->id)
        {{-- form update hidden --}}
        <div id='update-form-rate' class="flex flex-row gap-5 hidden">
            <div>Comment</div>
            <form method="post" action="{{ route('rate.update', $rate[0]->id) }}" class="flex flex-row gap-5 w-full">
                @csrf
                @method('patch')
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    name="content" id="content" cols="50" rows="4" id='text-update'>{{$rate[0]->content}}</textarea>
                <div class="flex flex-col justify-around">
                    <input type="number" name="star" id='star-update' value="{{$rate[0]->star}}"/>
                    <button class="bg-black text-white w-full py-3 rounded-md max-w-64">Update</button>
                </div>
            </form>
        </div>
        {{--  --}}
        @endif

        @forelse($rate as $item)
            @include('comment')
            <hr>

        @empty
            Not found rate
        @endforelse
        <div class="py-10 px-40 ">
            {{ $rate->appends(request()->except('page'))->fragment('rating')->links() }}
        </div>
    </div>
</div>
<script>

</script>
