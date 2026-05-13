<?php
vc_add_param("cms_carousel", 
	array(
	    'type' => 'img',
	    'heading' => esc_html__( 'Carousel Layout', 'book-junky' ),
	    'value' => 
		    array(
		    	'carousel-1' => get_template_directory_uri().'/inc/elements/images/carousel-1.jpg',
		    	'carousel-2' => get_template_directory_uri().'/inc/elements/images/carousel-2.jpg',
		    	'carousel-3' => get_template_directory_uri().'/inc/elements/images/carousel-3.jpg',
		    	'carousel-4' => get_template_directory_uri().'/inc/elements/images/carousel-4.jpg',
		    ),
	    'param_name' => 'carousel_layout',
	    "group" => esc_html__("Template", 'book-junky'),
	    'weight' => 1,
	)
);

vc_add_param("cms_carousel", 
	array(
        "type" => "textfield",
		'heading' => esc_html__( 'Title', 'book-junky' ),
        "param_name" => "carousel_title",
        "group" => esc_html__("Template", 'book-junky'),
        'dependency' => array(
			'element' => 'carousel_layout',
			'value' => array('carousel-1','carousel-4'),
		)
    )
);

vc_add_param("cms_carousel", 
	array(
        "type" => "dropdown",
        "param_name" => "extend",
        "value" => array(
            'Default' => '',
            'Extend Left' => 'extend-left',
            'Extend Right' => 'extend-right',
        ),
        "heading" => esc_html__("Select Extend", 'book-junky'),
        "group" => esc_html__("Template", 'book-junky'),
        'dependency' => array(
			'element' => 'carousel_layout',
			'value' => array('carousel-4'),
		),
    )
);










