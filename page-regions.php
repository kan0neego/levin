<?php
/**
 * Template Name: Страница регионов
 */

$directory = get_template_directory_uri() . '/src/';

get_header(); ?>

<style>
    .hat {
        background-image: url("<?php echo $directory; ?>img/banner-regions.webp");

        &::after {
            display: none;
        }
    }
</style>

<header class="hat">
    <?php get_template_part('template-parts/regions/banner-regions'); ?>
</header>

<section id="quotation" class="quotation">
    <?php get_template_part('template-parts/regions/quotation'); ?>
</section>

<section class="treatment-cards" id="services">
    <div class="container-2xl">
        <div class="section-header section-header--center">
            <h2 class="section-header__title">Наши услуги</h2>
            <div class="section-header__subtitle">Стоматологические программы в формате «одного дня»</div>
        </div>
        <?php get_template_part('template-parts/regions/services'); ?>
    </div>
</section>

<section class="start-cards" id="start">
    <div class="container-2xl">
        <div class="section-header section-header--center">
            <h2 class="section-header__title">С чего начать?</h2>
            <div class="section-header__subtitle">три простых шага к своей идеальной улыбке</div>
        </div>
        <?php get_template_part('template-parts/regions/start-steps'); ?>
    </div>
</section>

<section class="section-consult">
    <div class="container-2xl">
        <?php get_template_part('template-parts/regions/consult'); ?>
    </div>
</section>

<section class="transfer-programs" id="programs">
    <div class="container-2xl">
        <div class="section-header section-header--center">
            <h2 class="section-header__title">Программы трансфера, лечения и размещения</h2>
            <div class="section-header__subtitle">три простых шага к своей идеальной лыбке</div>
        </div>
        <?php get_template_part('template-parts/regions/transfer-programs'); ?>
    </div>
</section>

<section class="reasons-panel" id="reasons">
    <div class="reasons-panel__bg" aria-hidden="true">
        <span class="reasons-panel__glow reasons-panel__glow--a"></span>
        <span class="reasons-panel__glow reasons-panel__glow--b"></span>
        <img class="reasons-panel__molecule" src="<?php echo esc_url($directory . 'img/reasons-panel/molecule.webp'); ?>" alt="" width="1024" height="1024">
    </div>

    <div class="container-2xl">
        <div class="section-header section-header--center white-color">
            <h2 class="section-header__title">Почему выбирают именно нас</h2>
            <div class="section-header__subtitle">ЦПС «Доктор Левин» — уникальная клиника</div>
        </div>
        <?php get_template_part('template-parts/regions/reasons-panel'); ?>
    </div>
</section>

<section class="nobel-section" id="nobel-implant">
    <?php get_template_part('template-parts/sections/nobel'); ?>
</section>

<?php get_template_part('template-parts/sections/warranty'); ?>

<?php get_footer();
