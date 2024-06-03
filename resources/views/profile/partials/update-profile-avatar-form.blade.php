<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's avatar.") }}
        </p>
    </header>
<div class="flex flex-row gap-20">
    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-row gap-10">
            <input type="file"
                class="filepond h-48 w-48 -z-1" id="avatar-input"
                name="avatar"
                accept="image/png, image/jpeg, image/gif"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <div>
        Balance: ${{Auth::user()->balance}}
        <form method="post" action="{{ route('payment.checkout') }}" class="mt-6 space-y-6">
            <x-text-input type="number" name="money"/>
            <x-primary-button>{{ __('Checkout') }}</x-primary-button>
            @if (session('status') === 'checkout-ok')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Checkout Success.') }}</p>
            @endif

            @if (session('status') === 'checkout-fail')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Checkout Error.') }}</p>
            @endif
        <form>
    </div>
</div>
</section>

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

FilePond.create(document.querySelector('input[name=avatar]'), {
    storeAsFile: true,
    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleProgressIndicatorPosition: 'right bottom',
    styleButtonRemoveItemPosition: 'left bottom',
    styleButtonProcessItemPosition: 'right bottom',
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
    },
     files: [{
        source: '{{empty(Auth::user()->avatar) ? env('DEFAULT_IMAGE') : Auth::user()->avatar}}',
    }]
});
</script>
