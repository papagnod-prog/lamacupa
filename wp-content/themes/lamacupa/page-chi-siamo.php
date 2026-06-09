<?php
/**
 * Template Name: Chi Siamo
 * Template Post Type: page
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <!-- Page Hero -->
    <section class="page-hero" aria-labelledby="chiSiamoTitle">
        <div
            class="page-hero__bg"
            style="background-image: url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/chi-siamo-bg.jpg');background-color:#3a4a20"
            aria-hidden="true"
        ></div>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">La Famiglia Lamacupa</span>
            <h1 id="chiSiamoTitle">Chi Siamo</h1>
            <p class="lead">Una storia di passione, terra e tradizione che si tramanda da generazioni.</p>
        </div>
    </section>

    <!-- Storia Intro -->
    <section class="section section--cream" aria-labelledby="storiaTitle">
        <div class="container container--narrow text-center">
            <span class="eyebrow">Le Nostre Radici</span>
            <h2 id="storiaTitle">La Storia di Lamacupa</h2>
            <div class="divider"></div>
            <p class="lead">
                Tutto ebbe inizio negli anni &rsquo;50, quando nonno Giuseppe decise di dedicare la sua vita
                a queste terre aspre e generose ai confini tra Puglia e Basilicata. Da allora, tre generazioni
                di agricoltori hanno trasformato un piccolo appezzamento in un&rsquo;azienda agricola di riferimento
                per la qualit&agrave; dell&rsquo;olio extravergine d&rsquo;oliva del Mezzogiorno.
            </p>
        </div>
    </section>

    <!-- Split: Origini -->
    <section class="split-section fade-up" aria-label="Le origini">
        <div
            class="split-section__image-placeholder"
            aria-hidden="true"
            style="background:linear-gradient(135deg,#5C6B2E,#2C3A1A);font-size:5rem"
        >🌳</div>
        <div class="split-section__content">
            <span class="eyebrow">Anni &rsquo;50</span>
            <h2>Le Origini</h2>
            <div class="divider divider--left"></div>
            <p>
                Nonno Giuseppe Lamacupa eredit&ograve; dai suoi genitori un piccolo oliveto di pochi ettari
                sulle colline argillose di Montescaglioso, in Basilicata. Con sacrificio e determinazione,
                inizi&ograve; a espandere la propriet&agrave; acquistando appezzamenti limitrofi, curando
                ogni singolo albero come un figlio.
            </p>
            <p>
                La prima molitura avveniva con il vecchio frantoio a macina di pietra del paese. L&rsquo;olio
                veniva venduto ai mercati locali e scambiato con i vicini: era ancora un economia di sussistenza,
                ma la qualit&agrave; era gi&agrave; eccezionale.
            </p>
        </div>
    </section>

    <!-- Split: Seconda Generazione -->
    <section class="split-section fade-up" aria-label="La seconda generazione" style="direction:rtl">
        <div
            class="split-section__image-placeholder"
            aria-hidden="true"
            style="background:linear-gradient(135deg,#8B6914,#C4A882);font-size:5rem;direction:ltr"
        >🏺</div>
        <div class="split-section__content" style="direction:ltr">
            <span class="eyebrow">Anni &rsquo;80</span>
            <h2>La Seconda Generazione</h2>
            <div class="divider divider--left"></div>
            <p>
                Suo figlio Antonio port&ograve; il vento del rinnovamento: studi agronomici, viaggi in Spagna
                e Grecia per conoscere le best practice internazionali, e soprattutto la decisione
                di passare alla coltivazione biologica certificata, anticipando i tempi di quasi vent&rsquo;anni.
            </p>
            <p>
                Fu Antonio a introdurre la conservazione in orci di terracotta &mdash; riscoprendo un&rsquo;usanza
                degli antichi Romani &mdash; e a costruire il primo frantoio aziendale con impianto a freddo,
                per preservare intatte le propriet&agrave; organolettiche dell&rsquo;olio.
            </p>
        </div>
    </section>

    <!-- Split: Oggi -->
    <section class="split-section fade-up" aria-label="Lamacupa oggi">
        <div
            class="split-section__image-placeholder"
            aria-hidden="true"
            style="background:linear-gradient(135deg,#3a4a20,#5C6B2E);font-size:5rem"
        >🫒</div>
        <div class="split-section__content split-section__content--dark">
            <span class="eyebrow" style="color:var(--color-earth-light)">Oggi</span>
            <h2>Lamacupa Oggi</h2>
            <div class="divider divider--left" style="background:linear-gradient(90deg,var(--color-earth-light),rgba(255,255,255,0.3))"></div>
            <p>
                La terza generazione &mdash; Maria e Francesco &mdash; ha introdotto la vendita online
                e le esperienze di olioturismo, aprendo l&rsquo;azienda al mondo. Oggi Lamacupa esporta
                in oltre 15 paesi, ma non ha mai dimenticato le sue radici.
            </p>
            <p>
                Con oltre 200 ettari di oliveti, un frantoio di ultima generazione e una filosofia
                di rispetto assoluto per la biodiversit&agrave;, Lamacupa rappresenta l&rsquo;eccellenza
                della produzione olivicola del Sud Italia.
            </p>
        </div>
    </section>

    <!-- Valori -->
    <section class="section section--cream" aria-labelledby="valoriTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">I Nostri Valori</span>
                <h2 id="valoriTitle">Ci&ograve; in cui Crediamo</h2>
                <div class="divider"></div>
            </div>

            <div class="grid grid--3 stagger-children">

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🌱</div>
                    <h3 class="feature-card__title">Sostenibilit&agrave;</h3>
                    <p class="feature-card__text">
                        Coltiviamo in modo biologico certificato da oltre 30 anni, senza pesticidi
                        n&eacute; fertilizzanti chimici. La salute della nostra terra &egrave; la nostra priorit&agrave;.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🤲</div>
                    <h3 class="feature-card__title">Tradizione</h3>
                    <p class="feature-card__text">
                        Rispettiamo i ritmi della natura e le tecniche tramandate dai nostri nonni,
                        integrandole con le migliori tecnologie per la qualit&agrave; finale.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🏆</div>
                    <h3 class="feature-card__title">Eccellenza</h3>
                    <p class="feature-card__text">
                        Ogni bottiglia di Lamacupa &egrave; il risultato di controlli rigorosi e passione
                        autentica. Non facciamo compromessi sulla qualit&agrave;.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🤝</div>
                    <h3 class="feature-card__title">Comunit&agrave;</h3>
                    <p class="feature-card__text">
                        Siamo parte di una comunit&agrave; locale vivace. Collaboriamo con altri produttori
                        e investiamo nel territorio che ci ha dato tutto.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">🔬</div>
                    <h3 class="feature-card__title">Ricerca</h3>
                    <p class="feature-card__text">
                        Lavoriamo con l&rsquo;Universit&agrave; della Basilicata per studiare e valorizzare
                        le cultivar autoctone e ottimizzare i metodi di raccolta.
                    </p>
                </div>

                <div class="feature-card fade-up">
                    <div class="feature-card__icon" aria-hidden="true">💚</div>
                    <h3 class="feature-card__title">Rispetto</h3>
                    <p class="feature-card__text">
                        Rispettiamo ogni singolo ulivo &mdash; alcuni centenari &mdash; come custodi
                        di una storia e di una biodiversit&agrave; irripetibile.
                    </p>
                </div>

            </div><!-- /.grid -->
        </div>
    </section>

    <!-- Team -->
    <section class="section section--white" aria-labelledby="teamTitle">
        <div class="container">

            <div class="text-center mb-48">
                <span class="eyebrow">Le Persone</span>
                <h2 id="teamTitle">Il Nostro Team</h2>
                <div class="divider"></div>
            </div>

            <div class="team-grid">

                <div class="team-member fade-up">
                    <div class="team-member__photo-placeholder" aria-hidden="true">👨‍🌾</div>
                    <h3 class="team-member__name">Antonio Lamacupa</h3>
                    <p class="team-member__role">Fondatore &amp; Agronomo</p>
                    <p style="font-size:0.9rem;color:var(--color-text-light);margin-top:8px">
                        Agronomo con 40 anni di esperienza, &egrave; il custode del sapere ancestrale dell&rsquo;azienda.
                    </p>
                </div>

                <div class="team-member fade-up">
                    <div class="team-member__photo-placeholder" aria-hidden="true">👩‍💼</div>
                    <h3 class="team-member__name">Maria Lamacupa</h3>
                    <p class="team-member__role">Direttrice Commerciale</p>
                    <p style="font-size:0.9rem;color:var(--color-text-light);margin-top:8px">
                        Guida lo sviluppo commerciale e i rapporti internazionali con passione e visione.
                    </p>
                </div>

                <div class="team-member fade-up">
                    <div class="team-member__photo-placeholder" aria-hidden="true">👨‍🔬</div>
                    <h3 class="team-member__name">Francesco Lamacupa</h3>
                    <p class="team-member__role">Responsabile Produzione</p>
                    <p style="font-size:0.9rem;color:var(--color-text-light);margin-top:8px">
                        Supervisiona ogni fase della produzione, dal campo al frantoio, con rigore scientifico.
                    </p>
                </div>

                <div class="team-member fade-up">
                    <div class="team-member__photo-placeholder" aria-hidden="true">👩‍🍳</div>
                    <h3 class="team-member__name">Rosa Tanzillo</h3>
                    <p class="team-member__role">Esperta di Degustazione</p>
                    <p style="font-size:0.9rem;color:var(--color-text-light);margin-top:8px">
                        Panel leader certificata COI, guida le degustazioni e le esperienze di olioturismo.
                    </p>
                </div>

            </div><!-- /.team-grid -->
        </div>
    </section>

    <!-- CTA -->
    <section class="section section--olive text-center">
        <div class="container">
            <span class="eyebrow" style="color:var(--color-earth-light)">Vieni a Trovarci</span>
            <h2 style="color:var(--color-white);margin-bottom:16px">Conosci la Nostra Famiglia</h2>
            <p style="color:rgba(255,255,255,0.85);max-width:520px;margin:0 auto 36px">
                Prenota una visita all&rsquo;azienda e scopri di persona la passione che mettiamo in ogni bottiglia.
            </p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="btn btn--white">Prenota una Visita</a>
                <a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>"  class="btn btn--outline-white">Contattaci</a>
            </div>
        </div>
    </section>

</div><!-- /.page-content -->

<?php get_footer(); ?>
