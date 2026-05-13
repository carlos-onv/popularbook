<?php
vc_map(array(
    "name" => 'CMS Customer Favorites',
    "base" => "cms_customer_favorites",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Limit items number", 'book-junky'),
            "param_name" => "cms_limit",
            'value' => '6'
        ),
    )
));

class WPBakeryShortCode_cms_customer_favorites extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '6',
        ), $atts));

        $html_id = cmsHtmlID('cms_customer_favorites');
        $atts['html_id'] = $html_id;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $cms_limit,
            'orderby'   => 'meta_value_num',
            'meta_key'  => 'fs_favor',
        );
        $atts['cms_limit'] = $cms_limit;
        $atts['datas'] = new WP_Query( $args );
        return parent::content($atts, $content);
    }
}

?>