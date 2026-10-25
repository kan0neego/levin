<div class="section-gray-light">
    <div class="page__container">
        <h2 class="heading heading_h2 heading_border" id="doctors">Команда врачей</h2>
        <div class="swiper-container swiper-doctor">
            <div class="swiper-wrapper">
                <?php 
                    
                    $cat = get_the_category( get_the_ID() );
                    $cat_id = ( ! empty( $cat ) && isset( $cat[0]->cat_ID ) ) ? (int) $cat[0]->cat_ID : 0;
                    
                    if ( $cat_id === 209 ) {

                        $query = new WP_Query( [
                            'post_type' => 'doctors',
                            'post__in' => [ 22377, 5528, 19136, 5543 ]
                        ] );

                    } elseif ( $cat_id === 85 ) {

                        $query = new WP_Query( [
                            'post_type' => 'doctors',
                            'post__in' => [ 7372, 5540, 5788 ]
                        ] );

                    } else {

                        $query = new WP_Query( [
                            'post_type' => 'doctors',
                            'p'         => 5528
                        ] );

                    }
                    
                    if ( $query->have_posts() ) { 
                        
                        while ( $query->have_posts() ) {
                        
                            $query->the_post();
                            
                            if (get_field('is_slider')) { ?>
                                
                                <div class="swiper-slide">
                                    <?php 
                                        if ( get_field('is_active') ) { ?>
                                            <a href="<?php the_permalink(); ?>" class="card card-product card_theme_black">
                                        <?php } else { ?>
                                                <div class="card card-product card_theme_black">
                                        <?php } ?>
                                                    <div class="card__image">
                                                        <img loading="lazy" src="<?php echo get_field('clipped_photo_list'); ?>" alt="">
                                                    </div>
                                                    <div class="card__wrap">
                                                        <div class="card__wrap-content">
                                                            <div class="card__name">
                                                                <?php echo str_replace(" ", "<br />", get_the_title()); ?>
                                                            </div>
                                                            <div class="card__text">
                                                                <?php echo get_the_excerpt(); ?>
                                                            </div>
                                                            <b>
                                                                Стаж
                                                                <?php $exp = date('Y')-get_field('experience'); echo num_decline($exp, 'год, года, лет'); ?>
                                                            </b>
                                                        </div>
                                                        <?php if( get_field('is_active') ) { ?>
                                                            <div class="card___button">Подробнее</div>
                                                        <?php } else { ?>
                                                            <a href="#" class="card___button" data-target="#myModal2" data-toggle="modal">Записаться</a>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if( get_field('is_active') ) { ?>
                                                    </a>
                                                    <?php } else { ?>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                        <?php }} ?>
                                    <?php }
                                    wp_reset_postdata(); ?>

<?php
if ( $cat_id !== 209 ) {

$related_doctors_spec = get_field('related_doctors_spec');

if( is_array( $related_doctors_spec ) ) :
    
    foreach ($related_doctors_spec as $id) :
        
        $query = new WP_Query( [
            'post_type'    => 'doctors',
            'post__not_in'  => array(5528),
            'tax_query' => [
                [
                    'taxonomy' => 'doctors_group',
                    'field'    => 'id',
                    'terms'    => $id,
                ]
            ],
        ] ); 

    if ( $query->have_posts() ) { 
        
        while ( $query->have_posts() ) {
            
            $query->the_post();
            
            if (get_field('is_slider')) { ?>
        
        <div class="swiper-slide">
          <?php 
          if ( get_field('is_active') ) { ?>
          <a href="<?php the_permalink(); ?>" class="card card-product card_theme_black">
            <?php } else { ?>
            <div class="card card-product card_theme_black">
              <?php } ?>
              <div class="card__image">
                <img loading="lazy" src="<?php echo get_field('clipped_photo_list'); ?>" alt="">
              </div>
              <div class="card__wrap">
                <div class="card__wrap-content">
                  <div class="card__name">
                    <?php echo str_replace(" ", "<br />", get_the_title()); ?>
                  </div>
                  <div class="card__text">
                    <?php echo get_the_excerpt(); ?>
                  </div>
                  <b>
                    Стаж
                    <?php $exp = date('Y')-get_field('experience'); echo num_decline($exp, 'год, года, лет'); ?>
                  </b>
                </div>
                <?php if( get_field('is_active') ) { ?>
                <div class="card___button">Подробнее</div>
                <?php } else { ?>
                <a href="#" class="card___button" data-target="#myModal2" data-toggle="modal">Записаться</a>
                <?php } ?>
              </div>
              <?php if( get_field('is_active') ) { ?>
          </a>
          <?php } else { ?>
        </div>
        <?php } ?>
      </div>
        <?php }} ?>
    <?php }
    wp_reset_postdata();
    endforeach;
endif;
}
?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev-n"></div>
    <div class="swiper-button-next-n"></div>
</div>