<?php

$flatsome_inc_dir = 'inc/woo';

// Array of files to include.
$flatsome_includes = [
    '/hooks.php', //Include scripts and styles
];

// Include files.
foreach ( $flatsome_includes as $file ) {
    require_once get_theme_file_path( $flatsome_inc_dir . $file );
}