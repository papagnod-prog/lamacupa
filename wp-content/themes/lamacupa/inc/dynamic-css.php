<?php defined( 'ABSPATH' ) || exit;

$cp   = lamacupa_option( 'color_primary',     '#4A5E1A' );
$cpm  = lamacupa_option( 'color_primary_mid', '#6B7F2A' );
$cg   = lamacupa_option( 'color_gold',        '#C4941A' );
$cc   = lamacupa_option( 'color_cream',       '#F7F3EC' );
$ccd  = lamacupa_option( 'color_cream_dark',  '#EDE8DF' );
$ct   = lamacupa_option( 'color_text',        '#1E1E1E' );
$ctl  = lamacupa_option( 'color_text_light',  '#5A5A5A' );
$fh   = lamacupa_option( 'font_heading',       'Playfair Display' );
$fb   = lamacupa_option( 'font_body',          'Lato' );

// Sanitize hex
$hex = function( $v, $d ) { return preg_match( '/^#[0-9a-fA-F]{3,6}$/', $v ) ? $v : $d; };
$cp  = $hex( $cp,  '#4A5E1A' );
$cpm = $hex( $cpm, '#6B7F2A' );
$cg  = $hex( $cg,  '#C4941A' );
$cc  = $hex( $cc,  '#F7F3EC' );
$ccd = $hex( $ccd, '#EDE8DF' );
$ct  = $hex( $ct,  '#1E1E1E' );
$ctl = $hex( $ctl, '#5A5A5A' );

// Google Fonts
$font_map = [
    'Playfair Display' => 'Playfair+Display:wght@400;700',
    'Cormorant Garamond' => 'Cormorant+Garamond:wght@400;700',
    'Libre Baskerville' => 'Libre+Baskerville:wght@400;700',
    'Lato' => 'Lato:wght@300;400;700',
    'Open Sans' => 'Open+Sans:wght@300;400;700',
    'Raleway' => 'Raleway:wght@300;400;700',
];
$fonts_to_load = [];
if ( isset( $font_map[ $fh ] ) ) $fonts_to_load[] = $font_map[ $fh ];
if ( isset( $font_map[ $fb ] ) && $fb !== $fh ) $fonts_to_load[] = $font_map[ $fb ];
if ( $fonts_to_load ) :
    $gf_url = 'https://fonts.googleapis.com/css2?family=' . implode( '|', $fonts_to_load ) . '&display=swap';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="stylesheet" href="' . esc_url( $gf_url ) . '">' . "\n";
endif;

$fav = lamacupa_option( 'favicon', '' );
if ( $fav ) echo '<link rel="icon" href="' . esc_url( $fav ) . '">' . "\n";

$meta_desc = lamacupa_option( 'meta_description', '' );
if ( $meta_desc && is_front_page() ) echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";

$ga = lamacupa_option( 'ga_id', '' );
if ( $ga ) : ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga ) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config','<?php echo esc_attr( $ga ) ?>');</script>
<?php endif ?>
<style>
:root {
  --color-primary: <?php echo $cp ?>;
  --color-primary-mid: <?php echo $cpm ?>;
  --color-gold: <?php echo $cg ?>;
  --color-cream: <?php echo $cc ?>;
  --color-cream-dark: <?php echo $ccd ?>;
  --color-text: <?php echo $ct ?>;
  --color-text-light: <?php echo $ctl ?>;
  --font-heading: '<?php echo esc_attr( $fh ) ?>', Georgia, serif;
  --font-body: '<?php echo esc_attr( $fb ) ?>', system-ui, sans-serif;
}
</style>
<?php
$head_script = lamacupa_option( 'head_script', '' );
if ( $head_script ) echo wp_kses( $head_script, [ 'script' => [ 'type' => true, 'src' => true, 'async' => true ] ] );
