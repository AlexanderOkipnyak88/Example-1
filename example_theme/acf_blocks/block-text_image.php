<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-text_image-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-text_image';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    if(get_field('align_image')=='left'){
        $className .= ' image-left';
    }
    else{
        $className .= ' image-right';
    }
    if(get_field('with_hidden_text')){
        $className.=' with_hidden_text';
    }
    if(get_field('use_accordion'))
        $className.= ' with_accordion';
    $image = get_field('image');
    $title = get_field('title');
    $title_type = get_field('title_type');
    $text = get_field('text');
    $hidden_text = get_field('hidden_text');
    $link = get_field('link');
    $btn_class="btn";
    if(get_field('button_style')=='more')
        $btn_class = "more_btn";
    else if(get_field('button_style')=='hidden')
        $btn_class = "hidden_text_btn";
    $accordion = get_field('accordion');
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="content_wrapper">
        <?php if($title!='') : ?>
            <?php if($title_type=='H3') : ?>
            <h3><?= $title; ?></h3>
            <?php else : ?>
            <h2><?= $title; ?></h2>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(get_field('use_accordion')) : ?>
            <div class="accordion">
                <?php foreach($accordion as $a) : ?>
                    <div class="item">
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
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="text_wrapper">
                <?= $text; ?>
                <?php if(get_field('with_hidden_text')) :?>
                <div class="hidden_text"><?= $hidden_text; ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if($link) : ?>
            <a href="<?= esc_url($link['url']); ?>" class="<?= $btn_class; ?>"><?= $link['title']; ?></a>
        <?php endif; ?>
    </div>
    <div class="image_wrapper">
        <?php if($image) : ?>
            <img src="<?= esc_url($image['url']); ?>" alt="" width="100" height="100"/>
        <?php endif; ?>
    </div>
</section>
<?php } ?>