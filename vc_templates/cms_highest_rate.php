<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
$posts = $atts['data'];
global $opt_meta_options;
$size = 'shop_catalog';
$title = !empty($atts['cms_title']) ? $atts['cms_title'] : '';
$class = !empty($atts['extend']) ? $atts['extend'] : '';
$shop_page_url = get_permalink(wc_get_page_id('shop'));
/* Add main.js */
wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', '', 'all', true);
wp_enqueue_style('owl-carousel-style');
?>

<div class="carousel-product <?php echo esc_attr($class); ?>">

    <p class="title-carousel"><?php echo esc_attr($title); ?></p>

    <div class="owl-carousel owl-theme" id="carousel-product">
        <?php

        foreach ($posts as $book) {
            
            $color_item = get_post_meta($book->ID, 'ef3-color_item', true);
            $item_background = get_post_meta($book->ID, 'ef3-item_background', true);
            $bg_item_bg = !empty($item_background['background-image']) ? $item_background['background-image'] : '';
            $bg_item_color = !empty($item_background['background-color']) ? $item_background['background-color'] : '';
            $style = '';
            $style_text = "";
            $text_color = "white";
            $o = 0;

            if (!empty($bg_item_bg)) {

                $style = 'background-image: url("' . $bg_item_bg . '");background-size: cover;background-repeat: no-repeat;';
            } elseif (!empty($bg_item_color)) {
                $rgb = book_junky_get_text_color_by_bg($bg_item_color);
                $o = round(((intval($rgb["r"]) * 299) +
                        (intval($rgb["g"]) * 587) +
                        (intval($rgb["b"]) * 114)) / 1000);
                $text_color = ($o > 125) ? "black" : "white";
                $style_text = 'color:' . $text_color . ';';
                $style = 'background-color: ' . $bg_item_color . ';';
            } elseif (!empty($color_item)) {
                $rgb = book_junky_get_text_color_by_bg($color_item);
                $o = round(((intval($rgb["r"]) * 299) +
                        (intval($rgb["g"]) * 587) +
                        (intval($rgb["b"]) * 114)) / 1000);
                $text_color = ($o > 125) ? "black" : "white";
                $style_text = 'color:' . $text_color . ' !important;';
                $style = 'background-color: ' . $color_item . ';color:' . $text_color . ';';
            } else {

                $style = 'background-image: url("' . get_template_directory_uri() . 'assets/images/page_title_bg.jpg");';
            }
            ?>

            <div class="cms-carousel-item clearfix" style="<?php echo esc_html($style) ?>">

                <a class="title-product" style="<?php echo esc_html($style_text) ?>"
                   href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr( $book ->post_title); ?></a>

                <div class="wrap-info">

                    <p class="product-author" style="<?php echo esc_html($style_text) ?>">

                        <?php
                        echo esc_html__('by: ', 'book-junky');
                        echo book_junky_get_author($book->ID);
                        ?>
                    </p>
                    <?php echo book_junky_get_review_product($book->ID, true, $text_color); ?>
                    <div class="excerpt-product" style="<?php echo esc_html($style_text) ?>">

                        <?php echo wp_trim_words(get_the_excerpt($book->ID), '13', ''); ?>
                    </div>
                    <a class="view-shop"
                       style="color: <?php echo ($o <= 125) ? esc_attr($color_item) : "black"; ?>"
                       href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('View in Book Store', 'book-junky'); ?>
                        <i class="zmdi zmdi-long-arrow-right"></i></a>
                </div>

                <?php
                if (wp_get_attachment_image_src(get_post_thumbnail_id($book->ID), $size, false)):

                    $thumbnail = get_the_post_thumbnail($book->ID, $size);
                else:

                    $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . esc_attr( $book ->post_title) . '" />';
                endif;

                echo '<div class="post-thumbnail" style="box-shadow:0 5px 8px' . $color_item . '">' . $thumbnail . '</div>';
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>