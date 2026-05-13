<?php
vc_map(array(
    "name" => 'CMS Post Single',
    "base" => "cms_post_single",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            'type' => 'img',
            'heading' => esc_html__( 'Post Layout', 'book-junky' ),
            'value' => 
                array(
                    'post-1' => get_template_directory_uri().'/inc/elements/images/post_single_1.jpg',
                    'post-2' => get_template_directory_uri().'/inc/elements/images/post_single_2.jpg',
                ),
            'param_name' => 'post_layout',
            "group" => esc_html__("Template", 'book-junky'),
            'weight' => 1,
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'select_post',
            'value' => book_junky_get_post(),
            'heading' => esc_html__( 'Select Post', 'book-junky' ),
            "group" => esc_html__("Template", 'book-junky'),
        )
    )
));

class WPBakeryShortCode_cms_post_single extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'post_layout' => 'post-1',
        ), $atts));

        $html_id = cmsHtmlID('cms_post_single');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>