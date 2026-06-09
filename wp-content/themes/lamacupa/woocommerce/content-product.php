<?php
/**
 * WooCommerce Product Card Template (Loop)
 *
 * Used in the product archive loop via wc_get_template_part( 'content', 'product' ).
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<li <?php wc_product_class( 'product-card', $product ); ?>>

    <?php
    /**
     * woocommerce_before_shop_loop_item
     * - woocommerce_template_loop_product_link_open() (10)
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <!-- Product Image -->
    <div class="product-card__image-wrap">
        <?php
        /**
         * woocommerce_before_shop_loop_item_title
         * - woocommerce_show_product_loop_sale_flash() (10)
         * - woocommerce_template_loop_product_thumbnail() (10)
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
    </div><!-- /.product-card__image-wrap -->

    <!-- Product Info -->
    <div class="woo-product-info">

        <?php
        // Category badge
        $terms = get_the_terms( $product->get_id(), 'product_cat' );
        if ( $terms && ! is_wp_error( $terms ) ) {
            $term = reset( $terms );
            echo '<span class="card__eyebrow">' . esc_html( $term->name ) . '</span>';
        }
        ?>

        <?php
        /**
         * woocommerce_shop_loop_item_title
         * - woocommerce_template_loop_product_title() (10)
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        ?>

        <?php
        // Short description (excerpt)
        $short_desc = $product->get_short_description();
        if ( $short_desc ) {
            echo '<p class="product-card__desc" style="font-size:0.88rem;color:var(--color-text-light);margin-bottom:12px;-webkit-line-clamp:2;display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden">';
            echo wp_kses_post( wp_trim_words( $short_desc, 18 ) );
            echo '</p>';
        }
        ?>

        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">

            <?php
            /**
             * woocommerce_after_shop_loop_item_title
             * - woocommerce_template_loop_rating() (5)
             * - woocommerce_template_loop_price() (10)
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>

            <?php
            /**
             * woocommerce_after_shop_loop_item
             * - woocommerce_template_loop_product_link_close() (5)
             * - woocommerce_template_loop_add_to_cart() (10)
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>

        </div>

    </div><!-- /.woo-product-info -->

</li>
