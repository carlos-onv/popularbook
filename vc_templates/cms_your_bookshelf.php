<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */

$book_shelf = $atts['datas'];

if (!empty($book_shelf)) :

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
            $item_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-2';
            break;
    }

    ?>
    <div class="cms-grid-wraper grid-2 book_shelf">
        <div class="row">

            <?php
            $size = 'shop_catalog';
            $limit = !empty($atts['cms_limit']) ? intval($atts['cms_limit']) : 6;
            $i = 0;
            foreach ($book_shelf as $key) {
                global $product, $opt_meta_options;
                $color_item = get_post_meta($key, 'ef3-color_item', true);
                $box_shadow = !empty($color_item) ? $color_item : '#000';
                $hover = "this.style.boxShadow ='0 0 20px 0 " . $box_shadow . "';";
                $out = "this.style.boxShadow ='0 0 15px -2px " . $box_shadow . "';";
                $styles_hover = 'onmouseover="' . $hover . '"';
                $onmouseout = 'onmouseout="' . $out . '"';

                $thumbnail = get_the_post_thumbnail($key, $size);
                if ($i < $limit) {
                    ?>

                    <div class="bookshelf-item <?php echo esc_attr($item_class); ?>">
                        <div class="cms-grid-media"
                             style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> >
                            <a
                                    href="<?php echo esc_url(get_permalink($key)); ?>"><?php echo $thumbnail; ?></a>
                        </div>
                        <div class="info-product">
                            <a class="product-title"
                               href="<?php echo esc_url(get_permalink($key)); ?>"><?php echo get_the_title($key); ?></a>
                            <?php
                                    $author_name = book_junky_get_author( $key );

                                    if ( !empty($author_name) ) : 
                                    
                                    $author_page = get_option('woocommerce_author_page_id');
                                    $id_author = book_junky_get_id_term_2($key);
                                    ?>
                                    <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
                                        <p class="product-author">
                                            <?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( $key ); ?>
                                        </p>
                                    </a>
                                <?php endif; ?>

                            <?php

                            $price = get_post_meta($key, '_regular_price', true);
                            $sale = get_post_meta($key, '_sale_price', true);
                            ?>

                            <span class="price">
        					<?php if (!empty($sale)) : ?>
                                <del>
    								<span class="woocommerce-Price-amount amount">
    								<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol(); ?></span><?php echo esc_attr($sale); ?></span>
    							</del>
                            <?php endif; ?>

                                <ins>
    							<span class="woocommerce-Price-amount amount">
    							<span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol(); ?></span><?php echo esc_attr($price); ?></span>
    						</ins>
    					</span>

                        </div>
                    </div>
                    <?php
                }
                $i++;
            }
            ?>
        </div>
    </div>
    <?php
else :
    echo "<div class='empty-bookshelf text-center'><p>" . esc_html__('BookShelf Empty!', 'book-junky') . "</p></div>";
endif;
?>





