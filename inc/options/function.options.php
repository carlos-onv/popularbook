<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'opt_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__('System Options','book-junky'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

/**
 * General Options.
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'book-junky'),
    'icon' => 'el-icon-adjust-alt',
    'fields' => array(
        array(
            'title'             => esc_html__('Body Boxed', 'book-junky'),
            'id'                => 'en_boxed',
            'type'              => 'switch',
            'subtitle'       => esc_html__('work on screen min width 1650px','book-junky'),
            'default'           => false,
        ),
        array(
            'id'       => 'bg_boxed_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Background Type', 'book-junky'),
            'options' => array(
                '1' => esc_html__('Background Normal','book-junky'), 
                '2' => esc_html__('Background Gradient','book-junky'),
             ), 
            'default' => '2',
            'required'          => array( 'en_boxed', '=', 1 ),
        ),
        array(
            'id'                => 'boxed_background_1',
            'type'              => 'color',
            'title'             => esc_html__( 'Color Gradient 1', 'book-junky' ),
            'required'          => array( 'bg_boxed_type', '=', 2 ),
        ),
        array(
            'id'                => 'boxed_background_2',
            'type'              => 'color',
            'title'             => esc_html__( 'Color Gradient 2', 'book-junky' ),
            'required'          => array( 'bg_boxed_type', '=', 2 ),
        ),
        array(
            'title'             => esc_html__('Body Background', 'book-junky'),
            'subtitle'          => esc_html__('Body background when boxed body.', 'book-junky'),
            'id'                => 'boxed_background',
            'type'              => 'background',
            'required'          => array( 'bg_boxed_type', '=', 1 ),
        ),
        array(
            'title'             => esc_html__('Content Background', 'book-junky'),
            'subtitle'          => esc_html__('Content background when boxed body.', 'book-junky'),
            'id'                => 'boxed_content_background',
            'type'              => 'background',
            'required'          => array( 'en_boxed', '=', 1 ),
        ),
        array(
            'id'             => 'space_content',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'left'           => false,
            'right'          => false,
            'units'          => array('px'),
            'title'          => esc_html__('Space Content', 'book-junky'),
            'subtitle'       => esc_html__('Space content width header and footer default 100px.', 'book-junky'),
        ),
        array(
            'subtitle'          => esc_html__('Enable back to top button.', 'book-junky'),
            'id'                => 'general_back_to_top',
            'type'              => 'switch',
            'title'             => esc_html__('Back To Top', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Enable Page Loading.', 'book-junky'),
            'id'                => 'page_loading',
            'type'              => 'switch',
            'title'             => esc_html__('Page Loading', 'book-junky'),
            'default'           => false,
        ),
        array(
            'title' => esc_html__('Select Favicon Site', 'book-junky'),
            'subtitle' => esc_html__('Set icon for your site file type *.ico,.png', 'book-junky'),
            'id' => 'fav_icon',
            'type' => 'media',
            'url' => false,
        ),
    )
));

/**
 * Header Options
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'book-junky'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id'                => 'header_layout',
            'title'             => esc_html__('Layouts', 'book-junky'),
            'subtitle'          => esc_html__('select a layout for header', 'book-junky'),
            'default'           => '1',
            'type'              => 'image_select',
            'options'           => array(
                                        '1' => get_template_directory_uri().'/assets/images/header-1.jpg',
                                        '2' => get_template_directory_uri().'/assets/images/header-2.jpg',
                                        '3' => get_template_directory_uri().'/assets/images/header-3.jpg',
                                    )
        ),
        
        array(
            'subtitle'          => esc_html__('Enable mega menu.', 'book-junky'),
            'id'                => 'mega_menu',
            'type'              => 'switch',
            'title'             => esc_html__('Mega Menu', 'book-junky'),
            'default'           => false,
        ),
        array(
            'subtitle'          => esc_html__('Enable sticky mode for menu.', 'book-junky'),
            'id'                => 'menu_sticky',
            'type'              => 'switch',
            'title'             => esc_html__('Sticky Header', 'book-junky'),
            'default'           => false,
        ),
    )
));

/* Header 1 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header 1', 'book-junky'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Logo Type', 'book-junky'),
            'subtitle'          => esc_html__('Image / Text.', 'book-junky'),
            'id'                => 'logo_type',
            'type'              => 'button_set',
            'options'           => array(
                1 => esc_html__('Image', 'book-junky'),
                0 => esc_html__('Text', 'book-junky')
            ),
            'default'           => 1,
        ),
        array(
            'title'             => esc_html__('Select Logo', 'book-junky'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'book-junky'),
            'id'                => 'main_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
            'required'          => array( 'logo_type', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'book-junky'),
            'id'                => 'logo_max_height',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Height', 'book-junky'),
            'required'          => array( 'logo_type', '=', 1 ),

        ),
        array(
            'subtitle'          => esc_html__('Add custom logo text.', 'book-junky'),
            'id'                => 'logo_text',
            'type'              => 'text',
            'title'             => esc_html__('Logo Text', 'book-junky'),
            'required'          => array( 'logo_type', '=', 0 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom sologan Text.', 'book-junky'),
            'id'                => 'logo_text_sologan',
            'type'              => 'text',
            'title'             => esc_html__('Sologan Text', 'book-junky'),
            'required'          => array( 'logo_type', '=', 0 )
        ),
    )
));

/* Header 2 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header 2', 'book-junky'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Logo Type', 'book-junky'),
            'subtitle'          => esc_html__('Image / Text.', 'book-junky'),
            'id'                => 'logo_type_2',
            'type'              => 'button_set',
            'options'           => array(
                1 => esc_html__('Image', 'book-junky'),
                0 => esc_html__('Text', 'book-junky')
            ),
            'default'           => 1,
        ),
        array(
            'title'             => esc_html__('Select Logo', 'book-junky'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'book-junky'),
            'id'                => 'main_logo_2',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            ),
            'required'          => array( 'logo_type_2', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'book-junky'),
            'id'                => 'logo_max_height_2',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Height', 'book-junky'),
            'required'          => array( 'logo_type_2', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom logo text.', 'book-junky'),
            'id'                => 'logo_text_2',
            'type'              => 'text',
            'title'             => esc_html__('Logo Text', 'book-junky'),
            'required'          => array( 'logo_type_2', '=', 0 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom sologan Text.', 'book-junky'),
            'id'                => 'logo_text_sologan_2',
            'type'              => 'text',
            'title'             => esc_html__('Sologan Text', 'book-junky'),
            'required'          => array( 'logo_type_2', '=', 0 )
        ),
    )
));

/* Header 3 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header 3', 'book-junky'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(

        array(
            'id'                => 'en_header_top',
            'type'              => 'switch',
            'title'             => esc_html__('Header Top', 'book-junky'),
            'default'           => true,
        ),

        array(
            'id' => 'custom-header-left',
            'type' => 'textarea',
            'title' => esc_html__('Add hyper link on header top', 'book-junky'),
            'required'          => array( 'en_header_top', '=', 1 ),
        ),
        array(
            'title'             => esc_html__('Logo Type', 'book-junky'),
            'subtitle'          => esc_html__('Image / Text.', 'book-junky'),
            'id'                => 'logo_type_3',
            'type'              => 'button_set',
            'options'           => array(
                1 => esc_html__('Image', 'book-junky'),
                0 => esc_html__('Text', 'book-junky')
            ),
            'default'           => 1,
        ),
        array(
            'title'             => esc_html__('Select Logo', 'book-junky'),
            'subtitle'          => esc_html__('Select an image file for your logo.', 'book-junky'),
            'id'                => 'main_logo_3',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-2.png'
            ),
            'required'          => array( 'logo_type_3', '=', 1 )
        ),
        array(
            'subtitle'          => esc_html__('Set max height for logo.', 'book-junky'),
            'id'                => 'logo_max_height_3',
            'type'              => 'dimensions',
            'units'             => array('px'),
            'width'             => false,
            'title'             => esc_html__('Logo Height', 'book-junky'),
            'required'          => array( 'logo_type_3', '=', 1 ),
        ),
        array(
            'subtitle'          => esc_html__('Add custom logo text.', 'book-junky'),
            'id'                => 'logo_text_3',
            'type'              => 'text',
            'title'             => esc_html__('Logo Text', 'book-junky'),
            'required'          => array( 'logo_type_3', '=', 0 )
        ),
        array(
            'subtitle'          => esc_html__('Add custom sologan Text.', 'book-junky'),
            'id'                => 'logo_text_sologan_3',
            'type'              => 'text',
            'title'             => esc_html__('Sologan Text', 'book-junky'),
            'required'          => array( 'logo_type_3', '=', 0 )
        ),
    )
));

/**
 * Page Title
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title & BC', 'book-junky'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id'                => 'page_title_layout',
            'title'             => esc_html__('Layouts', 'book-junky'),
            'subtitle'          => esc_html__('select a layout for page title', 'book-junky'),
            'default'           => '2',
            'type'              => 'image_select',
            'options'           => array(
                                    '1' => get_template_directory_uri().'/assets/images/page-title-2.jpg',
                                    '2' => get_template_directory_uri().'/assets/images/page-title-1.jpg',
                                    '4' => get_template_directory_uri().'/assets/images/page-title-3.jpg',
                                    '5' => get_template_directory_uri().'/assets/images/page-title-4.jpg',
                                )
        ),
        array(
            'id'       => 'select_product',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Product', 'book-junky' ),
            'options'  =>  book_junky_get_product(),
            'required'  => array( 
                array( 'page_title_layout', '=', '4' ),
            )
        ),

        array(
            'id'       => 'select_product_2',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Product', 'book-junky' ),
            'options'  =>  book_junky_get_product(),
            'required'  => array( 
                array( 'page_title_layout', '=', '5' ),
            )
        ),

        array(
            'id'                => 'page_title_4_2',
            'type'              => 'text',
            'title'             => esc_html__('Page Title', 'book-junky'),
            'required'          => array( 'page_title_layout', '=', '5' ),
        ),

        array(
            'id'                => 'page_title_4',
            'type'              => 'text',
            'title'             => esc_html__('Page Title', 'book-junky'),
            'required'          => array( 'page_title_layout', '=', '4' ),
        ),

        array(
            'title'             => esc_html__('Background', 'book-junky'),
            'subtitle'          => esc_html__('Page title background.', 'book-junky'),
            'id'                => 'page_title_background',
            'type'              => 'background',
            'required'          => array( 'page_title_layout', '=', '2' )
        ),
        array(
            'title'             => esc_html__('Title Typography', 'book-junky'),
            'subtitle'          => esc_html__('Page title typography.', 'book-junky'),
            'id'                => 'page_title_typography',
            'type'              => 'typography',
            'google'            => true,
            'output'            => array( 'body .page-title h1' ),
            'required'          => array( 'page_title_layout', '=', '2' ),
        ),
        array(
            'title'             => esc_html__('Padding', 'book-junky'),
            'subtitle'          => esc_html__('Page title padding (top/bottom).', 'book-junky'),
            'id'                => 'page_title_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array( 'em', 'px', '%' ),
            'top'               => true,
            'right'             => false,
            'bottom'            => true,
            'left'              => false,
            'required'          => array( 'page_title_layout', '=', '2' ),
        ),
        array(
            'subtitle' => esc_html__('Enable custom sub title.', 'book-junky'),
            'id' => 'sub_title_en',
            'type' => 'switch',
            'title' => esc_html__('Custom Subtitle', 'book-junky'),
            'default' => false,
            'required' => array('page_title_layout', '=', '2'),
        ),
        array(
            'title'             => esc_html__('Sub Title Typography', 'book-junky'),
            'id'                => 'subtitle_typography',
            'type'              => 'typography',
            'google'            => true,
            'output'            => array( 'body .page-title p' ),
            'required'          => array( 'sub_title_en', '=', 1 ),
        ),
    )
));

/**
 * Content
 *
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'book-junky'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
    )
));

/* archive */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Archive', 'book-junky'),
    'icon' => 'el-icon-list',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'archive_layout',
            'title'             => esc_html__('Layouts', 'book-junky'),
            'subtitle'          => esc_html__('select a layout for archive, search, index...', 'book-junky'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'book-junky'),
            'id'                => 'archive_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'book-junky'),
            'id'                => 'archive_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'book-junky'),
            'default'           => true,
        ),
    )
));

/* Single */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single', 'book-junky'),
    'icon' => 'el-icon-file-edit',
    'subsection' => true,
    'fields' => array(
        array(
            'id'                => 'single_layout',
            'title'             => esc_html__('Layouts', 'book-junky'),
            'subtitle'          => esc_html__('select a layout for single...', 'book-junky'),
            'default'           => 'right',
            'type'              => 'image_select',
            'options'           => array(
                                        'left' => get_template_directory_uri().'/assets/images/content/right.png',
                                        'full' => get_template_directory_uri().'/assets/images/content/full.png',
                                        'right' => get_template_directory_uri().'/assets/images/content/left.png',
                                    )
        ),
        array(
            'subtitle'          => esc_html__('Show author.', 'book-junky'),
            'id'                => 'single_author',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show categories.', 'book-junky'),
            'id'                => 'single_categories',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'book-junky'),
            'id'                => 'single_tag',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'book-junky'),
            'id'                => 'single_comment_count',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show comment.', 'book-junky'),
            'id'                => 'single_comment',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'book-junky'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show date time.', 'book-junky'),
            'id'                => 'single_date',
            'type'              => 'switch',
            'title'             => esc_html__('Date', 'book-junky'),
            'default'           => true,
        )
    )
));

/*
woocommerce
*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Woocommerce', 'book-junky'),
    'icon' => 'el-icon-shopping-cart',
    'fields' => array(
        array(
            'title' => esc_html__('Number product', 'book-junky'),
            'id' => 'shop_number',
            'type' => 'slider',
            'subtitle' => esc_html__('Number product to show', 'book-junky'),
            'default' => 4,
            'min'  => 4,
            'step' => 2,
            'max' => 12,
        ),
        array(
            'title' => esc_html__('Number colums','book-junky'),
            'subtitle' => esc_html__('Choose number of columns in Shop Catalog page.','book-junky'),
            'id' => 'woo_columns_layout',
            'options' => array(
                6 => esc_html__('2 Columns','book-junky'),
                4 => esc_html__('3 Columns','book-junky'),
            ),
            'type' => 'select',
            'default' => '6',
        ),
        array(
            'id'                => 'phone_sp',
            'type'              => 'text',
            'title'             => esc_html__('Phone support checkout', 'book-junky'),
        ),
    )
));

/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'book-junky'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => esc_html__('Set color main color.', 'book-junky'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'book-junky'),
            'default' => '#7151ed',
        ),

        array(
            'subtitle' => esc_html__('Set color secondary color.', 'book-junky'),
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => esc_html__('Secondary Color', 'book-junky'),
            'default' => '#5f45eb',
        ),
        array(
            'id'       => 'link_color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Links Color', 'book-junky' ),
            'subtitle' => esc_html__( 'Select Links Color', 'book-junky' ),
            'regular'   => true,
            'hover'     => true,
            'active'    => false,
            'visited'   => false,
            'default'  => array(
                'regular'  => '#888a92',
                'hover'    => '#7151ed',
            )
        ),
    )
));

/**
 * Typography
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'book-junky'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h2'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h3'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h4'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h5'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h6'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky')
        )
    )
));

/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'google-font-selector-1');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'book-junky'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'book-junky'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  =>  $custom_font_1,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'book-junky'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'book-junky'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'book-junky'),
            'validate' => 'no_html',
            'default' => '',
        )
    )
));

/**
 * Footer
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'book-junky'),
    'icon' => 'el el-website',
    'fields' => array()
));

/* footer top. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top', 'book-junky'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(

        array(
            'title'             => esc_html__('Background', 'book-junky'),
            'subtitle'          => esc_html__('Footer top background.', 'book-junky'),
            'id'                => 'footer_top_background',
            'type'              => 'background',
        ),

        array(
            'title'             => esc_html__('Padding', 'book-junky'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'book-junky'),
            'id'                => 'footer_top_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
        ),
        array(
            'id'                => 'footer_top_title_color',
            'type'              => 'color',
            'title'             => esc_html__( 'Footer Top Title Color', 'book-junky' ),
        ),
        array(
            'id'                => 'footer_top_color',
            'type'              => 'color',
            'title'             => esc_html__( 'Footer Top Content Color', 'book-junky' ),
        ),

        array(
            'id'                => 'footer_top_link_color',
            'type'              => 'link_color',
            'regular'           => true,
            'hover'             => true,
            'active'            => false,
            'visited'           => false,
            'title'             => esc_html__( 'Footert Top Link Color', 'book-junky' ),
        ),

        array(
            'title'             => esc_html__('Select Footer Logo', 'book-junky'),
            'subtitle'          => esc_html__('Select an image file for your footer logo.', 'book-junky'),
            'id'                => 'footer_logo',
            'type'              => 'media',
            'url'               => false,
            'default'           => array(
                'url'=> get_template_directory_uri().'/assets/images/footer-logo.png'
            ),
        ),

        array(
            'id' => 'about_us',
            'type' => 'textarea',
            'title' => esc_html__('About us', 'book-junky'),
            'subtitle' => esc_html__('Tap about for site', 'book-junky'),
        ),
        array(
            'id' => 'social_footer',
            'type' => 'switch',
            'title' => esc_html__('Social Footer Top', 'book-junky'),
            'default' => true,
        ),

        array(
            'id' => 'footer_facebook_url',
            'type' => 'text',
            'title' => esc_html__('Facebook URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_twitter_url',
            'type' => 'text',
            'title' => esc_html__('Twitter URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_linkedin_url',
            'type' => 'text',
            'title' => esc_html__('Linkedin URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_instagram_url',
            'type' => 'text',
            'title' => esc_html__('Instagram URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_google_url',
            'type' => 'text',
            'title' => esc_html__('Google URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_skype_url',
            'type' => 'text',
            'title' => esc_html__('Skype URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_pinterest_url',
            'type' => 'text',
            'title' => esc_html__('Pinterest URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_youtube_url',
            'type' => 'text',
            'title' => esc_html__('Youtube URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),
        array(
            'id' => 'footer_tumblr_url',
            'type' => 'text',
            'title' => esc_html__('Tumblr URL', 'book-junky'),
            'required' => array('social_footer','=',1),
        ),

        array(
            'id'       => 'footer-top-column',
            'type'     => 'select',
            'title'    => esc_html__( 'Column', 'book-junky' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'book-junky' ),
            'default'    => 4,
            'options'  => array(
                2 => esc_html__('2', 'book-junky' ),
                3 => esc_html__('3', 'book-junky' ),
                4 => esc_html__('4', 'book-junky' ),
            )
        )
    )
));

/* footer bottom. */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Bottom', 'book-junky'),
    'icon' => 'el el-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'title'             => esc_html__('Background', 'book-junky'),
            'subtitle'          => esc_html__('Footer top background.', 'book-junky'),
            'id'                => 'footer_bottom_background',
            'type'              => 'background',
        ),
        array(
            'title'             => esc_html__('Padding', 'book-junky'),
            'subtitle'          => esc_html__('Footer top padding (top/bottom).', 'book-junky'),
            'id'                => 'footer_bottom_padding',
            'type'              => 'spacing',
            'mode'              => 'padding',
            'units'             => array('px'),
            'right'             => false,
            'left'              => false,
        ),
        array(
            'id' => 'copyright',
            'type' => 'textarea',
            'title' => esc_html__('Copyright', 'book-junky'),
            'subtitle' => esc_html__('Tap copyright text for site', 'book-junky'),
        ),

        array(
            'id'                => 'footer_bottom_color',
            'type'              => 'color',
            'title'             => esc_html__( 'Text Color', 'book-junky' ),
        ),

        array(
            'id'                => 'footer_button_link_color',
            'type'              => 'link_color',
            'regular'           => true,
            'hover'             => true,
            'active'            => false,
            'visited'           => false,
            'title'             => esc_html__( 'Link Color', 'book-junky' ),
        ),
    )
));

/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'book-junky'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'book-junky'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'book-junky'),
            'default' => false
        )
    )
));