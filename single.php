<?php
/*
 *  TODO:
 *  [] Картинка в баннере через img
 *  [] Дефолтный серый фон пока картинка не прогрузилась
 */

get_header();

if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = '/wp-content/uploads/2016/01/bg_levin.jpg';
}

$post_id = get_the_ID();
$h1 = get_field('h1');

?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>)
    }
</style>

<article class="post page <?php echo have_rows('toc_sidebar') ? 'page_sidebar' : ''; ?>">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name">
                    <?= $h1 ? $h1 : get_the_title() ?>
                </h1>

                <?php if (get_field('subtitle')): ?>
                <b>
                    <?php echo get_field('subtitle'); ?>
                </b>
                <?php endif; ?>

                <?php if(has_excerpt()) { ?>
                <p class="banner__text">
                    <?php echo get_the_excerpt(); ?>
                </p>
                <?php } ?>

                <?php
                $banner_list_items = get_field('banner_list');
                $banner_list_count = is_array($banner_list_items) ? count($banner_list_items) : 0;

                if(!empty($banner_list_items)) { ?>

                <div class="banner__text-list<?php echo $banner_list_count > 3 ? ' two-col' : ''; ?>">
                    <?php
                    foreach( $banner_list_items as $banner_list_item ) { ?>
                    <div class="banner__text-item">
                        <i></i>
                        <span>
                            <?php echo $banner_list_item['banner_list_item']; ?>
                        </span>
                    </div>
                    <?php
                    } ?>
                </div>
                <?php } ?>

                <hr />

                <?php if( have_rows('toc') ):?>
                <ul class="banner__menu">
                    <?php
                    while (have_rows('toc')):
                        the_row();
                        echo '<li class="banner__item"><a href="#' . get_sub_field('toc_anchor') . '" class="banner__link"><i></i><span>' . get_sub_field('toc_name') . '</span></a></li>';
                    endwhile; ?>
                </ul>
                <?php endif; ?>

                <div class="banner__button">
                    <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2"
                        onclick="_tmr.push({ type: 'reachGoal', id: 3289173, goal: 'general' }); console.log('Goal general reached for form submission button');">
                        <i class="b-icon b-icon--edit"></i>
                        Записаться на приём
                    </a>
                    <a href="#" class="b-button b-button--outline" data-toggle="modal" data-target="#myModal2"
                        onclick="_tmr.push({ type: 'reachGoal', id: 3289173, goal: 'general' }); console.log('Goal general reached for form submission button');">
                        <i class="b-icon b-icon--return"></i>
                        Обратный звонок
                    </a>
                </div>
            </div>
        </div>
    </header>

    <?php get_template_part('template-parts/sections/awards-badges'); ?>
    <?php get_template_part('template-parts/sections/services-cards'); ?>


    <?php if ($post_id==22234) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/WDmNggnrHzs">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/kompaniets-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Мини-импланты в ортодонтии</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/kompaniets-avatar.png"
                            alt="">
                        <div>
                            <p>Компаниец Екатерина Дмитриевна</p>
                            <span>Стоматолог-ортодонт</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif ($post_id==9263) { // gigiena ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/CcK0Zdbsm8s">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/vereshagina-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Узнайте все о гигиенической чистке за 2 минуты</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/vereshagina-avatar.png"
                            alt="">
                        <div>
                            <p>Верещагина Ольга Константиновна</p>
                            <span>Стоматолог-пародонтолог</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif ($post_id==21040) { // gbt ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/YbUKlNfFdaU">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/vereshagina-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Пародонтологическая чистка зубов</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/vereshagina-avatar.png"
                            alt="">
                        <div>
                            <p>Верещагина Ольга Константиновна</p>
                            <span>Стоматолог-пародонтолог</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif ($post_id==19271) { // vector ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/AuT1uj6_xOQ">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/vereshagina-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Лечение десен аппаратом Вектор</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/vereshagina-avatar.png"
                            alt="">
                        <div>
                            <p>Верещагина Ольга Константиновна</p>
                            <span>Стоматолог-пародонтолог</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==22242) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/UmwyZt24zp4">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/levin-narkoz-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Седация и наркоз: в чем отличие?</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png"
                            alt="">
                        <div>
                            <p>Левин Дмитрий Валерьевич</p>
                            <span>Главный врач</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==7703 || $post_id==2135 || $post_id==21819 || $post_id==4696 || $post_id==12138 || $post_id==13186 || $post_id==21204 || $post_id==11733 || $post_id==18904 || $post_id==20701 || $post_id==18399 || $post_id==12030 || $post_id==11547) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://rutube.ru/video/3fea809d307dc8a3716becaec7d84cf0/">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/lytkina-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container" style="gap:inherit">
                    <div class="big-video__subtitle">All-on-4 «во сне» 💤</div>
                    <span class="big-video__subtitle" style="line-height: 1.5; font-size:21px">Отзыв пациента о
                        протезировании
                        зубов на 4 имплантатах</span>

                    <!--<div class="person-container">
            <img class="person-container__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png" alt="">
            <div>
              <p>Левин Дмитрий Валерьевич</p>
              <span>Главный врач</span>
            </div>
          </div>-->
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==11428) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/-CX7Y0Y4GG8">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/perforaciya-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Перфорация гайморовой пазухи при синус-лифтинге</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png"
                            alt="">
                        <div>
                            <p>Левин Дмитрий Валерьевич</p>
                            <span>Главный врач</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==18961) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/X7TXVXYvIKc">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/kista-v-pazuhe-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Киста зуба проросла в гайморову пазуху. Что делать?</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png"
                            alt="">
                        <div>
                            <p>Левин Дмитрий Валерьевич</p>
                            <span>Главный врач</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==12379) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/ky5kYsCpS8U">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/sinusit-posle-sinus-liftinga-preview.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container">
                    <span class="big-video__subtitle">Осложнения синус-лифтинга</span>
                    <div class="person-container">
                        <img class="person-container__image"
                            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png"
                            alt="">
                        <div>
                            <p>Левин Дмитрий Валерьевич</p>
                            <span>Главный врач</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php } elseif($post_id==7992) { ?>

    <div id="video-section" class="video-section video-section_dark">
        <div class="video-section__container">
            <a class="big-video tube" href="https://youtu.be/b9SaS8GU1JY">
                <div class="video-play">
                    <img class="video-play__image"
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/video-play-button.svg"
                        alt="">
                </div>
                <video class="big-video__video banner-video__video" autoplay="" muted="" playsinline=""
                    loop="">
                    <source
                        src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/video/preview-udalenie-mike.mp4"
                        type="video/mp4">
                </video>
                <div class="big-video__info-container" style="gap:inherit">
                    <div class="big-video__subtitle">Удаление всех зубов мудрости «во сне» 💤</div>
                    <span class="big-video__subtitle" style="line-height: 1.5; font-size:21px">Отзыв
                        пациента</span>

                    <!--<div class="person-container">
            <img class="person-container__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/static/img/levin-avatar.png" alt="">
            <div>
              <p>Левин Дмитрий Валерьевич</p>
              <span>Главный врач</span>
            </div>
          </div>-->
                </div>
            </a>
        </div>
    </div>

    <?php } ?>

    <main class="prose-with-sidebar">

        <div class="sidebar-r">
            <?php if( have_rows('toc_sidebar') ): ?>
            <div class="sidebar-r__inner">
                <div class="sidebar-r__wrap">

                    <div class="sidebar-r__title">
                        Содержание
                    </div>

                    <ul class="sidebar-r__list">
                        <?php while ( have_rows('toc_sidebar') ) : the_row(); ?>
                        <li class="sidebar-r__list-item">
                            <a href="#<?php the_sub_field('toc_sidebar_anchor'); ?>" class="sidebar-r__link">
                                <?php the_sub_field('toc_sidebar_name'); ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="prose article">

            <?php //get_template_part('template-parts/service/related-links');
            ?>

            <?php
            while (have_posts()) {
                the_post();
                the_content();
            }
            ?>

            <?php
            
            $cat = get_the_category(get_the_ID());
            $cat_id = !empty($cat) ? (int) $cat[0]->cat_ID : 0;
            
            if (in_array($cat_id, [3, 19, 82, 66], true)) {
                get_template_part('template-parts/service/warranty');
            }
            
            ?>

            <?php get_template_part('template-parts/service/post-author'); ?>

        </div>
    </main>

    <?php get_template_part('template-parts/sections/video-reviews'); ?>

    <?php get_template_part('template-parts/sections/awards-cards'); ?>

    <?php get_template_part('template-parts/sections/doctors'); ?>

    </div>
    </div>

    <?php get_template_part('template-parts/sections/service-price'); ?>
</article>

<?php get_footer();
