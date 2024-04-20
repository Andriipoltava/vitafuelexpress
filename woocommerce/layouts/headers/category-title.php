<?php
/**
 * Category title.
 *
 * @package          Flatsome/WooCommerce/Templates
 * @flatsome-version 3.16.0
 */


global $wp_query;

// get the query object
$cat = $wp_query->get_queried_object();

$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
$image = wp_get_attachment_image($thumbnail_id, 'full');
?>

<div class="shop-page-title category-page-title page-title <?php flatsome_header_title_classes() ?>">
    <div class="page-title-inner row  medium-flex-wrap">
        <div class="flex-col flex-title  medium-text-center medium-6">
            <?php do_action('flatsome_category_title'); ?>
        </div>
        <?php if ($image) { ?>
            <div class="flex-col flex-images medium-text-center medium-6">
                <?php echo $image; ?>
            </div>
        <?php }; ?>
    </div>
</div>
