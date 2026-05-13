<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
add_action('widgets_init', 'recent_reviews');

function recent_reviews()
{
    register_widget('WC_Widget_Recent_Views_Book');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_Recent_Views_Book extends WP_Widget
{

    /**
     * Constructor.
     */

    function __construct()
    {
        parent::__construct(
            'recent_views_book', esc_html__('Review Book', 'book-junky'), array('description' => esc_html__('A widget that displays review product.', 'book-junky'),)
        );
    }

    public function form($instance)
    {
        $instance = array_merge(array(
            'title' => 'Recent Reviews',
            'limit' => '5'
        ), $instance);
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title'), 'book-junky'); ?>" type="text"
                   value="<?php esc_attr($instance['title']) ?>">
        </p>
        <p class="bj-limit-items">
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_attr_e('Limit:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('limit'), 'book-junky'); ?>" type="text"
                   value="<?php esc_attr($instance['limit']) ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (isset($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
        $instance['limit'] = (isset($new_instance['limit'])) ? strip_tags($new_instance['limit']) : $old_instance['limit'];
        return $instance;
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = $instance['title'];

        echo $args['before_widget'];
        $posts_list_id = book_junky_get_recent_reviews(10);

        if ($title) {
            echo '' . $before_title . esc_attr($title) . $after_title;
        }
        $limit_count = 0;
        $limit = $instance['limit'];
        foreach ($posts_list_id as $pid) {

            $color_item = get_post_meta($pid, 'ef3-color_item', true);
            $display = ($limit_count < $limit) ? "block;" : "none;";
            $item_background = get_post_meta($pid, 'ef3-item_background', true);
            $bg_item_bg = !empty($item_background['background-image']) ? $item_background['background-image'] : '';
            $bg_item_color = !empty($item_background['background-color']) ? $item_background['background-color'] : '';
            $style = '';

            if( !empty($bg_item_bg) ) {

                $style = 'background-image: url("'.$bg_item_bg.'");background-size: cover;background-repeat: no-repeat;display: ' . $display . '; ';
            } elseif( !empty($bg_item_color) ) {

                $style = 'background-color: '.$bg_item_color.';display: ' . $display . ' ;';
            } elseif( !empty($color_item) ) {

                $style = 'background-color: '.$color_item.';display: ' . $display . ' ;';
            } else {

                $style = 'background-image: url("' . get_template_directory_uri() . 'assets/images/page_title_bg.jpg");display: ' . $display . '; ';
            }

            ?>
            <div class="review-item clearfix" style="<?php echo esc_html($style) ?>">
                <div class="contents">
                    <a href="<?php echo get_permalink($pid) ?>"
                       class="title"><?php echo get_the_title($pid) ?></a>
                    <?php
                        $author_name = book_junky_get_author( $pid );

                        if ( !empty($author_name) ) : 
                        
                        $author_page = get_option('woocommerce_author_page_id');
                        $id_author = book_junky_get_id_term_2($pid);
                        ?>
                        <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
                            <p class="author-product">
                                <?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( $pid ); ?>
                            </p>
                        </a>
                    <?php endif; ?>
                    <div class="excerpt-product"><?php echo wp_trim_words(get_the_excerpt($pid), '10', ''); ?></div>
                    <?php echo book_junky_get_review_product($pid, false) ?>
                </div>
                <div class="thumbnail-review" style="box-shadow: 0 5px 15px -5px <?php echo esc_attr($color_item); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url($pid) ?>"
                         alt="<?php esc_html_e('Thumbnail', 'book-junky') ?>">
                </div>
            </div>
            <?php
            $limit_count++;
        }
        if ($limit < count($posts_list_id)) {
            ?>
            <div class="wrap-view-more">
                <div class="bj-view-more-rv"><?php echo esc_html__("View More","book-junky")?></div>
            </div>
            <?php

        }
        echo $args['after_widget'];
    }
}