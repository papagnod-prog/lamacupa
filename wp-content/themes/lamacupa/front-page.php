<?php
/**
 * Front Page Template
 *
 * @package Lamacupa
 */

get_header();
?>

<!-- ============================================================
     HERO SECTION
     ============================================================ -->
<?php
$lc_hero_bg       = function_exists( 'lamacupa_option' ) ? lamacupa_option( 'hero_bg_image', '' ) : '';
$lc_hero_bg_url   = $lc_hero_bg ? $lc_hero_bg : esc_url( LAMACUPA_URI ) . '/assets/images/hero-bg.jpg';
$lc_hero_titolo   = function_exists( 'lamacupa_option' ) ? lamacupa_option( 'hero_titolo', "L'Oro Verde di Puglia" ) : "L'Oro Verde di Puglia";
$lc_hero_sub      = function_exists( 'lamacupa_option' ) ? lamacupa_option( 'hero_sottotitolo', "Olio extravergine d'oliva biologico ottenuto dalla raccolta tradizionale delle olive Coratina e Ogliarola Barese, custodite nelle nostre terre da secoli." ) : "Olio extravergine d'oliva biologico ottenuto dalla raccolta tradizionale delle olive Coratina e Ogliarola Barese, custodite nelle nostre terre da secoli.";
$lc_cta_testo     = function_exists( 'lamacupa_option' ) ? lamacupa_option( 'hero_cta_testo', 'Scopri i Prodotti' ) : 'Scopri i Prodotti';
$lc_cta_link      = function_exists( 'lamacupa_option' ) ? lamacupa_option( 'hero_cta_link', home_url( '/prodotti/' ) ) : home_url( '/prodotti/' );
if ( ! $lc_cta_link ) $lc_cta_link = home_url( '/prodotti/' );
?>
<section class="hero" id="hero" aria-labelledby="heroTitle">

    <div
        class="hero__bg"
        id="heroBg"
        style="background-image: url('<?php echo esc_url( $lc_hero_bg_url ); ?>');"
        aria-hidden="true"
    ></div>

    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="hero__content">
        <span class="hero__eyebrow">Azienda Agricola &bull; Puglia &amp; Basilicata</span>

        <h1 class="hero__title" id="heroTitle">
            <?php echo wp_kses_post( $lc_hero_titolo ); ?>
        </h1>

        <p class="hero__subtitle">
            <?php echo esc_html( $lc_hero_sub ); ?>
        </p>

        <div class="hero__cta">
            <a href="<?php echo esc_url( $lc_cta_link ); ?>" class="btn btn--white btn--lg">
                <?php echo esc_html( $lc_cta_testo ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/chi-siamo/' ) ); ?>" class="btn btn--outline-white btn--lg">
                La Nostra Storia
            </a>
        </div>
    </div><!-- /.hero__content -->

    <div class="hero__scroll" onclick="document.getElementById('ilNostraMondo').scrollIntoView({behavior:'smooth'})">
        <span>Scorri</span>
        <div class="hero__scroll-arrow" aria-hidden="true"></div>
    </div>

</section><!-- /.hero -->


<!-- ============================================================
     IL NOSTRO MONDO – Feature Cards
     ============================================================ -->
<section class="section section--cream" id="ilNostraMondo" aria-labelledby="ilNostraMondoTitle">
    <div class="container">

        <div class="text-center mb-48">
            <span class="eyebrow">Il Nostro Mondo</span>
            <h2 class="section-title" id="ilNostraMondoTitle">Radici Profonde, Qualit&agrave; Autentica</h2>
            <p class="section-subtitle">
                Dalla cura della terra alla bottiglia, ogni passo del nostro processo
                &egrave; guidato da rispetto per la natura e amore per la tradizione.
            </p>
            <div class="divider"></div>
        </div>

        <div class="grid grid--auto-fit-260 stagger-children">

            <!-- Chi Siamo Card -->
            <article class="card fade-up">
                <div class="card__image-placeholder" aria-hidden="true">🌿</div>
                <div class="card__body">
                    <span class="card__eyebrow">La Famiglia</span>
                    <h3 class="card__title">Chi Siamo</h3>
                    <p class="card__text">
                        Una storia di famiglia che affonda le radici nel territorio della Basilicata e Puglia.
                        Tre generazioni di agricoltori che hanno fatto dell&rsquo;olio la propria vita.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/chi-siamo/' ) ); ?>" class="card__link">
                        Scopri la storia &rarr;
                    </a>
                </div>
            </article>

            <!-- La Nostra Terra Card -->
            <article class="card fade-up">
                <div class="card__image-placeholder" aria-hidden="true" style="background:linear-gradient(135deg,#4a5c24,#8B6914)">🫒</div>
                <div class="card__body">
                    <span class="card__eyebrow">Il Territorio</span>
                    <h3 class="card__title">La Nostra Terra</h3>
                    <p class="card__text">
                        Oltre 200 ettari di oliveti millenari tra Puglia e Basilicata,
                        con cultivar autoctone come Coratina e Ogliarola Barese.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/la-nostra-terra/' ) ); ?>" class="card__link">
                        Esplora il territorio &rarr;
                    </a>
                </div>
            </article>

            <!-- Gli Orci Card -->
            <article class="card fade-up">
                <div class="card__image-placeholder" aria-hidden="true" style="background:linear-gradient(135deg,#8B6914,#C4A882)">🏺</div>
                <div class="card__body">
                    <span class="card__eyebrow">Tradizione</span>
                    <h3 class="card__title">Gli Orci</h3>
                    <p class="card__text">
                        La conservazione tradizionale in grandi orci di terracotta &egrave; il nostro
                        segreto pi&ugrave; antico. Un metodo che preserva intatti profumi e sapori.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/gli-orci/' ) ); ?>" class="card__link">
                        Scopri gli orci &rarr;
                    </a>
                </div>
            </article>

            <!-- Olioturismo Card -->
            <article class="card fade-up">
                <div class="card__image-placeholder" aria-hidden="true" style="background:linear-gradient(135deg,#2C5F2E,#5C6B2E)">🌅</div>
                <div class="card__body">
                    <span class="card__eyebrow">Esperienze</span>
                    <h3 class="card__title">Olioturismo</h3>
                    <p class="card__text">
                        Vivi l&rsquo;esperienza della raccolta, partecipa a degustazioni guidate
                        e lasciati conquistare dalla magia di questa terra meravigliosa.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="card__link">
                        Prenota una visita &rarr;
                    </a>
                </div>
            </article>

        </div><!-- /.grid -->
    </div><!-- /.container -->
</section>


<!-- ============================================================
     SPLIT SECTION: IL FRANTOIO
     ============================================================ -->
<section class="split-section" aria-label="Il Frantoio">

    <div class="split-section__image-placeholder" aria-hidden="true">🫙</div>

    <div class="split-section__content">
        <span class="eyebrow">Il Processo</span>
        <h2>Dal Frantoio alla<br>Vostra Tavola</h2>
        <div class="divider divider--left"></div>
        <p class="lead">
            La raccolta avviene a mano o con pettini meccanici, nel rispetto dell&rsquo;oliva e del suo contenuto di polifenoli.
        </p>
        <p>
            La molitura avviene entro 24 ore dalla raccolta, con ciclo continuo a freddo, per garantire
            un olio di altissima qualit&agrave; con acidit&agrave; inferiore allo 0,2%. Ogni bottiglia
            racchiude la storia di una terra straordinaria.
        </p>
        <div class="mt-32">
            <a href="<?php echo esc_url( home_url( '/prodotti/' ) ); ?>" class="btn btn--primary">
                Acquista Ora
            </a>
        </div>
    </div>

</section><!-- /.split-section -->


<!-- ============================================================
     FEATURED PRODUCTS (WooCommerce)
     ============================================================ -->
<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<section class="section section--white" id="prodottiInEvidenza" aria-labelledby="prodottiTitle">
    <div class="container">

        <div class="text-center mb-48">
            <span class="eyebrow">La Nostra Selezione</span>
            <h2 class="section-title" id="prodottiTitle">I Nostri Prodotti</h2>
            <p class="section-subtitle">
                Olio extravergine d&rsquo;oliva biologico, selezioni speciali e prodotti
                della tradizione agricola pugliese e lucana.
            </p>
            <div class="divider"></div>
        </div>

        <div class="woo-featured-products">
            <?php echo do_shortcode( '[products limit="3" columns="3" orderby="date" order="DESC"]' ); ?>
        </div>

        <div class="text-center mt-48">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn--secondary">
                Vedi Tutti i Prodotti
            </a>
        </div>

    </div>
</section>
<?php endif; ?>


<!-- ============================================================
     OLIOTURISMO BANNER
     ============================================================ -->
<section
    class="banner-section"
    id="olioturismoTeaser"
    aria-labelledby="olioturismoTitle"
    style="background-image: url('<?php echo esc_url( LAMACUPA_URI ); ?>/assets/images/olioturismo-bg.jpg'); background-color: #2a3518;"
>
    <div class="banner-section__overlay" aria-hidden="true"></div>
    <div class="banner-section__content fade-up">
        <span class="eyebrow" style="color:#C4A882">Esperienze in Azienda</span>
        <h2 id="olioturismoTitle">Vivi la Magia<br>dell&rsquo;Olioturismo</h2>
        <p>
            Un giorno tra i nostri ulivi millenari, una degustazione dei nostri oli,
            la raccolta delle olive a mano come una volta. Un&rsquo;esperienza che resta nel cuore.
        </p>
        <a href="<?php echo esc_url( home_url( '/olioturismo/' ) ); ?>" class="btn btn--white btn--lg">
            Scopri le Esperienze
        </a>
    </div>
</section>


<!-- ============================================================
     AWARDS STRIP
     ============================================================ -->
<section class="awards-strip" aria-label="<?php esc_attr_e( 'Riconoscimenti', 'lamacupa' ); ?>">
    <div class="container">
        <div class="text-center mb-32">
            <span class="eyebrow">I Nostri Premi</span>
            <h2 class="section-title" style="font-size:1.8rem">Un Olio Premiato</h2>
        </div>
        <div class="awards-strip__inner">

            <div class="award-badge fade-up">
                <span class="award-badge__icon">🥇</span>
                <span class="award-badge__name">Oro</span>
                <span class="award-badge__year">Sol d&rsquo;Oro 2023</span>
            </div>

            <div class="award-badge fade-up">
                <span class="award-badge__icon">🏆</span>
                <span class="award-badge__name">Gran Men&shy;zione</span>
                <span class="award-badge__year">Ercole Olivario 2023</span>
            </div>

            <div class="award-badge fade-up">
                <span class="award-badge__icon">⭐</span>
                <span class="award-badge__name">5 Gocce</span>
                <span class="award-badge__year">Guida Flos Olei 2024</span>
            </div>

            <div class="award-badge fade-up">
                <span class="award-badge__icon">🎖️</span>
                <span class="award-badge__name">Best Blend</span>
                <span class="award-badge__year">EVOO World Cup 2022</span>
            </div>

            <div class="award-badge fade-up">
                <span class="award-badge__icon">🌿</span>
                <span class="award-badge__name">Bio Excellence</span>
                <span class="award-badge__year">BioEcoActual 2023</span>
            </div>

        </div><!-- /.awards-strip__inner -->

        <div class="text-center mt-32">
            <a href="<?php echo esc_url( home_url( '/premi/' ) ); ?>" class="btn btn--earth btn--sm">
                Vedi tutti i premi
            </a>
        </div>
    </div>
</section>


<!-- ============================================================
     TESTIMONIALS
     ============================================================ -->
<section class="section section--white" aria-label="<?php esc_attr_e( 'Testimonianze', 'lamacupa' ); ?>">
    <div class="container container--narrow">

        <div class="text-center mb-48">
            <span class="eyebrow">Cosa Dicono di Noi</span>
            <h2 class="section-title">Le Parole dei Nostri Clienti</h2>
            <div class="divider"></div>
        </div>

        <div class="grid grid--2 stagger-children">
            <div class="testimonial fade-up">
                <p class="testimonial__text">
                    &ldquo;Un olio straordinario, con un profilo aromatico complesso e una persistenza
                    ammirevole. Si sente la cura e la passione in ogni goccia.&rdquo;
                </p>
                <span class="testimonial__author">— Marco T., Milano</span>
            </div>
            <div class="testimonial fade-up">
                <p class="testimonial__text">
                    &ldquo;Ho visitato l&rsquo;azienda durante la raccolta. Un&rsquo;esperienza indimenticabile.
                    L&rsquo;olio Lamacupa &egrave; ora fisso sulla mia tavola.&rdquo;
                </p>
                <span class="testimonial__author">— Francesca B., Roma</span>
            </div>
        </div>

    </div>
</section>


<!-- ============================================================
     CONTACT CTA
     ============================================================ -->
<section class="section section--olive" aria-labelledby="ctaTitle">
    <div class="container text-center">
        <span class="eyebrow" style="color:var(--color-earth-light)">Contattaci</span>
        <h2 id="ctaTitle" style="color:var(--color-white);margin-bottom:16px">Hai Domande?</h2>
        <p style="color:rgba(255,255,255,0.85);max-width:520px;margin:0 auto 36px;font-size:1.1rem">
            Siamo sempre felici di parlare con chi ama l&rsquo;olio buono. Scrivici o vieni a trovarci in azienda.
        </p>
        <a href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>" class="btn btn--white btn--lg">
            Contattaci
        </a>
    </div>
</section>

<?php get_footer(); ?>
