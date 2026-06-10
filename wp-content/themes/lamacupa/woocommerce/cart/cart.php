<?php
/**
 * WooCommerce Cart Template
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<div class="cart-page">

    <!-- Cart Hero -->
    <div class="page-hero" style="background-color:var(--color-cream-dark,#F5F0E8);padding:calc(var(--nav-height,80px) + 40px) 0 40px">
        <div class="container">
            <h1 style="font-family:var(--font-heading);font-size:clamp(1.8rem,4vw,3rem)">
                <?php esc_html_e( 'Carrello', 'lamacupa' ); ?>
            </h1>
        </div>
    </div>

    <div class="container" style="padding-top:48px;padding-bottom:80px">

        <?php woocommerce_output_all_notices(); ?>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <!-- Cart Table -->
            <div class="cart-table-wrapper" style="overflow-x:auto;margin-bottom:32px">
                <table class="shop_table woocommerce-cart-form__contents" style="width:100%;border-collapse:collapse">
                    <thead>
                        <tr>
                            <th class="product-remove"></th>
                            <th class="product-thumbnail"></th>
                            <th class="product-name"><?php esc_html_e( 'Prodotto', 'lamacupa' ); ?></th>
                            <th class="product-price"><?php esc_html_e( 'Prezzo', 'lamacupa' ); ?></th>
                            <th class="product-quantity"><?php esc_html_e( 'Quantità', 'lamacupa' ); ?></th>
                            <th class="product-subtotal"><?php esc_html_e( 'Subtotale', 'lamacupa' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                    <!-- Remove -->
                                    <td class="product-remove">
                                        <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                /* translators: %s: product name */
                                                esc_attr( sprintf( __( 'Rimuovi %s dal carrello', 'lamacupa' ), wp_strip_all_tags( $_product->get_name() ) ) ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                        ?>
                                    </td>

                                    <!-- Thumbnail -->
                                    <td class="product-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                        if ( ! $product_permalink ) {
                                            echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        }
                                        ?>
                                    </td>

                                    <!-- Name -->
                                    <td class="product-name" data-title="<?php esc_attr_e( 'Prodotto', 'lamacupa' ); ?>">
                                        <?php
                                        if ( ! $product_permalink ) {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                        } else {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                        }
                                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                        echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Disponibile su ordinazione', 'lamacupa' ) . '</p>', $product_id ) );
                                        }
                                        ?>
                                    </td>

                                    <!-- Price -->
                                    <td class="product-price" data-title="<?php esc_attr_e( 'Prezzo', 'lamacupa' ); ?>">
                                        <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    </td>

                                    <!-- Quantity -->
                                    <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantità', 'lamacupa' ); ?>">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        } else {
                                            $min_quantity = 0;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        }
                                        $product_quantity = woocommerce_quantity_input(
                                            [
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $max_quantity,
                                                'min_value'    => $min_quantity,
                                                'product_name' => $_product->get_name(),
                                            ],
                                            $_product,
                                            false
                                        );
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        ?>
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotale', 'lamacupa' ); ?>">
                                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <tr>
                            <td colspan="6" class="actions">

                                <!-- Coupon -->
                                <?php if ( wc_coupons_enabled() ) : ?>
                                <div class="coupon" style="display:inline-flex;gap:8px;align-items:center">
                                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Codice coupon:', 'lamacupa' ); ?></label>
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Codice coupon', 'lamacupa' ); ?>">
                                    <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Applica coupon', 'lamacupa' ); ?>"><?php esc_html_e( 'Applica coupon', 'lamacupa' ); ?></button>
                                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                </div>
                                <?php endif; ?>

                                <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Aggiorna carrello', 'lamacupa' ); ?>"><?php esc_html_e( 'Aggiorna carrello', 'lamacupa' ); ?></button>

                                <?php do_action( 'woocommerce_cart_actions' ); ?>

                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </td>
                        </tr>

                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
            </div>

            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>

        <!-- Bottom row: continue shopping + cart totals -->
        <div class="cart-bottom" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start">

            <!-- Continue shopping link -->
            <div class="cart-continue">
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="btn btn--outline">
                    &larr; <?php esc_html_e( 'Continua gli acquisti', 'lamacupa' ); ?>
                </a>
            </div>

            <!-- Cart Totals -->
            <div class="cart-collaterals">
                <?php
                /**
                 * woocommerce_cart_collaterals
                 * - woocommerce_cart_totals() (10)
                 */
                do_action( 'woocommerce_cart_collaterals' );
                ?>
            </div>

        </div>

    </div><!-- /.container -->
</div><!-- /.cart-page -->

<?php do_action( 'woocommerce_after_cart' ); ?>
