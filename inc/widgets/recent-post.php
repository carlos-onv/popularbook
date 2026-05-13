<?php
/**
 * Class CmsRecentPosts
 */
class CmsRecentPosts extends WP_Widget {
    /**
     * Widget Setup
     */
    function __construct() {
        $widget_ops = array('classname' => 'cms-recent-posts', 'description' => esc_html__('A widget that displays recent posts.', 'book-junky') );
        $control_ops = array('id_base' => 'cms_recent_posts');
        parent::__construct('cms_recent_posts', esc_html__('CMS Recent Posts', 'book-junky'), $widget_ops, $control_ops);
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    function widget($args, $instance) {
        extract($args);
        $title = $instance['title']; 
        $posts = $instance['posts'];

        $args_query = array(
            'orderby' => 'ID',
            'order' => 'DESC',
            'post_type' => 'post',
            'posts_per_page' => $posts
        );
        $cms_recentposts = new WP_Query($args_query);

        echo ''.$before_widget;
        if($title) {
            echo ''.$before_title.esc_attr($title).$after_title;
        }
        ?>
        <?php if ($cms_recentposts->have_posts()) : ?>
            <?php while($cms_recentposts->have_posts()): $cms_recentposts->the_post(); global $post; ?>
                <article <?php post_class('recent-post-item clearfix'); ?>>
                    <div class="recent-post-thumbnail">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                    </div>
                    <div class="recent-post-content">
                        <a class="entry-widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <p class="date-time"><?php echo get_the_date('M d,Y'); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
        <!-- END WIDGET -->
        <?php
        echo ''.$after_widget;
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts'] = $new_instance['posts'];
        
        return $instance;
    }

    function form($instance) {

        $defaults = array('title' => 'RECENT POSTS', 'categories' => 'all', 'posts' => 5);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo ''.$this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'book-junky') ?></label>
            <input type="text" class="widefat" id="<?php echo ''.$this->get_field_id('title'); ?>" name="<?php echo ''.$this->get_field_name('title'); ?>" value="<?php echo ''.$instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id('posts'); ?>"><?php esc_html_e('Number of posts:', 'book-junky') ?></label>
            <input type="text" class="widefat" id="<?php echo ''.$this->get_field_id('posts'); ?>" name="<?php echo ''.$this->get_field_name('posts'); ?>" value="<?php echo ''.$instance['posts']; ?>" />
        </p>
    <?php
    }
}

register_widget('CmsRecentPosts');
?>