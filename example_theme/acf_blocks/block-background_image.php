<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    global $post;
    $id = 'block-background_image-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-background_image';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    $className.=" ".get_field('style');
    $image = get_field('image');
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $with_ticker = get_field('with_ticker');
    $tickers = get_field('tickers');
    $styleStr='';
    if($image) :
        $imgUrl=$image['url'];
        $styleStr='background:url('.$imgUrl.') no-repeat center 0; background-size:cover;';
    endif;
?>
<section class="<?= $className; ?>" id="<?= $id; ?>" style="<?= $styleStr; ?>">
    <div class="background-image_wrap">
        <div class="content_wrapper">
            <?php if($title!='') : ?>
                <h1><?= $title; ?></h1>
            <?php endif; ?>
            <?= $text;  ?>
            <?php if($link) : ?>
                <a href="<?= esc_url($link['url']); ?>" class="btn"><?= $link['title']; ?></a>
            <?php endif; ?>
        </div>
        <?php if(get_post_type() === 'post') : ?>
        <div class="post_meta">
            <?php $cats = wp_get_post_categories( $post->ID);?>
            <?php if($cats) : ?>
            <div class="title"><?php _e('Kategorien','lr'); ?></div>
            <div class="categories">
            <?php 
                foreach($cats as $cat){ ?>
                    <?php 
                        $cat_url=get_permalink(get_option( 'page_for_posts' ));
                        $cat_url .= (parse_url($cat_url, PHP_URL_QUERY) ? '&' : '?') . 'cat='.$cat; ?>
                    <a href="<?= esc_url($cat_url); ?>"><?= get_the_category_by_ID($cat); ?></a>
                <?php } ?>
            </div>
            <?php endif; ?>
            <div class="title"><?php _e('Veröffentlichungsdatum','lr'); ?></div>
            <div class="date"><?php the_time( get_option( 'date_format' ) ); ?></div>
            <?php if(the_author()!='') : ?>
                <div class="title"><?php _e('Autor','lr'); ?></div>
                <div class="author"><?php the_author(); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(get_post_type() === 'vacancy') : ?>
        <div class="vacancy_meta">
            <div>
                <div class="title"><?php _e('Standort','lr'); ?></div>
                <div class="region"><?= get_field('region',$post->ID); ?></div>
            </div>
            <div>
                <div class="title"><?php _e('Beschäftigungsverhältnis','lr'); ?></div>
                <div class="employment"><?= get_field('employment',$post->ID); ?></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php if($with_ticker) :  ?>
    <section class="block-running_ticker">
        <div class="running_ticker_wrap">
            <?php if($tickers) : ?>
                <div class="ticker">
                <?php foreach($tickers as $item) : ?>
                    <div class="ticker_item">
                        <?= $item['item']; ?>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
</section>
<?php } ?>