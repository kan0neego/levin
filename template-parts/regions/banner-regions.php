<?php
$h1 = get_field('h1');
?>
<div class="banner banner-regions">
    <div class="banner__content">
        <?php levin_breadcrumbs(); ?>

        <h2 class="banner__name">
            <?= $h1 ? $h1 : 'Пациентам <br>
            из других регионов'; ?>
        </h2>

        <div class="banner-page__text-box">
            <?php if ( has_excerpt() ) : ?>
            <p>
                <?php echo get_the_excerpt(); ?>
            </p>
            <?php else : ?>
            <p>
                Ежедневно к нам обращаются пациенты из городов России и Казахстана. Многие приезжают из других
                стран,
                даже несмотря на новые неудобные транзитные пути.
            </p>
            <?php endif; ?>
            <ul>
                <li>Организация приезда и лечения под ключ по комплексной программе реабилитации</li>
                <li>Проведение лечения в формате Пожизненной гарантии</li>
                <li>Бесплатное ежегодное сервисное обслуживание для пациентов</li>
            </ul>
        </div>

        <div class="banner__footer">
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

    <ul class="banner-nav">
        <li class="banner-nav__item">
            <a href="#services" class="banner-nav__link">
                Наши услуги
            </a>
        </li>
        <li class="banner-nav__item">
            <a href="#start" class="banner-nav__link">
                С чего начать
            </a>
        </li>
        <li class="banner-nav__item">
            <a href="#programs" class="banner-nav__link">
                Специальные программы
            </a>
        </li>
        <li class="banner-nav__item">
            <a href="#doctors" class="banner-nav__link">
                Команда врачей
            </a>
        </li>
        <li class="banner-nav__item">
            <a href="#reasons" class="banner-nav__link">
                Почему выбирают нас
            </a>
        </li>
    </ul>
</div>
