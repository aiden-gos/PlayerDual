import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/@pqina/pintura/pintura.css',
                'node_modules/filepond-plugin-media-preview/dist/filepond-plugin-media-preview.min.css',
                'node_modules/filepond/dist/filepond.esm.js',
                'node_modules/filepond-plugin-media-preview/dist/filepond-plugin-media-preview.esm.js',
                'node_modules/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.esm.js',
                'node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.esm.js',
                'node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.esm.js',
                'node_modules/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js',
                'node_modules/@pqina/filepond-plugin-image-editor/dist/FilePondPluginImageEditor.js',
                'node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js',
                'node_modules/@pqina/pintura/pintura.js',
                'node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css'
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
      }
});
