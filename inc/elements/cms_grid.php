<?php
vc_add_param("cms_grid", 
	array(
	    'type' => 'img',
	    'heading' => esc_html__( 'Carousel Layout', 'book-junky' ),
	    'value' => 
		    array(
		    	'grid-1' => get_template_directory_uri().'/inc/elements/images/grid-1.jpg',
		    	'grid-2' => get_template_directory_uri().'/inc/elements/images/grid-2.jpg',
		    	'grid-3' => get_template_directory_uri().'/inc/elements/images/grid-3.jpg',
		    	'grid-4' => get_template_directory_uri().'/inc/elements/images/grid-4.jpg',
		    ),
	    'param_name' => 'grid_layout',
	    "group" => esc_html__("Template", 'book-junky'),
	    'weight' => 1,
	)
);

vc_add_param("cms_grid", 
	array(
        "type" => "dropdown",
        "heading" => esc_html__("Columns LG Devices",'book-junky'),
        "param_name" => "col_lg",
        "edit_field_class" => "vc_col-sm-3 vc_column",
        "value" => array(1,2,3,4,5,6,12),
        "std" => 4,
        "group" => esc_html__("Grid Settings", 'book-junky')
    )
);

vc_add_param("cms_grid", 
	array(
        "type" => "dropdown",
        "param_name" => "extend_space",
        "value" => array(
            'Default' => '',
            'Extend Space' => 'extend-space',
        ),
        "heading" => esc_html__("Select Extend Space", 'book-junky'),
        "group" => esc_html__("Grid Settings", 'book-junky'),
        'dependency' => array(
			'element' => 'grid_layout',
			'value' => array('grid-2'),
		),
    )
);

vc_add_param("cms_grid", 
	array(
        "type" => "dropdown",
        "heading" => esc_html__("Filter",'book-junky'),
        "param_name" => "filter",
        "value" => array(
        	esc_html__("Enable",'book-junky') => "true",
        	esc_html__("Disable",'book-junky') => "false"
        	),
        "dependency" => array(
        	"element" => "grid_layout",
        	"value" => "grid-2"
        	),
        "group" => esc_html__("Grid Settings", 'book-junky'),
    )
);

vc_add_param("cms_grid", 
	array(
        "type" => "textfield",
        "heading" => esc_html__("Title Grid",'book-junky'),
        "param_name" => "title",
        "dependency" => array(
        	"element" => "grid_layout",
        	"value" => "grid-2"
        ),
        "group" => esc_html__("Grid Settings", 'book-junky')
    )
);