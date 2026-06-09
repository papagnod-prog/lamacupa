<?php
/**
 * Template Name: La Nostra Terra
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <!-- Hero -->
    <section class="page-hero" aria-labelledby="terraTitle">
        <div
            class="page-hero__bg"
            style="background-image:url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/terra-bg.jpg');background-color:#3a5020"
            aria-hidden="true"
        ></div>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">Il Territorio</span>
            <h1 id="terraTitle">La Nostra Terra</h1>
            <p class="lead">Oltre 200 ettari di oliveti millenari tra Puglia e Basilicata.</p>
        </div>
    </section>

    <!-- Intro -->
    <section class="section section--cream text-center">
        <div class="container container--narrow">
            <span class="eyebrow">Il Paesaggio</span>
            <h2>Una Terra di Ulivi Millenari</h2>
            <div class="divider"></div>
            <p class="lead">
                Le nostre campagne si estendono sulle dolci colline argillose della Basilicata
                e sulle distese piatte e soleggiate della Puglia. Un paesaggio unico al mondo,
                dove gli ulivi centenari coesistono con la macchia mediterranea, le mandrie di pecore
                e i calanchi di argilla grigia.
            </p>
            <p>
                Il microclima &egrave; determinante: inverni freddi che spezzano il ciclo dei parassiti,
                estati calde e ventilate che favoriscono la maturazione graduale delle olive.
                Il suolo, ricco di argilla e calcare, dona all&rsquo;olio la sua caratteristica
                mineralit&agrave; e robustezza.
            </p>
        </div>
    </section>

    <!-- Territorio numeri -->
    <section class="section section--olive" aria-label="I numeri">
        <div class="container">
            <div class="grid grid--4 text-center stagger-children">

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">200+</div>
                    <div style="color:var(--color-white);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;font-size:0.85rem;margin-top:8px">Ettari di Oliveti</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">5.000+</div>
                    <div style="color:var(--color-white);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;font-size:0.85rem;margin-top:8px">Ulivi Coltivati</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">350 m</div>
                    <div style="color:var(--color-white);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;font-size:0.85rem;margin-top:8px">Altitudine Media</div>
                </div>

                <div class="fade-up">
                    <div style="font-family:var(--font-heading);font-size:3rem;font-weight:700;color:var(--color-earth-light)">Bio</div>
                    <div style="color:var(--color-white);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;font-size:0.85rem;margin-top:8px">Certificazione Biologica</div>
                </div>

            </div>
        </div>
    </section>

    <!-- Cultivar Section -->
    <section class="section section--white" aria-labelledby="cultivarTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Le Variet&agrave;</span>
                <h2 id="cultivarTitle">Le Nostre Cultivar</h2>
                <div class="divider"></div>
                <p class="section-subtitle">
                    Coltiviamo esclusivamente cultivar autoctone pugliesi e lucane, selezionate nei secoli
                    per adattarsi perfettamente al nostro territorio.
                </p>
            </div>

            <div class="grid grid--2 stagger-children" style="gap:48px;align-items:center">

                <!-- Coratina -->
                <article class="card fade-up" style="overflow:visible">
                    <div style="background:linear-gradient(135deg,#5C6B2E,#8B9A3A);padding:48px;border-radius:8px 8px 0 0;text-align:center;font-size:5rem">🫒</div>
                    <div class="card__body" style="padding:40px">
                        <span class="card__eyebrow">Cultivar Autoctona</span>
                        <h3 class="card__title" style="font-size:1.7rem">Coratina</h3>
                        <p>
                            La Coratina &egrave; la cultivar regina della nostra azienda. Originaria di Corato (Bari),
                            &egrave; nota per l&rsquo;altissimo contenuto di polifenoli, che le conferisce
                            quel caratteristico sapore amaro e piccante tanto apprezzato dagli intenditori.
                        </p>
                        <p>
                            Il nostro olio Coratina monocultivar si distingue per note erbacee intense,
                            sentori di mandorla verde, carciofo e pomodoro. &Egrave; un olio robusto,
                            ideale per bruschette, zuppe di legumi e carni alla griglia.
                        </p>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px">
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Acidit&agrave;</div>
                                <div style="font-weight:700">&lt; 0,2%</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Raccolta</div>
                                <div style="font-weight:700">Ottobre &ndash; Novembre</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Polifenoli</div>
                                <div style="font-weight:700">800&ndash;1200 mg/kg</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Intensit&agrave;</div>
                                <div style="font-weight:700">Fruttato Intenso</div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Ogliarola Barese -->
                <article class="card fade-up" style="overflow:visible">
                    <div style="background:linear-gradient(135deg,#8B6914,#C4A882);padding:48px;border-radius:8px 8px 0 0;text-align:center;font-size:5rem">🌿</div>
                    <div class="card__body" style="padding:40px">
                        <span class="card__eyebrow">Cultivar Autoctona</span>
                        <h3 class="card__title" style="font-size:1.7rem">Ogliarola Barese</h3>
                        <p>
                            L&rsquo;Ogliarola Barese &egrave; la cultivar pi&ugrave; diffusa nella Puglia centrale.
                            Pi&ugrave; dolce e delicata rispetto alla Coratina, offre un olio dal fruttato leggero-medio,
                            con sentori di mandorla dolce, erba fresca e leggero amaro.
                        </p>
                        <p>
                            Il nostro blend Lamacupa Classico unisce Coratina (70%) e Ogliarola Barese (30%)
                            per un equilibrio perfetto tra carattere e rotondità. Ideale per crudi, insalate
                            e verdure grigliate.
                        </p>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px">
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Acidit&agrave;</div>
                                <div style="font-weight:700">&lt; 0,3%</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Raccolta</div>
                                <div style="font-weight:700">Novembre &ndash; Dicembre</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Polifenoli</div>
                                <div style="font-weight:700">300&ndash;600 mg/kg</div>
                            </div>
                            <div style="background:var(--color-cream);padding:16px;border-radius:8px">
                                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--color-olive-light);margin-bottom:4px">Intensit&agrave;</div>
                                <div style="font-weight:700">Fruttato Leggero</div>
                            </div>
                        </div>
                    </div>
                </article>

            </div><!-- /.grid -->
        </div>
    </section>

    <!-- Metodo Biologico -->
    <section class="section section--cream" aria-labelledby="biologicoTitle">
        <div class="container">

            <div class="grid grid--2" style="gap:64px;align-items:center">

                <div>
                    <span class="eyebrow">Metodo di Coltivazione</span>
                    <h2 id="biologicoTitle">Agricoltura Biologica e Sostenibile</h2>
                    <div class="divider divider--left"></div>
                    <p>
                        Dal 1992 coltiviamo i nostri oliveti in modo biologico certificato, senza l&rsquo;uso
                        di pesticidi, erbicidi o fertilizzanti di sintesi. La salute del suolo &egrave;
                        la nostra prima priorit&agrave;: pratichiamo tecniche di cover cropping con essenze
                        selvatiche che arricchiscono la biodiversit&agrave; e migliorano la struttura del terreno.
                    </p>
                    <p>
                        La lotta agli insetti nocivi avviene esclusivamente con metodi biologici: trappole
                        cromatiche, diffusori di feromoni e introduzione di insetti predatori naturali.
                        Le potature vengono effettuate rispettando i ritmi vegetativi dell&rsquo;ulivo,
                        mai in modo aggressivo.
                    </p>
                    <p>
                        L&rsquo;acqua piovana &egrave; raccolta in vasche e riutilizzata per l&rsquo;irrigazione
                        di soccorso nelle stagioni pi&ugrave; siccitose, riducendo al minimo il prelievo
                        idrico dalla falda.
                    </p>

                    <div class="mt-32" style="display:flex;flex-wrap:wrap;gap:12px">
                        <span style="background:var(--color-olive-dark);color:white;padding:8px 16px;border-radius:20px;font-size:0.82rem;font-weight:700">
                            🌱 Biologico Certificato
                        </span>
                        <span style="background:var(--color-olive-dark);color:white;padding:8px 16px;border-radius:20px;font-size:0.82rem;font-weight:700">
                            💧 Zero Spreco Idrico
                        </span>
                        <span style="background:var(--color-olive-dark);color:white;padding:8px 16px;border-radius:20px;font-size:0.82rem;font-weight:700">
                            ♻️ Compostaggio Residui
                        </span>
                        <span style="background:var(--color-olive-dark);color:white;padding:8px 16px;border-radius:20px;font-size:0.82rem;font-weight:700">
                            🦋 Biodiversit&agrave; Protetta
                        </span>
                    </div>
                </div>

                <div>
                    <div
                        style="width:100%;height:400px;background:linear-gradient(135deg,#3a5020,#5C6B2E);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:6rem"
                        aria-hidden="true"
                    >🌿</div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section
        class="banner-section"
        style="background-image:url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/terra-cta-bg.jpg');background-color:#2a3518;padding:100px 0"
    >
        <div class="banner-section__overlay"></div>
        <div class="banner-section__content fade-up">
            <span class="eyebrow" style="color:var(--color-earth-light)">Vivi la Terra</span>
            <h2>Visita i Nostri Oliveti</h2>
            <p>Cammina tra ulivi centenari, respira l&rsquo;aria pulita della nostra campagna.</p>
            <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="btn btn--white btn--lg">
                Prenota una Visita
            </a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
