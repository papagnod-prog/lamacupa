<?php get_header() ?>
<main class="site-main" style="padding:calc(var(--nav-height) + 40px) 0 80px">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <h1 style="font-family:var(--font-heading);margin-bottom:40px"><?php the_archive_title() ?></h1>
      <div class="grid-3">
        <?php while ( have_posts() ) : the_post() ?>
          <article style="background:#fff;border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow-sm)">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium', [ 'style' => 'width:100%;height:220px;object-fit:cover' ] ) ?></a>
            <?php endif ?>
            <div style="padding:24px">
              <h2 style="font-family:var(--font-heading);font-size:1.15rem;margin-bottom:10px"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
              <p style="font-size:.88rem;color:var(--color-text-light)"><?php the_excerpt() ?></p>
              <a href="<?php the_permalink() ?>" class="btn btn--outline btn--sm" style="margin-top:14px">Leggi tutto</a>
            </div>
          </article>
        <?php endwhile ?>
      </div>
      <div style="margin-top:40px;text-align:center"><?php the_posts_pagination() ?></div>
    <?php else : ?>
      <p>Nessun contenuto trovato.</p>
    <?php endif ?>
  </div>
</main>
<?php get_footer(); ?>
