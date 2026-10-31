<?php

get_header();

$theme_path = get_stylesheet_directory_uri();

if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = '/wp-content/uploads/2016/01/bg_levin.jpg';
}

$portfolio = do_shortcode('[portfolio]');

// Глобальная переменная для вывода отзывов
$DOCTOR_ID = null;

?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<div class="page doctor-profile">
    <header class="hat">
        <?php get_template_part('template-parts/doctor/hero-banner', null, ['portfolio' => $portfolio]); ?>
    </header>

    <main class="prose-with-sidebar">
        <div class="prose article">
            <?php the_content(); ?>
            <?php echo $portfolio; ?>

            <?php

        if( get_field( "certificates" ) ):

            $images = get_field('certificates');
            $size = 'full'; // (thumbnail, medium, large, full or custom size)
            $thumbnail = array(100,100); // (thumbnail, medium, large, full or custom size)

      ?>

            <h2 class="heading heading_h2 heading_border heading_center" id="certificates">Сертификаты</h2>
            <div class="swiper-container slide-certificates pb-5">
                <div class="swiper-wrapper">

                    <?php

    if( $images ):

      foreach( $images as $image ):
      ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($image['url']); ?>" class="glightbox">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="" data-lightbox="gallery-cert">
                        </a>
                    </div>

                    <?php

      endforeach;

    endif;
  ?>

                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-slider__button swiper-slider__button_white swiper-slider__button_left swiper-slider__button_left_inset"
                    id="certificates-slider-prev">
                    <svg width="22" height="15" viewBox="0 0 22 15" fill="none"
                        xmlns="https://www.w3.org/2000/svg">
                        <path d="M21.1421 8.1428H1.14209V6.1428H21.1421V8.1428Z"></path>
                        <path d="M1.41417 5.6573L8.48524 12.7284L7.07102 14.1426L-4.57764e-05 7.07151L1.41417 5.6573Z">
                        </path>
                        <path
                            d="M8.48524 1.41466L1.41417 8.48572L-4.57764e-05 7.07151L7.07102 0.000442505L8.48524 1.41466Z">
                        </path>
                    </svg>
                </div>
                <div class="swiper-slider__button swiper-slider__button_white swiper-slider__button_right swiper-slider__button_right_inset"
                    id="certificates-slider-next">
                    <svg width="22" height="15" viewBox="0 0 22 15" fill="none"
                        xmlns="https://www.w3.org/2000/svg">
                        <path d="M0 5.99978H20V7.99978H0V5.99978Z"></path>
                        <path d="M19.7279 8.48528L12.6569 1.41421L14.0711 0L21.1421 7.07107L19.7279 8.48528Z"></path>
                        <path d="M12.6569 12.7279L19.7279 5.65685L21.1421 7.07107L14.0711 14.1421L12.6569 12.7279Z">
                        </path>
                    </svg>
                </div>
            </div>

            <?php

  endif;

  ?>

            <?php
        $DOCTOR_ID = get_the_ID();
            $query_reviews = new WP_Query(array(
                   'post_type' => 'otzyvy',
              'posts_per_page' => 1,
              'offset' => 0,
              'meta_query' => array(
              'post_status' => 'publish',
              array(
                'key' => 'doctors',
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
                )
            )
        ));

        if ( $query_reviews->have_posts() ) {
        ?>
            <h2 class="heading heading_h2 heading_border heading_center" id="otzyvy">Отзывы</h2>
            <?php
            while( $query_reviews->have_posts() ) {

                $query_reviews->the_post(); ?>

            <div class="reviews-card reviews-card_page">
                <div class="reviews-card__header">
                    <div class="reviews-card__header-author">
                        <div class="reviews-card__wrap">
                            <div class="reviews-card__wrap-name">
                                <div class="rating-star">
                                    <span class="rating-star__active"></span>
                                    <span class="rating-star__active"></span>
                                    <span class="rating-star__active"></span>
                                    <span class="rating-star__active"></span>
                                    <span class="rating-star__active"></span>
                                    <!--<span></span>-->
                                </div>
                                <span></span>
                                <span><?php echo get_field('author_name'); ?>, <?php the_time('j F Y'); ?></span>
                            </div>
                            <a href="#">
                                <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/<?php echo get_field('source'); ?>.svg"
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="reviews-card__body">
                    <div class="reviews-card__name"><?php the_title(); ?></div>
                    <div class="reviews-card__text">
                        <?php the_content(); ?>
                    </div>
                </div>

            </div>
            <?php
        }

        /*
          Темплейт со скриптом и шаблоном карточки ajax подгрузки
          type all - все
          type doctor - отзывы на конкретного доктора
          $DOCTOR_ID - глобальная переменная вначале темплейта
        */


        get_template_part('load-more-reviews', null,  array( // массив с параметрами
            'type' => 'doctor',
            'doctor_id' => $DOCTOR_ID
        ));

    }
    wp_reset_query();
    ?>

            <?php

  if( get_field( "education" ) ):

    if( have_rows('education') ):

  ?>

            <h2 class="heading heading_h2 heading_border heading_center" id="education">Образование</h2>
            <div class="section__text-b text-center"><?php echo get_field('education_subtitle'); ?></div>

            <?php

      while( have_rows('education') ): the_row();
        $education_year = get_sub_field('year');
        $education_text = get_sub_field('education_text');

      ?>

            <div class="d-flex  profession mb-4 flex-wrap flex-md-nowrap ff-sf">
                <?php if ( $education_year ): ?>
                <span class="profession__name mb-3 mb-md-0"><?php echo $education_year; ?> г.</span>
                <hr class="mx-3 d-none d-md-block">
                <?php else: ?>
                <hr class="ml-0 mr-3 d-none d-md-block">
                <?php endif; ?>
                <p class="fw-3"><?php echo $education_text; ?></p>
            </div>

            <?php

      endwhile;

    endif;

  endif;

  ?>

            <?php

  if( get_field( "training" ) ):

    if( have_rows('training') ):

  ?>

            <h2 class="heading heading_h2 heading_border heading_center" id="training">Повышение квалификации</h2>
            <div class="section__text-b text-center"><?php echo get_field('training_subtitle'); ?></div>

            <?php

      while( have_rows('training') ): the_row();
        $training_year = get_sub_field('training_year');
        $training_text = get_sub_field('training_text');

      ?>

            <div class="d-flex  profession mb-4 flex-wrap flex-md-nowrap ff-sf">
                <?php if(get_sub_field('training_year')): ?>
                <span class="profession__name mb-3 mb-md-0"><?php echo $training_year; ?> г.</span>
                <hr class="mx-3 d-none d-md-block">
                <?php else: ?>
                <hr class="mr-3 ml-0 d-none d-md-block">
                <?php endif; ?>

                <p class="fw-3"><?php echo $training_text; ?></p>
            </div>

            <?php

      endwhile;

    endif;

  endif;

  ?>

    </main>
</div>


<div class="modal fade photomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
