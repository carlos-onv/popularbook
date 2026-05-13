<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     20.3.0
 * Theme        Book Junky
 */

if (!defined('ABSPATH')) {
    exit;
}

global $opt_theme_options;

$phone_sp = !empty($opt_theme_options['phone_sp']) ? $opt_theme_options['phone_sp'] : '+00000000';

wc_print_notices();

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
    return;
}
?>

<div class="wrap-checkout">

    <div class="row">

        <div class="col-xs-12 col-md-7 col-lg-8">
            <div class="content-checkout">
                <div class="wrap-header-checkout clearfix">

                    <h3><?php esc_html_e('Checkout', 'book-junky'); ?></h3>

                    <div class="wrap-contact-checkout">
                        <i class="zmdi zmdi-phone"></i>
                        <p><?php esc_html_e('For all enquiries please call', 'book-junky'); ?></p>
                        <a href="tel:<?php echo esc_attr($phone_sp); ?>"><?php echo esc_attr($phone_sp); ?></a>
                    </div>
                </div>

                <div class="wrap-content-checkout">
                    <?php woocommerce_checkout_login_form(); ?>

                    <form name="checkout" method="post" class="checkout woocommerce-checkout"
                          action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                        <div id="checkout-owl">

                            <?php if ($checkout->get_checkout_fields()) : ?>

                                <?php do_action('woocommerce_checkout_billing'); ?>

                                <div class="wrap-shipping bj-checkout-form" data-form-type="shipping">
                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                </div>

                            <?php endif; ?>

                            <div id="order_review" class="woocommerce-checkout-review-order bj-checkout-form"
                                 data-form-type="payment">
                                <?php do_action('woocommerce_checkout_order_review'); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-5 col-lg-4">
            <div class="checkout-detail">
                <?php woocommerce_checkout_coupon_form(); ?>
                <?php woocommerce_order_review($deprecated = false); ?>
            </div>
        </div>
    </div>
</div>
