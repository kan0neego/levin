<?php
/**
 *  Template Name: Список Врачей
 */

get_header();

$h1 = get_field('h1');
?>

<style>
    .hat {
        background-image: url(<?php echo get_template_directory_uri(); ?>/image/banner/banner-doctors.webp);
    }
</style>
<div class="page">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name">
                    <?= $h1 ? $h1 : get_the_title() ?>
                </h1>
                <?php if( has_excerpt() ) : ?>
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

    <main class="doctor-list page__container page__container-full">
        <div class="filter">
            <div class="filter__tagline">
                <div class="filter__tag tag tag_current" data-filter="*">Все врачи</div>
                <?php
                
                $categories = get_categories([
                    'taxonomy' => 'doctors_group',
                    'type' => 'doctors',
                    'hide_empty' => 1,
                ]);
                ?>

                <?php foreach( $categories as $cat ) : ?>

                <?php if( $cat->term_id != 210 ) : ?>

                <div class="filter__tag tag" data-filter=".<?php echo $cat->category_nicename; ?>"><?php echo $cat->name; ?></div>

                <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>
        <div class="position-block">
            <div class="position-block__title">Специализация</div>
            <div class="position-block__select">
                <select class='filters-select'>
                    <option value="*">Все врачи</option>
                    <?php
                    /* TODO: убрать дублирование мобильного селекта */
                    
                    $categories = get_categories([
                        'taxonomy' => 'doctors_group',
                        'type' => 'doctors',
                        'hide_empty' => 1,
                    ]);
                    ?>
                    <?php foreach( $categories as $cat ) : ?>
                    <?php if( $cat->term_id != 210 ) : ?>
                    <option value=".<?php echo $cat->category_nicename; ?>"><?php echo $cat->name; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="doctor-list__wrap">
            <div class="doctor-items doctor-list__sort_bl">
                <?php
                $args = array(
                    'post_type' => 'doctors',
                    'post_status'   => 'publish',
                    'posts_per_page' => -1
                );

                $query = new WP_Query( $args );

                while( $query->have_posts() ) : $query->the_post(); ?>

                <?php
                $doctorId = get_the_ID();
                $terms = get_the_terms($doctorId, 'doctors_group');
                $filter_class = '';
                if ($terms && !is_wp_error($terms)):
                    $slugs = wp_list_pluck($terms, 'slug');
                    $filter_class = implode(' ', $slugs);
                endif;
                ?>

                <?php get_template_part('template-parts/cards/doctor-card-list', null, ['doctor_id' => $doctorId, 'class' => 'filter-card ' . $filter_class]); ?>

                <?php endwhile; ?>
            </div>
        </div>
    </main>
</div>
</div><!--upper markup-->
</div>
</div>

<?php get_footer();
