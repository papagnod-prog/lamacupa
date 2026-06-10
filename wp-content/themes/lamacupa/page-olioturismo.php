<?php
/**
 * Template Name: Olioturismo
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();

$experiences = [
    [
        'icon'     => '🚶',
        'badge'    => 'Tour Guidato',
        'title'    => 'Passeggiata tra gli Ulivi',
        'desc'     => 'Una camminata guidata di 2 ore tra gli oliveti millenari dell\'azienda. Il nostro agronomo vi racconterà la storia di ogni cultivar, le tecniche di potatura e cura dell\'ulivo. Il percorso è adatto a tutta la famiglia.',
        'duration' => '2 ore',
        'group'    => 'Max 15 persone',
        'period'   => 'Tutto l\'anno',
        'price'    => '€ 15 a persona',
    ],
    [
        'icon'     => '🫒',
        'badge'    => 'Esperienza Sensoriale',
        'title'    => 'Degustazione Guidata di Oli',
        'desc'     => 'Un viaggio sensoriale attraverso i nostri oli monocultivar e blend. La nostra panel leader certificata COI vi guiderà alla scoperta dei profumi, aromi e sapori dell\'olio extravergine d\'alta qualità. Include pane, bruschette e abbinamenti gastronomici.',
        'duration' => '1,5 ore',
        'group'    => 'Max 20 persone',
        'period'   => 'Tutto l\'anno',
        'price'    => '€ 25 a persona',
    ],
    [
        'icon'     => '🏺',
        'badge'    => 'Visita in Cantina',
        'title'    => 'Il Segreto degli Orci',
        'desc'     => 'Una visita esclusiva alla nostra cantina degli orci di terracotta. Scoprite il metodo di conservazione tradizionale, la storia degli orci nel Mediterraneo antico e la differenza organolettica rispetto alla conservazione in acciaio. Degustazione comparativa inclusa.',
        'duration' => '1 ora',
        'group'    => 'Max 12 persone',
        'period'   => 'Tutto l\'anno',
        'price'    => '€ 20 a persona',
    ],
    [
        'icon'     => '⚙️',
        'badge'    => 'Visita al Frantoio',
        'title'    => 'Il Frantoio in Azione',
        'desc'     => 'Durante la stagione di raccolta (ottobre-novembre) è possibile visitare il frantoio in piena attività. Vedrete l\'intero ciclo di molitura, dall\'oliva alla goccia d\'olio, con la possibilità di assaggiare l\'olio appena estratto ancora torbido.',
        'duration' => '2 ore',
        'group'    => 'Max 20 persone',
        'period'   => 'Ottobre – Novembre',
        'price'    => '€ 18 a persona',
    ],
    [
        'icon'     => '🌾',
        'badge'    => 'Raccolta Partecipata',
        'title'    => 'La Raccolta delle Olive',
        'desc'     => 'Partecipate attivamente alla raccolta tradizionale delle olive con pettini e reti. Un\'esperienza autentica e coinvolgente che vi permetterà di capire davvero la fatica e la passione che stanno dietro a ogni bottiglia. Pranzo in azienda incluso.',
        'duration' => 'Giornata intera',
        'group'    => 'Max 10 persone',
        'period'   => 'Ottobre – Novembre',
        'price'    => '€ 60 a persona',
    ],
    [
        'icon'     => '🍽️',
        'badge'    => 'Pranzo in Azienda',
        'title'    => 'Tavola Contadina Lucana',
        'desc'     => 'Un pranzo genuino preparato con i prodotti dell\'azienda e del territorio: pane di grano duro, pasta fatta in casa, verdure dell\'orto, carni locali, formaggi e naturalmente il nostro olio extravergine in abbondanza. Possibilità di pacchi regalo con i prodotti degustati.',
        'duration' => '2-3 ore',
        'group'    => 'Max 25 persone',
        'period'   => 'Tutto l\'anno (prenotazione)',
        'price'    => '€ 35 a persona',
    ],
];
?>

<div class="page-content">

    <!-- Hero -->
    <section class="page-hero" aria-labelledby="olioturismoTitle">
        <div
            class="page-hero__bg"
            style="background-image:url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/olioturismo-bg.jpg');background-color:#2a4010"
            aria-hidden="true"
        ></div>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">Esperienze in Azienda</span>
            <h1 id="olioturismoTitle">Olioturismo</h1>
            <p class="lead">Vivi la magia degli ulivi millenari. Visita, degusta, partecipa.</p>
        </div>
    </section>

    <!-- Intro -->
    <section class="section section--cream text-center">
        <div class="container container--narrow">
            <span class="eyebrow">Benvenuti</span>
            <h2>L&rsquo;Azienda Aperta al Mondo</h2>
            <div class="divider"></div>
            <p class="lead">
                Lamacupa &egrave; molto pi&ugrave; di un&rsquo;azienda agricola: &egrave; un luogo dove
                la storia, la natura e la cultura gastronomica si intrecciano in esperienze autentiche
                e indimenticabili.
            </p>
            <p>
                Dal 2015 ospitiamo visitatori da tutto il mondo che vogliono conoscere da vicino il mondo
                dell&rsquo;olio extravergine d&rsquo;oliva: dalla cura degli ulivi alla molitura,
                dalla conservazione in orci alla degustazione professionale.
                Ogni visita &egrave; su misura e guidata dai nostri esperti.
            </p>
        </div>
    </section>

    <!-- Experiences Grid -->
    <section class="section section--white" aria-labelledby="experiencesTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Le Esperienze</span>
                <h2 id="experiencesTitle">Cosa Puoi Fare in Azienda</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--auto-fit-300 stagger-children">
                <?php foreach ( $experiences as $exp ) : ?>
                <article class="experience-card fade-up">
                    <div class="experience-card__image-wrap" aria-hidden="true">
                        <span><?php echo $exp['icon']; ?></span>
                        <span class="experience-card__badge"><?php echo esc_html( $exp['badge'] ); ?></span>
                    </div>
                    <div class="experience-card__body">
                        <h3 class="experience-card__title"><?php echo esc_html( $exp['title'] ); ?></h3>
                        <p class="experience-card__desc"><?php echo esc_html( $exp['desc'] ); ?></p>
                        <div class="experience-card__meta">
                            <span class="experience-card__meta-item">
                                <span aria-hidden="true">⏱</span>
                                <?php echo esc_html( $exp['duration'] ); ?>
                            </span>
                            <span class="experience-card__meta-item">
                                <span aria-hidden="true">👥</span>
                                <?php echo esc_html( $exp['group'] ); ?>
                            </span>
                            <span class="experience-card__meta-item">
                                <span aria-hidden="true">📅</span>
                                <?php echo esc_html( $exp['period'] ); ?>
                            </span>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
                            <span style="font-family:var(--font-heading);font-size:1.2rem;font-weight:700;color:var(--color-olive-dark)">
                                <?php echo esc_html( $exp['price'] ); ?>
                            </span>
                            <a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn btn--primary btn--sm">
                                Prenota
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div><!-- /.grid -->

        </div>
    </section>

    <!-- Come Arrivare / Info Pratiche -->
    <section class="section section--cream" aria-labelledby="infoTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Informazioni Pratiche</span>
                <h2 id="infoTitle">Tutto Quello che Devi Sapere</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--3 stagger-children">

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">📍</div>
                    <h3 class="feature-card__title">Come Arrivare</h3>
                    <p class="feature-card__text">
                        Siamo a Montescaglioso (MT), a circa 20 km da Matera e 60 km da Bari.
                        In auto: uscita A14 Taranto-Bari, poi SS99. Parcheggio gratuito in azienda.
                        Su richiesta, transfer da Matera.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">📞</div>
                    <h3 class="feature-card__title">Prenotazioni</h3>
                    <p class="feature-card__text">
                        Tutte le esperienze richiedono prenotazione almeno 48 ore prima.
                        Contattaci via email o telefono. Per gruppi superiori a 10 persone
                        consigliamo una settimana di anticipo.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">⚠️</div>
                    <h3 class="feature-card__title">Note Importanti</h3>
                    <p class="feature-card__text">
                        Indossate scarpe comode per i tour in campo. I bambini sono benvenuti.
                        Siamo adatti anche a gruppi con disabilit&agrave; motorie (su richiesta).
                        Alcuni tour stagionali disponibili solo in certi mesi.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Calendario Stagionale -->
    <section class="section section--white" aria-labelledby="calendarioTitle">
        <div class="container container--narrow">

            <div class="text-center mb-40">
                <span class="eyebrow">Il Calendario</span>
                <h2 id="calendarioTitle">Quando Venirci</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--2" style="gap:32px">

                <div style="background:var(--color-cream);border-radius:8px;padding:32px">
                    <h3 style="margin-bottom:16px">🌸 Primavera / Estate</h3>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
                        <li style="display:flex;gap:12px;font-size:0.95rem">
                            <span style="color:var(--color-olive-light);font-weight:700">✓</span>
                            Passeggiate tra gli oliveti in fiore
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem">
                            <span style="color:var(--color-olive-light);font-weight:700">✓</span>
                            Degustazioni di oli della stagione precedente
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem">
                            <span style="color:var(--color-olive-light);font-weight:700">✓</span>
                            Visita alla cantina degli orci
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem">
                            <span style="color:var(--color-olive-light);font-weight:700">✓</span>
                            Pranzo contadino con prodotti di stagione
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem">
                            <span style="color:var(--color-olive-light);font-weight:700">✓</span>
                            Corsi di cucina con l&rsquo;olio extravergine
                        </li>
                    </ul>
                </div>

                <div style="background:linear-gradient(135deg,#3a4a20,#5C6B2E);border-radius:8px;padding:32px;color:white">
                    <h3 style="color:white;margin-bottom:16px">🍂 Autunno (Ottobre-Novembre)</h3>
                    <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
                        <li style="display:flex;gap:12px;font-size:0.95rem;color:rgba(255,255,255,0.9)">
                            <span style="color:var(--color-earth-light);font-weight:700">★</span>
                            <strong style="color:white">Raccolta delle olive</strong> &mdash; esperienza unica!
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem;color:rgba(255,255,255,0.9)">
                            <span style="color:var(--color-earth-light);font-weight:700">★</span>
                            Visita al frantoio in piena attività
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem;color:rgba(255,255,255,0.9)">
                            <span style="color:var(--color-earth-light);font-weight:700">★</span>
                            Assaggio dell&rsquo;olio appena estratto
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem;color:rgba(255,255,255,0.9)">
                            <span style="color:var(--color-earth-light);font-weight:700">★</span>
                            Riempimento degli orci con il nuovo olio
                        </li>
                        <li style="display:flex;gap:12px;font-size:0.95rem;color:rgba(255,255,255,0.9)">
                            <span style="color:var(--color-earth-light);font-weight:700">★</span>
                            Festival della raccolta (fine ottobre)
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="section section--cream">
        <div class="container container--narrow">
            <div class="grid grid--2 stagger-children">
                <div class="testimonial fade-up">
                    <p class="testimonial__text">
                        &ldquo;Abbiamo portato i nostri ragazzi alla raccolta delle olive: è stata l'esperienza
                        più autentica e coinvolgente che potessimo offrire loro. Un giorno indimenticabile.&rdquo;
                    </p>
                    <span class="testimonial__author">— Famiglia Rossetti, Torino</span>
                </div>
                <div class="testimonial fade-up">
                    <p class="testimonial__text">
                        &ldquo;La degustazione guidata mi ha cambiato il modo di percepire l'olio. Rosa è
                        una professionista straordinaria. Siamo tornati tre volte in due anni.&rdquo;
                    </p>
                    <span class="testimonial__author">— Chef Marco P., Napoli</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking CTA -->
    <section class="section section--olive text-center">
        <div class="container">
            <span class="eyebrow" style="color:var(--color-earth-light)">Prenota Ora</span>
            <h2 style="color:var(--color-white);margin-bottom:16px">Scegli la Tua Esperienza</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:560px;margin:0 auto 36px;font-size:1.05rem">
                Contattaci per prenotare o per costruire un&rsquo;esperienza su misura per il tuo gruppo,
                team building aziendale o evento privato.
            </p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn btn--white btn--lg">
                    Prenota un&rsquo;Esperienza
                </a>
                <a href="mailto:visite@lamacupa.it" class="btn btn--outline-white btn--lg">
                    visite@lamacupa.it
                </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer();
