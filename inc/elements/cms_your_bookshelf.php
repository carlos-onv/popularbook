<?php
vc_map(array(
    "name" => 'CMS Your Bookshelf',
    "base" => "cms_your_bookshelf",
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

class WPBakeryShortCode_cms_your_bookshelf extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_limit' => '6',
        ), $atts));

        $html_id = cmsHtmlID('cms_your_bookshelf');
        $atts['html_id'] = $html_id;
        $atts['cms_limit'] = $cms_limit;
        $current_uid = get_current_user_id();
        $list_book_id = $current_uid !== 0 ? get_user_meta($current_uid, 'fs_favor_ids', true) : "";
        $list_id = explode(',',$list_book_id);
        array_shift($list_id);
        $atts['datas'] = $list_id;
        return parent::content($atts, $content);
    }
}

?>