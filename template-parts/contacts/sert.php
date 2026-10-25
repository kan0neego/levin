<?php if( get_field( "certificates" ) ) : ?>

    <?php
        $images = get_field('certificates');
        $size = 'full';
        $thumbnail = array(100,100);
    ?>
    <div class="section-license section-default pt-0">
        <div class="section-license__wrap wrap">
            <h2 class="section-license__title">
                Лицензии и сертификаты
            </h2>
        </div>
        <div class="license-list swiper js-swiper wrap" data-option="license-list" data-per-view="4" data-lg-slides-per-view="3"
    data-sm-slides-per-view="1">
            <div class="swiper-wrapper">
                <?php if( $images ) : ?>
                    <?php foreach( $images as $image ) : ?>
                        <div class="swiper-slide">
                            <div class="license-list__item license-item">
                                <picture class="license-item__picture picture">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="" class="picture__img glightbox" data-gallery="gallery1">
                                </picture>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="license-list__arrows">
                <div class="slider-arrow swiper-button-prev license-list__arrow license-list__arrow--prev"></div>
                <div class="slider-arrow swiper-button-next license-list__arrow license-list__arrow--next"></div>
            </div>
            <div class="license-list__pagination swiper-pagination"></div>
        </div>
    </div>

<?php endif; ?>