<?php
/**
 * WooCommerce My Account Template
 *
 * @package Lamacupa
 * @version WooCommerce 8.x
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
?>

<div class="my-account-page">

    <!-- Hero -->
    <div class="page-hero" style="background-color:var(--color-cream-dark,#F5F0E8);padding:calc(var(--nav-height,80px) + 40px) 0 40px">
        <div class="container">
            <h1 style="font-family:var(--font-heading);font-size:clamp(1.8rem,4vw,3rem)">
                <?php
                if ( is_user_logged_in() ) {
                    /* translators: %s: user display name */
                    printf( esc_html__( 'Ciao, %s', 'lamacupa' ), esc_html( $current_user->display_name ) );
                } else {
                    esc_html_e( 'Il Mio Account', 'lamacupa' );
                }
                ?>
            </h1>
        </div>
    </div>

    <div class="container" style="padding-top:48px;padding-bottom:80px">

        <?php woocommerce_output_all_notices(); ?>

        <?php if ( is_user_logged_in() ) : ?>

        <div class="my-account-layout" style="display:grid;grid-template-columns:260px 1fr;gap:48px;align-items:start">

            <!-- Sidebar Navigation -->
            <nav class="my-account-nav" style="background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                <ul class="woocommerce-MyAccount-navigation" style="list-style:none;padding:0;margin:0">
                    <?php
                    $tabs = wc_get_account_menu_items();
                    foreach ( $tabs as $endpoint => $label ) {
                        $is_active = is_wc_endpoint_url( $endpoint ) || ( 'dashboard' === $endpoint && is_account_page() && ! is_wc_endpoint_url( false ) );
                        ?>
                        <li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>" style="border-bottom:1px solid rgba(0,0,0,.08)">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
                               style="display:block;padding:14px 20px;color:inherit;text-decoration:none;font-weight:<?php echo $is_active ? '600' : '400'; ?>;background:<?php echo $is_active ? 'var(--color-primary,#5C6B2E)' : 'transparent'; ?>;color:<?php echo $is_active ? '#fff' : 'inherit'; ?>">
                                <?php echo esc_html( $label ); ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>

            <!-- Content Area -->
            <div class="my-account-content" style="background:#fff;border-radius:8px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                <?php
                /**
                 * woocommerce_account_content
                 * Renders the appropriate endpoint content
                 */
                do_action( 'woocommerce_account_content' );
                ?>
            </div>

        </div><!-- /.my-account-layout -->

        <?php else : ?>

        <!-- Login / Register forms for non-logged-in users -->
        <div class="my-account-login" style="max-width:520px;margin:0 auto">
            <?php do_action( 'woocommerce_account_content' ); ?>
        </div>

        <?php endif; ?>

    </div><!-- /.container -->
</div><!-- /.my-account-page -->
