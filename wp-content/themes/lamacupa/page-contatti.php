<?php
/**
 * Template Name: Contatti
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <!-- Hero -->
    <section class="page-hero" aria-labelledby="contattiTitle">
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">Siamo Qui per Voi</span>
            <h1 id="contattiTitle">Contattaci</h1>
            <p class="lead">Domande, ordini, prenotazioni visite &mdash; scriveteci, siamo sempre felici di rispondervi.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section section--cream" aria-labelledby="formTitle">
        <div class="container">

            <div class="contact-grid">

                <!-- Form Column -->
                <div>
                    <span class="eyebrow">Scrivici</span>
                    <h2 id="formTitle">Invia un Messaggio</h2>
                    <div class="divider divider--left"></div>
                    <p style="color:var(--color-text-light);margin-bottom:32px">
                        Compila il modulo sottostante e ti risponderemo entro 24 ore.
                        Per prenotazioni urgenti, ti consigliamo di chiamarci direttamente.
                    </p>

                    <?php if ( function_exists( 'wpcf7_contact_form' ) || class_exists( 'WPCF7' ) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7 id="contact" title="Contact form"]' ); ?>
                    <?php else : ?>
                        <!-- Fallback form when CF7 is not active -->
                        <form action="#" method="post" class="contact-form-fallback" novalidate>
                            <?php wp_nonce_field( 'lamacupa_contact', 'lamacupa_nonce' ); ?>

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                                <div>
                                    <label for="contact_name" style="display:block;font-size:0.85rem;font-weight:700;margin-bottom:6px">
                                        <?php esc_html_e( 'Nome *', 'lamacupa' ); ?>
                                    </label>
                                    <input
                                        type="text"
                                        id="contact_name"
                                        name="contact_name"
                                        required
                                        style="width:100%;padding:14px 18px;border:2px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;font-size:1rem"
                                        placeholder="Il tuo nome"
                                    >
                                </div>
                                <div>
                                    <label for="contact_email" style="display:block;font-size:0.85rem;font-weight:700;margin-bottom:6px">
                                        <?php esc_html_e( 'Email *', 'lamacupa' ); ?>
                                    </label>
                                    <input
                                        type="email"
                                        id="contact_email"
                                        name="contact_email"
                                        required
                                        style="width:100%;padding:14px 18px;border:2px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;font-size:1rem"
                                        placeholder="la-tua@email.it"
                                    >
                                </div>
                            </div>

                            <div style="margin-bottom:16px">
                                <label for="contact_phone" style="display:block;font-size:0.85rem;font-weight:700;margin-bottom:6px">
                                    <?php esc_html_e( 'Telefono', 'lamacupa' ); ?>
                                </label>
                                <input
                                    type="tel"
                                    id="contact_phone"
                                    name="contact_phone"
                                    style="width:100%;padding:14px 18px;border:2px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;font-size:1rem"
                                    placeholder="+39 000 000 0000"
                                >
                            </div>

                            <div style="margin-bottom:16px">
                                <label for="contact_subject" style="display:block;font-size:0.85rem;font-weight:700;margin-bottom:6px">
                                    <?php esc_html_e( 'Oggetto *', 'lamacupa' ); ?>
                                </label>
                                <select
                                    id="contact_subject"
                                    name="contact_subject"
                                    required
                                    style="width:100%;padding:14px 18px;border:2px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;font-size:1rem;background:white"
                                >
                                    <option value=""><?php esc_html_e( 'Seleziona un oggetto', 'lamacupa' ); ?></option>
                                    <option value="ordini"><?php esc_html_e( 'Ordini e prodotti', 'lamacupa' ); ?></option>
                                    <option value="visite"><?php esc_html_e( 'Prenotazione visite / Olioturismo', 'lamacupa' ); ?></option>
                                    <option value="informazioni"><?php esc_html_e( 'Informazioni generali', 'lamacupa' ); ?></option>
                                    <option value="grossisti"><?php esc_html_e( 'Grossisti e horeca', 'lamacupa' ); ?></option>
                                    <option value="pressa"><?php esc_html_e( 'Stampa e media', 'lamacupa' ); ?></option>
                                    <option value="altro"><?php esc_html_e( 'Altro', 'lamacupa' ); ?></option>
                                </select>
                            </div>

                            <div style="margin-bottom:24px">
                                <label for="contact_message" style="display:block;font-size:0.85rem;font-weight:700;margin-bottom:6px">
                                    <?php esc_html_e( 'Messaggio *', 'lamacupa' ); ?>
                                </label>
                                <textarea
                                    id="contact_message"
                                    name="contact_message"
                                    required
                                    rows="6"
                                    style="width:100%;padding:14px 18px;border:2px solid var(--color-cream-dark);border-radius:4px;font-family:inherit;font-size:1rem;resize:vertical"
                                    placeholder="Scrivi il tuo messaggio..."
                                ></textarea>
                            </div>

                            <div style="margin-bottom:24px;display:flex;gap:12px;align-items:flex-start">
                                <input type="checkbox" id="privacy_consent" name="privacy_consent" required style="margin-top:3px;flex-shrink:0">
                                <label for="privacy_consent" style="font-size:0.85rem;color:var(--color-text-light)">
                                    <?php
                                    printf(
                                        esc_html__( 'Ho letto e accetto la %s. I miei dati verranno trattati esclusivamente per rispondere alla mia richiesta.', 'lamacupa' ),
                                        '<a href="' . esc_url( home_url( '/privacy-policy/' ) ) . '" target="_blank" style="color:var(--color-olive-dark)">Privacy Policy</a>'
                                    );
                                    ?>
                                </label>
                            </div>

                            <button type="submit" class="btn btn--primary btn--lg">
                                <?php esc_html_e( 'Invia Messaggio', 'lamacupa' ); ?>
                            </button>
                        </form>
                    <?php endif; ?>

                </div><!-- /.form-column -->

                <!-- Info Column -->
                <div>
                    <span class="eyebrow">Dove Siamo</span>
                    <h2>Informazioni</h2>
                    <div class="divider divider--left"></div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon" aria-hidden="true">📍</div>
                        <div>
                            <p class="contact-info__label"><?php esc_html_e( 'Indirizzo', 'lamacupa' ); ?></p>
                            <p class="contact-info__value">
                                Via Lamacupa, km 3<br>
                                75024 Montescaglioso (MT)<br>
                                Basilicata, Italia
                            </p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon" aria-hidden="true">📞</div>
                        <div>
                            <p class="contact-info__label"><?php esc_html_e( 'Telefono', 'lamacupa' ); ?></p>
                            <p class="contact-info__value">
                                <a href="tel:+39000000000">+39 000 000 0000</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon" aria-hidden="true">✉️</div>
                        <div>
                            <p class="contact-info__label"><?php esc_html_e( 'Email', 'lamacupa' ); ?></p>
                            <p class="contact-info__value">
                                <a href="mailto:info@lamacupa.it">info@lamacupa.it</a><br>
                                <a href="mailto:visite@lamacupa.it">visite@lamacupa.it</a>
                                <span style="font-size:0.8rem;color:var(--color-text-light);display:block">(prenotazioni)</span>
                            </p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon" aria-hidden="true">🕐</div>
                        <div>
                            <p class="contact-info__label"><?php esc_html_e( 'Orari Vendita Diretta', 'lamacupa' ); ?></p>
                            <table class="hours-table">
                                <tbody>
                                    <tr>
                                        <td>Lunedì &ndash; Venerdì</td>
                                        <td>9:00 &ndash; 13:00 / 15:00 &ndash; 18:00</td>
                                    </tr>
                                    <tr>
                                        <td>Sabato</td>
                                        <td>9:00 &ndash; 13:00</td>
                                    </tr>
                                    <tr>
                                        <td>Domenica</td>
                                        <td>Su prenotazione</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon" aria-hidden="true">🏛️</div>
                        <div>
                            <p class="contact-info__label"><?php esc_html_e( 'Dati Fiscali', 'lamacupa' ); ?></p>
                            <p class="contact-info__value">
                                Azienda Agricola Lamacupa S.S.<br>
                                P.IVA: IT0000000000<br>
                                REA: MT-000000
                            </p>
                        </div>
                    </div>

                    <!-- Google Maps placeholder -->
                    <div class="map-placeholder" aria-label="<?php esc_attr_e( 'Mappa posizione azienda', 'lamacupa' ); ?>">
                        <span aria-hidden="true">🗺️</span>
                        <p>
                            <?php esc_html_e( 'Mappa Google Maps', 'lamacupa' ); ?><br>
                            <small style="font-size:0.75rem">
                                <?php esc_html_e( 'Sostituisci con l\'embed di Google Maps tramite la pagina Contatti nel backend WP', 'lamacupa' ); ?>
                            </small>
                        </p>
                    </div>
                    <!-- To embed real Google Maps, replace the div above with:
                    <iframe
                        class="map-embed"
                        src="https://www.google.com/maps/embed?pb=INSERISCI_QUI_L_URL_EMBED"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                    -->

                </div><!-- /.info-column -->

            </div><!-- /.contact-grid -->
        </div><!-- /.container -->
    </section>

    <!-- Come Arrivare -->
    <section class="section section--white" aria-labelledby="arrivoTitle">
        <div class="container">

            <div class="text-center mb-40">
                <span class="eyebrow">Raggiungici</span>
                <h2 id="arrivoTitle">Come Arrivare</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--3 stagger-children">

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🚗</div>
                    <h3 class="feature-card__title">In Auto</h3>
                    <p class="feature-card__text">
                        Da Matera: SS99 direzione Metaponto, uscita Montescaglioso (20 min).<br>
                        Da Bari: A14 uscita Taranto, poi SS407 Basentana, uscita Montescaglioso (60 min).<br>
                        Da Napoli: A3 uscita Sala Consilina, poi SS19 e SS407 (90 min).
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🚂</div>
                    <h3 class="feature-card__title">In Treno</h3>
                    <p class="feature-card__text">
                        La stazione pi&ugrave; vicina &egrave; Metaponto (linea Taranto-Reggio Calabria).
                        Da Metaponto a Montescaglioso: taxi o autobus locale (25 min).
                        Su prenotazione, offriamo transfer dalla stazione.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">✈️</div>
                    <h3 class="feature-card__title">In Aereo</h3>
                    <p class="feature-card__text">
                        Aeroporto di Bari &ldquo;Karol Wojtyla&rdquo;: 80 km (1 ora in auto).<br>
                        Aeroporto di Napoli Capodichino: 180 km (2 ore).<br>
                        Auto a noleggio disponibile presso entrambi gli aeroporti.
                    </p>
                </div>

            </div>
        </div>
    </section>

</div>

<?php get_footer();
