<?php if(is_search()) : ?>
<?php
	global $wp_query;
	if($wp_query->found_posts>0) :
?>
	<h2><?php echo $wp_query->found_posts; ?> Suchanfragen für <span>„<?= get_search_query(); ?>“</span> gefunden</h2>
	<?php else : ?>
	<h2>Für Ihre Suche wurde nichts <span>„<?= get_search_query(); ?>“</span></h2>
	<p><?php _e('Geben Sie Ihr Anliegen anders ein oder verwenden Sie andere Wörter','lr'); ?></p>
	<?php endif; ?>
<?php else : ?>
<h2 class="def active"><?php _e('Suchen','lr') ?></h2>
<h2 class="search_res"><span class="s_count"></span> Suchanfragen für <span class="query">„<span class="s_query"></span>“</span> gefunden</h2>
<h2 class="search_none">Für Ihre Suche wurde nichts gefunden<span class="query">„<span class="s_query"></span>“</span> </h2>
<?php endif; ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="search-field" value="<?php echo get_search_query() ?>" name="s" maxlength="1000"/>
	<button type="submit" class="search-submit btn white" ><?php echo esc_attr_x( 'Suchen', 'lr' ) ?></button>
</form>