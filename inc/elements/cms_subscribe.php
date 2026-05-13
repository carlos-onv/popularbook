<?php
vc_map(array(
    "name" => 'CMS Subscribe',
    "base" => "cms_subscribe",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        
        array(
            'type' => 'img',
            'heading' => esc_html__( 'Subscribe Style', 'book-junky' ),
            'value' => 
                array(
                    'subscribe-1' => get_template_directory_uri().'/inc/elements/images/subscribe-1.jpg',
                    'subscribe-2' => get_template_directory_uri().'/inc/elements/images/subscribe-2.jpg',
                ),
            'param_name' => 'subscribe_layout',
            'weight' => 1,
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "book-junky"),
            "param_name" => "sub_title",
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set title color.",'book-junky'),
            "param_name" => "color_title",
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Description", "book-junky"),
            "param_name" => "sub_description",
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set description color.",'book-junky'),
            "param_name" => "color_des",
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("ID Form Mail Chimp", "book-junky"),
            "param_name" => "id_mail_chimp",
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Facebook Url", "book-junky"),
            "param_name" => "facebook_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Url", "book-junky"),
            "param_name" => "twitter_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Instagram Url", "book-junky"),
            "param_name" => "instagram_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Google Url", "book-junky"),
            "param_name" => "google_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Linkedin Url", "book-junky"),
            "param_name" => "linkedin_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Pinterest Url", "book-junky"),
            "param_name" => "pinterest_url",
            'dependency' => array(
                'element' => 'subscribe_layout',
                'value' => array('subscribe-2'),
            ),
        ),

        array(
            "type" => "cms_template",
            "heading" => esc_html__("Shortcode Template",'book-junky'),
            "param_name" => "cms_template",
            "shortcode" => "cms_subscribe",
        ),
    )
));

class WPBakeryShortCode_cms_subscribe extends CmsShortCode
{   

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'subscribe_layout'  => 'subscribe-1',
        ), $atts));

        $html_id = cmsHtmlID('cms_subscribe');
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']);
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>