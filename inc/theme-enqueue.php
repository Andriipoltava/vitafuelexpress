<?php
function flatsome_child_scripts_styles() {
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', [], time());
}
add_action( 'wp_enqueue_scripts', 'flatsome_child_scripts_styles', 999 );