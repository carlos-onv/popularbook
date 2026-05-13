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

add_action('admin_init', 'book_junky_meta_teams');

MetaFramework::init();

function book_junky_meta_teams()
{

    /** page options */
    MetaFramework::setMetabox(array(
        'id' => '_page_team_options',
        'label' => esc_html__('Meta Option', 'book-junky'),
        'post_type' => 'teams',
        'context' => 'advanced',
        'priority' => 'default',
        'open_expanded' => false,
        'sections' => array(
            array(
                'title' => esc_html__('Info Member', 'book-junky'),
                'fields' => array(
                    array(
			            'id'                => 'position',
			            'type'              => 'text',
			            'title'             => esc_html__( 'Position Member', 'book-junky' ),
			        ),

			        array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook URL', 'book-junky'),
                    ),
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter URL', 'book-junky'),
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => esc_html__('Linkedin URL', 'book-junky'),
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram URL', 'book-junky'),
                    ),
                    array(
                        'id' => 'google_url',
                        'type' => 'text',
                        'title' => esc_html__('Google URL', 'book-junky'),
                    ),
                )
            ),
        )
    ));
}