<?php
    $logo = get_field('logo', 'option');
    $logo_dark = get_field('logo_dark', 'option');
    $phone = get_field('phone', 'option');
    $header_link = get_field('link', 'option');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php lr_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header" role="banner" <?= is_search() ? 'class="active search"' : '' ?>>
    <div class="header_wrapper">
        <div class="active_bg">
            <div class="logo">
                <?php if($logo){ ?>
                    <a href="/" class="custom-logo-link"><img class="custom-logo default" src="<?= $logo['url'] ?>" alt="" width="100" height="100"><img class="custom-logo dark" src="<?= $logo_dark['url'] ?>" alt="" width="100" height="100"></a>        
                <?php } else { ?>
                        <a href="/" class="custom-logo-link"><img class="custom-logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="" width="100" height="100"></a>
                <?php } ?>
            </div>
            <div class="actions_wrapper">
                <a href="#" class="search_marker"></a>
                <a href="tel:<?= str_replace(' ', '', $phone); ?>" class="phone"><?= $phone; ?></a>
            </div>
        </div>
        <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
        </nav>
        <div class="link_wrapper">
            <?php if($header_link) : ?>
                <a href="<?= esc_url($header_link['url']); ?>"><?= $header_link['title']; ?></a>
            <?php endif; ?>
        </div>
        <a href="#" class="burger"></a>
    </div>
    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs('-'); ?>
    <div class="mobile_menu_wrap">
        <div class="actions_wrapper">
            <a href="#" class="search_marker"></a>
            <a href="tel:<?= str_replace(' ', '', $phone); ?>" class="phone"><?= $phone; ?></a>
        </div>
        <nav id="mobile_menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
        </nav>
        <div class="link_wrapper">
            <?php if($header_link) : ?>
                <a href="<?= esc_url($header_link['url']); ?>"><?= $header_link['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="search_popup <?= is_search() ? 'active' : '' ?>">
        <div class="search_popup_wrap">
            <a href="#" class="search_close"></a>
            <?php get_search_form(); ?>
        </div>
        <div class="search_wrapper">
            <div class="search_wrap">
                <?php //echo load_search(1,'lorem'); ?>
            </div>
            <div class="posts_nav" id="search_nav">
            <?php 
                //echo load_search_navigation('');
            ?>
            </div>
        </div>
    </div>
</header>
<div id="container">
    <main id="content" role="main">