<?php
/*
	Шаблон Страницы (page) по умолчанию
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

$doctors = get_field('related_doctors');

$h1 = get_field('h1');
?>

<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<article class="post page <?php echo have_rows('toc_sidebar') ? 'page_sidebar' : ''; ?>">
    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>
                <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>
                <?php
            if (get_field('subtitle')): ?>
                <b class="mb-2"><?php echo get_field('subtitle'); ?></b>
                <?php
            endif;

            if (has_excerpt()) { ?>
                <p class="banner__text"><?php echo get_the_excerpt(); ?></p>
                <?php
            }

            $banner_list_items = get_field('banner_list');
        
            if(!empty($banner_list_items)) {
            ?>
                <div class="banner__text-list">
                    <?php
                foreach( $banner_list_items as $banner_list_item ) { ?>
                    <div class="banner__text-item">
                        <i></i>
                        <span><?php echo $banner_list_item['banner_list_item']; ?></span>
                    </div>
                    <?php
                } ?>
                </div>
                <?php
            } ?>
                <hr />
                <?php
            if( have_rows('toc') ): ?>
                <ul class="banner__menu">
                    <?php
                    while (have_rows('toc')):
                        the_row();
                        echo '<li class="banner__item"><a href="#' . get_sub_field('toc_anchor') . '" class="banner__link"><i></i><span>' . get_sub_field('toc_name') . '</span></a></li>';
                    endwhile; ?>
                </ul>
                <?php
            endif; ?>
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

    <main class="prose-with-sidebar">
        <div class="sidebar-r">
            <?php
        if( have_rows('toc_sidebar') ): ?>
            <div class="sidebar-r__inner">
                <div class="sidebar-r__wrap">
                    <div class="sidebar-r__title">Содержание</div>
                    <ul class="sidebar-r__list">
                        <?php
                        while ( have_rows('toc_sidebar') ) : the_row(); ?>
                        <li class="sidebar-r__list-item">
                            <a href="#<?php the_sub_field('toc_sidebar_anchor'); ?>" class="sidebar-r__link"><?php the_sub_field('toc_sidebar_name'); ?></a>
                        </li>
                        <?php
                        endwhile; ?>
                    </ul>
                </div>
            </div>
            <?php
        endif; ?>
        </div>

        <div class="prose article">

            <?php
            while (have_posts()) {
                the_post();
                the_content();
            } ?>

            <div class="author-article">
                <a href="/levin-dmitrij-valerevich/" class="author-article__left author-article__link">
                    <div class="author-article__avatar">
                        <img src="https://doctorlevin.ru/wp-content/uploads/2021/09/levin-author-avatar.png"
                            alt="">
                    </div>
                    <div class="author-article__content">
                        <div class="author-article__name">Левин Дмитрий Валерьевич</div>
                        <div class="author-article__text">Автор статьи. Челюстно-лицевой хирург, главный врач Центра
                        </div>
                    </div>
                </a>
                <div class="author-article__right">
                    <div class="author-article__text">Опубликовано: <?php echo the_date(); ?></div>
                    <div class="author-article__text">Обновлено: <?php echo get_the_modified_date(); ?></div>
                </div>
            </div>
        </div>
    </main>

    <?php get_template_part( 'template-parts/sections/nobel' ); ?>
    <?php get_template_part( 'template-parts/sections/warranty' ); ?>

	<?php if( $doctors ) : ?>

    <div class="section-gray-light">
        <div class="page__container">
            <h2 class="heading heading_h2 heading_border " id="doctors">Специалисты</h2>
            <div class="swiper-container swiper-doctor">
                <div class="swiper-wrapper">
                    <?php foreach( $doctors as $doctor ) : setup_postdata($doctor); ?>
                    <div class="swiper-slide">
                        <a href="<?php the_permalink($doctor->ID); ?>" class="card card-product card_theme_black">
                            <div class="card__image">
                                <img data-src="<?php echo get_field('clipped_photo', $doctor->ID); ?>" alt="" class="lazyload">
                            </div>
                            <div class="card__wrap">
                                <div class="card__wrap-content">
                                    <div class="card__name">
                                        <?php echo str_replace(' ', '<br />', get_the_title($doctor->ID)); ?>
                                    </div>
                                    <div class="card__text"><?php echo get_the_excerpt($doctor->ID); ?></div>
                                    <b>Стаж: <?php echo get_field('experience', $doctor->ID); ?></b>
                                </div>
                                <div class="card___button">Подробнее</div>

                            </div>
                        </a>
                    </div>

                    <?php endforeach; ?>

                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev-n"></div>
                <div class="swiper-button-next-n"></div>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

</article>

<?php
get_footer();
