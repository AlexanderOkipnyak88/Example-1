<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-contact_image-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-contact_image';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $image = get_field('image');
    $form = get_field('form_shortcode');
    $title = get_field('title');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="content_wrapper">
        <?php if($title!='') : ?>
            <h2><?= $title; ?></h2>
        <?php endif; ?>
        <div class="form_wrapper">
            <?= $form; ?>
        </div>
    </div>
    <div class="image_wrapper">
        <?php if($image) : ?>
            <img src="<?= esc_url($image['url']); ?>" alt=""/>
        <?php endif; ?>
    </div>
    <div class="deco"></div>
</section>
<?php } ?>