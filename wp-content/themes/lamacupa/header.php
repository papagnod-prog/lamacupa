<?php
/**
 * Header template
 * @package Lamacupa
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <div class="container header-inner">
    <div class="header-logo">
      <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-name">
          <?php bloginfo('name'); ?>
        </a>
      <?php endif; ?>
    </div>

    <nav class="header-nav" aria-label="<?php esc_attr_e('Menu principale', 'lamacupa'); ?>">
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'nav-list',
        'fallback_cb'    => '__return_false',
      ]); ?>
    </nav>

    <div class="header-actions">
      <?php if ( class_exists('WooCommerce') ) : ?>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon" aria-label="<?php esc_attr_e('Carrello', 'lamacupa'); ?>">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <?php $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
          <span class="cart-count<?php echo $count ? '' : ' cart-count--empty'; ?>"><?php echo esc_html($count); ?></span>
        </a>
      <?php endif; ?>

      <button class="hamburger" id="hamburger" aria-label="<?php esc_attr_e('Apri menu', 'lamacupa'); ?>" aria-expanded="false" aria-controls="mobile-menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<div class="mobile-menu-overlay" id="mobile-menu" aria-hidden="true">
  <button class="mobile-menu-close" id="mobile-menu-close" aria-label="<?php esc_attr_e('Chiudi menu', 'lamacupa'); ?>">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
      <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </svg>
  </button>
  <?php wp_nav_menu([
    'theme_location' => 'primary',
    'container'      => 'nav',
    'container_class'=> 'mobile-nav',
    'menu_class'     => 'mobile-nav-list',
    'fallback_cb'    => '__return_false',
  ]); ?>
</div>

<div class="site-content">
