<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-vacancies-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-vacancies';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    $count = get_field('count');
    //$count = 2;
    $vacancies = get_posts( [
        'numberposts' => $count,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'ASC',
        'post_type'   => 'vacancy'
    ]);
?>
<div class="<?= $className; ?>" id="<?= $id ?>" >
    <?php if($vacancies) : ?>
        <div class="vacancies_wrap">
        <?php foreach( $vacancies as $vacancy ){
            setup_postdata( $vacancy ); ?>
            <div class="vacancy">
                <a href="<?= esc_url(get_the_permalink($vacancy)); ?>" class="vac_lnk">
                    <div class="data"><span><?= get_field('employment',$vacancy); ?></span><span class="sep"></span><span><?= get_field('region',$vacancy) ?></span></div>
                    <h4><?= get_the_title($vacancy); ?></h4>
                    <div class="text_wrap"><?= get_the_excerpt($vacancy); ?></div>
                    <div class="more_wrap">
                        <span class="more_btn"><?php _e('Mehr lesen','lr'); ?></span>
                    </div>
                </a>
            </div>
        <?php }
        wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
</div>
<?php } ?>