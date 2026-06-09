<?php
/**
 * Generic Page Template
 *
 * @package Lamacupa
 */

get_header();
?>

<div class="page-content">

    <!-- Page Hero Banner -->
    <?php while ( have_posts() ) : the_post(); ?>

    <section class="page-hero" aria-label="<?php the_title_attribute(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <div
                class="page-hero__bg"
                style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'lamacupa-banner' ) ); ?>');"
                aria-hidden="true"
            ></div>
        <?php endif; ?>
        <div class="page-hero__overlay" aria-hidden="true"></div>
        <div class="page-hero__content">
            <span class="eyebrow" style="color:var(--color-earth-light)">
                <?php
                $ancestors = get_post_ancestors( get_the_ID() );
                if ( $ancestors ) {
                    echo esc_html( get_the_title( end( $ancestors ) ) );
                } else {
                    esc_html_e( 'Pagina', 'lamacupa' );
                }
                ?>
            </span>
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Page Content -->
    <main id="main" class="content-area">
        <div class="container">
            <div class="content-body">
                <?php the_content(); ?>

                <?php
                wp_link_pages( [
                    'before' => '<nav class="page-links"><span>' . esc_html__( 'Pagine:', 'lamacupa' ) . '</span>',
                    'after'  => '</nav>',
                ] );
                ?>
            </div><!-- /.content-body -->
        </div><!-- /.container -->
    </main><!-- /#main -->

    <?php endwhile; ?>

</div><!-- /.page-content -->

<?php get_footer(); ?>
