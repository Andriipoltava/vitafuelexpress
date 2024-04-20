<?php


add_action('woocommerce_archive_description', function () {
    ?>
    <div class="shop-container__top">
        <?php
        do_action('flatsome-child-woocommerce_archive_description');
        ?>
    </div>
    <?php
});
add_action('flatsome-child-woocommerce_archive_description', 'wc_setup_loop');

add_action('flatsome-child-woocommerce_archive_description', 'woocommerce_result_count', 20);
add_action('flatsome-child-woocommerce_archive_description', 'woocommerce_catalog_ordering', 30);


add_action('woocommerce_category_before_main_content', function () {
    $taxonomy = "product_cat";
    $terms = get_terms($taxonomy, array('hide_empty' => true,)); //Exclude Specific Category by ID

    ?>
    <div class="row"><?php
        foreach ($terms as $term) {
            $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_image($thumbnail_id); ?>


            <div class="col-term col">
                <a href="<?php echo get_term_link($term) ?>">
                    <?php

                    echo $image?:'<span class="rb"></span>';
                    echo '<p class="term-title">' . $term->name . '</p>';
                    ?>
                </a>
            </div>

            <?php
        } ?>
    </div>
    <?php
});
add_filter('woocommerce_catalog_orderby', function ($array) {
    return array(
        'popularity' => __('Most Popular', 'woocommerce'),
        'rating' => __('Sort by average rating', 'woocommerce'),
        'title_asc' => __('A-Z', 'woocommerce'),
        'title_desc' => __('Z-A', 'woocommerce'),
        'date' => __('Newest', 'woocommerce'),

    );
}, 99);

add_filter('woocommerce_get_catalog_ordering_args', 'custom_get_catalog_ordering_args');
function custom_get_catalog_ordering_args($args)
{
    if (isset($_GET['orderby'])) {
        // Sort by "menu_order" DESC (the default option)
        if ('title_desc' === $_GET['orderby']) {
            $args = array('orderby' => 'title', 'order' => 'DESC');
        } // Sort by "menu_order" ASC
        elseif ('title_asc' == $_GET['orderby']) {
            $args = array('orderby' => 'title', 'order' => 'ASC');
        }
    }
    return $args;
}

remove_action( 'flatsome_category_title', 'flatsome_add_category_filter_button', 999 );
