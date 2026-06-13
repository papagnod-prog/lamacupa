<?php defined( 'ABSPATH' ) || exit ?>
<div class="cart-page">
  <div class="page-hero" style="padding-bottom:20px">
    <div class="container">
      <h1 style="font-size:clamp(1.4rem,3vw,2rem)">Il Tuo Carrello</h1>
    </div>
  </div>
  <div class="container">
    <?php woocommerce_output_all_notices() ?>
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ) ?>" method="post">
      <div class="cart-layout">
        <div>
          <table class="cart-table">
            <thead>
              <tr>
                <th colspan="2">Prodotto</th>
                <th>Prezzo</th>
                <th>Quantità</th>
                <th>Totale</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                $product   = $cart_item['data'];
                $product_id = absint( $cart_item['product_id'] );
                if ( ! $product || ! $product->exists() || $cart_item['quantity'] == 0 ) continue;
              ?>
              <tr>
                <td style="width:80px">
                  <a href="<?php echo esc_url( $product->get_permalink() ) ?>">
                    <?php echo $product->get_image( [ 72, 72 ], [ 'style' => 'border-radius:4px', 'loading' => 'lazy' ] ) ?>
                  </a>
                </td>
                <td>
                  <a href="<?php echo esc_url( $product->get_permalink() ) ?>" class="cart-product-name"><?php echo esc_html( $product->get_name() ) ?></a>
                  <?php echo wc_get_formatted_cart_item_data( $cart_item ) ?>
                </td>
                <td><?php echo WC()->cart->get_product_price( $product ) ?></td>
                <td>
                  <input class="cart-qty-input" type="number" name="cart[<?php echo esc_attr( $cart_item_key ) ?>][qty]" value="<?php echo esc_attr( $cart_item['quantity'] ) ?>" min="0" step="1">
                </td>
                <td><?php echo WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ) ?></td>
                <td>
                  <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" class="cart-remove" title="Rimuovi">&times;</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px;flex-wrap:wrap;gap:12px">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) ?>" class="btn btn--outline btn--sm">← Continua a Fare Shopping</a>
            <button type="submit" name="update_cart" value="Aggiorna Carrello" class="btn btn--outline btn--sm"><?php esc_html_e( 'Aggiorna Carrello', 'lamacupa' ) ?></button>
          </div>
          <?php do_action( 'woocommerce_cart_contents' ) ?>
          <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ) ?>
        </div>

        <!-- Totals -->
        <div class="cart-totals-box">
          <h3>Riepilogo Ordine</h3>
          <div class="totals-row"><span>Subtotale</span><span><?php echo WC()->cart->get_cart_subtotal() ?></span></div>
          <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="totals-row" style="color:var(--color-primary)"><span>Coupon: <?php echo esc_html( $code ) ?></span><span>-<?php wc_cart_totals_coupon_html( $coupon ) ?></span></div>
          <?php endforeach ?>
          <?php if ( WC()->cart->needs_shipping() ) : ?>
            <div class="totals-row"><span>Spedizione</span><span><?php echo WC()->cart->get_cart_shipping_total() ?></span></div>
          <?php endif ?>
          <div class="totals-row total"><span>Totale</span><span><?php echo WC()->cart->get_total() ?></span></div>

          <!-- Coupon -->
          <?php if ( wc_coupons_enabled() ) : ?>
            <div class="coupon-row">
              <input type="text" name="coupon_code" placeholder="Codice coupon">
              <button type="submit" name="apply_coupon" value="Applica" class="btn btn--outline btn--sm">Applica</button>
            </div>
          <?php endif ?>

          <a href="<?php echo esc_url( wc_get_checkout_url() ) ?>" class="btn btn--primary btn--lg" style="width:100%;justify-content:center;margin-top:16px">Procedi all'Acquisto →</a>
          <p style="font-size:.78rem;color:var(--color-text-light);text-align:center;margin-top:10px">🔒 Pagamento sicuro e protetto</p>
        </div>
      </div>
    </form>
  </div>
</div>
