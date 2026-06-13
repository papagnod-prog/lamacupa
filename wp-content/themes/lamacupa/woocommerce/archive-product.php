<?php defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>
<div class="page-hero" style="padding-bottom:20px">
  <div class="container">
    <?php lamacupa_breadcrumb() ?>
    <h1 style="font-size:clamp(1.4rem,3vw,2rem)">
      <?php if ( is_search() ) : printf( 'Risultati per: "%s"', get_search_query() );
      elseif ( is_product_category() || is_product_tag() ) : echo woocommerce_page_title( false );
      else : esc_html_e( 'I Nostri Prodotti', 'lamacupa' ); endif ?>
    </h1>
  </div>
</div>

<!-- Category filter -->
<?php if ( ! is_search() ) : ?>
<div class="shop-filters">
  <div class="container">
    <div class="filter-pills">
      <span class="filter-label">Filtra:</span>
      <?php
      $cur  = get_query_var( 'product_cat' );
      $url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
      $cls  = empty( $cur ) ? 'btn--primary' : 'btn--outline';
      printf( '<a href="%s" class="btn btn--xs %s">Tutti</a>', esc_url( $url ), esc_attr( $cls ) );
      $cats = get_terms( [ 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => 0, 'orderby' => 'menu_order', 'exclude' => get_option( 'default_product_cat', 0 ) ] );
      if ( $cats && ! is_wp_error( $cats ) ) {
          foreach ( $cats as $cat ) {
              $active = $cur === $cat->slug ? 'btn--primary' : 'btn--outline';
              printf( '<a href="%s" class="btn btn--xs %s">%s</a>', esc_url( get_term_link( $cat ) ), esc_attr( $active ), esc_html( $cat->name ) );
          }
      }
      ?>
    </div>
  </div>
</div>
<?php endif ?>

<div class="container" style="padding-top:28px;padding-bottom:80px">
  <div class="shop-toolbar">
    <?php woocommerce_result_count(); woocommerce_catalog_ordering(); ?>
  </div>
  <?php woocommerce_output_all_notices();
  if ( woocommerce_product_loop() ) :
    do_action( 'woocommerce_before_shop_loop' );
    woocommerce_product_loop_start();
    if ( wc_get_loop_prop( 'total' ) ) :
      while ( have_posts() ) : the_post();
        do_action( 'woocommerce_shop_loop' );
        wc_get_template_part( 'content', 'product' );
      endwhile;
    endif;
    woocommerce_product_loop_end();
    do_action( 'woocommerce_after_shop_loop' );
  else :
    do_action( 'woocommerce_no_products_found' );
  endif ?>
</div>

<?php do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' )
;
