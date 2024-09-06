<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-columns_with_numbers-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-columns_with_numbers';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    if(get_field('blue_background')){
        $className.=' blue_bg';
    }
    $title = get_field('title');
    $columns = get_field('columns');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="columns_with_numbers_wrap">
    <?php if($title!='') : ?>
        <h2><?= $title; ?></h2>
    <?php endif; ?>  
    <?php if($columns) : ?>
        <div class="columns_wrap">
            <?php foreach($columns as $col) : ?>
                <div class="column">
                    <div class="number"><?= $col['number']; ?></div>
                    <div class="text"><?= $col['text']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
</section>
<?php } ?>