<?php

/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Kenji
 */

?>
<div id="cshero-header" class="header-3">

    <?php book_junky_header_3_top(); ?>
    <div class="wrap-middler">
        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-md-5 col-lg-5 top-left-3">

                    <?php book_junky_header_3_logo(); ?>

                    <a href="#" class="menu"><i class="fa fa-bars"></i> <?php echo esc_html__('Menu', 'book-junky'); ?></a>
                </div><!-- col-4-logo -->

                <div class="col-xs-12 col-md-7 col-lg-7 top-right-3 desktop">
                    <!--cut-->

                    <!--cut-->

                    <div class="wrap-free-shipping clearfix">
                        <!--<img src="<?php echo get_template_directory_uri(); ?>/assets/images/free_shipping_minimum50.png" />-->
                        <img style="width:220px;height:46px;margin-top:10px;" src="<?php esc_html_e('https://www.popularbook.ca/wp-content/uploads/free_shipping_75.png', 'book-junky') ?>" alt="<?php esc_html_e('Free shipping', 'book-junky') ?>" />
                    </div>

                    <div class="eCatalogue clearfix">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-1.png" alt="<?php esc_html_e('E-catalogue icon', 'book-junky'); ?>" />
                        <div class="content">
                            <a href="https://www.popularbook.ca/wp-content/uploads/PBC-2026-Catalogue.pdf" target="_blank">
                                <p class="header-menu-options"><?php esc_html_e('eCatalogue', ''); ?></p>
                            </a>
                        </div>
                    </div>

                    <div class="wrap-book-shelf clearfix">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-1.png'; ?>"
                            alt="<?php esc_html_e('icon 1', 'book-junky'); ?>">
                        <div class="content">
                            <?php if (class_exists('WooCommerce')) : ?>
                                <a href="<?php echo wc_get_account_endpoint_url('book-shelf'); ?>"
                                    alt="<?php esc_html_e('My Account', 'book-junky'); ?>">
                                <?php endif; ?>
                                <p class="header-menu-options"><?php esc_html_e('Wishlist', 'book-junky'); ?></p>
                                <?php if (class_exists('WooCommerce')) : ?>
                                </a>
                            <?php endif; ?>
                            <span class="aj-count">
                                <?php
                                $current_uid = get_current_user_id();

                                $count = flex_favorites_get_bookshelf_count_of_user($current_uid);

                                echo flex_favorites_get_bookshelf_count_of_user_display($count);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="wrap-your-basket clearfix">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-2.png'; ?>"
                            alt="<?php esc_html_e('icon 2', 'book-junky'); ?>">
                        <div class="content">
                            <p class="header-menu-options">
                                <?php if (class_exists('WooCommerce')) : ?>
                                    <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
                                    <?php endif; ?>

                                    <?php esc_html_e('Your Basket', 'book-junky'); ?>
                                    <?php if (class_exists('WooCommerce')) : ?>
                                    </a>
                                <?php endif; ?>
                            </p>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <span>
                                    <?php
                                    if (!WC()->cart->is_empty()) :

                                        echo WC()->cart->get_cart_subtotal();
                                    else :

                                        echo "0.00";
                                    endif;
                                    ?>
                                </span>
                            <?php else: ?>

                                <span>

                                    <?php echo "0.00"; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div><!--EO basket-->

                </div><!-- col-6-search -->

                <div class="col-xs-12 col-md-7 col-lg-7 top-right-3 mobile">
                    <div class="eCatalogue">
                        <a href="https://www.popularbook.ca/wp-content/uploads/PBCcatalogue2023-compressed.pdf" target="_blank" alt="eCatalogue">
                            <img height="35" width="35" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-1.png" alt="eCatalogue" />
                        </a>
                    </div>
                    <div class="wrap-free-shipping">
                        <a href="/" alt="shipping">
                            <img height="46" style="width:220px;height:46px;" src="<?php esc_html_e('https://www.popularbook.ca/wp-content/uploads/free_shipping_mobile-1.png', 'book-junky') ?>" alt="<?php esc_html_e('Free shipping', 'book-junky') ?>" />
                        </a>
                    </div>

                    <div class="wrap-book-shelf">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo wc_get_account_endpoint_url('book-shelf'); ?>"
                                alt="<?php esc_html_e('My Account', 'book-junky'); ?>">
                                <img height="35" width="36" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-wishlist.png'; ?>"
                                    alt="<?php esc_html_e('wishlist', 'book-junky'); ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="wrap-your-account">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                <img height="35" width="36" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/user-icon.png'; ?>"
                                    alt="<?php esc_html_e('account', 'book-junky'); ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="wrap-your-basket">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
                                <img height="35" width="36" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-cart.png'; ?>"
                                    alt="<?php esc_html_e('basket', 'book-junky'); ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- row -->
        </div><!-- #container -->
    </div><!-- wrap-middler -->

    <div class="container">

        <!--MJ-->
        <div class="row top-nav">
            <div id="top-navigation" class="col-xs-12 ">

                <nav id="site-navigation" class="main-navigation">
                    <?php header_top_navigation(); ?>
                </nav>
            </div>
        </div>
        <!--MJ-->

        <div class="row">
            <div id="header-navigation" class="col-xs-12 <?php book_junky_header_class('cshero-main-header'); ?>">

                <nav id="site-navigation" class="main-navigation">

                    <?php book_junky_header_navigation(); ?>
                </nav>
            </div>
        </div>
    </div>
</div><!-- #site-navigation -->