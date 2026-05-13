<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Kenji
 */

?>
<div id="cshero-header" class="header-3">

	<?php book_junky_header_3_top(); ?>
	<div class="wrap-middler">
	    <div class="container">

	        <div class="row">

	            <div class="col-xs-12 col-md-4 col-lg-4">

	                <?php book_junky_header_3_logo(); ?>

	                <a href="#" class="menu"><i class="fa fa-bars"></i> <?php echo esc_html__('Menu', 'book-junky'); ?></a>
	            </div>
	             
	            <div class="col-xs-12 col-md-6 col-lg-6">
	               	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform clearfix"  method="get">
						<div class="wrap-search clearfix">
							<input type="text" class="form-search" name="s" value="" placeholder="<?php esc_html_e('Search for book...','book-junky'); ?>"> 
                                 
							<!--	<div class="wrap-cat">
									<?php book_junky_get_cat_book(); ?>
								</div> -->
								 
					 	</div>
						 <button type="submit" class="search-submit"><?php esc_html_e('Go','book-junky'); ?></button>
					 	<input type="hidden" name="post_type" value="product" />
					 	<input type="hidden" name="bj_action" value="bj_product"/>
					</form>
	            </div>
	             
	            <div class="col-xs-12 col-md-2 col-lg-2 another-site-logo">
	            	<span class="label-style-1">Popular Holdings Ltd.</span><br>
					<a href="http://www.popularworld.com" target="_blank"><span class="label-style-2">www.popularworld.com</span></a>
					<a href="https://www.popularbookusa.com/" target="_blank"><span class="label-style-2">www.popularbookusa.com</span></a>
				</div><!-- #site-logo -->
	        </div>
	    </div>
    </div>

    <div class="container">
    	<div class="row">
    		<div id="header-navigation" class="col-xs-12 <?php book_junky_header_class('cshero-main-header'); ?>">

                <nav id="site-navigation" class="main-navigation">

                    <?php book_junky_header_navigation(); ?>
                </nav>
            </div>
    	</div>
    </div>
</div><!-- #site-navigation -->


