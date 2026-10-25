<?php
/**
 * Template Name: Контакты New
 */

get_header();
 
  $theme_path = get_stylesheet_directory_uri();
    if(has_post_thumbnail()) {
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
        $header_image = $image_url[0];
    } else {
        $header_image = "/wp-content/uploads/2016/01/bg_levin.jpg";
    }

?>
<?php $directory = get_template_directory_uri() . '/src/'; ?>
<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<div class="page page_sidebar">

    <header class="hat">
        <?php get_template_part('template-parts/contacts/banner-block'); ?>
    </header>

    <div class="page__container page-content page__container-full">
        <div class="section-division">
            <div class="section-division__wrap">
                <div class="division">
                    <div class="division-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="division-slider__slide swiper-slide">
                            <picture class="picture">
                                <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-0.jpg">
                                <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-0.jpg">
                                <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-0.jpg">
                                <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-0.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-0.jpg">
                            </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                            <picture class="picture">
                                <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-5.jpg">
                                <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-5.jpg">
                                <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-5.jpg">
                                <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-5.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-5.jpg">
                            </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                            <picture class="picture">
                                <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-6.jpg">
                                <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-6.jpg">
                                <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-6.jpg">
                                <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-6.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-6.jpg">
                            </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                            <picture class="picture">
                                <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-1.jpg">
                                <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-1.jpg">
                                <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-1.jpg">
                                <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-1.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-1.jpg">
                            </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-2.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-2.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-2.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-2.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-2.jpg">
                        </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-3.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/universitet-3.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/universitet-3.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/universitet-3.jpg" srcset="<?php echo $directory; ?>img/kontakty/universitet-3.jpg">
                        </picture>
                        </div>
                    </div>
                    <!-- /.swiper-wrapper -->
                    <div class="swiper-button-prev slider-arrow division-slider__arrow division-slider__arrow--prev"></div>
                    <div class="swiper-button-next  slider-arrow division-slider__arrow division-slider__arrow--next"></div>
                    <div class="swiper-pagination division-slider__pagination"></div>
                    </div>
                    <!-- /.division-slider -->
                    <div class="division__content">
                    <div class="division__header">
                        <div class="division__points">
                        <span class="division__point division__point--red"></span>
                        </div>
                        <!-- /.division__points -->
                        <p class="division__title">Клиника на Университете</p>
                        <!--
                        <div class="division__text-box">
                        <p>
                            В нашем Центре ценообразование в классическом в виде списка непонятных
                            позиций не используется
                        </p>
                        </div>
                        -->
                        <!-- /.division__text-box -->
                    </div>
                    <!-- /.division__header -->
                    <div class="division-address">
                        <p class="division-address__title">проспект Вернадского, 8А</p>
                        <a href="/kontakty/universitet/" class="division-address__link">Схема проезда</a>
                    </div>
                    <!-- /.division-address -->
                    <div class="division__schedule-box">
                        <div class="division-schedule">
                        <p class="division-schedule__title">Понедельник-пятница</p>
                        <p class="division-schedule__text">с 10:00 до 20:00</p>
                        </div>
                        <!-- /.division-schedule -->
                        <div class="division-schedule">
                        <p class="division-schedule__title">Суббота, воскресенье</p>
                        <p class="division-schedule__text">с 10:00 до 19:00</p>
                        </div>
                        <!-- /.division-schedule -->
                    </div>
                    <!-- /.division__schedule -->
                    <a href="/kontakty/universitet/" class="division__btn btn-n"> Подробнее</a>
                    
                    </div>
                    <!-- /.division__content -->
                </div>
                <!-- /.division -->
                <div class="division">
                    <div class="division-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-1.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-1.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-1.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/park-kultury-1.jpg" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-1.jpg">
                        </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-2.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-2.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-2.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/park-kultury-2.jpg" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-2.jpg">
                        </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-3.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-3.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-3.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/park-kultury-3.jpg" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-3.jpg">
                        </picture>
                        </div>
                        <div class="division-slider__slide swiper-slide">
                        <picture class="picture">
                            <source type="image/webp" media="(min-width: 992px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-4.jpg">
                            <source type="image/webp" media="(min-width: 768px)" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-4.jpg">
                            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-4.jpg">
                            <img alt="" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/kontakty/park-kultury-4.jpg" srcset="<?php echo $directory; ?>img/kontakty/park-kultury-4.jpg">
                        </picture>
                        </div>
                    </div>
                    <!-- /.swiper-wrapper -->
                    <div class="swiper-button-prev slider-arrow division-slider__arrow division-slider__arrow--prev"></div>
                    <div class="swiper-button-next  slider-arrow division-slider__arrow division-slider__arrow--next"></div>
                    <div class="swiper-pagination division-slider__pagination"></div>
                    </div>
                    <!-- /.division-slider -->
                    <div class="division__content">
                    <div class="division__header">
                        <div class="division__points">
                        <span class="division__point division__point--red"></span>
                        <span class="division__point division__point--borrow"></span>
                        </div>
                        <!-- /.division__points -->
                        <p class="division__title">Клиника на Парке Культуры</p>
                        <!--
                        <div class="division__text-box">
                        <p>
                            В нашем Центре ценообразование в классическом в виде списка непонятных
                            позиций не используется
                        </p>
                        </div>
                        -->
                        <!-- /.division__text-box -->
                    </div>
                    <!-- /.division__header -->
                    <div class="division-address">
                        <p class="division-address__title">ул. Льва Толстого, д. 5, стр. 1</p>
                        <a href="/kontakty/park-kultury/" class="division-address__link">Схема проезда</a>
                    </div>
                    <!-- /.division-address -->
                    <div class="division__schedule-box">
                        <div class="division-schedule">
                        <p class="division-schedule__title">Понедельник-пятница</p>
                        <p class="division-schedule__text">с 10:00 до 20:00</p>
                        </div>
                        <!-- /.division-schedule -->
                        <div class="division-schedule">
                        <p class="division-schedule__title">Суббота, воскресенье</p>
                        <p class="division-schedule__text">выходной</p>
                        </div>
                        <!-- /.division-schedule -->
                    </div>
                    <!-- /.division__schedule -->
                    <a href="/kontakty/park-kultury/" class="division__btn btn-n"> Подробнее</a>
                    </div>
                    <!-- /.division__content -->
                </div>
                <!-- /.division -->
            </div>
            <!-- /.section-division__wrap container -->
        </div>
        <!-- /.section-division -->
    </div>


    <?php 
    /*
    <main class="reviews page__container page-content">
       
        <h2 id="parking">Как добраться на машине</h2>
        <div class="row page-row">
            <div class="col-md-9 page-row__col page-row__left reviews-left">
                <div class="contacts-map">
                    <div class="contacts-map__map" id="contactsMap"></div>
                    <div class="contacts-map__badge">
                        <i></i>
                        <span>На территории Центра <b>бесплатная охраняемая парковка</b></span>
                    </div>
                </div>
                <div class="card card_flat contacts-item mb-4">
                    <div class="card-name mb-3">Схема проезда на парковку</div>
                    <div class="card-body">
                        <ul class="list list_blue mb-4">
                            <li>Въезд на внутреннюю парковку клиники с ул. Льва Толстого, по левой стороне движения, между домами №3 и №5</li>
                            <li>За магазином «Продукты», арка с постом охраны с двумя красно-белыми шлагбаумами</li>
                            <li>Сотрудники охраны помогут Вам запарковать автомобиль, далее администратор встретит Вас у служебного входа</li>
                        </ul>
                        <div class="contacts-item__photo">
                            <a href="/wp-content/uploads/roadmap/parking-1.jpg" class="glightbox3" data-gallery="gallery1">
                                <img src="/wp-content/uploads/roadmap/parking-1.jpg" alt="" class="image lazyload"  >
                            </a>
                            <a href="/wp-content/uploads/roadmap/parking-2.jpg" class="glightbox3 " data-gallery="gallery1">
                                <img src="/wp-content/uploads/roadmap/parking-2.jpg" alt="" class="image lazyload"  >
                            </a>
                        </div>
                        
                    </div>
                </div>
                <div class="info-block mb-4">
            <i></i>
            <span>На нашей внутренней парковке иногда заканчиваются места, прошу Вас не парковать 
автомобилина ул. Льва Толстого, лучше ставить на Ксеньинском или Несвижском переулках, 
это ближе к входу в клинику, и не за 380 ₽, а за 150 ₽/час.</span>
        </div>
                <h2 id="walking">Как добраться пешком</h2>
                <div class="contacts-map">
                    <div class="contacts-map__map" id="contactsMapFoot"></div>
                </div>
                <div class=" card card_flat contacts-item mb-5">
                    <div class="card-name mb-3">Маршрут от ст. м. Парк культуры (кольцевая)</div>
                    <div class="card-body">
                        <ul class="list list_blue mb-4">
                            <li>
                                Из стеклянных дверей направо вдоль Комсомольского проспекта, проходим магазин 🏪 «Азбука Вкуса», ⛪️ Церковь и после нее поворачиваем направо на ул. Льва Толстого
                            </li>
                            <li>
                                После магазина 🏪 «Магнолия» на перекрестке поворачиваем налево на Несвижский переулок
                            <li>
                                Вход в клинику под круглой вывеской синего цвета «Doctor Levin»
                            </li>
                        </ul>
                        <div class="contacts-item__photo">
                            <a href="/wp-content/uploads/roadmap/walking-1.jpg" class="page-gallery-kontakty" >
                                <img src="/wp-content/uploads/roadmap/walking-1.jpg" alt="" class="image lazyload"  data-lightbox="image-walking">
                            </a>
                            <a href="/wp-content/uploads/roadmap/walking-2.jpg" class="page-gallery-kontakty" >
                                <img src="/wp-content/uploads/roadmap/walking-2.jpg" alt="" class="image lazyload"  data-lightbox="image-walking">
                            </a>
                            <a href="/wp-content/uploads/roadmap/walking-3.jpg" class="page-gallery-kontakty" >
                                <img src="/wp-content/uploads/roadmap/walking-3.jpg" alt="" class="image lazyload"  data-lightbox="image-walking">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3  page-row__col  page-row__right  reviews-right">
                <div class="reviews-side">
                    <div class="reviews-side__name">Служба контроля качества</div>
                    <div class="reviews-side__text">
                        Ваше обращение рассмотрит генеральный директор в течение 1 дня
                    </div>
                    <div class="reviews-side__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/image/reviews-side.png" alt="">
                    </div>
                    <div class="reviews-side__button">
                        <a href="#" class="btn" data-toggle="modal" data-target="#myModal">Написать директору</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    */
    ?>

</div>

<?php get_footer(); ?>
