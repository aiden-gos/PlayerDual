
<div id="rating" class="p-4 sm:p-8 bg-white sm:rounded-lg w-full flex flex-row gap-10 max-md:flex-col">
    <div class="w-full md:px-[20%]">
        <h1 class="text-2xl font-bold flex flex-row items-center">Rating <span class="text-lg text-gray-500"> ({{$rateCount ?? "0"}}/{{$orderCount ?? "0"}})</span></h1> <br>
        <hr> <br>

        @if ($showRate)
            <div class="flex flex-row gap-5 w-full">
                <div>Comment</div>
                <form id="rate-form" action="{{ route('rate.create') }}" method="post" class="flex flex-row gap-5 w-full">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="flex flex-col w-full">
                        <textarea class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            name="content" id="content" cols="50" rows="4"></textarea>
                    </div>
                    <div class="flex flex-col justify-around">
                        <div class="flex flex-col">
                            @include('components.ratingbar')
                        </div>
                        <button class="bg-rose-500 text-white w-full py-3 rounded-md max-w-64">Send</button>
                    </div>
                </form>
            </div>
        @endif

        @forelse($rate as $item)
            @include('comment')
            <hr>
        @empty
            <div class="w-full text-center p-5 text-gray-500">Not found rate</div>
        @endforelse
        @if(isset($rate[0]))
        <div class="py-10 px-40 ">
            {{ $rate->appends(request()->except('page'))->fragment('rating')->links() }}
        </div>
        @endif
    </div>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script>
        $("#rate-form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "content": {
                    required: true,
                },
            }
        });
    </script>
</div>

