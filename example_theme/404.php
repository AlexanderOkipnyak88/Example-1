<?php get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content" itemprop="mainContentOfPage">
    <?php
        $running_title = '';
        for($i=0;$i<20;$i++){
            $running_title.='404 &mdash; ';
        }
    ?>
    <div class="running_header">
        <div class="running_text">
            <div class="ticker"><?= $running_title; ?></div>
        </div>
        <div class="running_wrapper">
            <div class="bottom_content aligntop">
                <div class="small_title"><?php _e('OOPS!','lr'); ?></div>
                <div class="text">
                    <?php _e('Diese Seite wurde noch nicht erstellt oder existiert nicht mehr.','lr'); ?>
                    <div class="btn_wrap"><a href="/" class="btn white"><?php _e('Zur Startseite','lr'); ?></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</article>
<?php get_footer(); ?>