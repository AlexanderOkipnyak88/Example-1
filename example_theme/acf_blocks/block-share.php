<?php if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
} ?>

<?php
if (!$is_preview) {
    $id = 'block-share-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }
    $className = 'block-share';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }
    global $post;
    $link = get_permalink($post->ID);
?>
<section class="<?= $className; ?>" id="<?= $id; ?>">
    <div class="share_wrap">
        <div class="small_title_wrap">
            <div class="small_title"><?php _e('Aktionen','lr'); ?></div>
        </div>
        <div class="sharing_wrap">
            <div class="likes">
                <div class="share_title"><?php _e('Hat Ihnen der Artikel gefallen?', 'lr'); ?></div>
                <?= get_simple_likes_button( $post->ID ); ?>
            </div>
            <div class="share">
                <div class="share_title"><?php _e('Teilen', 'lr'); ?></div>
                <div class="share_block">
                    <?php $share_str= str_replace(' ','%20',$post->post_title); ?>
                    <a href="http://www.facebook.com/sharer/sharer.php?u=<?= esc_url($link) ?>&t=<?= $share_str ?>" target="_blank" class="share-popup fb">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.9997 1.66663H12.4997C11.3946 1.66663 10.3348 2.10561 9.5534 2.88701C8.77199 3.66842 8.33301 4.72822 8.33301 5.83329V8.33329H5.83301V11.6666H8.33301V18.3333H11.6663V11.6666H14.1663L14.9997 8.33329H11.6663V5.83329C11.6663 5.61228 11.7541 5.40032 11.9104 5.24404C12.0667 5.08776 12.2787 4.99996 12.4997 4.99996H14.9997V1.66663Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                    </a>
                    <a href="http://www.twitter.com/intent/tweet?url=<?= esc_url($link); ?>&text=<?= $share_str ?>" target="_blank" class="share-popup tw">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.1663 2.49996C18.3683 3.06285 17.4848 3.49338 16.5497 3.77496C16.0478 3.19788 15.3808 2.78887 14.6389 2.60323C13.897 2.41759 13.1159 2.46429 12.4014 2.737C11.6869 3.00972 11.0734 3.49529 10.6438 4.12805C10.2143 4.76082 9.98942 5.51024 9.99967 6.27496V7.10829C8.5352 7.14626 7.08407 6.82147 5.77551 6.16283C4.46696 5.50419 3.34161 4.53215 2.49967 3.33329C2.49967 3.33329 -0.833659 10.8333 6.66634 14.1666C4.95011 15.3316 2.90564 15.9157 0.833008 15.8333C8.33301 20 17.4997 15.8333 17.4997 6.24996C17.4989 6.01783 17.4766 5.78629 17.433 5.55829C18.2835 4.71953 18.8837 3.66055 19.1663 2.49996Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= esc_url($link); ?>" target="_blank" class="share-popup ln">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.333 6.66663C14.6591 6.66663 15.9309 7.19341 16.8685 8.13109C17.8062 9.06877 18.333 10.3405 18.333 11.6666V17.5H14.9997V11.6666C14.9997 11.2246 14.8241 10.8007 14.5115 10.4881C14.199 10.1756 13.775 9.99996 13.333 9.99996C12.891 9.99996 12.4671 10.1756 12.1545 10.4881C11.8419 10.8007 11.6663 11.2246 11.6663 11.6666V17.5H8.33301V11.6666C8.33301 10.3405 8.85979 9.06877 9.79747 8.13109C10.7352 7.19341 12.0069 6.66663 13.333 6.66663Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.00033 7.5H1.66699V17.5H5.00033V7.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.33366 4.99996C4.25413 4.99996 5.00033 4.25377 5.00033 3.33329C5.00033 2.41282 4.25413 1.66663 3.33366 1.66663C2.41318 1.66663 1.66699 2.41282 1.66699 3.33329C1.66699 4.25377 2.41318 4.99996 3.33366 4.99996Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>