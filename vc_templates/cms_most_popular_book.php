<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 * @Custom: Kennji
 */

$limit = !empty( $atts['cms_limit'] ) ? $atts['cms_limit'] : '20';
?>
<div class="wrap-cms-popuplar-book">
    <div class="row">
        <div class="most-popular-info col-xs-12 col-md-4 col-lg-3">
            <p class="title-1"><?php echo esc_html__("our","book-junky")?></p>
            <p class="title-2"><?php echo esc_html__("TOP","book-junky"); echo "<span>".esc_attr( $limit ); ?></span></p>
            <p class="title-3"><?php echo esc_html__("Most popular books","book-junky")?></p>
            <a href="#"><?php echo esc_html__("View all","book-junky")?></a>
        </div>
        <div class="most-popular-contents col-xs-12 col-md-8 col-lg-9">
            <div id="most-popular" class="owl-carousel owl-theme">
                <?php
                foreach ($atts['datas'] ->posts as $product) {

                    $color_item = get_post_meta( $product->ID , 'ef3-color_item', true);
                    $box_shadow = !empty($color_item) ? $color_item : '#000';
                    $hover = "this.style.boxShadow ='0 0 20px 0 ".$box_shadow. "';";
                    $out = "this.style.boxShadow ='0 0 15px -2px ".$box_shadow. "';";
                    $styles_hover = 'onmouseover="'.$hover. '"';
                    $onmouseout = 'onmouseout="'.$out.'"';
                    $author = esc_html__("by ", "book-junky");
                    $au_ = array();
                    foreach (book_junky_get_term_by_post_id($product->ID) as $term) {
                        $au_[] = $term->name;
                    }
                    $author .= implode(" & ", $au_);

                    ?>
                    <div class="item-popuplar">
                        <div class="thumbnal-popuplar" style="transition:all 0.25s ease 0s ;box-shadow: 0 0 15px -2px <?php echo esc_attr($box_shadow); ?>;" <?php echo $styles_hover . ' ' . $onmouseout; ?> >
                            <a href="<?php echo get_permalink($product->ID) ?>">
                            <?php echo get_the_post_thumbnail($product->ID,'shop_catalog_image_size'); ?>
                            </a>
                        </div>
                        <div class="content-popuplar">
                            <a class="popular-title"
                               href="<?php echo get_permalink($product->ID) ?>"><?php echo esc_attr($product->post_title) ?></a>
                            <div class="popular-author">
                                <?php echo esc_attr($author) ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

