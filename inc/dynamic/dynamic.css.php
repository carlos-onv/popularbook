<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {

        wp_enqueue_style('custom-dynamic',get_template_directory_uri() . '/assets/css/custom-dynamic.css');

        $_dynamic_css = $this->css_render();

        wp_add_inline_style('custom-dynamic', $_dynamic_css);
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options,$opt_meta_options;

        ob_start();

        /* Theme Options. */

        /* Background boxed */
        if( ($opt_theme_options['en_boxed'] == 1 ) && ($opt_theme_options['bg_boxed_type'] == 1) && ( !empty($opt_theme_options['boxed_background']['background-color']) || !empty($opt_theme_options['boxed_background']['background-image']) ) ) {

            $color = (!empty($opt_theme_options['boxed_background']['background-color'])) ? $opt_theme_options['boxed_background']['background-color'] : '#7e5bef';
            $image = (!empty($opt_theme_options['boxed_background']['background-image'])) ? $opt_theme_options['boxed_background']['background-image'] : '';
            $repeat = (!empty($opt_theme_options['boxed_background']['background-repeat'])) ? $opt_theme_options['boxed_background']['background-repeat'] : 'no-repeat';
            $position = (!empty($opt_theme_options['boxed_background']['background-position'])) ? $opt_theme_options['boxed_background']['background-position'] : 'center top';
            $size = (!empty($opt_theme_options['boxed_background']['background-size'])) ? $opt_theme_options['boxed_background']['background-size'] : 'cover';
            $attachment = (!empty($opt_theme_options['boxed_background']['background-attachment'])) ? $opt_theme_options['boxed_background']['background-attachment'] : 'fixed';
            echo '
                @media screen and (min-width: 1400px) {
                    .body-boxed {
                        background-color:'.esc_attr($color).';
                        background-image:url("'.esc_attr($image).'");
                        background-repeat:'.esc_attr($repeat).';
                        background-position:'.esc_attr($position).';
                        background-size:'.esc_attr($size).';
                        background-attachment:'.esc_attr($attachment).';
                    }
                }
            ';
        }

        /* Background gradient boxed */

        if( ($opt_theme_options['en_boxed'] == 1 ) && ($opt_theme_options['bg_boxed_type'] == 2) && !empty($opt_theme_options['boxed_background_1']) && !empty($opt_theme_options['boxed_background_2']) ) {

            $startColor = $opt_theme_options['boxed_background_1'];
            $endColor = $opt_theme_options['boxed_background_2'];
            echo '
                @media screen and (min-width: 1400px) {
                    .body-boxed {
                        background-color: '.$startColor.';
                        background-image: -webkit-linear-gradient( top, '.$startColor.', '.$endColor.' );
                        background-image: linear-gradient( top, '.$startColor.', '.$endColor.' );
                    }
                }
            ';
        }

        /* Background Content */

        if( ($opt_theme_options['en_boxed'] == 1 ) && ( !empty($opt_theme_options['boxed_content_background']['background-color']) || !empty($opt_theme_options['boxed_content_background']['background-image']) ) ) {

            $color = (!empty($opt_theme_options['boxed_content_background']['background-color'])) ? $opt_theme_options['boxed_content_background']['background-color'] : '#ffffff';
            $image = (!empty($opt_theme_options['boxed_content_background']['background-image'])) ? $opt_theme_options['boxed_content_background']['background-image'] : '';
            $repeat = (!empty($opt_theme_options['boxed_content_background']['background-repeat'])) ? $opt_theme_options['boxed_content_background']['background-repeat'] : 'no-repeat';
            $position = (!empty($opt_theme_options['boxed_content_background']['background-position'])) ? $opt_theme_options['boxed_content_background']['background-position'] : 'center top';
            $size = (!empty($opt_theme_options['boxed_content_background']['background-size'])) ? $opt_theme_options['boxed_content_background']['background-size'] : 'cover';
            $attachment = (!empty($opt_theme_options['boxed_content_background']['background-attachment'])) ? $opt_theme_options['boxed_content_background']['background-attachment'] : 'fixed';
            echo '
                @media screen and (min-width: 1400px) {
                    .body-boxed .wrap-boxed {
                        background-color:'.esc_attr($color).';
                        background-image:url("'.esc_attr($image).'");
                        background-repeat:'.esc_attr($repeat).';
                        background-position:'.esc_attr($position).';
                        background-size:'.esc_attr($size).';
                        background-attachment:'.esc_attr($attachment).';
                    }
                }
            ';
        }


        /* Padding content */

        if(isset($opt_theme_options['space_content']['padding-top']) ) {
            echo '.site-content{padding-top:'.esc_attr($opt_theme_options['space_content']['padding-top']).';}';
        }

        if(isset($opt_theme_options['space_content']['padding-bottom']) ) {
            echo '.site-content{padding-bottom:'.esc_attr($opt_theme_options['space_content']['padding-bottom']).';}';
        }

        /* Logo Height */

        if(!empty($opt_theme_options['logo_max_height_3']['height']) ) {
            echo '.header-3 .main-logo-3{max-height:'.esc_attr($opt_theme_options['logo_max_height_3']['height']).';}';
        }

        if(!empty($opt_theme_options['logo_max_height_2']['height']) ) {
            echo '.header-2 .main-logo-2{max-height:'.esc_attr($opt_theme_options['logo_max_height_2']['height']).';}';
        }

        if(!empty($opt_theme_options['logo_max_height']['height']) ) {
            echo '.header-1 .main-logo{max-height:'.esc_attr($opt_theme_options['logo_max_height']['height']).';}';
        }

        /* Background Footer Bottom */

        if( !empty($opt_theme_options['footer_bottom_background']['background-color']) || !empty($opt_theme_options['footer_bottom_background']['background-image']) ) {

            $color = (!empty($opt_theme_options['footer_bottom_background']['background-color'])) ? $opt_theme_options['footer_bottom_background']['background-color'] : '#383b3f';
            $image = (!empty($opt_theme_options['footer_bottom_background']['background-image'])) ? $opt_theme_options['footer_bottom_background']['background-image'] : '';
            $repeat = (!empty($opt_theme_options['footer_bottom_background']['background-repeat'])) ? $opt_theme_options['footer_bottom_background']['background-repeat'] : 'no-repeat';
            $position = (!empty($opt_theme_options['footer_bottom_background']['background-position'])) ? $opt_theme_options['footer_bottom_background']['background-position'] : 'center top';
            $size = (!empty($opt_theme_options['footer_bottom_background']['background-size'])) ? $opt_theme_options['footer_bottom_background']['background-size'] : 'cover';
            $attachment = (!empty($opt_theme_options['footer_bottom_background']['background-attachment'])) ? $opt_theme_options['footer_bottom_background']['background-attachment'] : 'fixed';
            echo '
                @media screen and (min-width: 992px) {
                    .site-footer #footer-bottom {
                        background-color:'.esc_attr($color).';
                        background-image:url("'.esc_attr($image).'");
                        background-repeat:'.esc_attr($repeat).';
                        background-position:'.esc_attr($position).';
                        background-size:'.esc_attr($size).';
                        background-attachment:'.esc_attr($attachment).';
                    }
                }
            ';
        }


        /*padding footer bottom*/
        if(!empty($opt_theme_options['footer_bottom_padding']['padding-top'])) {
            echo '@media screen and (min-width: 992px) {
                .site-footer #footer-bottom{padding-top:'.esc_attr($opt_theme_options['footer_bottom_padding']['padding-top']).';}
            }';
        }

        /*padding footer bottom*/
        if(!empty($opt_theme_options['footer_bottom_padding']['padding-bottom'])) {
            echo '@media screen and (min-width: 992px) {
                .site-footer #footer-bottom{padding-bottom:'.esc_attr($opt_theme_options['footer_bottom_padding']['padding-bottom']).';}
            }';
        }

        /*color footer bottom theme*/
        if(!empty($opt_theme_options['footer_bottom_color']) ) {
            echo '@media screen and (min-width: 992px) {.site-footer #footer-bottom p{color:'.esc_attr($opt_theme_options['footer_bottom_color']).';}}';
        }

        /*link color footer bottom theme*/
        if(!empty($opt_theme_options['footer_button_link_color']['regular']) ) {
            echo '@media screen and (min-width: 992px) {.site-footer #footer-bottom a{color:'.esc_attr($opt_theme_options['footer_button_link_color']['regular']).';}}';
        }

        /*link hover color footer bottom theme*/
        if(!empty($opt_theme_options['footer_button_link_color']['hover']) ) {
            echo '@media screen and (min-width: 992px) {.site-footer #footer-bottom a:hover{color:'.esc_attr($opt_theme_options['footer_button_link_color']['hover']).';}}';
        }

        /* Theme Option Footer Top */

        if( !empty($opt_theme_options['footer_top_background']['background-color']) || !empty($opt_theme_options['footer_top_background']['background-image']) ) {

            $color = (!empty($opt_theme_options['footer_top_background']['background-color'])) ? $opt_theme_options['footer_top_background']['background-color'] : '#383b3f';
            $image = (!empty($opt_theme_options['footer_top_background']['background-image'])) ? $opt_theme_options['footer_top_background']['background-image'] : '';
            $repeat = (!empty($opt_theme_options['footer_top_background']['background-repeat'])) ? $opt_theme_options['footer_top_background']['background-repeat'] : 'no-repeat';
            $position = (!empty($opt_theme_options['footer_top_background']['background-position'])) ? $opt_theme_options['footer_top_background']['background-position'] : 'center top';
            $size = (!empty($opt_theme_options['footer_top_background']['background-size'])) ? $opt_theme_options['footer_top_background']['background-size'] : 'cover';
            $attachment = (!empty($opt_theme_options['footer_top_background']['background-attachment'])) ? $opt_theme_options['footer_top_background']['background-attachment'] : 'fixed';
            echo '.site-footer #footer-top {
                    background-color:'.esc_attr($color).';
                    background-image:url("'.esc_attr($image).'");
                    background-repeat:'.esc_attr($repeat).';
                    background-position:'.esc_attr($position).';
                    background-size:'.esc_attr($size).';
                    background-attachment:'.esc_attr($attachment).';
                }
            ';
        }

        /*padding footer top*/
        if(!empty($opt_theme_options['footer_top_padding']['padding-top'])) {
            echo '@media screen and (min-width: 992px) {.site-footer #footer-top{padding-top:'.esc_attr($opt_theme_options['footer_top_padding']['padding-top']).';}}';
        }

        /*padding footer top*/
        if(!empty($opt_theme_options['footer_top_padding']['padding-bottom'])) {
            echo '@media screen and (min-width: 992px) {.site-footer #footer-top{padding-bottom:'.esc_attr($opt_theme_options['footer_top_padding']['padding-bottom']).';}}';
        }

        /*footer top title color*/
        if(!empty($opt_theme_options['footer_top_title_color'])) {
            echo '.site-footer #footer-top .wg-ft-title{
                color:'.esc_attr($opt_theme_options['footer_top_title_color']).';
            }';
        }

        /*footer top color*/
        if(!empty($opt_theme_options['footer_top_color'])) {
            echo '.site-footer .footer-about p,
            .site-footer .widget_custom_html li {
                color:'.esc_attr($opt_theme_options['footer_top_color']).';
            }';
        }

        /*footer top link color*/
        if(!empty($opt_theme_options['footer_top_link_color']['regular'])) {
            echo '
            .site-footer .widget_custom_html a,
            .site-footer #footer-top .footer-about i {
                color:'.esc_attr($opt_theme_options['footer_top_link_color']['regular']).';
            }';
        }

        /*footer top link color*/
        if(!empty($opt_theme_options['footer_top_link_color']['hover'])) {
            echo '
            .site-footer .widget_custom_html a:hover,
            .site-footer #footer-top .footer-about i:hover {
                color:'.esc_attr($opt_theme_options['footer_top_link_color']['hover']).';
            }';
        }

        /* Theme Option Background Page Title */

        if( !empty($opt_theme_options['page_title_background']['background-color']) || !empty($opt_theme_options['page_title_background']['background-image']) ) {

            $color = (!empty($opt_theme_options['page_title_background']['background-color'])) ? $opt_theme_options['page_title_background']['background-color'] : '#383b3f';
            $image = (!empty($opt_theme_options['page_title_background']['background-image'])) ? $opt_theme_options['page_title_background']['background-image'] : '';
            $repeat = (!empty($opt_theme_options['page_title_background']['background-repeat'])) ? $opt_theme_options['page_title_background']['background-repeat'] : 'no-repeat';
            $position = (!empty($opt_theme_options['page_title_background']['background-position'])) ? $opt_theme_options['page_title_background']['background-position'] : 'center top';
            $size = (!empty($opt_theme_options['page_title_background']['background-size'])) ? $opt_theme_options['page_title_background']['background-size'] : 'cover';
            $attachment = (!empty($opt_theme_options['page_title_background']['background-attachment'])) ? $opt_theme_options['page_title_background']['background-attachment'] : 'fixed';
            echo '.page-title {
                    background-color:'.esc_attr($color).';
                    background-image:url("'.esc_attr($image).'");
                    background-repeat:'.esc_attr($repeat).';
                    background-position:'.esc_attr($position).';
                    background-size:'.esc_attr($size).';
                    background-attachment:'.esc_attr($attachment).';
                }
            ';
        }

        /*padding page title top*/
        if(!empty($opt_theme_options['page_title_padding']['padding-top'])) {
            echo '@media screen and (min-width: 992px) {
                #page-title-1.page-title,
                #page-title-2.page-title {
                    padding-top:'.esc_attr($opt_theme_options['page_title_padding']['padding-top']).';
                }
            }';
        }

        /*padding page title bottom*/
        if(!empty($opt_theme_options['page_title_padding']['padding-bottom'])) {
            echo '@media screen and (min-width: 992px) {
                #page-title-1.page-title,
                #page-title-2.page-title {
                    padding-bottom:'.esc_attr($opt_theme_options['page_title_padding']['padding-bottom']).';
                }
            }';
        }

        /* Meta Options. */



        /*padding content*/
        if(isset($opt_meta_options['space_content']['padding-top']) && (is_page()) ) {
            echo '.site-content{padding-top:'.esc_attr($opt_meta_options['space_content']['padding-top']).';}';
        }

        /*padding content*/
        if( isset($opt_meta_options['space_content']['padding-bottom']) && (is_page()) ) {
            echo '.site-content{padding-bottom:'.esc_attr($opt_meta_options['space_content']['padding-bottom']).';}';
        }
        
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();