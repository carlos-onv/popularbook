<?php
vc_map(array(
    "name" => 'CMS Button',
    "base" => "cms_button",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            'type' => 'dropdown',
            'param_name' => 'align_button',
            'value' => array(
                esc_html__( 'Left', 'book-junky' ) => 'left',
                esc_html__( 'Center', 'book-junky' ) => 'center',
                esc_html__( 'Right', 'book-junky' ) => 'right',
            ),
            'heading' => esc_html__( 'Align Button', 'book-junky' ),
        ),
        array(
            "type" => "vc_link",
            "heading" => esc_html__( 'Link Button', "book-junky" ),
            "param_name" => "link_button",
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set text color.",'book-junky'),
            "param_name" => "color_text",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set text color when hover.",'book-junky'),
            "param_name" => "color_text_hover",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set color border.",'book-junky'),
            "param_name" => "color_border",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set color border when hover.",'book-junky'),
            "param_name" => "color_border_hover",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'custom_color',
            'value' => array(
                esc_html__( 'Color Normal', 'book-junky' ) => 'co_no',
                esc_html__( 'Color Gradient', 'book-junky' ) => 'co_gra',
            ),
            'heading' => esc_html__( 'Select Box Shadow', 'book-junky' ),
            "group" => esc_html__("Button Settings", "book-junky"),
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set color button.",'book-junky'),
            "param_name" => "color_btn",
            "group" => esc_html__("Button Settings", "book-junky"),
            "dependency" => array(
                "element" => "custom_color",
                "value" => "co_no",
            ),
        ),


        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color Gradient 1.",'book-junky'),
            "param_name" => "color_gradient_1",
            "group" => esc_html__("Button Settings", "book-junky"),
            "dependency" => array(
                "element" => "custom_color",
                "value" => "co_gra",
            ),
        ),


        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color Gradient 2.",'book-junky'),
            "param_name" => "color_gradient_2",
            "group" => esc_html__("Button Settings", "book-junky"),
            "dependency" => array(
                "element" => "custom_color",
                "value" => "co_gra",
            ),
        ),
        
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set color button hover.",'book-junky'),
            "param_name" => "color_btn_hover",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'custom_bs',
            'value' => array(
                esc_html__( 'Disable', 'book-junky' ) => 'dis-bs',
                esc_html__( 'Enable Custom', 'book-junky' ) => 'en-ct',
            ),
            'heading' => esc_html__( 'Select Box Shadow', 'book-junky' ),
            "group" => esc_html__("Button Settings", "book-junky"),
        ),

        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Set color box shadow.",'book-junky'),
            "param_name" => "color_bs",
            "group" => esc_html__("Button Settings", "book-junky"),
            "dependency" => array(
                "element" => "custom_bs",
                "value" => "en-ct",
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Button Border Radius", "book-junky"),
            "param_name" => "btn_radius",
            "description" => "Enter: ...px",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Max Width Button", "book-junky"),
            "param_name" => "max_width_button",
            "description" => "Enter: ...px",
            "group" => esc_html__("Button Settings", "book-junky"),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Inline Block", 'book-junky'),
            'param_name' => 'dis_inline',
            'std' => false,
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Space Right Button", 'book-junky'),
            'param_name' => 'spa_right',
            'std' => false,
        ),

        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon Item', 'book-junky' ),
            'param_name' => 'icon_button',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'material-design',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'description' => esc_html__( 'Select icon from library.', 'book-junky' ),
        ),
        array(
            "type" => "cms_template",
            "heading" => esc_html__("Shortcode Template",'book-junky'),
            "param_name" => "cms_template",
            "shortcode" => "cms_button",
        ),
    )
));

class WPBakeryShortCode_cms_button extends CmsShortCode
{   

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'align_button'  => 'center',
        ), $atts));

        $html_id = cmsHtmlID('cms_button');
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']);
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>