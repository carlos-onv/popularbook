<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     20.0.0
 * Theme        Book Junky
 */
global $opt_theme_options, $wpdb;
$column_iteam = !empty($opt_theme_options['woo_columns_layout']) ? $opt_theme_options['woo_columns_layout'] : '6';

$items = 12 / $column_iteam;
$items = 5;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$shop_column = $shop_sidebar = '';

if (is_active_sidebar('woo-sidebar')) {

    $shop_column = 'no-sidebar';
} else {

    $shop_column = 'en_sidebar';
}

get_header(); ?>

<div class="book-junky-shop <?php echo esc_attr($shop_column); ?>">
    <div class="wrap-search-shop">
        <?php echo do_shortcode('[cms_search_book]'); ?>
    </div>

    <div class="wrap-archive">
        <div class="row">
            <?php if (have_posts()) :
                global $wp_the_query; ?>
                <?php $i = 1;
                $count = $wp_the_query->post_count;
                ?>

                <?php if (is_active_sidebar('woo-sidebar') ) : ?>

                    <div class="sidebar-filter col-xs-12 col-md-4 col-lg-3">

                        <?php dynamic_sidebar('woo-sidebar'); ?>
                    </div>
                <?php endif; ?>

                <div class="col-xs-12 col-md-8 col-lg-9">
                    <div class="shop-content">
						<div>
							<h1>Shop Textbooks</h1>
						</div>
                        <div class="catalog_ordering clearfix">

                            <?php

                            /**
                             * woocommerce_before_shop_loop hook.
                             *
                             * @hooked wc_print_notices - 10
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action('woocommerce_before_shop_loop');
                            ?>
                        </div>

                        <div class="book-junky-products">
                            <div class="row">
                            <?php while (have_posts()) : the_post(); ?>

                                <?php /*if (($i % $items == 1) || ($i == 1)) : ?>
                                    <div class="row">
                                <?php endif;*/ ?>

                                <?php

                                /**
                                 * woocommerce_shop_loop hook.
                                 *
                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                 */
                                do_action('woocommerce_shop_loop');
                                ?>

                                <?php wc_get_template_part('content', 'product'); ?>
                                <?php /*if (($i % $items == 0) || ($i == ($count))) : ?>
                                    </div>
                                <?php endif;*/ ?>

                                <?php $i++; ?>
                            <?php endwhile; // end of the loop. ?>
                            </div>
                            <?php book_junky_paging_nav(); ?>
                        </div>
                        
                    </div>
                </div>

            <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                <?php

                /**
                 * woocommerce_no_products_found hook.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
                ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
