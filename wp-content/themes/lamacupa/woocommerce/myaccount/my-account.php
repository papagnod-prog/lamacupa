<?php defined( 'ABSPATH' ) || exit ?>
<div class="page-hero" style="padding-bottom:20px">
  <div class="container"><h1 style="font-size:clamp(1.4rem,3vw,2rem)">Il Mio Account</h1></div>
</div>
<div class="container">
  <?php woocommerce_output_all_notices() ?>
  <?php if ( is_user_logged_in() ) : ?>
    <div class="account-layout">
      <nav class="account-nav">
        <ul>
          <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ) ?>">
              <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ) ?>"><?php echo esc_html( $label ) ?></a>
            </li>
          <?php endforeach ?>
        </ul>
      </nav>
      <div class="account-content">
        <?php do_action( 'woocommerce_account_content' ) ?>
      </div>
    </div>
  <?php else : ?>
    <div style="max-width:480px;margin:40px auto">
      <?php do_action( 'woocommerce_account_content' ) ?>
    </div>
  <?php endif ?>
</div>
