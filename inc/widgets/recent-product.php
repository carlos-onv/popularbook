<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
add_action('widgets_init', 'recent_products');

function recent_products()
{
    register_widget('WC_Widget_Recent_Product');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_Recent_Product extends WP_Widget
{

    /**
     * Constructor.
     */

    function __construct()
    {
        parent::__construct(
            'recent_product', esc_html__('Recent Product', 'book-junky'), array('description' => esc_html__('A widget that displays recent product.', 'book-junky'),)
        );
    }

    public function form($instance)
    {
        $instance = array_merge(array(
            'title' => 'Newest Releases',
            'limit' => '4'
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

        if ($title) {
            echo '' . $before_title . esc_attr($title) . $after_title;
        }

        $args_query = array(
            'orderby' => 'ID',
            'order' => 'DESC',
            'post_type' => 'product',
            'posts_per_page' => $limit
        );
        $recent_product = new WP_Query($args_query);

        if ($recent_product ->have_posts()) :

            while( $recent_product ->have_posts() ): 
                $recent_product ->the_post(); 
                global $post,$opt_meta_options;

                $color_item = get_post_meta( get_the_ID() , 'ef3-color_item', true);
                ?>
                <div class="review-item clearfix">

                    <div class="thumbnail-review" style="box-shadow: 0 5px 15px -5px <?php echo esc_attr($color_item); ?>">
                        <a href="<?php echo get_permalink( get_the_ID() ) ?>">
                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() ) ?>"
                             alt="<?php esc_html_e('Thumbnail', 'book-junky') ?>">
                         </a>
                    </div>

                    <div class="contents">
                        <a href="<?php echo get_permalink( get_the_ID() ) ?>" class="title">
                           <?php the_title() ?>
                        </a>
                        <div class="author-product">
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
                        </div>
                        <?php 

                            /**
                             * woocommerce_after_shop_loop_item_title hook.
                             *
                             * @hooked woocommerce_template_loop_rating - 5
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            do_action( 'woocommerce_after_shop_loop_item_title' );
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        endif;

        echo $args['after_widget'];
    }
}