import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',


                // 'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
                'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
                'node_modules/admin-lte/plugins/select2/css/select2.min.css',


                'node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js',

                'node_modules/admin-lte/dist/js/adminlte.min.js',
                'node_modules/admin-lte/dist/css/adminlte.css',

                'resources/js/scripts.js',
            ],
            refresh: true,
        })
    ],
    resolve: {
        alias: {
            '~jquery': path.resolve(__dirname, 'node_modules/jquery'),
            '~admin-lte': path.resolve(__dirname, 'node_modules/admin-lte'),
        }
    },
});
