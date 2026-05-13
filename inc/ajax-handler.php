<?php
if (!defined("ABSPATH")) {
    exit();
}

if (!class_exists("book_junky_ajax_handler")) {
    class book_junky_ajax_handler
    {
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'book_junky_register_ajax'));
            add_action("wp_ajax_book_junky_load_more_comments", array($this, "book_junky_load_more_comments"));
            add_action("wp_ajax_nopriv_book_junky_load_more_comments", array($this, "book_junky_load_more_comments"));
            add_action("wp_ajax_book_junky_show_more_latest_products", array($this, "book_junky_show_more_latest_products"));
            add_action("wp_ajax_nopriv_book_junky_show_more_latest_products", array($this, "book_junky_show_more_latest_products"));
        }

        function book_junky_register_ajax()
        {
            wp_enqueue_script('bj-handle.js', get_template_directory_uri() . '/assets/js/bj-handle.js', '', 'all', true);
            $ajax_data = array(
                'ajax_url' => admin_url('admin-ajax.php'),
            );
            wp_localize_script('bj-handle.js', 'bj_handle', $ajax_data);
        }

        function book_junky_load_more_comments()
        {
            if (!empty($_REQUEST['page']) && !empty($_REQUEST['post_id']) && !empty($_REQUEST['count'])) {
                global $post;
                $post->ID = $_REQUEST['post_id'];
                $per_page = get_option('comments_per_page', '5');
                $per_page = intval($per_page);
                $page = intval($_REQUEST['page']) + 1;
                $layout = wp_list_comments(apply_filters('woocommerce_product_review_list_args', array(
                        'callback' => 'woocommerce_comments',
                        'page' => $page,
                        'per_page' => $per_page,
                        'echo' => false))
                );
                $new_count = $_REQUEST['count'] - $per_page;
                $new_count = $_REQUEST['count'] <= 0 ? 0 : $new_count;
                wp_send_json(array('stt' => 'success', 'layout' => $layout, 'new_count' => $new_count));
                die();
            } else {
                wp_send_json(array('stt' => 'error'));
                die();
            }
        }

        function book_junky_show_more_latest_products()
        {
            if (!empty($_REQUEST['count']) && !empty($_REQUEST['limit'])) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1
                );
                $counts = count(get_posts($args));
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $_REQUEST['limit'],
                    'offset' => $_REQUEST['count'],
                );
                $data = get_posts($args);
                $layout = "";
                foreach ($data as $product){
                    $layout .= book_junky_get_item_layout($product->ID);
                }
                $more = true;
                if($counts <= $_REQUEST['limit']+$_REQUEST['count']){
                    $more = false;
                }
                wp_send_json(array('stt' => 'success', 'layout' => $layout, 'more' => $more));
                die();
            } else {
                wp_send_json(array('stt' => 'error'));
                die();
            }
        }
    }

    new book_junky_ajax_handler();
}
$opt = get_option('comments_per_page');