<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-posts_slider-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-posts_slider';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $exclude = array();
    if(is_single()){
        global $post;
        $exclude = array($post->ID);
    }
    $posts = get_posts( [
        'numberposts' => 10,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'exclude'     => $exclude,
        'post_type'   => 'post',
    ] );
    $link = get_field('link');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <?php if($title!='') : ?>
        <h2><?= $title; ?></h2>
    <?php endif; ?>  
    <?php if($posts) : ?>
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
            <div class="swiper slider">
                <div class="swiper-wrapper">
                <?php foreach( $posts as $p ){
                    setup_postdata( $p ); 
                    $cats = wp_get_post_categories( $p->ID);
                ?>
                        <div class="swiper-slide">
                            <a href="<?= get_permalink($p); ?>" class="post_lnk">
                                <div class="img_wrapper">
                                    <?php echo get_the_post_thumbnail($p,'post_img'); ?>
                                </div>
                                <div class="content_wrapper">
                                    <div class="post_meta">
                                    <?php if($cats) :
                                        $isfirst = true; ?>
                                        <span class="category">
                                            <?php
                                                foreach($cats as $cat){
                                                    if(!$isfirst)
                                                        echo ', ';
                                                    echo get_the_category_by_ID($cat);
                                                    $isfirst = false;
                                                }
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                        <span class="date"><?= get_post_time( get_option( 'date_format' ),false,$p ); ?></span>
                                    </div>
                                    <h4><?= get_the_title($p); ?></h4>
                                    <div class="text_wrap"><?= get_the_excerpt($p); ?></div>
                                    <div class="more_wrap">
                                        <span class="more_btn"><?php _e('Mehr lesen','lr'); ?></span>
                                    </div>
                                </div>
                            </a>
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
<?php } ?>