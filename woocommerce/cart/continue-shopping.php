<?php
/**
 * Continue Shopping Button
 *
 * @package          Flatsome/WooCommerce/Templates
 * @flatsome-version 3.16.0
 */

defined( 'ABSPATH' ) || exit; ?>

<div class="continue-shopping pull-left text-left">
	<a class="button-continue-shopping button white"  href="<?php echo esc_url( apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
		<?php echo esc_html__( 'Continue shopping', 'woocommerce' ); ?>
	</a>
</div>
