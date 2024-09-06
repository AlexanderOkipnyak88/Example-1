<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-banner-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-banner';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    if(get_field('with_margin'))
        $className.= ' with_margin';
    $image = get_field('image');
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $styleStr='';
    if($image) :
        $imgUrl=$image['url'];
        $styleStr='background:url('.$imgUrl.') no-repeat center 0; background-size:cover;';
    endif;
?>
<section class="<?= $className; ?>" id="<?= $id; ?>" style="<?= $styleStr; ?>">
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
<?php } ?>