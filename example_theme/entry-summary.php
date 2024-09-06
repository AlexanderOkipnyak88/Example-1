<a href="<?php the_permalink(); ?>">
    <div class="img_wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); ?>
        <?php endif; ?>
    </div>
    <div class="content_wrapper">
        <div class="post_meta">
            <?php
                $cats = wp_get_post_categories( $post->ID, array(
                    'exclude' => [1]
                ));
                if($cats) :
                    $isfirst = true;
            ?>
                <span class="category">
                    <?php foreach($cats as $cat){
                        if(!$isfirst)
                            echo ', ';
                        echo get_the_category_by_ID($cat);
                        $isfirst = false;
                    } ?>
                </span>
            <?php
                endif;
            ?>
            <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
        </div>
        <h4><?php the_title(); ?></h4>
        <div class="text_wrap"><?php the_excerpt(); ?></div>
        <div class="more_wrap">
            <span class="more_btn"><?php _e('Mehr lesen','lr'); ?></span>
        </div>
    </div>
</a>