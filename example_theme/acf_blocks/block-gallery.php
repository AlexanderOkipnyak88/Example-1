<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-gallery-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-gallery';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $items = get_field('gallery');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="block-gallery_wrap">
    <?php if($title!='') : ?>
        <h2><?= $title; ?></h2>
    <?php endif; ?>  
    </div>
    <?php if($items) : ?>
        <div class="slider_wrapper">
            <div class="gallery-button-prev">
                <svg width="76" height="75" viewBox="0 0 76 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M41.0898 29.0799L34.5698 35.5999C33.7998 36.3699 33.7998 37.6299 34.5698 38.3999L41.0898 44.9199" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 37.5C1 17.0655 17.5655 0.499997 38 0.499996C58.4345 0.499994 75 17.0655 75 37.5C75 57.9345 58.4345 74.5 38 74.5C17.5655 74.5 1.00001 57.9345 1 37.5Z" stroke="#133DA8"/>
                </svg> 
            </div>
            <div class="swiper gallery-slider">
                <div class="swiper-wrapper">
                <?php foreach( $items as $item ){ ?>
                        <div class="swiper-slide">
                            <?php  if($item['item']['item_type']=='image') :  ?>
                                <img src="<?= esc_url($item['item']['image']['url']); ?>" alt=""/>
                            <?php elseif($item['item']['item_type']=='video') : ?>
                                <video controls>
                                    <source src="<?= esc_url($item['item']['video']['url']); ?>" type='video/mp4'>
                                    Your browser does not support the video tag.
                                </video>
                            <?php elseif($item['item']['item_type']=='iframe') : ?>
                                <?= $item['item']['iframe']; ?>
                            <?php endif; ?>
                        </div>
                <?php }
                wp_reset_postdata(); ?>
                </div>
            </div>
            <div class="gallery-button-next">
                <svg width="76" height="75" viewBox="0 0 76 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M34.9102 29.0799L41.4302 35.5999C42.2002 36.3699 42.2002 37.6299 41.4302 38.3999L34.9102 44.9199" stroke="#133DA8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M75 37.5C75 17.0655 58.4345 0.499997 38 0.499996C17.5655 0.499994 1.00001 17.0655 1 37.5C1 57.9345 17.5655 74.5 38 74.5C58.4345 74.5 75 57.9345 75 37.5Z" stroke="#133DA8"/>
                </svg> 
            </div>
        </div>
        <div class="swiper-pagination"></div>
    <?php endif; ?>
    <?php if($link) : ?>
        <a href="<?= esc_url($link['url']); ?>" class="btn"><?= $link['title']; ?></a>
    <?php endif; ?>
</section>
<?php } ?>