<?php
/*
Template Name: Услуга Гнатология
Template Post Type: post
*/

get_header();

if( has_post_thumbnail() ) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = "/wp-content/uploads/2016/01/bg_levin.jpg";
}

$post_id = get_the_ID();
$h1 = get_field('h1');
?>
<article class="post page">
    <div class="banner" style="background-image: url(<?php echo $header_image; ?>)">
        <div class="banner__content">
            <?php levin_breadcrumbs(); ?>
            <h1 class="banner__name">
                <?=$h1 ? $h1 : get_the_title(); ?>
            </h1>
            
            <?php if( get_field('subtitle') ) : ?>
                <b class="mb-2">
                    <?php the_field('subtitle'); ?>
                </b>
            <?php endif; ?>
            
            <?php if( has_excerpt() ) : ?>
                <p class="banner__text">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php endif; ?>
            
            <div class="banner__price-container">
                <div class="banner__price-subheading">Цена консультации</div>
                <div class="banner__price">5 000 ₽</div>
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

    <?php get_template_part('template-parts/sections/awards-badges'); ?>

    <div class="section section-default section-anchors pt-40 pt-20-mob pb-0">
        <div class="page__container_index page__container_full">
            <div class="anchors__container">
                <div class="anchors__item">Этапы лечения</div>
                <div class="anchors__item">Кому подходит</div>
                <div class="anchors__item">Преимущества</div>
                <div class="anchors__item">Анализы</div>
                <div class="anchors__item">Альтернативы</div>
                <div class="anchors__item">Сравнения</div>
                <div class="anchors__item">Цены</div>
                <div class="anchors__item">Слово врача</div>
                <div class="anchors__item">Вопросы и ответы</div>
            </div>
        </div>
    </div>

    <div class="section section-default section-page-intro">
        <div class="page__container_index page__container_full">
            <div class="page-intro__text">
                Современная стоматология не имеет ничего общего с тем, что с детства запомнилось людям среднего и старшего возраста больше нет ужасающих механических бормашин, огромных стеклянных шприцев с толстыми, плохо заточенными иглами и слов «ну ничего, потерпишь»
            </div>
        </div>
    </div>

    <div class="section section-default section-treat-list pt-0">
        <div class="page__container_index page__container_full">
            <div class="treat-list__container">
                <div class="treat-list__heading">
                    Что мы лечим
                </div>
                <ul class="treat-list__links">
                    <li><a href="#">Боль в виске при жевании</a></li>
                    <li><a href="#">Боль в шее из-за ВНЧС</a></li>
                    <li><a href="#">Хрустит челюсть</a></li>
                    <li><a href="#">Миофасциальный болевой синдром</a></li>
                    <li><a href="#">Смещение сустава челюсти</a></li>
                    <li><a href="#">Вывих челюсти</a></li>
                    <li><a href="#">Подвывих нижней челюсти</a></li>
                    <li><a href="#">Асимметрия лица</a></li>
                    <li><a href="#">Заклинило челюсть</a></li>
                    <li><a href="#">Щелкает сустав челюсти</a></li>
                    <li><a href="#">Лечение дисфункции височно-нижнечелюстного сустава (ВНЧС)</a></li>
                    <li><a href="#">Болит челюсть при жевании и открывании рта</a></li>
                    <li><a href="#">Cиновит сустава челюсти</a></li>
                    <li><a href="#">Контрактура нижней челюсти</a></li>
                </ul>
            </div>
        </div>
    </div>

<div class="section section-default">
  <div class="page__container_index page__container_full">
    <?php get_template_part('template-parts/common/topic-snippet'); ?>
  </div>
</div>

    <?php get_template_part('template-parts/sections/services-cards'); ?>

    <div class="section section-default section-quote-with-image pt-40 pt-0-mob">
        <div class="page__container_index page__container_full">
            <?php get_template_part('template-parts/gnathology/quote'); ?>
        </div>
    </div>
    
    <div class="section section-default section-identification-symptoms section-dark-gray pt-0 pb-0">
        <div class="page__container_index page__container_full">
            <?php get_template_part('template-parts/gnathology/symptoms'); ?>
        </div>
    </div>

    <?php //get_template_part('template-parts/gnathology/about'); ?>

    <?php //get_template_part('template-parts/gnathology/doctors'); ?>

    <?php //get_template_part( 'template-parts/gnathology/price' ); ?>

    <div class="section section-default section-accordions pt-0">
        <div class="page__container_index page__container_full">
            <h2 class="heading heading_h2 section-heading_h2 heading_border" id="faq">Ответы на вопросы</h2>
            <div class="article">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php //get_template_part('template-parts/sections/doctors'); ?>

    <?php get_template_part('template-parts/sections/awards-cards'); ?>

</article>

<?php
get_footer();