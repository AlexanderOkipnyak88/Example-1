<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content" itemprop="mainContentOfPage">
<?php the_content(); ?>
<div class="resume_form">
    <div class="resume_form_wrapper_top">
        <div class="resume_form_wrapper">
            <div class="form_wrapper">
                <?php 
                    $resume_form = get_field('resume_form_shortcode', 'option');
                    if($resume_form!=''){
                        echo do_shortcode($resume_form);
                    } 
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    $vacancies = get_posts( [
        'numberposts' => 10,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'post_type'   => 'vacancy',
    ] );
?>
<section class="vacancy_slider" id="vacancy_slider">
    <h2><?php _e('Aktuelle <br>Stellenangebote','lr'); ?></h2>
    <?php if($vacancies) : ?>
        <div class="slider_wrapper">
            <div class="slide_btn_wrap">
                <div class="slider-button-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.09 19.9201L8.57003 13.4001C7.80003 12.6301 7.80003 11.3701 8.57003 10.6001L15.09 4.08008" stroke="#636363" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="slider-button-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.91003 19.9201L15.43 13.4001C16.2 12.6301 16.2 11.3701 15.43 10.6001L8.91003 4.08008" stroke="#636363" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> 
                </div>
            </div>
            <div class="swiper slider-3">
                <div class="swiper-wrapper">
                <?php foreach( $vacancies as $v ){
                    setup_postdata( $v ); ?>
                        <div class="swiper-slide">
                            <div class="vacancy">
                                <div class="data"><span>Ganztags</span><span class="sep"></span><span>Berlin</span></div>
                                <h4><?= get_the_title($v); ?></h4>
                                <div class="text_wrap"><?= get_the_excerpt($v); ?></div>
                                <div class="more_wrap">
                                    <a href="<?= esc_url(get_the_permalink($v)); ?>" class="more_btn"><?php _e('Mehr lesen','lr'); ?></a>
                                </div>
                            </div>
                        </div>
                <?php }
                wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($link) : ?>
        <a href="<?= esc_url($link['url']); ?>" class="btn"><?= $link['title']; ?></a>
    <?php endif; ?>
</section>
</div>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>