<?php $h1 = get_field('h1'); ?>
<div class="banner banner-contact">
    <div class="banner__content">
        <?php levin_breadcrumbs(); ?>
        <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>
        <div class="banner-page-phone">
            <p class="banner-page-phone__title">Контактный телефон</p>
            <a href="<?php echo phone_link(get_site_phone()); ?>" class="banner-page-phone__text">
                <?php echo phone_format(get_site_phone()); ?>
            </a>
        </div>
        <hr>
        <div class="banner__footer">
            <div class="banner-contact__contacts">
                <div class="banner-page-address">
                    <div class="banner-page-address__header">
                        <span>Клиника</span>
                        <p class="banner-page-address__point">Университет</p>
                    </div>
                    <p class="banner-page-address__text">пр. Вернадского, д. 8А</p>
                </div>
                <div class="banner-page-address">
                    <div class="banner-page-address__header">
                        <span>Клиника</span>
                        <p class="banner-page-address__point banner-page-address__point--brown">Парк Культуры</p>
                    </div>
                    <p class="banner-page-address__text">ул. Льва Толстого, д. 5, стр. 1</p>
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
