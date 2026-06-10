<?php
/**
 * Import Tool Admin Page
 * Strumento per importare contenuti nel sito Lamacupa
 *
 * @package Lamacupa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
   REGISTER ADMIN MENU PAGE
   ============================================================ */
function lamacupa_import_menu() {
    add_management_page(
        __( 'Importa da Vecchio Sito', 'lamacupa' ),
        __( 'Importa da Vecchio Sito', 'lamacupa' ),
        'manage_options',
        'lamacupa-import',
        'lamacupa_import_page'
    );
}
add_action( 'admin_menu', 'lamacupa_import_menu' );

/* ============================================================
   LOCALIZE ADMIN JS
   ============================================================ */
function lamacupa_import_localize( $hook ) {
    if ( 'tools_page_lamacupa-import' !== $hook ) {
        return;
    }
    wp_localize_script( 'lamacupa-admin', 'lamacupaAdmin', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'lamacupa_import_nonce' ),
    ] );
}
add_action( 'admin_enqueue_scripts', 'lamacupa_import_localize', 20 );

/* ============================================================
   IMPORT PAGE HTML
   ============================================================ */
function lamacupa_import_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap lamacupa-import-wrap">
        <h1><?php esc_html_e( 'Importa da Vecchio Sito', 'lamacupa' ); ?></h1>
        <p><?php esc_html_e( 'Utilizza questi strumenti per importare contenuti dal vecchio sito nel nuovo sito WordPress.', 'lamacupa' ); ?></p>

        <!-- ===================== SEZIONE 1: XML/WXR ===================== -->
        <div class="lamacupa-import-section">
            <h2><?php esc_html_e( 'Importa WordPress XML (WXR)', 'lamacupa' ); ?></h2>
            <p class="description">
                <?php esc_html_e( 'Importa un file di esportazione WordPress (.xml o .wxr) contenente articoli, pagine, prodotti e media.', 'lamacupa' ); ?>
            </p>

            <form id="lamacupa-xml-import-form" enctype="multipart/form-data">
                <?php wp_nonce_field( 'lamacupa_import_nonce', 'lamacupa_import_nonce_field' ); ?>
                <input type="hidden" name="action" value="lamacupa_import_xml">

                <table class="form-table">
                    <tr>
                        <th><?php esc_html_e( 'File XML/WXR', 'lamacupa' ); ?></th>
                        <td>
                            <input type="file" name="import_xml_file" accept=".xml,.wxr" required>
                            <p class="description"><?php esc_html_e( 'Esporta il vecchio sito da Strumenti > Esporta in WordPress.', 'lamacupa' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Cosa importare', 'lamacupa' ); ?></th>
                        <td>
                            <label><input type="checkbox" name="import_posts" value="1" checked> <?php esc_html_e( 'Articoli del blog', 'lamacupa' ); ?></label><br>
                            <label><input type="checkbox" name="import_pages" value="1" checked> <?php esc_html_e( 'Pagine', 'lamacupa' ); ?></label><br>
                            <label><input type="checkbox" name="import_products" value="1"> <?php esc_html_e( 'Prodotti WooCommerce', 'lamacupa' ); ?></label><br>
                            <label><input type="checkbox" name="import_media" value="1" checked> <?php esc_html_e( 'Immagini / Media (scarica da URL)', 'lamacupa' ); ?></label>
                        </td>
                    </tr>
                </table>

                <div class="lamacupa-progress">
                    <div class="lamacupa-progress-bar"><div class="lamacupa-progress-bar__fill"></div></div>
                    <div class="lamacupa-progress-text"></div>
                </div>
                <div class="lamacupa-feedback"></div>
                <div class="lamacupa-results"></div>

                <button type="submit" class="lamacupa-import-btn">
                    <?php esc_html_e( 'Importa XML', 'lamacupa' ); ?>
                </button>
            </form>
        </div>

        <!-- ===================== SEZIONE 2: CSV PRODOTTI ===================== -->
        <div class="lamacupa-import-section">
            <h2><?php esc_html_e( 'Importa Prodotti WooCommerce (CSV)', 'lamacupa' ); ?></h2>
            <p class="description">
                <?php esc_html_e( 'Importa prodotti da un file CSV. Ogni riga del CSV corrisponde a un prodotto.', 'lamacupa' ); ?>
            </p>

            <h4><?php esc_html_e( 'Colonne attese nel CSV:', 'lamacupa' ); ?></h4>
            <table class="lamacupa-col-map">
                <tr><th><?php esc_html_e( 'Colonna CSV', 'lamacupa' ); ?></th><th><?php esc_html_e( 'Campo WooCommerce', 'lamacupa' ); ?></th><th><?php esc_html_e( 'Obbligatoria', 'lamacupa' ); ?></th></tr>
                <tr><td><code>Name</code></td><td><?php esc_html_e( 'Nome prodotto', 'lamacupa' ); ?></td><td>&#10003;</td></tr>
                <tr><td><code>SKU</code></td><td><?php esc_html_e( 'SKU', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Description</code></td><td><?php esc_html_e( 'Descrizione', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Short Description</code></td><td><?php esc_html_e( 'Descrizione breve', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Price</code></td><td><?php esc_html_e( 'Prezzo regolare', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Sale Price</code></td><td><?php esc_html_e( 'Prezzo scontato', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Stock</code></td><td><?php esc_html_e( 'Quantità in magazzino', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Categories</code></td><td><?php esc_html_e( 'Categorie (separare con |)', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Images</code></td><td><?php esc_html_e( 'URL immagini (separare con |)', 'lamacupa' ); ?></td><td></td></tr>
                <tr><td><code>Tags</code></td><td><?php esc_html_e( 'Tag (separare con |)', 'lamacupa' ); ?></td><td></td></tr>
            </table>

            <form id="lamacupa-csv-import-form" enctype="multipart/form-data" style="margin-top:16px">
                <?php wp_nonce_field( 'lamacupa_import_nonce', 'lamacupa_import_nonce_csv' ); ?>
                <input type="hidden" name="action" value="lamacupa_import_csv">

                <table class="form-table">
                    <tr>
                        <th><?php esc_html_e( 'File CSV', 'lamacupa' ); ?></th>
                        <td>
                            <input type="file" name="import_csv_file" accept=".csv" required>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Separatore', 'lamacupa' ); ?></th>
                        <td>
                            <select name="csv_delimiter">
                                <option value=","><?php esc_html_e( 'Virgola (,)', 'lamacupa' ); ?></option>
                                <option value=";"><?php esc_html_e( 'Punto e virgola (;)', 'lamacupa' ); ?></option>
                                <option value="	"><?php esc_html_e( 'Tabulazione', 'lamacupa' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Aggiorna esistenti', 'lamacupa' ); ?></th>
                        <td>
                            <label><input type="checkbox" name="update_existing" value="1"> <?php esc_html_e( 'Aggiorna prodotti già presenti (per SKU)', 'lamacupa' ); ?></label>
                        </td>
                    </tr>
                </table>

                <div class="lamacupa-progress">
                    <div class="lamacupa-progress-bar"><div class="lamacupa-progress-bar__fill"></div></div>
                    <div class="lamacupa-progress-text"></div>
                </div>
                <div class="lamacupa-feedback"></div>
                <div class="lamacupa-results"></div>

                <button type="submit" class="lamacupa-import-btn">
                    <?php esc_html_e( 'Importa CSV', 'lamacupa' ); ?>
                </button>
            </form>
        </div>

        <!-- ===================== SEZIONE 3: ZIP IMMAGINI ===================== -->
        <div class="lamacupa-import-section">
            <h2><?php esc_html_e( 'Importa Immagini (ZIP)', 'lamacupa' ); ?></h2>
            <p class="description">
                <?php esc_html_e( 'Carica un archivio ZIP contenente immagini. Verranno estratte e importate nella Libreria Media di WordPress.', 'lamacupa' ); ?>
            </p>

            <form id="lamacupa-zip-import-form" enctype="multipart/form-data">
                <?php wp_nonce_field( 'lamacupa_import_nonce', 'lamacupa_import_nonce_zip' ); ?>
                <input type="hidden" name="action" value="lamacupa_import_zip">

                <table class="form-table">
                    <tr>
                        <th><?php esc_html_e( 'File ZIP', 'lamacupa' ); ?></th>
                        <td>
                            <input type="file" name="import_zip_file" accept=".zip" required>
                            <p class="description"><?php esc_html_e( 'Max dimensione: dipende dalla configurazione PHP del server.', 'lamacupa' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Associa a post esistenti', 'lamacupa' ); ?></th>
                        <td>
                            <label>
                                <input type="checkbox" name="match_by_filename" value="1">
                                <?php esc_html_e( 'Associa le immagini a post/prodotti esistenti tramite nome file', 'lamacupa' ); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Salta duplicati', 'lamacupa' ); ?></th>
                        <td>
                            <label>
                                <input type="checkbox" name="skip_duplicates" value="1" checked>
                                <?php esc_html_e( 'Non reimportare immagini già presenti nella libreria', 'lamacupa' ); ?>
                            </label>
                        </td>
                    </tr>
                </table>

                <div class="lamacupa-progress">
                    <div class="lamacupa-progress-bar"><div class="lamacupa-progress-bar__fill"></div></div>
                    <div class="lamacupa-progress-text"></div>
                </div>
                <div class="lamacupa-feedback"></div>
                <div class="lamacupa-results"></div>

                <button type="submit" class="lamacupa-import-btn">
                    <?php esc_html_e( 'Importa ZIP', 'lamacupa' ); ?>
                </button>
            </form>
        </div>

    </div><!-- /.wrap -->
    <?php
}

/* ============================================================
   AJAX HANDLER: IMPORT XML
   ============================================================ */
add_action( 'wp_ajax_lamacupa_import_xml', 'lamacupa_ajax_import_xml' );
function lamacupa_ajax_import_xml() {
    if ( ! check_ajax_referer( 'lamacupa_import_nonce', 'lamacupa_import_nonce_field', false ) ) {
        wp_send_json_error( [ 'message' => 'Errore di sicurezza. Ricarica la pagina e riprova.' ] );
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => 'Permessi insufficienti.' ] );
    }

    if ( empty( $_FILES['import_xml_file']['tmp_name'] ) ) {
        wp_send_json_error( [ 'message' => 'Nessun file ricevuto.' ] );
    }

    $file     = $_FILES['import_xml_file']; // phpcs:ignore
    $tmp_path = $file['tmp_name'];
    $ext      = strtolower( pathinfo( sanitize_file_name( $file['name'] ), PATHINFO_EXTENSION ) );

    if ( ! in_array( $ext, [ 'xml', 'wxr' ], true ) ) {
        wp_send_json_error( [ 'message' => 'Formato file non supportato. Usa .xml o .wxr.' ] );
    }

    $import_posts    = ! empty( $_POST['import_posts'] );
    $import_pages    = ! empty( $_POST['import_pages'] );
    $import_products = ! empty( $_POST['import_products'] );
    $import_media    = ! empty( $_POST['import_media'] );

    // Parse the XML file
    libxml_use_internal_errors( true );
    $xml = simplexml_load_file( $tmp_path );
    if ( ! $xml ) {
        wp_send_json_error( [ 'message' => 'Impossibile leggere il file XML. Assicurati che sia un valido file di esportazione WordPress.' ] );
    }

    $namespaces = $xml->getNamespaces( true );
    $wp_ns      = isset( $namespaces['wp'] ) ? $namespaces['wp'] : 'http://wordpress.org/export/1.2/';

    $rows      = [];
    $imported  = 0;
    $errors    = 0;
    $skipped   = 0;

    foreach ( $xml->channel->item as $item ) {
        $wp    = $item->children( $wp_ns );
        $title = (string) $item->title;
        $type  = (string) $wp->post_type;
        $status = (string) $wp->status;

        // Filter by type
        if ( 'post' === $type && ! $import_posts ) {
            $skipped++;
            $rows[] = [ 'name' => $title, 'status' => 'skip', 'note' => 'Tipo non selezionato' ];
            continue;
        }
        if ( 'page' === $type && ! $import_pages ) {
            $skipped++;
            $rows[] = [ 'name' => $title, 'status' => 'skip', 'note' => 'Tipo non selezionato' ];
            continue;
        }
        if ( 'product' === $type && ! $import_products ) {
            $skipped++;
            $rows[] = [ 'name' => $title, 'status' => 'skip', 'note' => 'Tipo non selezionato' ];
            continue;
        }
        if ( 'attachment' === $type ) {
            if ( ! $import_media ) {
                $skipped++;
                continue;
            }
        }

        if ( ! in_array( $type, [ 'post', 'page', 'product', 'attachment' ], true ) ) {
            $skipped++;
            $rows[] = [ 'name' => $title, 'status' => 'skip', 'note' => 'Tipo ignorato: ' . esc_html( $type ) ];
            continue;
        }

        // Build post data
        $content  = (string) $item->children( 'http://purl.org/rss/1.0/modules/content/' )->encoded;
        $excerpt  = (string) $item->children( 'http://wordpress.org/export/1.2/excerpt/' )->encoded;
        $post_date = (string) $wp->post_date;
        $slug      = (string) $wp->post_name;
        $post_id   = (int) $wp->post_id;

        $post_status = 'publish';
        if ( 'draft' === $status ) $post_status = 'draft';

        $post_arr = [
            'post_title'   => wp_strip_all_tags( $title ),
            'post_content' => wp_kses_post( $content ),
            'post_excerpt' => sanitize_textarea_field( $excerpt ),
            'post_status'  => $post_status,
            'post_type'    => $type,
            'post_name'    => $slug,
            'post_date'    => $post_date,
        ];

        // Check if post with same slug exists
        $existing = get_page_by_path( $slug, OBJECT, $type );
        if ( $existing ) {
            $rows[] = [ 'name' => $title, 'status' => 'skip', 'note' => 'Già esistente' ];
            $skipped++;
            continue;
        }

        $new_id = wp_insert_post( $post_arr, true );
        if ( is_wp_error( $new_id ) ) {
            $rows[]  = [ 'name' => $title, 'status' => 'error', 'note' => $new_id->get_error_message() ];
            $errors++;
        } else {
            // Import categories/tags
            $categories_ns = $item->category;
            if ( $categories_ns ) {
                $cats = [];
                $tags = [];
                foreach ( $categories_ns as $cat ) {
                    $domain = (string) $cat->attributes()->domain;
                    $nicename = (string) $cat->attributes()->nicename;
                    $cat_name = (string) $cat;
                    if ( 'category' === $domain ) {
                        $cats[] = $cat_name;
                    } elseif ( 'post_tag' === $domain ) {
                        $tags[] = $cat_name;
                    }
                }
                if ( ! empty( $cats ) ) wp_set_post_categories( $new_id, array_map( 'lamacupa_get_or_create_term_id', $cats ) );
                if ( ! empty( $tags ) ) wp_set_post_tags( $new_id, $tags );
            }

            $rows[]   = [ 'name' => $title, 'status' => 'ok', 'note' => 'Importato (ID: ' . $new_id . ')' ];
            $imported++;
        }
    }

    $message = sprintf(
        'Importazione completata: <strong>%d importati</strong>, %d saltati, %d errori.',
        $imported, $skipped, $errors
    );

    wp_send_json_success( [
        'message' => $message,
        'rows'    => array_slice( $rows, 0, 100 ), // limit results shown
    ] );
}

/* ============================================================
   HELPER: GET OR CREATE TERM
   ============================================================ */
function lamacupa_get_or_create_term_id( $name, $taxonomy = 'category' ) {
    $term = get_term_by( 'name', $name, $taxonomy );
    if ( $term ) return $term->term_id;
    $new = wp_insert_term( $name, $taxonomy );
    return is_wp_error( $new ) ? 0 : $new['term_id'];
}

/* ============================================================
   AJAX HANDLER: IMPORT CSV (WooCommerce Products)
   ============================================================ */
add_action( 'wp_ajax_lamacupa_import_csv', 'lamacupa_ajax_import_csv' );
function lamacupa_ajax_import_csv() {
    if ( ! check_ajax_referer( 'lamacupa_import_nonce', 'lamacupa_import_nonce_csv', false ) ) {
        wp_send_json_error( [ 'message' => 'Errore di sicurezza. Ricarica la pagina e riprova.' ] );
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => 'Permessi insufficienti.' ] );
    }
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( [ 'message' => 'WooCommerce non è attivo. Attivalo prima di importare prodotti.' ] );
    }

    if ( empty( $_FILES['import_csv_file']['tmp_name'] ) ) {
        wp_send_json_error( [ 'message' => 'Nessun file CSV ricevuto.' ] );
    }

    $file      = $_FILES['import_csv_file']; // phpcs:ignore
    $tmp_path  = $file['tmp_name'];
    $ext       = strtolower( pathinfo( sanitize_file_name( $file['name'] ), PATHINFO_EXTENSION ) );
    if ( 'csv' !== $ext ) {
        wp_send_json_error( [ 'message' => 'Il file deve essere in formato .csv.' ] );
    }

    $delimiter      = isset( $_POST['csv_delimiter'] ) ? sanitize_text_field( wp_unslash( $_POST['csv_delimiter'] ) ) : ',';
    $update_existing = ! empty( $_POST['update_existing'] );

    // Read CSV
    $handle = fopen( $tmp_path, 'r' ); // phpcs:ignore
    if ( ! $handle ) {
        wp_send_json_error( [ 'message' => 'Impossibile leggere il file CSV.' ] );
    }

    $headers = fgetcsv( $handle, 0, $delimiter );
    if ( ! $headers ) {
        fclose( $handle ); // phpcs:ignore
        wp_send_json_error( [ 'message' => 'Il file CSV è vuoto o non valido.' ] );
    }

    // Normalize header names
    $headers = array_map( 'trim', $headers );
    $headers = array_map( 'strtolower', $headers );

    $col = [];
    foreach ( $headers as $i => $h ) {
        $col[ $h ] = $i;
    }

    $rows     = [];
    $imported = 0;
    $errors   = 0;
    $updated  = 0;

    while ( ( $data = fgetcsv( $handle, 0, $delimiter ) ) !== false ) {
        $get = function( $key ) use ( $data, $col ) {
            $k = strtolower( $key );
            return isset( $col[ $k ] ) && isset( $data[ $col[ $k ] ] ) ? trim( $data[ $col[ $k ] ] ) : '';
        };

        $name  = $get( 'name' );
        if ( ! $name ) {
            $rows[] = [ 'name' => '(senza nome)', 'status' => 'skip', 'note' => 'Nome obbligatorio mancante' ];
            continue;
        }

        $sku         = $get( 'sku' );
        $description = $get( 'description' );
        $short_desc  = $get( 'short description' );
        $price       = $get( 'price' );
        $sale_price  = $get( 'sale price' );
        $stock       = $get( 'stock' );
        $categories  = $get( 'categories' );
        $images      = $get( 'images' );
        $tags        = $get( 'tags' );

        // Check for existing product by SKU
        $existing_id = null;
        if ( $sku ) {
            $existing_id = wc_get_product_id_by_sku( $sku );
        }

        if ( $existing_id && ! $update_existing ) {
            $rows[] = [ 'name' => $name, 'status' => 'skip', 'note' => 'Prodotto già esistente (SKU: ' . esc_html( $sku ) . ')' ];
            continue;
        }

        $product_data = [
            'post_title'   => sanitize_text_field( $name ),
            'post_content' => wp_kses_post( $description ),
            'post_excerpt' => sanitize_textarea_field( $short_desc ),
            'post_status'  => 'publish',
            'post_type'    => 'product',
        ];

        if ( $existing_id ) {
            $product_data['ID'] = $existing_id;
            $product_id = wp_update_post( $product_data, true );
            $action_label = 'Aggiornato';
        } else {
            $product_id = wp_insert_post( $product_data, true );
            $action_label = 'Importato';
        }

        if ( is_wp_error( $product_id ) ) {
            $rows[] = [ 'name' => $name, 'status' => 'error', 'note' => $product_id->get_error_message() ];
            $errors++;
            continue;
        }

        // Set product type
        wp_set_object_terms( $product_id, 'simple', 'product_type' );

        // SKU, price, stock
        if ( $sku )        update_post_meta( $product_id, '_sku', sanitize_text_field( $sku ) );
        if ( $price )      update_post_meta( $product_id, '_regular_price', wc_format_decimal( $price ) );
        if ( $sale_price ) update_post_meta( $product_id, '_sale_price', wc_format_decimal( $sale_price ) );
        if ( $price )      update_post_meta( $product_id, '_price', $sale_price ? wc_format_decimal( $sale_price ) : wc_format_decimal( $price ) );

        if ( '' !== $stock ) {
            update_post_meta( $product_id, '_manage_stock', 'yes' );
            update_post_meta( $product_id, '_stock', (int) $stock );
            update_post_meta( $product_id, '_stock_status', ( (int) $stock > 0 ) ? 'instock' : 'outofstock' );
        } else {
            update_post_meta( $product_id, '_stock_status', 'instock' );
        }

        // Categories
        if ( $categories ) {
            $cat_names  = array_map( 'trim', explode( '|', $categories ) );
            $cat_ids    = [];
            foreach ( $cat_names as $cn ) {
                if ( $cn ) {
                    $cat_ids[] = lamacupa_get_or_create_term_id( $cn, 'product_cat' );
                }
            }
            $cat_ids = array_filter( $cat_ids );
            if ( $cat_ids ) wp_set_object_terms( $product_id, $cat_ids, 'product_cat' );
        }

        // Tags
        if ( $tags ) {
            $tag_names = array_map( 'trim', explode( '|', $tags ) );
            wp_set_object_terms( $product_id, $tag_names, 'product_tag' );
        }

        // Images
        if ( $images ) {
            $image_urls = array_map( 'trim', explode( '|', $images ) );
            $first_set  = false;
            foreach ( $image_urls as $img_url ) {
                if ( ! filter_var( $img_url, FILTER_VALIDATE_URL ) ) continue;
                $att_id = lamacupa_sideload_image( $img_url, $product_id );
                if ( $att_id && ! is_wp_error( $att_id ) && ! $first_set ) {
                    set_post_thumbnail( $product_id, $att_id );
                    $first_set = true;
                }
            }
        }

        if ( $existing_id ) {
            $updated++;
        } else {
            $imported++;
        }
        $rows[] = [ 'name' => $name, 'status' => 'ok', 'note' => $action_label . ' (ID: ' . $product_id . ')' ];
    }

    fclose( $handle ); // phpcs:ignore

    // Clear WooCommerce transients
    if ( function_exists( 'wc_delete_product_transients' ) ) {
        wc_delete_product_transients();
    }

    $message = sprintf(
        'Importazione CSV completata: <strong>%d nuovi prodotti</strong>, %d aggiornati, %d errori.',
        $imported, $updated, $errors
    );

    wp_send_json_success( [
        'message' => $message,
        'rows'    => array_slice( $rows, 0, 100 ),
    ] );
}

/* ============================================================
   AJAX HANDLER: IMPORT ZIP (Images)
   ============================================================ */
add_action( 'wp_ajax_lamacupa_import_zip', 'lamacupa_ajax_import_zip' );
function lamacupa_ajax_import_zip() {
    if ( ! check_ajax_referer( 'lamacupa_import_nonce', 'lamacupa_import_nonce_zip', false ) ) {
        wp_send_json_error( [ 'message' => 'Errore di sicurezza. Ricarica la pagina e riprova.' ] );
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => 'Permessi insufficienti.' ] );
    }
    if ( ! class_exists( 'ZipArchive' ) ) {
        wp_send_json_error( [ 'message' => 'L\'estensione ZipArchive di PHP non è disponibile su questo server.' ] );
    }

    if ( empty( $_FILES['import_zip_file']['tmp_name'] ) ) {
        wp_send_json_error( [ 'message' => 'Nessun file ZIP ricevuto.' ] );
    }

    $file = $_FILES['import_zip_file']; // phpcs:ignore
    $ext  = strtolower( pathinfo( sanitize_file_name( $file['name'] ), PATHINFO_EXTENSION ) );
    if ( 'zip' !== $ext ) {
        wp_send_json_error( [ 'message' => 'Il file deve essere in formato .zip.' ] );
    }

    $match_by_filename = ! empty( $_POST['match_by_filename'] );
    $skip_duplicates   = ! empty( $_POST['skip_duplicates'] );

    $zip = new ZipArchive();
    $res = $zip->open( $file['tmp_name'] );
    if ( true !== $res ) {
        wp_send_json_error( [ 'message' => 'Impossibile aprire l\'archivio ZIP (codice errore: ' . $res . ').' ] );
    }

    $upload_dir  = wp_upload_dir();
    $tmp_extract = $upload_dir['basedir'] . '/lamacupa-import-tmp-' . time();
    wp_mkdir_p( $tmp_extract );

    $zip->extractTo( $tmp_extract );
    $zip->close();

    $allowed_exts = [ 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' ];
    $rows         = [];
    $imported     = 0;
    $errors       = 0;
    $skipped      = 0;

    // Recursively find image files
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator( $tmp_extract, RecursiveDirectoryIterator::SKIP_DOTS )
    );

    foreach ( $iterator as $fileinfo ) {
        if ( ! $fileinfo->isFile() ) continue;

        $img_ext = strtolower( pathinfo( $fileinfo->getFilename(), PATHINFO_EXTENSION ) );
        if ( ! in_array( $img_ext, $allowed_exts, true ) ) continue;

        $filename = $fileinfo->getFilename();
        $filepath = $fileinfo->getPathname();

        // Skip duplicates check
        if ( $skip_duplicates ) {
            global $wpdb;
            $existing = $wpdb->get_var( $wpdb->prepare( // phpcs:ignore
                "SELECT ID FROM {$wpdb->posts} WHERE post_type='attachment' AND post_title=%s LIMIT 1",
                pathinfo( $filename, PATHINFO_FILENAME )
            ) );
            if ( $existing ) {
                $rows[] = [ 'name' => $filename, 'status' => 'skip', 'note' => 'Già presente in libreria' ];
                $skipped++;
                continue;
            }
        }

        // Sideload into media library
        $file_array = [
            'name'     => $filename,
            'tmp_name' => $filepath,
        ];

        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $post_id = 0;

        // Try to match to a post
        if ( $match_by_filename ) {
            $basename   = pathinfo( $filename, PATHINFO_FILENAME );
            global $wpdb;
            $post_id = (int) $wpdb->get_var( $wpdb->prepare( // phpcs:ignore
                "SELECT ID FROM {$wpdb->posts} WHERE post_name=%s AND post_status='publish' LIMIT 1",
                sanitize_title( $basename )
            ) );
        }

        $att_id = media_handle_sideload( $file_array, $post_id );

        if ( is_wp_error( $att_id ) ) {
            $rows[] = [ 'name' => $filename, 'status' => 'error', 'note' => $att_id->get_error_message() ];
            $errors++;
        } else {
            // Set as featured image if matched
            if ( $match_by_filename && $post_id && ! has_post_thumbnail( $post_id ) ) {
                set_post_thumbnail( $post_id, $att_id );
            }
            $rows[] = [ 'name' => $filename, 'status' => 'ok', 'note' => 'Importata (ID: ' . $att_id . ')' ];
            $imported++;
        }
    }

    // Cleanup temp dir
    lamacupa_rmdir_recursive( $tmp_extract );

    $message = sprintf(
        'Importazione ZIP completata: <strong>%d immagini importate</strong>, %d saltate, %d errori.',
        $imported, $skipped, $errors
    );

    wp_send_json_success( [
        'message' => $message,
        'rows'    => array_slice( $rows, 0, 100 ),
    ] );
}

/* ============================================================
   HELPER: SIDELOAD IMAGE FROM URL
   ============================================================ */
function lamacupa_sideload_image( $url, $post_id = 0 ) {
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $tmp = download_url( $url );
    if ( is_wp_error( $tmp ) ) {
        return $tmp;
    }

    $file_array = [
        'name'     => basename( parse_url( $url, PHP_URL_PATH ) ),
        'tmp_name' => $tmp,
    ];

    $id = media_handle_sideload( $file_array, $post_id );

    if ( is_wp_error( $id ) ) {
        @unlink( $tmp ); // phpcs:ignore
    }

    return $id;
}

/* ============================================================
   HELPER: RECURSIVE RMDIR
   ============================================================ */
function lamacupa_rmdir_recursive( $dir ) {
    if ( ! is_dir( $dir ) ) return;
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator( $dir, RecursiveDirectoryIterator::SKIP_DOTS ),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ( $items as $item ) {
        if ( $item->isDir() ) {
            rmdir( $item->getPathname() );
        } else {
            unlink( $item->getPathname() );
        }
    }
    rmdir( $dir );
}
