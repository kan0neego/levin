<?php
/**
 * Template Name: Филиал
 */

get_header();

if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = '/wp-content/uploads/2016/01/bg_levin.jpg';
}
?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<div class="page page_sidebar">

    <header class="hat">
        <?php get_template_part('template-parts/contacts/banner-single'); ?>
    </header>

    <section class="division-map">
        <div class="division-map__map-box" id="contactsMapBranch" data-center-desktop="<?php echo get_page_uri($post->ID) == 'kontakty/universitet' ? '55.68960885851686,37.524056366378744' : '55.732083167339354,37.585311466903654'; ?>"
            data-center-mobile="<?php echo get_page_uri($post->ID) == 'kontakty/universitet' ? '55.68063823218292,37.52659910052486' : '55.722456238711516,37.588798338623'; ?>" data-marker="<?php echo get_page_uri($post->ID) == 'kontakty/universitet' ? '55.68982097669404,37.52711408465572' : '55.732143706517206,37.58878760978695'; ?>"></div>
        <div class="division-map__wrap wrap">
            <div class="division-map__contacts map-contacts">
                <p class="map-contacts__title">Контакты</p>
                <div class="map-contacts__box">
                    <p class="map-contacts__name">Адрес</p>
                    <div class="map-contacts__value">
                        <p class="map-contacts__address">
                            <?php echo get_field('clinic_address'); ?>
                        </p>
                    </div>
                    <div class="map-contacts__description">
                        <p class="map-contacts__build"><?php echo get_field('clinic_address_caption'); ?></p>
                        <div class="map-contacts__parking">
                            <img class="mr-1" src="<?php echo get_template_directory_uri(); ?>/img/park-icon.svg">
                            <p>Бесплатная парковка</p>
                        </div>
                    </div>
                    <div class="map-contacts__way">
                        <a href="#pathway" class="map-contacts__driveway">
                            <i class="icon icon-driveway">
                                <span class="path1"></span>
                            </i>
                            <span class="map-contacts__driveway-text">
                                Схема проезда
                            </span>
                        </a>
                        <a href="#pathway" class="map-contacts__coords">Координаты <?php echo get_field('clinic_geo'); ?></a>
                    </div>
                </div>
                <hr class="map-contacts__line">
                <div class="map-contacts__box map-contacts__box--col-2 map-contacts__box--adress-way">
                    <div class="map-contacts__col">
                        <p class="map-contacts__name">Метро</p>
                        <div class="map-contacts__value">
                            <span class="map-contacts__metro"><?php echo get_field('clinic_metro'); ?></span>
                        </div>
                    </div>
                    <div class="map-contacts__col">
                        <span class="map-contacts__time">
                            <i class="icon-pedestrian">
                                <span class="path1"></span>
                            </i>
                            5 минут пешком
                        </span>
                    </div>
                </div>
                <hr class="map-contacts__line">
                <div class="map-contacts__box">
                    <p class="map-contacts__name">Контактный телефон</p>
                    <div class="map-contacts__value">
                        <a href="<?php echo phone_link(get_site_phone()); ?>" class="map-contacts__phone">
                            <?php echo phone_format(get_site_phone()); ?>
                        </a>
                    </div>
                </div>
                <hr class="map-contacts__line">
                <div class="map-contacts__box">
                    <p class="map-contacts__name">Адрес</p>
                    <div class="map-contacts__value">
                        <a href="mailto:<?php echo get_site_email(); ?>" class="map-contacts__email"><?php echo get_site_email(); ?></a>
                    </div>
                </div>
                <hr class="map-contacts__line">
                <div class="map-contacts__box map-contacts__box--col-2">
                    <div class="map-contacts__col">
                        <p class="map-contacts__name">Понедельник-пятница</p>
                        <div class="map-contacts__value">
                            <p class="map-contacts__hours">с 10:00 до 20:00</p>
                        </div>
                    </div>
                    <div class="map-contacts__col">
                        <p class="map-contacts__name">Суббота</p>
                        <div class="map-contacts__value">
                            <p class="map-contacts__hours">
                                с 10:00 до 19:00
                                <?php //echo (get_page_uri($post->ID) == 'kontakty/universitet') ? 'выходные дни' : '10:00 до 19:00'
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="map-contacts__box">
                    <a href="https://yandex.ru/maps/?rtext=~<?php echo get_field('clinic_geo'); ?>" target="_blank"
                        class="map-contacts__btn ya-nav-btn btn-n">
                        <span class="show-tablet">
                            Открыть в
                        </span>
                        <img src="<?php echo get_template_directory_uri(); ?>/src/img/ya-nav.png" alt="" class="ya-nav-btn__icon">
                        <span class="ya-nav-btn__dark">
                            Яндекс.Навигатор
                        </span>
                    </a>
                </div>
            </div>
        </div>
</div>
<div class="pathway section-default" id="pathway">
    <div class="pathway__wrap wrap">
        <h2 class="pathway__title">Как добраться</h2>
        <div class="pathway__accordion accordion-path">
            <div class="accordion-path__item">
                <div class="accordion-path__header">
                    <i class="accordion-path__icon icon-pedestrian"></i>
                    <p class="accordion-path__title">
                        <!--<span class="show-mobile">Пешком</span>-->
                        <span class="show-tablet">
                            Пешком от метро <?php echo get_field('clinic_metro'); ?>
                        </span>
                    </p>
                    <i class="accordion-path__arrow icon-arrow-accordion-path"></i>
                </div>
                <div class="accordion-path__content text-box">
                    <?php echo get_field('clinic_route_metro'); ?>
                </div>
            </div>
            <div class="accordion-path__item">
                <div class="accordion-path__header">
                    <i class="accordion-path__icon icon-car"></i>
                    <p class="accordion-path__title">
                        <!--<span class="show-mobile">Схема проезда</span>-->
                        <span class="show-tablet">Схема проезда на парковку</span>
                    </p>
                    <i class="accordion-path__arrow icon-arrow-accordion-path"></i>
                </div>
                <div class="accordion-path__content text-box">
                    <?php echo get_field('clinic_route_parking'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //get_template_part( 'template-parts/contacts/review' );
?>
<?php get_template_part('template-parts/contacts/sert'); ?>

<?php if( is_page( 20485 ) ) : ?>

<?php get_template_part('template-parts/contacts/credentials-park-kultury'); ?>

<?php elseif( is_page( 20486 ) ) : ?>
<?php get_template_part('template-parts/contacts/credentials-universitet'); ?>
<?php endif; ?>

<?php get_footer();
