<?php

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_rating', 'woocommerce_template_loop_rating', 5 );
add_action( 'add_to_cart', 'woocommerce_template_loop_add_to_cart', 5 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );


/* Get Content Product */
function book_junky_get_info_product() {
    global $product,$opt_theme_opions,$opt_meta_options;

    $id_product = $page_title = '';
    if(!empty($opt_theme_opions['select_product']) ) {

        $id_product = $opt_theme_opions['select_product'];
    } elseif( !empty($opt_meta_options['select_product']) && is_page() && !empty($opt_meta_options['custom_page_title']) ) {

        $id_product = $opt_meta_options['select_product'];
    } else {

        $id_product = '100';
    }

    if(!empty($opt_theme_opions['page_title_4']) ) {

        $page_title = $opt_theme_opions['page_title_4'];
    } elseif($opt_meta_options['page_title_4'] && is_page() && !empty($opt_meta_options['custom_page_title'])) {

        $page_title = $opt_meta_options['page_title_4']; 
    } else {

        $page_title = 'This Weeks Book Review';
    }



    $check = get_post_meta( $id_product, 'ef3-color_item', true);
    $box_shadow = !empty($check) ? $check : '#3c2a88';

    $item_background = get_post_meta($id_product, 'ef3-item_background', true);
    $bg_item_bg = !empty($item_background['background-image']) ? $item_background['background-image'] : '';
    $bg_item_color = !empty($item_background['background-color']) ? $item_background['background-color'] : '';
    $style = '';

    if( !empty($bg_item_bg) ) {

        $style = 'background-image: url("'.$bg_item_bg.'");background-size: cover;background-repeat: no-repeat;';
    } elseif( !empty($bg_item_color) ) {

        $style = 'background-color: '.$bg_item_color.';';
    } elseif( !empty($check) ) {

        $style = 'background-color: '.$check.';';
    } else {

        $style = 'background-image: url("' . get_template_directory_uri() . '/assets/images/page_title_bg.jpg");';
    }

    $args_query = array(

        'post_type' => 'product',
        'p' => $id_product,
    );
    $info_product = new WP_Query($args_query);

    if ( $info_product ->have_posts() ) {
        $info_product ->the_post();

        ?>
            <div class="page-title-product" style="<?php echo esc_attr($style); ?>">

                <div class="container">

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="wrap-thumbnail" style="box-shadow: 0 5px 15px -5px <?php echo esc_attr($box_shadow); ?>" >

                                <?php echo the_post_thumbnail( 'shop_catalog_image_size' ); ?>
                            </div>

                            <div class="wrap-content">

                                <h5><?php echo esc_attr($page_title); ?></h5>

                                <h4><?php the_title(); ?></h4>

                                <div><?php echo book_junky_get_review_product($id_product); ?></div>

                                <p><?php echo wp_trim_words( get_the_content(), '50', ''); ?></p>

                                <a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read Review','book-junky'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    wp_reset_postdata();
}

/* Get Content Product */
function book_junky_get_info_product_2() {
    global $product,$opt_theme_opions,$opt_meta_options;

    $id_product = $page_title = '';
    if(!empty($opt_theme_opions['select_product_2']) ) {

        $id_product = $opt_theme_opions['select_product_2'];
    } elseif( !empty($opt_meta_options['select_product_2']) && is_page() && !empty($opt_meta_options['custom_page_title']) ) {

        $id_product = $opt_meta_options['select_product_2'];
    } else {

        $id_product = '100';
    }

    if(!empty($opt_theme_opions['page_title_4_2']) ) {

        $page_title = $opt_theme_opions['page_title_4_2'];
    } elseif($opt_meta_options['page_title_4_2'] && is_page() && !empty($opt_meta_options['custom_page_title'])) {

        $page_title = $opt_meta_options['page_title_4_2']; 
    } else {

        $page_title = 'This Weeks Book Review';
    }

    $args_query = array(

        'post_type' => 'product',
        'p' => $id_product,
    );
    $info_product = new WP_Query($args_query);

    if ( $info_product ->have_posts() ) {
        global $opt_meta_options;

        $info_product ->the_post();

        $check = get_post_meta( $id_product, 'ef3-color_item', true);
        $box_shadow = !empty($check) ? $check : '#3c2a88';
        $id_avt = get_term_meta( $id_product,"bj_avatar",true);

        $item_background = get_post_meta($id_product, 'ef3-item_background', true);
        $bg_item_bg = !empty($item_background['background-image']) ? $item_background['background-image'] : '';
        $bg_item_color = !empty($item_background['background-color']) ? $item_background['background-color'] : '';
        $style = '';

        if( !empty($bg_item_bg) ) {

            $style = 'background-image: url("'.$bg_item_bg.'");background-size: cover;background-repeat: no-repeat;';
        } elseif( !empty($bg_item_color) ) {

            $style = 'background-color: '.$bg_item_color.';';
        } elseif( !empty($check) ) {

            $style = 'background-color: '.$check.';';
        } else {

            $style = 'background-image: url("' . get_template_directory_uri() . '/assets/images/page_title_bg.jpg");';
        }

        if( !empty($id_avt) ) {

            $term_avt = wp_get_attachment_image_src( $id_avt, 'book_junky_500X500', false);

            $url_avt = $term_avt[0];
        } else {

            $url_avt = get_template_directory_uri() . '/assets/images/author.png';
        }

        ?>
            <div class="page-title-product_2" style="<?php echo esc_attr($style); ?>">

                <div class="container">
                    <div class="wrap-title-product">
                    <div class="row">

                        <div class="col-xs-12">
                        
                            <h5><?php echo esc_attr($page_title); ?></h5>
                        </div>

                        <div class="col-xs-12">

                            <div class="wrap-thumbnail" style="box-shadow: 0 5px 15px -5px <?php echo esc_attr($box_shadow); ?>" >

                                <?php echo the_post_thumbnail( 'shop_catalog_image_size' ); ?>
                            </div>

                            <div class="wrap-content">

                                <div class="author">
                                    <img src="<?php echo esc_url($url_avt); ?>" alt="<?php esc_html__("Avt Author", "book-junky"); ?>">
                                    <?php echo book_junky_get_author($id_product); ?>
                                </div>

                                <h4><?php the_title(); ?></h4>

                                <div><?php echo book_junky_get_review_product($id_product); ?></div>

                                <p><?php echo wp_trim_words( get_the_content(), '50', ''); ?></p>

                                <a class="re-view" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read Review','book-junky'); ?></a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }

    wp_reset_postdata();
}

function book_junky_info_single_product() {
    global $product;

    $id_product = get_the_ID();

    $public = get_the_terms( $id_product,"pa_originally_published",true);
    $hardcover = get_the_terms( $id_product,"pa_hardcover",true);
    $language = get_the_terms( $id_product,"pa_language",true);
    $cat = wc_get_product_category_list( $id_product, ', ');

    ?>
        <ul><?php if( !empty($cat) ) : ?>
            <li>
                <div class="info-single-title"><?php echo esc_html('Genre','book-junky'); ?>:</div>
                <span>
                    <?php

                        echo $cat;
                    ?>
                </span>
            </li>
            <?php endif; ?>
            
            <?php if( !empty($public) ) : ?>
            <li>
                <div class="info-single-title"><?php echo esc_html('Originally Published','book-junky'); ?>:</div>
                <span>
                    <?php
                        foreach ($public as $key) {
                            echo $key ->name;
                        }
                    ?>
                </span>
            </li>

            <?php endif; ?>
            
            <?php if( !empty($hardcover) ) : ?>
            <li>
                <div class="info-single-title"><?php echo esc_html('Hardcover','book-junky'); ?>:</div>
                <span>
                    <?php
                        foreach ($hardcover as $key) {
                            echo $key ->name;
                        }
                    ?>
                </span>
            </li>

            <?php endif; ?>
            
            <?php if( !empty($language) ) : ?>
            <li>
                <div class="info-single-title"><?php echo esc_html('Language','book-junky'); ?>:</div>
                <span>
                    <?php
                        $s = array();
                        foreach ($language as $attr_value) {
                            $s[] = $attr_value->name;
                        }
                        echo implode(', ', $s);
                    ?>
                </span>
            </li>

            <?php endif; ?>
        </ul>
    <?php
}


function book_junky_single_detail() {
    global $product;

    $id_product = get_the_ID();

    $publisher = get_the_terms( $id_product,"pa_publisher",true);
    $hardcover = get_the_terms( $id_product,"pa_hardcover",true);
    $ime = get_the_terms( $id_product,"pa_isbn",true);
    $dimensions = get_the_terms( $id_product,"pa_dimensions",true);
    $language = get_the_terms( $id_product,"pa_language",true);

    ?>
        <ul>
            <li>
                <span class="info-single-title"><?php echo esc_html('Hardcover','book-junky'); ?>:</span>
                <span>
                    <?php
                        if( !empty( $hardcover ) ) {

                            foreach ($hardcover as $key) {
                                echo $key ->name;
                            }
                        } else {

                            echo "NA";
                        }
                    ?>
                </span>
            </li>
            <li>
                <span class="info-single-title"><?php echo esc_html('Publisher','book-junky'); ?>:</span>
                <span>
                    <?php
                        if( !empty( $publisher ) ) {

                            foreach ($publisher as $key) {
                                echo $key ->name;
                            }
                        } else {

                            echo "NA";
                        }
                    ?>
                </span>
            </li>
            <li>
                <span class="info-single-title"><?php echo esc_html('Language','book-junky'); ?>:</span>
                <span>
                    <?php
                        if( !empty( $language ) ) {

                            $s = array();
                            foreach ($language as $attr_value) {
                                $s[] = $attr_value->name;
                            }
                            echo implode(', ', $s);
                        } else {

                            echo "NA";
                        }
                    ?>
                </span>
            </li>
            <li>
                <span class="info-single-title"><?php echo esc_html('ISBN-10','book-junky'); ?>:</span>
                <span>
                    <?php
                        if( !empty( $ime ) ) {

                            foreach ($ime as $key) {
                                echo $key ->name;
                            } 
                        } else {

                            echo "NA";
                        }
                    ?>
                </span>
            </li>
            <li>
                <span class="info-single-title"><?php echo esc_html('Dimensions','book-junky'); ?>:</span>
                <span>
                    <?php
                        if( !empty( $dimensions ) ) {

                            foreach ($dimensions as $key) {
                                echo $key ->name;
                            } 
                        } else {

                            echo "NA";
                        }
                    ?>
                </span>
            </li>
        </ul>
    <?php
}

function book_junky_share_book(){
    $url = get_the_permalink();
    $title = get_the_title();
    ?>

    <div class="wrap-share">
        <ul class="list-unstyled clearfix">
            <li>
                <a class="facebook" title="<?php esc_html_e('Share this article to Facebook','book-junky'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($url);?>&t=<?php echo esc_html($title); ?>">
                    <i class="zmdi zmdi-facebook"></i>
                </a>
            </li>
            <li>
                <a class="twitter" title="<?php esc_html_e('Share this article to Twitter','book-junky'); ?>"  target="_blank" href="https://twitter.com/home?status=<?php echo esc_html__('Check out this article','book-junky');?>:%20<?php echo esc_attr($title);?>%20-%20<?php echo esc_url($url);?>">
                    <i class="zmdi zmdi-twitter"></i>
                </a>
            </li>
            
            <li>
                <a class="email" title="<?php esc_html_e('Share this article to GooglePlus','book-junky'); ?>" target="_blank" href="mailto:?body=<?php echo esc_url($url);?>"><i class="zmdi zmdi-email"></i>
                </a>
            </li>
        </ul>
    </div>

    <?php
}



































