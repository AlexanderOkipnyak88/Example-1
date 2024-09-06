<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-two_columns_list-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-two_columns_list';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $left_colunn = get_field('left_column');
    $right_colunn = get_field('right_column');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="two_columns_wrap">
        <?php if($title!='') : ?>
            <h3><?= $title; ?></h3>
        <?php endif; ?>
        <div class="columns">
            <div class="column">
                <?php if($left_colunn) : ?>
                    <ul>
                    <?php foreach($left_colunn as $item) : ?>
                        <li><?= $item['item']; ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="column">
                <?php if($right_colunn) : ?>
                    <ul>
                    <?php foreach($right_colunn as $item) : ?>
                        <li><?= $item['item']; ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>