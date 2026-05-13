<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<style>
    #content.site-content {
        background-color: rgba(249, 250, 252, 1);
    }
    #content-ty{
        text-align: center;
        font-family: 'Montserrat';
    }
    #content-ty p{
        font-size: 22.6px;
        font-weight: 500;
        line-height: 27.54px;
    }
    #content-ty h1 {
        font-size: 39.22px;
        color: #000;
        font-weight: 700;
    }
    #best-sell .wpb_wrapper .title-product {
        font-size: 18px;
        color: #0f120b;
        font-family: "averta-regular";
    }
    #best-sell .wpb_wrapper .price {
        color: #af0128 !important;
        font-size: 14px !important;
        font-family: "averta-regular";
        font-weight: bold;
    }
    #best-sell .product-content {
        margin-top: 4%;
        padding: 0 10%;
        text-align: center;
    }
    .wpb_gallery_slides.wpb_image_grid {
        margin: 0 auto;
    }
</style>

<div class="woocommerce-order"> 
 
	<?php 
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
		
		    <div>
                <?php
                    /*$image_ids = array();
                    foreach ($order->get_items() as $item_id => $item ) {
                        $product_id = $item->get_product()->get_id();
                        $image_id = get_post_thumbnail_id( $product_id );
                        $image_ids[] = $image_id;
                    }*/
                
            	    echo do_shortcode('[vc_row row_visible="" row_border="" el_id="content-ty"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text el_class="text-404"]</p>
                    <h1>Thank You!</h1>
                    <p>Your order successfully been placed.[/vc_column_text][vc_btn title="Go Back" style="custom" custom_background="#af0128" custom_text="#ffffff" align="center" css=".vc_custom_1711993218891{padding-top: 16px !important;padding-right: 37px !important;padding-bottom: 16px !important;padding-left: 37px !important;}" link="url:https%3A%2F%2Fwww.popularbook.ca%2F"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]');
            ?>
            </div>

			<?php //wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>
	
	<?php echo do_shortcode('[vc_row row_visible="" row_border="" css=".vc_custom_1654030808554{background-color: #f9fafc !important;}" el_id="best-sell"][vc_column][vc_custom_heading heading_layout="heading-2" text="RECOMMENDED PRODUCTS" font_container="tag:h2|font_size:25px|text_align:center|color:%23888a92" google_fonts="font_family:averta-bold%3Aregular|font_style:700%20Normal%3A400%3Anormal"][/vc_column][vc_column offset=""][products columns="6" orderby="title" order="ASC" ids="1682, 1467, 2978, 14092, 20184, 20162"][/vc_column][/vc_row]'); ?>
            
</div>


