  <?php

    $prices_blocks = get_field('prices_blocks', get_the_ID());
    
    if( have_rows('prices_blocks', get_the_ID()) ) { ?>

  <div class="section-gray" id="price">
    <div class="page__container ">
      <h2 class="heading heading_h2 heading_border " id="price">
        <?php echo get_field('price_heading') ? get_field('price_heading') : 'Цены'; ?>
      </h2>
      <?php if ( get_field('price_desc') ) { ?>
      <p class="section__text-b">
        <?php echo get_field('price_desc'); ?>
      </p>
      <?php } ?>

      <?php
          $n=0;

          foreach( $prices_blocks as $prices_block )
          { $n++; ?>

      <div class="price <?=($n==1) ? 'price-open' : '' ?>">
        <div class="price-header">
          <?php echo get_field( 'prices_block_name', $prices_block ); ?>
        </div>
        <div class="price-wrap">

          <?php
              
              $prices_block_groups = get_field( 'prices_block_group', $prices_block );
              $num_subgroups = count($prices_block_groups);
              $i=0;

              if (have_rows('prices_block_group', $prices_block)) {

                while ( have_rows('prices_block_group', $prices_block) ) : the_row(); $i++;

                  if($num_subgroups>1)
                    echo '<div class="price-subheader">'.get_sub_field( 'prices_block_group_name' ).'</div>';

                  $price_items = get_sub_field('prices_block_subgroup_items');

                  foreach( $price_items as $price_item ):
                    // пропускаем удалённые записи
                    $item_id = is_object($price_item) ? $price_item->ID : $price_item;
                    if ( ! $item_id || get_post_status( $item_id ) !== 'publish' ) { continue; }
                  ?>
          <div class="price-item">
            <div class="price-content">
              <div class="price-name">
                <?php echo get_the_title($price_item); ?>
              </div>
              <?php if( has_excerpt($price_item) ) { ?>
              <div class="price-text">
                <?php echo get_the_excerpt( $price_item ); ?>
              </div>
              <?php } ?>
            </div>
            <div class="price-price">

              <span>
                <?php echo get_field( 'cost_value_max', $price_item ) ? '<i>от</i>' : ''; ?>
                <?php if (get_field( 'cost_value', $price_item )==0) { ?>
                Бесплатно
                <?php } else { ?>
                <?php echo number_format( get_field( 'cost_value', $price_item ), 0, '', ' ' ); ?> ₽
                <?php } ?>
              </span>
              <?php if (get_field( 'cost_date_badge', $price_item )) { ?>
              <span class="price-badge">
                <?php echo get_field('price_badge', 'option'); ?>
              </span>
              <?php } ?>
              <?php
                        if ( get_field( 'cost_value_max', $price_item ) ) { ?>
              <b>до
                <?php echo number_format( get_field( 'cost_value_max', $price_item ), 0, '', ' ' ); ?> ₽
              </b>
              <?php } ?>
            </div>
          </div>

          <?php
                  endforeach;

                endwhile;

              } ?>

        </div>
      </div>

      <?php  
            } ?>

      <a href="<?php the_permalink( 8191 ); ?>" class="b-button b-button--wide b-button--primari" style="max-width:inherit">Смотреть все цены</a>
    </div><!--/.page__container-->
  </div><!--/.section-gray-->

  <?php
    } ?>