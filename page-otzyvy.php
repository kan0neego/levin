<?php
/**
 * Template Name: Отзывы
 */

get_header();

$theme_path = get_stylesheet_directory_uri();
if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = '/wp-content/uploads/2016/01/bg_levin.jpg';
}

$h1 = get_field('h1');
?>
<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<div class="page">

    <header class="hat">
        <div class="banner banner-rating">
            <a href="#" class="banner__badge">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/src/img/index/merchant-badge.svg"
                    alt="">
            </a>
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name">
                    <?= $h1 ? $h1 : get_the_title(); ?>
                </h1>
                <?php if (get_field('subtitle')): ?>
                <b>
                    <?php echo get_field('subtitle'); ?>
                </b>
                <?php endif; ?>
                <?php if (has_excerpt()) { ?>
                <p class="banner__text"><?php echo get_the_excerpt(); ?></p>
                <?php } ?>
                <div class="rating-banner">
                    <div class="rating-banner__stars">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span class="active"></span>
                        <p>4.97</p>
                    </div>
                    <div class="rating-banner__info">
                        Средняя оценка на<br />
                        независимых площадках
                    </div>
                </div>
                <hr />
                <div class="rating-image">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/white/1.svg" alt="">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/white/2.svg" alt="">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/white/3.svg" alt="">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/white/4.svg" alt="">
                </div>
                <?php if (have_rows('toc')): ?>
                <ul class="banner__menu">
                    <?php while (have_rows('toc')):
                        the_row();
                        echo '<li class="banner__item"><a href="#' . get_sub_field('toc_anchor') . '" class="banner__link"><i></i><span>' . get_sub_field('toc_name') . '</span></a></li>';
                    endwhile; ?>
                </ul>
                <?php endif; ?>
                <div class="banner__button">
                    <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal4">
                        <i class="b-icon b-icon--edit"></i>
                        Написать отзыв
                    </a>
                    <a href="#" class="b-button b-button--outline" data-toggle="modal" data-target="#control">
                        Написать директору
                    </a>
                </div>
            </div>
        </div>
    </header>



    <main class="reviews page__container page__container_full pt-5">
        <div class="row page-row">
            <div class="col-md-9 page-row__col page-row__left reviews-left">
                <?php
                $reviews_args = array(
                    'post_type' => 'otzyvy',
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 10,
                    'offset' => 0
                );

                $query = new WP_query($reviews_args);
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
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
                                    <span>
                                        <?php echo get_field('author_name') ? get_field('author_name') : 'Пациент'; ?>, <?php the_time('j F Y'); ?></span>

                                </div>
                                <a href="#">
                                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/<?php echo get_field('source'); ?>.svg"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="reviews-card__body">
                        <h3 class="reviews-card__name"><?php the_title(); ?></h3>
                        <div class="reviews-card__text">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <?php
                        $featured_doctors = get_field('doctors');
                        $i = 0;
                        if( $featured_doctors ): ?>
                    <span class="reviews-card_subtitle">Лечащие врачи</span>
                    <div class="reviews-card__footer">

                        <?php foreach( $featured_doctors as $doctor ):
                                $title = get_the_title( $doctor->ID );
                                $custom_field = get_field( 'avatar', $doctor->ID );
                                $excerpt = get_the_excerpt( $doctor->ID );
                                $link = get_permalink( $doctor->ID );
                                $i++;
                            ?>
                        <?php if($i > 2) {

                            } else { ?>
                        <a href="<?php echo esc_html($link); ?>">

                            <div class="doctor-content">
                                <div class="doctor-content__image">
                                    <img src="<?php echo esc_html($custom_field); ?>">
                                </div>
                                <div class="doctor-content__text">
                                    <b><?php echo esc_html($title); ?></b>
                                    <span><?php echo esc_html($excerpt); ?></span>
                                </div>
                            </div>
                        </a>
                        <?php } ?>

                        <?php endforeach; ?>
                    </div>
                    <img class="iconreviews" src="<?php echo get_bloginfo('template_directory'); ?>/img/icon.png">
                    <?php
                    // Reset the global post object so that the rest of the page works correctly.
                    wp_reset_postdata(); ?>
                    <?php endif; ?>





                </div>

                <?php
                    }

                }
                wp_reset_query();
                
                ?>


                <!--
                Темплейт со скриптом и шаблоном карточки ajax подгрузки
                type all - все
                type doctor - отзывы на конкретного доктора
                -->
                <?php get_template_part('load-more-reviews', null, [
                    // массив с параметрами
                    'type' => 'all',
                    'doctor_id' => null,
                ]); ?>




            </div>
            <div class="col-md-3  page-row__col  page-row__right  reviews-right">
                <div class="reviews-side">
                    <div class="reviews-side__name">Служба
                        контроля качества
                    </div>
                    <div class="reviews-side__text">Ваше обращение рассмотрит
                        генеральный директор в течение 1 дня
                    </div>
                    <div class="reviews-side__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/image/reviews-side.png" alt="">
                    </div>
                    <div class="reviews-side__button">
                        <a href="#" class="btn" data-toggle="modal" data-target="#control">Написать
                            директору</a>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="heading heading_h2 heading_border heading_center">Рейтинг и отзывы</h2>
        <div class="rating-list rating-list-while mb-5">
            <a href="https://yandex.ru/maps/org/doktor_levin/1150624676/reviews/" target="_blank" rel="nofollow"
                class="rating-card">
                <div class="rating__item">
                    <div class="rating-star">
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                    </div>
                    <div class="rating-info ff-sf">
                        4.9 <span>из 5</span>
                    </div>
                </div>
                <div class="rating__item">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/yandex.svg" alt="">
                    <div class="rating-amount ff-sf">
                        382 отзыва
                    </div>
                </div>
            </a>
            <a href="https://maps.app.goo.gl/dMc1K57AhP8YzJ868" target="_blank" rel="nofollow" class="rating-card">
                <div class="rating__item">
                    <div class="rating-star">
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                    </div>
                    <div class="rating-info ff-sf">
                        4.8 <span>из 5</span>
                    </div>
                </div>
                <div class="rating__item">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/google.svg" alt="">
                    <div class="rating-amount ff-sf">
                        96 отзывов
                    </div>
                </div>
            </a>
            <a href="https://zoon.ru/msk/medical/tsentr_privatnoj_stomatologii_doktor_levin/" target="_blank"
                rel="nofollow" class="rating-card">
                <div class="rating__item">
                    <div class="rating-star">
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span></span>
                    </div>
                    <div class="rating-info ff-sf">
                        4 <span>из 5</span>
                    </div>
                </div>
                <div class="rating__item">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/zoon.svg" alt="">
                    <div class="rating-amount ff-sf">
                        157 отзывов
                    </div>
                </div>
            </a>
            <a href="https://prodoctorov.ru/moskva/lpu/72645-centr-privatnoy-stomatologii-doktora-levina/otzivi/#tab-content"
                target="_blank" rel="nofollow" class="rating-card">
                <div class="rating__item">
                    <div class="rating-star">
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span class="rating-star__active"></span>
                        <span></span>
                    </div>
                    <div class="rating-info ff-sf">
                        4 <span>из 5</span>
                    </div>
                </div>
                <div class="rating__item">
                    <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/prodoctorov.svg" alt="">
                    <div class="rating-amount ff-sf">
                        17 отзывов
                    </div>
                </div>
            </a>
        </div>

    </main>
</div>

<?php get_template_part('/template-parts/modals/modal-review'); ?>

<?php get_footer(); ?>
