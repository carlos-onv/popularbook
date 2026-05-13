<?php
/**
 * @name : Default Header
 * @package : CMSSuperHeroes
 * @author : Kenji
 */

?>

<div id="cshero-header" class="header-1">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-4 left-header">

                <?php if (is_active_sidebar('left-header-1')) : ?>

                    <?php dynamic_sidebar('left-header-1'); ?>
                <?php endif; ?>
            </div>
            <div id="cshero-header-logo" class="text-center col-xs-12 col-md-4">

                <?php book_junky_header_logo(); ?>
            </div><!-- #site-logo -->
            <div class="col-xs-12 col-md-4 right-header">
                
                <?php book_junky_login(); ?>
                
                <a href="#" class="menu"><i class="fa fa-bars"></i> <?php echo esc_html__('Menu', 'book-junky'); ?></a>
            </div>
            <div id="header-navigation" class="col-xs-12 <?php book_junky_header_class('cshero-main-header'); ?>">

                <nav id="site-navigation" class="main-navigation">

                    <?php book_junky_header_navigation(); ?>
                </nav>
            </div>
        </div>
    </div>
</div><!-- #site-navigation -->