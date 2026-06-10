<?php
/**
 * Index – fallback template
 *
 * WordPress will use this if no more-specific template matches.
 * For the front page, front-page.php takes priority.
 * For archives and singular posts, this is the catch-all.
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <?php if ( have_posts() ) : ?>

        <?php if ( is_home() && ! is_front_page() ) : ?>
        <!-- Blog Index -->
        <section class="page-hero">
            <div class="page-hero__overlay" aria-hidden="true"></div>
            <div class="page-hero__content">
                <span class="eyebrow" style="color:var(--color-earth-light)"><?php esc_html_e( 'Notizie', 'lamacupa' ); ?></span>
                <h1><?php single_post_title(); ?></h1>
            </div>
        </section>
        <?php endif; ?>

        <main id="main" class="content-area">
            <div class="container">

                <?php if ( is_archive() ) : ?>
                <header class="archive-header" style="margin-bottom:48px">
                    <?php the_archive_title( '<h1 class="section-title">', '</h1>' ); ?>
                    <?php the_archive_description( '<p class="lead">', '</p>' ); ?>
                </header>
                <?php endif; ?>

                <?php if ( is_search() ) : ?>
                <header style="margin-bottom:48px">
                    <h1 class="section-title">
                        <?php
                        printf(
                            /* translators: %s: search term */
                            esc_html__( 'Risultati per: &ldquo;%s&rdquo;', 'lamacupa' ),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </header>
                <?php endif; ?>

                <div class="grid grid--auto-fit-300">
                    <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'lamacupa-card', [ 'class' => 'card__image' ] ); ?>
                        </a>
                        <?php else : ?>
                        <div class="card__image-placeholder" aria-hidden="true">📰</div>
                        <?php endif; ?>

                        <div class="card__body">
                            <span class="card__eyebrow">
                                <?php echo esc_html( get_the_date() ); ?>
                            </span>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="card__link">
                                <?php esc_html_e( 'Leggi di più', 'lamacupa' ); ?> &rarr;
                            </a>
                        </div>

                    </article>

                    <?php endwhile; ?>
                </div><!-- /.grid -->

                <!-- Pagination -->
                <nav class="pagination" aria-label="<?php esc_attr_e( 'Navigazione articoli', 'lamacupa' ); ?>" style="margin-top:56px;text-align:center">
                    <?php
                    the_posts_pagination( [
                        'prev_text' => '&larr; ' . esc_html__( 'Precedente', 'lamacupa' ),
                        'next_text' => esc_html__( 'Successivo', 'lamacupa' ) . ' &rarr;',
                        'screen_reader_text' => ' ',
                    ] );
                    ?>
                </nav>

            </div><!-- /.container -->
        </main><!-- /#main -->

    <?php else : ?>

        <!-- No posts found -->
        <main id="main" class="content-area section" style="padding-top:calc(var(--nav-height) + 64px)">
            <div class="container container--narrow text-center">
                <span style="font-size:4rem" aria-hidden="true">🔍</span>
                <h1 style="margin:24px 0 16px"><?php esc_html_e( 'Nessun risultato trovato', 'lamacupa' ); ?></h1>
                <p class="lead">
                    <?php esc_html_e( 'Spiacenti, non abbiamo trovato quello che cercavi. Prova a modificare la ricerca.', 'lamacupa' ); ?>
                </p>
                <?php get_search_form(); ?>
                <p style="margin-top:32px">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                        &larr; <?php esc_html_e( 'Torna alla Home', 'lamacupa' ); ?>
                    </a>
                </p>
            </div>
        </main>

    <?php endif; ?>

</div><!-- /.page-content -->

<?php get_footer();
