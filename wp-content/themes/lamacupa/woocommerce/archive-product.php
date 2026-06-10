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

    <!-- Shop Hero Banner -->
    <div class="shop-hero" style="background-color:var(--color-cream-dark);padding:calc(var(--nav-height,80px) + 48px) 0 56px">
        <div class="container">
            <span class="eyebrow"><?php esc_html_e( 'La Nostra Selezione', 'lamacupa' ); ?></span>
            <h1 class="shop-hero__title" style="font-family:var(--font-heading);font-size:clamp(2rem,5vw,3.5rem);margin-bottom:16px">
                <?php
                if ( is_search() ) {
                    /* translators: %s: search query */
                    printf( esc_html__( 'Risultati per: "%s"', 'lamacupa' ), get_search_query() );
                } elseif ( is_product_category() ) {
                    echo woocommerce_page_title( false );
                } elseif ( is_product_tag() ) {
                    echo woocommerce_page_title( false );
                } else {
                    esc_html_e( 'I Nostri Prodotti', 'lamacupa' );
                }
                ?>
            </h1>
            <?php
            $term = get_queried_object();
            if ( $term && ! empty( $term->description ) ) {
                echo '<p class="lead" style="max-width:620px;margin-top:12px">' . wp_kses_post( $term->description ) . '</p>';
            } else {
                ?>
                <p class="lead" style="max-width:620px;margin-top:12px">
                    <?php esc_html_e( "Olio extravergine d'oliva biologico e prodotti selezionati dell'Azienda Agricola Lamacupa.", 'lamacupa' ); ?>
                </p>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- Category Filter Buttons -->
    <?php if ( ! is_product_category() && ! is_search() ) : ?>
    <div class="shop-filters" style="background:#fff;border-bottom:1px solid rgba(0,0,0,.08);padding:20px 0">
        <div class="container">
            <div class="shop-filters__inner" style="display:flex;flex-wrap:wrap;gap:10px;align-items:center">
                <span style="font-weight:600;margin-right:6px"><?php esc_html_e( 'Filtra:', 'lamacupa' ); ?></span>

                <?php
                $current_cat_slug = get_query_var( 'product_cat' );
                $shop_url         = get_permalink( wc_get_page_id( 'shop' ) );

                // "Tutti" button
                $all_active = empty( $current_cat_slug ) ? 'btn--primary' : 'btn--outline';
                printf(
                    '<a href="%s" class="btn btn--sm %s">%s</a>',
                    esc_url( $shop_url ),
                    esc_attr( $all_active ),
                    esc_html__( 'Tutti', 'lamacupa' )
                );

                // Top-level product categories
                $categories = get_terms( [
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'parent'     => 0,
                    'orderby'    => 'menu_order',
                    'order'      => 'ASC',
                    'exclude'    => get_option( 'default_product_cat', 0 ),
                ] );

                if ( $categories && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $cat ) {
                        $cat_url    = get_term_link( $cat );
                        $is_active  = ( $current_cat_slug === $cat->slug ) ? 'btn--primary' : 'btn--outline';
                        printf(
                            '<a href="%s" class="btn btn--sm %s">%s</a>',
                            esc_url( $cat_url ),
                            esc_attr( $is_active ),
                            esc_html( $cat->name )
                        );
                    }
                } else {
                    // Fallback static categories
                    $static_cats = [
                        'olio-evo'          => 'Olio EVO',
                        'confezioni-regalo' => 'Confezioni Regalo',
                        'accessori'         => 'Accessori',
                    ];
                    foreach ( $static_cats as $slug => $label ) {
                        $cat_obj = get_term_by( 'slug', $slug, 'product_cat' );
                        if ( $cat_obj ) {
                            $cat_url   = get_term_link( $cat_obj );
                            $is_active = ( $current_cat_slug === $slug ) ? 'btn--primary' : 'btn--outline';
                            printf(
                                '<a href="%s" class="btn btn--sm %s">%s</a>',
                                esc_url( $cat_url ),
                                esc_attr( $is_active ),
                                esc_html( $label )
                            );
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Shop Toolbar + Products -->
    <div class="container" style="padding-top:48px;padding-bottom:80px">

        <div class="shop-toolbar" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:12px">
            <?php woocommerce_result_count(); ?>
            <?php woocommerce_catalog_ordering(); ?>
        </div>

        <?php
        woocommerce_output_all_notices();

        if ( woocommerce_product_loop() ) :

            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) :
                while ( have_posts() ) :
                    the_post();
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
            do_action( 'woocommerce_no_products_found' );
        endif;
        ?>

    </div><!-- /.container -->
</div><!-- /.shop-page -->

<?php
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
