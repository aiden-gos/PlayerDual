<div class='w-full flex flex-row gap-2 p-5'>
    <a href="/user/{{ $item->author->id }}">
        <div class="pt-2"><img class="rounded-full" width="50" height="50" src="{{ $item->author->avatar }}"
                class="avt-1-15 avt-img" alt="PD"></div>
    </a>
    <div class="flex flex-row justify-between w-full p-2 items-center">
        <a href="/user/{{ $item->author->id }}">
            <p class="font-bold">{{ $item->author->name }}</p>
            <p class=""><span>{{ $item->created_at }}</span></p>
            <p class="py-2">{{ $item->content }}</p>
            @if ($item->author->id == Auth::user()->id)
                <div class="flex flex-row gap-5">
                    <button id="update-rate" class="text-yellow-600">Update</button>
                    <input type="hidden" id="id" value="{{ $item->id }}">
                    <form method="post" action="{{ route('rate.create') }}/{{ $item->id }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id">
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            @endif
        </a>
        <div class="">
            <div class="flex flex-row">

                @for ($i = 0; $i < $item->star; $i++)
                    <svg width="20" heigth="20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256"
                        enable-background="new 0 0 256 256" xml:space="preserve">
                        <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                        <g>
                            <g>
                                <g>
                                    <path fill="#f6fb09" data-title="Layer 0" xs="0"
                                        d="M111,60.4l-16.7,41.7l-42.2,0.3L10,102.6l33.1,24.9c18.3,13.7,33.4,25,33.7,25.2c0.3,0.2-3,17.9-7.9,42.5c-4.6,23.2-8.3,42.1-8.2,42.1c0.1,0,15.3-11.3,33.8-25.2l33.6-25.2l33.6,25.2c18.5,13.9,33.7,25.2,33.8,25.2c0.1,0-3.6-18.9-8.2-42.1c-4.9-24.6-8.3-42.3-7.9-42.5c0.3-0.2,15.4-11.5,33.7-25.2l33.1-24.9l-42.2-0.3l-42.2-0.3L145,60.4c-9.2-22.9-16.8-41.6-17-41.6S120.2,37.5,111,60.4z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                @endfor

                @for ($i = 0; $i < 5 - $item->star; $i++)
                    <svg width="20" heigth="20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256"
                        enable-background="new 0 0 256 256" xml:space="preserve">
                        <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                        <g>
                            <g>
                                <g>
                                    <path fill="#f9ff05" data-title="Layer 0" xs="0"
                                        d="M109.9,52.3c-9.9,20.1-18.2,36.8-18.3,37c-0.1,0.1-18.6,3-40.9,6.2c-22.4,3.2-40.6,6-40.6,6.1s13.2,13.1,29.3,28.8c16.1,15.7,29.3,28.8,29.3,29.1s-3,18.5-6.8,40.4c-3.7,21.9-6.7,40-6.6,40.1c0.1,0.1,16.5-8.2,36.3-18.7c19.8-10.4,36.2-18.9,36.5-19c0.3,0,16.7,8.5,36.5,19c19.8,10.4,36.1,18.9,36.3,18.8c0.1-0.1-2.8-18-6.6-39.9c-3.8-21.9-6.9-40.1-6.9-40.5c0-0.4,13.2-13.6,29.3-29.3c16.1-15.7,29.3-28.6,29.3-28.8s-18.3-2.9-40.6-6.1c-22.3-3.3-40.6-6-40.7-6c-0.1-0.1-8.2-16.6-18.2-36.8c-10-20.2-18.2-36.8-18.3-36.9C128,15.8,119.8,32.2,109.9,52.3z M154.8,103c0.1,0.1,13.4,2,29.7,4.4c16.2,2.3,29.6,4.4,29.7,4.5s-5.1,5.3-11.4,11.5c-6.4,6.2-16.1,15.7-21.5,21.1l-9.9,9.7l5.1,29.5c2.8,16.2,5,29.5,4.9,29.6c-0.1,0.1-11.5-5.8-25.2-13.1c-13.8-7.3-25.8-13.5-26.6-13.9c-1.5-0.7-1.5-0.7-28,13.2c-14.6,7.7-26.6,13.9-26.7,13.8c-0.1-0.1,2.1-13.2,4.8-29.2c2.7-15.9,4.9-29.4,4.9-29.8c-0.1-0.4-9.6-10-21.3-21.3c-11.6-11.3-21.2-20.8-21.3-21c-0.1-0.2,0.1-0.4,0.3-0.4c0.2,0,13.6-1.9,29.7-4.2c16-2.3,29.2-4.2,29.3-4.2c0,0,6.1-12.2,13.5-27.1L128,48.8l13.3,27C148.7,90.7,154.7,102.9,154.8,103z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                @endfor
            </div>
            {{-- <span class="flex flex-row justify-end">(<span>Hire</span>&nbsp;2h)</span> --}}
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var btnUpdate = $('#update-rate');
        var stateFormShow = true;
        btnUpdate.click(function() {
            if (stateFormShow) {
                $("#update-form-rate").removeClass('hidden')
                btnUpdate.text('Cancel')
                stateFormShow = false;
            } else {
                $("#update-form-rate").addClass('hidden')
                btnUpdate.text('Update')
                stateFormShow = true;
            }

        })
    })
</script>
