<?php
vc_map(array(
    "name" => 'CMS Popular Categories',
    "base" => "cms_popular_categories",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            'type' => 'dropdown',
            'param_name' => 'layout',
            'value' => array(
                esc_html__( 'Default', 'book-junky' ) => 'default',
                esc_html__( 'Masonry', 'book-junky' ) => 'masonry',
            ),
            'heading' => esc_html__( 'Align Button', 'book-junky' ),
        ),

        array(
            "type" => "dropdown",
            "param_name" => "cms_limit",
            "value" => array(
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
            ),
            "heading" => esc_html__("Limit items number", 'book-junky'),
        )
    )
));

class WPBakeryShortCode_cms_popular_categories extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '3',
        ), $atts));
        $html_id = cmsHtmlID('cms_popular_categories');
        $atts['html_id'] = $html_id;
        $atts['cms_limit'] = $cms_limit;
        $args = array(
            'taxonomy' => 'product_cat',
            'number' => $cms_limit,
            'orderby' => 'count',
            'order' => 'desc',
            'hide_empty' => false
        );
        $atts['datas'] = get_terms($args);
        return parent::content($atts, $content);
    }
}

?>