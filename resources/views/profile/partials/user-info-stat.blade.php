<div class="flex flex-row w-full">
    <div class="w-full flex flex-col justify-center items-center">
        <div>
            $ {{number_format(Auth::user()->balance)}}
        </div>
        <div class="mt-1 text-sm text-gray-600">
            Total amount deposited
        </div>
    </div>

    <div class="w-full flex flex-col justify-center items-center">
        <div>
            $ 0
        </div>
        <div class="mt-1 text-sm text-gray-600">
            Total amount donated
        </div>
    </div>

    <div class="w-full flex flex-col justify-center items-center">
        <div>
            0 h
        </div>
        <div class="mt-1 text-sm text-gray-600">
            Total time hired
        </div>
    </div>
</div>
