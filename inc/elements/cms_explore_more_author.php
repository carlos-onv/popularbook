<?php
vc_map(array(
    "name" => 'CMS Explore More Authors',
    "base" => "cms_explore_more_author",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "book-junky"),
            "param_name" => "cms_title",
            'value' => esc_html__('Explore More Authors', 'book-junky')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Authors limit", "book-junky"),
            "param_name" => "cms_limit",
            'value' => '10'
        )
    )
));

class WPBakeryShortCode_cms_explore_more_author extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'cms_limit' => '10',
                'cms_title' => esc_html__('Explore More Authors', 'book-junky')),
                $atts)
        );
        $authors = get_terms(array(
            'taxonomy' => "pa_book_author",
            'hide_empty' => true,
            'number' => intval($cms_limit),
            'orderby' => 'id',
            'order' => 'DESC'
        ));
        $html_id = cmsHtmlID('cms_explore_more_author');
        $atts['cms_title'] = $cms_title;
        $atts['html_id'] = $html_id;
        $atts['authors'] = $authors;
        return parent::content($atts, $content);
    }
}

?>