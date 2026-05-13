<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     10.6.4
 * Theme     	Book Junky
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
 
    $classes[] = 'single-product';
     
    return $classes;
}



get_header(); ?>
<?php
if(isset($_POST) && count($_POST)>1 && isset($_POST['quantity']))
{
    $product = wc_get_product( get_the_ID() );
    
?>
<script>

if (typeof spdt === 'function') {
  spdt('addtocart', {
    value: '<?php echo $product->get_price(); ?>', // Dynamically populate from session data
    currency: 'CAD', // Dynamically populate from session data
    });
  } else {
    console.warn('Spotify pixel not loaded yet.');
  }



/*

w.spdt('addtocart', {
 value: '<?php echo $product->get_price(); ?>',
 currency: 'CAD',
});
*/
</script>
<?php
}
?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

<?php get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
