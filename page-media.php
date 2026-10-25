<?php
/**
 * Template Name: СМИ
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
        background-image: url(/wp-content/uploads/2021/07/Group-12534-1.jpg);
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

                <hr />

                <div class="rating-image">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/kommersant.svg" alt="КоммерсантЪ">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/startsmile.svg" alt="Startsmile">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/maxim.svg" alt="MAXIM">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/mediametrics.svg" alt="MediaMetrics">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/cosmopolitan.svg" alt="COSMOPOLITAN">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/index/logo-list/forbes.svg" alt="Forbes">
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

    <main class=" page__container page-content">

        <?php
    $press_args = array(
                    'post_type' => 'press',
                    'post_status' => 'publish',
                    );

    $query = new WP_query($press_args);
    
    if ($query->have_posts()) {
    ?>

        <div class="media-row">

            <?php
        $i=0;
        while ($query->have_posts()) {
            $i++;
            $query->the_post();
            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
            
            // set up logo
            if (get_field('source') == 'kommersant') $logo = "kommersant.svg";
            if (get_field('source') == 'startsmile') $logo = "startsmile.svg";
            if (get_field('source') == 'mediametrics') $logo = "mediametrics.svg";
            if (get_field('source') == 'mk') $logo = "mk.svg";
            if (get_field('source') == 'kp') $logo = "kp.svg";
            if (get_field('source') == 'cosmopolitan') $logo = "cosmopolitan.svg";
            if (get_field('source') == 'maxim') $logo = "maxim.svg";
            if (get_field('source') == 'dental-magazine') $logo = "dental-magazine.svg";
            if (get_field('source') == 'planet-today') $logo = "planet-today.png";
            if (get_field('source') == 'metro') $logo = "metro.svg";
            if (get_field('source') == 'pravda') $logo = "pravda.svg";
            if (get_field('source') == 'rbc') $logo = "rbc.svg";
            if (get_field('source') == 'rbg') $logo = "rbg.png";

        ?>

            <a href="<?php echo get_field('link'); ?>" data-draggable="false" data-zoomable="false" target="_blank" rel="nofollow"
                class="media-card <?php if ($i <= 2) {
                    echo 'media-card_col';
                } ?> <?php if (get_field('is_video')) {
                    echo 'media-card-video-hover glightbox';
                } ?>"
                style="background-image: url(<?php echo $image; ?>)">

                <?php if(get_field('video_preview')) { ?>
                <video class="media-card__video gif" muted loop preload="none">
                    <source src="<?php echo get_field('video_preview'); ?>" type="video/webm">
                </video>
                <?php } ?>

                <div class="media-card__content">

                    <?php
                if (isset($logo)) { ?>

                    <div class="media-card__logo">
                        <img class="lazyload"
                            data-src="<?php echo $theme_path; ?>/src/img/index/logo-list/<?php echo $logo; ?>" alt="">
                    </div>

                    <?php
                } ?>

                    <?php
                if(get_field('is_video')) { ?>

                    <div class="media-card__play">
                        <i></i>
                    </div>

                    <?php
                } ?>

                    <?php
                if( $i<=2 ) { ?>
                    <div class="media-card__content-wrap">
                        <?php
                } ?>

                        <div class="media-card__text"><span><?php the_title(); ?></span></div>

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





        <!--
  
        <a href="https://youtu.be/iClIpZEo7_g" class="media-card media-card_col glightbox" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
          
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                    <div class="media-card__play">
                    <i></i>
                </div>

                   
                </div>
                <div class="media-card__content-wrap">
                    <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
                    <div class="media-card__text-small">Наши врачи часто выступают экспертами в ведущих СМИ, те или
иные технологии в стоматологии, передовые методики отрасли</div>
<div class="card___button">Подробнее</div>

                </div>
                
            </div>
        </a>

        <a href="#" class="media-card media-card_col" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
          
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                 

                   
                </div>
                <div class="media-card__content-wrap">
                    <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
                    <div class="media-card__text-small">Наши врачи часто выступают экспертами в ведущих СМИ, те или
иные технологии в стоматологии, передовые методики отрасли</div>
<div class="card___button">Подробнее</div>

                </div>
            </div>
        </a>


        <a href="#" class="media-card" style="background-image: url(/image/max-image.png)">
        <img src=" https://i.gifer.com/1VY8.gif" class="gif" alt="">
            <div class="media-card__content">
          
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                 

                   
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        <a href="#" class="media-card" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        <a href="#" class="media-card" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        <a href="#" class="media-card" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        <a href="#" class="media-card" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        <a  class="media-card glightbox" href="https://youtu.be/iClIpZEo7_g" style="background-image: url(/image/max-image.png)">
            <div class="media-card__content">
                <div class="media-card__logo">
                    <img src="/image/max-image.svg" alt="">
                </div>
                <div class="media-card__play">
                    <i></i>
                </div>
                <div class="media-card__text"><span>Cosmopolitan — абсолютно белоснежная улыбка</span> </div>
            </div>
        </a>
        -->




    </main>
</div>
<?php get_footer(); ?>
