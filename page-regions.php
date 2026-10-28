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

<section class="section-services" id="services">
    <?php get_template_part('template-parts/regions/services'); ?>
</section>

<section class="section-start-steps" id="start">
    <?php get_template_part('template-parts/regions/start-steps'); ?>
</section>

<div class="section-consul wrap">
    <?php get_template_part('template-parts/regions/consult'); ?>
</div>

<section class="section-reasons mb-0" id="reasons">
    <?php get_template_part('template-parts/regions/reasons'); ?>
</section>

<?php get_template_part('template-parts/sections/nobel'); ?>

<?php get_template_part('template-parts/sections/warranty'); ?>

<script>
    document.addEventListener(`DOMContentLoaded`, () => {
        const accordionContactsItems = document.querySelectorAll(`.contacts-accordion__item`)
        accordionContactsItems && accordionContactsHandler()

        function accordionContactsHandler() {
            accordionContactsItems.forEach((element) => {
                element.querySelector(`.contacts-accordion__header`).addEventListener(`click`, (
                    event) => {
                    event.target.closest(`.contacts-accordion__header`).classList.toggle(
                        `active`)
                    event.target.closest(`.contacts-accordion__item`).querySelector(
                        `.contacts-accordion__content`).classList.toggle(`active`)
                })
            })
        }

        const accordionPathItems = document.querySelectorAll(`.accordion-path__item`)
        accordionPathItems && accordionPathHandler(accordionPathItems)

        function accordionPathHandler(items) {
            items.forEach((element) => {
                element.querySelector(`.accordion-path__header`).addEventListener(`click`, () => {
                    element.classList.toggle(`active`)
                })
            })
        }

        const accordionItems = document.querySelectorAll(`.accordion__item`) || []
        accordionItems && accordionHandler(accordionItems)

        function accordionHandler(items) {
            items.forEach((element) => {
                element.querySelector(`.accordion__header`).addEventListener(`click`, () => {
                    element.classList.toggle(`active`)
                })
            })
        }
    })
</script>

<?php get_footer();
