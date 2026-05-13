<?php

    $link_button = $color_text = $color_text_hover = $color_border = $color_border_hover = $color_btn = $color_btn_hover = $btn_radius = $dis_inline = $class = $color_bs = $max_width_button = $custom_bs = $custom_co = $color_gradient_1 = $color_gradient_2 = $spa_right = '';

    $cms_id = $atts['html_id'];
    $align = 'left';
    $custom_co = 'co_no';
    $icon = !empty($atts['icon_button']) ? $atts['icon_button'] : '';

    if (!empty($icon)) {
        $icon_class = 'zmdi '. $icon;
    }

    if(!empty($atts['align_button']) ){
        $align = $atts['align_button'];
    }

    if(!empty($atts['custom_color']) ){
        $custom_co = $atts['custom_color'];
    }

    $a_href = $a_title = $a_target = '';
	$link = vc_build_link( $atts['link_button'] );
	if ( strlen( $link['url'] ) > 0 ) {
	    $a_href = $link['url'];
	    $a_title = (!empty($link['title'])) ? $link['title'] : esc_html__('READ MORE', 'book-junky');
	    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
	}

    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    if($dis_inline == 'true') {
        $class = 'inline';
    };

    if($spa_right == 'true') {
        $class .= ' spa-right';
    };

    $styles_hover = $onmouseout = '';
    $btn_hover = $border_hover = $text_hover = '';

    if(!empty($color_btn_hover) || !empty($color_text_hover) || !empty($color_border_hover) ) {
        $styles[] = 'transition: all 0.5s ease 0s ;';
        
        if(!empty($color_btn_hover)) {
            $btn_hover = "this.style.background='".$color_btn_hover."';";
        }

        if(!empty($color_border_hover)) {
            $border_hover = "this.style.borderColor='".$color_border_hover."';";
        }
        
        if(!empty($color_text_hover)) {
            $text_hover = "this.style.color='".$color_text_hover."';";
        }
        
        $styles_hover = 'onmouseover="'.$btn_hover. '' . $text_hover . ''.$border_hover.'"';
    }

    if(!empty($color_btn) && $custom_co == 'co_no' ) {
        $styles[] = 'background: '.$color_btn.';';
    }

    if( !empty($color_gradient_1) && !empty($color_gradient_2) && $custom_co == 'co_gra' ) {
        $styles[] = 'background-color: '. $color_gradient_1 .';';
        $styles[] = 'background-image: -webkit-linear-gradient( '. $color_gradient_1 .' , ' . $color_gradient_2. ') ;';
        $styles[] = 'background-image: linear-gradient( '. $color_gradient_1 .' , ' . $color_gradient_2. ') ;';
    }

    if(!empty($color_text)) {
        $styles[] = 'color: '.$color_text.';';
    }

    if(!empty($color_border)) {
        $styles[] = 'border: 1px solid '.$color_border.';';
    }

    if(!empty($color_bs) && $custom_bs == 'en-ct') {
        $styles[] = 'box-shadow: 0 5px 15px '.$color_bs.';';
    }

    if(!empty($btn_radius)) {
        $styles[] = 'border-radius:'.$btn_radius.';';
    }

    if(!empty($max_width_button)) {
        $styles[] = 'width:'.$max_width_button.';';
    }

    if ( !empty($styles) ) {
        $attributess = implode( ' ', $styles );
    }


    $btn = $text = $border = $ga = '';
    if( !empty($color_btn) ||  !empty($color_text) ) {
        
        if( !empty($color_btn) && $custom_co == 'co_no' ) {
            $btn = "this.style.background='".$color_btn."';";
        }

        if( !empty($color_gradient_1) && !empty($color_gradient_2) && $custom_co == 'co_gra' ) {
            $btn = "this.style.backgroundColor='".$color_gradient_1."';";
            $ga = "this.style.backgroundImage='linear-gradient( ". $color_gradient_1 ." , " . $color_gradient_2. " )';";
        }
        
        if( !empty($color_text)) {
            $text = "this.style.color='".$color_text."';";
        }

        if( !empty($color_border)) {
            $border = "this.style.borderColor='".$color_border."';";
        }

        $onmouseout = 'onmouseout="'.$text.''.$btn.''.$border.''.$ga.'"';
    }

if(!empty($a_title)) {
?>
<div class="cms-button-wrapper text-<?php echo esc_html($align); ?> <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($cms_id); ?>">

    <a class="text-center" target="<?php echo esc_attr($a_target);?>" href="<?php echo esc_url($a_href);?>" 
    style="<?php echo esc_attr($attributess); ?>" <?php echo $onmouseout . ' '. $styles_hover; ?>>
        <?php echo esc_attr($a_title); ?><?php if( !empty($icon_class)) : echo "<i class='" . $icon_class . "'></i>"; endif;?>
    </a>
</div>
<?php } ?>