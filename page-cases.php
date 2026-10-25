<?php
/**
 *  Template Name: Список Кейсов
 */

get_header();

$h1 = get_field('h1');
?>

<style>
    .hat {
        background-image: url(<?php echo get_template_directory_uri(); ?>/image/banner/banner-doctors.webp);
    }
</style>
<div class="page mb-5">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name">
                    <?= $h1 ? $h1 : get_the_title() ?>
                </h1>
                <?php if ( has_excerpt() ) : ?>
                <p class="banner__text">
                    <?php echo get_the_excerpt(); ?>
                </p>
                <?php endif; ?>
                <div class="banner__text-list">
                    <div class="banner__text-item">
                        <i></i>
                        <span>Врачи мирового уровня</span>
                    </div>
                    <div class="banner__text-item">
                        <i></i>
                        <span>Индивидуальный подход каждому пациенту</span>
                    </div>
                    <div class="banner__text-item">
                        <i></i>
                        <span>Помощь в сложных и нестандартных случаях</span>
                    </div>
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
    </header>

    <main class="page__container page__container-full">
        <?php $categories = get_categories_for_post_type('cases', 'category'); ?>

        <?php if ( $categories ) : ?>

        <div class="filter">
            <div class="filter__tagline">
                <div class="filter__tag tag tag_current" data-filter="*">Все работы</div>
                <?php foreach ( $categories as $cat ) : ?>
                <div class="filter__tag tag" data-filter=".<?php echo $cat->slug; ?>">
                    <?php echo $cat->name; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php endif; ?>

        <?php
        $posts_args = array(
            'post_type'      => 'cases',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );

        $query = new WP_query( $posts_args );

        if ( $query->have_posts() ) :
            ?>

        <div class="grid-list case-list filter-list">
            <?php
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $post_cats    = get_the_category();
                    $filter_class = '';
                    foreach ( $post_cats as $cats ) :
                        $filter_class .= esc_attr( $cats->slug ) . ' ';
                    endforeach;
                    ?>
            <div class="grid-list-item filter-item <?php echo esc_attr(trim($filter_class)); ?>">
                <?php get_template_part('template-parts/cards/case-card-list'); ?>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
                ?>
        </div>

        <?php endif; ?>
    </main>
</div>


<?php get_footer();
