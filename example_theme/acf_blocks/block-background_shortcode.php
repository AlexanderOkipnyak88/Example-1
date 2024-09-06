<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-background_shortcode-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-background_shortcode';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $image = get_field('image');
    $shortcode = get_field('shortcode');
    $styleStr='';
    if($image) :
        $imgUrl=$image['url'];
        $styleStr='background:url('.$imgUrl.') no-repeat center 0; background-size:cover;';
    endif;
?>
<section class="<?= $className; ?>" id="<?= $id; ?>" style="<?= $styleStr; ?>">
    <div class="background-shortcode_wrap">
        <div class="form_wrapper">
            <?php echo do_shortcode($shortcode); ?>
        </div>
    </div>
</section>
<?php } ?>