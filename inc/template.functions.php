<?php
/**
 * get header layout.
 */
function book_junky_header()
{
    global $opt_theme_options, $opt_meta_options;
    //echo "<pre>";print_r($opt_theme_options);print_r($opt_meta_options);echo "</pre>";

    if (empty($opt_theme_options)) {
        get_template_part('inc/header/header', '1');
        return;
    }

    if (is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

/**
 * get theme logo.
 */
function book_junky_header_logo()
{
    global $opt_theme_options;

    echo '<div class="main_logo">';

    if (isset($opt_theme_options['logo_type']) && $opt_theme_options['logo_type'] && !empty($opt_theme_options['main_logo']['url'])) {
        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' . get_bloginfo("name") . '" src="' . esc_url($opt_theme_options['main_logo']['url']) . '"></a>';
    } elseif (isset($opt_theme_options['logo_type']) && !$opt_theme_options['logo_type'] && !empty($opt_theme_options['logo_text'])) {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html($opt_theme_options['logo_text']) . '</a></h1>';

        if (!empty($opt_theme_options['logo_text_sologan']))
            echo '<p class="site-description">' . esc_html($opt_theme_options['logo_text_sologan']) . '</p>';

    } else {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo("name") . '</a></h1>';
        echo '<p class="site-description">' . get_bloginfo("description") . '</p>';
    }

    echo '</div>';
}

/**
 * get theme logo.
 */
function book_junky_header_logo_2()
{
    global $opt_theme_options;

    echo '<div class="main-logo-2">';

    if (isset($opt_theme_options['logo_type_2']) && $opt_theme_options['logo_type_2'] && !empty($opt_theme_options['main_logo_2']['url'])) {
        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' . get_bloginfo("name") . '" src="' . esc_url($opt_theme_options['main_logo_2']['url']) . '"></a>';
    } elseif (isset($opt_theme_options['logo_type_2']) && !$opt_theme_options['logo_type_2'] && !empty($opt_theme_options['logo_text_2'])) {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html($opt_theme_options['logo_text_2']) . '</a></h1>';

        if (!empty($opt_theme_options['logo_text_sologan_2']))
            echo '<p class="site-description">' . esc_html($opt_theme_options['logo_text_sologan_2']) . '</p>';

    } else {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo("name") . '</a></h1>';
        echo '<p class="site-description">' . get_bloginfo("description") . '</p>';
    }

    echo '</div>';
}

/**
 * get theme logo.
 */
function book_junky_header_3_logo()
{
    global $opt_theme_options;

    echo '<div class="main-logo-3">';

    if (isset($opt_theme_options['logo_type_3']) && $opt_theme_options['logo_type_3'] && !empty($opt_theme_options['main_logo_3']['url'])) {

        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' . get_bloginfo("name") . '" src="' . esc_url($opt_theme_options['main_logo_3']['url']) . '"></a>';
    } elseif (isset($opt_theme_options['logo_type_3']) && !$opt_theme_options['logo_type_3'] && !empty($opt_theme_options['logo_text_3'])) {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html($opt_theme_options['logo_text_3']) . '</a></h1>';

        if (!empty($opt_theme_options['logo_text_sologan_3']))
            echo '<p class="site-description">' . esc_html($opt_theme_options['logo_text_sologan_3']) . '</p>';

    } else {
        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo("name") . '</a></h1>';
        echo '<p class="site-description">' . get_bloginfo("description") . '</p>';
    }

    echo '</div>';
}

/**
 * get header class.
 */
function book_junky_header_class($class = '')
{
    global $opt_theme_options;

    if (empty($opt_theme_options)) {

        echo esc_attr($class);

        return;
    }

    if (!empty($opt_theme_options['menu_sticky'])) {

        $class .= ' sticky-desktop';
    }

    echo esc_attr($class);
}

/**
 * main navigation.
 */
function book_junky_header_navigation()
{

    global $opt_meta_options;
    //echo "<pre>";print_r($opt_meta_options);echo "</pre>";

    $attr = array(
        'menu_class' => 'nav-menu menu-main-menu',
        'theme_location' => 'primary'
    );

    if (is_page() && !empty($opt_meta_options['header_menu']))
        $attr['menu'] = $opt_meta_options['header_menu'];

    /* enable mega menu. */
    if (class_exists('HeroMenuWalker')) {
        $attr['walker'] = new HeroMenuWalker();
    }

    $locations = get_nav_menu_locations();

    if (empty($locations['primary']))
        return;

    //echo "<pre>";print_r($locations);echo "</pre>";
    /* main nav. */
    wp_nav_menu($attr);
}

/**
 * get page title layout
 */
function book_junky_page_title()
{
    if (class_exists('WooCommerce')) {
        if (is_product()) {
            return;
        }
    }

    $page_author = '';

    if (class_exists('WooCommerce')) {
        $page_author = get_option('woocommerce_author_page_id');
    }

    if (is_page($page_author)) {
        if (!empty($_REQUEST['author_id']) && !empty(term_exists(intval($_REQUEST['author_id']), 'pa_book_author'))) {
            $id = $_REQUEST['author_id'];
            $author = get_term($id);
            $name = $author->name;
            $descriptions = $author->description;
            $avatar = get_term_meta($id, 'bj_avatar', true);
            $bg_img = get_term_meta($id, 'bj_bg_image', true);
            $bg_color = get_term_meta($id, 'bj_bg_color', true);

            if (!empty($avatar)) :

                $src = wp_get_attachment_image_url($avatar, 'book_junky_500X500');
            else :

                $src = get_template_directory_uri() . '/assets/images/ex.jpg';
            endif;

            if (!empty($bg_img)) :

                $src_bg = wp_get_attachment_image_url($bg_img, 'full');
            endif;

            if (!empty($bg_img)) {

                $style = 'background-image: url("' . $src_bg . '");';
            } elseif (!empty($bg_color)) {

                $style = 'background-color: ' . $bg_color . ';';
            } else {

                $style = 'background-color: #7151ed;';
            }

            $url = get_the_permalink();
            $title = get_the_title();

            ?>
            <div class="page-title-author">
                <div class="wrap-backround" style="<?php echo esc_attr($style); ?>">
                </div>

                <div class="wrap-content">
                    <div class="avatar">
                        <img src="<?php echo esc_url($src); ?>" alt="Avatar author">
                    </div>

                    <h3 class="name-author"><?php echo esc_attr($name); ?></h3>

                    <p class="des-author"><?php echo esc_attr($descriptions); ?></p>

                    <div class="share">
                        <p class="title-share"><?php esc_html_e('SHARE THIS AUTHOR', 'book-junky'); ?></p>

                        <ul>
                            <li><a class="facebook"
                                   title="<?php esc_html_e('Share this article to Facebook', 'book-junky'); ?>"
                                   target="_blank"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($url); ?>&t=<?php echo esc_html($title); ?>"><i
                                            class="zmdi zmdi-facebook"></i></a></li>
                            <li><a class="twitter"
                                   title="<?php esc_html_e('Share this article to Twitter', 'book-junky'); ?>"
                                   target="_blank"
                                   href="https://twitter.com/home?status=<?php echo esc_html__('Check out this article', 'book-junky'); ?>:%20<?php echo esc_attr($title); ?>%20-%20<?php echo esc_url($url); ?>"><i
                                            class="zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                            <li><a title="<?php esc_html_e('Share this article to GooglePlus', 'book-junky'); ?>"
                                   target="_blank" href="mailto:?body=<?php echo esc_url($url); ?>"><i
                                            class="zmdi zmdi-email"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {

        global $opt_theme_options, $opt_meta_options;

        /* default. */
        $layout = '2';

        /* get theme options */
        if (!empty($opt_theme_options['page_title_layout'])) {
            $layout = $opt_theme_options['page_title_layout'];
        }

        if (is_page() && !empty($opt_meta_options['sub_title_en']) && !empty($opt_meta_options['custom_page_title']) && !empty($opt_meta_options['sub_title']) && (!empty($opt_meta_options['page_title_layout']) == '2')) {
            $layout = '3';
        }


        /* custom layout from page. */
        if (is_page() && !empty($opt_meta_options['custom_page_title'])) {
            $layout = $opt_meta_options['page_title_layout'];
        }

        ?>
        <?php switch ($layout) {
            case '2':
                ?>
                <div id="page-title-1" class="page-title text-center">
                    <h1><?php book_junky_get_page_title(); ?></h1>
                </div>
                <?php
                break;

            case '3':
                ?>
                <div id="page-title-2" class="page-title text-center">
                    <h1><?php book_junky_get_page_title(); ?></h1>
                    <p><?php echo esc_attr($opt_meta_options['sub_title']); ?></p>
                </div>
                <?php
                break;

            case '4':
                book_junky_get_info_product();
                break;

            case '5':
                book_junky_get_info_product_2();
                break;
        } ?>
        <?php
    }
}

/**
 * page title
 */
function book_junky_get_page_title()
{

    global $opt_meta_options;

    if (!is_archive()) {
        /* page. */
        if (is_page()) :
            /* custom title. */
            if (!empty($opt_meta_options['page_title_text'])):
                echo esc_html($opt_meta_options['page_title_text']);
            else :
                the_title();
            endif;
        elseif (is_front_page()):
            esc_html_e('Blog', 'book-junky');
        /* search */
        elseif (is_search()):
            printf(esc_html__('Search Results for: %s', 'book-junky'), '<span>' . get_search_query() . '</span>');
        /* 404 */
        elseif (is_404()):
            esc_html_e('404', 'book-junky');
        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if (is_category()) :
            single_cat_title();
        elseif (is_tag()) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif (is_author()) :
            printf(esc_html__('Author: %s', 'book-junky'), '<span class="vcard">' . get_the_author() . '</span>');
        /* date */
        elseif (is_day()) :
            printf(esc_html__('Day: %s', 'book-junky'), '<span>' . get_the_date() . '</span>');
        elseif (is_month()) :
            printf(esc_html__('Month: %s', 'book-junky'), '<span>' . get_the_date() . '</span>');
        elseif (is_year()) :
            printf(esc_html__('Year: %s', 'book-junky'), '<span>' . get_the_date() . '</span>');
        /* post format */
        elseif (is_tax('post_format', 'post-format-aside')) :
            esc_html_e('Asides', 'book-junky');
        elseif (is_tax('post_format', 'post-format-gallery')) :
            esc_html_e('Galleries', 'book-junky');
        elseif (is_tax('post_format', 'post-format-image')) :
            esc_html_e('Images', 'book-junky');
        elseif (is_tax('post_format', 'post-format-video')) :
            esc_html_e('Videos', 'book-junky');
        elseif (is_tax('post_format', 'post-format-quote')) :
            esc_html_e('Quotes', 'book-junky');
        elseif (is_tax('post_format', 'post-format-link')) :
            esc_html_e('Links', 'book-junky');
        elseif (is_tax('post_format', 'post-format-status')) :
            esc_html_e('Statuses', 'book-junky');
        elseif (is_tax('post_format', 'post-format-audio')) :
            esc_html_e('Audios', 'book-junky');
        elseif (is_tax('post_format', 'post-format-chat')) :
            esc_html_e('Chats', 'book-junky');
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

/**
 * Breadcrumb NavXT
 *
 * @since 1.0.0
 */
function book_junky_get_bread_crumb()
{

    if (!function_exists('bcn_display')) return;

    bcn_display();
}

/**
 * Display an optional post detail.
 */
function book_junky_post_detail()
{
    global $opt_theme_options;

    ?>
    <ul class="single_detail">

        <?php if (!empty($opt_theme_options['single_author'])) : ?>

            <li class="detail-author"><i class="zmdi zmdi-account"></i> <?php the_author_posts_link(); ?></li>

        <?php endif; ?>

        <?php if (has_category() && (!empty($opt_theme_options['single_categories']))) : ?>

            <li class="detail-terms"><?php the_terms(get_the_ID(), 'category', '', ', '); ?></li>

        <?php endif; ?>

        <?php if (!empty($opt_theme_options['single_comment_count'])) : ?>

            <li class="detail-comment">
                <?php echo esc_html(comments_number('0', '1', '%')); ?><?php esc_html_e(' Comments', 'book-junky'); ?>
            </li>
        <?php endif; ?>

        <?php if (!empty($opt_theme_options['single_date'])) : ?>

            <li class="detail-date"><i class="zmdi zmdi-calendar"></i> <?php the_date(); ?></li>
        <?php endif; ?>

    </ul>
    <?php
}

function book_junky_single_comment()
{

    global $opt_theme_options;

    if (!empty($opt_theme_options['single_comment'])) :
        /* If comments are open or we have at least one comment, load up the comment template.*/

        if (comments_open() || get_comments_number()) :

            comments_template();
        endif;
    endif;
}

/**
 * Display an optional single tag.
 */
function book_junky_single_tag()
{
    global $opt_theme_options;
    if (!empty($opt_theme_options['single_tag'])) :
        ?>
        <div class="entry-categories"><?php the_terms(get_the_ID(), 'post_tag', '', ''); ?></div>
        <?php
    endif;
}

/**
 * Display an optional post video.
 */
function book_junky_post_video()
{

    global $opt_meta_options, $wp_embed;

    /* no video. */
    if (empty($opt_meta_options['opt-video-type'])) {
        book_junky_post_thumbnail();
        return;
    }

    if ($opt_meta_options['opt-video-type'] == 'local' && !empty($opt_meta_options['otp-video-local']['id'])) {

        $video = wp_get_attachment_metadata($opt_meta_options['otp-video-local']['id']);

        echo do_shortcode('[video width="' . esc_attr($opt_meta_options['otp-video-local']['width']) . '" height="' . esc_attr($opt_meta_options['otp-video-local']['height']) . '" ' . $video['fileformat'] . '="' . esc_url($opt_meta_options['otp-video-local']['url']) . '" poster="' . esc_url($opt_meta_options['otp-video-thumb']['url']) . '"][/video]');

    } elseif ($opt_meta_options['opt-video-type'] == 'youtube' && !empty($opt_meta_options['opt-video-youtube'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]' . esc_url($opt_meta_options['opt-video-youtube']) . '[/embed]'));

    } elseif ($opt_meta_options['opt-video-type'] == 'vimeo' && !empty($opt_meta_options['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]' . esc_url($opt_meta_options['opt-video-vimeo']) . '[/embed]'));

    }
}

/**
 * Display an optional post gallery.
 */
function book_junky_post_gallery()
{
    global $opt_meta_options;

    /* no audio. */
    if (empty($opt_meta_options['opt-gallery'])) {
        book_junky_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta_options['opt-gallery']);

    ?>
    <div id="gallery-nav" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $i = 0; ?>
            <?php foreach ($array_id as $image_id): ?>
                <?php
                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                if ($attachment_image[0] != ''):?>
                    <div class="item <?php if ($i == 0) {
                        echo 'active';
                    } ?>">
                        <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]); ?>"
                             alt=""/>
                    </div>
                    <?php $i++; endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="left control" href="#gallery-nav" role="button" data-slide="prev">
            <span class="fa fa-angle-left"></span>
        </a>
        <a class="right control" href="#gallery-nav" role="button" data-slide="next">
            <span class="fa fa-angle-right"></span>
        </a>
    </div>
    <?php
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function book_junky_post_thumbnail()
{
    if (has_post_thumbnail()) {
        the_post_thumbnail('medium');
    }
}

function book_junky_post_sidebar()
{
    global $opt_theme_options;

    $_sidebar = 'right';

    if (isset($opt_theme_options['single_layout']))
        $_sidebar = $opt_theme_options['single_layout'];

    return 'is-sidebar-' . esc_attr($_sidebar);
}

function book_junky_post_class()
{
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-9 col-md-9 col-lg-9";

    if (isset($opt_theme_options['single_layout']) && $opt_theme_options['single_layout'] == 'full')
        $_class = "col-xs-12 col-sm-12 col-md-12 col-lg-12";

    echo esc_attr($_class);
}

/**
 * Display an optional archive detail.
 */
function book_junky_archive_detail()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['archive_date'])) : ?>

        <div class="detail-date">

            <?php
            echo get_the_date('j');
            echo '<span>' . get_the_date('S') . '</span>';
            echo get_the_date(' F');
            echo get_the_date(' Y');
            ?>
        </div>
    <?php endif;
}

function book_junky_archive_sidebar($check)
{
    global $opt_theme_options;

    $_sidebar = 'right';
    if (!empty($opt_theme_options[$check])) {

        $_sidebar = $opt_theme_options[$check];
    }

    return 'is-sidebar-' . esc_attr($_sidebar);
}

function book_junky_archive_class()
{
    global $opt_theme_options;

    $_class = "col-xs-12 col-sm-9 col-md-9 col-lg-9";

    if (isset($opt_theme_options['archive_layout']) && $opt_theme_options['archive_layout'] == 'full')
        $_class = "col-xs-12 col-sm-12 col-md-12 col-lg-12";

    echo esc_attr($_class);
}

/**
 * footer layout
 */
function book_junky_footer_top()
{
    global $opt_theme_options;

    /* footer-top */
    if (empty($opt_theme_options['footer-top-column'])) {
        return;
    } else {
        $_class = '';
        $_lg_1 = '';
        $_lg_4 = '';

        switch ($opt_theme_options['footer-top-column']) {
            case '2':
                $_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
                break;
            case '3':
                $_class = 'col-lg-4 col-md-4 col-sm-12 col-xs-12';
                break;
            case '4':
                $_class = 'col-md-3 col-sm-12 col-xs-12';
                $_lg_1 = 'col-lg-4';
                $_lg_4 = 'col-lg-2';
                break;
        }
        ?>
        
        <div id="footer-top">
            <div class="container">
                <div class="row">
        <?php

        for ($i = 1; $i <= $opt_theme_options['footer-top-column']; $i++) {
            if ($i == 1) {
                ?>
                <div class="wrap-about <?php echo esc_attr($_class) . ' ';
                echo esc_attr($_lg_1); ?>">
                    <?php book_junky_footer_about(); ?>
                </div>
                <?php
            } elseif ($i == 2 || $i == 3) {
                if (is_active_sidebar('sidebar-footer-top-' . $i)) {
                    echo '<div class="' . esc_html($_class) . '">';
                    dynamic_sidebar('sidebar-footer-top-' . $i);
                    echo "</div>";
                }
            } else {
                if (is_active_sidebar('sidebar-footer-top-' . $i)) {
                    echo '<div class="' . esc_attr($_class) . ' ' . esc_attr($_lg_4) . '">';
                    dynamic_sidebar('sidebar-footer-top-' . $i);
                    echo "</div>";
                }
            }
        }
        ?>


                </div>
            </div>
        </div><!-- #footer-top -->
        <?php
    }
}

function book_junky_footer_about()
{
    global $opt_theme_options;

    ?>
    <div class="footer-about">
        <a href="<?php echo esc_url(home_url('/')); ?>"><img class="logo-footer"
                                                             src="<?php echo esc_url($opt_theme_options['footer_logo']['url']); ?>"
                                                             alt="<?php echo esc_html__('Book Junky', 'book-junky'); ?>"></a>
        <p>
            <?php if( !empty($opt_theme_options['about_us']) ) { echo esc_html($opt_theme_options['about_us']);} ?>
        </p>
        <?php
        if (!empty($opt_theme_options['footer_facebook_url']) || !empty($opt_theme_options['footer_twitter_url']) || !empty($opt_theme_options['footer_linkedin_url']) || !empty($opt_theme_options['footer_instagram_url']) || !empty($opt_theme_options['footer_google_url']) || !empty($opt_theme_options['footer_skype_url']) || !empty($opt_theme_options['footer_pinterest_url']) || !empty($opt_theme_options['footer_youtube_url']) || !empty($opt_theme_options['footer_tumblr_url'])) {
            ?>
            <ul>
                <?php if ($opt_theme_options['footer_facebook_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_facebook_url']); ?>"><i
                                    class="zmdi zmdi-facebook-box"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_instagram_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_instagram_url']); ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/instagram.png'; ?>"
                                    alt="Instagram"></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_twitter_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_twitter_url']); ?>"><i
                                    class="zmdi zmdi-twitter-box"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_linkedin_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_linkedin_url']); ?>"><i
                                    class="zmdi zmdi-linkedin-box"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_google_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_google_url']); ?>"><i
                                    class="zmdi zmdi-google-plus-box"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_skype_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_skype_url']); ?>"><i
                                    class="zmdi zmdi-skype"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_pinterest_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_pinterest_url']); ?>"><i
                                    class="zmdi zmdi-pinterest-box"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_youtube_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_youtube_url']); ?>"><i
                                    class="zmdi zmdi-youtube-play"></i></a></li>
                <?php } ?>
                <?php if ($opt_theme_options['footer_tumblr_url']) { ?>
                    <li><a href="<?php echo esc_url($opt_theme_options['footer_tumblr_url']); ?>"><i
                                    class="zmdi zmdi-tumblr"></i></a></li>
                <?php } ?>
            </ul>
            <?php
        }
        ?>
    </div>
    <?php
}

function book_junky_footer_bottom()
{
    global $opt_theme_options;

    /* footer-top */
    if (empty($opt_theme_options['copyright'])) {
        echo "<p>Copyright &#169; 2017 ";
        echo "<a href='http://cmssuperheroes.com' target='_blank'>CMSSuperheroes</a>. All Right Reserved";
        echo '</p>';
    } else {
        echo wp_kses_post($opt_theme_options['copyright']);
    }
}

function book_junky_favicon_icon()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['fav_icon']['url'])) {

        echo esc_url($opt_theme_options['fav_icon']['url']);
    } else {
        echo get_template_directory_uri() . '/assets/images/fav.png';
    }
}

function book_junky_start_boxed()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['en_boxed'])) {

        ?><div class="wrap-boxed"><?php
    }
}

function book_junky_end_boxed()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['en_boxed'])) {

        ?></div><?php
    }
}


// Add specific CSS class by filter
add_filter('body_class', 'book_junky_add_class');
function book_junky_add_class($classes)
{

    global $opt_theme_options;

    if (!empty($opt_theme_options['en_boxed'])) {
        $classes[] = 'body-boxed';
    }

    return $classes;
}

/*loadding page*/

function book_junky_page_loading()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['page_loading'])) {
        echo '<div id="book-junky-loadding"><div class="wrap-loading">
        <div class="bounceball"></div>
        <div class="text">';
        echo esc_html__("NOW LOADING", "book-junky");
        echo '</div></div></div>';
    }
}

function book_junky_back_to_top()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['general_back_to_top'])) {
        ?>
        <div class="book-junky-back-to-top"><i class="fa fa-angle-double-up"></i></div><?php
    }
}


/* Get Term Product */
function book_junky_get_cat_book()
{
    $term = get_terms(array('taxonomy' => 'product_cat'));
    ?>

    <select name="product_cat" id="product_cat">

        <option value=""><?php esc_html_e('Browse Categories', 'book-junky'); ?></option>
        <?php
        foreach ($term as $key => $value) {
            echo '<option value=' . $value->slug . '>' . $value->name . '</option>';
        }
        ?>
    </select>
    <?php
}

/* Get Term Product */
function book_junky_get_cat_book_2($cate_slug = "")
{
    $term = get_terms(array('taxonomy' => 'product_cat'));
    ?>

    <select name="product_cat" id="product_cat">

        <option value=""><?php esc_html_e('', 'book-junky'); ?></option>
        <?php
        /*foreach ($term as $key => $value) {
            if($value->name=="All"){continue;}
            $selected = !empty($cate_slug) && $value->slug === $cate_slug ? "selected" : "";
            echo '<option value="' . $value->slug . '" ' . esc_attr($selected) . '>' . $value->name . '</option>';
        }*/
        ?>
    </select>
    <?php
}


function book_junky_edit_link()
{
    edit_post_link(
        'Edit',
        '<span class="edit-link">',
        '</span>'
    );
}


/**
 * Display an optional archive tag.
 */
function book_junky_archive_tag()
{
    global $opt_theme_options;
    if (!empty($opt_theme_options['archive_tag'])) :
        ?>
        <div class="entry-tag"><?php the_terms(get_the_ID(), 'post_tag', '', ''); ?></div>
        <?php
    endif;
}

/* Get Product */
function book_junky_get_product()
{
    $products = array();
    $args_query = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    $product = new WP_Query($args_query);
    if ($product->have_posts()) {
        foreach ($product->posts as $p) {

            $products[$p->ID] = $p->post_title;
        }
    }

    return $products;
}

/* Get Post */
function book_junky_get_post()
{
    $posts = array();
    $args_query = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );
    $post = new WP_Query($args_query);
    if ($post->have_posts()) {
        foreach ($post->posts as $p) {

            $posts[$p->post_title] = $p->ID;
        }
    }

    return $posts;
}

/**
 * Get review information of Woo product
 *
 * @author KP
 */
function book_junky_get_review_product($post_id, $show_counts = true, $style_text = "")
{

    $rating_count = get_post_meta($post_id, '_wc_rating_count', true);
    $class_color = (!empty($style_text)) ? " bj-color-" . $style_text : "";
    if (!empty($rating_count)) :
        $rating_count = array_sum($rating_count);
        $average = get_post_meta($post_id, '_wc_average_rating', true);
        $review_count = get_post_meta($post_id, '_wc_review_count', true);
        $html = '';
        if ($rating_count > 0) :
            $html .= '<div class="woocommerce">';
            $html .= '<div class="woocommerce-product-rating">';
            if (0 < $average) {
                $html .= '<span class="star-rating' . esc_html($class_color) . '" style="color:' . esc_html($style_text) . ';">';
                $html .= '<span style="width:' . (($average / 5) * 100) . '%">';
                if (0 < $rating_count) {
                    /* translators: 1: rating 2: rating count */
                    $html .= sprintf(_n('Rated %1$s out of 5 based on %2$s customer rating', 'Rated %1$s out of 5 based on %2$s customer ratings', $rating_count, 'woocommerce'), '<strong class="rating">' . esc_html($average) . '</strong>', '<span class="rating">' . esc_html($rating_count) . '</span>');
                } else {
                    /* translators: %s: rating */
                    $html .= sprintf(esc_html__('Rated %s out of 5', 'woocommerce'), '<strong class="rating">' . esc_html($average) . '</strong>');
                }

                $html .= '</span>';

            }
            $html .= '</span>';
            if ($show_counts === true) {
                $html .= '<span class="bj-rating-counts test" style="color:' . esc_html($style_text) . ';">' . $review_count . ' ' . esc_html("Ratings") . '</span>';
            }
            $html .= '</div>';
            $html .= '</div>';
        endif;
    else :
        $html = '<div class="woocommerce">
                <div class="woocommerce-product-rating">
                <span class="star-rating ' . esc_html($class_color) . '">
                    <span style="width:0%"></span>
                </span>';
        if ($show_counts === true) {
            $html .= '<span class="bj-rating-counts" style="color:' . esc_html($style_text) . ';">0 Ratings</span>';
        }
        $html .= '</div>
                </div>';
    endif;
    return $html;
}


/*
** Count view
*/

function book_junky_getPostViews($postID)
{

    $count_key = 'post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

        return "0";
    }

    return $count;
}

function book_junky_setPostViews($postID)
{

    $count_key = 'post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {

        $count = 0;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');
    } else {

        $count++;

        update_post_meta($postID, $count_key, $count);
    }
}

function book_junky_get_id_term($id_product = 0)
{
    $attr = wp_get_post_terms($id_product, 'pa_book_author');
    $term_id = array();
    foreach ($attr as $attr_value) {
        $term_id[] = $attr_value->term_id;
    }
    return $term_id;
}

function book_junky_get_id_term_2($id_product = 0)
{
    $attr = wp_get_post_terms($id_product, 'pa_book_author');
    $term_id = '';
    foreach ($attr as $attr_value) {
        $term_id = $attr_value->term_id;
    }
    return $term_id;
}

function book_junky_get_author($id_product = 0)
{
    $attr = wp_get_post_terms($id_product, 'pa_book_author');
    $author = array();
    $author_page = get_option('woocommerce_author_page_id');
    if(!empty($attr)){
        foreach ($attr as $attr_value) {
            $author[] = '<a href="'.home_url("/?page_id=" . $author_page).'&author_id='.$attr_value->term_id.'">'.$attr_value->name.'</a>';
        }
    }
    return implode(' & ', $author);
    
}

function book_junky_get_year_book($year = "")
{
    $attr = get_terms('pa_year_publication');
    ?>
    <select name="bj_tax_pa_year_publication" id="term">

        <option value=""><?php esc_html_e('Year', 'book-junky'); ?></option>
        <?php
        foreach ($attr as $term) {
            $selected = (!empty($year) && $term->term_id === intval($year)) ? "selected" : "";
            echo '<option value="' . $term->term_id . '" ' . esc_attr($selected) . '>' . $term->name . '</option>';
        }
        ?>
    </select>
    <?php
}

function book_junky_get_subject_book($subject = "")
{
    $subject_cat = get_term_by('slug', 'subject', 'product_cat');
    $subject_list = get_term_children( $subject_cat->term_id, 'product_cat' );
    ?>
    <select name="cat_subject" id="term">

        <option value=""><?php esc_html_e('Subject', 'book-junky'); ?></option>
        <?php
        foreach ($subject_list as $term) {
            $term_details = get_term_by('id', $term, 'product_cat');
            $selected = (!empty($subject) && $term_details->term_id === intval($subject)) ? "selected" : "";
            echo '<option value="' . $term_details->term_id . '" ' . esc_attr($selected) . '>' . $term_details->name . '</option>';
        }
        ?>
    </select>
    <?php
}

/* Search Book */

function book_junky_search_book($show_cate_single = true)
{

    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    $cate_slug = !empty($_REQUEST['product_cat']) ? $_REQUEST['product_cat'] : "";
    $year = !empty($_REQUEST['pa_year_publication']) ? $_REQUEST['pa_year_publication'] : "";
    ?>

    <div class="wrap-search-book">
        <form action="<?php echo esc_url(home_url('/')); ?>" class="searchform" method="get">
            <?php
            if ($show_cate_single === true):
                ?>
                <div class="wrap-cat">
                    <?php book_junky_get_cat_book_2($cate_slug); ?>
                </div>
            <?php endif; ?>
            <div class="wrap-year">
                <?php book_junky_get_year_book($year); ?>
            </div>

            <div class="wrap-search">
                <input type="text" class="form-search" name="s" value="<?php if(isset($_REQUEST['s']) && $_REQUEST['s']!=''){ echo $_REQUEST['s']; } ?>" placeholder="<?php esc_html_e('Search Book', 'book-junky'); ?>">
                <button type="submit" class="search-submit"><?php esc_html_e('Enter Title or ISBN', 'book-junky'); ?></button>
            </div>
            <input type="hidden" name="post_type" value="product"/>
            <input type="hidden" name="bj_action" value="bj_product"/>
        </form>
    </div>
    <?php
}

function book_junky_get_recent_reviews($limit)
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1
    );
    $comments_query = new WP_Comment_Query;
    $comments = $comments_query->query($args);
    $post_id_list = array();
    $count_pid = 0;

    foreach ($comments as $comment) {

        if (!in_array($comment->comment_post_ID, $post_id_list) && $count_pid < $limit) {

            $post_id_list[] = $comment->comment_post_ID;
            $count_pid++;
        }
    }
    return $post_id_list;
}

function book_junky_get_posts_by_term_id($term_id = array(), $posts_per_page = -1)
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'tax_query' => array(
            array(
                'taxonomy' => 'pa_book_author',
                'field' => 'term_id',
                'terms' => $term_id,
                'operator' => 'IN',
            )
        ),
    );
    return $query = new WP_Query($args);
}

function book_junky_count_product_by_term_id($term_id)
{
    $query = book_junky_get_posts_by_term_id($term_id);
    return $query->post_count;
}

function book_junky_get_term_by_post_id($post_id, $taxonomy = 'pa_book_author')
{
    //default get author attribute of Woo
    $terms = get_the_terms($post_id, $taxonomy);
    return $terms;
}

function bj_get_woocommerce_currency_symbol()
{
    $currency = get_option('woocommerce_currency', "GBP");
    $symbols = apply_filters('woocommerce_currency_symbols', array(
        'AED' => '&#x62f;.&#x625;',
        'AFN' => '&#x60b;',
        'ALL' => 'L',
        'AMD' => 'AMD',
        'ANG' => '&fnof;',
        'AOA' => 'Kz',
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => 'Afl.',
        'AZN' => 'AZN',
        'BAM' => 'KM',
        'BBD' => '&#36;',
        'BDT' => '&#2547;&nbsp;',
        'BGN' => '&#1083;&#1074;.',
        'BHD' => '.&#x62f;.&#x628;',
        'BIF' => 'Fr',
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => 'Bs.',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTC' => '&#3647;',
        'BTN' => 'Nu.',
        'BWP' => 'P',
        'BYR' => 'Br',
        'BZD' => '&#36;',
        'CAD' => '&#36;',
        'CDF' => 'Fr',
        'CHF' => '&#67;&#72;&#70;',
        'CLP' => '&#36;',
        'CNY' => '&yen;',
        'COP' => '&#36;',
        'CRC' => '&#x20a1;',
        'CUC' => '&#36;',
        'CUP' => '&#36;',
        'CVE' => '&#36;',
        'CZK' => '&#75;&#269;',
        'DJF' => 'Fr',
        'DKK' => 'DKK',
        'DOP' => 'RD&#36;',
        'DZD' => '&#x62f;.&#x62c;',
        'EGP' => 'EGP',
        'ERN' => 'Nfk',
        'ETB' => 'Br',
        'EUR' => '&euro;',
        'FJD' => '&#36;',
        'FKP' => '&pound;',
        'GBP' => '&pound;',
        'GEL' => '&#x10da;',
        'GGP' => '&pound;',
        'GHS' => '&#x20b5;',
        'GIP' => '&pound;',
        'GMD' => 'D',
        'GNF' => 'Fr',
        'GTQ' => 'Q',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => 'L',
        'HRK' => 'Kn',
        'HTG' => 'G',
        'HUF' => '&#70;&#116;',
        'IDR' => 'Rp',
        'ILS' => '&#8362;',
        'IMP' => '&pound;',
        'INR' => '&#8377;',
        'IQD' => '&#x639;.&#x62f;',
        'IRR' => '&#xfdfc;',
        'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
        'ISK' => 'kr.',
        'JEP' => '&pound;',
        'JMD' => '&#36;',
        'JOD' => '&#x62f;.&#x627;',
        'JPY' => '&yen;',
        'KES' => 'KSh',
        'KGS' => '&#x441;&#x43e;&#x43c;',
        'KHR' => '&#x17db;',
        'KMF' => 'Fr',
        'KPW' => '&#x20a9;',
        'KRW' => '&#8361;',
        'KWD' => '&#x62f;.&#x643;',
        'KYD' => '&#36;',
        'KZT' => 'KZT',
        'LAK' => '&#8365;',
        'LBP' => '&#x644;.&#x644;',
        'LKR' => '&#xdbb;&#xdd4;',
        'LRD' => '&#36;',
        'LSL' => 'L',
        'LYD' => '&#x644;.&#x62f;',
        'MAD' => '&#x62f;.&#x645;.',
        'MDL' => 'MDL',
        'MGA' => 'Ar',
        'MKD' => '&#x434;&#x435;&#x43d;',
        'MMK' => 'Ks',
        'MNT' => '&#x20ae;',
        'MOP' => 'P',
        'MRO' => 'UM',
        'MUR' => '&#x20a8;',
        'MVR' => '.&#x783;',
        'MWK' => 'MK',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => 'MT',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => 'C&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#x631;.&#x639;.',
        'PAB' => 'B/.',
        'PEN' => 'S/.',
        'PGK' => 'K',
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PRB' => '&#x440;.',
        'PYG' => '&#8370;',
        'QAR' => '&#x631;.&#x642;',
        'RMB' => '&yen;',
        'RON' => 'lei',
        'RSD' => '&#x434;&#x438;&#x43d;.',
        'RUB' => '&#8381;',
        'RWF' => 'Fr',
        'SAR' => '&#x631;.&#x633;',
        'SBD' => '&#36;',
        'SCR' => '&#x20a8;',
        'SDG' => '&#x62c;.&#x633;.',
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&pound;',
        'SLL' => 'Le',
        'SOS' => 'Sh',
        'SRD' => '&#36;',
        'SSP' => '&pound;',
        'STD' => 'Db',
        'SYP' => '&#x644;.&#x633;',
        'SZL' => 'L',
        'THB' => '&#3647;',
        'TJS' => '&#x405;&#x41c;',
        'TMT' => 'm',
        'TND' => '&#x62f;.&#x62a;',
        'TOP' => 'T&#36;',
        'TRY' => '&#8378;',
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => 'Sh',
        'UAH' => '&#8372;',
        'UGX' => 'UGX',
        'USD' => '&#36;',
        'UYU' => '&#36;',
        'UZS' => 'UZS',
        'VEF' => 'Bs F',
        'VND' => '&#8363;',
        'VUV' => 'Vt',
        'WST' => 'T',
        'XAF' => 'Fr',
        'XCD' => '&#36;',
        'XOF' => 'Fr',
        'XPF' => 'Fr',
        'YER' => '&#xfdfc;',
        'ZAR' => '&#82;',
        'ZMW' => 'ZK',
    ));

    $currency_symbol = $symbols[$currency];

    return $currency_symbol;
}


add_action('pa_book_author_add_form_fields', 'book_junky_add_thumbnail', 10, 2);
add_action('pa_book_author_edit_form_fields', 'book_junky_edit_thumbnail', 10, 2);

// Add term page
function book_junky_add_thumbnail()
{
    ?>
    <div class="form-field term-description-wrap">
        <label><?php esc_html_e('Avatar', "book-junky") ?></label>
        <div class="thumbnails">

            <div class="thumbnails_button materialize">
                <a class="btn btn-success waves-effect button_thumbnail"
                   data-title="<?php esc_html_e('Choose or Upload Image', "book-junky") ?>"
                   data-button="<?php esc_html_e('Use this image', "book-junky") ?>"
                   data-multiple="false"> <span
                            class="dashicons dashicons-plus"></span> <?php esc_html_e('Add avatar', "book-junky") ?>
                </a>
            </div>
            <div class="thumbnails_images_container">
                <ul class="thumbnails_images ui-sortable">
                </ul>
                <input type="hidden" name="bj_avatar" class="image_id" value=""/>
            </div>
            <div class="clearfix"></div>
            <div class="sample" style="display:none">
                <li class="image" data-attachment_id="">
                    <div class="picture"><img src="" alt=""></div>
                    <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                </li>
            </div>
        </div>
    </div>
    <div class="form-field term-description-wrap">
        <label><?php esc_html_e('Background Title', "book-junky") ?></label>
        <div class="thumbnails">
            <div class="bj-color-title">
                <input type="text" class="bj-color-title-picker" name="bj_bg_color" value=""/>
            </div>
            <div class="thumbnails_button materialize">
                <a class="btn btn-success waves-effect button_thumbnail"
                   data-title="<?php esc_html_e('Choose or Upload Image', "book-junky") ?>"
                   data-button="<?php esc_html_e('Use this image', "book-junky") ?>"
                   data-multiple="false"> <span
                            class="dashicons dashicons-plus"></span> <?php esc_html_e('Add image', "book-junky") ?>
                </a>
            </div>
            <div class="thumbnails_images_container">
                <ul class="thumbnails_images ui-sortable">
                </ul>
                <input type="hidden" name="bj_bg_image" class="image_id" value=""/>
            </div>
            <div class="clearfix"></div>
            <div class="sample" style="display:none">
                <li class="image" data-attachment_id="">
                    <div class="picture"><img src="" alt=""></div>
                    <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                </li>
            </div>
        </div>
    </div>
    <?php
}

function book_junky_edit_thumbnail($term)
{
    $logo = get_term_meta($term->term_id, 'bj_avatar', true);
    $bg_img = get_term_meta($term->term_id, 'bj_bg_image', true);
    $bg_color = get_term_meta($term->term_id, 'bj_bg_color', true);
    ?>
    <tr>
        <td><label><?php esc_html_e('Avatar', "book-junky") ?></label></td>
        <td>
            <div class="thumbnails">
                <div class="thumbnails_button materialize">
                    <a class="btn btn-success waves-effect button_thumbnail"
                       data-title="<?php esc_html_e('Choose or Upload Image', "book-junky") ?>"
                       data-button="<?php esc_html_e('Use this image', "book-junky") ?>"
                       data-multiple="false"> <span
                                class="dashicons dashicons-plus"></span> <?php esc_html_e('Add avatar', "book-junky") ?>
                    </a>
                </div>
                <div class="thumbnails_images_container">
                    <ul class="thumbnails_images ui-sortable">
                        <?php if (!empty($logo)) { ?>
                            <li class="image" data-attachment_id="<?php echo $logo; ?>">
                                <div class="picture"><?php echo wp_get_attachment_image($logo, array(
                                        78,
                                        78
                                    )); ?></div>
                                <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                            </li>
                        <?php } ?>
                    </ul>
                    <input type="hidden" name="bj_avatar" class="image_id" value="<?php echo $logo ?>"/>
                </div>
                <div class="clearfix"></div>
                <div class="sample" style="display:none">
                    <li class="image" data-attachment_id="">
                        <div class="picture"><img src="" alt=""></div>
                        <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                    </li>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><label><?php esc_html_e('Background Title', "book-junky") ?></label></td>
        <td>
            <div class="bj-color-title">
                <input type="text" class="bj-color-title-picker" name="bj_bg_color" value="<?php echo $bg_color ?>"/>
            </div>
            <div class="thumbnails">
                <div class="thumbnails_button materialize">
                    <a class="btn btn-success waves-effect button_thumbnail"
                       data-title="<?php esc_html_e('Choose or Upload Image', "book-junky") ?>"
                       data-button="<?php esc_html_e('Use this image', "book-junky") ?>"
                       data-multiple="false"> <span
                                class="dashicons dashicons-plus"></span> <?php esc_html_e('Add image', "book-junky") ?>
                    </a>
                </div>
                <div class="thumbnails_images_container">
                    <ul class="thumbnails_images ui-sortable">
                        <?php if (!empty($bg_img)) { ?>
                            <li class="image" data-attachment_id="<?php echo $bg_img; ?>">
                                <div class="picture"><?php echo wp_get_attachment_image($bg_img, array(
                                        78,
                                        78
                                    )); ?></div>
                                <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                            </li>
                        <?php } ?>
                    </ul>
                    <input type="hidden" name="bj_bg_image" class="image_id" value="<?php echo $bg_img ?>"/>
                </div>
                <div class="clearfix"></div>
                <div class="sample" style="display:none">
                    <li class="image" data-attachment_id="">
                        <div class="picture"><img src="" alt=""></div>
                        <span class="remove_button dashicons dashicons-dismiss" id="remove_price_type" style="">
                    </li>
                </div>
            </div>
        </td>
    </tr>
    <?php
}

add_action('edited_pa_book_author', 'book_junky_save_term_meta', 10, 1);
add_action('create_pa_book_author', 'book_junky_save_term_meta', 10, 1);
function book_junky_save_term_meta($term_id)
{
    update_term_meta($term_id, 'bj_avatar', $_POST['bj_avatar']);
    update_term_meta($term_id, 'bj_bg_image', $_POST['bj_bg_image']);
    update_term_meta($term_id, 'bj_bg_color', $_POST['bj_bg_color']);
}

function charity_tag() {
    the_tags();
}

/**
 * Header top
 */

function book_junky_header_3_top()
{
    global $opt_theme_options;

    if (!empty($opt_theme_options['en_header_top'])) :
        ?>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-8 top-left-3 w">

                        <?php
                        if (is_user_logged_in()):
                            $user = wp_get_current_user();

                            if (class_exists('WooCommerce')) : ?>
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                                   alt="<?php esc_html_e('My Account', 'book-junky'); ?>">

                                    <?php esc_html_e('My Account', 'book-junky'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo wp_logout_url( get_site_url() ); ?>">Logout</a>
                            <?php
                        else:

                            if (function_exists('cshlg_add_login_form')) : ?>
                                
                                <a href="/create-account">Sign Up</a>
                                
                                <?php cshlg_link_to_login(); ?> 
                                
                            <?php else : ?>

<!--
                                <a href="<?php echo esc_url(home_url('/wp-admin')); ?>">
                                    <?php esc_html_e('Sig in / Register','book-junky'); ?></a>
-->
                                <a href="/create-account">Sign Up</a>
                                <a class="go_to_login_linkc go_to_login_pop pum-trigger" href="#" style="cursor: pointer;">Login</a>
                            <?php endif;
                        endif;

                        if (!empty($opt_theme_options['custom-header-left'])) :

                            echo wp_kses_post($opt_theme_options['custom-header-left']);
                        endif;
                        ?>
                    </div>
                    <div class="col-xs-12 col-md-4 top-right-3">
                        <!-- <div class="wrap-free-shipping clearfix">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/free_shipping.png" />
                        </div> -->
                        
                        <div class="eCatalogue clearfix">
                         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-1.png" />
                         <div class="content">
                            <a href="https://www.popularbook.ca/wp-content/uploads/PBC_Catalogue_2021-22_LowRes.pdf" target="_blank">
                                <h5><?php esc_html_e('eCatalogue', ''); ?></h5>
                            </a>
                             </div>
                    </div>
                     
                    <div class="wrap-book-shelf clearfix">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-1.png'; ?>"
                                 alt="<?php esc_html_e('icon 1', 'book-junky'); ?>">
                            <div class="content">
                                <?php if (class_exists('WooCommerce')) : ?>
                                <a href="<?php echo wc_get_account_endpoint_url('book-shelf'); ?>"
                                   alt="<?php esc_html_e('My Account', 'book-junky'); ?>">
                                    <?php endif; ?>
                                    <h5><?php esc_html_e('Wishlist', 'book-junky'); ?></h5>
                                    <?php if (class_exists('WooCommerce')) : ?>
                                </a>
                            <?php endif; ?>
                                <span class="aj-count">
                                    <?php
                                    $current_uid = get_current_user_id();

                                    $count = flex_favorites_get_bookshelf_count_of_user($current_uid);

                                    echo flex_favorites_get_bookshelf_count_of_user_display($count);
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="wrap-your-basket clearfix">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/icon-2.png'; ?>"
                                 alt="<?php esc_html_e('icon 2', 'book-junky'); ?>">
                            <div class="content">
                                <h5>
                                    <?php if (class_exists('WooCommerce')) : ?>
                                    <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
                                        <?php endif; ?>

                                        <?php esc_html_e('Your Basket', 'book-junky'); ?>
                                        <?php if (class_exists('WooCommerce')) : ?>
                                    </a>
                                <?php endif; ?>
                                </h5>
                                <?php if (class_exists('WooCommerce')) : ?>
                                    <span>
                                <?php
                                if (!WC()->cart->is_empty()) :

                                    echo WC()->cart->get_cart_subtotal();
                                else :

                                    echo "0.00";
                                endif;
                                ?>
                            </span>
                                <?php else: ?>

                                    <span>

                                    <?php echo "0.00"; ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
}

function book_junky_login()
{
    if (is_user_logged_in()):
        $user = wp_get_current_user();
        ?>
        <div class="user-login">
            <div class="bj-user-head-logo">
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                       alt="<?php esc_html_e('Avatar', 'book-junky'); ?>">
                        <?php echo get_avatar($user->ID, 85); ?>
                    </a>
                <?php else : ?>
                    <?php echo get_avatar($user->ID, 85); ?>
                <?php endif; ?>
            </div>

            <div class="bj-user-head-info">
                <?php if (class_exists('WooCommerce')) : ?>

                    <div class="bj-user-name">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                           title="<?php esc_html_e('My Account', 'book-junky'); ?>"><?php echo esc_attr($user->display_name) ?>
                        </a>
                    </div>
                <?php else : ?>

                    <div class="bj-user-name"><?php echo esc_attr($user->display_name) ?></div>
                <?php endif; ?>

                <div class="bj-user-ask">
                    <span><?php echo esc_html__("Not ", "book-junky") . esc_attr($user->display_name) . "?" ?></span>
                    <a class="bj-user-logout"
                       href="<?php echo wp_logout_url() ?>"><?php echo esc_html__("Signout", "book-junky") ?></a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="bj-user-head clearfix">

            <?php if (function_exists('cshlg_add_login_form')) : ?>
                <?php cshlg_link_to_login(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/wp-admin')); ?>"><?php esc_html_e('Sign in / Register','book-junky'); ?></a>
            <?php endif; ?>
        </div>
    <?php endif;
}


//add endpoint
add_action('init', 'book_junky_add_endpoints');
add_filter('query_vars', 'book_junky_add_woo_query_vars', 0);


function book_junky_add_endpoints()
{
    $endpoint = "book-shelf";
    add_rewrite_endpoint($endpoint, EP_ROOT | EP_PAGES);
}

function book_junky_add_woo_query_vars($vars)
{
    $endpoint = "book-shelf";
    $vars[] = $endpoint;
    return $vars;
}

/**
 * Flush rewrite rules on theme activation.
 */
function book_junky_flush_rewrite_rules()
{
    add_rewrite_endpoint('book-shelf', EP_ROOT | EP_PAGES);
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'book_junky_flush_rewrite_rules');

add_filter('woocommerce_account_menu_items', 'book_junky_new_menu_items');
add_action('woocommerce_account_book-shelf_endpoint', 'book_junky_bookshelf_contents');


function book_junky_bookshelf_contents()
{
    $current_uid = get_current_user_id();
    $list_book_id = $current_uid !== 0 ? get_user_meta($current_uid, 'fs_favor_ids', true) : "";
    $list_id = explode(',', $list_book_id);
    array_shift($list_id);
    wc_get_template('myaccount/bookshelf.php', array('books' => $list_id));
}

function book_junky_new_menu_items($items)
{
    $bookshelf = "book-shelf";
    $payments = "payment-methods";
    // Remove the logout menu item.
    $logout = $items['customer-logout'];
    $orders = $items['orders'];
    $edit_address = $items['edit-address'];
    unset($items['customer-logout']);
    unset($items['orders']);
    unset($items['edit-address']);
    // Insert your custom endpoint.
    $items['edit-address'] = $edit_address;
    $items[$payments] = esc_html__('Payment Methods', 'book-junky');
    $items['orders'] = $orders;
    $items[$bookshelf] = esc_html__('My Bookshelf', 'book-junky');
    return $items;
}

function book_junky_get_text_color_by_bg($background_hex)
{
    $hex = str_replace('#', '', $background_hex);
    $length = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    return $rgb;
}

add_filter('woocommerce_product_settings', 'book_junky_woocommerce_product_settings');
function book_junky_woocommerce_product_settings($settings)
{
    $settings[2] = array(
        'title' => esc_html__('Author page', 'book-junky'),
        'desc' => '<br/>' . sprintf(esc_html__('The base page can also be used in your <a href="%s">product permalinks</a>.', 'book-junky'), admin_url('options-permalink.php')),
        'id' => 'woocommerce_author_page_id',
        'type' => 'single_select_page',
        'default' => '',
        'class' => 'wc-enhanced-select-nostd',
        'css' => 'min-width:300px;',
        'desc_tip' => esc_html__('This sets the base page of your shop - this is where your product archive will be.', 'book-junky'),
        'title' => __('Author page', 'woocommerce'),
        'desc' => '<br/>' . sprintf(__('The base page can also be used in your <a href="%s">product permalinks</a>.', 'woocommerce'), admin_url('options-permalink.php')),
        'id' => 'woocommerce_author_page_id',
        'type' => 'single_select_page',
        'default' => '',
        'class' => 'wc-enhanced-select-nostd',
        'css' => 'min-width:300px;',
        'desc_tip' => __('This sets the base page of your shop - this is where your product archive will be.', 'woocommerce'),
    );
    return $settings;
}





























