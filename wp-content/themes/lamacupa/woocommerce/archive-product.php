<?php
/**
 * WooCommerce Archive Product Template (Shop Page)
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * woocommerce_before_main_content fires our custom wrapper (functions.php)
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="shop-page">

    <!-- Shop Header -->
    <div class="shop-header" style="background-color:var(--color-cream-dark);padding:calc(var(--nav-height) + 48px) 0 56px">
        <div class="container">
            <span class="eyebrow"><?php esc_html_e( 'La Nostra Selezione', 'lamacupa' ); ?></span>
            <h1 class="shop-header__title">
                <?php
                if ( is_search() ) {
                    /* translators: %s: search query */
                    printf( esc_html__( 'Risultati per: "%s"', 'lamacupa' ), get_search_query() );
                } elseif ( is_product_category() ) {
                    echo woocommerce_page_title( false );
                } elseif ( is_product_tag() ) {
                    echo woocommerce_page_title( false );
                } else {
                    esc_html_e( 'Prodotti', 'lamacupa' );
                }
                ?>
            </h1>
            <?php
            // Show category description
            $term = get_queried_object();
            if ( $term && ! empty( $term->description ) ) {
                echo '<p class="lead" style="max-width:620px;margin-top:12px">' . wp_kses_post( $term->description ) . '</p>';
            } else {
                ?>
                <p class="lead" style="max-width:620px;margin-top:12px">
                    <?php esc_html_e( 'Olio extravergine d\'oliva biologico e prodotti selezionati dell\'Azienda Agricola Lamacupa.', 'lamacupa' ); ?>
                </p>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- Shop Toolbar + Products -->
    <div class="container" style="padding-top:48px;padding-bottom:80px">

        <?php
        /**
         * woocommerce_before_shop_loop
         * - woocommerce_output_all_notices() (20)
         * - woocommerce_result_count() (20)
         * - woocommerce_catalog_ordering() (30)
         */
        ?>

        <div class="shop-toolbar">
            <?php woocommerce_result_count(); ?>
            <?php woocommerce_catalog_ordering(); ?>
        </div>

        <?php
        if ( woocommerce_product_loop() ) :

            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) :
                while ( have_posts() ) :
                    the_post();
                    /**
                     * woocommerce_shop_loop
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                endwhile;
            endif;

            woocommerce_product_loop_end();

            /**
             * woocommerce_after_shop_loop
             * - woocommerce_pagination() (10)
             */
            do_action( 'woocommerce_after_shop_loop' );

        else :
            /**
             * woocommerce_no_products_found
             */
            do_action( 'woocommerce_no_products_found' );
        endif;
        ?>

    </div><!-- /.container -->
</div><!-- /.shop-page -->

<?php
/**
 * woocommerce_after_main_content fires our custom wrapper end (functions.php)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
