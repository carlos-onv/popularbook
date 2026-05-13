<?php
	$subscribe_layout = 'subscribe-1';
	if (!empty($atts['subscribe_layout'])) {
		$subscribe_layout = $atts['subscribe_layout'];
	}

	$title = !empty($atts['sub_title']) ? $atts['sub_title'] : 'Sign Up';
	$description = !empty($atts['sub_description']) ? $atts['sub_description'] : 'Description';
	$color_title = !empty($atts['color_title']) ? $atts['color_title'] : '';
	$color_des = !empty($atts['color_des']) ? $atts['color_des'] : '';
	$id_mail_chimp = !empty($atts['id_mail_chimp']) ? $atts['id_mail_chimp'] : '153';

	switch ($subscribe_layout) {
		case 'subscribe-1':
		?>

			<div class="wrap-subscribe-1" id="<?php echo esc_attr($atts['html_id']);?>">

				<h4 style="color: <?php echo esc_attr($color_title); ?>"><?php echo esc_html($title); ?></h4>

				<p style="color: <?php echo esc_attr($color_des); ?>"><?php echo esc_html($description); ?></p>

				<?php echo apply_filters('the_content','[mc4wp_form id=" ' . $id_mail_chimp . '"]'); ?>
			</div>
		<?php break;
		
		case 'subscribe-2':
		?>

			<div class="wrap-subscribe-2 row" id="<?php echo esc_attr($atts['html_id']);?>">
				<div class="col-xs-12 col-md-6 sub-left">

					<h5 style="color: <?php echo esc_attr($color_title); ?>"><?php echo esc_html($title); ?></h5>

					<p style="color: <?php echo esc_attr($color_des); ?>"><?php echo esc_html($description); ?></p>
				</div>

				<div class="col-xs-12 col-md-6 sub-right">

					<?php echo apply_filters('the_content','[mc4wp_form id=" ' . $id_mail_chimp . ' "]'); ?>
				</div>
				<?php if (!empty($atts['facebook_url']) || !empty($atts['twitter_url']) || !empty($atts['linkedin_url']) || !empty($atts['instagram_url']) || !empty($atts['google_url']) || !empty($atts['pinterest_url']) ) : ?>

		            <div class="col-xs-12 text-center social">

			            <ul>

			                <?php if (!empty($atts['facebook_url'])) { ?>

			                    <li><a href="<?php echo esc_url($atts['facebook_url']); ?>"><i
			                                    class="zmdi zmdi-facebook"></i></a></li>
			                <?php } ?>

			                <?php if (!empty($atts['instagram_url'])) { ?>

			                    <li><a href="<?php echo esc_url($atts['instagram_url']); ?>"><i
			                                    class="zmdi zmdi-instagram"></i></a></li>
			                <?php } ?>

			                <?php if (!empty($atts['twitter_url'])) { ?>
			                    <li><a href="<?php echo esc_url($atts['twitter_url']); ?>"><i
			                                    class="zmdi zmdi-twitter"></i></a></li>
			                <?php } ?>
			                <?php if (!empty($atts['linkedin_url'])) { ?>
			                    <li><a href="<?php echo esc_url($atts['linkedin_url']); ?>"><i
			                                    class="zmdi zmdi-linkedin"></i></a></li>
			                <?php } ?>
			                <?php if (!empty($atts['google_url'])) { ?>
			                    <li><a href="<?php echo esc_url($atts['google_url']); ?>"><i
			                                    class="zmdi zmdi-google"></i></a></li>
			                <?php } ?>
			                <?php if (!empty($atts['pinterest_url'])) { ?>
			                    <li><a href="<?php echo esc_url($atts['pinterest_url']); ?>"><i
			                                    class="zmdi zmdi-pinterest"></i></a></li>
			                <?php } ?>
			            </ul>
		            </div>
	        	<?php endif; ?>
			</div>
		<?php break;
	}