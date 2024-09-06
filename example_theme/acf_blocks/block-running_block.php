<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-running_block-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-running_block';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    $title = get_field('title');
    $running_title = '';
    for($i=0;$i<20;$i++){
        $running_title.=$title.' &mdash; ';
    }
    $small_title = get_field('small_title');
    $text = get_field('text');
    $footer_address = get_field('footer_address', 'option');
    $footer_phone = get_field('footer_phone', 'option');
    $footer_fax = get_field('footer_fax', 'option');
    $footer_email = get_field('footer_email', 'option');
?>
<div class="running_header">
    <div class="running_text">
        <div class="ticker"><?= $running_title; ?></div>
    </div>
    <?php if(get_field('show_bottom_content')) : ?>
    <div class="running_wrapper">
        <div class="bottom_content aligntop">
            <div class="small_title"><?= $small_title; ?></div>
            <?php if(get_field('show_contacts')) : ?>
                <div class="contacts">
                    <div class="col">
                        <div class="contact address"><?= $footer_address; ?></div>
                        <div class="contact phone"><a href="tel:<?= str_replace(' ', '', $footer_phone); ?>"><?= $footer_phone; ?></a></div>
                    </div>
                    <div class="col">
                        <div class="contact fax"><?= $footer_fax; ?></div>
                        <div class="contact email"><a href="mailto:<?= $footer_email; ?>"><?= $footer_email; ?></a></div>
                    </div>
                </div>
            <?php else : ?>
                <div class="text"><?= $text; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php } ?>