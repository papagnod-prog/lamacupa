<?php
/**
 * Template Name: Gli Orci
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <!-- Hero -->
    <section class="page-hero" aria-labelledby="orciTitle">
        <div
            class="page-hero__bg"
            style="background-image:url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/orci-bg.jpg');background-color:#6B4A18"
            aria-hidden="true"
        ></div>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">Tradizione Millenaria</span>
            <h1 id="orciTitle">Gli Orci</h1>
            <p class="lead">La conservazione dell&rsquo;olio in terracotta: un&rsquo;arte antica che preserva la perfezione.</p>
        </div>
    </section>

    <!-- Intro -->
    <section class="section section--cream">
        <div class="container container--narrow text-center">
            <span class="eyebrow">Il Segreto Antico</span>
            <h2>Quando la Tradizione Diventa Innovazione</h2>
            <div class="divider"></div>
            <p class="lead">
                Gli orci di terracotta sono stati per millenni il modo in cui l&rsquo;olio d&rsquo;oliva
                veniva conservato nel bacino mediterraneo. I Romani, i Greci, i Fenici &mdash; tutti
                affidavano i loro oro verde a questi contenitori di argilla cotta.
            </p>
            <p>
                Noi abbiamo riscoperto e perfezionato questa tradizione millenaria, combinandola
                con i pi&ugrave; moderni sistemi di controllo della temperatura e dell&rsquo;umidit&agrave;.
                Il risultato &egrave; un olio che mantiene intatte le sue caratteristiche organolettiche
                per mesi, sviluppando ulteriore complessit&agrave; aromatica nel tempo.
            </p>
        </div>
    </section>

    <!-- Gli Orci: Visual Feature -->
    <section class="split-section" aria-label="Gli orci di Lamacupa">
        <div
            class="split-section__image-placeholder"
            style="background:linear-gradient(135deg,#8B6914,#6B4A18);font-size:8rem"
            aria-hidden="true"
        >🏺</div>
        <div class="split-section__content">
            <span class="eyebrow">I Nostri Contenitori</span>
            <h2>Gli Orci di Lamacupa</h2>
            <div class="divider divider--left"></div>
            <p>
                I nostri orci sono realizzati a mano da maestri vasai della Basilicata, con argilla locale
                cotta a bassa temperatura. Ogni orcio ha una capacit&agrave; di circa 500 litri ed &egrave;
                trattato internamente con argilla purissima che gli conferisce la caratteristica
                impermeabilit&agrave; senza alterare le qualit&agrave; organolettiche dell&rsquo;olio.
            </p>
            <p>
                La forma &egrave; quella tradizionale della <em>dolia</em> romana: ventre ampio, collo stretto,
                base piatta per garantire stabilit&agrave;. Sono sepolti per met&agrave; nel pavimento
                della cantina, dove la temperatura rimane costante tra i 14 e i 16 gradi tutto l&rsquo;anno
                &mdash; ideale per la conservazione dell&rsquo;olio.
            </p>
            <p>
                Ogni orcio &egrave; numerato e dedicato a una singola cultivar o blend. La separazione
                permette di preservare le caratteristiche specifiche di ogni variet&agrave;.
            </p>
        </div>
    </section>

    <!-- Come funziona -->
    <section class="section section--white" aria-labelledby="processoTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Il Processo</span>
                <h2 id="processoTitle">Dal Frantoio all&rsquo;Orcio</h2>
                <p class="section-subtitle">
                    Un processo meticoloso che inizia dalla raccolta e culmina nella conservazione
                    in questi contenitori straordinari.
                </p>
                <div class="divider"></div>
            </div>

            <div class="orci-process stagger-children">

                <div class="orci-step fade-up">
                    <div class="orci-step__number">1</div>
                    <h3 class="orci-step__title">Raccolta</h3>
                    <p class="orci-step__text">
                        Le olive vengono raccolte a mano o con pettini meccanici nella prima met&agrave;
                        di ottobre, a maturazione incompleta per massimizzare i polifenoli.
                    </p>
                </div>

                <div class="orci-step fade-up">
                    <div class="orci-step__number">2</div>
                    <h3 class="orci-step__title">Molitura</h3>
                    <p class="orci-step__text">
                        Entro 24 ore dalla raccolta, le olive vengono molite a freddo (max 27°C)
                        nel nostro frantoio aziendale con gramola a due fasi.
                    </p>
                </div>

                <div class="orci-step fade-up">
                    <div class="orci-step__number">3</div>
                    <h3 class="orci-step__title">Decantazione</h3>
                    <p class="orci-step__text">
                        L&rsquo;olio appena estratto riposa 48 ore in serbatoi di acciaio inox
                        per la prima decantazione naturale delle impurezze.
                    </p>
                </div>

                <div class="orci-step fade-up">
                    <div class="orci-step__number">4</div>
                    <h3 class="orci-step__title">Trasferimento</h3>
                    <p class="orci-step__text">
                        L&rsquo;olio viene trasferito negli orci con una pompa a bassa pressione,
                        evitando l&rsquo;ossidazione. Ogni orcio viene colmato e sigillato con
                        un coperchio di terracotta.
                    </p>
                </div>

                <div class="orci-step fade-up">
                    <div class="orci-step__number">5</div>
                    <h3 class="orci-step__title">Maturazione</h3>
                    <p class="orci-step__text">
                        L&rsquo;olio matura in cantina per 2&ndash;6 mesi, sviluppando complessit&agrave;
                        aromatica grazie al naturale scambio gassoso della terracotta.
                    </p>
                </div>

                <div class="orci-step fade-up">
                    <div class="orci-step__number">6</div>
                    <h3 class="orci-step__title">Imbottigliamento</h3>
                    <p class="orci-step__text">
                        L&rsquo;olio viene imbottigliato in vetro scuro a richiesta, preservando
                        tutto il patrimonio organolettico sviluppato durante la maturazione.
                    </p>
                </div>

            </div><!-- /.orci-process -->
        </div>
    </section>

    <!-- Perch&eacute; la terracotta -->
    <section class="section section--cream" aria-labelledby="percheTerracottaTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">La Scienza Dietro la Tradizione</span>
                <h2 id="percheTerracottaTitle">Perch&eacute; la Terracotta?</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--3 stagger-children">

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🌡️</div>
                    <h3 class="feature-card__title">Temperatura Stabile</h3>
                    <p class="feature-card__text">
                        La terracotta ha un&rsquo;eccellente inerzia termica: mantiene l&rsquo;olio
                        a temperatura costante anche con le fluttuazioni esterne, rallentando
                        i processi ossidativi.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">💨</div>
                    <h3 class="feature-card__title">Micro-Ossigenazione</h3>
                    <p class="feature-card__text">
                        La porosit&agrave; controllata della terracotta permette un leggerissimo scambio
                        gassoso &mdash; analogo alla micro-ossigenazione del vino in legno &mdash;
                        che arrotonda e complessa il profilo aromatico.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🧪</div>
                    <h3 class="feature-card__title">Inerit&agrave; Chimica</h3>
                    <p class="feature-card__text">
                        L&rsquo;argilla cotta non cede alcun composto all&rsquo;olio, a differenza
                        di alcuni acciai o materiali plastici. L&rsquo;olio rimane chimicamente
                        puro e integro.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">⚗️</div>
                    <h3 class="feature-card__title">Polifenoli Preservati</h3>
                    <p class="feature-card__text">
                        Studi condotti con l&rsquo;Universit&agrave; della Basilicata hanno dimostrato
                        che l&rsquo;olio conservato in terracotta mantiene il 15-20% in pi&ugrave;
                        di polifenoli rispetto all&rsquo;acciaio dopo 6 mesi.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🏛️</div>
                    <h3 class="feature-card__title">Eredit&agrave; Culturale</h3>
                    <p class="feature-card__text">
                        Conservare l&rsquo;olio negli orci significa tenere viva una tradizione
                        millenaria, riconosciuta dall&rsquo;UNESCO come parte del patrimonio
                        immateriale del Mediterraneo.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">♻️</div>
                    <h3 class="feature-card__title">Sostenibilit&agrave;</h3>
                    <p class="feature-card__text">
                        Gli orci di terracotta hanno una vita utile di decenni, non richiedono
                        energia per la produzione del freddo e sono completamente biodegradabili.
                        La scelta pi&ugrave; sostenibile che esista.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Quote / Blockquote -->
    <section class="section section--white">
        <div class="container container--narrow">
            <blockquote style="font-size:1.4rem;text-align:center;border:none;background:none;padding:0">
                &ldquo;Mio padre mi disse: &lsquo;L&rsquo;orcio non mente. Se l&rsquo;olio &egrave; buono,
                lo porter&agrave; a perfezione. Se &egrave; cattivo, non potr&agrave; nasconderlo.&rsquo;
                Aveva ragione.&rdquo;
            </blockquote>
            <p class="text-center" style="color:var(--color-olive-light);font-weight:700;margin-top:16px">
                &mdash; Antonio Lamacupa, fondatore
            </p>
        </div>
    </section>

    <!-- Visita la cantina CTA -->
    <section class="section section--earth" style="background-color:var(--color-earth-dark)">
        <div class="container text-center">
            <span class="eyebrow" style="color:var(--color-cream)">Vieni a Vedere</span>
            <h2 style="color:var(--color-white);margin-bottom:16px">Visita la Nostra Cantina degli Orci</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:520px;margin:0 auto 36px">
                Un&rsquo;esperienza emozionante: camminare tra le file degli orci, sentire il profumo
                dell&rsquo;olio fresco, toccare con mano una tradizione millenaria.
            </p>
            <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="btn btn--white btn--lg">
                Prenota la Visita
            </a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
