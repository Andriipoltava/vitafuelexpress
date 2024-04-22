<?php




add_filter( 'wf_pklist_alter_shipping_method', 'wf_pklist_alter_shipping_method_func', 10, 3 );

function wf_pklist_alter_shipping_method_func($shipping, $template_type, $order) {
    $s = str_replace(['$0.00','free','shipping',',',' ','Free','Shipping'], '', $shipping);
    if ($s === '') {
        $shipping = 'Free shipping';
    }
    return $shipping;
}

function company_email_option_callback( $args ){
    printf(
        '<input class="regular-text ltr" type="text" id="%s" name="%s" value="%s" />',
        $args[ 'label_for' ],
        $args[ 'name' ],
        esc_attr( get_option( $args[ 'name' ] ) )
    );
}
add_filter('wf_pklist_alter_find_replace','wf_pklist_add_values_for_custom_placeholders',10,5);
function wf_pklist_add_values_for_custom_placeholders($find_replace,$template_type,$order,$box_packing,$order_package)
{
    if($template_type=='invoice')
    {
        $find_replace['[wfte_company_email]']=get_option('company_email');
    }
    return $find_replace;
}
//company_email invoice

add_filter('wf_pklist_alter_invoice_date','wt_pklist_change_invoice_date_format',10,3);
function wt_pklist_change_invoice_date_format($invoice_date, $template_type, $order){

    $order_id = $order->get_id();
    $meta_input = get_post_meta($order_id, '_invoice_date_meta_key', true);

    return date("m-d-Y",strtotime($meta_input));

}
add_filter('wpcf7_skip_spam_check', '__return_true');
