</main>
</div>
<?php
    $footer_logo = get_field('footer_logo', 'option');
    $footer_text = get_field('footer_text', 'option');
    $footer_first_menu_title = get_field('footer_first_menu_title', 'option');
    $footer_second_menu_title = get_field('footer_second_menu_title', 'option');
    $contacts_title = get_field('contacts_title', 'option');
    $footer_address = get_field('footer_address', 'option');
    $footer_phone = get_field('footer_phone', 'option');
    $footer_fax = get_field('footer_fax', 'option');
    $footer_email = get_field('footer_email', 'option');
    $copyright = get_field('copyright', 'option');
?>
<footer id="footer" role="contentinfo">
    <div class="footer_wrap">
        <div class="top_footer">
            <div class="footer_logo">
                <?php if($footer_logo){ ?>
                    <a href="/" class="custom-logo-link"><img class="footer-logo" src="<?= $footer_logo['url'] ?>" alt="" width="100" height="100"></a>        
                <?php } ?>
                <div class="footer_text"><?= $footer_text; ?></div>
            </div>
            <div class="footer_menu_1">
                <h5><?= $footer_first_menu_title; ?></h5>
                <nav id="footer_menu_1" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-1', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                </nav>
            </div>
            <div class="footer_menu_2">
                <h5><?= $footer_second_menu_title; ?></h5>
                <nav id="footer_menu_2" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                </nav>
            </div>
            <div class="footer_contacts">
                <h5><?= $contacts_title; ?></h5>
                <div class="f_contact address"><?= $footer_address; ?></div>
                <div class="f_contact phone"><a href="tel:<?= str_replace(' ', '', $footer_phone); ?>"><?= $footer_phone; ?></a></div>
                <div class="f_contact fax"><?= $footer_fax; ?></div>
                <div class="f_contact email"><a href="mailto:<?= $footer_email; ?>"><?= $footer_email; ?></a></div>
            </div>
        </div>
    </div>
    <div class="bottom_footer_line">
        <div class="footer_wrap">
            <div class="bottom_footer">
                <div class="copyright"><?= $copyright; ?></div>
                <nav id="bottom-footer-menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu( array( 'theme_location' => 'bottom-footer-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                </nav>
            </div>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>