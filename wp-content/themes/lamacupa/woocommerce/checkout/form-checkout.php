<?php defined( 'ABSPATH' ) || exit ?>
<div class="checkout-page">
  <div class="page-hero" style="padding-bottom:20px">
    <div class="container"><h1 style="font-size:clamp(1.4rem,3vw,2rem)">Checkout</h1></div>
  </div>
  <div class="container">
    <!-- 4-STEP PROGRESS BAR -->
    <div class="checkout-steps">
      <div class="checkout-step done"><div class="step-num">✓</div><span class="step-label">Carrello</span></div>
      <div class="checkout-step active"><div class="step-num">2</div><span class="step-label">I tuoi dati</span></div>
      <div class="checkout-step"><div class="step-num">3</div><span class="step-label">Pagamento</span></div>
      <div class="checkout-step"><div class="step-num">4</div><span class="step-label">Conferma</span></div>
    </div>

    <?php woocommerce_output_all_notices() ?>
    <?php do_action( 'woocommerce_before_checkout_form', WC()->checkout() ) ?>

    <?php if ( WC()->cart->is_empty() ) : ?>
      <p style="text-align:center">Il carrello è vuoto. <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) ?>" style="color:var(--color-primary)">Torna allo shop</a>.</p>
    <?php else : ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ) ?>" enctype="multipart/form-data">
      <div class="checkout-layout">

        <!-- LEFT -->
        <div>
          <!-- Billing -->
          <div class="checkout-section">
            <h2>Dati di Fatturazione</h2>

            <!-- Privato / Azienda toggle -->
            <div class="customer-type-selector">
              <label><input type="radio" name="lamacupa_customer_type" value="privato" checked> 👤 Privato</label>
              <label><input type="radio" name="lamacupa_customer_type" value="azienda"> 🏢 Azienda</label>
            </div>

            <div id="billing-privato-fields" class="billing-extra active">
              <div class="field-row full">
                <div>
                  <label>Codice Fiscale</label>
                  <input type="text" name="billing_codice_fiscale" placeholder="RSSMRA80A01H501U" maxlength="16" value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_codice_fiscale' ) ) ?>">
                  <p class="field-note">Richiesto per la ricevuta fiscale.</p>
                </div>
              </div>
            </div>

            <div id="billing-azienda-fields" class="billing-extra">
              <div class="field-row">
                <div>
                  <label>Ragione Sociale *</label>
                  <input type="text" name="billing_ragione_sociale" placeholder="Azienda S.r.l." value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_ragione_sociale' ) ) ?>">
                </div>
                <div>
                  <label>Partita IVA *</label>
                  <input type="text" name="billing_piva" placeholder="IT12345678901" maxlength="13" value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_piva' ) ) ?>">
                </div>
              </div>
              <div class="field-row" style="margin-top:12px">
                <div>
                  <label>Codice SDI</label>
                  <input type="text" name="billing_sdi" placeholder="ABCDE12" maxlength="7" value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_sdi' ) ) ?>">
                  <p class="field-note">Codice destinatario 6–7 caratteri.</p>
                </div>
                <div>
                  <label>Oppure PEC</label>
                  <input type="text" name="billing_pec" placeholder="fatture@pec.it" value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_pec' ) ) ?>">
                  <p class="field-note">SDI o PEC, non entrambi.</p>
                </div>
              </div>
            </div>

            <?php do_action( 'woocommerce_checkout_billing' ) ?>
          </div>

          <!-- Shipping -->
          <?php if ( WC()->cart->needs_shipping_address() ) : ?>
          <div class="checkout-section">
            <h2>Indirizzo di Spedizione</h2>
            <?php do_action( 'woocommerce_checkout_shipping' ) ?>
          </div>
          <?php endif ?>

          <!-- Notes -->
          <div class="checkout-section">
            <h2>Note sull'ordine</h2>
            <?php foreach ( WC()->checkout()->get_checkout_fields( 'order' ) as $key => $field ) :
              woocommerce_form_field( $key, $field, WC()->checkout()->get_value( $key ) );
            endforeach ?>
          </div>
        </div>

        <!-- RIGHT -->
        <div>
          <!-- Order review -->
          <div class="checkout-section">
            <h2>Riepilogo Ordine</h2>
            <?php do_action( 'woocommerce_checkout_before_order_review' ) ?>
            <div id="order_review"><?php do_action( 'woocommerce_checkout_order_review' ) ?></div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ) ?>
          </div>

          <!-- Payment -->
          <div class="checkout-section">
            <h2>Metodo di Pagamento</h2>
            <div id="payment">
              <?php if ( WC()->cart->needs_payment() ) : ?>
                <ul class="wc_payment_methods payment_methods methods">
                  <?php if ( WC()->payment_gateways()->get_available_payment_gateways() ) :
                    foreach ( WC()->payment_gateways()->get_available_payment_gateways() as $gateway ) :
                      wc_get_template( 'checkout/payment-method.php', [ 'gateway' => $gateway ] );
                    endforeach;
                  else : ?>
                    <li class="woocommerce-notice woocommerce-info">Nessun metodo di pagamento disponibile.</li>
                  <?php endif ?>
                </ul>
              <?php endif ?>
              <div style="margin-top:20px">
                <?php do_action( 'woocommerce_review_order_before_submit' ) ?>
                <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn btn--primary btn--lg" id="place_order" style="width:100%;justify-content:center">' . esc_html( WC()->checkout()->get_order_button_text() ) . '</button>' ) ?>
                <?php do_action( 'woocommerce_review_order_after_submit' ) ?>
                <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ) ?>
              </div>
              <p style="font-size:.78rem;color:var(--color-text-light);text-align:center;margin-top:10px">🔒 Pagamento sicuro e protetto SSL</p>
            </div>
          </div>
        </div>

      </div>
    </form>
    <?php endif ?>
    <?php do_action( 'woocommerce_after_checkout_form', WC()->checkout() ) ?>
  </div>
</div>
