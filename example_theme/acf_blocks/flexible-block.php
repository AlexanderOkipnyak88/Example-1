<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
	$id = 'block-background_image-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
?>
<div class="flexible_block" id="<?= $id; ?>" >
<?php
	if(have_rows('flexible_block')){
		while(have_rows('flexible_block')): the_row();
			$layout = 'acf_blocks/flexible/'.get_row_layout();
			get_template_part($layout);
		endwhile;
	}
	else{
		echo "Flexible ACF Block";
	}
?>
<div class="deco"></div>
</div>
<?php } ?>