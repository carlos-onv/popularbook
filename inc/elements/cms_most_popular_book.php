<?php
vc_map(array(
    "name" => 'CMS Most Popular Book',
    "base" => "cms_most_popular_book",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Limit items number", 'book-junky'),
            "param_name" => "cms_limit",
            'value' => '20'
        ),
    )
));

class WPBakeryShortCode_cms_most_popular_book extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '20',
        ), $atts));

        $html_id = cmsHtmlID('cms_most_popular_book');
        $atts['cms_limit'] = $cms_limit;
        $atts['html_id'] = $html_id;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $atts['cms_limit'],
            'orderby'   => 'meta_value_num',
            'meta_key'  => 'total_sales',
        );
        /* Add main.js */
        wp_enqueue_script('owl-carousel-custom', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', '', 'all', true);
        wp_enqueue_style('owl-carousel-style' );
        $atts['datas'] = new WP_Query( $args );
        return parent::content($atts, $content);
    }
}

?>