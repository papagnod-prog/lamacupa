<?php
/**
 * Dynamic CSS from Theme Options
 * Genera CSS inline dalle opzioni salvate
 *
 * @package Lamacupa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
   ENQUEUE GOOGLE FONTS & DYNAMIC CSS
   ============================================================ */
function lamacupa_dynamic_css() {
    $options = get_option( 'lamacupa_options', [] );

    $color_primary   = ! empty( $options['color_primary'] )   ? $options['color_primary']   : '#5C6B2E';
    $color_secondary = ! empty( $options['color_secondary'] ) ? $options['color_secondary'] : '#8B6914';
    $color_accent    = ! empty( $options['color_accent'] )    ? $options['color_accent']    : '#C4A882';
    $color_testo     = ! empty( $options['color_testo'] )     ? $options['color_testo']     : '#2C2C2C';
    $color_sfondo    = ! empty( $options['color_sfondo'] )    ? $options['color_sfondo']    : '#F5F0E8';
    $font_titoli     = ! empty( $options['font_titoli'] )     ? $options['font_titoli']     : 'Playfair Display';
    $font_corpo      = ! empty( $options['font_corpo'] )      ? $options['font_corpo']      : 'Lato';

    // Validate hex colors
    $hex_re = '/^#[a-fA-F0-9]{3,6}$/';
    if ( ! preg_match( $hex_re, $color_primary ) )   $color_primary   = '#5C6B2E';
    if ( ! preg_match( $hex_re, $color_secondary ) ) $color_secondary = '#8B6914';
    if ( ! preg_match( $hex_re, $color_accent ) )    $color_accent    = '#C4A882';
    if ( ! preg_match( $hex_re, $color_testo ) )     $color_testo     = '#2C2C2C';
    if ( ! preg_match( $hex_re, $color_sfondo ) )    $color_sfondo    = '#F5F0E8';

    // Allowed font values
    $allowed_titoli = [ 'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Georgia' ];
    $allowed_corpo  = [ 'Lato', 'Open Sans', 'Raleway', 'Source Sans Pro' ];
    if ( ! in_array( $font_titoli, $allowed_titoli, true ) ) $font_titoli = 'Playfair Display';
    if ( ! in_array( $font_corpo, $allowed_corpo, true ) )   $font_corpo  = 'Lato';

    // Google Fonts URL
    $fonts_to_load = [];
    $google_fonts  = [ 'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Lato', 'Open Sans', 'Raleway', 'Source Sans Pro' ];

    if ( in_array( $font_titoli, $google_fonts, true ) ) {
        $fonts_to_load[] = str_replace( ' ', '+', $font_titoli ) . ':ital,wght@0,400;0,600;0,700;1,400';
    }
    if ( in_array( $font_corpo, $google_fonts, true ) && $font_corpo !== $font_titoli ) {
        $fonts_to_load[] = str_replace( ' ', '+', $font_corpo ) . ':wght@300;400;700';
    }

    if ( ! empty( $fonts_to_load ) ) {
        $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $fonts_to_load ) . '&display=swap';
        // Remove previously registered default google fonts to avoid duplicates
        wp_dequeue_style( 'lamacupa-google-fonts' );
        wp_enqueue_style( 'lamacupa-google-fonts-dynamic', esc_url( $fonts_url ), [], null );
    }

    // Derive darker/lighter shades from primary for CSS vars
    $css = "
<style id='lamacupa-dynamic-css'>
:root {
    --color-primary:   {$color_primary};
    --color-secondary: {$color_secondary};
    --color-accent:    {$color_accent};
    --color-text:      {$color_testo};
    --color-bg:        {$color_sfondo};
    --font-heading:    '{$font_titoli}', Georgia, serif;
    --font-body:       '{$font_corpo}', sans-serif;
}
body {
    font-family: var(--font-body);
    color: var(--color-text);
    background-color: var(--color-bg);
}
h1, h2, h3, h4, h5, h6,
.section-title,
.hero__title,
.card__title {
    font-family: var(--font-heading);
}
</style>
";

    echo $css; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'lamacupa_dynamic_css', 5 );

/* ============================================================
   FAVICON FROM OPTIONS
   ============================================================ */
function lamacupa_dynamic_favicon() {
    $favicon_url = lamacupa_option( 'favicon', '' );
    if ( $favicon_url ) {
        echo '<link rel="icon" href="' . esc_url( $favicon_url ) . '">' . "\n";
        echo '<link rel="shortcut icon" href="' . esc_url( $favicon_url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'lamacupa_dynamic_favicon', 1 );

/* ============================================================
   META DESCRIPTION & OG TAGS FROM OPTIONS
   ============================================================ */
function lamacupa_dynamic_meta() {
    if ( is_front_page() ) {
        $meta_desc = lamacupa_option( 'meta_description', '' );
        if ( $meta_desc ) {
            echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
        }
        $og_image = lamacupa_option( 'og_image', '' );
        if ( $og_image ) {
            echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'lamacupa_dynamic_meta', 3 );
