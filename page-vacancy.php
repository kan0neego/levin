<?php
/*
 * Template Name: Страница Вакансии
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

$excerpt = get_the_excerpt();
$h1 = get_field('h1');
$banner_list_items = get_field('banner_list');

?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<article class="post page <?php echo have_rows('toc_sidebar') ? 'page_sidebar' : ''; ?>">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>

                <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>

                <?php if (get_field('subtitle')): ?>
                <b class="mb-2"><?php echo get_field('subtitle'); ?></b>
                <?php endif; ?>

                <?php if($excerpt): ?>
                <p class="banner__text">
                    <?php echo $excerpt; ?>
                </p>
                <?php endif; ?>


                <?php if(!empty($banner_list_items)) {
                ?>

                <div class="banner__text-list">
                    <?php
                foreach( $banner_list_items as $banner_list_item ) { ?>

                    <div class="banner__text-item">
                        <i></i>
                        <span><?php echo $banner_list_item['banner_list_item']; ?></span>
                    </div>

                    <?php
                } ?>
                </div>

                <?php
            } ?>

                <div class="banner__button">
                    <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal">
                        <i class="b-icon b-icon--edit"></i>
                        Написать директору
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="page__container">

        <div class="filter">
            <div class="filter__tagline">
                <!--<div class="filter__tag tag tag_current" data-filter="*">Показать все</div>-->
                <div class="filter__tag tag" data-filter=".vac1">Администратор</div>
                <!--<div class="filter__tag tag" data-filter=".vac1">Ассистент стоматолога</div>-->
                <!--<div class="filter__tag tag" data-filter=".vac2">Старшая медсестра</div>-->
                <!--<div class="filter__tag tag" data-filter=".vac3">Стоматолог-хирург</div>-->
                <!--<div class="filter__tag tag" data-filter=".vac4">Старшая медсестра</div>-->
                <!--<div class="filter__tag tag" data-filter=".vac2">Ассистент стоматолога</div>
                <div class="filter__tag tag" data-filter=".vac3">Стоматолог-ортопед</div>-->
            </div>
        </div>

        <!--<p>В данный момент свободных вакансий нет.</p>-->
        <div class="vacancy-list__grid">
            <div class="card_vacancy vac1" id="administrator">
                <h2>Администратор</h2>
                <div class="vacancy_subtitle">Должностные обязанности</div>
                <ul>
                    <li>Встреча пациентов и информирование их об услугах клиники</li>
                    <li>Координирование записи на прием и оформление первичной документации</li>
                    <li>Взаимодействие с медицинским и другим персоналом, работа с медицинской программой IDENT</li>
                    <li>Обработка входящих и исходящих звонков, переписка с пациентами</li>
                    <li>Выполнение поручений руководства</li>
                </ul>
                <div class="vacancy_subtitle">Требования</div>
                <ul>
                    <li>Опыт работы администратором в стоматологии</li>
                    <li>Грамотная устная и письменная речь</li>
                    <li>Доброжелательность, хорошая память, ответственность, коммуникабельность</li>
                    <li>Навыки работы с оргтехникой и ПК</li>
                </ul>
                <div class="vacancy_subtitle">Условия</div>
                <ul>
                    <li>График работы с 10.00 до 20.00</li>
                    <li>Оплата смены - 4000 рублей на испытательный срок три месяца. После испытательного срока 4500
                        рублей за смену</li>
                    <li>Количество смен по выбору (2/2, 5/2 и т.д.)</li>
                    <li>Проспект Вернадского, 8а, метро: Университет</li>
                    <li>Заработная плата почасовая, плюс доп. оплата за Rg-снимки.</li>
                </ul>
                <div class="vacancy_subtitle">Локация</div>
                <div class="vacancy_location">
                    <!--<div style="display: flex; align-items: center; grid-gap: 6px;">
                        <div class="site-menu__center-icon svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
                                <g mask="url(#mask0_6316_3750)">
                                    <rect width="8" height="8" rx="4" fill="#8C5B32"></rect>
                                </g>
                            </svg>
                        </div>
                        <div>Парк Культуры</div>
                    </div>-->
                    <div style="display: flex; align-items: center; grid-gap: 6px;">
                        <div class="site-menu__center-icon svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8"
                                fill="none">
                                <g mask="url(#mask0_6316_3750)">
                                    <rect width="8" height="8" rx="4" fill="#ED1C29"></rect>
                                </g>
                            </svg>
                        </div>
                        <div>Университет</div>
                    </div>
                </div>
                <div class="vacancy_subtitle" style="margin-top:30px">Подробная информация и запись на собеседование по
                    E-mail и телефону (с 10 до 18 в рабочие дни):</div>
                <a href="mailto:poletaeva@doctorlevin.ru" class="section-button mt-4">
                    poletaeva@doctorlevin.ru
                </a>
                <a href="tel:+74957754852" class="section-button mt-4">
                    +7 495 775-48-52
                </a>
            </div>
        </div>
    </main>
</article>

<?php
get_footer();