<?php
/*
Template Name: Список услуг
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

$h1 = get_field('h1');
?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<header class="hat">
    <div class="banner">
        <div class="banner__content">
            <?php levin_breadcrumbs(); ?>
            <h1 class="banner__name">
                <?= $h1 ? $h1 : get_the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
            <p class="banner__text">
                <?php echo get_the_excerpt(); ?>
            </p>
            <?php endif; ?>
            <hr />
            <ul class="banner__menu">
                <li class="banner__item">
                    <a href="#implantologiya" class="banner__link"><i></i><span>Имплантология</span></a>
                </li>
                <li class="banner__item">
                    <a href="#chlkh" class="banner__link"><i></i><span>Хирургия и ЧЛХ</span></a>
                </li>
                <li class="banner__item">
                    <a href="#protezirovanie-na-implantah" class="banner__link"><i></i><span>Протезы на
                            имплантах</span></a>
                </li>
                <li class="banner__item">
                    <a href="#ortopediya" class="banner__link"><i></i><span>Ортопедия</span></a>
                </li>
                <li class="banner__item">
                    <a href="#lor" class="banner__link"><i></i><span>ЛОР-стоматология</span></a>
                </li>
                <li class="banner__item">
                    <a href="#terapiya" class="banner__link"><i></i><span>Терапия</span></a>
                </li>
                <li class="banner__item">
                    <a href="#endodontiya" class="banner__link"><i></i><span>Эндодонтия</span></a>
                </li>
                <li class="banner__item">
                    <a href="#ortodontiya" class="banner__link"><i></i><span>Ортодонтия</span></a>
                </li>
                <li class="banner__item">
                    <a href="#gigena-i-otbelivanie" class="banner__link"><i></i><span>Гигиена и отбеливание</span></a>
                </li>
                <li class="banner__item">
                    <a href="#parodontologiya" class="banner__link"><i></i><span>Пародонтология</span></a>
                </li>
                <li class="banner__item">
                    <a href="#kosmetologiya" class="banner__link"><i></i><span>Косметология</span></a>
                </li>
                <li class="banner__item">
                    <a href="#kids" class="banner__link"><i></i><span>Детская стоматология</span></a>
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
</header>

<div class="section section-advantages pt-0">

    <div class="section-advantages__wrap section-advantages-full section-advantages__wrap_page">
        <?php
        if( have_rows('service_item') ):
            $i=0;
            while( have_rows('service_item') ) : the_row(); ?>

        <div id="<?php echo get_sub_field('service_anchor'); ?>" class="section-advantages__item section-advantages__page lazyload-bg"
            data-bg="<?php echo get_sub_field('service_img'); ?>">
            <div class="section-advantages__name">
                <?php echo get_sub_field('service_title'); ?>
            </div>
            <div class="section-advantages__text mb-4">
                <?php echo get_sub_field('service_desc'); ?>
            </div>

            <?php
                    $links_objects = get_sub_field('service_links');
                    $count =  $links_objects ? count($links_objects) : FALSE;
                    
                    if( have_rows('service_links') ): ?>

            <?php
                            // Set up array with link groups
                            
                            $groud_id = 0;
                            $links_groups = array();
                            $new_array = array();

                            while( have_rows('service_links') ) : the_row();

                                if (get_sub_field('service_item_link') == false) {

                                    // New group

                                    $group_id = $i++;
                                    $links_groups[$group_id] = array( "group_name" => get_sub_field('service_item_text') );

                                } else {

                                    // New link in group
                                    $links_groups[$group_id]["group_links"][] = array( "name" => get_sub_field('service_item_text'), "link" => get_sub_field('service_item_link') );

                                }

                            endwhile;

                            /*
                                $links_groups - массив ссылок на элементы услуг
                                
                            */

                            foreach($links_groups as $key => $value) {
                                
                                $num_links = 0; 
                                if(isset($links_groups[$key]['group_links']))
                                $num_links = count((array)$links_groups[$key]['group_links']);
                                
                            ?>

            <?php
                                if(isset($links_groups[$key]['group_name'])): ?>
            <h3><?php echo $links_groups[$key]['group_name']; ?></h3>
            <?php
                                endif; ?>
            <ul class="section__menu <?php if ($count > 6) {
                echo 'section__menu_column';
            } ?>">

                <?php
                                    for ($n=0; $n<$num_links; $n++) {
                                    ?>

                <li class="section__menu-item">
                    <a class="section__menu-link text-white" href="<?php echo $links_groups[$key]['group_links'][$n]['link']; ?>">
                        <i></i>
                        <span>
                            <span class="section-text-item">
                                <?php echo @$links_groups[$key]['group_links'][$n]['name']; ?>
                            </span>
                        </span>
                    </a>
                </li>

                <?php
                                    }
                                    ?>
            </ul>
            <?php
                            }

                        ?>

            <?php
                    endif; ?>

            <?php
                    if(get_sub_field('has_button')):
                        $button = get_sub_field('button_options');
                    ?>

            <a href="<?php echo $button['button_link']; ?>"
                class="section-advantages__button info-slider__button   b-button  b-button--outline ">
                <span><?php echo $button['button_text']; ?></span>
            </a>

            <?php
                    endif; ?>

        </div>

        <?php    
            endwhile;
        endif;
        ?>

    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/src/js/index-main.js"
    id="sticky-js"></script>

<?php get_footer(); ?>
<!-- Здесь html/php код шаблона -->
