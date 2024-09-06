<?php
    get_header(); 

    $image = get_field('blog_image','option');
    $title = get_field('blog_title','option');
    $text = get_field('blog_text','option');
    $link = get_field('blog_link','option');
?>
<div class="running_header">
    <div class="running_text">
        <div class="ticker"><?php _e('blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog &mdash; blog','lr'); ?></div>
    </div>
    <div class="running_wrapper">
        <div class="bottom_content">
            <div class="small_title"><?php _e('Aktuelle Artikel','lr'); ?></div>
            <div class="categories">
                <a href="<?= esc_url(get_permalink( get_option( 'page_for_posts' ) )); ?>"><?php _e('Alle Kategorien','lr'); ?></a>
                <?php     
                $terms = get_terms( array(
                    'taxonomy'   => 'category',
                    'hide_empty' => false,
                    'exclude' => [1]
                ));
                $cur_cat_id = get_query_var('cat');
                foreach($terms as $term) : 
                    $classstr = '';
                    if($term->term_id==$cur_cat_id)
                        $classstr='class="active"';
                ?>
                    <a href="<?= esc_url(get_category_link($term->term_id)); ?>" <?= $classstr; ?> ><?= $term->name; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="posts_wrapper">
<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'entry' );
endwhile; endif;
?>
</div>
<?php 
get_template_part( 'nav', 'below' ); 
?>

<?php if($image) : ?>
<style>
    #block-banner-blog{
        background:url(<?= $image['url']; ?>) no-repeat center 0;
        background-size:cover;
    }
</style>

<section class="block-banner" id="block-banner-blog">
    <div class="banner_wrap">
        <div class="content_wrapper">
            <?php if($title!='') : ?>
                <h2><?= $title; ?></h2>
            <?php endif; ?>
            <div class="text_wrap"><?= $text;  ?></div>
        </div>
        <?php if($link) : ?>
            <a href="<?= esc_url($link['url']); ?>" class="big_btn"><?= $link['title']; ?></a>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<?php get_footer();