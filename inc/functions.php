<?php

/**
 * get terms
 *
 * @param string $taxonomy
 * @param bool $slug
 * @param array $options
 * @return array
 */
function book_junky_get_terms($taxonomy = 'category', $slug = true, $options = array())
{

    $_terms = get_terms($taxonomy, $options);

    $terms = array();

    if (empty($_terms) || is_wp_error($_terms))
        return $terms;

    foreach ($_terms as $_term) {
        if ($slug) {
            $terms[$_term->slug] = $_term->name;
        } else {
            $terms[$_term->term_id] = $_term->name;
        }
    }

    return $terms;
}

add_action('pre_get_posts', 'book_junky_search_handler');
function book_junky_search_handler($q)
{
    if (!$q->is_main_query()) {
        return;
    }
    $q->set('tax_query', bj_filter_by_taxonomy($q->get('tax_query')));
    $q->set('meta_query', bj_filter_by_meta($q->get('meta_query')));
    if ($q->get('post_type') !== 'product' || !isset($_REQUEST['bj_action']) || (!empty($_REQUEST['bj_action']) && $_REQUEST['bj_action'] !== "bj_product")) {
        return;
    }
}

function bj_filter_by_taxonomy($tax_query = array())
{
    if (!is_array($tax_query)) {
        $tax_query = array();
    }
    $tax_query['relation'] = 'AND';
    foreach ($_REQUEST as $key => $tax_value) {
        if (strpos($key, 'bj_tax_') !== false) {
            $value = explode(',', $tax_value);
            $temp = array(
                'taxonomy' => str_replace("bj_tax_", "", $key),
                'field' => 'term_id',
                'terms' => $value,
                'operator' => 'IN'
            );
            if (!empty($tax_value)) {
                $tax_query[] = $temp;
            }
        }
    }
    return apply_filters('bj_query_taxonomies', $tax_query);
}

function book_junky_get_item_layout($post_id)
{
    global $product;
    $product = wc_get_product( $post_id );
    global $opt_meta_options;
    $box_shadow = !empty($opt_meta_options['color_item']) ? $opt_meta_options['color_item'] : '#000';
    $hover = "this.style.boxShadow ='0 0 20px 0 " . $box_shadow . "';";
    $out = "this.style.boxShadow ='0 0 15px -2px " . $box_shadow . "';";
    $styles_hover = 'onmouseover="' . $hover . '"';
    $onmouseout = 'onmouseout="' . $out . '"';
    if (has_post_thumbnail($post_id)):
        $thumbnail = get_the_post_thumbnail($post_id);
    else:
        $thumbnail = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.jpg" alt="' . get_the_title() . '" />';
    endif;
    ob_start();
    ?>
    <div class="cms-grid-item col-md-4 col-sm-6 col-xs-12 new-col-lg-5">
        <div class="wrap-content">
            <div class="cms-grid-media"
                 style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> >

                <?php echo $thumbnail; ?>
            </div>
            <div class="info-product">
                <a class="product-title"
                   href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo get_the_title($post_id); ?></a>
                <p class="product-author"><?php echo esc_html__('by: ', 'book-junky');
                    echo book_junky_get_author($post_id); ?>
                </p>
                <div class="wrap-price"><?php woocommerce_template_loop_price(); ?></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function bj_filter_by_meta($meta_query = array())
{
    if (!is_array($meta_query)) {
        $meta_query = array(
            'relation' => 'AND'
        );
    }
    $meta_query['relation'] = 'AND';
    foreach ($_REQUEST as $key => $meta_value) {
        if (strpos($key, 'bj_meta_') !== false) {
            $meta_key = str_replace('bj_meta_', "", $key);
            $meta_value_list = explode(",", $meta_value);
            $meta_array = array(
                'relation' => 'OR'
            );
            foreach ($meta_value_list as $value) {
                if (strpos($value, ":") !== false && strpos($value, "max") === false) {
                    $value_space = explode(':', $value);
                    if (count($value_space) >= 2) {
                        $meta_array[] =
                            array(
                                'key' => $meta_key,
                                'value' => $value_space,
                                'type' => 'numeric',
                                'compare' => 'BETWEEN'
                            );
                    }
                } elseif (strpos($value, ":") !== false && strpos($value, "max") !== false) {
                    $value_space = explode(':', $value);
                    if (count($value_space) >= 2) {
                        $meta_array[] =
                            array(
                                'key' => $meta_key,
                                'value' => $value_space[0],
                                'type' => 'numeric',
                                'compare' => '>='
                            );
                    }
                } elseif (strpos($value, ">") !== false) {
                    $meta_key = str_replace('bj_meta_', "", $key);
                    $meta_value_list = explode(",", $meta_value);
                    $meta_array = array(
                        'relation' => 'OR'
                    );
                    foreach ($meta_value_list as $value) {
                        $value = str_replace('>', "", $value);
                        $value_space = array($value, $value + 0.99);
                        if (count($value_space) >= 2) {
                            $meta_array[] =
                                array(
                                    'key' => $meta_key,
                                    'value' => $value_space,
                                    'type' => 'numeric',
                                    'compare' => 'BETWEEN'
                                );
                        }
                    }
                }
            }
            $meta_query[] = $meta_array;
        }
    }
    return apply_filters('bj_query_meta', $meta_query);
}

/**
 * get list menu.
 * @return array
 */
function book_junky_get_nav_menu()
{

    $menus = array(
        '' => esc_html__('Default', 'book-junky')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu) {
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

/* Include the TGM_Plugin_Activation class.*/
require_once(get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php');

/* load list plugins */
require_once(get_template_directory() . '/inc/options/require.plugins.php');

/* load demo data setting */
require_once(get_template_directory() . '/inc/demo-data.php');

/* lip font */
require_once get_template_directory() . '/inc/libs/font-awesome.php';

require_once get_template_directory() . '/inc/libs/material-design.php';

/* load template functions */
require_once(get_template_directory() . '/inc/template.functions.php');

/* load mega menu. */
require_once(get_template_directory() . '/inc/mega-menu/functions.php');

/* load theme options. */
require_once(get_template_directory() . '/inc/options/function.options.php');

/* load meta testimonials. */
require_once(get_template_directory() . '/inc/options/meta-testimonials.php');

/* load mata options */
require_once(get_template_directory() . '/inc/options/meta-options.php');

/* Load meta team */
require_once(get_template_directory() . '/inc/options/meta-teams.php');

/* load meta product */
require_once(get_template_directory() . '/inc/options/meta-product.php');

require_once(get_template_directory() . '/woocommerce/function-hook.php');

/* load taxonomy options */
//require_once( get_template_directory() . '/inc/options/meta-taxonomy.php' );

/* load static css. */
require_once(get_template_directory() . '/inc/dynamic/static.css.php');

/* load dynamic css*/
require_once(get_template_directory() . '/inc/dynamic/dynamic.css.php');

/* Widget */
require_once(get_template_directory() . '/inc/widgets/search-book.php');

require_once(get_template_directory() . '/inc/widgets/recent-post.php');

require_once(get_template_directory() . '/inc/widgets/recent-reviews.php');

require_once(get_template_directory() . '/inc/widgets/browse-author.php');

require_once(get_template_directory() . '/inc/widgets/recents-review-2.php');

require_once(get_template_directory() . '/inc/widgets/filter-wg.php');

require_once(get_template_directory() . '/inc/widgets/recent-product.php');

/* Post Favorite */
require_once(get_template_directory() . '/inc/post_favorite.php');

/* ajax-handler */
require_once(get_template_directory() . '/inc/ajax-handler.php');














