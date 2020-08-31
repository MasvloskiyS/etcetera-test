<?php 

function wp_real_estate_scripts() {

    wp_enqueue_style( 'slick-css',  get_template_directory_uri() . '/../etcetera-test/libs/slick-slider/slick.css');
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/../etcetera-test/libs/slick-slider/slick-theme.css');

    wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/../etcetera-test/libs/slick-slider/slick.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/../etcetera-test/js/common.js', array('jquery'), '', true );


}
        
add_action( 'wp_enqueue_scripts', 'wp_real_estate_scripts' );
