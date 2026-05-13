<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $el_id
 * @var $css
 * @var $css_animation
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $link = $google_fonts = $font_container = $el_id = $el_class = $css = $css_animation = $font_container_data = $google_fonts_data = $heading_layout = $css_classes = $link_heading = '';
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/**
 * @var $css_class
 */
extract( $this->getStyles( $el_class . $this->getCSSAnimation( $css_animation ), $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if( isset($heading_layout) ) {
    $css_classes .= ' '. $heading_layout;
}

if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	//wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
	$style = '';
}
		
$output = '';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

switch ($heading_layout) {
	case 'heading-1':
		if ( 'post_title' === $source ) {
			$text = get_the_title( get_the_ID() );
		}

		if ( ! empty( $link ) ) {
			$link = vc_build_link( $link );
			$text = '<a href="' . esc_attr( $link['url'] ) . '"' . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . '>' . $text . '</a>';
		}
		if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
			$output .= '<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
			$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
			$output .= $text;
			$output .= '</' . $font_container_data['values']['tag'] . '>';
			$output .= '</div>';
		} else {
			$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
			$output .= $text;
			$output .= '</' . $font_container_data['values']['tag'] . '>';
		}
	break;

	case 'heading-2' :
		if ( ! empty( $link_heading ) ) {
			$a_href = $a_title = $a_target = '';
			$link = vc_build_link( $link_heading );

			if ( strlen( $link['url'] ) > 0 ) {
			    $a_href = $link['url'];
			    $a_title = (!empty($link['title'])) ? $link['title'] : esc_html__('Link', 'book-junky');
			    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}
		}

		$output .= '<div class="heading-2">';
		$output .= '<div class="wrap-heading">';
		$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="heading">';
		$output .= $text;
		$output .= '</' . $font_container_data['values']['tag'] . '>';
		$output .= '</div>';
		if( ! empty( $a_href )) :
			$output .= '<div class="wrap-link"><a href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '<i class="zmdi zmdi-chevron-right"></i></a></div>';
		endif;
		$output .= '</div>';
	break;

	case 'heading-3' :
		if ( ! empty( $link_heading ) ) {
			$a_href = $a_title = $a_target = '';
			$link = vc_build_link( $link_heading );

			if ( strlen( $link['url'] ) > 0 ) {
			    $a_href = $link['url'];
			    $a_title = (!empty($link['title'])) ? $link['title'] : esc_html__('Link', 'book-junky');
			    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}
		}

		$output .= '<div class="heading-3 clearfix">';
		$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="heading">';
		$output .= $text;
		$output .= '</' . $font_container_data['values']['tag'] . '>';
		if( ! empty( $a_href )) :
			$output .= '<div class="wrap-link"><a href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '<i class="zmdi zmdi-chevron-right"></i></a></div>';
		endif;
		$output .= '</div>';
	break;
}

echo $output;
