<?php

add_action('widgets_init', 'donate_book');

function donate_book() {
    register_widget('WC_Widget_Search_Book');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_Search_Book extends WP_Widget {

	/**
	 * Constructor.
	 */

    function __construct() {
        parent::__construct(
                'donate_book', esc_html__( 'Search Book','book-junky'), array('description' => esc_html__('A Search box for book.', 'book-junky'),)
        );
    }

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		?>
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform"  method="get">
				<div class="wrap-cat">
					<?php book_junky_get_cat_book(); ?>
				</div>
				
				<div class="wrap-search">
					<input type="text" class="form-search" name="s" value="" placeholder="<?php esc_html_e('Enter Title or ISBN','book-junky'); ?>">
				 	<button type="submit" class="search-submit"><i class="zmdi zmdi-search"></i></button>
			 	</div>
			 	<input type="hidden" name="post_type" value="product" />
			</form>
		<?php

	}
}
