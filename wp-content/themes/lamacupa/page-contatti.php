<?php get_header() ?>

<div class="page-hero">
  <div class="container">
    <?php lamacupa_breadcrumb() ?>
    <h1>Contatti</h1>
  </div>
</div>

<section>
  <div class="container">
    <div class="grid-2" style="align-items:start;gap:56px">

      <!-- FORM -->
      <div>
        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px">Scrivici</h2>
        <?php
        $cf7 = lamacupa_option( 'cf7_contatti_id', '' );
        if ( $cf7 && function_exists( 'do_shortcode' ) ) {
            echo do_shortcode( '[contact-form-7 id="' . esc_attr( $cf7 ) . '" title="Contatti"]' );
        } else { ?>
          <form method="post">
            <div class="grid-2" style="margin-bottom:16px">
              <div><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Nome</label><input type="text" name="nome" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit"></div>
              <div><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Email</label><input type="email" name="email" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit"></div>
            </div>
            <div style="margin-bottom:16px"><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Oggetto</label><input type="text" name="oggetto" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit"></div>
            <div style="margin-bottom:20px"><label style="font-size:.85rem;font-weight:700;display:block;margin-bottom:5px">Messaggio</label><textarea name="messaggio" rows="5" style="width:100%;padding:10px 14px;border:1px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;resize:vertical"></textarea></div>
            <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center">Invia Messaggio</button>
          </form>
        <?php } ?>
      </div>

      <!-- INFO -->
      <div>
        <h2 style="font-family:var(--font-heading);font-size:1.4rem;margin-bottom:24px">Dove Siamo</h2>
        <div style="display:flex;flex-direction:column;gap:20px">
          <div style="display:flex;gap:14px">
            <span style="font-size:1.4rem;flex-shrink:0">📍</span>
            <div>
              <strong style="display:block;margin-bottom:3px">Indirizzo</strong>
              <span style="color:var(--color-text-light)"><?php echo esc_html( lamacupa_option( 'indirizzo', 'Via Lamacupa — Contrada Lamacupa' ) ) ?><br>
              <?php echo esc_html( lamacupa_option( 'cap', '70020' ) ) ?> <?php echo esc_html( lamacupa_option( 'citta', 'Cassano delle Murge' ) ) ?> (<?php echo esc_html( lamacupa_option( 'provincia', 'BA' ) ) ?>)</span>
            </div>
          </div>
          <div style="display:flex;gap:14px">
            <span style="font-size:1.4rem;flex-shrink:0">📞</span>
            <div>
              <strong style="display:block;margin-bottom:3px">Telefono</strong>
              <a href="tel:<?php echo esc_attr( lamacupa_option( 'telefono', '' ) ) ?>" style="color:var(--color-primary)"><?php echo esc_html( lamacupa_option( 'telefono', '+39 080 000 0000' ) ) ?></a>
            </div>
          </div>
          <div style="display:flex;gap:14px">
            <span style="font-size:1.4rem;flex-shrink:0">✉️</span>
            <div>
              <strong style="display:block;margin-bottom:3px">Email</strong>
              <a href="mailto:<?php echo esc_attr( lamacupa_option( 'email', '' ) ) ?>" style="color:var(--color-primary)"><?php echo esc_html( lamacupa_option( 'email', 'info@lamacupa.it' ) ) ?></a>
            </div>
          </div>
          <div style="display:flex;gap:14px">
            <span style="font-size:1.4rem;flex-shrink:0">🕐</span>
            <div>
              <strong style="display:block;margin-bottom:8px">Orari</strong>
              <table style="font-size:.88rem;color:var(--color-text-light);border-collapse:collapse">
                <tr><td style="padding:3px 24px 3px 0">Lun – Ven</td><td><?php echo esc_html( lamacupa_option( 'orari_lv', '9:00 – 13:00 / 15:00 – 18:00' ) ) ?></td></tr>
                <tr><td style="padding:3px 24px 3px 0">Sabato</td><td><?php echo esc_html( lamacupa_option( 'orari_sab', '9:00 – 13:00' ) ) ?></td></tr>
                <tr><td style="padding:3px 24px 3px 0">Domenica</td><td><?php echo esc_html( lamacupa_option( 'orari_dom', 'Solo su appuntamento' ) ) ?></td></tr>
              </table>
            </div>
          </div>
        </div>

        <?php $maps = lamacupa_option( 'maps_embed_url', '' ); if ( $maps ) : ?>
          <div style="margin-top:28px;border-radius:var(--radius);overflow:hidden">
            <iframe src="<?php echo esc_url( $maps ) ?>" width="100%" height="260" style="border:0;display:block" allowfullscreen loading="lazy"></iframe>
          </div>
        <?php else : ?>
          <div style="margin-top:28px;background:var(--color-cream);border-radius:var(--radius);height:200px;display:flex;align-items:center;justify-content:center;color:var(--color-text-light);font-size:.88rem">Configura il link Google Maps dal pannello Lamacupa Options → Contatti</div>
        <?php endif ?>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
