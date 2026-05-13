<?php
	$fancybox_layout = 'fancybox-1';
	if (!empty($atts['fancybox_style'])) {
		$fancybox_layout = $atts['fancybox_style'];
	}

	switch ($fancybox_layout) {
		case 'fancybox-1':
			$title = !empty($atts['title_item']) ? $atts['title_item'] : 'Title';
			$content = !empty($atts['description_item']) ? $atts['description_item'] : 'Content';
			$color_title = !empty($atts['color_title']) ? $atts['color_title'] : '';
			$color_content = !empty($atts['color_content']) ? $atts['color_content'] : '';

			?>
				<div class="fancy-box-1" id="<?php echo esc_attr($atts['html_id']);?>">
					<h5 style="color:<?php echo esc_attr($color_title); ?>"><?php echo esc_html($title); ?></h5>
					<p style="color:<?php echo esc_attr($color_content); ?>"><?php echo esc_html($content); ?></p>
				</div>
			<?php break;

		case 'fancybox-2':
			$icon_name = "icon_" . $atts['icon_type'];
			$iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';

			$title = !empty($atts['title_item']) ? $atts['title_item'] : 'Title';
			$bg_color_icon = !empty($atts['bg_color_icon']) ? $atts['bg_color_icon'] : '';
			$color_title = !empty($atts['color_title']) ? $atts['color_title'] : '';
			$color_content = !empty($atts['color_content']) ? $atts['color_content'] : '';

			$content_opts = (array) vc_param_group_parse_atts($atts['content_opts']);

			if(!empty($atts['type_element'])) {
				$type_element = $atts['type_element'];
			} else {
				$type_element = 'text_field';
			}

			?>
				<div class="fancy-box-2 clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
					<?php if(!empty($iconClass)): ?>
						<div class="wrap-left">
							<i style="background-color:<?php echo esc_attr($bg_color_icon); ?>" class="<?php echo esc_attr($iconClass); ?>"></i>
						</div>
					<?php endif; ?>
					<div class="wrap-right">
						<h3 class="h5" style="color:<?php echo esc_attr($color_title); ?>"><?php echo esc_html($title); ?></h3>
							
							<?php foreach ($content_opts as $key => $value) { ?>
								<?php switch ($type_element) {
									case 'text_field':

										echo '<p style="color:' . $color_content . '" class="text_field">'.$value['content_opt'] .'</p>';
										break;
									case 'phone':

										echo '<div style="color:' . $color_content . '" class="phone">' . $value['title_opt'] . ': <a href="tel:' . $value['content_opt'] . '" >' . $value['content_opt'] . '</a></div>';
										break;
									case 'email':

										echo '<div style="color:' . $color_content . '" class="email">' . $value['title_opt'] . ': <a href="mailto:' . $value['content_opt'] . '" >' . $value['content_opt'] . '</a></div>';
										break;
									default:
										# code...
										break;
								} ?>
							
								
							<?php } ?>
					</div>
				</div>
			<?php break;
		case 'fancybox-3':

			$color_border = !empty($atts['color_border']) ? $atts['color_border'] : '#7e5bef';
			$a_href = $a_title = $a_target = '';
			$link = vc_build_link( $atts['link_fancy'] );
			if ( strlen( $link['url'] ) > 0 ) {
			    $a_href = $link['url'];
			    $a_title = (!empty($link['title'])) ? $link['title'] : esc_html__('READ MORE', 'book-junky');
			    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}

			$css = !empty($atts['design_css']) ? $atts['design_css'] : '';
			$class = vc_shortcode_custom_css_class( $css );

			extract(shortcode_atts(array(
			    'css' => ''
			), $atts));
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

			$select_image = $atts['fancy_image'];
			$attachment_image = wp_get_attachment_image_src($select_image, 'full');
			$image_url = $attachment_image[0];

			?>
			<div class="fancy-box-3 <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($atts['html_id']);?>">
				<div class="wrap-content" style="border: 5px solid <?php echo esc_attr($color_border); ?>;">
					<?php if ( !empty($a_href) ): ?>
						<a href="<?php echo esc_url($a_href); ?>" target="<?php echo esc_attr($a_target); ?>" >
					<?php endif ?>
						<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($a_title); ?>">
					<?php if ( !empty($a_href) ): ?>
						</a>
					<?php endif ?>
				</div>
			</div>
		<?php break;

		case 'fancybox-4':
			if ( !empty($atts['title_item']) ) {

				$type_icon = '';
				if ( !empty($atts['type_icon']) ) {
					$type_icon = $atts['type_icon'];
				}

				$class = '';
				if (!empty($atts['spa_right']) ) {
					
					if($atts['spa_right'] == true ) {
						$class = 'spa-right';
					}
				}

				$iconClass = isset($atts['icon_material-design-2']) ? $atts['icon_material-design-2'] : 'zmdi zmdi-star';

				$color_icon = !empty($atts['color_ic_fancy_box']) ? $atts['color_ic_fancy_box'] : '#7e5bef';
				$color_content = !empty($atts['color_fancy_box']) ? $atts['color_fancy_box'] : '#888a92';
				$bg_fancy_box = !empty($atts['bg_fancy_box']) ? $atts['bg_fancy_box'] : '#fff';

				?>
				<div class="fancy-box-4 <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($atts['html_id']);?>">

					<div class="wrap-content" style="background-color: <?php echo esc_attr($bg_fancy_box); ?>">
						<?php if ($type_icon == 'icon_left' || $type_icon == 'both_sides' ) : ?>

							<i style="color: <?php echo esc_attr($color_icon); ?>" class="<?php echo esc_attr($iconClass); ?>"></i>
						<?php endif; ?>

						<span style="color: <?php echo esc_attr($color_content); ?>">

							<?php echo esc_attr($atts['title_item']); ?>
						</span>

						<?php if ($type_icon == 'icon_right' || $type_icon == 'both_sides' ) : ?>
							<i style="color: <?php echo esc_attr($color_icon); ?>" class="<?php echo esc_attr($iconClass); ?>"></i>
						<?php endif; ?>
					</div>
				</div>
			<?php }
		break;

		default:
			echo "Kennji";
			break;
	}

?>