<?php
vc_map(array(
    "name" => 'CMS Best Sellers',
    "base" => "cms_best_sellers",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', "book-junky"),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Time point", 'book-junky'),
            "param_name" => "cms_time_point",
            'value' => array(
                'all' => esc_html__("All time", 'book-junky'),
                'month' => esc_html__("Current month", 'book-junky'),
                'week' => esc_html__("Current week", 'book-junky')
            )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Limit items number", 'book-junky'),
            "param_name" => "cms_limit",
            'value' => '6'
        )
    )
));

class WPBakeryShortCode_cms_best_sellers extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'cms_time_point' => 'all',
            'cms_limit' => '6',
        ), $atts));

        $html_id = cmsHtmlID('cms_best_sellers');
        $atts['html_id'] = $html_id;
        switch ($cms_time_point){
            case "month":
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $cms_limit,
                    'date_query' => array(
                        array(
                            'month' => date( 'M' ),
                        ),
                    ),
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => 'total_sales'
                );
                break;
            case "week":
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $cms_limit,
                    'date_query' => array(
                        array(
                            'week' => date( 'W' ),
                        ),
                    ),
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => 'total_sales'
                );
                break;
            default:
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $cms_limit,
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => 'total_sales'
                );
                break;
        }
        $atts['cms_limit'] = $cms_limit;
        $atts['datas'] = new WP_Query($args);
        return parent::content($atts, $content);
    }
}

?>