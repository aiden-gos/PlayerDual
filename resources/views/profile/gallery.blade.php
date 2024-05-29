<x-app-layout>
    <x-slot name="header">
        @include('profile.partials.sidebar-profile')
    </x-slot>
    @vite(["resources/css/galleryupload.css"])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="pb-5 flex flex-col justify-between w-full">

                        <form method="post" action="{{ route('profile.gallery') }}" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-row justify-between">
                                <h1 class="text-2xl">Gallery</h1>
                                <x-primary-button>Upload</x-primary-button>
                            </div>
                            
                            <input type="file" 
                                class="filepond"
                                name="upload"
                                data-allow-reorder="true"
                                data-max-file-size="3MB"
                                accept="image/png, image/jpeg, image/gif, video/mp4">
                        </form>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @if (empty($gallery))
                    <div class="text-gray-600">Empty gallery</div>
                @else
                    @foreach ($gallery as $ele)
                        @if (isset($ele->type) && $ele->type == 'image')
                            <div>
                                <img class="w-[340px] h-[200px] rounded-lg object-cover" src="{{$ele->link}}" alt="">
                            </div>
                        @elseif (isset($ele->type) && $ele->type == 'video')
                            <video controls class="w-[340px] h-[200px] rounded-lg object-cover">
                                <source src="{{$ele->link}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
import * as FilePond from "{{Vite::asset('node_modules/filepond/dist/filepond.esm.js')}}";
import FilePondPluginFilePoster from "{{Vite::asset('node_modules/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm.js')}}";
import FilePondPluginImageEditor from "{{Vite::asset('node_modules/@pqina/filepond-plugin-image-editor/dist/FilePondPluginImageEditor.js')}}";

FilePond.registerPlugin(
    FilePondPluginImageEditor,
    FilePondPluginFilePoster
);

import {
    openEditor,
    createDefaultImageReader,
    createDefaultImageWriter,
    processImage,
    getEditorDefaults,
} from "{{Vite::asset('node_modules/@pqina/pintura/pintura.js')}}";

FilePond.create(document.querySelector('input[name=upload]'), {
    storeAsFile: true,
    allowReorder: true,
    filePosterMaxHeight: 256,
    imageEditor: {
        createEditor: openEditor,
        imageReader: [createDefaultImageReader],
        imageWriter: [
            createDefaultImageWriter,
            {
                targetSize: {
                    width: 128,
                },
            },
        ],
        imageProcessor: processImage,
        editorOptions: {
            ...getEditorDefaults({
            }),
            imageCropAspectRatio: 1,
        },
    }
});
</script>