<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<style>
    #content.site-content {
        background-color: rgba(249, 250, 252, 1);
    }
    #content-404{
        text-align: center;
        font-family: 'averta-regular';
    }
    #content-404 p{
        font-size: 22.6px;
        font-weight: 500;
        line-height: 27.54px;
    }
    #content-404 h1 {
        font-size: 39.22px;
        color: #000;
        font-weight: 700;
        font-family: 'averta-regular';
    }
    #best-sell .wpb_wrapper .title-product {
        font-size: 18px;
        color: #0f120b;
        font-family: "averta-regular";
    }
    #best-sell .wpb_wrapper .price {
        color: #af0128 !important;
        font-size: 14px !important;
        font-family: "averta-regular";
        font-weight: bold;
    }
    #best-sell .product-content {
        margin-top: 4%;
        padding: 0 10%;
        text-align: center;
    }
    .heading-2:before {
        left: 0;
    }
</style>

<div id="primary" class="container">

	<main id="main" class="site-main" role="main">

		<div class="error-404 not-found">
			<?php
			    echo do_shortcode('[vc_row row_visible="" row_border="" el_id="content-404"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_single_image image="97808" img_size="full" alignment="center"][vc_column_text el_class="text-404"]
<h1>PAGE NOT FOUND</h1>
We can’t seem to find what you are looking for, but let’s keep moving![/vc_column_text][vc_btn title="Go Back" style="custom" custom_background="#af0128" custom_text="#ffffff" align="center" css=".vc_custom_1711993218891{padding-top: 16px !important;padding-right: 37px !important;padding-bottom: 16px !important;padding-left: 37px !important;}" link="url:https%3A%2F%2Fwww.popularbook.ca%2F"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][vc_row row_visible="" row_border="" css=".vc_custom_1654030808554{background-color: #f9fafc !important;}" el_id="best-sell"][vc_column][vc_custom_heading heading_layout="heading-2" text="RECOMMENDED PRODUCTS" font_container="tag:h2|font_size:25px|text_align:center|color:%23888a92" google_fonts="font_family:averta-bold%3Aregular|font_style:700%20Normal%3A400%3Anormal"][/vc_column][vc_column offset=""][products columns="6" orderby="title" order="ASC" ids="1682, 1467, 2978, 14092, 20184, 20162"][/vc_column][/vc_row]');
			?>
		</div><!-- .error-404 -->
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
