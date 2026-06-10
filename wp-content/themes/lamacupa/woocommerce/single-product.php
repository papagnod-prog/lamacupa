<?php
/**
 * WooCommerce Single Product Template
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

while ( have_posts() ) :
    the_post();
    ?>

    <div class="single-product-page">

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar" style="background:#fff;border-bottom:1px solid rgba(0,0,0,.08);padding:12px 0">
            <div class="container">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>

        <!-- Product Main Section -->
        <div class="container" style="padding-top:56px;padding-bottom:56px">
            <div class="product-layout" style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start">

                <!-- Product Gallery (left) -->
                <div class="product-gallery">
                    <?php
                    /**
                     * woocommerce_before_single_product_summary
                     * - woocommerce_show_product_sale_flash (10)
                     * - woocommerce_show_product_images (20)
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>

                <!-- Product Info (right) -->
                <div class="product-summary">
                    <?php
                    /**
                     * woocommerce_single_product_summary
                     * - woocommerce_template_single_title (5)
                     * - woocommerce_template_single_rating (10)
                     * - woocommerce_template_single_price (10)
                     * - woocommerce_template_single_excerpt (20)
                     * - woocommerce_template_single_add_to_cart (30)
                     * - woocommerce_template_single_meta (40)
                     * - woocommerce_template_single_sharing (50)
                     */
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>

            </div><!-- /.product-layout -->
        </div>

        <!-- Product Description Tabs -->
        <div class="product-tabs-section" style="background:#fff;border-top:1px solid rgba(0,0,0,.08);padding:56px 0">
            <div class="container">
                <?php
                /**
                 * woocommerce_after_single_product_summary
                 * - woocommerce_output_product_data_tabs (10)
                 * - woocommerce_upsell_display (15)
                 * - woocommerce_output_related_products (20)
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>
        </div>

    </div><!-- /.single-product-page -->

    <?php
endwhile;

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
