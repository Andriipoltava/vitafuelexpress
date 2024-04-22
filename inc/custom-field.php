<?php
////////////////////

if (!function_exists('mv_add_other_fields_for_packaging')) {
    function mv_add_other_fields_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta($post->ID, '_order_change', true) ? get_post_meta($post->ID, '_order_change', true) : $post->ID;

        echo '<input type="hidden" name="meta_field_custom_number_order" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
            <input type="text" style="width:250px;" name="my_field_name" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>';

    }
}

if (!function_exists('mv_add_field_payment')) {
    function mv_add_field_payment()
    {
        global $post;

        $meta_data = get_post_meta($post->ID, '_payment_change', true) ? get_post_meta($post->ID, '_payment_change', true) : $post->ID;

        echo '<input type="hidden" name="meta_field_payment" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
			<select name="my_field_payment" style="width:250px;">';
        echo '<option value="">Selected for invoice</option>';
        if ($meta_data == "received") {
            echo '<option selected value="received">received</option>';
        } else {
            echo '<option value="received">received</option>';
        }
        if ($meta_data == "not received") {
            echo '<option selected value="not received">not received</option>';
        } else {
            echo '<option value="not received">not received</option>';
        }
        echo '</select>
			</p>';

    }
}

// Save the data of the Meta field
add_action('save_post', 'mv_save_wc_order_other_fields', 10, 1);
if (!function_exists('mv_save_wc_order_other_fields')) {

    function mv_save_wc_order_other_fields($post_id)
    {

        if (!isset($_POST['meta_field_custom_number_order'])) {
            return $post_id;
        }
        $nonce = $_REQUEST['meta_field_custom_number_order'];

        if (!wp_verify_nonce($nonce)) {
            return $post_id;
        }

        if (!isset($_POST['meta_field_payment'])) {
            return $post_id;
        }
        $nonce = $_REQUEST['meta_field_payment'];

        if (!wp_verify_nonce($nonce)) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
        update_post_meta($post_id, '_payment_change', $_POST['my_field_payment']);
        update_post_meta($post_id, '_order_change', $_POST['my_field_name']);
    }
}


add_action('add_meta_boxes', 'mv_add_meta_boxes');
if (!function_exists('mv_add_meta_boxes')) {
    function mv_add_meta_boxes()
    {
        add_meta_box('mv_other_fields', __('№ Order for invoice', 'woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core');
        add_meta_box('my_other_fields', __('Payments for invoice', 'woocommerce'), 'mv_add_field_payment', 'shop_order', 'side', 'core');
        add_meta_box(
            'meta_box_date_invoice', // Unique ID
            __('Date for invoice', 'woocommerce'),    // Meta Box title
            'meta_date_invoice_html',    // Callback function
            'shop_order', 'side', 'core'
        );
    }
}

function meta_date_invoice_html($post)
{

    $invoice_date = get_post_meta($post->ID, '_invoice_date_meta_key', true);
    ?>

    <label for="invoice_date">Invoice date</label>
    <input name="invoice_date" type="text" id="datepicker" value="<?php echo esc_attr($invoice_date); ?>">

    <script>
        (function ($) {

            'use strict';

            $(document).ready(function () {

                'use strict';

                //Basic jQuery UI Datepicker initialization
                $('#datepicker').datepicker();

            });

        })(window.jQuery);
    </script>
    <?php

}

function meta_box_datepicker_save($post_id)
{
    if (array_key_exists('invoice_date', $_POST)) {
        update_post_meta(
            $post_id,
            '_invoice_date_meta_key',
            $_POST['invoice_date']
        );
    }
}

add_action('save_post', 'meta_box_datepicker_save');