import * as FilePond from 'filepond/dist/filepond.esm.js';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm.js';
import FilePondPluginImageEditor from '@pqina/filepond-plugin-image-editor/dist/FilePondPluginImageEditor.js';

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
} from '@pqina/pintura/pintura.js';

FilePond.create(document.querySelector('input[name=avatar]'), {
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
    server:{
        url: '/avatar',
        'X-CSRF-TOKEN':'{{ csrf_token() }}'
    }
});