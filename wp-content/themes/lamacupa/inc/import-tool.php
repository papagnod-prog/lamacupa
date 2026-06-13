<?php defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', function () {
    add_management_page( 'Importa da Vecchio Sito', 'Importa da Vecchio Sito', 'manage_options', 'lamacupa-import', 'lamacupa_import_page' );
} );

function lamacupa_import_page() { ?>
    <div class="wrap">
      <h1>📦 Importa da Vecchio Sito WordPress</h1>
      <p>Importa prodotti, articoli e immagini dal tuo vecchio sito WordPress.</p>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:28px">

        <!-- XML -->
        <div style="background:#fff;border:1px solid #ddd;border-radius:6px;padding:24px">
          <h2 style="font-size:1.1rem;margin-bottom:12px">📄 WordPress XML (WXR)</h2>
          <p style="font-size:.88rem;color:#666;margin-bottom:16px">Esporta dal vecchio sito: <strong>Strumenti → Esporta → Tutto il contenuto</strong>, poi carica qui il file .xml</p>
          <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field( 'lm_import_xml' ) ?>
            <input type="hidden" name="lm_action" value="import_xml">
            <div style="margin-bottom:12px"><label style="font-size:.85rem;font-weight:700">File XML</label><input type="file" name="import_file" accept=".xml" style="display:block;margin-top:6px"></div>
            <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:16px">
              <label><input type="checkbox" name="import_posts" value="1" checked> Articoli del blog</label>
              <label><input type="checkbox" name="import_pages" value="1"> Pagine</label>
              <label><input type="checkbox" name="import_products" value="1" checked> Prodotti WooCommerce</label>
            </div>
            <input type="submit" class="button button-primary" value="Importa XML">
          </form>
          <?php if ( isset( $_POST['lm_action'] ) && $_POST['lm_action'] === 'import_xml' ) lamacupa_do_import_xml() ?>
        </div>

        <!-- CSV -->
        <div style="background:#fff;border:1px solid #ddd;border-radius:6px;padding:24px">
          <h2 style="font-size:1.1rem;margin-bottom:12px">📊 Prodotti CSV (WooCommerce)</h2>
          <p style="font-size:.88rem;color:#666;margin-bottom:16px">Colonne richieste: <code>Name, SKU, Description, Short Description, Regular Price, Stock, Categories, Images</code></p>
          <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field( 'lm_import_csv' ) ?>
            <input type="hidden" name="lm_action" value="import_csv">
            <div style="margin-bottom:16px"><label style="font-size:.85rem;font-weight:700">File CSV</label><input type="file" name="import_file" accept=".csv" style="display:block;margin-top:6px"></div>
            <input type="submit" class="button button-primary" value="Importa Prodotti">
          </form>
          <?php if ( isset( $_POST['lm_action'] ) && $_POST['lm_action'] === 'import_csv' ) lamacupa_do_import_csv() ?>
        </div>

        <!-- ZIP -->
        <div style="background:#fff;border:1px solid #ddd;border-radius:6px;padding:24px">
          <h2 style="font-size:1.1rem;margin-bottom:12px">🖼 Immagini ZIP</h2>
          <p style="font-size:.88rem;color:#666;margin-bottom:16px">Carica uno zip con le immagini. Verranno importate nella Media Library di WordPress.</p>
          <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field( 'lm_import_zip' ) ?>
            <input type="hidden" name="lm_action" value="import_zip">
            <div style="margin-bottom:16px"><label style="font-size:.85rem;font-weight:700">File ZIP</label><input type="file" name="import_file" accept=".zip" style="display:block;margin-top:6px"></div>
            <input type="submit" class="button button-primary" value="Importa Immagini">
          </form>
          <?php if ( isset( $_POST['lm_action'] ) && $_POST['lm_action'] === 'import_zip' ) lamacupa_do_import_zip() ?>
        </div>

      </div>
    </div>
    <?php
}

function lamacupa_do_import_xml() {
    if ( ! check_admin_referer( 'lm_import_xml' ) ) return;
    if ( empty( $_FILES['import_file']['tmp_name'] ) ) { echo '<div class="notice notice-error"><p>Nessun file caricato.</p></div>'; return; }
    $file = $_FILES['import_file']['tmp_name'];
    libxml_use_internal_errors( true );
    $xml = simplexml_load_file( $file );
    if ( ! $xml ) { echo '<div class="notice notice-error"><p>File XML non valido.</p></div>'; return; }
    $ns      = $xml->getNamespaces( true );
    $channel = $xml->channel;
    $items   = $channel->item;
    $import_posts    = ! empty( $_POST['import_posts'] );
    $import_pages    = ! empty( $_POST['import_pages'] );
    $import_products = ! empty( $_POST['import_products'] );
    $count = [ 'post' => 0, 'page' => 0, 'product' => 0, 'skip' => 0 ];
    foreach ( $items as $item ) {
        $wp  = $item->children( $ns['wp'] ?? '' );
        $type = (string) $wp->post_type;
        if ( $type === 'post' && ! $import_posts ) { $count['skip']++; continue; }
        if ( $type === 'page' && ! $import_pages ) { $count['skip']++; continue; }
        if ( $type === 'product' && ! $import_products ) { $count['skip']++; continue; }
        if ( ! in_array( $type, [ 'post', 'page', 'product' ], true ) ) continue;
        $slug = (string) $wp->post_name;
        if ( get_page_by_path( $slug, OBJECT, $type ) ) { $count['skip']++; continue; }
        $post_id = wp_insert_post( [
            'post_title'   => (string) $item->title,
            'post_content' => (string) $item->children( 'http://purl.org/rss/1.0/modules/content/' )->encoded,
            'post_excerpt' => (string) $item->children( $ns['excerpt'] ?? '' )->encoded,
            'post_status'  => (string) $wp->status === 'publish' ? 'publish' : 'draft',
            'post_type'    => $type,
            'post_name'    => $slug,
            'post_date'    => (string) $wp->post_date,
        ] );
        if ( ! is_wp_error( $post_id ) ) $count[ $type ]++;
    }
    echo '<div class="notice notice-success"><p>✅ Importati: <strong>' . $count['post'] . '</strong> articoli, <strong>' . $count['page'] . '</strong> pagine, <strong>' . $count['product'] . '</strong> prodotti. Saltati: ' . $count['skip'] . '</p></div>';
}

function lamacupa_do_import_csv() {
    if ( ! check_admin_referer( 'lm_import_csv' ) ) return;
    if ( empty( $_FILES['import_file']['tmp_name'] ) ) { echo '<div class="notice notice-error"><p>Nessun file caricato.</p></div>'; return; }
    if ( ! class_exists( 'WooCommerce' ) ) { echo '<div class="notice notice-error"><p>WooCommerce non è attivo.</p></div>'; return; }
    $file   = fopen( $_FILES['import_file']['tmp_name'], 'r' );
    $header = fgetcsv( $file );
    $header = array_map( 'trim', $header );
    $map    = array_flip( $header );
    $count  = 0; $skip = 0;
    while ( ( $row = fgetcsv( $file ) ) !== false ) {
        $d = [];
        foreach ( $header as $i => $h ) $d[ $h ] = isset( $row[ $i ] ) ? trim( $row[ $i ] ) : '';
        $name = $d['Name'] ?? $d['name'] ?? '';
        if ( ! $name ) { $skip++; continue; }
        $sku = $d['SKU'] ?? $d['sku'] ?? '';
        if ( $sku && wc_get_product_id_by_sku( $sku ) ) { $skip++; continue; }
        $post_id = wp_insert_post( [
            'post_title'   => $name,
            'post_content' => $d['Description'] ?? $d['description'] ?? '',
            'post_excerpt' => $d['Short Description'] ?? $d['short_description'] ?? '',
            'post_status'  => 'publish',
            'post_type'    => 'product',
        ] );
        if ( is_wp_error( $post_id ) ) { $skip++; continue; }
        $price = $d['Regular Price'] ?? $d['regular_price'] ?? $d['Price'] ?? '';
        update_post_meta( $post_id, '_regular_price', $price );
        update_post_meta( $post_id, '_price', $price );
        if ( $sku ) update_post_meta( $post_id, '_sku', $sku );
        $stock = $d['Stock'] ?? $d['stock_quantity'] ?? '';
        if ( $stock !== '' ) { update_post_meta( $post_id, '_stock', intval( $stock ) ); update_post_meta( $post_id, '_manage_stock', 'yes' ); }
        wp_set_object_terms( $post_id, 'simple', 'product_type' );
        $cats = $d['Categories'] ?? $d['category'] ?? '';
        if ( $cats ) {
            $cat_names = array_map( 'trim', explode( ',', $cats ) );
            $term_ids  = [];
            foreach ( $cat_names as $cn ) {
                $term = term_exists( $cn, 'product_cat' ) ?: wp_insert_term( $cn, 'product_cat' );
                if ( ! is_wp_error( $term ) ) $term_ids[] = (int) ( $term['term_id'] ?? $term );
            }
            if ( $term_ids ) wp_set_object_terms( $post_id, $term_ids, 'product_cat' );
        }
        $count++;
    }
    fclose( $file );
    echo '<div class="notice notice-success"><p>✅ Importati <strong>' . $count . '</strong> prodotti. Saltati: ' . $skip . '</p></div>';
}

function lamacupa_do_import_zip() {
    if ( ! check_admin_referer( 'lm_import_zip' ) ) return;
    if ( empty( $_FILES['import_file']['tmp_name'] ) ) { echo '<div class="notice notice-error"><p>Nessun file caricato.</p></div>'; return; }
    if ( ! class_exists( 'ZipArchive' ) ) { echo '<div class="notice notice-error"><p>ZipArchive non disponibile su questo server.</p></div>'; return; }
    $zip  = new ZipArchive();
    $tmp  = $_FILES['import_file']['tmp_name'];
    if ( $zip->open( $tmp ) !== true ) { echo '<div class="notice notice-error"><p>Impossibile aprire il file ZIP.</p></div>'; return; }
    $upload   = wp_upload_dir();
    $dest_dir = trailingslashit( $upload['basedir'] ) . 'lamacupa-import/';
    wp_mkdir_p( $dest_dir );
    $zip->extractTo( $dest_dir );
    $zip->close();
    $exts    = [ 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' ];
    $files   = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dest_dir ) );
    $count   = 0;
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    foreach ( $files as $f ) {
        if ( ! $f->isFile() ) continue;
        if ( ! in_array( strtolower( $f->getExtension() ), $exts, true ) ) continue;
        $file_path = $f->getPathname();
        $file_arr  = [ 'name' => $f->getFilename(), 'tmp_name' => $file_path, 'error' => 0, 'size' => filesize( $file_path ) ];
        $id = media_handle_sideload( $file_arr, 0 );
        if ( ! is_wp_error( $id ) ) $count++;
    }
    echo '<div class="notice notice-success"><p>✅ Importate <strong>' . $count . '</strong> immagini nella Media Library.</p></div>';
}
