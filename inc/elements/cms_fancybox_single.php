<?php
vc_remove_param('cms_fancybox_single', 'title');
vc_remove_param('cms_fancybox_single', 'content_align');
vc_remove_param('cms_fancybox_single', 'button_type');
vc_remove_param('cms_fancybox_single', 'button_link');
vc_remove_param('cms_fancybox_single', 'button_text');
vc_remove_param('cms_fancybox_single', 'description');
vc_remove_param('cms_fancybox_single', 'image');

vc_add_param("cms_fancybox_single", 
	array(
	    'type' => 'img',
	    'heading' => esc_html__( 'Fancybox Style', 'book-junky' ),
	    'value' => 
		    array(
		    	'fancybox-1' => get_template_directory_uri().'/inc/elements/images/fancy-1.jpg',
		    	'fancybox-2' => get_template_directory_uri().'/inc/elements/images/fancy-2.jpg',
		    	'fancybox-3' => get_template_directory_uri().'/inc/elements/images/fancy-3.jpg',
		    	'fancybox-4' => get_template_directory_uri().'/inc/elements/images/fancy-4.jpg',
		    ),
	    'param_name' => 'fancybox_style',
	    "group" => esc_html__("Template", 'book-junky'),
	    'weight' => 1,
	)
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "textfield",
        "heading" => esc_html__("Title Item",'book-junky'),
        "param_name" => "title_item",
        "value" => "",
        "description" => esc_html__("Title Of Item",'book-junky'),
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-1','fancybox-2','fancybox-4'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky')
    )
);

vc_add_param("cms_fancybox_single", 
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Icon library', 'book-junky' ),
		'value' => array(
			esc_html__( 'Font Awesome', 'book-junky' ) => 'fontawesome',
			esc_html__( 'Open Iconic', 'book-junky' ) => 'openiconic',
			esc_html__( 'Typicons', 'book-junky' ) => 'typicons',
			esc_html__( 'Entypo', 'book-junky' ) => 'entypo',
			esc_html__( 'Linecons', 'book-junky' ) => 'linecons',
			esc_html__( 'P7 Stroke', 'book-junky' ) => 'pe7stroke',
			esc_html__( 'RT Icon', 'book-junky' ) => 'rticon',
			esc_html__( 'Material Design', 'book-junky' ) => 'material-design',
		),
		'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-2'),
		),
		'param_name' => 'icon_type',
		'description' => esc_html__( 'Select icon library.', 'book-junky' ),
		"group" => esc_html__("Fancy Icon Settings", 'book-junky'),
	)
);

vc_add_param("cms_fancybox_single", 
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__( 'Icon Item', 'book-junky' ),
		'param_name' => 'icon_material-design',
		'settings' => array(
			'emptyIcon' => true, // default true, display an "EMPTY" icon?
			'type' => 'material-design',
			'iconsPerPage' => 200, // default 100, how many icons per/page to display
		),
		'dependency' => array(
			'element' => 'icon_type',
			'value' => 'material-design',
		),
		'description' => esc_html__( 'Select icon from library.', 'book-junky' ),
		"group" => esc_html__("Fancy Icon Settings", 'book-junky')
	)
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "textarea",
        "heading" => esc_html__("Content Item",'book-junky'),
        "param_name" => "description_item",
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-1'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "css_editor",
        "heading" => esc_html__("Design Fancybox",'book-junky'),
        "param_name" => "design_css",
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-3'),
		),
        "group" => esc_html__("Design Options", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "dropdown",
        "heading" => esc_html__("Type Content",'book-junky'),
        "param_name" => "type_element",
        "value" => array(
        	esc_html__("Text Field","book-junky") => "text_field",
        	esc_html__("Phone","book-junky") => "phone",
        	esc_html__("Email","book-junky") => "email",
        	),
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-2'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky')
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "dropdown",
        "heading" => esc_html__("Icon Layout",'book-junky'),
        "param_name" => "type_icon",
        "value" => array(
        	esc_html__("Icon None","book-junky") => "",
        	esc_html__("Icon Left","book-junky") => "icon_left",
        	esc_html__("Icon Right","book-junky") => "icon_right",
        	esc_html__("Icon Both Sides","book-junky") => "both_sides",
        	),
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-4'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky')
    )
);

vc_add_param("cms_fancybox_single", 
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__( 'Icon Item', 'book-junky' ),
		'param_name' => 'icon_material-design-2',
		'settings' => array(
			'emptyIcon' => true, // default true, display an "EMPTY" icon?
			'type' => 'material-design',
			'iconsPerPage' => 200, // default 100, how many icons per/page to display
		),
		'dependency' => array(
			'element' => 'type_icon',
			'value' => array('icon_left','icon_right','both_sides'),
		),
		'description' => esc_html__( 'Select icon from library.', 'book-junky' ),
		"group" => esc_html__("Fancy Icon Settings", 'book-junky')
	)
);

vc_add_param("cms_fancybox_single", 
	array(
        'type' => 'checkbox',
        'heading' => esc_html__("Space Right Fancybox", 'book-junky'),
        'param_name' => 'spa_right',
        'std' => false,
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-4'),
		),
		"group" => esc_html__("Fancy Icon Settings", 'book-junky')
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Color Icon Box', 'book-junky' ),
        "param_name" => "color_ic_fancy_box",
	    'dependency' => array(
			'element' => 'type_icon',
			'value' => array('icon_left','icon_right','both_sides'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Color Content', 'book-junky' ),
        "param_name" => "color_fancy_box",
	    'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-4'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Background Fancy Box', 'book-junky' ),
        "param_name" => "bg_fancy_box",
	    'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-4'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);


vc_add_param("cms_fancybox_single", 
	array(
        'type' => 'param_group',
        'heading' => 'Content',
        'param_name' => 'content_opts',
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-2'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title",'book-junky'),
                "param_name" => "title_opt",
                'admin_label' => true,
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Content",'book-junky'),
                "param_name" => "content_opt",
                'admin_label' => true,
            ),
        ),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Background Color Icon', 'book-junky' ),
        "param_name" => "bg_color_icon",
	    'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-2'),
		),
		'description' => esc_html__( 'Select color icon.', 'book-junky' ),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Color Title', 'book-junky' ),
        "param_name" => "color_title",
	    'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-1','fancybox-2'),
		),
		'description' => esc_html__( 'Select color title.', 'book-junky' ),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
		'heading' => esc_html__( 'Color Content', 'book-junky' ),
        "param_name" => "color_content",
	    'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-1','fancybox-2'),
		),
		'description' => esc_html__( 'Select color content.', 'book-junky' ),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "vc_link",
        "heading" => esc_html__( 'Link Button', "book-junky" ),
        "param_name" => "link_fancy",
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-3'),
		),
		'description' => esc_html__( 'link on click fancy.', 'book-junky' ),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);

vc_add_param("cms_fancybox_single", 
	array(
	    'type' => 'attach_image',
	    'heading' => esc_html__( 'Select Image.', 'book-junky' ),
	    'param_name' => 'fancy_image',
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-3'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
	)
);

vc_add_param("cms_fancybox_single", 
	array(
        "type" => "colorpicker",
        "heading" => esc_html__("Set color fancybox.",'book-junky'),
        "param_name" => "color_border",
        'dependency' => array(
			'element' => 'fancybox_style',
			'value' => array('fancybox-3'),
		),
        "group" => esc_html__("Fancy Icon Settings", 'book-junky'),
    )
);



