<?php defined( 'ABSPATH' ) || exit;
global $product;
if ( ! $product || ! $product->is_visible() ) return;
?>
<div class="product-card" <?php wc_product_class( '', $product ) ?>>
  <a href="<?php the_permalink() ?>" class="product-card__img">
    <?php if ( $product->get_image_id() ) :
      echo $product->get_image( 'product-thumb', [ 'loading' => 'lazy', 'alt' => esc_attr( $product->get_name() ) ] );
    else : ?>
      <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--color-cream);min-height:220px;color:var(--color-text-light)">🫒</div>
    <?php endif ?>
  </a>
  <div class="product-card__body">
    <?php $cats = wc_get_product_category_list( $product->get_id(), ', ' );
    if ( $cats ) echo '<span class="product-card__cat">' . wp_strip_all_tags( $cats ) . '</span>'; ?>
    <h2 class="product-card__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php if ( $desc = $product->get_short_description() ) : ?>
      <p class="product-card__desc"><?php echo wp_strip_all_tags( $desc ) ?></p>
    <?php endif ?>
    <span class="product-card__price"><?php echo $product->get_price_html() ?></span>
    <?php woocommerce_template_loop_add_to_cart() ?>
  </div>
</div>
