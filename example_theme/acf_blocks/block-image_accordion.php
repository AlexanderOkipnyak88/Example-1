<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-image_accordion' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-image_accordion image-left with_accordion';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $accordion = get_field('accordion');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="content_wrapper">
        <?php if($title!='') : ?>
            <h2><?= $title; ?></h2>
        <?php endif; ?>
        <div class="accordion">
            <?php $counter=0; ?>
            <?php foreach($accordion as $a) : ?>
                <div class="item <?= $counter==0 ? 'active' : '' ?>" data-index="<?= $counter; ?>">
                    <div class="title">
                        <?= $a['title']; ?>
                        <span class="cross">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.39998 14H19.6" stroke="#133DA8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 19.6001V8.40002" stroke="#133DA8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> 
                        </span>
                    </div>
                    <div class="text"><?= $a['text']; ?></div>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="image_wrapper">
        <?php $counter=0; ?>
        <?php foreach($accordion as $a) : ?>
            <img src="<?= esc_url($a['image']['url']); ?>" alt="" class="img-index-<?= $counter; ?> <?= $counter==0 ? 'active' : '' ?>"/>
            <?php $counter++ ?>
        <?php endforeach; ?>
    </div>
</section>
<?php } ?>