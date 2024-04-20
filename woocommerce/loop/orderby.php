<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

?>

<form class="woocommerce-ordering " method="get">
    <span class="woocommerce-ordering__title">
    <?php esc_attr_e('Order by:', 'woocommerce'); ?>
        </span>
    <span class="woocommerce-ordering__wrap">
    <?php foreach ($catalog_orderby_options as $id => $name) : ?>
        <span class="woocommerce-ordering__item">
        <input type="radio" id="orderby_<?php echo esc_attr($id); ?>" name="orderby" class="orderby"
               value="<?php echo esc_attr($id); ?>" <?php checked($orderby, $id); ?> >
        <label class="woocommerce-ordering__label" for="orderby_<?php echo esc_attr($id); ?>"><?php echo esc_html($name); ?></label>
        </span>
    <?php endforeach; ?>
        </span>
    <input type="hidden" name="paged" value="1"/>


    <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>

<script>
    jQuery('body').on('change', 'form.woocommerce-ordering .orderby', function () {
        /* woo3.3 */
        if (!jQuery("#is_woo_shortcode").length) {
            woof_current_values.orderby = jQuery(this).val();
            woof_ajax_page_num = 1;
            woof_submit_link(woof_get_submit_link(), 0);
            return false;
        }
        /* +++ */
    });
</script>