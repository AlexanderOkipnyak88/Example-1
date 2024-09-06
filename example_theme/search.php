<?php get_header(); ?>
<div class="search_wrapper">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<article id="post-0" class="post no-results not-found">
</article>
<?php endif; ?>
</div>
<?php get_footer(); ?>