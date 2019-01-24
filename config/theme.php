<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 19/11/2018
 * Time: 18:10
 */
return [
    'cdn_url' => str_finish(env('AWS_CDN_ENDPOINT', 'https://cdn.z1lab.com.br'), '/'),
    'css'     => [
        'vendor/animate.css/animate.min.css',
        'vendor/hs-megamenu/src/hs.megamenu.css',
        //'vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
        'vendor/slick-carousel/slick/slick.css',
        //'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
        'css/theme-purple.min.css',
    ],
    'js'      => [
        'vendor/jquery/dist/jquery.min.js',
        'vendor/jquery-migrate/dist/jquery-migrate.min.js',
        'vendor/popper.js/dist/umd/popper.min.js',
        'vendor/bootstrap/bootstrap.min.js',
        //'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
        //'vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        //'vendor/custombox/dist/custombox.min.js',
        //'vendor/cubeportfolio/js/jquery.cubeportfolio.min.js',
        'js/theme.min.js',
    ],
    'js-defer' => [

        'vendor/hs-megamenu/src/hs.megamenu.js',
        'vendor/slick-carousel/slick/slick.min.js',

    ],
    'prod'    => [
        'namespace' => 'template/front/',
        'version'   => '2.1.1',
    ],
];
