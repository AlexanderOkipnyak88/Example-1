<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php get_template_part( 'entry', ( is_front_page() || is_home() || is_front_page() && is_home() || is_archive() ? 'summary' : 'content' ) ); ?>
</article>