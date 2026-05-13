<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
?>
<div class="bj-latest-pub">
    <div class="bj-latest-pub-title">
        <p><?php echo esc_attr($atts["cms_title"]) ?></p>
    </div>
    <div class="bj-latest-pub-list grid-2 extend-space">
        <div class="row">
            <?php
            if (!empty($atts['data'])) {
                foreach ($atts['data'] as $product) {
                    echo book_junky_get_item_layout($product->ID);
                }
            }
            ?>
        </div>
    </div>
    <div class="bj-latest-show-more wrap-view-more">
        <a class="button bj-button-show-more"
           data-limit="<?php echo !empty($atts['cms_limit']) ? esc_attr($atts['cms_limit']) : '-1' ?>"><?php echo esc_html__("Show more", 'book-junky') ?></a>
    </div>
</div>