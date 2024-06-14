@auth
    @vite(['node_modules/filepond-plugin-media-preview/dist/filepond-plugin-media-preview.min.css'])
    <x-modal name="up-story-form" focusable>
        <style>
            label.error {
                color: red
            }
        </style>
        <form id="story" method="post" action="{{ route('stories.up') }}" class="p-6  flex flex-row gap-10"
            enctype="multipart/form-data">
            @csrf
            <div class="w-full">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 text-3xl">
                        {{ __('Upload story') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Upload your story.') }}
                    </p>
                </div>
                <hr>
                <br>
                <div>
                    <x-input-label for="msg" :value="__('Content')" />
                    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        name="content" id="content" cols="65" rows="10"></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        {{ __('Upload') }}
                    </x-primary-button>
                </div>
            </div>

            <div class="w-full flex items-center">
                <input class="w-full" id="upload" type="file" class="filepond" name="upload"
                    data-allow-reorder="true" data-max-file-size="20MB" accept="video/mp4">
                <div id='update-err' class="text-red-500"></div>
            </div>
        </form>
    </x-modal>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            var validator = $("#story").validate({
                rules: {
                    content: {
                        required: true,
                    },
                    update: {
                        required: true,
                        extension: "mp4"
                    },
                },
                messages: {
                    ok: {
                        required: "input type is required",
                        extension: "select valied input file format (mp4)"
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.filepond--credits').addClass('hidden');
        })
    </script>

    <script type="module">
        import * as FilePond from "{{ Vite::asset('node_modules/filepond/dist/filepond.esm.js') }}";
        import FilePondPluginMediaPreview from "{{ Vite::asset('node_modules/filepond-plugin-media-preview/dist/filepond-plugin-media-preview.esm.js') }}";
        import FilePondPluginFilePoster from "{{ Vite::asset('node_modules/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm.js') }}";
        import FilePondPluginFileValidateSize from "{{ Vite::asset('node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.esm.js') }}";
        import FilePondPluginImageExifOrientation from "{{ Vite::asset('node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.esm.js') }}";

        FilePond.registerPlugin(
            FilePondPluginMediaPreview,
            FilePondPluginFilePoster,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize
        );

        FilePond.create(document.querySelector('input[name=upload]'), {
            storeAsFile: true,
            allowReorder: true,
        });
    </script>
@endauth
