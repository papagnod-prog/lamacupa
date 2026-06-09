<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Mobile Nav Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay" aria-hidden="true"></div>

<!-- Mobile Nav Drawer -->
<nav class="mobile-nav" id="mobileNav" aria-label="<?php esc_attr_e( 'Menu mobile', 'lamacupa' ); ?>">
    <?php
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => '',
        'fallback_cb'     => 'lamacupa_mobile_menu_fallback',
        'items_wrap'      => '%3$s',
        'depth'           => 2,
    ] );
    ?>
</nav>

<!-- Site Header -->
<header class="site-header<?php echo ( ! is_front_page() ) ? ' site-header--solid' : ''; ?>" id="siteHeader">
    <div class="nav-container">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
            <?php
            if ( has_custom_logo() ) {
                $logo_id  = get_theme_mod( 'custom_logo' );
                $logo_img = wp_get_attachment_image( $logo_id, 'full', false, [
                    'class' => 'site-logo__img',
                    'alt'   => esc_attr( get_bloginfo( 'name' ) ),
                ] );
                echo $logo_img;
            } else {
                ?>
                <span class="site-logo__text">
                    <span class="site-logo__name"><?php bloginfo( 'name' ); ?></span>
                    <span class="site-logo__tagline">Azienda Agricola</span>
                </span>
                <?php
            }
            ?>
        </a>

        <!-- Primary Navigation -->
        <nav class="primary-nav" id="primaryNav" aria-label="<?php esc_attr_e( 'Menu principale', 'lamacupa' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_class'      => 'primary-nav',
                'fallback_cb'     => 'lamacupa_primary_menu_fallback',
                'items_wrap'      => '%3$s',
                'depth'           => 2,
            ] );
            ?>
        </nav>

        <!-- WooCommerce Cart + Hamburger -->
        <div class="flex flex--gap-16 flex--center">

            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <div class="nav-cart" aria-label="<?php esc_attr_e( 'Carrello', 'lamacupa' ); ?>">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Visualizza carrello', 'lamacupa' ); ?>">
                    <svg class="nav-cart__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M7.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm9 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2 2h2l2.68 10.39L7 14h12l2-7H6.21L5 3H2V2zM9 14l-.54-2h9.08l-1.14 4H8l1-2z"/>
                    </svg>
                    <span class="nav-cart__count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : '0' ); ?></span>
                    <span class="visually-hidden"><?php esc_html_e( 'Articoli nel carrello', 'lamacupa' ); ?></span>
                </a>
            </div>
            <?php endif; ?>

            <!-- Hamburger (mobile) -->
            <button
                class="hamburger"
                id="hamburgerBtn"
                aria-label="<?php esc_attr_e( 'Apri menu', 'lamacupa' ); ?>"
                aria-expanded="false"
                aria-controls="mobileNav"
            >
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </button>

        </div><!-- /.flex -->

    </div><!-- /.nav-container -->
</header><!-- /.site-header -->

<?php
/**
 * Fallback for primary nav menu when no menu is assigned.
 */
function lamacupa_primary_menu_fallback() {
    $pages = [
        home_url( '/' )               => __( 'Home',           'lamacupa' ),
        home_url( '/chi-siamo/' )     => __( 'Chi Siamo',      'lamacupa' ),
        home_url( '/la-nostra-terra/' ) => __( 'La Nostra Terra', 'lamacupa' ),
        home_url( '/gli-orci/' )      => __( 'Gli Orci',       'lamacupa' ),
        home_url( '/premi/' )         => __( 'Premi',          'lamacupa' ),
        home_url( '/olioturismo/' )   => __( 'Olioturismo',    'lamacupa' ),
        home_url( '/prodotti/' )      => __( 'Prodotti',       'lamacupa' ),
        home_url( '/contatti/' )      => __( 'Contatti',       'lamacupa' ),
    ];
    foreach ( $pages as $url => $label ) {
        printf( '<a href="%s">%s</a>', esc_url( $url ), esc_html( $label ) );
    }
}

function lamacupa_mobile_menu_fallback() {
    lamacupa_primary_menu_fallback();
}
?>
