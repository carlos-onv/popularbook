<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

add_action('admin_init', 'book_junky_meta_boxs');

MetaFramework::init();

function book_junky_meta_boxs()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id' => '_page_main_options',
        'label' => esc_html__('Page Setting', 'book-junky'),
        'post_type' => 'page',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => false,
        'sections' => array(
            array(
                'title' => __('Header', 'book-junky'),
                'id' => 'tab-page-header',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id' => 'header_layout',
                        'title' => esc_html__('Layouts', 'book-junky'),
                        'subtitle' => esc_html__('select a layout for header', 'book-junky'),
                        'default' => '',
                        'type' => 'image_select',
                        'options' => array(
                            '1' => get_template_directory_uri().'/assets/images/header-1.jpg',
                            '2' => get_template_directory_uri().'/assets/images/header-2.jpg',
                            '3' => get_template_directory_uri().'/assets/images/header-3.jpg',
                        )
                    ),
                    array(
                        'id' => 'header_menu',
                        'type' => 'select',
                        'title' => __('Select Menu', 'book-junky'),
                        'subtitle' => __('custom menu for current page', 'book-junky'),
                        'options' => book_junky_get_nav_menu(),
                        'default' => '',
                    ),
                )
            ),
            array(
                'title' => esc_html__('Page Title & BC', 'book-junky'),
                'id' => 'tab-page-title-bc',
                'icon' => 'el el-map-marker',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Enable custom page title.', 'book-junky'),
                        'id' => 'custom_page_title',
                        'type' => 'switch',
                        'title' => esc_html__('Custom Page Title', 'book-junky'),
                        'default' => false,
                    ),

                    array(
                        'id' => 'page_title_layout',
                        'title' => esc_html__('Layouts', 'book-junky'),
                        'subtitle' => esc_html__('select a layout for page title', 'book-junky'),
                        'default' => '1',
                        'type' => 'image_select',
                        'options' => array(
                            '1' => get_template_directory_uri().'/assets/images/page-title-2.jpg',
                            '2' => get_template_directory_uri().'/assets/images/page-title-1.jpg',
                            '4' => get_template_directory_uri().'/assets/images/page-title-3.jpg',
                            '5' => get_template_directory_uri().'/assets/images/page-title-4.jpg',
                        ),
                        'required' => array('custom_page_title', '=', 1),
                    ),
                    array(
                        'id'       => 'select_product',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Select Product', 'book-junky' ),
                        'options'  =>  book_junky_get_product(),
                        'required'  => array( 'page_title_layout', '=', '4' ),
                    ),
                    array(
                        'id'       => 'select_product_2',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Select Product', 'book-junky' ),
                        'options'  =>  book_junky_get_product(),
                        'required'  => array( 'page_title_layout', '=', '5' ),
                    ),

                    array(
                        'id'                => 'page_title_4',
                        'type'              => 'text',
                        'title'             => esc_html__('Page Title', 'book-junky'),
                        'required'          => array( 'page_title_layout', '=', '4' ),
                    ),

                    array(
                        'id'                => 'page_title_4_2',
                        'type'              => 'text',
                        'title'             => esc_html__('Page Title', 'book-junky'),
                        'required'          => array( 'page_title_layout', '=', '5' ),
                    ),
                    
                    array(
                        'id' => 'page_title_text',
                        'type' => 'text',
                        'title' => esc_html__('Custom Title', 'book-junky'),
                        'subtitle' => esc_html__('Custom current page title.', 'book-junky'),
                        'required' => array('page_title_layout', '=', '2'),
                    ),
                    array(
                        'subtitle' => esc_html__('Enable sub title.', 'book-junky'),
                        'id' => 'sub_title_en',
                        'type' => 'switch',
                        'title' => esc_html__('Subtitle', 'book-junky'),
                        'default' => false,
                        'required' => array('page_title_layout', '=', '2'),
                    ),
                    array(
                        'id' => 'sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Sub Title', 'book-junky'),
                        'subtitle' => esc_html__('Custom current page sub title.', 'book-junky'),
                        'required' => array('sub_title_en', '=', 1),
                    ),
                )
            ),
            array(
                'title' => esc_html__('Page Option', 'book-junky'),
                'id' => 'tab-one-page',
                'icon' => 'el el-cogs',
                'fields' => array(
                    array(
                        'subtitle' => esc_html__('Enable one page mode for current page.', 'book-junky'),
                        'id' => 'page_one_page',
                        'type' => 'switch',
                        'title' => esc_html__('Enable', 'book-junky'),
                        'default' => false,
                    ),
                    array(
                        'id'            => 'page_one_page_speed',
                        'type'          => 'slider',
                        'title'         => esc_html__( 'Speed', 'book-junky' ),
                        'default'       => 1000,
                        'min'           => 500,
                        'step'          => 100,
                        'max'           => 5000,
                        'display_value' => 'text',
                        'required' => array('page_one_page', '=', '1')
                    ),
                    array(
                        'id'             => 'space_content',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'left'           => false,
                        'right'          => false,
                        'units'          => array('px'),
                        'title'          => esc_html__('Space Content', 'book-junky'),
                    ),
                )
            ),
        )
    ));

    /** post options */
    MetaFramework::setMetabox(array(
        'id' => '_page_post_format_options',
        'label' => esc_html__('Post Format', 'book-junky'),
        'post_type' => 'post',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => true,
        'sections' => array(
            array(
                'title' => esc_html__('Header', 'book-junky'),
                'id' => 'tab-page-header',
                'icon' => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id' => 'post_layout',
                        'title' => esc_html__('Layouts', 'book-junky'),
                        'subtitle' => esc_html__('select a layout show on page blog', 'book-junky'),
                        'default' => '1',
                        'type' => 'image_select',
                        'options' => array(
                            '1' => get_template_directory_uri().'/assets/images/layout_post_1.jpg',
                            '2' => get_template_directory_uri().'/assets/images/layout_post_2.jpg',
                        )
                    ),
                )
            ),
            array(
                'title' => '',
                'id' => 'color-Color',
                'icon' => 'el el-laptop',
                'fields' => array(
                    array(
                        'id' => 'opt-video-type',
                        'type' => 'select',
                        'title' => esc_html__('Select Video Type', 'book-junky'),
                        'subtitle' => esc_html__('Local video, Youtube, Vimeo', 'book-junky'),
                        'options' => array(
                            'local' => esc_html__('Upload', 'book-junky'),
                            'youtube' => esc_html__('Youtube', 'book-junky'),
                            'vimeo' => esc_html__('Vimeo', 'book-junky'),
                        )
                    ),
                    array(
                        'id' => 'otp-video-local',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Local Video', 'book-junky'),
                        'subtitle' => esc_html__('Upload video media using the WordPress native uploader', 'book-junky'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'opt-video-youtube',
                        'type' => 'text',
                        'title' => esc_html__('Youtube', 'book-junky'),
                        'subtitle' => esc_html__('Load video from Youtube.', 'book-junky'),
                        'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'book-junky'),
                        'required' => array('opt-video-type', '=', 'youtube')
                    ),
                    array(
                        'id' => 'opt-video-vimeo',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'book-junky'),
                        'subtitle' => esc_html__('Load video from Vimeo.', 'book-junky'),
                        'placeholder' => esc_html__('https://vimeo.com/155673893', 'book-junky'),
                        'required' => array('opt-video-type', '=', 'vimeo')
                    ),
                    array(
                        'id' => 'otp-video-thumb',
                        'type' => 'media',
                        'url' => true,
                        'mode' => false,
                        'title' => esc_html__('Video Thumb', 'book-junky'),
                        'subtitle' => esc_html__('Upload thumb media using the WordPress native uploader', 'book-junky'),
                        'required' => array('opt-video-type', '=', 'local')
                    ),
                    array(
                        'id' => 'opt-gallery',
                        'type' => 'gallery',
                        'title' => esc_html__('Add/Edit Gallery', 'book-junky'),
                        'subtitle' => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'book-junky'),
                    ),
                )
            ),
        )
    ));
}