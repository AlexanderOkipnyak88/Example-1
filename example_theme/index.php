<?php
    get_header(); 

    $image = get_field('blog_image','option');
    $title = get_field('blog_title','option');
    $text = get_field('blog_text','option');
    $link = get_field('blog_link','option');
    $current_cat = 0;
    if(isset($_GET['cat'])&&$_GET['cat']!='')
        $current_cat=$_GET['cat'];
?>
<div class="running_header">
    <div class="running_text">
        <div class="ticker"><?php _e('ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber &mdash; ratgeber','lr'); ?></div>
    </div>
    <div class="running_wrapper">
        <div class="bottom_content">
            <div class="small_title"><?php _e('Aktuelle Artikel','lr'); ?></div>
            <div class="categories">
                <a href="<?= esc_url(get_permalink( get_option( 'page_for_posts' ) )); ?>" <?= $current_cat==0 ? 'class="active"' : '' ?> data-cat="0"><?php _e('Alle Kategorien','lr'); ?></a>
                <?php     
                $terms = get_terms( array(
                    'taxonomy'   => 'category',
                    'hide_empty' => false
                ));
                foreach($terms as $term) : ?>
                    <a href="<?= esc_url(get_category_link($term->term_id)); ?>" <?= $current_cat==$term->term_id ? 'class="active"' : '' ?>  data-cat="<?= $term->term_id; ?>"><?= $term->name; ?></a>
                <?php endforeach; ?>
                <div class="custom-select">
                    <select>
                        <option value="0"><?php _e('Alle Kategorien','lr'); ?></option>
                        <?php $counter=0; ?>
                        <?php foreach($terms as $term) : ?>
                            <option value="<?= $counter; ?>"><?= $term->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="posts_wrapper" id="posts_wrapper">
    <div class="deco"></div>
<?php
/*if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'entry' );
endwhile; endif;*/

echo load_posts(1,$current_cat);
?>
</div>
<div class="posts_nav" id="posts_nav">
<?php 
//get_template_part( 'nav', 'below' ); 
echo load_navigation($current_cat);
?>
</div>

<?php
    $styleStr='';
    if($image) :
        $imgUrl=$image['url'];
        $styleStr='background:url('.$imgUrl.') no-repeat center 0; background-size:cover;';
    endif;
?>

<section class="block-banner" id="block-banner-blog" style="<?= $styleStr; ?>">
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
<?php get_footer();