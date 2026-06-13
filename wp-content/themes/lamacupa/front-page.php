<?php get_header() ?>

<!-- HERO -->
<?php
$hero_bg  = lamacupa_option( 'hero_bg', '' );
$hero_style = $hero_bg ? ' style="background-image:url(' . esc_url( $hero_bg ) . ')"' : '';
?>
<section class="hero"<?php echo $hero_style; ?>>
  <div class="hero__overlay"></div>
  <div class="hero__content container">
    <span class="eyebrow">Azienda Agricola dal <?php echo esc_html( lamacupa_option( 'anno_fondazione', '1990' ) ) ?></span>
    <h1 class="hero__title">
      <?php echo esc_html( lamacupa_option( 'hero_titolo', "L'Oro Verde di Puglia" ) ) ?><br>
      <em><?php echo esc_html( lamacupa_option( 'hero_sottotitolo', 'Olio Extravergine di Oliva Biologico' ) ) ?></em>
    </h1>
    <p class="hero__desc"><?php echo esc_html( lamacupa_option( 'hero_desc', 'Cultivar Coratina e Peranzana. Raccolta manuale. Molita a freddo. Il meglio della Puglia, direttamente a casa tua.' ) ) ?></p>
    <div class="hero__ctas">
      <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) ?>" class="btn btn--primary btn--lg">
          <?php echo esc_html( lamacupa_option( 'hero_cta1', 'Acquista Ora' ) ) ?>
        </a>
      <?php endif ?>
      <a href="<?php echo esc_url( home_url( '/la-nostra-storia/' ) ) ?>" class="btn btn--ghost btn--lg">
        <?php echo esc_html( lamacupa_option( 'hero_cta2', 'Scopri la Nostra Storia' ) ) ?>
      </a>
    </div>
  </div>
</section>

<!-- USP STRIP -->
<div class="usp-strip">
  <div class="container">
    <div class="grid-4">
      <?php
      $usps = [
        [ 'icon' => '🌿', 'text' => lamacupa_option( 'usp1', 'Biologico Certificato' ) ],
        [ 'icon' => '🏆', 'text' => lamacupa_option( 'usp2', 'Pluripremiato' ) ],
        [ 'icon' => '🚚', 'text' => lamacupa_option( 'usp3', 'Spedizione 24/48h' ) ],
        [ 'icon' => '♻️', 'text' => lamacupa_option( 'usp4', 'Packaging Sostenibile' ) ],
      ];
      foreach ( $usps as $usp ) : ?>
        <div class="usp-item">
          <span class="usp-icon"><?php echo $usp['icon'] ?></span>
          <span><?php echo esc_html( $usp['text'] ) ?></span>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<!-- PRODOTTI IN EVIDENZA -->
<section style="background:#fff">
  <div class="container">
    <h2 class="section-title fade-in-up">I Nostri Oli</h2>
    <p class="section-subtitle fade-in-up">Selezionati, moliti a freddo, consegnati a casa tua</p>
    <?php echo do_shortcode( '[featured_products limit="4" columns="4"]' ) ?>
    <div style="text-align:center;margin-top:40px">
      <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) ?>" class="btn btn--outline btn--lg">Vedi Tutti i Prodotti</a>
      <?php endif ?>
    </div>
  </div>
</section>

<!-- BRAND STORY TEASER -->
<section style="background:var(--color-cream)">
  <div class="container">
    <div class="grid-2">
      <div class="fade-in-up">
        <span class="eyebrow">La Nostra Storia</span>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.4rem);margin-bottom:20px">Tre generazioni di passione per l'olivo</h2>
        <p style="color:var(--color-text-light);line-height:1.8;margin-bottom:12px">
          <?php echo esc_html( lamacupa_option( 'storia_testo', "L'Azienda Agricola Lamacupa nasce dall'amore per la terra pugliese e per le sue cultivar millenarie. Coltiviamo Coratina e Peranzana secondo i princìpi dell'agricoltura biologica, rispettando i ritmi della natura." ) ) ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/la-nostra-storia/' ) ) ?>" class="btn btn--outline" style="margin-top:16px">Scopri di Più</a>
      </div>
      <div class="fade-in-up story-img">
        <?php $img = lamacupa_option( 'storia_img', '' ); ?>
        <?php if ( $img ) : ?>
          <img src="<?php echo esc_url( $img ) ?>" alt="Oliveto Lamacupa" loading="lazy">
        <?php else : ?>
          <div style="width:100%;height:100%;background:var(--color-cream-dark);display:flex;align-items:center;justify-content:center;min-height:300px;color:var(--color-text-light);font-size:.9rem">📷 Immagine oliveto</div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- BESTSELLER -->
<section style="background:#fff">
  <div class="container">
    <h2 class="section-title fade-in-up">I Più Venduti</h2>
    <?php echo do_shortcode( '[best_selling_products limit="3" columns="3"]' ) ?>
  </div>
</section>

<!-- OLIOTURISMO TEASER -->
<section style="background:#1a1a0e;color:#fff;text-align:center;position:relative;overflow:hidden">
  <?php $ot_img = lamacupa_option( 'olioturismo_hero_img', '' ); ?>
  <?php if ( $ot_img ) : ?>
    <div style="position:absolute;inset:0;background-image:url(<?php echo esc_url( $ot_img ) ?>);background-size:cover;background-position:center;opacity:.35"></div>
  <?php endif ?>
  <div class="container" style="position:relative;z-index:1">
    <span class="eyebrow" style="color:var(--color-gold)">Esperienze</span>
    <h2 style="font-size:clamp(1.8rem,4vw,3rem);margin:12px 0 20px">Vivi l'Esperienza dell'Olio</h2>
    <p style="max-width:560px;margin:0 auto 36px;opacity:.8;line-height:1.7">Visite guidate agli oliveti, degustazioni guidate e raccolta delle olive. Scopri la nostra terra in prima persona.</p>
    <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ) ?>" class="btn btn--primary btn--lg">Prenota una Visita</a>
  </div>
</section>

<!-- TRUST STRIP -->
<div class="trust-strip" style="background:#fff">
  <div class="container">
    <div class="trust-badges">
      <div class="trust-badge"><span class="icon">🔒</span><span>Pagamento Sicuro SSL</span></div>
      <div class="trust-badge"><span class="icon">🚚</span><span>Spedizione in tutta Italia e Europa</span></div>
      <div class="trust-badge"><span class="icon">⭐</span><span>Qualità Certificata</span></div>
      <div class="trust-badge"><span class="icon">↩️</span><span>Reso Facile 14 Giorni</span></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
