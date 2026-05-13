<?php 
	$style = "grid-1";
    if(!empty($atts['grid_layout'])) {
        $style = $atts['grid_layout'];
    }

    switch ($style) {
    	case 'grid-1':
    	?>
    		<div class="cms-grid-wraper grid-1" id="<?php echo esc_attr($atts['html_id']);?>">

			    <div class="row <?php echo esc_attr($atts['grid_class']);?>">

			        <?php 

			        $posts = $atts['posts'];
			        $size = 'book-grid-thumbnail';

			        while($posts ->have_posts()){

			        	global $product,$opt_meta_options;
			        	$box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
						$hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
						$out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
						$styles_hover = 'onmouseover="'.$hover. '"';
						$onmouseout = 'onmouseout="'.$out.'"';
			        	
			            $posts ->the_post();

			            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

	                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
	                    else:

	                        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
	                    endif;

			            ?>

			            <div class="<?php echo esc_attr($atts['item_class']);?>">
				            <div class="wrap-content">
					            <div class="cms-grid-media" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> ><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $thumbnail; ?></a></div>
					            <div class="info-product">
					                <a class="product-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
					                <?php
			                            $author_name = book_junky_get_author( get_the_ID() );

			                            if ( !empty($author_name) ) : 
			                            
			                            $author_page = get_option('woocommerce_author_page_id');
			                            $id_author = book_junky_get_id_term_2(get_the_ID());
			                            ?>
			                            <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
							                <p class="product-author">
							                	<?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?>
							                </p>
					            		</a>
					            	<?php endif; ?>

									<?php

										/**
										 * woocommerce_after_shop_loop_item_title hook.
										 *
										 * @hooked woocommerce_template_loop_rating - 5
										 * @hooked woocommerce_template_loop_price - 10
										 */
										do_action( 'woocommerce_after_shop_loop_item_title' );
									?>
								</div>
							</div>
			            </div>
			            <?php
			        }
			        ?>
			    </div>
			</div>
    	<?php break;
    	
    	case 'grid-2':
    		$extra_class = $class = '';
    		if( $atts['col_lg'] == 5 ) {
    			
    			$extra_class = 'new-col-lg-5';
    		}

    		if( !empty($atts['extend_space']) ) {
    			$class = $atts['extend_space'];
    		}

    		/* get categories */
	        $taxo = 'product_cat';
	        $_category = array();
	        if(!isset($atts['cat']) || $atts['cat']==''){
	            $terms = get_terms($taxo);
	            foreach ($terms as $cat){
	                $_category[] = $cat->term_id;
	            }
	        } else {
	            $_category  = explode(',', $atts['cat']);
	        }
	        $atts['categories'] = $_category;

	        if ($atts['filter'] == 'true') {
	            wp_enqueue_script('cms-jquery-shuffle');
	            $atts['grid_class'] .= " cms-grid-masonry-2";
	        }

	        $title = !empty($atts['title']) ? $atts['title'] : '';

    		?>

    		<div class="cms-grid-wraper grid-2 <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($atts['html_id']);?>">
    			<?php if( !empty($title) || $atts['filter'] == "true" ) : ?>
	    		<div class="cms-grid-filter clearfix">
	    			<?php if( !empty($title) ) : ?>
						<h3 class="title"><?php echo esc_attr($title); ?></h3>
					<?php endif; ?>

	    			<?php if( $atts['filter'] == "true" ) : ?>
			            <ul class="cms-filter-category list-unstyled list-inline">
			                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All'); ?></a></li>
			                <?php 
			                if(is_array($atts['categories']))
			                foreach($atts['categories'] as $category):?>
			                    <?php $term = get_term( $category, $taxo );?>
			                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
			                            <?php echo esc_html($term->name);?>
			                        </a>
			                    </li>
			                <?php endforeach;?>
			            </ul>

			    	<?php endif; ?> 
			    </div>
			    <?php endif; ?> 

			    <div class="row <?php echo esc_attr($atts['grid_class']);?>">

			        <?php 

			        $posts = $atts['posts'];
			        $size = 'book-grid-thumbnail';

			        while($posts ->have_posts()){

			        	global $product,$opt_meta_options;
			            $posts ->the_post();
			        	$box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
						$hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
						$out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
						$styles_hover = 'onmouseover="'.$hover. '"';
						$onmouseout = 'onmouseout="'.$out.'"';
			        	$groups = array();
			            $groups[] = '"all"';
			            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
			                $groups[] = '"category-'.$category->slug.'"';
			            }

			            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

	                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
	                    else:

	                        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
	                    endif;

			            ?>

			            <div class="<?php echo esc_attr($atts['item_class']);?> <?php echo esc_attr($extra_class); ?>"  data-groups='[<?php echo implode(',', $groups);?>]'>
				            <div class="cms-grid-media" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> ><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $thumbnail; ?></a></div>
				            <div class="info-product">
				                <a class="product-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				                <?php
		                            $author_name = book_junky_get_author( get_the_ID() );

		                            if ( !empty($author_name) ) : 

		                            $author_page = get_option('woocommerce_author_page_id');
		                            $id_author = book_junky_get_id_term_2(get_the_ID());
		                            ?>
		                            <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
						                <p class="product-author">
						                	<?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?>
						                </p>
				            		</a>
				            	<?php endif; ?>
								<?php

									/**
									 * woocommerce_after_shop_loop_item_title hook.
									 *
									 * @hooked woocommerce_template_loop_rating - 5
									 * @hooked woocommerce_template_loop_price - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item_title' );
								?>
							</div>
			            </div>
			            <?php
			        }
			        ?>
			    </div>

			    <?php //helping_hand_paging_nav(); ?>
			</div>

    	<?php break;

    	case 'grid-3':
    		?>
    		<div class="cms-grid-wraper grid-3" id="<?php echo esc_attr($atts['html_id']);?>">

			    <div class="row <?php echo esc_attr($atts['grid_class']);?>">

			        <?php 

			        $posts = $atts['posts'];
			        $size = 'book-grid-thumbnail';

			        while($posts ->have_posts()){

			        	global $product,$opt_meta_options;
			        	$box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
						$hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
						$out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
						$styles_hover = 'onmouseover="'.$hover. '"';
						$onmouseout = 'onmouseout="'.$out.'"';
			        	
			            $posts ->the_post();

			            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

	                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
	                    else:

	                        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
	                    endif;

			            ?>

			            <div class="<?php echo esc_attr($atts['item_class']);?>">
				            <div class="wrap-content">
					            <div class="cms-grid-media" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> >

					            	<?php echo $thumbnail; ?>
					            </div>
					            <div class="info-product">
					                <a class="product-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
					                <?php
			                            $author_name = book_junky_get_author( get_the_ID() );

			                            if ( !empty($author_name) ) : 
			                            
			                            $author_page = get_option('woocommerce_author_page_id');
			                            $id_author = book_junky_get_id_term_2(get_the_ID());
			                            ?>
			                            <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
							                <p class="product-author">
							                	<?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?>
							                </p>
					            		</a>
					            	<?php endif; ?>

									<?php echo book_junky_get_review_product( get_the_ID(), false ); ?>
								</div>
							</div>
			            </div>
			            <?php
			        }
			        ?>
			    </div>

			    <?php //helping_hand_paging_nav(); ?>
			</div>
    	<?php break;

    	case 'grid-4':
    		?>
    		<div class="cms-grid-wraper grid-4" id="<?php echo esc_attr($atts['html_id']);?>">

			    <div class="row <?php echo esc_attr($atts['grid_class']);?>">

			        <?php 

			        $posts = $atts['posts'];
			        $size = 'book-grid-thumbnail';

			        while($posts ->have_posts()){
			        	global $product,$opt_meta_options;
			        	$box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
						$hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
						$out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
						$styles_hover = 'onmouseover="'.$hover. '"';
						$onmouseout = 'onmouseout="'.$out.'"';
			            $posts ->the_post();

			            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):

	                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
	                    else:

	                        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
	                    endif;
			            ?>

			            <div class="<?php echo esc_attr($atts['item_class']);?>">
				            <div class="cms-grid-media" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> ><?php echo $thumbnail; ?></div>
				            <div class="info-product">
				                <a class="product-title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				                <?php
		                            $author_name = book_junky_get_author( get_the_ID() );

		                            if ( !empty($author_name) ) : 
		                            
		                            $author_page = get_option('woocommerce_author_page_id');
		                            $id_author = book_junky_get_id_term_2(get_the_ID());
		                            ?>
		                            <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo esc_attr($id_author); ?>">
						                <p class="product-author">
						                	<?php echo esc_html__('by: ','book-junky'); echo book_junky_get_author( get_the_ID() ); ?>
						                </p>
				            		</a>
				            	<?php endif; ?>

								<?php

									/**
									 * woocommerce_after_shop_loop_item_title hook.
									 *
									 * @hooked woocommerce_template_loop_price - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item_title' );
								?>
								<div class="excerpt-product"><?php echo wp_trim_words( get_the_excerpt(), '30', ''); ?></div>
							</div>
			            </div>
			            <?php
			        }
			        ?>
			    </div>

			    <?php //helping_hand_paging_nav(); ?>
			</div>
    	<?php break;
    }
?>