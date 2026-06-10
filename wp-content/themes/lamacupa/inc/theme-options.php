<?php
/**
 * Lamacupa Theme Options Admin Panel
 *
 * @package Lamacupa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
   REGISTER ADMIN MENU
   ============================================================ */
function lamacupa_options_menu() {
    add_theme_page(
        'Opzioni Tema Lamacupa',
        'Lamacupa Options',
        'manage_options',
        'lamacupa-options',
        'lamacupa_options_page'
    );
}
add_action( 'admin_menu', 'lamacupa_options_menu' );

/* ============================================================
   ENQUEUE ADMIN ASSETS
   ============================================================ */
function lamacupa_admin_enqueue( $hook ) {
    if ( 'appearance_page_lamacupa-options' !== $hook && 'tools_page_lamacupa-import' !== $hook ) {
        return;
    }

    // WordPress color picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );

    // Media uploader
    wp_enqueue_media();

    // Admin CSS
    wp_enqueue_style(
        'lamacupa-admin',
        get_template_directory_uri() . '/assets/css/admin.css',
        [],
        LAMACUPA_VERSION
    );

    // Admin JS
    wp_enqueue_script(
        'lamacupa-admin',
        get_template_directory_uri() . '/assets/js/admin.js',
        [ 'jquery', 'wp-color-picker' ],
        LAMACUPA_VERSION,
        true
    );

    // Localize for options page (import page localizes separately)
    if ( 'appearance_page_lamacupa-options' === $hook ) {
        wp_localize_script( 'lamacupa-admin', 'lamacupaAdmin', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'lamacupa_import_nonce' ),
        ] );
    }
}
add_action( 'admin_enqueue_scripts', 'lamacupa_admin_enqueue' );

/* ============================================================
   SAVE OPTIONS
   ============================================================ */
function lamacupa_save_options() {
    if (
        ! isset( $_POST['lamacupa_options_nonce'] ) ||
        ! wp_verify_nonce( $_POST['lamacupa_options_nonce'], 'lamacupa_save_options' )
    ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $raw     = isset( $_POST['lamacupa'] ) ? $_POST['lamacupa'] : [];
    $options = [];

    // --- Tab Azienda ---
    $options['ragione_sociale']  = sanitize_text_field( $raw['ragione_sociale'] ?? '' );
    $options['partita_iva']      = sanitize_text_field( $raw['partita_iva'] ?? '' );
    $options['indirizzo']        = sanitize_textarea_field( $raw['indirizzo'] ?? '' );
    $options['cap']              = sanitize_text_field( $raw['cap'] ?? '' );
    $options['citta']            = sanitize_text_field( $raw['citta'] ?? '' );
    $options['provincia']        = sanitize_text_field( $raw['provincia'] ?? '' );
    $options['telefono']         = sanitize_text_field( $raw['telefono'] ?? '' );
    $options['email']            = sanitize_email( $raw['email'] ?? '' );
    $options['whatsapp']         = sanitize_text_field( $raw['whatsapp'] ?? '' );
    $options['anno_fondazione']  = sanitize_text_field( $raw['anno_fondazione'] ?? '' );
    $options['descrizione_breve'] = wp_kses_post( $raw['descrizione_breve'] ?? '' );

    // --- Tab Identità Visiva ---
    $options['logo']             = absint( $raw['logo'] ?? 0 );
    $options['logo_footer']      = absint( $raw['logo_footer'] ?? 0 );
    $options['favicon']          = absint( $raw['favicon'] ?? 0 );
    $options['color_primary']    = sanitize_hex_color( $raw['color_primary'] ?? '#5C6B2E' );
    $options['color_secondary']  = sanitize_hex_color( $raw['color_secondary'] ?? '#8B6914' );
    $options['color_accent']     = sanitize_hex_color( $raw['color_accent'] ?? '#C4A882' );
    $options['color_text']       = sanitize_hex_color( $raw['color_text'] ?? '#2C2C2C' );
    $options['color_bg']         = sanitize_hex_color( $raw['color_bg'] ?? '#F5F0E8' );
    $allowed_font_titles = [ 'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Georgia' ];
    $allowed_font_body   = [ 'Lato', 'Open Sans', 'Raleway', 'Source Sans Pro' ];
    $options['font_titles'] = in_array( $raw['font_titles'] ?? '', $allowed_font_titles, true ) ? $raw['font_titles'] : 'Playfair Display';
    $options['font_body']   = in_array( $raw['font_body'] ?? '', $allowed_font_body, true ) ? $raw['font_body'] : 'Lato';

    // --- Tab Homepage ---
    $options['hero_titolo']          = sanitize_text_field( $raw['hero_titolo'] ?? '' );
    $options['hero_sottotitolo']     = sanitize_textarea_field( $raw['hero_sottotitolo'] ?? '' );
    $options['hero_cta_testo']       = sanitize_text_field( $raw['hero_cta_testo'] ?? '' );
    $options['hero_cta_link']        = esc_url_raw( $raw['hero_cta_link'] ?? '' );
    $options['hero_bg_image']        = absint( $raw['hero_bg_image'] ?? 0 );
    $options['sezione_chi_siamo']    = isset( $raw['sezione_chi_siamo'] ) ? 1 : 0;
    $options['sezione_terra']        = isset( $raw['sezione_terra'] ) ? 1 : 0;
    $options['sezione_orci']         = isset( $raw['sezione_orci'] ) ? 1 : 0;
    $options['sezione_premi']        = isset( $raw['sezione_premi'] ) ? 1 : 0;
    $options['sezione_olioturismo']  = isset( $raw['sezione_olioturismo'] ) ? 1 : 0;
    $options['testo_olioturismo']    = wp_kses_post( $raw['testo_olioturismo'] ?? '' );

    // --- Tab Contatti ---
    $options['maps_embed_url']   = esc_url_raw( $raw['maps_embed_url'] ?? '' );
    $options['orari_lun_ven']    = sanitize_text_field( $raw['orari_lun_ven'] ?? '' );
    $options['orari_sabato']     = sanitize_text_field( $raw['orari_sabato'] ?? '' );
    $options['orari_domenica']   = sanitize_text_field( $raw['orari_domenica'] ?? '' );
    $options['note_orari']       = sanitize_textarea_field( $raw['note_orari'] ?? '' );
    $options['instagram']        = esc_url_raw( $raw['instagram'] ?? '' );
    $options['facebook']         = esc_url_raw( $raw['facebook'] ?? '' );
    $options['youtube']          = esc_url_raw( $raw['youtube'] ?? '' );

    // --- Tab Pagamenti ---
    $options['stripe_enabled']     = isset( $raw['stripe_enabled'] ) ? 1 : 0;
    $options['stripe_public_key']  = sanitize_text_field( $raw['stripe_public_key'] ?? '' );
    $options['stripe_secret_key']  = sanitize_text_field( $raw['stripe_secret_key'] ?? '' );
    $options['stripe_test_mode']   = isset( $raw['stripe_test_mode'] ) ? 1 : 0;
    $options['paypal_enabled']     = isset( $raw['paypal_enabled'] ) ? 1 : 0;
    $options['paypal_email']       = sanitize_email( $raw['paypal_email'] ?? '' );
    $options['bacs_enabled']       = isset( $raw['bacs_enabled'] ) ? 1 : 0;
    $options['bacs_iban']          = sanitize_text_field( $raw['bacs_iban'] ?? '' );
    $options['bacs_intestatario']  = sanitize_text_field( $raw['bacs_intestatario'] ?? '' );
    $options['bacs_causale']       = sanitize_text_field( $raw['bacs_causale'] ?? '' );
    $options['cod_enabled']        = isset( $raw['cod_enabled'] ) ? 1 : 0;

    // --- Tab Social & SEO ---
    $options['meta_description']    = sanitize_textarea_field( $raw['meta_description'] ?? '' );
    $options['og_image']            = absint( $raw['og_image'] ?? 0 );
    $options['ga_id']               = sanitize_text_field( $raw['ga_id'] ?? '' );
    // Raw HTML scripts — stored as-is, only admins can set these
    $options['script_header']       = $raw['script_header'] ?? '';
    $options['script_footer']       = $raw['script_footer'] ?? '';

    update_option( 'lamacupa_options', $options );

    add_action( 'admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Opzioni salvate con successo.</strong></p></div>';
    } );
}
add_action( 'admin_init', 'lamacupa_save_options' );

/* ============================================================
   OPTIONS PAGE HTML
   ============================================================ */
function lamacupa_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Non hai i permessi per accedere a questa pagina.' );
    }

    $options = get_option( 'lamacupa_options', [] );

    // Helper: get option value with default
    $opt = function( $key, $default = '' ) use ( $options ) {
        return isset( $options[ $key ] ) ? $options[ $key ] : $default;
    };

    $tabs = [
        'azienda'   => 'Azienda',
        'identita'  => 'Identità Visiva',
        'homepage'  => 'Homepage',
        'contatti'  => 'Contatti',
        'pagamenti' => 'Pagamenti',
        'seo'       => 'Social & SEO',
    ];

    $active_tab = isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $tabs ) ? $_GET['tab'] : 'azienda';
    ?>
    <div class="wrap lamacupa-options-wrap">
        <h1 class="lamacupa-options-title">
            <span class="lamacupa-options-title__icon">🫒</span>
            Lamacupa Options
        </h1>

        <nav class="lamacupa-tabs" id="lamacupaTabs">
            <?php foreach ( $tabs as $slug => $label ) : ?>
            <a
                href="<?php echo esc_url( admin_url( 'themes.php?page=lamacupa-options&tab=' . $slug ) ); ?>"
                class="lamacupa-tab<?php echo $active_tab === $slug ? ' lamacupa-tab--active' : ''; ?>"
                data-tab="<?php echo esc_attr( $slug ); ?>"
            ><?php echo esc_html( $label ); ?></a>
            <?php endforeach; ?>
        </nav>

        <form method="post" action="" id="lamacupaOptionsForm" enctype="multipart/form-data">
            <?php wp_nonce_field( 'lamacupa_save_options', 'lamacupa_options_nonce' ); ?>

            <!-- ================================================
                 TAB: AZIENDA
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'azienda' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-azienda">
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Dati Azienda</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field">
                            <label for="lc_ragione_sociale">Ragione Sociale</label>
                            <input type="text" id="lc_ragione_sociale" name="lamacupa[ragione_sociale]"
                                value="<?php echo esc_attr( $opt('ragione_sociale') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_partita_iva">Partita IVA</label>
                            <input type="text" id="lc_partita_iva" name="lamacupa[partita_iva]"
                                value="<?php echo esc_attr( $opt('partita_iva') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_indirizzo">Indirizzo</label>
                            <textarea id="lc_indirizzo" name="lamacupa[indirizzo]" rows="3" class="large-text"><?php echo esc_textarea( $opt('indirizzo') ); ?></textarea>
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_cap">CAP</label>
                            <input type="text" id="lc_cap" name="lamacupa[cap]"
                                value="<?php echo esc_attr( $opt('cap') ); ?>" class="small-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_citta">Città</label>
                            <input type="text" id="lc_citta" name="lamacupa[citta]"
                                value="<?php echo esc_attr( $opt('citta') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_provincia">Provincia</label>
                            <input type="text" id="lc_provincia" name="lamacupa[provincia]"
                                value="<?php echo esc_attr( $opt('provincia') ); ?>" class="small-text" maxlength="2">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_telefono">Telefono</label>
                            <input type="text" id="lc_telefono" name="lamacupa[telefono]"
                                value="<?php echo esc_attr( $opt('telefono') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_email">Email</label>
                            <input type="email" id="lc_email" name="lamacupa[email]"
                                value="<?php echo esc_attr( $opt('email') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_whatsapp">WhatsApp (numero con prefisso)</label>
                            <input type="text" id="lc_whatsapp" name="lamacupa[whatsapp]"
                                value="<?php echo esc_attr( $opt('whatsapp') ); ?>" class="regular-text"
                                placeholder="+39 320 000 0000">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_anno_fondazione">Anno di Fondazione</label>
                            <input type="text" id="lc_anno_fondazione" name="lamacupa[anno_fondazione]"
                                value="<?php echo esc_attr( $opt('anno_fondazione') ); ?>" class="small-text">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_descrizione_breve">Descrizione Breve <span class="description">(usata nel footer)</span></label>
                            <textarea id="lc_descrizione_breve" name="lamacupa[descrizione_breve]" rows="4" class="large-text"><?php echo wp_kses_post( $opt('descrizione_breve') ); ?></textarea>
                        </div>

                    </div><!-- /.lamacupa-fields -->
                </div><!-- /.lamacupa-card -->
            </div><!-- /#tab-azienda -->

            <!-- ================================================
                 TAB: IDENTITÀ VISIVA
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'identita' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-identita">
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Loghi</h2>
                    <div class="lamacupa-fields">

                        <?php
                        $image_fields = [
                            'logo'         => 'Logo Principale',
                            'logo_footer'  => 'Logo Footer',
                            'favicon'      => 'Favicon',
                        ];
                        foreach ( $image_fields as $field_key => $field_label ) :
                            $img_id  = (int) $opt( $field_key, 0 );
                            $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'thumbnail' ) : '';
                        ?>
                        <div class="lamacupa-field lamacupa-image-field">
                            <label><?php echo esc_html( $field_label ); ?></label>
                            <div class="lamacupa-image-preview" id="preview_<?php echo esc_attr( $field_key ); ?>">
                                <?php if ( $img_url ) : ?>
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="lamacupa[<?php echo esc_attr( $field_key ); ?>]"
                                id="input_<?php echo esc_attr( $field_key ); ?>"
                                value="<?php echo esc_attr( $img_id ); ?>">
                            <button type="button" class="button lamacupa-upload-btn"
                                data-target="input_<?php echo esc_attr( $field_key ); ?>"
                                data-preview="preview_<?php echo esc_attr( $field_key ); ?>"
                                data-title="<?php echo esc_attr( 'Seleziona ' . $field_label ); ?>">
                                Seleziona immagine
                            </button>
                            <?php if ( $img_id ) : ?>
                            <button type="button" class="button lamacupa-remove-btn"
                                data-target="input_<?php echo esc_attr( $field_key ); ?>"
                                data-preview="preview_<?php echo esc_attr( $field_key ); ?>">
                                Rimuovi
                            </button>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Colori</h2>
                    <div class="lamacupa-fields">

                        <?php
                        $colors = [
                            'color_primary'   => [ 'Colore Primario',   '#5C6B2E' ],
                            'color_secondary' => [ 'Colore Secondario', '#8B6914' ],
                            'color_accent'    => [ 'Colore Accento',    '#C4A882' ],
                            'color_text'      => [ 'Colore Testo',      '#2C2C2C' ],
                            'color_bg'        => [ 'Colore Sfondo',     '#F5F0E8' ],
                        ];
                        foreach ( $colors as $key => [ $label, $default ] ) :
                        ?>
                        <div class="lamacupa-field">
                            <label for="lc_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
                            <input type="text" id="lc_<?php echo esc_attr( $key ); ?>"
                                name="lamacupa[<?php echo esc_attr( $key ); ?>]"
                                value="<?php echo esc_attr( $opt( $key, $default ) ); ?>"
                                class="lamacupa-color-picker"
                                data-default-color="<?php echo esc_attr( $default ); ?>">
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Tipografia</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field">
                            <label for="lc_font_titles">Font Titoli</label>
                            <select id="lc_font_titles" name="lamacupa[font_titles]">
                                <?php
                                $font_titles = [ 'Playfair Display', 'Cormorant Garamond', 'Libre Baskerville', 'Georgia' ];
                                $cur = $opt( 'font_titles', 'Playfair Display' );
                                foreach ( $font_titles as $f ) {
                                    printf( '<option value="%s"%s>%s</option>', esc_attr($f), selected($cur, $f, false), esc_html($f) );
                                }
                                ?>
                            </select>
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_font_body">Font Corpo</label>
                            <select id="lc_font_body" name="lamacupa[font_body]">
                                <?php
                                $font_body = [ 'Lato', 'Open Sans', 'Raleway', 'Source Sans Pro' ];
                                $cur = $opt( 'font_body', 'Lato' );
                                foreach ( $font_body as $f ) {
                                    printf( '<option value="%s"%s>%s</option>', esc_attr($f), selected($cur, $f, false), esc_html($f) );
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div><!-- /#tab-identita -->

            <!-- ================================================
                 TAB: HOMEPAGE
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'homepage' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-homepage">
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Sezione Hero</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_hero_titolo">Titolo Principale</label>
                            <input type="text" id="lc_hero_titolo" name="lamacupa[hero_titolo]"
                                value="<?php echo esc_attr( $opt('hero_titolo', "L'Oro Verde di Puglia") ); ?>"
                                class="large-text">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_hero_sottotitolo">Sottotitolo</label>
                            <textarea id="lc_hero_sottotitolo" name="lamacupa[hero_sottotitolo]" rows="3" class="large-text"><?php echo esc_textarea( $opt('hero_sottotitolo', "Olio extravergine d'oliva biologico ottenuto dalla raccolta tradizionale delle olive Coratina e Ogliarola Barese.") ); ?></textarea>
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_hero_cta_testo">Testo Bottone CTA</label>
                            <input type="text" id="lc_hero_cta_testo" name="lamacupa[hero_cta_testo]"
                                value="<?php echo esc_attr( $opt('hero_cta_testo', 'Scopri i Prodotti') ); ?>"
                                class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_hero_cta_link">Link Bottone CTA</label>
                            <input type="text" id="lc_hero_cta_link" name="lamacupa[hero_cta_link]"
                                value="<?php echo esc_attr( $opt('hero_cta_link') ); ?>"
                                class="regular-text" placeholder="/prodotti/">
                        </div>

                        <?php
                        $hero_bg_id  = (int) $opt('hero_bg_image', 0);
                        $hero_bg_url = $hero_bg_id ? wp_get_attachment_image_url( $hero_bg_id, 'thumbnail' ) : '';
                        ?>
                        <div class="lamacupa-field lamacupa-image-field">
                            <label>Immagine di Sfondo Hero</label>
                            <div class="lamacupa-image-preview" id="preview_hero_bg_image">
                                <?php if ( $hero_bg_url ) : ?>
                                <img src="<?php echo esc_url( $hero_bg_url ); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="lamacupa[hero_bg_image]" id="input_hero_bg_image"
                                value="<?php echo esc_attr( $hero_bg_id ); ?>">
                            <button type="button" class="button lamacupa-upload-btn"
                                data-target="input_hero_bg_image"
                                data-preview="preview_hero_bg_image"
                                data-title="Seleziona immagine di sfondo">
                                Seleziona immagine
                            </button>
                            <?php if ( $hero_bg_id ) : ?>
                            <button type="button" class="button lamacupa-remove-btn"
                                data-target="input_hero_bg_image"
                                data-preview="preview_hero_bg_image">Rimuovi</button>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Sezioni Homepage</h2>
                    <p class="description">Attiva o disattiva le sezioni visualizzate nella homepage.</p>
                    <div class="lamacupa-fields lamacupa-fields--checkboxes">

                        <?php
                        $sections = [
                            'sezione_chi_siamo'   => 'Chi Siamo',
                            'sezione_terra'       => 'La Nostra Terra',
                            'sezione_orci'        => 'Gli Orci',
                            'sezione_premi'       => 'Premi',
                            'sezione_olioturismo' => 'Olioturismo',
                        ];
                        foreach ( $sections as $key => $label ) :
                        ?>
                        <div class="lamacupa-field lamacupa-field--checkbox">
                            <label>
                                <input type="checkbox" name="lamacupa[<?php echo esc_attr( $key ); ?>]" value="1"
                                    <?php checked( 1, $opt( $key, 1 ) ); ?>>
                                <?php echo esc_html( $label ); ?>
                            </label>
                        </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="lamacupa-fields" style="margin-top:20px">
                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_testo_olioturismo">Testo Sezione Olioturismo</label>
                            <textarea id="lc_testo_olioturismo" name="lamacupa[testo_olioturismo]" rows="4" class="large-text"><?php echo wp_kses_post( $opt('testo_olioturismo') ); ?></textarea>
                        </div>
                    </div>
                </div>
            </div><!-- /#tab-homepage -->

            <!-- ================================================
                 TAB: CONTATTI
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'contatti' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-contatti">
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Google Maps</h2>
                    <div class="lamacupa-fields">
                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_maps_embed_url">URL Embed Google Maps <span class="description">(il valore dell'attributo src dell'iframe)</span></label>
                            <input type="text" id="lc_maps_embed_url" name="lamacupa[maps_embed_url]"
                                value="<?php echo esc_attr( $opt('maps_embed_url') ); ?>" class="large-text"
                                placeholder="https://www.google.com/maps/embed?pb=...">
                        </div>
                    </div>
                </div>

                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Orari di Apertura</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field">
                            <label for="lc_orari_lun_ven">Lunedì – Venerdì</label>
                            <input type="text" id="lc_orari_lun_ven" name="lamacupa[orari_lun_ven]"
                                value="<?php echo esc_attr( $opt('orari_lun_ven', '9:00 – 18:00') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_orari_sabato">Sabato</label>
                            <input type="text" id="lc_orari_sabato" name="lamacupa[orari_sabato]"
                                value="<?php echo esc_attr( $opt('orari_sabato', '9:00 – 13:00') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_orari_domenica">Domenica</label>
                            <input type="text" id="lc_orari_domenica" name="lamacupa[orari_domenica]"
                                value="<?php echo esc_attr( $opt('orari_domenica', 'Su prenotazione') ); ?>" class="regular-text">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_note_orari">Note Orari</label>
                            <textarea id="lc_note_orari" name="lamacupa[note_orari]" rows="3" class="large-text"><?php echo esc_textarea( $opt('note_orari') ); ?></textarea>
                        </div>

                    </div>
                </div>

                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Social Media</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_instagram">Link Instagram</label>
                            <input type="text" id="lc_instagram" name="lamacupa[instagram]"
                                value="<?php echo esc_attr( $opt('instagram') ); ?>" class="large-text"
                                placeholder="https://www.instagram.com/lamacupa">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_facebook">Link Facebook</label>
                            <input type="text" id="lc_facebook" name="lamacupa[facebook]"
                                value="<?php echo esc_attr( $opt('facebook') ); ?>" class="large-text"
                                placeholder="https://www.facebook.com/lamacupa">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_youtube">Link YouTube</label>
                            <input type="text" id="lc_youtube" name="lamacupa[youtube]"
                                value="<?php echo esc_attr( $opt('youtube') ); ?>" class="large-text"
                                placeholder="https://www.youtube.com/@lamacupa">
                        </div>

                    </div>
                </div>
            </div><!-- /#tab-contatti -->

            <!-- ================================================
                 TAB: PAGAMENTI
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'pagamenti' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-pagamenti">

                <!-- Stripe -->
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Stripe</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--checkbox lamacupa-field--full">
                            <label>
                                <input type="checkbox" name="lamacupa[stripe_enabled]" value="1"
                                    <?php checked( 1, $opt( 'stripe_enabled', 0 ) ); ?>>
                                Abilita pagamenti con Stripe
                            </label>
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_stripe_public_key">Chiave Pubblica (Publishable Key)</label>
                            <input type="text" id="lc_stripe_public_key" name="lamacupa[stripe_public_key]"
                                value="<?php echo esc_attr( $opt('stripe_public_key') ); ?>" class="large-text"
                                placeholder="pk_live_...">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_stripe_secret_key">Chiave Segreta (Secret Key)</label>
                            <input type="password" id="lc_stripe_secret_key" name="lamacupa[stripe_secret_key]"
                                value="<?php echo esc_attr( $opt('stripe_secret_key') ); ?>" class="large-text"
                                placeholder="sk_live_...">
                            <p class="description">La chiave segreta non viene mai esposta al pubblico.</p>
                        </div>

                        <div class="lamacupa-field lamacupa-field--checkbox">
                            <label>
                                <input type="checkbox" name="lamacupa[stripe_test_mode]" value="1"
                                    <?php checked( 1, $opt( 'stripe_test_mode', 0 ) ); ?>>
                                Modalità Test (usa chiavi test pk_test_ / sk_test_)
                            </label>
                        </div>

                    </div>
                </div>

                <!-- PayPal -->
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">PayPal</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--checkbox lamacupa-field--full">
                            <label>
                                <input type="checkbox" name="lamacupa[paypal_enabled]" value="1"
                                    <?php checked( 1, $opt( 'paypal_enabled', 0 ) ); ?>>
                                Abilita pagamenti con PayPal
                            </label>
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_paypal_email">Email PayPal</label>
                            <input type="email" id="lc_paypal_email" name="lamacupa[paypal_email]"
                                value="<?php echo esc_attr( $opt('paypal_email') ); ?>" class="regular-text"
                                placeholder="pagamenti@lamacupa.it">
                        </div>

                    </div>
                </div>

                <!-- Bonifico Bancario -->
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Bonifico Bancario</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--checkbox lamacupa-field--full">
                            <label>
                                <input type="checkbox" name="lamacupa[bacs_enabled]" value="1"
                                    <?php checked( 1, $opt( 'bacs_enabled', 0 ) ); ?>>
                                Abilita pagamento tramite bonifico bancario
                            </label>
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_bacs_iban">IBAN</label>
                            <input type="text" id="lc_bacs_iban" name="lamacupa[bacs_iban]"
                                value="<?php echo esc_attr( $opt('bacs_iban') ); ?>" class="large-text"
                                placeholder="IT60 X054 2811 1010 0000 0123 456">
                        </div>

                        <div class="lamacupa-field">
                            <label for="lc_bacs_intestatario">Intestatario del Conto</label>
                            <input type="text" id="lc_bacs_intestatario" name="lamacupa[bacs_intestatario]"
                                value="<?php echo esc_attr( $opt('bacs_intestatario') ); ?>" class="regular-text"
                                placeholder="Azienda Agricola Lamacupa">
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_bacs_causale">Causale Suggerita</label>
                            <input type="text" id="lc_bacs_causale" name="lamacupa[bacs_causale]"
                                value="<?php echo esc_attr( $opt('bacs_causale', 'Ordine #{order_number}') ); ?>" class="large-text"
                                placeholder="Ordine #{order_number}">
                            <p class="description">Puoi usare {order_number} come segnaposto per il numero d'ordine.</p>
                        </div>

                    </div>
                </div>

                <!-- Contrassegno -->
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">Contrassegno (Pagamento alla Consegna)</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--checkbox lamacupa-field--full">
                            <label>
                                <input type="checkbox" name="lamacupa[cod_enabled]" value="1"
                                    <?php checked( 1, $opt( 'cod_enabled', 0 ) ); ?>>
                                Abilita pagamento in contrassegno (Cash on Delivery)
                            </label>
                        </div>

                    </div>
                </div>

            </div><!-- /#tab-pagamenti -->

            <!-- ================================================
                 TAB: SOCIAL & SEO
                 ================================================ -->
            <div class="lamacupa-tab-panel<?php echo $active_tab === 'seo' ? ' lamacupa-tab-panel--active' : ''; ?>" id="tab-seo">
                <div class="lamacupa-card">
                    <h2 class="lamacupa-card__title">SEO</h2>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_meta_description">Meta Description Sito</label>
                            <textarea id="lc_meta_description" name="lamacupa[meta_description]" rows="3" class="large-text"
                                maxlength="160"><?php echo esc_textarea( $opt('meta_description') ); ?></textarea>
                            <p class="description">Massimo 160 caratteri</p>
                        </div>

                        <?php
                        $og_id  = (int) $opt('og_image', 0);
                        $og_url = $og_id ? wp_get_attachment_image_url( $og_id, 'thumbnail' ) : '';
                        ?>
                        <div class="lamacupa-field lamacupa-image-field">
                            <label>OG Image di Default <span class="description">(1200×630px consigliati)</span></label>
                            <div class="lamacupa-image-preview" id="preview_og_image">
                                <?php if ( $og_url ) : ?>
                                <img src="<?php echo esc_url( $og_url ); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="lamacupa[og_image]" id="input_og_image"
                                value="<?php echo esc_attr( $og_id ); ?>">
                            <button type="button" class="button lamacupa-upload-btn"
                                data-target="input_og_image"
                                data-preview="preview_og_image"
                                data-title="Seleziona OG Image">
                                Seleziona immagine
                            </button>
                            <?php if ( $og_id ) : ?>
                            <button type="button" class="button lamacupa-remove-btn"
                                data-target="input_og_image"
                                data-preview="preview_og_image">Rimuovi</button>
                            <?php endif; ?>
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_ga_id">Google Analytics ID</label>
                            <input type="text" id="lc_ga_id" name="lamacupa[ga_id]"
                                value="<?php echo esc_attr( $opt('ga_id') ); ?>" class="regular-text"
                                placeholder="G-XXXXXXXXXX">
                        </div>

                    </div>
                </div>

                <div class="lamacupa-card lamacupa-card--warning">
                    <h2 class="lamacupa-card__title">Script Personalizzati</h2>
                    <div class="lamacupa-notice lamacupa-notice--warning">
                        <strong>Attenzione:</strong> Inserire solo codice di cui si è certi.
                        Script malevoli possono compromettere la sicurezza del sito.
                        Questi campi sono accessibili solo agli amministratori.
                    </div>
                    <div class="lamacupa-fields">

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_script_header">Script nell'&lt;head&gt; (prima di &lt;/head&gt;)</label>
                            <textarea id="lc_script_header" name="lamacupa[script_header]" rows="6"
                                class="large-text code"><?php echo esc_textarea( $opt('script_header') ); ?></textarea>
                        </div>

                        <div class="lamacupa-field lamacupa-field--full">
                            <label for="lc_script_footer">Script nel footer (prima di &lt;/body&gt;)</label>
                            <textarea id="lc_script_footer" name="lamacupa[script_footer]" rows="6"
                                class="large-text code"><?php echo esc_textarea( $opt('script_footer') ); ?></textarea>
                        </div>

                    </div>
                </div>
            </div><!-- /#tab-seo -->

            <div class="lamacupa-submit-bar">
                <button type="submit" name="lamacupa_save" value="1" class="button button-primary button-hero">
                    Salva Opzioni
                </button>
                <span class="lamacupa-save-feedback" id="lamacupaSaveFeedback"></span>
            </div>

        </form>
    </div><!-- /.wrap -->
    <?php
}

/* ============================================================
   INJECT CUSTOM SCRIPTS (header/footer) & GA
   ============================================================ */
function lamacupa_inject_header_scripts() {
    $options = get_option( 'lamacupa_options', [] );

    // Google Analytics
    if ( ! empty( $options['ga_id'] ) ) {
        $ga_id = esc_js( $options['ga_id'] );
        echo "<!-- Google Analytics -->\n";
        echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$ga_id}\"></script>\n";
        echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{$ga_id}');</script>\n";
    }

    // Custom header script (admin-only stored)
    if ( ! empty( $options['script_header'] ) ) {
        echo $options['script_header'] . "\n"; // phpcs:ignore
    }
}
add_action( 'wp_head', 'lamacupa_inject_header_scripts', 99 );

function lamacupa_inject_footer_scripts() {
    $options = get_option( 'lamacupa_options', [] );
    if ( ! empty( $options['script_footer'] ) ) {
        echo $options['script_footer'] . "\n"; // phpcs:ignore
    }
}
add_action( 'wp_footer', 'lamacupa_inject_footer_scripts', 99 );

/* ============================================================
   INJECT FAVICON FROM OPTIONS
   ============================================================ */
function lamacupa_custom_favicon() {
    $favicon_id = (int) lamacupa_option('favicon', 0);
    if ( $favicon_id ) {
        $favicon_url = wp_get_attachment_image_url( $favicon_id, 'full' );
        if ( $favicon_url ) {
            echo '<link rel="icon" href="' . esc_url( $favicon_url ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'lamacupa_custom_favicon', 1 );
