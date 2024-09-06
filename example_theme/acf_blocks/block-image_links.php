<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-image_links-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-image_links';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $links = get_field('links');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="image_links_wrap">
        <?php if($title!='') : ?>
            <h2><?= $title; ?></h2>
        <?php endif; ?>
        <?php if($links) : ?>
        <div class="links">
            <?php foreach($links as $link) : ?>
                <div class="item">
                    <a href="<?= esc_url($link['link']['url']); ?>">
                        <img src="<?= esc_url($link['image']['url']); ?>" alt=""/>
                        <span><?= $link['link']['title'] ?></span>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php } ?>