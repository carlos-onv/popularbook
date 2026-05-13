<?php
/**
 * demo data.
 *
 * config.
 */
add_filter('ef3-theme-options-opt-name', 'book_junky_set_demo_opt_name');

function book_junky_set_demo_opt_name(){
    return 'opt_theme_options';
}

add_filter('ef3-replace-content', 'book_junky_replace_content', 10 , 2);

function book_junky_replace_content($replaces, $attachment){
    return array(
        //'/image="(.+?)"/' => 'image="'.$attachment.'"',
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
        //'/src="(.+?)"/' => 'src="'.ef3_import_export()->acess_url.'ef3-placeholder-image.jpg"'
    );
}

add_filter('ef3-replace-theme-options', 'book_junky_replace_theme_options');

function book_junky_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'book_junky_enable_create_demo');

function book_junky_enable_create_demo(){
    return false;
}

/**
 * Set woo page.
 *
 * get array woo page title and update options.
 *
 * @author FOX
 */
function book_junky_set_page(){
    
    $woo_pages = array(
        'woocommerce_shop_page_id' => 'Shop',
        'woocommerce_cart_page_id' => 'Shop Cart',
        'woocommerce_checkout_page_id' => 'Shop Checkout',
        'woocommerce_myaccount_page_id' => 'User Profile',
        'woocommerce_author_page_id' => 'Author profile',
    );
    
    foreach ($woo_pages as $key => $woo_page){
    
        $page = get_page_by_title($woo_page);
    
        if(!isset($page->ID))
            return ;
             
        update_option($key, $page->ID);
    
    }
}

add_action('ef3-import-finish', 'book_junky_set_page');