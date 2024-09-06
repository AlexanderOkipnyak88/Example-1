<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-services-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-services';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $category = get_field('category');
    $services = get_posts( [
        'numberposts' => -1,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'ASC',
        'post_type'   => 'service',
        'tax_query' => array(
            array(
            'taxonomy' => 'service_category',
            'field' => 'term_id',
            'terms' => $category
             )
        )
    ]);
    $banner_title = get_field('banner_title');
    $banner_text = get_field('banner_text');
    $banner_link = get_field('banner_link');
    
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <?php if($title!='') : ?>
    <h2><?= $title ?></h2>
    <?php endif; ?>
    <?php if($services) : ?>
        <div class="services_wrap">
        <?php foreach( $services as $service ){
            setup_postdata( $service ); ?>
            <div class="service">
                <a href="<?= esc_url(get_the_permalink($service)); ?>" class="service_lnk">
                    <div class="img_wrap">
                        <?php echo get_the_post_thumbnail($service,'services_tabs'); ?>
                    </div>
                    <div class="content_wrap">
                        <h4><?= get_the_title($service); ?></h4>
                        <div class="text_wrap"><?= get_the_excerpt($service); ?></div>
                        <div class="more_wrap">
                            <span class="more_btn"><?php _e('Mehr lesen','lr'); ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
        wp_reset_postdata(); ?>
        <?php if(get_field('show_banner')) : ?>
            <div class="service_banner">
                <div class="content_wrap">
                    <h3><?= $banner_title ?></h3>
                    <div class="text_wrap"><?= $banner_text; ?></div>
                    <div class="more_wrap">
                        <a href="<?= esc_url($banner_link['url']); ?>" class="btn white"><?= $banner_link['title']; ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
<?php } ?>