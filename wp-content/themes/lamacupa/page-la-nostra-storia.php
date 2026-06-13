<?php get_header() ?>

<div class="page-hero">
  <div class="container">
    <?php lamacupa_breadcrumb() ?>
    <h1>La Nostra Storia</h1>
  </div>
</div>

<!-- CHI SIAMO -->
<section class="story-section">
  <div class="container">
    <div class="grid-2">
      <div class="fade-in-up">
        <span class="eyebrow">Chi Siamo</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:20px">Una famiglia, una terra, un olio</h2>
        <p style="color:var(--color-text-light);line-height:1.8;margin-bottom:16px">
          <?php echo wp_kses_post( lamacupa_option( 'chisiamo_testo', "L'Azienda Agricola Lamacupa nasce dall'amore profondo per la terra pugliese. Da tre generazioni coltiviamo i nostri oliveti con dedizione, rispetto per la natura e passione per la qualità. Ogni bottiglia racconta la storia di una famiglia che ha fatto dell'olio extravergine d'oliva la propria missione." ) ) ?>
        </p>
        <p style="color:var(--color-text-light);line-height:1.8">
          <?php echo wp_kses_post( lamacupa_option( 'chisiamo_testo2', 'Siamo convinti che la terra vada ascoltata e rispettata. Per questo lavoriamo in modo biologico, senza compromessi, per restituire a tavola tutto il sapore autentico della Puglia.' ) ) ?>
        </p>
      </div>
      <div class="fade-in-up story-img">
        <?php $img = lamacupa_option( 'chisiamo_img', '' ); ?>
        <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ) ?>" alt="La famiglia Lamacupa" loading="lazy">
        <?php else : ?><div style="width:100%;height:100%;background:var(--color-cream-dark);display:flex;align-items:center;justify-content:center;min-height:320px;color:var(--color-text-light)">📷 Foto famiglia</div><?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- LA NOSTRA TERRA -->
<section class="story-section" style="background:var(--color-cream)">
  <div class="container">
    <div class="grid-2">
      <div class="fade-in-up story-img" style="order:0">
        <?php $img2 = lamacupa_option( 'terra_img', '' ); ?>
        <?php if ( $img2 ) : ?><img src="<?php echo esc_url( $img2 ) ?>" alt="Gli oliveti di Lamacupa" loading="lazy">
        <?php else : ?><div style="width:100%;height:100%;background:var(--color-cream-dark);display:flex;align-items:center;justify-content:center;min-height:320px;color:var(--color-text-light)">📷 Foto oliveto</div><?php endif ?>
      </div>
      <div class="fade-in-up" style="order:1">
        <span class="eyebrow">La Nostra Terra</span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:20px">Il cuore verde della Puglia</h2>
        <p style="color:var(--color-text-light);line-height:1.8;margin-bottom:16px">
          <?php echo wp_kses_post( lamacupa_option( 'terra_testo', 'I nostri oliveti si estendono nel cuore della Puglia, su terreni argillosi e calcarei che conferiscono all\'olio le sue caratteristiche uniche. Coltiviamo principalmente la cultivar Coratina, nota per la sua robustezza, l\'alto contenuto di polifenoli e il sapore deciso e fruttato.' ) ) ?>
        </p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px">
          <?php
          $stats = [
            [ 'n' => lamacupa_option( 'terra_ettari', '50' ),    'l' => 'Ettari coltivati' ],
            [ 'n' => lamacupa_option( 'terra_ulivi', '3.000' ),  'l' => 'Ulivi centenari' ],
            [ 'n' => lamacupa_option( 'terra_cultivar', '2' ),   'l' => 'Cultivar certificate' ],
            [ 'n' => lamacupa_option( 'terra_anni', '30+' ),     'l' => 'Anni di esperienza' ],
          ];
          foreach ( $stats as $s ) : ?>
            <div style="text-align:center;background:#fff;border-radius:var(--radius);padding:20px">
              <div style="font-family:var(--font-heading);font-size:1.8rem;color:var(--color-primary);font-weight:700"><?php echo esc_html( $s['n'] ) ?></div>
              <div style="font-size:.82rem;color:var(--color-text-light);margin-top:4px"><?php echo esc_html( $s['l'] ) ?></div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GLI ORCI -->
<section class="story-section">
  <div class="container">
    <div style="max-width:760px;margin:0 auto;text-align:center">
      <span class="eyebrow fade-in-up">La Tradizione</span>
      <h2 class="fade-in-up" style="font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:20px">Gli Orci: la conservazione millenaria</h2>
      <p class="fade-in-up" style="color:var(--color-text-light);line-height:1.8;margin-bottom:16px">
        <?php echo wp_kses_post( lamacupa_option( 'orci_testo', "Una delle pratiche che ci distingue è la conservazione dell'olio nei tradizionali orci di terracotta. Questa tecnica millenaria, tramandata di generazione in generazione, permette all'olio di mantenersi al riparo dalla luce e dall'ossidazione, preservandone intatte tutte le qualità organolettiche." ) ) ?>
      </p>
      <p class="fade-in-up" style="color:var(--color-text-light);line-height:1.8">
        <?php echo wp_kses_post( lamacupa_option( 'orci_testo2', "Gli orci vengono lavati, asciugati e preparati con cura prima di ogni frangitura. L'olio appena estratto viene posto negli orci dove riposerà, sviluppando la sua struttura aromatica complessa." ) ) ?>
      </p>
    </div>
  </div>
</section>

<!-- PREMI -->
<section class="story-section" style="background:var(--color-cream)">
  <div class="container">
    <span class="eyebrow fade-in-up" style="text-align:center;display:block">Riconoscimenti</span>
    <h2 class="section-title fade-in-up">Premi & Certificazioni</h2>
    <div class="awards-grid">
      <?php
      $awards = [
        [ 'anno' => lamacupa_option('premio1_anno','2023'), 'titolo' => lamacupa_option('premio1_titolo','Sol d\'Oro — Medaglia d\'Oro'), 'desc' => lamacupa_option('premio1_desc','Categoria Fruttato Medio Intenso') ],
        [ 'anno' => lamacupa_option('premio2_anno','2022'), 'titolo' => lamacupa_option('premio2_titolo','Flos Olei — Top 20 World'), 'desc' => lamacupa_option('premio2_desc','Guida internazionale degli oli d\'oliva') ],
        [ 'anno' => lamacupa_option('premio3_anno','2022'), 'titolo' => lamacupa_option('premio3_titolo','Leone d\'Oro — Vinitaly'), 'desc' => lamacupa_option('premio3_desc','Miglior olio biologico') ],
        [ 'anno' => lamacupa_option('premio4_anno','2021'), 'titolo' => lamacupa_option('premio4_titolo','Gambero Rosso — 3 Foglie'), 'desc' => lamacupa_option('premio4_desc','Massimo riconoscimento guida italiana') ],
      ];
      foreach ( $awards as $a ) : ?>
        <div class="award-card fade-in-up">
          <div style="font-size:2rem;margin-bottom:10px">🏆</div>
          <div class="award-year"><?php echo esc_html( $a['anno'] ) ?></div>
          <h3><?php echo esc_html( $a['titolo'] ) ?></h3>
          <p><?php echo esc_html( $a['desc'] ) ?></p>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
