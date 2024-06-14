<div class="flex flex-col w-52 h-80  mb-24">
    <button class="story" href="" x-data=""
        x-on:click.prevent='$dispatch("open-modal",{name : "story-detail", story: {
                        id: "{{ $story->id }}",
                        video_link: "{{ $story->video_link }}",
                        view: "{{ $story->view }}",
                        content: "{{ $story->content }}",
                        like: {{ $story->like }},
                        is_liked_by_user: "{{ $story->is_liked_by_user }}",
                        user: {
                            id: "{{ $story->user->id }}",
                            name: "{{ $story->user->name }}",
                            avatar: "{{ $story->user->avatar }}"
                        },
                    }})'>
        <input type="hidden" value="{{ $story->id }}">
        <div class="box-item">
            <div>
                <video class="w-52 h-80 rounded-xl object-cover" src="{{ $story->video_link }}" class=""
                    alt="PD" id="avt-img-reponsiver"></video>
            </div>
            <div class="flex flex-row gap-5 justify-center mt-[-30px]  text-white">
                <p class="flex flex-row gap-1">
                    <svg fill="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                        viewBox="0 0 544.582 544.582" xml:space="preserve">
                        <g>
                            <path d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                   C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                   c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                        </g>
                    </svg>
                    {{ $story->like }}
                </p>
                <p class="flex flex-row gap-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                        viewBox="0 0 50 50">
                        <path fill= "#FFFFFF"
                            d="M 25 4 C 12.316406 4 2 12.972656 2 24 C 2 30.1875 5.335938 36.066406 10.949219 39.839844 C 10.816406 40.890625 10.285156 43.441406 8.183594 46.425781 L 7.078125 47.992188 L 9.054688 48 C 14.484375 48 18.15625 44.671875 19.363281 43.394531 C 21.195313 43.796875 23.089844 44 25 44 C 37.683594 44 48 35.027344 48 24 C 48 12.972656 37.683594 4 25 4 Z">
                        </path>
                    </svg>
                    {{ $story->comment }}
                </p>
                <p class="flex flex-row gap-1  text-white">
                    <svg width="20" height="20" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.20513 12.5C6.66296 14.7936 8.9567 16.9 12.5 16.9C16.0433 16.9 18.3371 14.7936 19.7949 12.5C18.3371 10.2064 16.0433 8.1 12.5 8.1C8.9567 8.1 6.66296 10.2064 5.20513 12.5ZM3.98551 12.1913C5.53974 9.60093 8.20179 6.9 12.5 6.9C16.7982 6.9 19.4603 9.60093 21.0145 12.1913L21.1997 12.5L21.0145 12.8087C19.4603 15.3991 16.7982 18.1 12.5 18.1C8.20179 18.1 5.53974 15.3991 3.98551 12.8087L3.80029 12.5L3.98551 12.1913ZM12.5 9.4C10.7879 9.4 9.4 10.7879 9.4 12.5C9.4 14.2121 10.7879 15.6 12.5 15.6C14.2121 15.6 15.6 14.2121 15.6 12.5C15.6 10.7879 14.2121 9.4 12.5 9.4Z"
                            fill="#FFFFFF" />
                    </svg>
                    {{ $story->view }}
                </p>
            </div>
        </div>
        <div class="flex flex-row items-center mt-5 gap-2">
            <div><img src="{{ $story->user->avatar }}" class="h-10 w-10 rounded-[50%]" alt="PD"></div>
            <p class="font-bold">{{ $story->user->name }}</p>
        </div>
    </button>
</div>
