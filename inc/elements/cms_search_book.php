<?php
vc_map(array(
    "name" => 'CMS Search Book',
    "base" => "cms_search_book",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "cms_template",
            "heading" => esc_html__("Shortcode Template",'book-junky'),
            "param_name" => "cms_template",
            "shortcode" => "cms_search_book",
        ),
    )
));

class WPBakeryShortCode_cms_search_book extends CmsShortCode
{   

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_template' => 'cms_search_book',
        ), $atts));

        $html_id = cmsHtmlID('cms_search_book');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>