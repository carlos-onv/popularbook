<?php
/**
 * Affiliate Link Generator
 *
 * @author YITH
 * @package YITH\Affiliates\Templates
 * @version 2.0.0
 */

/**
 * Template variables:
 *
 * @var $affiliate      YITH_WCAF_Affiliate
 * @var $generated_url  string
 * @var $original_url   string
 * @var $share_enabled  bool
 * @var $atts           array
 * @var $share_atts     array
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly
?>

<div class="yith-wcaf yith-wcaf-link-generator woocommerce">

	<?php
	/**
	 * DO_ACTION: yith_wcaf_before_dashboard_section
	 *
	 * Allows to render some content before the section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	do_action( 'yith_wcaf_before_dashboard_section', 'generate-link', $atts );
	?>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_before_link_generator
	 *
	 * Allows to render some content before the referral link generator in the Affiliate Dashboard.
	 *
	 * @param array $atts Array with section attributes.
	 */
	do_action( 'yith_wcaf_before_link_generator', $atts );
	?>

	<div class="link-generator-box <?php echo $affiliate ? 'double-column' : 'single-column'; ?>">

		<?php if ( $affiliate ) : ?>
			<div class="affiliate-info">
				<h4>
					<?php echo esc_html_x( 'Your affiliate ID is:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?>
					<span class="regular-text"><?php echo esc_html( $affiliate->get_token() ); ?></span>
				</h4>

				<p class="form-row">
					<label class="bold-text" for="referral_url"><?php echo esc_html_x( 'Your referral URL is:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?></label>
					<span class="copy-field-wrapper">
						<?php
						/**
						 * APPLY_FILTERS: yith_wcaf_referral_link
						 *
						 * Filters the affiliate's referral link.
						 *
						 * @param string $affiliate_referral_link Affiliate's referral link.
						 */
						?>
						<input type="url" id="referral_url" class="copy-target" value="<?php echo esc_attr( apply_filters( 'yith_wcaf_referral_link', $affiliate->get_referral_url() ) ); ?>" readonly/>
						<a class="copy-trigger">
							<?php echo esc_html_x( 'Copy URL', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?>
						</a>
					</span>
				</p>

				<small>
					<?php
					/**
					 * APPLY_FILTERS: yith_wcaf_link_generator_text
					 *
					 * Filters the text in the link generator.
					 *
					 * @param string $text Text.
					 */
					echo wp_kses_post( apply_filters( 'yith_wcaf_link_generator_text', _x( 'Copy this URL and use it to redirect users to our Home Page with your affiliate ID.', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ) ) );
					?>
				</small>

				<small>
					<?php echo wp_kses_post( apply_filters( 'yith_wcaf_link_generator_text', _x( 'If you want to redirect users to a specific page (for example: a product page) use the link generator.', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ) ) ); ?>
				</small>

				<?php
				/**
				 * DO_ACTION: yith_wcaf_social_share_template
				 *
				 * Allows to render some content in the section to share the referral URL.
				 *
				 * @param array $atts Array with section attributes.
				 */
				do_action( 'yith_wcaf_social_share_template', $atts );
				?>

				<?php
				/**
				 * DO_ACTION: yith_wcaf_after_social_share_template
				 *
				 * Allows to render some content after the section to share the referral URL.
				 *
				 * @param array $atts Array with section attributes.
				 */
				do_action( 'yith_wcaf_after_social_share_template', $atts );
				?>
			</div>
		<?php endif; ?>

		<div class="link-generator">
			<h4><?php echo esc_html_x( 'Choose your banner:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?></h4>
			<p>Click on the banner to copy the HTML code and paste it on your website.</p>
			<div class="affil-banner">
			    <div>
			        <div><a href="<?php echo esc_attr( apply_filters( 'yith_wcaf_referral_link', $affiliate->get_referral_url() ) ); ?>"><img src="<?php echo "https://".$_SERVER['HTTP_HOST']; ?>/media/Affiliate_PBC_CA_Instagram.jpg" /></a></div>
			        <a class="copy-trigger-banner">Copy HTML</a>
			    </div>
			    <hr>
			    <script>
                    jQuery( document ).ready(function() {
                        jQuery( ".copy-trigger-banner" ).click(function() {
                            var copyText = jQuery(this).prev().html();
                            navigator.clipboard.writeText(copyText);
                            alert("HTML Copied");
                        });
                    });
			    </script>
			</div>
		</div>

	</div>
<style>
.affil-banner .copy-trigger-banner::before {
  background: url(https://pbcca.idlwebclients.com/wp-content/plugins/yith-woocommerce-affiliates-premium/assets/images/copy.svg);
  content: "";
  display: inline-block;
  height: 15px;
  margin-right: 5px;
  vertical-align: middle;
  width: 15px;
}
.affil-banner .copy-trigger-banner {
  cursor:pointer;
}
</style>
	<?php
	/**
	 * DO_ACTION: yith_wcaf_after_link_generator
	 *
	 * Allows to render some content after the referral link generator in the Affiliate Dashboard.
	 *
	 * @param array $atts Array with section attributes.
	 */
	do_action( 'yith_wcaf_after_link_generator', $atts );
	?>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_after_dashboard_section
	 *
	 * Allows to render some content after the section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	do_action( 'yith_wcaf_after_dashboard_section', 'link-generator', $atts );
	?>

</div>
