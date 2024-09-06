<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-services_tabs-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-services_tabs';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $image = get_field('image');
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $args = array(
        'taxonomy' => 'service_category',
        'hide_empty' => false,
        'orderby'=>'ID',
        'order'=>'ASC'
    );
    $categories = get_terms($args);
    $styleStr='';
    if($image) :
        $imgUrl=$image['url'];
        $styleStr='background-image:url('.$imgUrl.')';
    endif;
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="block-services_tabs_wrap" style="<?= $styleStr; ?>">
        <h2><?= $title; ?></h2>
        <?php if($categories) : ?>
        <?php $counter=0; ?>
        <div class="tabs">
            <ul class="tab_titles">
                <?php foreach($categories as $cat) : ?>
                    <?php 
                        $li_class = '';
                        if($counter == 0){
                            $li_class = 'active';
                            $counter = 1;
                        }
                    ?>
                    <li class="<?= $li_class; ?>"><?= $cat->name; ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="custom-select-wrapper">
                <div class="custom-select">
                    <select>
                        <?php $counter=0; ?>
                        <?php foreach($categories as $cat) : ?>
                            <?php 
                                $li_class = '';
                                if($counter == 0)
                                    $li_class = 'selected = "selected"';
                                $counter++;
                            ?>
                            <option value="<?= $counter; ?>" <?= $li_class; ?>><?= $cat->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php $counter=0; ?>
            <div class="tabs_content">
                <?php foreach($categories as $cat) : ?>
                    <?php
                        $tab_class = 'tab_item';
                        if($counter == 0){
                            $tab_class = 'tab_item active';
                            $counter = 1;
                        }
                    ?>
                    <div class="<?= $tab_class; ?>">
                        <?php
                            $services = get_posts( [
                                'numberposts' => 3,
                                'category'    => 0,
                                'orderby'     => 'date',
                                'order'       => 'ASC',
                                'post_type'   => 'service',
                                'tax_query' => array(
                                    array(
                                    'taxonomy' => 'service_category',
                                    'field' => 'term_id',
                                    'terms' => $cat->term_id
                                     )
                                )
                            ] );
                            foreach( $services as $service ){
                                setup_postdata( $service ); ?>
                                <div class="service">
                                    <a href="<?= esc_url(get_the_permalink($service)); ?>">
                                        <div class="img_wrap">
                                            <?php echo get_the_post_thumbnail($service,'services_tabs'); ?>
                                        </div>
                                        <div class="content_wrap">
                                            <h4><?= get_the_title($service); ?></h4>
                                            <div class="text_wrap"><?= get_the_excerpt($service); ?></div>
                                            <div class="more_wrap">
                                                <span class="more_btn"><?php _e('Mehr lesen','lr'); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                            wp_reset_postdata();
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="bottom_content">
            <div class="bottom_text"><?= $text; ?></div>
            <?php if($link) : ?>
                <a href="<?= esc_url($link['url']); ?>" class="btn white"><?= $link['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php } ?>