<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */

/* Add main.js */
wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', '', 'all', true);
wp_enqueue_style('owl-carousel-style');
?>
    <div class="explore-author">
        <h3 class="text-center entry-title"><?php echo esc_attr($atts['cms_title']); ?></h3>
        <div class="owl-carousel owl-theme" id="explore-author">
            <?php
            foreach ($atts['authors'] as $author) :
                $count = book_junky_count_product_by_term_id($author->term_id);
                $layout_count = ($count > 1) ? $count . " " . esc_html__("Books", "book-junky") : $count . " " . esc_html__("Book", "book-junky");
                $author_page = get_option('woocommerce_author_page_id');
                ?>
                <div class="bj-author">
                    <img class="bj-author-avatar"
                         src="<?php echo esc_url(wp_get_attachment_image_url(get_term_meta($author->term_id, 'bj_avatar', true),'wp_get_attachment_image_url' ) ) ?>"
                         alt="">
                    <div class="bj-author-name"><a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo $author->term_id ?>"><?php echo esc_attr($author->name) ?></a></div>
                    <div class="bj-book-counts"><p><?php echo esc_attr($layout_count) ?></p></div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>

