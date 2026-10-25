<?php get_header(); ?>
<div class="page_rubrika">
<?php
    $queried_object = get_queried_object(); 
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;  
?>

    <header class="hat">
    <div class="page__container hat__container">

      <?php levin_breadcrumbs(); ?>
            <h1 class="hat__heading"><?php single_cat_title(); ?></h1>
            <?php if ( get_field('cat_desc', $taxonomy . '_' . $term_id) ): ?>
            <p class="hat__subheading"><?php echo get_field('cat_desc'); ?></p>
            <?php endif; ?>

      <button class="hat__button button button_white-blue" data-toggle="modal" data-target="#myModal2"><svg class="button__icon" width="12" height="14" xmlns="https://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.573 3.548L1.652 7.307l-.184 1.978 2.078-.181 3.91-3.752-1.883-1.804zM9.75 3.15L7.87 1.347l-1.36 1.304L8.39 4.455 9.75 3.15zM.762 10.69a.711.711 0 01-.557-.193.653.653 0 01-.202-.533l.264-2.792a1.3 1.3 0 01.398-.812L6.945.34c.49-.472 1.38-.449 1.896.046l1.912 1.832c.535.514.556 1.328.048 1.817l-6.281 6.02a1.4 1.4 0 01-.847.382l-2.911.253zm-.064 1.341h9.774c.384 0 .698.302.698.67 0 .368-.314.669-.698.669H.698c-.384 0-.698-.301-.698-.67 0-.367.314-.668.698-.668z"></path></svg>Записаться на приём</button>
      <button class="hat__button button button_white-blue" data-toggle="modal" data-target="#myModal2"><svg class="button__icon" width="14" height="14" xmlns="https://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.458 8.11a.779.779 0 00-.977.505c-.729 2.291-2.874 3.83-5.338 3.83-3.081 0-5.587-2.443-5.587-5.445 0-3.001 2.506-5.444 5.587-5.444a5.64 5.64 0 013.613 1.298L9.07 2.577a.77.77 0 00-.894.64.777.777 0 00.64.894l3.303.546a.798.798 0 00.394-.038c.03-.01.053-.03.08-.046.052-.026.106-.05.15-.087.028-.022.046-.055.07-.081.036-.039.075-.075.102-.122.02-.033.028-.073.043-.11.018-.046.043-.089.052-.14l.587-3.11a.778.778 0 10-1.53-.29l-.21 1.122A7.179 7.179 0 007.142 0C3.204 0 0 3.14 0 7s3.204 7 7.143 7c3.144 0 5.885-1.975 6.82-4.914a.779.779 0 00-.505-.977z"></path></svg>Обратный звонок</button>
    </div>
  </header>
    <style>
        .hat {
            background-image: url(https://doctorlevin.ru/wp-content/uploads/2016/01/bg_levin.jpg);
        }
    </style>

    <main class="page__container">
        <?php if(category_description()) {?>
            <div class="post__article article">
                <?php echo category_description(); ?>
            </div><!--post__article-->
            <div class="post-footer"></div>
        <?php }?>

        <?php wp_reset_query(); ?>

        <div class="post-footer__item post-footer__item_gray">
            <h3 class="heading heading_h3">Статьи по теме</h3>
            <div class="other-offers">
                <?php
                $category_id = get_query_var('cat');
                $category_link = get_category_link($category_id);
                $catquery = new WP_Query(array('category__in' => $category_id));
                while ($catquery->have_posts()) : $catquery->the_post();
                    ?>

                    <?php
                        if(has_post_thumbnail()) {
                            $image_id = get_post_thumbnail_id();
                            $image_url = wp_get_attachment_image_src($image_id, 'post_thumbs', true);
                            $post_image = $image_url[0];
                        } else {
                            $post_image = "/wp-content/uploads/2019/10/bg_levin_thumb.jpg";
                        }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="other-offers__card float-card">
                        <img src="<?php echo $post_image; ?>" class="float-card__image">
                        <div class="float-card__content">
                            <div class="float-card__tag"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></div>
                            <div class="float-card__text"><?php the_title(); ?></div>
                        </div>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </main><!--page__container-->


</div>
<?php get_footer(); ?>
