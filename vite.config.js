import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //front
                'resources/css/app.css',
                'resources/css/animate.css',
                'resources/css/bootstrap.css',
                'resources/css/media_query.css',
                'resources/css/owl.carousel.css',
                'resources/css/owl.theme.default.css',
                'resources/css/style_1.css',
                'resources/js/bootstrap.js',
                'resources/js/jquery.waypoints.min.js',
                // 'resources/js/main.js',
                'resources/js/modernizr-3.5.0.min.js',
                'resources/js/owl.carousel.min.js',
                'resources/js/jquery.stellar.min.js',
                'resources/js/app.js',
                'resources/js/main.js',
                //admin
                'resources/vendor/bootstrap/css/bootstrap.min.css',
                'resources/vendor/bootstrap-icons/bootstrap-icons.css',
                'resources/vendor/boxicons/css/boxicons.min.css',
                'resources/vendor/remixicon/remixicon.css',
                'resources/css/style.css',
                //
                'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'resources/js/admin_main.js'
            ],
            refresh: true,
        }),
    ],
});
