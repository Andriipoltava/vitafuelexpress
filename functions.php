<?php

$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = [
    '/theme-enqueue.php', //Include scripts and styles
    '/woo.php', //Include scripts and styles
    '/custom-field.php', //
    '/wp-form.php', //
];

// Include files.
foreach ( $understrap_includes as $file ) {
    require_once get_theme_file_path( $understrap_inc_dir . $file );
}

// Add custom Theme Functions here

add_action( 'wp_head', function () {
	if(get_theme_mod('site_width')) {
		$site_width = intval(get_theme_mod('site_width'));
        ?>
            <style>
                div.row.row-small{max-width: <?php echo $site_width; ?>px}
				footer .is-border {max-width: <?php echo $site_width-20; ?>px}
            </style>
        <?php
    };
});



add_filter( 'auto_plugin_update_send_email', '__return_false' );


