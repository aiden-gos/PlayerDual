<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-gray-100 fixed h-screen w-60 shadow flex flex-col gap-4 p-4 pt-20">
            @auth
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'up-story-form')"
                    class="bg-gray-200 text-black border w-full py-3 rounded-md max-w-64 flex items-center p-2 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 24 24">
                        <path
                            d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z">
                        </path>
                    </svg>
                    Post your story
                </button>
            @endauth
            <h2 class="text-xl font-bold w-full text-center">Trending</h2>
            <hr>
            @foreach ($top_stories as $story)
                <button class="story" href="" x-data=""
                    x-on:click.prevent='$dispatch("open-modal",{name : "story-detail", story: {
                        id: "{{$story->id ?? ""}}",
                        video_link: "{{$story->video_link  ?? ""}}",
                        content: "{{$story->content  ?? ""}}",
                        user: {
                            id: "{{isset($story->user->id) ? $story->user->id : ''}}",
                            name: "{{isset($story->user->name) ? $story->user->name : ''}}",
                            avatar: "{{isset($story->user->avatar) ? $story->user->avatar : ''}}",
                        },
                    }})'>
                    <input type="hidden" value="{{ $story->id }}">
                    <div class="flex flex-row gap-4">
                        <img src="{{ $story->user->avatar ?? "" }}" alt="profile" class="w-12 h-12 rounded-full">
                        <div class="flex items-center">
                            <p class="text-sm font-bold text-start">{{ $story->user->name ?? "" }}</p>
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    </x-slot>
    <div class="py-5 bg-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-row flex-wrap gap-5">
                        @foreach ($stories as $story)
                            @include('stories.story-card')
                        @endforeach

                        @include('stories.stories-up')
                    </div>
                    <div class="py-5 px-20">
                        {{ $stories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('stories.stories-show')
</x-app-layout>
