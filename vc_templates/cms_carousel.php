<?php
$style = "carousel-1";
if (!empty($atts['carousel_layout'])) {
    $style = $atts['carousel_layout'];
}

switch ($style) {
    case 'carousel-1':
        $posts = $atts['posts'];
        $size = 'book_junky_500X500';
        $title = !empty($atts['carousel_title']) ? $atts['carousel_title'] : 'Carousel Title';
        ?>
        <div class="carousel-testimonials">

            <h4 class="title-carousel"><?php echo esc_attr($title); ?></h4>

            <div class="cms-carousel owl-carousel" id="<?php echo esc_attr($atts['html_id']); ?>">
                <?php

                while ($posts->have_posts()) {

                    global $opt_meta_options;

                    $posts->the_post();

                    ?>

                    <div class="cms-carousel-item">

                        <?php the_content(); ?>

                        <div class="wrap-image">

                            <?php
                            if (has_post_thumbnail() && !post_password_required() && !is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

                                $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                            else:

                                $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';
                            endif;

                            echo '<div class="post-thumbnail">' . $thumbnail . '</div>';
                            ?>

                            <div class="wrap-info">

                                <h5><?php the_title(); ?></h5>

                                <?php if (!empty($opt_meta_options['location'])) : ?>

                                    <span><?php echo $opt_meta_options['location']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php break;

    case 'carousel-2' :

        $posts = $atts['posts'];
        $size = 'book_junky_450X500';

        ?>
        <div class="carousel-team-1">

            <div class="cms-carousel owl-carousel" id="<?php echo esc_attr($atts['html_id']); ?>">

                <?php

                while ($posts->have_posts()) {

                    global $opt_meta_options;

                    $posts->the_post();

                    ?>
                    <div class="cms-carousel-item">

                        <?php
                        if (has_post_thumbnail() && !post_password_required() && !is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

                            $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                        else:

                            $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';
                        endif;

                        echo '<div class="post-thumbnail">' . $thumbnail . '</div>';
                        ?>

                        <div class="wrap-info">

                            <h5><?php the_title(); ?></h5>

                            <?php if (!empty($opt_meta_options['position'])) : ?>

                                <span><?php echo $opt_meta_options['position']; ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($opt_meta_options['facebook_url']) || !empty($opt_meta_options['twitter_url']) || !empty($opt_meta_options['linkedin_url']) || !empty($opt_meta_options['instagram_url']) || !empty($opt_meta_options['google_url'])) : ?>

                            <ul class="wrap-social">

                                <?php if (!empty($opt_meta_options['facebook_url'])) : ?>

                                    <li><a href="<?php echo esc_url($opt_meta_options['facebook_url']); ?>"><i
                                                    class="zmdi zmdi-facebook"></i></a></li>
                                <?php endif; ?>

                                <?php if (!empty($opt_meta_options['twitter_url'])) : ?>

                                    <li><a href="<?php echo esc_url($opt_meta_options['twitter_url']); ?>"><i
                                                    class="zmdi zmdi-twitter"></i></a></li>
                                <?php endif; ?>

                                <?php if (!empty($opt_meta_options['linkedin_url'])) : ?>

                                    <li><a href="<?php echo esc_url($opt_meta_options['linkedin_url']); ?>"><i
                                                    class="zmdi zmdi-linkedin"></i></a></li>
                                <?php endif; ?>

                                <?php if (!empty($opt_meta_options['instagram_url'])) : ?>

                                    <li><a href="<?php echo esc_url($opt_meta_options['instagram_url']); ?>"><img
                                                    src="<?php echo get_template_directory_uri() . '/assets/images/instagram.png'; ?>"
                                                    alt="Instagram"></a></li>
                                <?php endif; ?>

                                <?php if (!empty($opt_meta_options['google_url'])) : ?>

                                    <li><a href="<?php echo esc_url($opt_meta_options['google_url']); ?>"><i
                                                    class="zmdi zmdi-google"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php break;

    case 'carousel-3' :

        $posts = $atts['posts'];
        $size = 'book_junky_500X500';

        ?>
        <div class="carousel-team-2">

            <div class="cms-carousel owl-carousel" id="<?php echo esc_attr($atts['html_id']); ?>">
                <?php

                while ($posts->have_posts()) {

                    global $opt_meta_options;

                    $posts->the_post();
                    ?>
                    <div class="cms-carousel-item">
                        <?php

                        if (has_post_thumbnail() && !post_password_required() && !is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

                            $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                        else:

                            $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';
                        endif;
                        ?>

                        <div class="wrap-thumbnail">

                            <?php echo $thumbnail; ?>

                            <?php if (!empty($opt_meta_options['facebook_url']) || !empty($opt_meta_options['twitter_url']) || !empty($opt_meta_options['linkedin_url']) || !empty($opt_meta_options['instagram_url']) || !empty($opt_meta_options['google_url'])) : ?>

                                <ul class="wrap-social">

                                    <?php if (!empty($opt_meta_options['facebook_url'])) : ?>

                                        <li><a href="<?php echo esc_url($opt_meta_options['facebook_url']); ?>"><i
                                                        class="zmdi zmdi-facebook"></i></a></li>
                                    <?php endif; ?>

                                    <?php if (!empty($opt_meta_options['twitter_url'])) : ?>

                                        <li><a href="<?php echo esc_url($opt_meta_options['twitter_url']); ?>"><i
                                                        class="zmdi zmdi-twitter"></i></a></li>
                                    <?php endif; ?>

                                    <?php if (!empty($opt_meta_options['linkedin_url'])) : ?>

                                        <li><a href="<?php echo esc_url($opt_meta_options['linkedin_url']); ?>"><i
                                                        class="zmdi zmdi-linkedin"></i></a></li>
                                    <?php endif; ?>

                                    <?php if (!empty($opt_meta_options['instagram_url'])) : ?>

                                        <li><a href="<?php echo esc_url($opt_meta_options['instagram_url']); ?>"><img
                                                        src="<?php echo get_template_directory_uri() . '/assets/images/instagram.png'; ?>"
                                                        alt="Instagram"></a></li>
                                    <?php endif; ?>

                                    <?php if (!empty($opt_meta_options['google_url'])) : ?>

                                        <li><a href="<?php echo esc_url($opt_meta_options['google_url']); ?>"><i
                                                        class="zmdi zmdi-google"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="wrap-info">

                            <h5><?php the_title(); ?></h5>

                            <?php if (!empty($opt_meta_options['position'])) : ?>

                                <span><?php echo $opt_meta_options['position']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php break;

    case 'carousel-4':
        global $opt_meta_options;
        $posts = $atts['posts'];
        $size = 'shop_catalog';
        $title = !empty($atts['carousel_title']) ? $atts['carousel_title'] : '';
        $class = !empty($atts['extend']) ? $atts['extend'] : '';
        $shop_page_url = get_permalink(wc_get_page_id('shop'));

        ?>
        <div class="carousel-product <?php echo esc_attr($class); ?>">

            <p class="title-carousel"><?php echo esc_attr($title); ?></p>

            <div class="cms-carousel owl-carousel" id="<?php echo esc_attr($atts['html_id']); ?>">
                <?php

                while ($posts->have_posts()) {

                    $posts->the_post();

                    $color_item = get_post_meta(get_the_ID(), 'ef3-color_item', true);
                    $item_background = get_post_meta(get_the_ID(), 'ef3-item_background', true);
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
                           href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>

                        <div class="wrap-info">
                            <?php
                                $author_name = book_junky_get_author( get_the_ID() );

                                if ( !empty($author_name) ) : 
                                
                                $author_page = get_option('woocommerce_author_page_id');
                                $id_author = book_junky_get_id_term_2(get_the_ID());
                                ?>
                                <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
                                    <p class="product-author">
                                        <?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?>
                                    </p>
                                </a>
                            <?php endif; ?>
                            <?php echo book_junky_get_review_product(get_the_ID(), true, $text_color); ?>
                            <div class="excerpt-product" style="<?php echo esc_html($style_text) ?>">

                                <?php echo wp_trim_words(get_the_excerpt(), '13', ''); ?>
                            </div>
                            <a class="view-shop"
                               style="color: <?php echo ($o <= 125) ? esc_attr($color_item) : "black"; ?>"
                               href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('View in Book Store', 'book-junky'); ?>
                                <i class="zmdi zmdi-long-arrow-right"></i></a>
                        </div>

                        <?php
                        if (has_post_thumbnail() && !post_password_required() && !is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

                            $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                        else:

                            $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';
                        endif;

                        echo '<div class="post-thumbnail" style="box-shadow:0 5px 8px' . $color_item . '">' . $thumbnail . '</div>';
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php break;

    default:
        echo "Kennji";
        break;
}