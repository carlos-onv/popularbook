<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
add_action('widgets_init', 'recent_reviews_2');

function recent_reviews_2()
{
    register_widget('WC_Widget_Recent_Views_Book_2');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_Recent_Views_Book_2 extends WP_Widget
{

    /**
     * Constructor.
     */

    function __construct()
    {
        parent::__construct(
            'recent_views_book_2', esc_html__('Recent Review Book', 'book-junky'), array('description' => esc_html__('A widget that displays review product.', 'book-junky'),)
        );
    }

    public function form($instance)
    {
        $instance = array_merge(array(
            'title' => 'This Weeks Reviewed',
            'limit' => '3'
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
        $limit = $instance['limit'];
        $posts_list_id = book_junky_get_recent_reviews($limit);

        if ($title) {
            echo '' . $before_title . esc_attr($title) . $after_title;
        }
        ?>
        <div class="recent-review-2">
            <?php
            foreach ($posts_list_id as $pid) {

                $color_item = get_post_meta($pid, 'ef3-color_item', true);
                ?>
                <div class="recent-review-item clearfix">
                
                    <div class="thumbnail-review" style="box-shadow: 0 5px 15px -5px <?php echo esc_attr($color_item); ?>">
                        <a href="<?php echo get_permalink($pid) ?>">
                            <img src="<?php echo get_the_post_thumbnail_url($pid) ?>"
                             alt="<?php esc_html_e('Thumbnail', 'book-junky') ?>">
                         </a>
                    </div>
                    <div class="contents">

                        <a href="<?php echo get_permalink($pid) ?>" class="title">

                           <?php echo get_the_title($pid) ?>
                        </a>
                        <div class="author-product">
                            <?php
                            $author_page = get_option('woocommerce_author_page_id');
                            $id_author = book_junky_get_id_term_2($pid);

                            ?>
                            <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
                                <?php 

                                    echo esc_html__('by ', 'book-junky');
                                    echo book_junky_get_author($pid); 
                                ?>
                            </a>
                        </div>

                        <?php echo book_junky_get_review_product($pid, false) ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        echo $args['after_widget'];
    }
}