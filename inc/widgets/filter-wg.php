<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
add_action('widgets_init', 'add_filter_shop');

function add_filter_shop()
{
    register_widget('WC_Widget_Filter_Book');
}

/**
 * Resource Search Widget.
 * @extends  WC_Widget
 */
class WC_Widget_Filter_Book extends WP_Widget
{

    /**
     * Constructor.
     */

    function __construct()
    {
        parent::__construct(
            'filter_book', esc_html__('Filter Books', 'book-junky'), array('description' => esc_html__('A widget that displays filter book.', 'book-junky'),)
        );
    }

    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title'), 'book-junky'); ?>" type="text"
                   value="<?php echo !empty($instance['title'])? esc_attr($instance['title']): 'Filters' ?>">
        </p>
        <p class="bj-limit-items">
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_attr_e('Categories show limit:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('limit'), 'book-junky'); ?>" type="text"
                   value="<?php echo !empty($instance['limit'])? esc_attr($instance['limit']):'5' ?>">
        </p>
        <p class="bj-min-price-items">
            <label for="<?php echo esc_attr($this->get_field_id('min_price')); ?>"><?php esc_attr_e('Min price filter:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('min_price'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('min_price'), 'book-junky'); ?>" type="text"
                   value="<?php echo !empty($instance['min_price']) ? esc_attr($instance['min_price']): '0' ?>">
        </p>
        <p class="bj-max-price-items">
            <label for="<?php echo esc_attr($this->get_field_id('max_price')); ?>"><?php esc_attr_e('Max price filter:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('max_price'), 'book-junky'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('max_price'), 'book-junky'); ?>" type="text"
                   value="<?php echo !empty($instance['max_price']) ? esc_attr($instance['max_price']) :'100' ?>">
        </p>
        <p class="bj-age-range-items">
            <label for="<?php echo esc_attr($this->get_field_id('age_range')); ?>"><?php esc_attr_e('Age range values:', 'book-junky'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('age_range'), 'book-junky'); ?>"
                   placeholder="0|6|12|18"
                   name="<?php echo esc_attr($this->get_field_name('age_range'), 'book-junky'); ?>" type="text"
                   value="<?php echo !empty($instance['age_range']) ? esc_attr($instance['age_range']):'0|6|12|18' ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (isset($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
        $instance['limit'] = (isset($new_instance['limit'])) ? strip_tags($new_instance['limit']) : $old_instance['limit'];
        $instance['min_price'] = (isset($new_instance['min_price'])) ? strip_tags($new_instance['min_price']) : $old_instance['min_price'];
        $instance['max_price'] = (isset($new_instance['max_price'])) ? strip_tags($new_instance['max_price']) : $old_instance['max_price'];
        $instance['age_range'] = (isset($new_instance['age_range'])) ? strip_tags($new_instance['age_range']) : $old_instance['age_range'];
        return $instance;
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = $instance['title'];

        echo $args['before_widget'];
        if (!empty($_REQUEST['product_cat'])) {
            $term_active = get_term_by('slug', $_REQUEST['product_cat'], 'product_cat');
            $cate_value = $_REQUEST['product_cat'];
        }
        if (!empty($_REQUEST['product_cat_double'])) {
            $term_active = get_term_by('slug', $_REQUEST['product_cat_double'], 'product_cat');
            $cate_value = $_REQUEST['product_cat_double'];
        }
        if (!empty($_REQUEST['bj_tax_product_cat'])) {
            $terms_active = explode(',', $_REQUEST['bj_tax_product_cat']);
        }
        $terms = get_terms(array('taxonomy' => 'product_cat'));
        $age_range = !empty($instance['age_range']) ? $instance['age_range'] : "";
        ?>
        <form method="get" class="bj-ft-form">
            <div class="wrap-title">
                <?php
                if ($title) {
                    echo '' . $before_title . esc_attr($title) . $after_title;
                }
                echo "<div class='bj-filter-rs'>" . esc_html__('Reset', 'book-junky') . "</div>";
                ?>
            </div>
            <?php
            $limit_count = 0;
            $limit = $instance['limit'];
            ?>
            <div class="bj-ft-cate">
                <h3><?php echo esc_html__("Category", "book-junky") ?></h3><?php
                if (is_product_taxonomy()):
                    $queried_object = get_queried_object();
                    if (!empty($queried_object)):
                        ?>
                        <div class="bj-ft-cat-item bj-active" style="display: block;">
                            <a href="<?php echo esc_url(get_term_link($queried_object, $taxonomy = 'product_cat')) ?>"><?php echo esc_attr($queried_object->name) ?></a>
                        </div>
                        <?php
                        $limit_count++;
                    endif;
                    foreach ($terms as $term):
                        $display = ($limit_count < $limit) ? "display:block;" : "display:none;";
                        if (empty($queried_object) || (!empty($queried_object) && $queried_object->slug !== $term->slug)):
                            ?>
                            <div class="bj-ft-cat-item" style="<?php echo esc_attr($display) ?>">
                                <a href="<?php echo esc_url(get_term_link($term, $taxonomy = 'product_cat')) ?>"><?php echo esc_attr($term->name) ?></a>
                            </div>
                            <?php
                            $limit_count++;
                        endif;
                    endforeach;
                    ?>
                <?php
                elseif (is_archive()):
                    if (!empty($terms_active)):
                        foreach ($terms_active as $term_id) {
                            $term = get_term($term_id, 'product_cat');
                            ?>
                            <input type="hidden" class="bj-type-form" value="archive">
                            <div class="bj-ft-cat-item" style="display: block;">
                                <input type="checkbox" class="bj-ft-check-cate"
                                       id="bj-ft-cate-<?php echo esc_attr($term_id) ?>"
                                       value="<?php echo esc_attr($term_id) ?>" checked><label
                                        for="bj-ft-cate-<?php echo esc_attr($term_id) ?>"><?php echo esc_attr($term->name) ?></label>
                            </div>
                            <?php
                            $limit_count++;
                        }
                    endif;
                    foreach ($terms as $term):
                        $display = ($limit_count < $limit) ? "display:block;" : "display:none;";

                        if ((!empty($terms_active) && !in_array($term->term_id, $terms_active))):
                            ?>
                            <div class="bj-ft-cat-item" style="<?php echo esc_attr($display) ?>">
                                <input type="checkbox" class="bj-ft-check-cate"
                                       id="bj-ft-cate-<?php echo esc_attr($term->term_id) ?>"
                                       value="<?php echo esc_attr($term->term_id) ?>"><label
                                        for="bj-ft-cate-<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
                            </div>
                            <?php
                            $limit_count++;
                        elseif (empty($terms_active)):?>
                            <div class="bj-ft-cat-item" style="<?php echo esc_attr($display) ?>">
                                <input type="checkbox" class="bj-ft-check-cate"
                                       id="bj-ft-cate-<?php echo esc_attr($term->term_id) ?>"
                                       value="<?php echo esc_attr($term->term_id) ?>"><label
                                        for="bj-ft-cate-<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></label>
                            </div>
                            <?php
                            $limit_count++;
                        endif;
                    endforeach;
                    ?>
                    <input type="hidden" name="bj_tax_product_cat"
                           value="<?php echo(!empty($_REQUEST['bj_tax_product_cat']) ? esc_attr($_REQUEST['bj_tax_product_cat']) : "") ?>">
                <?php
                endif;
                ?>
                <?php
                if ($limit < count($terms)) {
                    ?>
                    <div class="bj-view-more-ft"><?php echo esc_html__("More...", "book-junky") ?></div>
                    <?php

                }
                ?>
            </div>
            <?php
            /*
            $age_ = explode('|', $age_range);
            if (!is_array($age_)) {
                $age_ = array();
            }
            ?>
            <div class="bj-ft-age">
                <h3><?php echo esc_html__("Age Range", "book-junky") ?></h3>
                <?php
                $ages_active = array();
                if (!empty($_REQUEST['bj_meta_ef3-age_accordant'])) {
                    $ages_active = explode(",", $_REQUEST['bj_meta_ef3-age_accordant']);
                }
                for ($i = 0; $i < count($age_); $i++) {
                    if (isset($age_[$i + 1])):
                        $check_value = $age_[$i] . ':' . $age_[$i + 1];
                        $checked = (in_array($check_value, $ages_active)) ? "checked" : "";
                        ?>
                        <div class="bj-ft-age-item">
                            <input type="checkbox" class="bj-ft-input-age"
                                   id="bj-ft-age-<?php echo esc_attr($age_[$i]) . '-' . $age_[$i + 1] ?>"
                                   value="<?php echo esc_attr($age_[$i]) . ':' . $age_[$i + 1] ?>" <?php echo esc_attr($checked) ?>><label
                                    for="bj-ft-age-<?php echo esc_attr($age_[$i]) . '-' . $age_[$i + 1] ?>"><?php echo esc_attr($age_[$i]) . ' - ' . $age_[$i + 1] ?></label>
                        </div>
                    <?php
                    else:
                        $check_value = $age_[$i] . ":max";
                        $checked = (in_array($check_value, $ages_active)) ? "checked" : "";
                        ?>
                        <div class="bj-ft-age-item">
                            <input type="checkbox" class="bj-ft-input-age"
                                   id="bj-ft-age-<?php echo esc_attr($age_[$i]) ?>"
                                   value="<?php echo esc_attr($age_[$i]) . ":max" ?>" <?php echo esc_attr($checked) ?>><label
                                    for="bj-ft-age-<?php echo esc_attr($age_[$i]) ?>"><?php echo esc_attr($age_[$i]) . '+' ?></label>
                        </div>
                    <?php
                    endif;
                }
                ?>
                <input type="hidden" name="bj_meta_ef3-age_accordant"
                       value="<?php echo (!empty($_REQUEST['bj_meta_ef3-age_accordant'])) ? $_REQUEST['bj_meta_ef3-age_accordant'] : "" ?>">
            </div>
            <div class="bj-ft-rating">
                <h3><?php echo esc_html__("Average Rating", "book-junky") ?></h3>
                <?php
                $rating_active = (!empty($_REQUEST['bj_meta__wc_average_rating'])) ? explode(',', $_REQUEST['bj_meta__wc_average_rating']) : array();
                for ($i = 5; $i >= 0; $i--) {
                    $checked_rating = in_array(">" . $i, $rating_active) ? "checked" : "";
                    if ($i !== 0) {
                        ?>
                        <div class="bj-ft-rating-item">
                            <input type="checkbox" class="bj-ft-input-rating" id="<?php echo esc_attr($i) ?>-star"
                                   value="<?php echo esc_html(">") . esc_attr($i) ?>" <?php echo esc_attr($checked_rating) ?>><label
                                    for="<?php echo esc_attr($i) ?>-star"><?php echo $i . " star" ?></label>
                        </div>
                        <?php
                    } else {

                        ?>
                        <div class="bj-ft-rating-item">
                            <input type="checkbox" class="bj-ft-input-rating" id="<?php echo esc_attr($i) ?>-star"
                                   value="<?php echo esc_html(">") . esc_attr($i) ?>" <?php echo esc_attr($checked_rating) ?>><label
                                    for="<?php echo esc_attr($i) ?>-star"><?php echo esc_html__("No Ratings", "book-junky") ?></label>
                        </div>
                        <?php
                    }
                }
                ?>
                <input type="hidden" name="bj_meta__wc_average_rating"
                       value="<?php echo (!empty($_REQUEST['bj_meta__wc_average_rating'])) ? $_REQUEST['bj_meta__wc_average_rating'] : "" ?>">
            </div>
            <?php
            $min_price_val = !empty($_REQUEST["min_price"]) ? $_REQUEST["min_price"] : $instance['min_price'];
            $max_price_val = !empty($_REQUEST["max_price"]) ? $_REQUEST["max_price"] : $instance['max_price'];
            ?>
            <div class="bj-ft-price" data-min="<?php echo esc_attr($instance['min_price']) ?>"
                 data-max="<?php echo esc_attr($instance['max_price']) ?>"
                 data-currency="<?php echo esc_attr(bj_get_woocommerce_currency_symbol()); ?>">
                <h3><?php echo esc_html__("Price Range", "book-junky") ?></h3>
                <div id="bj-range-price"></div>
                <button type="button"
                        class="bj-ft-price-button"><?php echo esc_html__("Filter", "book-junky") ?></button>
                <input type="hidden" name="min_price" class="bj-range-min-price-val"
                       value="<?php echo esc_attr($min_price_val) ?>">
                <input type="hidden" name="max_price" class="bj-range-max-price-val"
                       value="<?php echo esc_attr($max_price_val) ?>">
            </div>
            */ ?>
            <input type="hidden" name="post_type"
                   value="<?php echo (is_product_taxonomy()) ? "" : esc_html("product") ?>">
        </form>
        <?php
        echo $args['after_widget'];
    }
}