<?php
$portfolio = isset($args['portfolio']) ? $args['portfolio'] : '';
?>
<div class="banner">
    <div class="banner__content">
        <?php levin_breadcrumbs(); ?>

        <h1 class="banner__name">
            <?php
            $title = get_field('h1') ? get_field('h1') : get_the_title();
            echo '<span>' . str_replace(' ', '</span> ', $title);
            ?>
        </h1>
        <?php
            if(is_single ('9006')) {
        ?>
        <div class="banner-doctor__badge">
            <div class="banner-doctor__badge-item nobel">
                <img src="/image/doctors/nobel-badge.svg" alt="">
                <span>Сертифицированный<br>специалист Nobel</span>
            </div>
        </div>
        <?php
            }
        ?>
        <?php
            if(is_single ('8261')) {
        ?>
        <div class="banner-doctor__badge">
            <div class="banner-doctor__badge-item inv">
                <img src="<?php echo get_template_directory_uri(); ?>/image/doctors/inv-badge.svg" alt="">
                <span>ТОП-5 экспертов<br>Invisalign в Москве</span>
            </div>
        </div>
        <?php
            }
        ?>
        <div class="banner-doctor__items">
            <div class="banner-doctor__item">
                <div class="banner-doctor__span">Специализация</div>
                <div class="banner-doctor__sub-title"><?php echo get_the_excerpt(); ?> </div>
            </div>
            <?php if( get_field( "experience" ) ): ?>

            <div class="banner-doctor__item">
                <div class="banner-doctor__span">Стаж работы</div>
                <div class="banner-doctor__sub-title">
                    <?php $exp = date('Y') - get_field('experience');
                    echo num_decline($exp, 'год, года, лет'); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <hr>
        <div class="banner__text"><?php echo get_field('banner_text'); ?></div>
        <hr>

        <ul class="banner__menu">
            <?php if( get_field( "skills" ) ): ?>
            <li class="banner__item">
                <a href="#specialty" class="banner__link"><i></i><span>Специализация</span></a>
            </li>
            <?php endif; ?>

            <?php if( get_field( "education" ) ): ?>
            <li class="banner__item">
                <a href="#education" class="banner__link"><i></i><span>Образование</span></a>
            </li>
            <?php endif; ?>

            <?php if( get_field( "certificates" ) ): ?>
            <li class="banner__item">
                <a href="#certificates" class="banner__link"><i></i><span>Сертификаты</span></a>
            </li>
            <?php endif; ?>

            <?php if( $portfolio ): ?>
            <li class="banner__item">
                <a href="#raboty" class="banner__link"><i></i><span>Фото работ</span></a>
            </li>
            <?php endif; ?>

            <li class="banner__item">
                <a href="#otzyvy" class="banner__link"><i></i><span>Отзывы</span></a>
            </li>
        </ul>

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
