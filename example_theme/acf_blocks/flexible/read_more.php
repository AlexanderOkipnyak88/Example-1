<?php 
	if(get_row_layout()=='read_more'): 
        $link=get_sub_field('link');
?>  
    <p class="rm"><a href="<?= esc_url($link['url']); ?>" class="more_btn"><?= $link['title']!='' ? $link['title'] : 'Jetz Anfragen' ?></a></p>
<?php endif;?>
