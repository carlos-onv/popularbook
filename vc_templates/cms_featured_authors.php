<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */

$item = $atts['cms_limit'];

$item_class = '';

switch ($item) {
    case '1':
        $item_class = 'col-xs-12';
        break;
    case '2':
        $item_class = 'col-xs-12 col-sm-6';
        break;
    case '3':
        $item_class = 'col-xs-12 col-sm-6 col-md-4';
        break;
    case '4':
        $item_class = 'col-xs-12 col-sm-6 col-md-3';
        break;

    case '5':
        $item_class = 'col-xs-12 col-sm-6 col-md-3 new-col-lg-5';
        break;

    default:
        $item_class = 'col-xs-12 col-sm-6 col-md-3';
        break;
}
?>
<div class="cms-author">
    <div class="row">
        <?php

        foreach ($atts['datas'] as $author) {
            $logo_id = get_term_meta($author->term_id, 'bj_avatar', true);
            $book_count = book_junky_count_product_by_term_id($author->term_id);
            $label = $book_count <= 1 ? " book" : " books";

            if (!empty($logo_id)) :

                $src = wp_get_attachment_image_url($logo_id, 'book_junky_450X500');
            else :

                $src = get_template_directory_uri() . '/assets/images/ex.jpg';
            endif;
            $author_page = get_option('woocommerce_author_page_id');
            ?>
            <div class="<?php echo esc_attr($item_class); ?>">
                <a href="<?php echo home_url("/?page_id=" . $author_page) ?>&author_id=<?php echo $author->term_id ?>">
                    <div class="item">
                        <img src="<?php echo esc_url($src); ?>" alt="Avt Author">

                        <div class="info">
                            <div class="bj-author-name"><?php echo esc_attr($author->name) ?></div>

                            <div class="bj-count-book">

                                <?php echo esc_attr($book_count) . esc_attr($label); ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
