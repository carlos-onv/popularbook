<?php
vc_map(array(
        "name" => 'CMS Highest Rated Books',
        "base" => "cms_highest_rate",
        "icon" => "cs_icon_for_vc",
        "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "book-junky"),
                "param_name" => "cms_title",
                'value' => esc_html__('Highest Rated Books', 'book-junky')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Products limit", "book-junky"),
                "param_name" => "cms_limit",
                'value' => '10'
            )
        )
    )
);

class WPBakeryShortCode_cms_highest_rate extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '10',
            'cms_title' => esc_html__('Highest Rated Books', 'book-junky')
        ), $atts));
        $atts['data'] = array();
        $atts['cms_limit'] = $cms_limit;
        $atts['cms_title'] = $cms_title;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => intval($cms_limit),
            'offset' => 0,
            'orderby' => 'meta_value_num',
            'meta_key' => '_wc_average_rating',
            'order' => "DESC"
        );
        $data = get_posts($args);
        $atts['data'] = $data;
        $html_id = cmsHtmlID('cms_highest_rate');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>