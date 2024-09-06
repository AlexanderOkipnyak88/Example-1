<?php 
	if(get_row_layout()=='title'): 
        $type = get_sub_field('type');
?>  
	    <<?= $type; ?>><?php the_sub_field('text'); ?></<?= $type; ?>>

<?php endif;?>
