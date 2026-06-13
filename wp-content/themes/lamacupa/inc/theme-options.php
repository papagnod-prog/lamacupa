<?php defined( 'ABSPATH' ) || exit;

/* ── Admin menu ─────────────────────────────────────────────────── */
add_action( 'admin_menu', function () {
    add_theme_page( 'Lamacupa Options', 'Lamacupa Options', 'manage_options', 'lamacupa-options', 'lamacupa_options_page' );
} );

/* ── Save ───────────────────────────────────────────────────────── */
add_action( 'admin_post_lamacupa_save_options', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Non autorizzato' );
    check_admin_referer( 'lamacupa_options_save' );
    $raw  = isset( $_POST['lamacupa'] ) ? $_POST['lamacupa'] : [];
    $opts = [];
    $text_fields = [ 'ragione_sociale','piva','indirizzo','cap','citta','provincia','telefono','email','whatsapp','anno_fondazione',
        'hero_titolo','hero_sottotitolo','hero_desc','hero_cta1','hero_cta2','hero_bg',
        'usp1','usp2','usp3','usp4','storia_img','storia_testo','storia_testo2',
        'chisiamo_img','chisiamo_testo','chisiamo_testo2','terra_img','terra_testo',
        'terra_ettari','terra_ulivi','terra_cultivar','terra_anni',
        'orci_testo','orci_testo2',
        'premio1_anno','premio1_titolo','premio1_desc','premio2_anno','premio2_titolo','premio2_desc',
        'premio3_anno','premio3_titolo','premio3_desc','premio4_anno','premio4_titolo','premio4_desc',
        'exp1_titolo','exp1_desc','exp1_durata','exp1_gruppo','exp1_prezzo',
        'exp2_titolo','exp2_desc','exp2_durata','exp2_gruppo','exp2_prezzo',
        'exp3_titolo','exp3_desc','exp3_durata','exp3_gruppo','exp3_prezzo',
        'olioturismo_hero_img','cf7_olioturismo_id','cf7_contatti_id',
        'maps_embed_url','orari_lv','orari_sab','orari_dom',
        'instagram','facebook','youtube','meta_description','ga_id',
        'logo','logo_footer','favicon','og_image','descrizione_breve',
        'color_primary','color_primary_mid','color_gold','color_cream','color_cream_dark','color_text','color_text_light',
        'font_heading','font_body',
        'stripe_pubkey','stripe_seckey','paypal_email','bonifico_iban','bonifico_intestatario','bonifico_causale',
    ];
    foreach ( $text_fields as $f ) {
        if ( isset( $raw[ $f ] ) ) $opts[ $f ] = sanitize_text_field( $raw[ $f ] );
    }
    $url_fields = [ 'hero_bg','storia_img','chisiamo_img','terra_img','olioturismo_hero_img','logo','logo_footer','favicon','og_image','maps_embed_url' ];
    foreach ( $url_fields as $f ) {
        if ( isset( $raw[ $f ] ) ) $opts[ $f ] = esc_url_raw( $raw[ $f ] );
    }
    $textarea_fields = [ 'descrizione_breve','storia_testo','storia_testo2','chisiamo_testo','chisiamo_testo2','terra_testo','orci_testo','orci_testo2','head_script','foot_script' ];
    foreach ( $textarea_fields as $f ) {
        if ( isset( $raw[ $f ] ) ) $opts[ $f ] = wp_kses_post( $raw[ $f ] );
    }
    $bool_fields = [ 'stripe_enabled','stripe_test','paypal_enabled','bonifico_enabled','contrassegno_enabled' ];
    foreach ( $bool_fields as $f ) $opts[ $f ] = isset( $raw[ $f ] ) ? '1' : '0';
    update_option( 'lamacupa_options', $opts );
    wp_redirect( admin_url( 'themes.php?page=lamacupa-options&saved=1' ) );
    exit;
} );

/* ── Render page ────────────────────────────────────────────────── */
function lamacupa_options_page() {
    $tabs = [
        'azienda'    => '🏢 Azienda',
        'identita'   => '🎨 Identità',
        'home'       => '🏠 Homepage',
        'storia'     => '📖 La Nostra Storia',
        'oliotur'    => '🫒 Olioturismo',
        'contatti'   => '📍 Contatti',
        'seo'        => '🔍 Social & SEO',
        'pagamenti'  => '💳 Pagamenti',
    ];
    $active = isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $tabs ) ? sanitize_key( $_GET['tab'] ) : 'azienda';
    if ( isset( $_GET['saved'] ) ) echo '<div class="notice notice-success is-dismissible"><p>✅ Opzioni salvate!</p></div>';
    ?>
    <div class="wrap">
      <h1 style="margin-bottom:16px">⚙️ Lamacupa Options</h1>
      <nav class="nav-tab-wrapper">
        <?php foreach ( $tabs as $slug => $label ) :
            $url = admin_url( 'themes.php?page=lamacupa-options&tab=' . $slug );
            $cls = $slug === $active ? 'nav-tab nav-tab-active' : 'nav-tab'; ?>
            <a href="<?php echo esc_url( $url ) ?>" class="<?php echo $cls ?>"><?php echo esc_html( $label ) ?></a>
        <?php endforeach ?>
      </nav>
      <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ) ?>" style="margin-top:24px">
        <input type="hidden" name="action" value="lamacupa_save_options">
        <?php wp_nonce_field( 'lamacupa_options_save' ) ?>
        <?php lamacupa_options_tab( $active ) ?>
        <p style="margin-top:24px"><input type="submit" class="button button-primary button-large" value="💾 Salva Opzioni"></p>
      </form>
    </div>
    <?php
}

/* ── Field helpers ──────────────────────────────────────────────── */
function lm_field( $label, $key, $type = 'text', $placeholder = '', $note = '' ) {
    $val = lamacupa_option( $key, '' );
    echo '<tr><th scope="row"><label for="lm_' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';
    if ( $type === 'textarea' ) {
        echo '<textarea name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '" rows="3" class="large-text">' . esc_textarea( $val ) . '</textarea>';
    } elseif ( $type === 'color' ) {
        echo '<input type="color" name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '" value="' . esc_attr( $val ?: $placeholder ) . '" style="width:60px;height:36px;padding:2px;border:1px solid #ddd;border-radius:4px">';
    } elseif ( $type === 'image' ) {
        echo '<div style="display:flex;gap:12px;align-items:center">';
        echo '<input type="url" name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="' . esc_attr( $placeholder ) . '">';
        echo '<button type="button" class="button lm-upload-btn" data-target="lm_' . esc_attr( $key ) . '">Scegli immagine</button>';
        if ( $val ) echo '<img src="' . esc_url( $val ) . '" style="max-height:50px;border-radius:3px">';
        echo '</div>';
    } elseif ( $type === 'checkbox' ) {
        $checked = checked( lamacupa_option( $key ), '1', false );
        echo '<input type="checkbox" name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '" value="1" ' . $checked . '>';
    } elseif ( $type === 'font' ) {
        $fonts = [ 'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Lato', 'Open Sans', 'Raleway' ];
        echo '<select name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '">';
        foreach ( $fonts as $f ) echo '<option value="' . esc_attr( $f ) . '" ' . selected( $val, $f, false ) . '>' . esc_html( $f ) . '</option>';
        echo '</select>';
    } else {
        echo '<input type="' . esc_attr( $type ) . '" name="lamacupa[' . esc_attr( $key ) . ']" id="lm_' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="' . esc_attr( $placeholder ) . '">';
    }
    if ( $note ) echo '<p class="description">' . esc_html( $note ) . '</p>';
    echo '</td></tr>';
}

function lm_section( $title ) {
    echo '<tr><td colspan="2"><h3 style="border-bottom:1px solid #ddd;padding-bottom:8px;margin-top:20px">' . esc_html( $title ) . '</h3></td></tr>';
}

/* ── Tab content ────────────────────────────────────────────────── */
function lamacupa_options_tab( $tab ) {
    echo '<table class="form-table"><tbody>';
    switch ( $tab ) {
        case 'azienda':
            lm_field( 'Ragione Sociale', 'ragione_sociale', 'text', 'Azienda Agricola Lamacupa' );
            lm_field( 'Partita IVA', 'piva', 'text', 'IT00000000000' );
            lm_field( 'Indirizzo', 'indirizzo', 'text', 'Via Lamacupa, Contrada Lamacupa' );
            lm_field( 'CAP', 'cap', 'text', '70020' );
            lm_field( 'Città', 'citta', 'text', 'Cassano delle Murge' );
            lm_field( 'Provincia', 'provincia', 'text', 'BA' );
            lm_field( 'Telefono', 'telefono', 'tel', '+39 080 000 0000' );
            lm_field( 'Email', 'email', 'email', 'info@lamacupa.it' );
            lm_field( 'WhatsApp', 'whatsapp', 'text', '+39 000 000 0000' );
            lm_field( 'Anno Fondazione', 'anno_fondazione', 'text', '1990' );
            lm_field( 'Descrizione breve (footer)', 'descrizione_breve', 'textarea' );
            break;

        case 'identita':
            lm_field( 'Logo principale', 'logo', 'image', 'URL del logo' );
            lm_field( 'Logo footer', 'logo_footer', 'image', 'URL logo footer (bianco)' );
            lm_field( 'Favicon', 'favicon', 'image', 'URL favicon 32x32' );
            lm_section( 'Colori' );
            lm_field( 'Colore primario', 'color_primary', 'color', '#4A5E1A' );
            lm_field( 'Colore primario chiaro', 'color_primary_mid', 'color', '#6B7F2A' );
            lm_field( 'Colore oro/gold', 'color_gold', 'color', '#C4941A' );
            lm_field( 'Sfondo crema', 'color_cream', 'color', '#F7F3EC' );
            lm_field( 'Sfondo crema scuro', 'color_cream_dark', 'color', '#EDE8DF' );
            lm_field( 'Testo principale', 'color_text', 'color', '#1E1E1E' );
            lm_field( 'Testo secondario', 'color_text_light', 'color', '#5A5A5A' );
            lm_section( 'Font' );
            lm_field( 'Font titoli', 'font_heading', 'font' );
            lm_field( 'Font corpo', 'font_body', 'font' );
            break;

        case 'home':
            lm_section( 'Hero' );
            lm_field( 'Immagine di sfondo hero', 'hero_bg', 'image', 'URL immagine hero' );
            lm_field( 'Titolo hero', 'hero_titolo', 'text', "L'Oro Verde di Puglia" );
            lm_field( 'Sottotitolo hero', 'hero_sottotitolo', 'text', 'Olio Extravergine di Oliva Biologico' );
            lm_field( 'Descrizione hero', 'hero_desc', 'textarea' );
            lm_field( 'Testo CTA principale', 'hero_cta1', 'text', 'Acquista Ora' );
            lm_field( 'Testo CTA secondario', 'hero_cta2', 'text', 'Scopri la Nostra Storia' );
            lm_section( 'USP Strip' );
            lm_field( 'USP 1', 'usp1', 'text', 'Biologico Certificato' );
            lm_field( 'USP 2', 'usp2', 'text', 'Pluripremiato' );
            lm_field( 'USP 3', 'usp3', 'text', 'Spedizione 24/48h' );
            lm_field( 'USP 4', 'usp4', 'text', 'Packaging Sostenibile' );
            lm_section( 'Sezione Storia (teaser)' );
            lm_field( 'Immagine storia', 'storia_img', 'image' );
            lm_field( 'Testo storia (teaser)', 'storia_testo', 'textarea' );
            lm_section( 'Olioturismo (teaser)' );
            lm_field( 'Immagine sfondo olioturismo', 'olioturismo_hero_img', 'image' );
            break;

        case 'storia':
            lm_section( 'Chi Siamo' );
            lm_field( 'Immagine Chi Siamo', 'chisiamo_img', 'image' );
            lm_field( 'Testo paragrafo 1', 'chisiamo_testo', 'textarea' );
            lm_field( 'Testo paragrafo 2', 'chisiamo_testo2', 'textarea' );
            lm_section( 'La Nostra Terra' );
            lm_field( 'Immagine La Nostra Terra', 'terra_img', 'image' );
            lm_field( 'Testo La Nostra Terra', 'terra_testo', 'textarea' );
            lm_field( 'Ettari coltivati', 'terra_ettari', 'text', '50' );
            lm_field( 'Numero ulivi', 'terra_ulivi', 'text', '3.000' );
            lm_field( 'Numero cultivar', 'terra_cultivar', 'text', '2' );
            lm_field( 'Anni di esperienza', 'terra_anni', 'text', '30+' );
            lm_section( 'Gli Orci' );
            lm_field( 'Testo Gli Orci (paragrafo 1)', 'orci_testo', 'textarea' );
            lm_field( 'Testo Gli Orci (paragrafo 2)', 'orci_testo2', 'textarea' );
            lm_section( 'Premi' );
            for ( $i = 1; $i <= 4; $i++ ) {
                lm_section( "Premio $i" );
                lm_field( "Anno", "premio{$i}_anno", 'text', '2023' );
                lm_field( "Titolo", "premio{$i}_titolo", 'text' );
                lm_field( "Descrizione", "premio{$i}_desc", 'text' );
            }
            break;

        case 'oliotur':
            for ( $i = 1; $i <= 3; $i++ ) {
                lm_section( "Esperienza $i" );
                lm_field( "Titolo", "exp{$i}_titolo", 'text' );
                lm_field( "Descrizione", "exp{$i}_desc", 'textarea' );
                lm_field( "Durata", "exp{$i}_durata", 'text', '2 ore' );
                lm_field( "Dimensione gruppo", "exp{$i}_gruppo", 'text', 'Max 15 persone' );
                lm_field( "Prezzo", "exp{$i}_prezzo", 'text', '€15 a persona' );
            }
            lm_section( 'Form prenotazione' );
            lm_field( 'ID Contact Form 7 (olioturismo)', 'cf7_olioturismo_id', 'text', '', 'Inserisci l\'ID del form CF7 dedicato all\'olioturismo' );
            break;

        case 'contatti':
            lm_field( 'ID Contact Form 7 (contatti)', 'cf7_contatti_id', 'text', '', 'ID del form contatti CF7' );
            lm_field( 'Google Maps embed URL', 'maps_embed_url', 'url', 'https://www.google.com/maps/embed?...', 'URL dell\'iframe da Google Maps (non l\'URL completo ma quello dell\'embed)' );
            lm_section( 'Orari' );
            lm_field( 'Lunedì – Venerdì', 'orari_lv', 'text', '9:00 – 13:00 / 15:00 – 18:00' );
            lm_field( 'Sabato', 'orari_sab', 'text', '9:00 – 13:00' );
            lm_field( 'Domenica', 'orari_dom', 'text', 'Solo su appuntamento' );
            break;

        case 'seo':
            lm_field( 'Instagram', 'instagram', 'url', 'https://instagram.com/lamacupa' );
            lm_field( 'Facebook', 'facebook', 'url', 'https://facebook.com/lamacupa' );
            lm_field( 'YouTube', 'youtube', 'url' );
            lm_section( 'SEO' );
            lm_field( 'Meta description sito', 'meta_description', 'textarea', '', 'Massimo 160 caratteri' );
            lm_field( 'OG Image (anteprima social)', 'og_image', 'image' );
            lm_field( 'Google Analytics 4 ID', 'ga_id', 'text', 'G-XXXXXXXXXX' );
            lm_section( 'Script personalizzati' );
            lm_field( 'Script header (dopo <head>)', 'head_script', 'textarea', '', 'Codice HTML/JS da inserire nel <head>' );
            lm_field( 'Script footer (prima di </body>)', 'foot_script', 'textarea', '', 'Codice HTML/JS da inserire prima della chiusura </body>' );
            break;

        case 'pagamenti':
            lm_section( 'Stripe' );
            lm_field( 'Abilita Stripe', 'stripe_enabled', 'checkbox' );
            lm_field( 'Modalità test', 'stripe_test', 'checkbox' );
            lm_field( 'Chiave pubblica', 'stripe_pubkey', 'text', 'pk_live_...' );
            lm_field( 'Chiave segreta', 'stripe_seckey', 'password', 'sk_live_...' );
            lm_section( 'PayPal' );
            lm_field( 'Abilita PayPal', 'paypal_enabled', 'checkbox' );
            lm_field( 'Email PayPal', 'paypal_email', 'email' );
            lm_section( 'Bonifico Bancario' );
            lm_field( 'Abilita Bonifico', 'bonifico_enabled', 'checkbox' );
            lm_field( 'IBAN', 'bonifico_iban', 'text', 'IT00 X000 0000 0000 0000 0000 000' );
            lm_field( 'Intestatario', 'bonifico_intestatario', 'text' );
            lm_field( 'Causale suggerita', 'bonifico_causale', 'text', 'Ordine #{order_id}' );
            lm_section( 'Pagamento alla Consegna' );
            lm_field( 'Abilita Contrassegno', 'contrassegno_enabled', 'checkbox' );
            break;
    }
    echo '</tbody></table>';
}

/* ── Admin JS for image uploader ────────────────────────────────── */
add_action( 'admin_footer', function () {
    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'appearance_page_lamacupa-options' ) return; ?>
    <script>
    jQuery(function($){
      $('.lm-upload-btn').on('click', function(e){
        e.preventDefault();
        var targetId = $(this).data('target');
        var frame = wp.media({ title: 'Seleziona immagine', button: { text: 'Usa questa immagine' }, multiple: false });
        frame.on('select', function(){
          var att = frame.state().get('selection').first().toJSON();
          $('#' + targetId).val(att.url);
        });
        frame.open();
      });
    });
    </script>
    <?php
} );
