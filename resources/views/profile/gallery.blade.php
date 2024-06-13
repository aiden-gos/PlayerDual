@vite(['node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css'])
<x-app-layout>
    <x-slot name="header">
        @include('profile.partials.sidebar-profile')
    </x-slot>
    @vite(['resources/css/galleryupload.css'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="pb-5 flex flex-col justify-between w-full">

                    <form method="post" action="{{ route('profile.gallery') }}" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-row justify-between">
                            <h1 class="text-2xl">Gallery</h1>
                            <x-primary-button>Upload</x-primary-button>
                        </div>

                        <input id="upload" type="file" class="filepond" name="upload" data-allow-reorder="true"
                            data-max-file-size="20MB" accept="image/png, image/jpeg, image/gif, video/mp4">
                        <div id="chooser" class=""></div>
                        <a class="dropbox-saver"></a>

                        <div id="file-info"></div>
                    </form>
                </div>
                <div class="">
                    @if (empty($gallery))
                        <div class="text-gray-600">Empty gallery</div>
                    @else
                        <div ID="ngy2p"
                            data-nanogallery2='{
                                "itemsBaseURL": "http://nanogallery2.nanostudio.org/samples/",
                                "thumbnailWidth": "300",
                                "thumbnailBorderVertical": 0,
                                "thumbnailBorderHorizontal": 0,
                                "colorScheme": {
                                "thumbnail": {
                                    "background": "rgba(255,255,255,1)"
                                }
                                },
                                "thumbnailLabel": {
                                "position": "overImageOnBottom"
                                },
                                "thumbnailHoverEffect2": "imageScaleIn80",
                                "thumbnailGutterWidth": 10,
                                "thumbnailGutterHeight": 10,
                                "thumbnailOpenImage": true
                            }'>
                            @foreach ($gallery as $ele)
                                <a href="{{ $ele->link }}" data-ngthumb="{{ $ele->link }}" data-ngdesc=""></a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"
    data-app-key="57e7cwbrqrgxbxm"></script>
<script>
    options = {
        success: function(files) {
            console.log(files[0].link);
            $.ajax({
                url: "{{ route('profile.gallery.dropbox') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "link": files[0].link
                }
            });

            Dropbox.cancel();
        },
        cancel: function() {
            Dropbox.cancel();
        },
        linkType: "direct", // or "direct"
        multiselect: false, // or true
        extensions: ['.png', '.jpg', 'jpeg', 'mp4', 'wmv', 'avi'],
        folderselect: false, // or true
    };

    var button = Dropbox.createChooseButton(options);
    document.getElementById("chooser").appendChild(button);
    Dropbox.choose(options);
</script>

<script type="module">
    import * as FilePond from "{{ Vite::asset('node_modules/filepond/dist/filepond.esm.js') }}";
    import FilePondPluginFilePoster from "{{ Vite::asset('node_modules/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm.js') }}";
    import FilePondPluginImageEditor from "{{ Vite::asset('node_modules/@pqina/filepond-plugin-image-editor/dist/FilePondPluginImageEditor.js') }}";
    import FilePondPluginFileValidateSize from "{{ Vite::asset('node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.esm.js') }}";
    import FilePondPluginImagePreview from "{{ Vite::asset('/node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js') }}";
    import FilePondPluginImageExifOrientation from "{{ Vite::asset('node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.esm.js') }}";

    FilePond.registerPlugin(
        // FilePondPluginImageEditor,
        FilePondPluginFilePoster,
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize
    );

    import {
        openEditor,
        createDefaultImageReader,
        createDefaultImageWriter,
        processImage,
        getEditorDefaults,
    } from "{{ Vite::asset('node_modules/@pqina/pintura/pintura.js') }}";

    FilePond.create(document.querySelector('input[name=upload]'), {
        storeAsFile: true,
        allowReorder: true,
        imageEditor: {
            createEditor: openEditor,
            imageReader: [createDefaultImageReader],
            imageWriter: [
                createDefaultImageWriter,
            ],
            imageProcessor: processImage,
            editorOptions: {
                ...getEditorDefaults({}),
            },
        }
    });
</script>

<script>
    $('#upload').on('change', function() {
        var file = $(this)[0].files[0];
        console.log(file);
    });
</script>
