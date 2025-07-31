import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    build: {
        sourcemap: true
    },
    plugins: [
        laravel({
            input: [
                'resources/assets/scss/style.scss',
                'resources/assets/js/app.js'
            ],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        headers: {
            'Access-Control-Allow-Origin': '*'
        }
    }
});
