<?php get_header() ?>
<div class="page-hero">
  <div class="container">
    <?php lamacupa_breadcrumb() ?>
    <h1><?php the_title() ?></h1>
  </div>
</div>
<main class="site-main" style="padding:56px 0 80px">
  <div class="container" style="max-width:860px">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post() ?>
      <div class="entry-content"><?php the_content() ?></div>
    <?php endwhile; endif ?>
  </div>
</main>
<?php get_footer(); ?>
