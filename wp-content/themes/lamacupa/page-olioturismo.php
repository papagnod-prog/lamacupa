<?php get_header() ?>

<div class="page-hero">
  <div class="container">
    <?php lamacupa_breadcrumb() ?>
    <h1>Olioturismo</h1>
    <p style="margin-top:10px;color:var(--color-text-light)">Vivi l'esperienza dell'olio extravergine direttamente in azienda</p>
  </div>
</div>

<section>
  <div class="container">
    <h2 class="section-title fade-in-up">Le Nostre Esperienze</h2>
    <p class="section-subtitle fade-in-up">Scegli l'esperienza che fa per te e prenota la tua visita</p>
    <div class="grid-3">
      <?php
      $exps = [
        [
          'icona'  => '🫒',
          'titolo' => lamacupa_option( 'exp1_titolo', 'Visita Guidata agli Oliveti' ),
          'desc'   => lamacupa_option( 'exp1_desc', 'Passeggiata tra gli ulivi centenari con guida esperta. Scopri le cultivar Coratina e Peranzana, le tecniche di coltivazione biologica e il ciclo produttivo dell\'olio.' ),
          'durata' => lamacupa_option( 'exp1_durata', '2 ore' ),
          'gruppo' => lamacupa_option( 'exp1_gruppo', 'Max 15 persone' ),
          'prezzo' => lamacupa_option( 'exp1_prezzo', '€15 a persona' ),
        ],
        [
          'icona'  => '🍶',
          'titolo' => lamacupa_option( 'exp2_titolo', 'Degustazione Guidata' ),
          'desc'   => lamacupa_option( 'exp2_desc', 'Assaggia i nostri oli extravergini con una guida sensoriale esperta. Impara a riconoscere i profumi, i sapori e le caratteristiche di un olio di alta qualità.' ),
          'durata' => lamacupa_option( 'exp2_durata', '1,5 ore' ),
          'gruppo' => lamacupa_option( 'exp2_gruppo', 'Max 10 persone' ),
          'prezzo' => lamacupa_option( 'exp2_prezzo', '€25 a persona' ),
        ],
        [
          'icona'  => '🌾',
          'titolo' => lamacupa_option( 'exp3_titolo', 'Raccolta delle Olive' ),
          'desc'   => lamacupa_option( 'exp3_desc', 'Vivi in prima persona la raccolta tradizionale delle olive (ottobre–novembre). Un\'esperienza autentica tra i filari, con pranzo in azienda incluso.' ),
          'durata' => lamacupa_option( 'exp3_durata', 'Giornata intera' ),
          'gruppo' => lamacupa_option( 'exp3_gruppo', 'Max 12 persone' ),
          'prezzo' => lamacupa_option( 'exp3_prezzo', '€45 a persona' ),
        ],
      ];
      foreach ( $exps as $exp ) : ?>
        <div class="exp-card fade-in-up">
          <div class="exp-card__header">
            <div style="font-size:2.2rem;margin-bottom:10px"><?php echo $exp['icona'] ?></div>
            <h3><?php echo esc_html( $exp['titolo'] ) ?></h3>
          </div>
          <div class="exp-card__body">
            <p style="color:var(--color-text-light);line-height:1.7;font-size:.92rem"><?php echo esc_html( $exp['desc'] ) ?></p>
            <div class="exp-meta">
              <span>⏱ <?php echo esc_html( $exp['durata'] ) ?></span>
              <span>👥 <?php echo esc_html( $exp['gruppo'] ) ?></span>
              <span>💰 <?php echo esc_html( $exp['prezzo'] ) ?></span>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- PRENOTAZIONE -->
<section style="background:var(--color-cream)">
  <div class="container" style="max-width:680px;text-align:center">
    <span class="eyebrow fade-in-up">Prenota</span>
    <h2 class="fade-in-up" style="font-size:clamp(1.5rem,3vw,2rem);margin-bottom:16px">Vuoi venire a trovarci?</h2>
    <p class="fade-in-up" style="color:var(--color-text-light);margin-bottom:36px">Scrivi per prenotare la tua esperienza o per avere maggiori informazioni. Rispondiamo entro 24 ore.</p>
    <?php
    $cf7_id = lamacupa_option( 'cf7_olioturismo_id', '' );
    if ( $cf7_id && function_exists( 'do_shortcode' ) ) {
        echo do_shortcode( '[contact-form-7 id="' . esc_attr( $cf7_id ) . '" title="Olioturismo"]' );
    } else { ?>
      <form method="post" style="text-align:left;background:#fff;border-radius:var(--radius);padding:32px;box-shadow:var(--shadow-sm)">
        <div class="grid-2" style="margin-bottom:16px">
          <div><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Nome *</label><input type="text" name="nome" required style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit"></div>
          <div><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Email *</label><input type="email" name="email" required style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit"></div>
        </div>
        <div style="margin-bottom:16px"><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Esperienza di interesse</label>
          <select name="esperienza" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit">
            <option>Visita Guidata agli Oliveti</option>
            <option>Degustazione Guidata</option>
            <option>Raccolta delle Olive</option>
          </select>
        </div>
        <div style="margin-bottom:20px"><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Messaggio</label><textarea name="messaggio" rows="4" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;resize:vertical"></textarea></div>
        <button type="submit" class="btn btn--primary btn--lg" style="width:100%;justify-content:center">Invia Richiesta</button>
      </form>
    <?php } ?>
  </div>
</section>

<?php get_footer(); ?>
