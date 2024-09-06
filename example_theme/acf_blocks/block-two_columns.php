<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-two_columns-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-two_columns';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    if(get_field('background') == 'white')
        $className.=' white_bg';
    $title = get_field('title');
    $left_colunn = get_field('left_column');
    $right_colunn = get_field('right_column');
    $bottom_text = get_field('bottom_text');
    $link = get_field('link');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="two_columns_wrap">
        <?php if($title!='') : ?>
            <h3><?= $title; ?></h3>
        <?php endif; ?>
        <div class="columns">
            <div class="column"><?= $left_colunn; ?></div>
            <div class="column"><?= $right_colunn; ?></div>
        </div>
        <?php if($bottom_text!=''|| $link) : ?>
        <div class="bottom_content">
            <div class="bottom_text"><?= $bottom_text; ?></div>
            <a href="<?= esc_url($link['url']); ?>" class="btn"><?= $link['title']; ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php } ?>