<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-team-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-team';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $team = get_field('team');
    $left_colunn = get_field('left_column');
    $right_colunn = get_field('right_column');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="team_wrap">
        <?php if($title) : ?>
        <h2><?= $title; ?></h2>
        <?php endif; ?>
        <?php if($team) : ?>
            <div class="team">
                <?php foreach($team as $t) : ?>
                    <div class="item">
                        <div class="img_wrap">
                            <?php if($t['image']) : ?>
                                <img src="<?= esc_url($t['image']['url']); ?>" alt=""/>
                            <?php endif; ?>
                        </div>
                        <div class="text_wrap">
                            <h4><?= $t['name']; ?></h4>
                            <p><?= $t['position']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="columns">
            <div class="column"><?= $left_colunn; ?></div>
            <div class="column"><?= $right_colunn; ?></div>
        </div>
    </div>
</section>
<?php } ?>