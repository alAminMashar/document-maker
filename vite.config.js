import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
    sourcemap: true
    },
    plugins: [
        // basicSsl(),
        laravel({
            input: ['resources/assets/scss/style.scss'],
            output:['/public/build/app.css'],
            refresh: true,
        }),
    ],
    // server: {
    //     https: false,
    //     host: 'document-maker.test',
    // }
});
