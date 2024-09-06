<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-faq-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-faq';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $title = get_field('title');
    $faq = get_field('faq');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>" itemscope itemtype="https://schema.org/FAQPage">
    <div class="faq_wrap">
        <?php if($title!='') : ?>
            <h2><?= $title; ?></h2>
        <?php endif; ?>
        <?php if($faq) : ?>
            <div class="faq accordion">
                <?php foreach($faq as $f) : ?>
                    <div class="item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="title" itemprop="name">
                            <?= $f['title']; ?>
                            <span class="cross">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.85786 20H34.1421" stroke="#133DA8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20 34.1422V5.85791" stroke="#133DA8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> 
                            </span>
                        </div>
                        <div class="text" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text"><?= $f['text']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php } ?>