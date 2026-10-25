<?php
/**
 * Template Name: Цены
 */

get_header();

$theme_path = get_stylesheet_directory_uri();
if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = home_url() . '/wp-content/uploads/2016/01/bg_levin.jpg';
}

$excerpt = get_the_excerpt();
$h1 = get_field('h1');

?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<article class="page">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>

                <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>

                <?php if (get_field('subtitle')): ?>
                <b><?php echo get_field('subtitle'); ?></b>
                <?php endif; ?>

                <?php if($excerpt) { ?>
                <p class="banner__text">
                    <?php echo $excerpt; ?>
                </p>
                <?php } ?>

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
        <div class="banner-info">
            <a href="/nomer1-v-rejtinge-id-kommersant/" class="banner-info__item">
                <i></i>
                <span>Номер 1 в рейтинге <b>ИД «КоммерсантЪ»</b></span>
            </a>
            <a href="#nobelcenter" class="banner-info__item">
                <i></i>
                <span>Центр клинического мастерства <b>Nobel Biocare</b></span>
            </a>
        </div>
    </header>
    <main class="prose-with-sidebar">
        <div class="sidebar-r">
            <div class="sidebar-r__inner">
                <div class="sidebar-r__wrap">
                    <div class="sidebar-r__title">Цены</div>
                    <ul class="sidebar-r__list">
                        <li class="sidebar-r__list-item">
                            <a href="#sedaciya" class="sidebar-r__link">Седация</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#implantologiya" class="sidebar-r__link">Имплантология</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#udalenie-implantatov" class="sidebar-r__link">Удаление имплантатов</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#osteoplastika" class="sidebar-r__link">Остеопластика</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#lechenie" class="sidebar-r__link">Лечение зубов под микроскопом</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#udalenie-zubov" class="sidebar-r__link">Удаление зубов</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#protezirovanie" class="sidebar-r__link">Несъемное протезирование</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#protezirovanie-na-implantah" class="sidebar-r__link">Протезирование на
                                имплантах</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#lor-stomatologiya" class="sidebar-r__link">ЛОР-стоматология</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#plastika-myagkih-tkaney" class="sidebar-r__link">Пластика мягких тканей</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#neyromyshechnaya-stomatologiya" class="sidebar-r__link">Нейромышечная
                                стоматология</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#parodontologiya" class="sidebar-r__link">Пародонтология</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#ortodontiya" class="sidebar-r__link">Ортодонтия</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#gigiena" class="sidebar-r__link">Гигиена и отбеливание</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#kosmetologiya" class="sidebar-r__link">Косметология</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#konsultaciya" class="sidebar-r__link">Консультация и диагностика</a>
                        </li>
                        <li class="sidebar-r__list-item">
                            <a href="#detskaya" class="sidebar-r__link">Детская стоматология</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="prose article">

            <?php
            while (have_posts()) {
                the_post();
                the_content();
            }
            ?>

        </div>
	</main>
	<?php get_template_part( 'template-parts/sections/nobel' ); ?>
	<?php get_template_part( 'template-parts/sections/warranty' ); ?>
</article>

<?php
get_footer();