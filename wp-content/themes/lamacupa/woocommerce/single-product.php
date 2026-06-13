<?php defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>
<div style="background:var(--color-cream-dark);padding:calc(var(--nav-height) + 14px) 0 14px">
  <div class="container"><?php lamacupa_breadcrumb() ?></div>
</div>
<div class="container">
  <?php woocommerce_output_all_notices() ?>
  <?php while ( have_posts() ) : the_post() ?>
    <?php global $product ?>
    <div class="single-product-layout">
      <!-- Gallery -->
      <div class="product-gallery">
        <div class="main-image">
          <?php
          $img_id  = $product->get_image_id();
          $img_src = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : wc_placeholder_img_src();
          ?>
          <img id="main-product-img" src="<?php echo esc_url( $img_src ) ?>" alt="<?php echo esc_attr( $product->get_name() ) ?>" loading="lazy">
        </div>
        <?php $gallery = $product->get_gallery_image_ids(); if ( $gallery ) : ?>
          <div class="thumbs">
            <?php if ( $img_id ) : ?>
              <img class="gallery-thumb active" src="<?php echo esc_url( wp_get_attachment_image_url( $img_id, 'thumbnail' ) ) ?>" data-full="<?php echo esc_url( $img_src ) ?>" alt="" onclick="document.getElementById('main-product-img').src=this.dataset.full;document.querySelectorAll('.gallery-thumb').forEach(function(t){t.classList.remove('active')});this.classList.add('active')">
            <?php endif ?>
            <?php foreach ( $gallery as $gid ) :
              $tsrc = wp_get_attachment_image_url( $gid, 'thumbnail' );
              $fsrc = wp_get_attachment_image_url( $gid, 'large' ); ?>
              <img class="gallery-thumb" src="<?php echo esc_url( $tsrc ) ?>" data-full="<?php echo esc_url( $fsrc ) ?>" alt="" onclick="document.getElementById('main-product-img').src=this.dataset.full;document.querySelectorAll('.gallery-thumb').forEach(function(t){t.classList.remove('active')});this.classList.add('active')">
            <?php endforeach ?>
          </div>
        <?php endif ?>
      </div>

      <!-- Info -->
      <div class="product-info">
        <?php $cats = wc_get_product_category_list( $product->get_id() );
        if ( $cats ) echo '<span class="product-cat-badge">' . wp_strip_all_tags( $cats ) . '</span>'; ?>
        <h1><?php the_title() ?></h1>
        <?php if ( function_exists( 'woocommerce_template_single_rating' ) ) woocommerce_template_single_rating() ?>
        <span class="price"><?php echo $product->get_price_html() ?></span>
        <?php if ( $short = $product->get_short_description() ) : ?>
          <div class="short-desc"><?php echo wp_kses_post( $short ) ?></div>
        <?php endif ?>
        <?php woocommerce_template_single_add_to_cart() ?>
        <div class="product-trust">
          <span>🔒 Pagamento sicuro</span>
          <span>🚚 Spedizione 24/48h</span>
          <span>↩️ Reso 14 giorni</span>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="product-tabs" style="padding-bottom:80px">
      <div class="tabs-nav">
        <button class="tab-btn active" data-tab="tab-desc">Descrizione</button>
        <button class="tab-btn" data-tab="tab-info">Scheda Tecnica</button>
        <?php if ( comments_open() ) : ?>
          <button class="tab-btn" data-tab="tab-reviews">Recensioni (<?php echo $product->get_review_count() ?>)</button>
        <?php endif ?>
      </div>
      <div id="tab-desc" class="tab-panel active" style="line-height:1.8;color:var(--color-text-light)"><?php the_content() ?></div>
      <div id="tab-info" class="tab-panel">
        <?php wc_display_product_attributes( $product ) ?>
      </div>
      <?php if ( comments_open() ) : ?>
        <div id="tab-reviews" class="tab-panel"><?php comments_template() ?></div>
      <?php endif ?>
    </div>

    <!-- Related -->
    <?php
    $related = wc_get_related_products( $product->get_id(), 4 );
    if ( $related ) :
      $args = [ 'post_type' => 'product', 'post__in' => $related, 'posts_per_page' => 4 ];
      $q = new WP_Query( $args );
      if ( $q->have_posts() ) : ?>
        <section style="padding-bottom:80px">
          <h2 class="section-title" style="margin-bottom:32px">Potrebbero Interessarti</h2>
          <div class="grid-4">
            <?php while ( $q->have_posts() ) : $q->the_post(); global $product; $product = wc_get_product( get_the_ID() );
            wc_get_template_part( 'content', 'product' );
            endwhile; wp_reset_postdata() ?>
          </div>
        </section>
      <?php endif ?>
    <?php endif ?>
  <?php endwhile ?>
</div>

<?php do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' )
;
