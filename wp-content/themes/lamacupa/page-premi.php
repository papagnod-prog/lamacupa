<?php
/**
 * Template Name: Premi
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();

$awards = [
    [
        'medal'       => '🥇',
        'title'       => 'Medaglia d\'Oro',
        'competition' => 'Sol d\'Oro International',
        'year'        => '2023',
        'category'    => 'Fruttato Intenso',
        'desc'        => 'Premiato per l\'eccezionale complessità aromatica e il contenuto record di polifenoli del nostro Coratina monocultivar.',
    ],
    [
        'medal'       => '🏆',
        'title'       => 'Gran Menzione',
        'competition' => 'Ercole Olivario',
        'year'        => '2023',
        'category'    => 'Biologico DOP',
        'desc'        => 'Riconoscimento nazionale per la qualità eccellente dell\'olio biologico nelle competizioni organizzate da Unioncamere.',
    ],
    [
        'medal'       => '⭐',
        'title'       => '5 Gocce',
        'competition' => 'Guida Flos Olei',
        'year'        => '2024',
        'category'    => 'Top 100 World',
        'desc'        => 'Il massimo riconoscimento della guida internazionale più autorevole del settore olivicolo, curata da Marco Oreggia.',
    ],
    [
        'medal'       => '🎖️',
        'title'       => 'Best Southern Italian Blend',
        'competition' => 'EVOO World Cup',
        'year'        => '2022',
        'category'    => 'Blend Biologico',
        'desc'        => 'Primo premio nella categoria blend biologici del Sud Italia al concorso internazionale di Barcellona.',
    ],
    [
        'medal'       => '🌿',
        'title'       => 'Bio Excellence Award',
        'competition' => 'BioEcoActual',
        'year'        => '2023',
        'category'    => 'Olio Biologico',
        'desc'        => 'Premio per l\'eccellenza nella produzione biologica certificata, con particolare attenzione alla sostenibilità ambientale.',
    ],
    [
        'medal'       => '🥈',
        'title'       => 'Medaglia d\'Argento',
        'competition' => 'New York International Olive Oil Competition',
        'year'        => '2023',
        'category'    => 'Fruttato Medio',
        'desc'        => 'Riconoscimento al NYIOOC, il concorso olivicolo più grande del mondo per numero di campioni partecipanti.',
    ],
    [
        'medal'       => '🏅',
        'title'       => 'Tre Foglie',
        'competition' => 'Guida Slow Food Slow Olio',
        'year'        => '2024',
        'category'    => 'Presidio Slow Food',
        'desc'        => 'Inserimento nella selezione d\'eccellenza della guida Slow Food, che valorizza la biodiversità olivicola italiana.',
    ],
    [
        'medal'       => '🌟',
        'title'       => 'Super Gold',
        'competition' => 'Terraolivo Jerusalem',
        'year'        => '2022',
        'category'    => 'Fruttato Intenso Biologico',
        'desc'        => 'Massimo riconoscimento al concorso internazionale di Gerusalemme, con panel di degustatori internazionali.',
    ],
    [
        'medal'       => '🎗️',
        'title'       => 'Miglior Olio del Sud',
        'competition' => 'Gambero Rosso – Oli d\'Italia',
        'year'        => '2023',
        'category'    => 'Tre Foglie',
        'desc'        => 'Selezione nella guida Oli d\'Italia del Gambero Rosso con il massimo riconoscimento delle Tre Foglie.',
    ],
    [
        'medal'       => '✨',
        'title'       => 'Gold Award',
        'competition' => 'Los Angeles International Olive Oil Competition',
        'year'        => '2021',
        'category'    => 'Monovarietale Biologico',
        'desc'        => 'Primo riconoscimento internazionale che ha aperto le porte ai mercati nordamericani per l\'azienda.',
    ],
    [
        'medal'       => '🎖️',
        'title'       => 'Selezione Qualit&agrave;',
        'competition' => 'Mastri Oleari',
        'year'        => '2024',
        'category'    => 'Blend Fruttato Intenso',
        'desc'        => 'Selezione annuale dei migliori oli italiani a cura del consorzio Mastri Oleari, associazione dei produttori d\'eccellenza.',
    ],
    [
        'medal'       => '🌱',
        'title'       => 'Green Producer Award',
        'competition' => 'Olive Oil Times Awards',
        'year'        => '2023',
        'category'    => 'Sostenibilit&agrave; Ambientale',
        'desc'        => 'Premio speciale per le pratiche agricole virtuose e l\'impegno nella riduzione dell\'impatto ambientale della produzione.',
    ],
];
?>

<div class="page-content">

    <!-- Hero -->
    <section class="page-hero" aria-labelledby="premiTitle">
        <div
            class="page-hero__bg"
            style="background-image:url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/premi-bg.jpg');background-color:#4a5020"
            aria-hidden="true"
        ></div>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">Riconoscimenti</span>
            <h1 id="premiTitle">I Nostri Premi</h1>
            <p class="lead">L&rsquo;eccellenza dell&rsquo;olio Lamacupa riconosciuta a livello internazionale.</p>
        </div>
    </section>

    <!-- Intro Stats -->
    <section class="section section--olive">
        <div class="container">
            <div class="grid grid--4 text-center stagger-children">

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">25+</div>
                    <div style="color:rgba(255,255,255,0.85);font-size:0.85rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-top:8px">Premi Totali</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">12</div>
                    <div style="color:rgba(255,255,255,0.85);font-size:0.85rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-top:8px">Concorsi Internazionali</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">8</div>
                    <div style="color:rgba(255,255,255,0.85);font-size:0.85rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-top:8px">Guide d&rsquo;Eccellenza</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">2013</div>
                    <div style="color:rgba(255,255,255,0.85);font-size:0.85rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-top:8px">Primo Premio Internazionale</div>
                </div>

            </div>
        </div>
    </section>

    <!-- Awards Grid -->
    <section class="section section--cream" aria-labelledby="awardsGridTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Il Palmar&egrave;s</span>
                <h2 id="awardsGridTitle">Tutti i Riconoscimenti</h2>
                <div class="divider"></div>
                <p class="section-subtitle">
                    Ogni anno i nostri oli vengono valutati dai panel di degustazione pi&ugrave; autorevoli al mondo.
                    Questi riconoscimenti confermano la nostra dedizione alla qualit&agrave; assoluta.
                </p>
            </div>

            <div class="awards-grid stagger-children">
                <?php foreach ( $awards as $award ) : ?>
                <article class="award-card fade-up">
                    <span class="award-card__medal" aria-hidden="true"><?php echo $award['medal']; ?></span>
                    <h3 class="award-card__title"><?php echo esc_html( $award['title'] ); ?></h3>
                    <p class="award-card__competition"><?php echo esc_html( $award['competition'] ); ?></p>
                    <span class="award-card__year"><?php echo esc_html( $award['year'] ); ?></span>
                    <p class="award-card__category" style="font-size:0.78rem;font-weight:700;color:var(--color-olive-light);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:12px">
                        <?php echo wp_kses_post( $award['category'] ); ?>
                    </p>
                    <p class="award-card__desc"><?php echo esc_html( $award['desc'] ); ?></p>
                </article>
                <?php endforeach; ?>
            </div><!-- /.awards-grid -->

        </div>
    </section>

    <!-- Metodologia -->
    <section class="section section--white">
        <div class="container container--narrow">
            <div class="text-center mb-32">
                <span class="eyebrow">Come Vengono Valutati</span>
                <h2>Il Panel di Degustazione</h2>
                <div class="divider"></div>
            </div>
            <p class="lead text-center">
                I nostri oli vengono sottoposti a panel test certificati COI (Consiglio Oleicolo Internazionale),
                dove assaggiatori professionisti valutano parametri sensoriali come fruttato, amaro,
                piccante, difetti e armonia generale del profilo.
            </p>
            <p class="text-center">
                Partecipiamo ai concorsi internazionali non per vanit&agrave;, ma per metterci alla prova,
                confrontarci con i migliori produttori mondiali e garantire ai nostri clienti
                una qualit&agrave; verificata da terzi indipendenti.
            </p>

            <div class="grid grid--3 mt-48" style="text-align:center">
                <div style="padding:32px;background:var(--color-cream);border-radius:8px">
                    <div style="font-size:2.5rem;margin-bottom:12px" aria-hidden="true">📋</div>
                    <h4>Panel Test COI</h4>
                    <p style="font-size:0.9rem;color:var(--color-text-light)">
                        Metodologia ufficiale del Consiglio Oleicolo Internazionale
                    </p>
                </div>
                <div style="padding:32px;background:var(--color-cream);border-radius:8px">
                    <div style="font-size:2.5rem;margin-bottom:12px" aria-hidden="true">🔬</div>
                    <h4>Analisi Chimiche</h4>
                    <p style="font-size:0.9rem;color:var(--color-text-light)">
                        Acidit&agrave;, perossidi, polifenoli certificati da laboratori accreditati
                    </p>
                </div>
                <div style="padding:32px;background:var(--color-cream);border-radius:8px">
                    <div style="font-size:2.5rem;margin-bottom:12px" aria-hidden="true">🌍</div>
                    <h4>Concorsi Internazionali</h4>
                    <p style="font-size:0.9rem;color:var(--color-text-light)">
                        Valutazioni da panel di 15+ paesi produttori
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section section--olive text-center">
        <div class="container">
            <span class="eyebrow" style="color:var(--color-earth-light)">Assaggiali</span>
            <h2 style="color:var(--color-white);margin-bottom:16px">Prova l&rsquo;Olio Premiato</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:520px;margin:0 auto 36px">
                Acquista i nostri oli premiati direttamente online o vieni a gustarli in azienda durante una degustazione guidata.
            </p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="<?php echo esc_url( home_url( '/prodotti/' ) ); ?>"    class="btn btn--white">Acquista Online</a>
                <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="btn btn--outline-white">Prenota Degustazione</a>
            </div>
        </div>
    </section>

</div>

<?php get_footer();
