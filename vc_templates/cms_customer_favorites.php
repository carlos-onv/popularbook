<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: Kenji
 */

$fav = $atts['datas'];

$item = $atts['cms_limit'];

$item_class = '';

switch ($item) {
	case '1':
		$item_class = 'col-xs-12';
		break;
	case '2':
		$item_class = 'col-xs-12 col-sm-6';
		break;
	case '3':
		$item_class = 'col-xs-12 col-sm-4 col-md-4';
		break;
	case '4':
		$item_class = 'col-xs-12 col-sm-4 col-md-3';
		break;
    case '5':
        $item_class = 'col-xs-12 col-sm-4 col-md-3 new-col-lg-5';
        break;

	case '6':
		$item_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-2';
		break;
	
	default:
		$item_class = 'col-xs-12 col-sm-4 col-md-3';
		break;
}

if ($fav ->have_posts()) { ?>
<div class="cms-grid-wraper grid-2 cs-fav">
	<div class="row">

        <?php 
        $size = 'shop_catalog';

        while($fav ->have_posts()){

        	global $product,$opt_meta_options;
            $fav ->the_post();
        	$box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
			$hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
			$out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
			$styles_hover = 'onmouseover="'.$hover. '"';
			$onmouseout = 'onmouseout="'.$out.'"';

            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

                $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
            else:

                $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
            endif;

            ?>

            <div class="cs-fav-item <?php echo esc_attr($item_class);?>">
	            <div class="cms-grid-media" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> >
	            	<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $thumbnail; ?></a>
	            </div>
	            <div class="info-product">
	                <a class="product-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
	                <?php
                    $author_page = get_option('woocommerce_author_page_id');
                    $id_author = book_junky_get_id_term_2(get_the_ID());

                    ?>
                    <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
		                <p class="product-author"><?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?></p>
		            </a>

					<?php

						/**
						 * woocommerce_after_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<?php echo book_junky_get_review_product( get_the_ID(),false ); ?>
				</div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
}





