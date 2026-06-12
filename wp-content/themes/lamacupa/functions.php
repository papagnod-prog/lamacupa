<?php
/**
 * Lamacupa Theme Functions
 *
 * @package Lamacupa
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LAMACUPA_VERSION', '1.1.0' );
define( 'LAMACUPA_DIR', get_template_directory() );
define( 'LAMACUPA_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function lamacupa_setup() {
    // Make the theme translatable
    load_theme_textdomain( 'lamacupa', LAMACUPA_DIR . '/languages' );

    // Add default posts and comments RSS feed links to <head>
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable post thumbnails / featured images
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup for search form, comment form, comments
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    // Custom logo
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => [ 'site-title', 'site-description' ],
    ] );

    // WooCommerce
    add_theme_support( 'woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 900,
        'product_grid'          => [
            'default_rows'    => 3,
            'min_rows'        => 1,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ],
    ] );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Wide/Full alignment support (block editor)
    add_theme_support( 'align-wide' );

    // Editor styles
    add_theme_support( 'editor-styles' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Navigation menus
    register_nav_menus( [
        'primary' => esc_html__( 'Menu Principale', 'lamacupa' ),
        'footer'  => esc_html__( 'Menu Footer', 'lamacupa' ),
    ] );
}
add_action( 'after_setup_theme', 'lamacupa_setup' );

/* ============================================================
   CUSTOM IMAGE SIZES
   ============================================================ */
function lamacupa_image_sizes() {
    add_image_size( 'lamacupa-hero',       1920, 1080, true );
    add_image_size( 'lamacupa-banner',     1440, 600,  true );
    add_image_size( 'lamacupa-card',       600,  450,  true );
    add_image_size( 'lamacupa-card-wide',  800,  500,  true );
    add_image_size( 'lamacupa-thumb',      400,  300,  true );
    add_image_size( 'lamacupa-square',     600,  600,  true );
    add_image_size( 'lamacupa-portrait',   600,  800,  true );
    add_image_size( 'lamacupa-team',       300,  300,  true );
}
add_action( 'after_setup_theme', 'lamacupa_image_sizes' );

/* ============================================================
   ENQUEUE STYLES & SCRIPTS
   ============================================================ */
function lamacupa_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'lamacupa-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Lato:wght@300;400;700;900&display=swap',
        [],
        null
    );

    // Main stylesheet (style.css)
    wp_enqueue_style(
        'lamacupa-style',
        get_stylesheet_uri(),
        [ 'lamacupa-google-fonts' ],
        LAMACUPA_VERSION
    );

    // Additional CSS
    wp_enqueue_style(
        'lamacupa-main',
        LAMACUPA_URI . '/assets/css/main.css',
        [ 'lamacupa-style' ],
        LAMACUPA_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'lamacupa-main',
        LAMACUPA_URI . '/assets/js/main.js',
        [],
        LAMACUPA_VERSION,
        true   // load in footer
    );

    // Localise script with AJAX url and nonce if needed
    wp_localize_script( 'lamacupa-main', 'lamacupaData', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'homeUrl' => home_url( '/' ),
        'nonce'   => wp_create_nonce( 'lamacupa_nonce' ),
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lamacupa_enqueue_assets' );

/* ============================================================
   WOOCOMMERCE: REMOVE DEFAULT STYLES
   ============================================================ */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// WooCommerce: use our own wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );

function lamacupa_woo_wrapper_start() {
    echo '<main id="main" class="site-main woo-main">';
    echo '<div class="container">';
}

function lamacupa_woo_wrapper_end() {
    echo '</div>';
    echo '</main>';
}

add_action( 'woocommerce_before_main_content', 'lamacupa_woo_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content',  'lamacupa_woo_wrapper_end',   10 );

// WooCommerce: remove sidebar from shop
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Cart fragment for AJAX cart count update
add_filter( 'woocommerce_add_to_cart_fragments', 'lamacupa_cart_count_fragment' );
function lamacupa_cart_count_fragment( $fragments ) {
    ob_start();
    ?>
    <span class="nav-cart__count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
    <?php
    $fragments['.nav-cart__count'] = ob_get_clean();
    return $fragments;
}

/* ============================================================
   REGISTER SIDEBARS / WIDGET AREAS
   ============================================================ */
function lamacupa_register_sidebars() {
    $defaults = [
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( array_merge( $defaults, [
        'name'        => esc_html__( 'Sidebar principale', 'lamacupa' ),
        'id'          => 'main-sidebar',
        'description' => esc_html__( 'Aggiunge widget alla sidebar principale.', 'lamacupa' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => esc_html__( 'Footer colonna 1', 'lamacupa' ),
        'id'          => 'footer-1',
        'description' => esc_html__( 'Prima colonna del footer.', 'lamacupa' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => esc_html__( 'Footer colonna 2', 'lamacupa' ),
        'id'          => 'footer-2',
        'description' => esc_html__( 'Seconda colonna del footer.', 'lamacupa' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => esc_html__( 'Shop sidebar', 'lamacupa' ),
        'id'          => 'shop-sidebar',
        'description' => esc_html__( 'Sidebar per la pagina shop.', 'lamacupa' ),
    ] ) );
}
add_action( 'widgets_init', 'lamacupa_register_sidebars' );

/* ============================================================
   EXCERPT
   ============================================================ */
function lamacupa_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'lamacupa_excerpt_length' );

function lamacupa_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'lamacupa_excerpt_more' );

/* ============================================================
   BODY CLASSES
   ============================================================ */
function lamacupa_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'singular';
    }
    if ( is_front_page() ) {
        $classes[] = 'front-page';
    }
    return $classes;
}
add_filter( 'body_class', 'lamacupa_body_classes' );

/* ============================================================
   CUSTOM LOGO HELPER
   ============================================================ */
function lamacupa_get_logo_html() {
    if ( has_custom_logo() ) {
        return get_custom_logo();
    }
    return '<span class="site-logo__text">
        <span class="site-logo__name">Lamacupa</span>
        <span class="site-logo__tagline">Azienda Agricola</span>
    </span>';
}

/* ============================================================
   PAGINATION
   ============================================================ */
function lamacupa_pagination() {
    $args = [
        'prev_text' => '&larr; ' . esc_html__( 'Precedente', 'lamacupa' ),
        'next_text' => esc_html__( 'Successivo', 'lamacupa' ) . ' &rarr;',
        'type'      => 'list',
    ];
    echo paginate_links( $args );
}

/* ============================================================
   SCHEMA / STRUCTURED DATA
   ============================================================ */
function lamacupa_schema_org() {
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Farm',
        'name'        => get_bloginfo( 'name' ),
        'description' => get_bloginfo( 'description' ),
        'url'         => home_url( '/' ),
        'image'       => get_template_directory_uri() . '/assets/images/og-image.jpg',
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Via Lamacupa',
            'addressLocality' => 'Montescaglioso',
            'addressRegion'   => 'Basilicata',
            'postalCode'      => '75024',
            'addressCountry'  => 'IT',
        ],
        'sameAs' => [
            'https://www.instagram.com/lamacupa',
            'https://www.facebook.com/lamacupa',
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'lamacupa_schema_org' );

/* ============================================================
   OPEN GRAPH META TAGS
   ============================================================ */
function lamacupa_og_tags() {
    if ( is_front_page() ) {
        $title       = get_bloginfo( 'name' ) . ' - Olio Extravergine d\'Oliva di Alta Qualità';
        $description = get_bloginfo( 'description' );
        $url         = home_url( '/' );
    } elseif ( is_singular() ) {
        $title       = get_the_title() . ' | ' . get_bloginfo( 'name' );
        $description = get_the_excerpt();
        $url         = get_permalink();
    } else {
        $title       = wp_title( '|', false, 'right' ) . get_bloginfo( 'name' );
        $description = get_bloginfo( 'description' );
        $url         = home_url( '/' );
    }
    ?>
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="<?php echo esc_attr( $title ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
    <meta property="og:url"         content="<?php echo esc_url( $url ); ?>" />
    <meta property="og:site_name"   content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
    <meta name="twitter:card"       content="summary_large_image" />
    <?php
}
add_action( 'wp_head', 'lamacupa_og_tags' );

/* ============================================================
   ALLOW SVG UPLOADS (admin)
   ============================================================ */
function lamacupa_allow_svg( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'lamacupa_allow_svg' );

/* ============================================================
   CLEAN UP WP HEAD
   ============================================================ */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* ============================================================
   WOOCOMMERCE PRODUCT COLUMNS
   ============================================================ */
add_filter( 'loop_shop_columns', function() { return 3; } );
add_filter( 'loop_shop_per_page', function() { return 9; }, 20 );

/* ============================================================
   CHECKOUT – CAMPI FATTURAZIONE ITALIANI (P.IVA / CF / SDI / PEC)
   ============================================================ */

// Registra i campi aggiuntivi nel checkout WooCommerce
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
    $fields['billing']['billing_customer_type'] = [
        'type'     => 'hidden',
        'default'  => 'privato',
        'priority' => 5,
    ];
    $fields['billing']['billing_codice_fiscale'] = [
        'label'    => __( 'Codice Fiscale', 'lamacupa' ),
        'required' => false,
        'priority' => 120,
        'class'    => [ 'form-row-wide' ],
    ];
    $fields['billing']['billing_ragione_sociale'] = [
        'label'    => __( 'Ragione Sociale', 'lamacupa' ),
        'required' => false,
        'priority' => 121,
        'class'    => [ 'form-row-wide' ],
    ];
    $fields['billing']['billing_piva'] = [
        'label'    => __( 'Partita IVA', 'lamacupa' ),
        'required' => false,
        'priority' => 122,
        'class'    => [ 'form-row-wide' ],
    ];
    $fields['billing']['billing_sdi'] = [
        'label'    => __( 'Codice SDI', 'lamacupa' ),
        'required' => false,
        'priority' => 123,
        'class'    => [ 'form-row-first' ],
    ];
    $fields['billing']['billing_pec'] = [
        'label'    => __( 'PEC', 'lamacupa' ),
        'required' => false,
        'priority' => 124,
        'class'    => [ 'form-row-last' ],
    ];
    return $fields;
} );

// Salva i campi sull'ordine
add_action( 'woocommerce_checkout_update_order_meta', function( $order_id ) {
    $fields = [ 'billing_customer_type', 'billing_codice_fiscale', 'billing_ragione_sociale', 'billing_piva', 'billing_sdi', 'billing_pec' ];
    foreach ( $fields as $field ) {
        if ( ! empty( $_POST[ $field ] ) ) {
            update_post_meta( $order_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
        }
    }
} );

// Mostra i campi nel pannello ordine in admin
add_action( 'woocommerce_admin_order_data_after_billing_address', function( $order ) {
    $tipo  = get_post_meta( $order->get_id(), '_billing_customer_type', true );
    $cf    = get_post_meta( $order->get_id(), '_billing_codice_fiscale', true );
    $rs    = get_post_meta( $order->get_id(), '_billing_ragione_sociale', true );
    $piva  = get_post_meta( $order->get_id(), '_billing_piva', true );
    $sdi   = get_post_meta( $order->get_id(), '_billing_sdi', true );
    $pec   = get_post_meta( $order->get_id(), '_billing_pec', true );

    echo '<div style="margin-top:12px;padding-top:12px;border-top:1px solid #eee">';
    echo '<strong>Tipo cliente:</strong> ' . esc_html( $tipo ?: 'privato' ) . '<br>';
    if ( $cf )   echo '<strong>C.F.:</strong> '           . esc_html( $cf )   . '<br>';
    if ( $rs )   echo '<strong>Ragione Sociale:</strong> ' . esc_html( $rs )   . '<br>';
    if ( $piva ) echo '<strong>P.IVA:</strong> '          . esc_html( $piva ) . '<br>';
    if ( $sdi )  echo '<strong>SDI:</strong> '            . esc_html( $sdi )  . '<br>';
    if ( $pec )  echo '<strong>PEC:</strong> '            . esc_html( $pec )  . '<br>';
    echo '</div>';
} );

/* ============================================================
   THEME OPTIONS HELPER
   ============================================================ */
/**
 * Get a single theme option value.
 *
 * @param string $key     Option key.
 * @param mixed  $default Default value if option not set.
 * @return mixed
 */
function lamacupa_option( $key, $default = '' ) {
    $options = get_option( 'lamacupa_options', [] );
    if ( ! is_array( $options ) ) {
        $options = [];
    }
    return ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) ? $options[ $key ] : $default;
}

/* ============================================================
   WOOCOMMERCE: PAYMENT GATEWAY SETTINGS FROM THEME OPTIONS
   ============================================================ */
/**
 * Enable or disable WooCommerce payment gateways based on theme options.
 * Runs on woocommerce_payment_gateways filter.
 */
function lamacupa_apply_gateway_settings( $load_gateways ) {
    // Only apply settings on the frontend checkout / AJAX calls
    if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        return $load_gateways;
    }

    $stripe_enabled  = (bool) lamacupa_option( 'stripe_enabled', 0 );
    $paypal_enabled  = (bool) lamacupa_option( 'paypal_enabled', 0 );
    $bacs_enabled    = (bool) lamacupa_option( 'bacs_enabled', 0 );
    $cod_enabled     = (bool) lamacupa_option( 'cod_enabled', 0 );

    // Map WC gateway class => our option flag
    $gateway_map = [
        'WC_Gateway_BACS' => $bacs_enabled,
        'WC_Gateway_COD'  => $cod_enabled,
        'WC_Gateway_Paypal' => $paypal_enabled,
    ];

    foreach ( $load_gateways as $key => $gateway_class ) {
        $class_name = is_object( $gateway_class ) ? get_class( $gateway_class ) : $gateway_class;
        if ( isset( $gateway_map[ $class_name ] ) && ! $gateway_map[ $class_name ] ) {
            unset( $load_gateways[ $key ] );
        }
    }

    return $load_gateways;
}
add_filter( 'woocommerce_payment_gateways', 'lamacupa_apply_gateway_settings' );

/**
 * Inject Stripe public key into page if Stripe is enabled.
 */
function lamacupa_stripe_public_key_data() {
    if ( ! lamacupa_option( 'stripe_enabled', 0 ) ) return;
    $pk = lamacupa_option( 'stripe_public_key', '' );
    if ( $pk ) {
        echo '<script>window.lamacupaStripeKey=' . wp_json_encode( $pk ) . ';</script>' . "\n";
    }
}
add_action( 'wp_head', 'lamacupa_stripe_public_key_data', 50 );

/* ============================================================
   INCLUDE ADDITIONAL THEME FILES
   ============================================================ */
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/import-tool.php';
require_once get_template_directory() . '/inc/dynamic-css.php';
