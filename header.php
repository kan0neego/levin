<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Левин Д.В">
    <meta name="theme-color" content="#313640">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/img/icon-highres.png">
    <link rel="dns-prefetch" href="//vk.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="preconnect" href="//cdnjs.cloudflare.com">
    <link rel="preconnect" href="//fonts.gstatic.com">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php if (!is_page_template('page-feedback.php') && !is_page_template('page-skk.php')) { ?> 
    <header class="mobile-header">
        <a href="<?php echo site_url() ?>" class="mobile-header__logo" aria-label="<?php the_field('sitename_caption', 'option'); ?>"></a>
        <button class="mobile-header__contacts button button_outline-blue" data-toggle="modal" data-target="#myModal" onclick="ym(38009025,'reachGoal','kontact_open'); return true;">Контакты</button>
        <button class="mobile-header__trigger" aria-label="Открыть меню"></button>
    </header>
    <aside class="sidebar sidebar_on">
        <div class="sidebar__item">
            <div class="site-menu">
                <div class="site-menu__branding site-menu__segment">
                    <a href="<?php echo site_url() ?>" class="site-menu__logo" aria-label="<?php the_field('sitename_caption', 'option'); ?>"></a>
                    <div>
                        <div class="site-menu__name"><?php the_field('sitename_short', 'option'); ?></div>
                        <div class="site-menu__slogan"><?php the_field('sitename_caption', 'option'); ?></div>
                    </div>
                </div>
                <div class="header__phone-what">
                    <a href="<?php echo phone_link( get_site_phone() ); ?>" class="site-menu__phone site-menu__segment" onclick="ym(38009025,'reachGoal','phone_click'); return true;">
                        <?php echo phone_format( get_site_phone() ); ?>
                    </a>
                </div>
                <div class="site-menu__segment">
                    <button id="order" class="sidebar-new__btn-n btn-n" data-toggle="modal" data-target="#myModal2">
                        Записаться на приём
                    </button>
                    <button id="contacts" class="site-menu__button button button_outline-blue" data-toggle="modal" data-target="#myModal">
                        Контактная информация
                    </button>
                </div>

                <?php get_template_part('template-parts/sidebar/sidebar-medal'); ?>

                <?php get_template_part('template-parts/menu/sidebar-menu'); ?>

                <?php get_template_part('template-parts/sidebar/sidebar-offer'); ?>

                <?php get_template_part('template-parts/sidebar/sidebar-timetable'); ?>

                <?php get_template_part('template-parts/sidebar/sidebar-social'); ?>

            </div>
            <div class="site-menu__actions site-menu__segment">
                <button class="site-menu__button btn-n btn-n--crystal" data-toggle="modal" data-target="#myModal" onclick="ym(38009025,'reachGoal','kontact_open'); return true;">Контакты и запись на приём</button>
                <button class="site-menu__button btn-n btn-n--crystal" data-toggle="modal" data-target="#control">Служба контроля качества</button>
            </div>
        </div>
    </aside>
  
    <div id="wrapper">
        <div id="page-content-wrapper">
                        
    <?php } // закрываем проверку на шаблон отзывов ?>
