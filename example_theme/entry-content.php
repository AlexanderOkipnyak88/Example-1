<?php  
    $title = get_the_title();  
    $keys = explode(" ",$s);  
    $title = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search_expt">\0</span>', $title);

    $excerpt = get_the_excerpt();  
    $excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search_expt">\0</span>', $excerpt);
?>
<div class="content_wrapper">
    <h4><?= $title; ?></h4>
    <div class="text_wrap"><?= $excerpt; ?></div>
    <div class="more_wrap">
        <a href="<?php esc_url(the_permalink()); ?>" class="more_btn"><?php _e('Mehr lesen','lr'); ?></a>
    </div>
</div>