<?php
/**
 * Shortcode Search Book
 */

global $wp_query;
global $wpdb;

$cate_slug = !empty($_REQUEST['product_cat']) ? $_REQUEST['product_cat'] : "";
$year = !empty($_REQUEST['bj_tax_pa_year_publication']) ? $_REQUEST['bj_tax_pa_year_publication'] : "";
$subject = !empty($_REQUEST['cat_subject']) ? $_REQUEST['cat_subject'] : "";

//echo "<pre>";print_r($wpdb->last_query);echo "</pre>";
//echo "<pre>";print_r($wp_query->query_vars);echo "</pre>";
?>
<div class="wrap-search-book" id="<?php echo esc_attr($atts['html_id']); ?>">
    <form class="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <div class="wrap-cat" style="display: none !important;">
            <?php book_junky_get_cat_book_2($cate_slug); ?>
        </div>

        <!--
        <div class="wrap-year">
            <?php book_junky_get_year_book($year); ?>
        </div>
        -->
        <div class="wrap-cat">
            <?php book_junky_get_subject_book($subject); ?>
        </div>

        <div class="wrap-search">
            <input type="text" class="form-search" name="s" value=""
                   placeholder="<?php esc_html_e('Enter Title or ISBN', 'book-junky'); ?>">
            <button type="submit" class="search-submit"><?php esc_html_e('Search Books', 'book-junky'); ?></button>
        </div>
        <input type="hidden" name="post_type" value=""/>
        <input type="hidden" name="bj_action" value="bj_product"/>
    </form>
</div>