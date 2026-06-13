<?php
/**
 * Lamacupa Theme Functions
 * @package Lamacupa
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Theme Setup ───────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', 'lamacupa_setup' );
function lamacupa_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus( [
        'primary' => __( 'Menu Principale', 'lamacupa' ),
        'footer'  => __( 'Menu Footer', 'lamacupa' ),
    ] );

    add_image_size( 'product-thumb', 600, 600, true );
    add_image_size( 'hero-wide', 1600, 700, true );

    load_theme_textdomain( 'lamacupa', get_template_directory() . '/languages' );
}

// ─── Enqueue Assets ────────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', 'lamacupa_enqueue' );
function lamacupa_enqueue() {
    $ver = wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'lamacupa-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'lamacupa-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'lamacupa-fonts' ],
        $ver
    );

    wp_enqueue_script(
        'lamacupa-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $ver,
        true
    );
    wp_script_add_data( 'lamacupa-main', 'defer', true );
}

// ─── Admin Assets ──────────────────────────────────────────────────────────────
add_action( 'admin_enqueue_scripts', 'lamacupa_admin_enqueue' );
function lamacupa_admin_enqueue( $hook ) {
    if ( 'appearance_page_lamacupa-options' !== $hook ) return;
    $ver = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style(
        'lamacupa-admin',
        get_template_directory_uri() . '/assets/css/admin.css',
        [ 'wp-color-picker' ],
        $ver
    );
    wp_enqueue_media();
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script(
        'lamacupa-admin',
        get_template_directory_uri() . '/assets/js/admin.js',
        [ 'wp-color-picker', 'jquery' ],
        $ver,
        true
    );
}

// ─── WooCommerce Config ────────────────────────────────────────────────────────
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_filter( 'loop_shop_columns', function() { return 3; } );
add_filter( 'loop_shop_per_page', function() { return 12; }, 20 );

// Remove default WooCommerce sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// ─── Helper: lamacupa_option ──────────────────────────────────────────────────
function lamacupa_option( $key, $default = '' ) {
    $options = get_option( 'lamacupa_options', [] );
    return isset( $options[ $key ] ) && $options[ $key ] !== '' ? $options[ $key ] : $default;
}

// ─── Schema.org LocalBusiness JSON-LD ─────────────────────────────────────────
add_action( 'wp_head', 'lamacupa_schema_jsonld' );
function lamacupa_schema_jsonld() {
    $name    = lamacupa_option( 'ragione_sociale', get_bloginfo( 'name' ) );
    $address = lamacupa_option( 'indirizzo', '' );
    $tel     = lamacupa_option( 'tel', '' );
    $email   = lamacupa_option( 'email', '' );
    $schema  = [
        '@context'        => 'https://schema.org',
        '@type'           => 'LocalBusiness',
        'name'            => $name,
        'url'             => home_url( '/' ),
        'logo'            => lamacupa_option( 'logo', '' ),
        'description'     => lamacupa_option( 'meta_description', get_bloginfo( 'description' ) ),
        'address'         => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressCountry'  => 'IT',
        ],
        'telephone'       => $tel,
        'email'           => $email,
        'sameAs'          => array_filter( [
            lamacupa_option( 'instagram', '' ),
            lamacupa_option( 'facebook', '' ),
            lamacupa_option( 'youtube', '' ),
        ] ),
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

// ─── WooCommerce: Italian Checkout Fields (CF / PIVA / SDI / PEC) ─────────────
add_filter( 'woocommerce_checkout_fields', 'lamacupa_checkout_fields' );
function lamacupa_checkout_fields( $fields ) {
    $fields['billing']['billing_codice_fiscale'] = [
        'label'    => __( 'Codice Fiscale', 'lamacupa' ),
        'required' => false,
        'class'    => [ 'form-row-wide' ],
        'priority' => 35,
    ];
    $fields['billing']['billing_piva'] = [
        'label'    => __( 'Partita IVA', 'lamacupa' ),
        'required' => false,
        'class'    => [ 'form-row-wide' ],
        'priority' => 36,
    ];
    $fields['billing']['billing_sdi'] = [
        'label'    => __( 'Codice SDI / Destinatario', 'lamacupa' ),
        'required' => false,
        'class'    => [ 'form-row-wide' ],
        'priority' => 37,
    ];
    $fields['billing']['billing_pec'] = [
        'label'    => __( 'PEC', 'lamacupa' ),
        'type'     => 'email',
        'required' => false,
        'class'    => [ 'form-row-wide' ],
        'priority' => 38,
    ];
    return $fields;
}

add_action( 'woocommerce_checkout_update_order_meta', 'lamacupa_save_checkout_fields' );
function lamacupa_save_checkout_fields( $order_id ) {
    $fields = [ 'billing_codice_fiscale', 'billing_piva', 'billing_sdi', 'billing_pec' ];
    foreach ( $fields as $field ) {
        if ( ! empty( $_POST[ $field ] ) ) {
            update_post_meta( $order_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'lamacupa_admin_order_fields' );
function lamacupa_admin_order_fields( $order ) {
    $fields = [
        '_billing_codice_fiscale' => __( 'Codice Fiscale', 'lamacupa' ),
        '_billing_piva'           => __( 'Partita IVA', 'lamacupa' ),
        '_billing_sdi'            => __( 'Codice SDI', 'lamacupa' ),
        '_billing_pec'            => __( 'PEC', 'lamacupa' ),
    ];
    foreach ( $fields as $meta_key => $label ) {
        $val = get_post_meta( $order->get_id(), $meta_key, true );
        if ( $val ) {
            echo '<p><strong>' . esc_html( $label ) . ':</strong> ' . esc_html( $val ) . '</p>';
        }
    }
}

// ─── Breadcrumb ───────────────────────────────────────────────────────────────
function lamacupa_breadcrumb() {
    if ( is_front_page() ) return;
    $sep   = '<span class="breadcrumb-sep" aria-hidden="true">/</span>';
    $items = [];
    $items[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'lamacupa' ) . '</a>';

    if ( is_shop() ) {
        $items[] = '<span>' . __( 'Shop', 'lamacupa' ) . '</span>';
    } elseif ( is_product_category() ) {
        $items[] = '<a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '">' . __( 'Shop', 'lamacupa' ) . '</a>';
        $items[] = '<span>' . single_cat_title( '', false ) . '</span>';
    } elseif ( is_product() ) {
        $items[] = '<a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '">' . __( 'Shop', 'lamacupa' ) . '</a>';
        $items[] = '<span>' . get_the_title() . '</span>';
    } elseif ( is_page() ) {
        $items[] = '<span>' . get_the_title() . '</span>';
    } elseif ( is_single() ) {
        $items[] = '<span>' . get_the_title() . '</span>';
    }

    echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Percorso di navigazione', 'lamacupa' ) . '">';
    echo implode( ' ' . $sep . ' ', $items );
    echo '</nav>';
}

// ─── Includes ─────────────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/dynamic-css.php';
require_once get_template_directory() . '/inc/import-tool.php';
