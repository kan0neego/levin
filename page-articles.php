<?php
/**
 * Template Name: Статьи
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

?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<div class="page page_sidebar">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>

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
    </header>

    <main class=" page__container page-content" style="margin-bottom:60px">

        <div class="filter">
            <div class="filter__tagline">
                <div class="filter__tag tag tag_current" data-filter="*">Все статьи</div>
                <?php

      $n=0;

            $categories = get_categories( array(
                'taxonomy'  => 'category',
                'type'      => 'post',
                'include'   => array (77,82,24,20,18,22,83,66,21,3,17,19)
            ));

            foreach ( $categories as $cat ) {

        ?>

                <div class="filter__tag tag" data-filter=".<?php echo 'cat_' . $cat->category_nicename; ?>"><?php echo $cat->name; ?></div>

                <?php
            }
        ?>

            </div>
        </div>
        <!-- mobile filter -->
        <div class="position-block">
            <div class="position-block__title">Рубрики</div>
            <div class="position-block__select">
                <select class='filters-select'>
                    <option value="*">Все статьи</option>
                    <?php

    $n=0;

    $categories = get_categories( array(
      'taxonomy'     => 'doctors_group',
      'type'         => 'doctors',
      'hide_empty'   => 0,
    ));

    foreach ( $categories as $cat ) {

    ?>

                    <option value=".<?php echo 'cat_' . $cat->category_nicename; ?>"><?php echo $cat->name; ?></option>

                    <?php
        }
      ?>

                </select>
            </div>
        </div>
        <!--/mobile filter-->

        <?php
    $stickies = get_option( 'sticky_posts' );
    $press_args = array(
                    'post_type'     => 'post',
                    'post__in'      => $stickies,
                    'post_status'   => 'publish',
                    'ignore_sticky_posts' => 1
                    );

    $query = new WP_query($press_args);
    
    if ($query->have_posts()) {
    ?>

        <div class="media-row doctor-list__sort_bl">

            <?php
        $i=0;
        while ($query->have_posts()) {
            $i++;
            $query->the_post();
            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );

            $terms = get_the_terms( $post->ID , 'category');
            if($terms) {

                foreach( $terms as $term ) {
                    $cat_obj = get_term($term->term_id, 'category');
                    $cat_slug = $cat_obj->slug;
                }
            }
        ?>

            <a href="<?php echo get_permalink(); ?>" data-draggable="false" data-zoomable="false" target="_blank" rel="nofollow"
                class="media-card <?php if ($i <= 2) {
                    echo 'media-card_col';
                } ?> doctor-list__section <?php echo 'cat_' . $cat_slug; ?>"
                style="background-image: url(<?php echo $image; ?>)">


                <div class="media-card__content">

                    <?php
                if( $i<=2 ) { ?>
                    <div class="media-card__content-wrap">
                        <?php
                } ?>

                        <div class="media-card__text"><span><?php the_title() . '1' . $cat_slug; ?></span></div>

                        <?php
                if ( $i<=2 && get_the_excerpt() != "" ) { ?>

                        <div class="media-card__text-small"><span><?php echo get_the_excerpt(); ?></span></div>
                    </div>

                    <?php
                } ?>

                </div>
            </a>

            <?php
        }
    }

    wp_reset_postdata();

    ?>

        </div>

    </main>
</div>
<?php get_footer(); ?>
