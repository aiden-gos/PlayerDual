<x-modal-story name="story-detail" focusable>
    <div class="flex flex-row h-[900px] gap-10">
        <div class="flex flex-row items-center">
            <button
                @click="
                    axios.get(`/stories/next`).then((data)=>{
                        story = {
                            id: data.data.id,
                            video_link: data.data.video_link,
                            content: data.data.content,
                            is_liked_by_user: data.data.is_liked_by_user,
                            like: data.data.like,
                            comment_count: data.data.comment_count,
                            view: data.data.view,
                            user: {
                                id: data.data.user.id,
                                name: data.data.user.name,
                                avatar: data.data.user.avatar,
                            },
                        };
                        renderComment(data.data.id);
                    });">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <video autoplay loop height="900" width="400" controls x-init="$watch('story.video_link', () => {
                $el.load();
                $el.play();
            });
            $watch('show', value => {
                if (!value) {
                    $el.pause();
                }
            });">
                <source type="video/mp4" :src="story.video_link">
            </video>
            <button
                @click="
                    axios.get(`/stories/next`).then((data)=>{
                        story = {
                            id: data.data.id,
                            video_link: data.data.video_link,
                            content: data.data.content,
                            is_liked_by_user: data.data.is_liked_by_user,
                            like: data.data.like,
                            comment_count: data.data.comment_count,
                            view: data.data.view,
                            user: {
                                id: data.data.user.id,
                                name: data.data.user.name,
                                avatar: data.data.user.avatar,
                            },
                        };
                        renderComment(data.data.id);
                    });">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="h-full flex items-end">
                @auth
                    {{-- unlike --}}
                    <button x-show="!story.is_liked_by_user"
                        @click="like(story.id); story.is_liked_by_user = !story.is_liked_by_user; story.like += 1; "
                        id="like-btn" class="bg-gray-300 p-2 rounded-full mb-24 ml-[-20px]">
                        <svg fill="#57534e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                            viewBox="0 0 544.582 544.582" xml:space="preserve">
                            <g>
                                <path
                                    d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                                        C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                                        c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                            </g>
                        </svg>
                    </button>
                    {{-- like --}}
                    <button x-show="story.is_liked_by_user"
                        @click="unlike(story.id); story.is_liked_by_user = !story.is_liked_by_user; story.like -= 1;"
                        id="like-btn" class="bg-red-300 p-2 rounded-full mb-24 ml-[-20px] bg-red-300">
                        <svg fill="#57534e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                            viewBox="0 0 544.582 544.582" xml:space="preserve">
                            <g>
                                <path
                                    d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                                        C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                                        c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                            </g>
                        </svg>
                    </button>
                @endauth
            </div>
        </div>
        <div class="flex flex-col w-[400px] bg-gray-100 p-5">
            <div class="flex flex-row gap-4 justify-between">
                <div class="flex flex-row gap-2">
                    <img :src="story?.user?.avatar" alt="profile" class="w-12 h-12 object-cover rounded-full">
                    <div class="flex items-center">
                        <p class="text-sm font-bold" x-text="story?.user?.name"></p>
                    </div>
                </div>
                <a :href="'user/' + story?.user?.id" class="bg-rose-500 text-white p-2 rounded-xl h-10">Rent</a>
            </div>
            <br>
            <hr>
            <br>
            <div class="flex flex-row gap-10 justify-center">
                <p class="flex flex-row gap-1">
                    <svg fill="#57534e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                        viewBox="0 0 544.582 544.582" xml:space="preserve">
                        <g>
                            <path
                                d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
                            C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
                            c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z" />
                        </g>
                    </svg>
                    <span x-text="story.like"></span>
                </p>
                <p class="flex flex-row gap-1 ">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                        viewBox="0 0 50 50">
                        <path fill= "#57534e"
                            d="M 25 4 C 12.316406 4 2 12.972656 2 24 C 2 30.1875 5.335938 36.066406 10.949219 39.839844 C 10.816406 40.890625 10.285156 43.441406 8.183594 46.425781 L 7.078125 47.992188 L 9.054688 48 C 14.484375 48 18.15625 44.671875 19.363281 43.394531 C 21.195313 43.796875 23.089844 44 25 44 C 37.683594 44 48 35.027344 48 24 C 48 12.972656 37.683594 4 25 4 Z">
                        </path>
                    </svg>
                    <span id='comment-count' x-text="story.comment_count"></span>
                </p>
                <p class="flex flex-row gap-1  ">
                    <svg width="20" height="20" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.20513 12.5C6.66296 14.7936 8.9567 16.9 12.5 16.9C16.0433 16.9 18.3371 14.7936 19.7949 12.5C18.3371 10.2064 16.0433 8.1 12.5 8.1C8.9567 8.1 6.66296 10.2064 5.20513 12.5ZM3.98551 12.1913C5.53974 9.60093 8.20179 6.9 12.5 6.9C16.7982 6.9 19.4603 9.60093 21.0145 12.1913L21.1997 12.5L21.0145 12.8087C19.4603 15.3991 16.7982 18.1 12.5 18.1C8.20179 18.1 5.53974 15.3991 3.98551 12.8087L3.80029 12.5L3.98551 12.1913ZM12.5 9.4C10.7879 9.4 9.4 10.7879 9.4 12.5C9.4 14.2121 10.7879 15.6 12.5 15.6C14.2121 15.6 15.6 14.2121 15.6 12.5C15.6 10.7879 14.2121 9.4 12.5 9.4Z"
                            fill="#57534e" />
                    </svg>
                    <span x-text="story.view"></span>
                </p>
            </div>
            <div class="mt-5 text-stone-600" x-text="story.content"></div>
            <br>
            <hr>
            <br>
            {{-- Coment --}}
            <div id="comment" class="overflow-auto h-full">

                {{-- <div class="py-2">
                        <div class="flex flex-row gap-2">
                            <img src="" alt="profile" class="w-8 h-8 rounded-full">
                            <div class="flex items-start flex-col">
                                <p class="text-sm font-bold">Username</p>
                                <p class="text-xs text-stone-600"><span>dd-mm-yyy</span></p>
                            </div>
                        </div>
                        <p class="py-2 text-[14px] text-stone-600">comment comment comment</p>
                    </div> --}}

            </div>
            @auth
                <div class="flex flex-row items-start gap-2">
                    <textarea id="comment-content"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" name="content"
                        id="content" cols="50" rows="1"></textarea>
                    <button @click="handleComment(story.id)" class="bg-rose-500 text-white rounded-md p-2">Comment</button>
                </div>
            @endauth
            {{--  --}}
        </div>
    </div>
    <script>
        function like(id) {
            axios.get('/stories/like/' + id).then((response) => {})
        }

        function unlike(id) {
            axios.get('/stories/unlike/' + id).then((response) => {})
        }

        function renderComment(id) {
            $('#comment').empty();
            axios.get('/comment/' + id)
                .then((response) => {
                    $('#comment-content').val('');
                    var id = '{{ isset(Auth::user()->id) ? Auth::user()->id : 'null' }}';

                    response.data.forEach(e => {
                        $('#comment').append(`
                        <div class="py-2">
                            <div id="comment--${e.id}" class="flex flex-row gap-2">
                                <img src="${e?.user?.avatar}" alt="profile" class="w-8 h-8 rounded-full">
                                <div class="flex items-start flex-col">
                                    <div class="flex flex-row gap-20">
                                    <p class="text-sm font-bold">${e?.user?.name}</p>
                                      ${ id == e?.user?.id ? `
                                                        <button @click="deleteComment(${e.id});" class="text-xs text-red-600 mt-1">Delete</button>
                                                  ` : "" }
                                    </div>
                                    <p class="text-xs text-stone-600"><span>${new Date(e?.created_at).toLocaleString()}</span></p>
                                    <p class="py-2 text-[14px] text-stone-600">${e?.content}</p>
                                </div>
                            </div>
                        </div>
                    `);
                    });
                });
        }

        function handleComment(id) {
            var content = $("#comment-content").val();
            axios.post('/comment/' + id, {
                "content": content
            }).then((response) => {
                $('#comment-content').val('');
                var e = response.data;
                var id = '{{ isset(Auth::user()->id) ? Auth::user()->id : 'null' }}';

                $('#comment').append(`
                        <div id="comment--${e.id}"  class="py-2">
                            <div class="flex flex-row gap-2">
                                <img src="{{ isset(Auth::user()->avatar) ? Auth::user()->avatar : '' }}" alt="profile" class="w-8 h-8 rounded-full">
                                <div class="flex items-start flex-col">
                                    <div class="flex flex-row gap-20">
                                        <p class="text-sm font-bold">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}</p>
                                        <button @click="deleteComment(${e.id});" class="text-xs text-red-600 mt-1">Delete</button>
                                    </div>
                                    <p class="text-xs text-stone-600"><span>${new Date(e?.created_at).toLocaleString()}</span></p>
                                    <p class="py-2 text-[14px] text-stone-600">${e?.content}</p>
                                </div>
                            </div>
                        </div>
                    `);
                $('#comment').scrollTop($('#comment').prop('scrollHeight'));
                $('#comment-count').text(parseInt($('#comment-count').text()) + 1);
            });
        }

        function deleteComment(id) {
            axios.delete('/comment/' + id).then((response) => {
                $("#comment--" + id).remove();
                $('#comment-count').text(parseInt($('#comment-count').text()) - 1);
            });
        }
    </script>
</x-modal-story>
