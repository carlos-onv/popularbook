<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 20.6.0
 * Theme 	Book Junky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

wc_print_notices();

if (is_user_logged_in()) {

	$user = wp_get_current_user();
}

?>

<div class="wrap-profile">
<div class="row">
	<div class="col-xs-12 col-md-5">
		<div class="account-nav">
			<div class="wrap-user clearfix">
				<div class="bj-user-head-logo">
					
	                <?php echo get_avatar($user->ID, 85) ?>
	            </div>

	            <div class="bj-user-name">

                	<?php echo esc_attr($user->display_name) ?>
                </div>
			</div>
			<?php

				/**
				 * My Account navigation.
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_navigation' );
			?>
		</div>
	</div>
	<div class="wrap-account-content col-xs-12 col-md-7">
		<div class="account-content">
			<?php
				/**
				 * My Account content.
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>
</div>
</div>




