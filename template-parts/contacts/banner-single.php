<?php

$h1 = get_field('h1');
?>

<div class="banner banner-contact">
    <div class="banner__content">
        <?php levin_breadcrumbs(); ?>

        <h1 class="banner__name">
            <?= $h1 ? $h1 : get_the_title() ?>
        </h1>

        <?php if ( has_excerpt() ) : ?>
        <p class="banner__text">
            <?php echo get_the_excerpt(); ?>
        </p>
        <?php endif; ?>

        <hr>

        <div class="banner__footer">
            <div class="banner-contact__contacts">
                <div class="banner-page-address">
                    <div class="banner-page-address__header">
                        <p class="banner-page-address__point <?php echo get_page_uri($post->ID) == 'kontakty/universitet' ? '' : 'banner-page-address__point--brown'; ?>">
                            <?php echo get_field('clinic_metro'); ?>
                        </p>
                        <p class="banner-page-address__time">
                            <i class="icon-pedestrian">
                                <span class="path1"></span>
                            </i>
                            5 минут пешком
                        </p>
                    </div>
                    <p class="banner-page-address__text">
                        <?php echo get_field('clinic_address'); ?>
                    </p>
                </div>

                <div class="banner-page-phone">
                    <p class="banner-page-phone__title">Контактный телефон</p>
                    <a href="<?php echo phone_link(get_site_phone()); ?>" class="banner-page-phone__text">
                        <?php echo phone_format(get_site_phone()); ?>
                    </a>
                </div>
            </div>

            <div class="banner__button">
                <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2">
                    <i class="b-icon b-icon--edit"></i>
                    Записаться на приём
                </a>
                <a href="#" class="b-button b-button--outline" data-toggle="modal" data-target="#myModal2">
                    <i class="b-icon b-icon--return"></i>
                    Обратный звонок
                </a>
            </div>
        </div>
    </div>
</div>
