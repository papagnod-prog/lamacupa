<?php
/**
 * WooCommerce Checkout Form Template
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! is_user_logged_in() && 'no' === get_option( 'woocommerce_enable_guest_checkout' ) && 'yes' === get_option( 'woocommerce_enable_signup_and_login_from_checkout' ) ) {
    woocommerce_login_form( [ 'message' => esc_html__( 'Accedi al tuo account per procedere con il checkout.', 'lamacupa' ) ] );
    return;
}
?>

<div class="checkout-page">

    <!-- Checkout Hero -->
    <div class="page-hero" style="background-color:var(--color-cream-dark,#F5F0E8);padding:calc(var(--nav-height,80px) + 40px) 0 40px">
        <div class="container">
            <h1 style="font-family:var(--font-heading);font-size:clamp(1.8rem,4vw,3rem)">
                <?php esc_html_e( 'Checkout', 'lamacupa' ); ?>
            </h1>
        </div>
    </div>

    <div class="container" style="padding-top:48px;padding-bottom:80px">

        <?php woocommerce_output_all_notices(); ?>

        <?php do_action( 'woocommerce_before_checkout_form', WC()->checkout() ); ?>

        <!-- If checkout is empty -->
        <?php if ( WC()->cart->is_empty() ) : ?>
            <div class="woocommerce-info">
                <?php
                /* translators: %s: shop URL */
                printf( wp_kses_post( __( 'Il carrello è vuoto. <a href="%s">Torna allo shop</a>.', 'lamacupa' ) ), esc_url( wc_get_page_permalink( 'shop' ) ) );
                ?>
            </div>
        <?php else : ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <div class="checkout-layout" style="display:grid;grid-template-columns:1.4fr 1fr;gap:56px;align-items:start">

                <!-- LEFT: Billing + Shipping + Notes -->
                <div class="checkout-left">

                    <?php if ( ! is_user_logged_in() && WC()->checkout()->is_registration_enabled() ) : ?>
                    <div class="woocommerce-account-fields">
                        <?php do_action( 'woocommerce_before_checkout_registration_form', WC()->checkout() ); ?>
                        <?php if ( WC()->checkout()->get_checkout_fields( 'account' ) ) : ?>
                        <div class="create-account">
                            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Billing Details -->
                    <div class="checkout-section" style="background:#fff;border-radius:8px;padding:32px;margin-bottom:24px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:20px;border-bottom:2px solid var(--color-primary,#5C6B2E);padding-bottom:12px">
                            <?php esc_html_e( 'Dati di Fatturazione', 'lamacupa' ); ?>
                        </h2>

                        <!-- Selettore Privato / Azienda -->
                        <div class="customer-type-selector">
                            <label>
                                <input type="radio" name="lamacupa_customer_type" value="privato" checked>
                                <span>👤 <?php esc_html_e( 'Privato', 'lamacupa' ); ?></span>
                            </label>
                            <label>
                                <input type="radio" name="lamacupa_customer_type" value="azienda">
                                <span>🏢 <?php esc_html_e( 'Azienda / Libero professionista', 'lamacupa' ); ?></span>
                            </label>
                        </div>

                        <!-- Campi extra Privato: Codice Fiscale -->
                        <div id="billing-privato-fields" class="billing-extra-fields active">
                            <div class="field-row full">
                                <div>
                                    <label for="billing_codice_fiscale"><?php esc_html_e( 'Codice Fiscale', 'lamacupa' ); ?></label>
                                    <input type="text" id="billing_codice_fiscale" name="billing_codice_fiscale"
                                        placeholder="RSSMRA80A01H501U"
                                        maxlength="16"
                                        value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_codice_fiscale' ) ); ?>" />
                                    <p class="field-note"><?php esc_html_e( 'Necessario per emissione della ricevuta fiscale.', 'lamacupa' ); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Campi extra Azienda: P.IVA + Ragione Sociale + SDI/PEC -->
                        <div id="billing-azienda-fields" class="billing-extra-fields">
                            <div class="field-row">
                                <div>
                                    <label for="billing_ragione_sociale"><?php esc_html_e( 'Ragione Sociale', 'lamacupa' ); ?> <span style="color:red">*</span></label>
                                    <input type="text" id="billing_ragione_sociale" name="billing_ragione_sociale"
                                        placeholder="Azienda S.r.l."
                                        value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_ragione_sociale' ) ); ?>" />
                                </div>
                                <div>
                                    <label for="billing_piva"><?php esc_html_e( 'Partita IVA', 'lamacupa' ); ?> <span style="color:red">*</span></label>
                                    <input type="text" id="billing_piva" name="billing_piva"
                                        placeholder="IT12345678901"
                                        maxlength="13"
                                        value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_piva' ) ); ?>" />
                                </div>
                            </div>
                            <div class="field-row" style="margin-top:14px">
                                <div>
                                    <label for="billing_sdi"><?php esc_html_e( 'Codice SDI', 'lamacupa' ); ?></label>
                                    <input type="text" id="billing_sdi" name="billing_sdi"
                                        placeholder="ABCDE12"
                                        maxlength="7"
                                        value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_sdi' ) ); ?>" />
                                    <p class="field-note"><?php esc_html_e( 'Codice destinatario a 6 o 7 caratteri.', 'lamacupa' ); ?></p>
                                </div>
                                <div>
                                    <label for="billing_pec"><?php esc_html_e( 'Oppure PEC', 'lamacupa' ); ?></label>
                                    <input type="text" id="billing_pec" name="billing_pec"
                                        placeholder="fatture@pec.azienda.it"
                                        value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_pec' ) ); ?>" />
                                    <p class="field-note"><?php esc_html_e( 'Inserire SDI o PEC — non entrambi.', 'lamacupa' ); ?></p>
                                </div>
                            </div>
                        </div>

                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <!-- Shipping Address (togglable) -->
                    <?php if ( WC()->cart->needs_shipping_address() ) : ?>
                    <div class="checkout-section" style="background:#fff;border-radius:8px;padding:32px;margin-bottom:24px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px;border-bottom:2px solid var(--color-primary,#5C6B2E);padding-bottom:12px">
                            <?php esc_html_e( 'Indirizzo di Spedizione', 'lamacupa' ); ?>
                        </h2>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Order Notes -->
                    <div class="checkout-section" style="background:#fff;border-radius:8px;padding:32px;margin-bottom:24px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px;border-bottom:2px solid var(--color-primary,#5C6B2E);padding-bottom:12px">
                            <?php esc_html_e( 'Note sull\'ordine', 'lamacupa' ); ?>
                        </h2>
                        <?php
                        foreach ( WC()->checkout()->get_checkout_fields( 'order' ) as $key => $field ) {
                            woocommerce_form_field( $key, $field, WC()->checkout()->get_value( $key ) );
                        }
                        ?>
                    </div>

                </div><!-- /.checkout-left -->

                <!-- RIGHT: Order Review + Payment -->
                <div class="checkout-right">

                    <!-- Order Review -->
                    <div class="checkout-section" style="background:#fff;border-radius:8px;padding:32px;margin-bottom:24px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px;border-bottom:2px solid var(--color-primary,#5C6B2E);padding-bottom:12px">
                            <?php esc_html_e( 'Riepilogo Ordine', 'lamacupa' ); ?>
                        </h2>

                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>

                    <!-- Payment Methods -->
                    <div class="checkout-section" style="background:#fff;border-radius:8px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px;border-bottom:2px solid var(--color-primary,#5C6B2E);padding-bottom:12px">
                            <?php esc_html_e( 'Metodo di Pagamento', 'lamacupa' ); ?>
                        </h2>

                        <div id="payment" class="woocommerce-checkout-payment">
                            <?php if ( WC()->cart->needs_payment() ) : ?>
                                <ul class="wc_payment_methods payment_methods methods">
                                    <?php
                                    if ( ! empty( WC()->payment_gateways()->get_available_payment_gateways() ) ) {
                                        foreach ( WC()->payment_gateways()->get_available_payment_gateways() as $gateway ) {
                                            wc_get_template(
                                                'checkout/payment-method.php',
                                                [ 'gateway' => $gateway ]
                                            );
                                        }
                                    } else {
                                        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Nessun metodo di pagamento disponibile.', 'lamacupa' ) ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                    ?>
                                </ul>
                            <?php endif; ?>

                            <div class="form-row place-order" style="margin-top:24px">
                                <noscript>
                                    <?php esc_html_e( 'Il tuo browser non supporta JavaScript.', 'lamacupa' ); ?>
                                </noscript>
                                <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
                                <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt btn btn--primary btn--lg" id="place_order" value="' . esc_attr( WC()->checkout()->get_order_button_text() ) . '" data-value="' . esc_attr( WC()->checkout()->get_order_button_text() ) . '">' . esc_html( WC()->checkout()->get_order_button_text() ) . '</button>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
                                <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                            </div>
                        </div>
                    </div>

                </div><!-- /.checkout-right -->

            </div><!-- /.checkout-layout -->

        </form>

        <?php endif; ?>

        <?php do_action( 'woocommerce_after_checkout_form', WC()->checkout() ); ?>

    </div><!-- /.container -->
</div><!-- /.checkout-page -->
