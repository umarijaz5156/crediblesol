import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/front/style.css',
                'resources/js/front/script.js',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/owner-custom.css',
                'resources/css/slick.css'
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
});
