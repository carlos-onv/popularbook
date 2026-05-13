<?php
vc_map(array(
    "name" => 'CMS Featured Authors',
    "base" => "cms_featured_authors",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Limit items number", 'book-junky'),
            "param_name" => "cms_limit",
            'value' => '5'
        ),
    )
));

class WPBakeryShortCode_cms_featured_authors extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '5',
        ), $atts));

        $html_id = cmsHtmlID('cms_featured_authors');
        $atts['html_id'] = $html_id;
        $atts['cms_limit'] = $cms_limit;
        $args=array(
            'orderby' => 'id',
            'order' => 'DESC',
            'number' => $cms_limit
        );
        $terms = get_terms('pa_book_author',$args);
        $atts['datas'] = $terms;
        return parent::content($atts, $content);
    }
}

?>