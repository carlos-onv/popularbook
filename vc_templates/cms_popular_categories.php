<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: Kenji
 */
if (!is_array($atts['datas'])) {
    $atts['datas'] = array();
}

$check = $atts['cms_limit'];
if( !empty($atts['layout'])) {

	$layout = $atts['layout'];
} else {

	$layout = 'default';
}
switch ($layout) {
	case 'default':

		$class = "";
		if( $check == '2' ) {
			$class = 'col-xs-12 col-md-6';
		} elseif( $check == '3' || $check == '5' || $check == '6' ) {
			$class = 'col-xs-12 col-sm-6 col-md-4';
		} elseif( $check == '4' ) {
			$class = 'col-xs-12 col-md-3';
		}
		?>
		<div class="cms-category">
			<div class="row">
				<?php foreach ($atts['datas'] as $term) : 

				$link = get_term_link( $term->term_id );
				$thumbnail_id = get_term_meta($term->term_id,'thumbnail_id',true);
				$thumbnail_url = wp_get_attachment_image_url($thumbnail_id,'medium');

				?>
				<div class="cat-item <?php echo esc_attr($class); ?>">
					<div class="item-cat">
						<a href="<?php echo esc_url($link); ?>">
							<div class="thumbnail-cat">
								<img src="<?php echo esc_url($thumbnail_url)?>" alt="<?php esc_html_e("thumbnail","book-junky")?>">
							</div>
							<div class="info">
								<h5><?php echo esc_attr($term->name)?></h5>
			    				<h6><?php echo esc_attr($term->description)?></h6>
							</div>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php break;
	
	case 'masonry':
		?>
		<div class="cms-category">
			<div class="row">
				<?php

				$i = 1;
				$class = $thumbnail_url = '';
				foreach ($atts['datas'] as $term) :

				$thumbnail_id = get_term_meta($term->term_id,'thumbnail_id',true);

				if( $i < 5 ) {

					$class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';
					$thumbnail_url = wp_get_attachment_image_url($thumbnail_id,'book_junky_390X315');
				} else {

					$class = 'col-xs-12 col-sm-6 col-md-4';
					$thumbnail_url = wp_get_attachment_image_url($thumbnail_id,'book_junky_450X265');
				}

				$link = get_category_link( $term->term_id );

				?>
				<div class="cat-item <?php echo esc_attr($class); ?>">
					<div class="item-cat">
						<a href="<?php echo esc_url($link); ?>">
							<div class="thumbnail-cat">
								<img src="<?php echo esc_url($thumbnail_url)?>" alt="<?php esc_html_e("thumbnail","book-junky")?>">
							</div>
							<div class="info">
								<h5><?php echo esc_attr($term->name)?></h5>
			    				<h6><?php echo esc_attr($term->description)?></h6>
							</div>
						</a>
					</div>
				</div>
				<?php $i++; endforeach; ?>
			</div>
		</div>
	<?php break;
}


