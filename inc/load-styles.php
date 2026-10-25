<?php

add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_styles() {
    wp_register_script( 'uiscom-availability', get_template_directory_uri() . '/static/js/uiscom-availability.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_localize_script(
        'uiscom-availability',
        'uiscomCheck',
        array(
            'url'     => apply_filters( 'uiscom_check_url', 'https://app.uiscom.ru/' ),
            'timeout' => apply_filters( 'uiscom_check_timeout', 5000 ),
        )
    );
    wp_enqueue_script( 'uiscom-availability' );
}
