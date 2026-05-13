<?php
$style = "post-1";
if (!empty($atts['post_layout'])) {
    $style = $atts['post_layout'];
}

$post_id = !empty( $atts['select_post'] ) ? $atts['select_post'] : '';
?>
<div class="post-single" id="<?php echo esc_attr($atts['html_id']); ?>">
<?php
switch ($style) {
	case 'post-1':
		?>
		<div class="blog-grid">
		<div class="wrap-layout-1">
			<div class="wrap-thumbnail">
				<a href="<?php echo esc_url(get_permalink($post_id) ); ?>">
					<?php if (has_post_thumbnail( $post_id )): ?>

						<?php echo get_the_post_thumbnail($post_id, 'large'); ?>
					<?php else : 
						echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';

						?>
					<?php endif ?>
				</a>
			</div>
			
			<div class="wrap-content">

				<h3 class="entry-title"><a href="<?php echo esc_url(get_permalink($post_id) ); ?>"><?php echo get_the_title($post_id); ?></a></h3>

				<div class="detail-date">

		            <?php
			            echo get_the_date('j');
			            echo '<span>' . get_the_date('S') . '</span>';
			            echo get_the_date(' F');
			            echo get_the_date(' Y');
		            ?>
		        </div>
			</div>

			<footer class="entry-footer">

				<a href="<?php echo esc_url(get_permalink($post_id) ); ?>"><?php esc_html_e('Read more', 'book-junky') ?></a>

				<?php
					$output = get_post_meta($post_id, '_nectar_love', true);
					$count = "<span class='nectar-love-count'>" . $output . "</span>";
					$icon = 'zmdi zmdi-favorite-outline';
			  		$title = esc_html__('Love this', 'book-junky');
					if( isset($_COOKIE['nectar_love_'. $post_id]) ){
						$class = 'nectar-love loved';
						$icon = 'zmdi zmdi-favorite';
						$title = esc_html__('You already love this!', 'book-junky');
					}
					$heart_icon = '<i class="'.$icon.'"></i>';

			  		echo '<a href="#" class="nectar-love" id="nectar-love-'. $post_id .'" title="'. $title .'"> '.$heart_icon . $count . '</a>'
				?>
			</footer><!-- .entry-footer -->
		</div>
		</div>
	<?php break;
	
	default: 
	?>
	<div class="blog-default">
		<div class="wrap-content clearfix">
		<div class="wrap-left">
			<a href="<?php echo esc_url(get_permalink($post_id) ); ?>">
				<?php if (has_post_thumbnail( $post_id )): ?>

					<?php echo get_the_post_thumbnail($post_id, 'medium'); ?>
				<?php else : 
					echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';

					?>
				<?php endif ?>
			</a>
		</div>

		<div class="wrap-right">

			<h3 class="entry-title"><a href="<?php echo esc_url(get_permalink($post_id) ); ?>"><?php echo get_the_title($post_id); ?></a></h3>

			<div class="detail-date">

	            <?php
	            echo get_the_date('j');
	            echo '<span>' . get_the_date('S') . '</span>';
	            echo get_the_date(' F');
	            echo get_the_date(' Y');
	            ?>
	        </div>
			
			<p><?php echo wp_trim_words( get_the_excerpt( $post_id ), '25', ''); ?></p>

			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'book-junky' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>

			<footer class="entry-footer">
				<a href="<?php the_permalink( $post_id ); ?>"><?php esc_html_e('Read more', 'book-junky') ?></a>
				<?php
					$output = get_post_meta($post_id, '_nectar_love', true);
					$count = "<span class='nectar-love-count'>" . $output . "</span>";
					$icon = 'zmdi zmdi-favorite-outline';
			  		$title = esc_html__('Love this', 'book-junky');
					if( isset($_COOKIE['nectar_love_'. $post_id]) ){
						$class = 'nectar-love loved';
						$icon = 'zmdi zmdi-favorite';
						$title = esc_html__('You already love this!', 'book-junky');
					}
					$heart_icon = '<i class="'.$icon.'"></i>';

			  		echo '<a href="#" class="nectar-love" id="nectar-love-'. $post_id .'" title="'. $title .'"> '.$heart_icon . $count . '</a>'
				?>
			</footer><!-- .entry-footer -->
		</div>
		</div>
	</div>
	<?php
		break;
}
?>
</div>

