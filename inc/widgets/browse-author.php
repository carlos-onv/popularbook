<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
add_action('widgets_init', 'browse_author');

function browse_author()
{
    register_widget('WC_Widget_browse_author');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_browse_author extends WP_Widget
{

    /**
     * Constructor.
     */

    function __construct()
    {
        parent::__construct(
            'browse_author', esc_html__('Browse By Author', 'book-junky'), array('description' => esc_html__('A widget that displays browse by author.', 'book-junky'),)
        );
    }

    public function form($instance)
    {
        $instance = array_merge(array(
            'title' => 'Browse By Author',
            'limit' => '7'
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
        $limit = $instance['limit'];

        echo $args['before_widget'];
        $terms = get_terms(array(
            'taxonomy' => 'pa_book_author',
            'hide_empty' => false
        ));
        if ($title) {
            echo '' . $before_title . esc_attr($title) . $after_title;
        }
        $limit_count = 0;

        foreach ($terms as $term) {
            $count = book_junky_count_product_by_term_id($term->term_id);
            $layout_count = ($count > 1) ? $count . " " . esc_html__("Books", "book-junky") : $count . " " . esc_html__("Book", "book-junky");
            ?>
            <?php 
                $id_avt = get_term_meta($term ->term_id,"bj_avatar",true);

                if( !empty($id_avt) ) {

                    $term_avt = wp_get_attachment_image_src( $id_avt, 'book_junky_500X500', false);

                    $url_avt = $term_avt[0];
                } else {

                    $url_avt = get_template_directory_uri() . '/assets/images/author.png';
                }
            $author_page = get_option('woocommerce_author_page_id');
            ?>


            <div class="bj-brs-author-item clearfix" style="<?php echo ($limit_count < $limit)? esc_html("display:block") : esc_html("display:none") ?>">
                <div class="wrap-thumbnail">
                    <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo $term->term_id ?>">
                        <img src="<?php echo esc_url($url_avt); ?>" alt="<?php esc_html__("Avt Author", "book-junky"); ?>">
                    </a>
                </div>
                <div class="wrap-info">
                    <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo $term->term_id ?>"><?php echo esc_attr($term->name) ?></a>
                    <div class="bj-brs-author-count"><?php echo esc_attr($layout_count) ?></div>
                </div>
            </div>
            <?php
            $limit_count++;
        }


        echo $args['after_widget'];
    }
}