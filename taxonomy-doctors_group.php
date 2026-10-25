<?php
/**
 * The template for displaying all single posts and attachments
 */
?>
<?php get_header(); ?>
<?php $term = get_queried_object();  ?>

<style>
  .hat {
    background-image: url(<?php echo get_template_directory_uri(); ?>/image/banner/banner_komanda-vrachej.jpg);
  }
</style>
<div class="page">
    <header class="hat doctor-profile__hat">
        <div class="page__container hat__container">
            <?php levin_breadcrumbs(); ?>
            <h1 class="banner__name"><?php echo $term->name; ?></h1>

            <p class="banner__text mb-0">
                Команда высококлассных специалистов, ведущих сотрудников кафедр и факультетов крупнейших медицинских вузов Москвы
            </p>        
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
    </header>

  <main class="doctor-list page__container page__container-full">   
  <div class="doctor-list__wrap">
    <div class="doctor-items doctor-list__sort_bl">
    <?php
    
        $args = array(
            'post_type' => 'doctors',
            'tax_query' => array(
                    array(
                    'taxonomy' => 'doctors_group',
                    'field' => 'term_id',
                    'terms' => $term->term_id
                )
            )
        );

        $query = new WP_Query( $args );
        $num = $query->found_posts;
        $n = 0;
        
        //$big_cards = array(1,2,6,7,8,9,10,11,12,13,14,15);
      $big_cards = array();

        while ( $query->have_posts() ) {
        
          $query->the_post();
          $doctor_id = get_the_ID();
          $n++;

          // get post category slug
          $my_terms = get_the_terms( $post->ID, 'doctors_group' );
          if( $my_terms && !is_wp_error( $my_terms ) ) {
              foreach( $my_terms as $term ) {
                  $term_id = $term->term_id;
                  $otdelenie = $term->slug;
              }
          }

          if(!in_array($n, $big_cards)) {

        /* 
          Маленькая карточка
           cat->term_id==107 - медицинский персонал
           $num - количество врачей в отделении
           $n - номер врача
        */
    ?>

    <?php if (get_field('is_show_main')) { ?>
    
      <<?php echo (get_field('is_active')) ? 'a href="'.get_permalink().'"' : 'div'; ?> class="doctor-item doctor-list__section  <?php echo $otdelenie; ?>">
        <div class="doctor-item__image">
          <img class="lazyload" data-src="<?php echo get_field('clipped_photo_list', $doctor_id); ?>" alt="<?php the_title(); ?>" >
        </div>
        <div class="doctor-item__content">
          <div class="doctor-item__header">
            <div class="doctor-item__post"><?php the_excerpt(); ?></div>
            <?php if( get_field( "experience" ) ): ?>
            <div class="doctor-item__badge">Стаж <?php echo get_field('experience'); ?></div>
            <?php endif; ?>
          </div>
          <div class="doctor-item__name"><?php the_title(); ?></div>
          
          <?php if( get_field( "short_text" ) ): ?>
          <div class="doctor-item__text"><span><?php echo get_field('short_text'); ?></span></div>
          <?php endif; ?>

          <?php if(get_field('is_active')) { ?>
          <div class="doctor-item__button-wrap">
            <div href="<?php the_permalink(); ?>" class="doctor-item__button">Подробнее о враче</div>
          </div>
          <?php } elseif($term_id != 107) { ?>
          <div class="doctor-item__button-wrap">
            <div data-toggle="modal" data-target="#myModal2" class="doctor-item__button">Записаться на прием</div>
          </div>
          <?php } ?>
        
        </div>
      </<?php echo (get_field('is_active')) ? 'a' : 'div'; ?>>

    <?php } ?>

    <?php
            } else {

        /*
          Большая карточка
          
        */
    ?>

      
      <<?php echo (get_field('is_active')) ? 'a href="'.get_permalink().'"' : 'div'; ?> class="doctor-list__section doctor-item doctor-item_primary doctor__sort-primary <?php echo $otdelenie; ?>">
        <div class="doctor-item__image">
          <img class="lazyload" data-src="<?php echo get_field('clipped_photo_list_primary', $doctor_id); ?>" alt="<?php the_title(); ?>">
          <img class="lazyload" data-src="<?php echo get_field('clipped_photo_list', $doctor_id); ?>" alt="<?php the_title(); ?>" >
        </div>
        <div class="doctor-item__content">
          
          <?php if ($doctor_id==7366 || $doctor_id==7370 || $doctor_id==7372) { ?>

          <div class="doctor-item__top">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-nobel-badge.svg" alt="">
            <span>
              Сертифицированный <br>
              специалист <b>Nobel Biocare</b>
            </span>
          </div>
          
          <?php } elseif ($doctor_id==5528) { ?>

          <div class="doctor-item__top">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-nobel-badge.svg" alt="">
            <span>
              Клинический экперт <br>
              <b>Nobel Biocare Russia</b>
            </span>
          </div>

          <?php } elseif ($doctor_id==5540) { ?>

          <div class="doctor-item__top doctor-item__top-img">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-top-badge.svg" alt="">
            <span>
              Сертифицированный<br />
              ортопед-гнатолог
            </span>
          </div>

          <?php } elseif ($doctor_id==11913) { ?>

          <div class="doctor-item__top doctor-item__top-img">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-top-badge.svg" alt="">
            <span>
              Мастер цифрового<br />
              планирования улыбки
            </span>
          </div>

          <?php } elseif ($doctor_id==5546) { ?>

          <div class="doctor-item__top doctor-item__top-img">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-top-badge.svg" alt="">
            <span>
              <b>ТОП-10 стоматологов Москвы</b><br />
              в номинации «Реставрация зубов»
            </span>
          </div>

          <?php } elseif ($doctor_id==5547) { ?>

          <div class="doctor-item__top doctor-item__top-img">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-top-badge.svg" alt="">
            <span>
              <b>ТОП-10 стоматологов Москвы</b><br />
              в номинации «Эндодонтия»
            </span>
          </div>            

          <?php } elseif ($doctor_id==8261) { ?>

          <div class="doctor-item__top">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-invisalign-badge.svg" alt="">
            <span>
              Сертифицированный<br>
              <b>специалист Invisalign®</b>
            </span>
          </div>

          <?php } elseif ($doctor_id==5788) { ?>

          <div class="doctor-item__top">
            <img src="<?php echo get_template_directory_uri(); ?>/image/banner/logo-invisalign-badge.svg" alt="">
            <span>
              Специалист Invisalign®<br>
              <b>уровня Platinum Elite II</b>
            </span>
          </div>

          <?php } ?>


          <div class="doctor-item__name"><?php the_title(); ?></div>
          <div class="doctor-item__header">
          <div class="doctor-item__post"><?php the_excerpt(); ?></div>
          <?php if( get_field( "experience" ) ): ?>
          <div class="doctor-item__badge">Стаж <?php echo get_field('experience'); ?></div>
          <?php endif; ?>
          </div>
         
          
          <?php if( get_field( "short_text" ) ): ?>
          <div class="doctor-item__text">
            <span>
            <?php echo get_field( "short_text" ); ?>
            </span>
          </div>
          <?php endif; ?>

          <?php if(get_field('is_active')) { ?>
          <div class="doctor-item__button-wrap">
            <div href="<?php the_permalink(); ?>" class="doctor-item__button">Подробнее о враче</div>
          </div>
          <?php } elseif($term_id != 107) { ?>
          <div class="doctor-item__button-wrap">
            <div data-toggle="modal" data-target="#myModal2" class="doctor-item__button">Записаться на прием</div>
          </div>
          <?php } ?>

        </div>
      </<?php echo (get_field('is_active')) ? 'a' : 'div'; ?>>

      <?php
        } // else big cards
        ?>

      <?php
      } // endforeach cards
      ?>
 
    

    <?php
    //}
    ?>
  </div> <!--/ блок карточек -->
</div> <!--/ блок отделений-->    

<!--
    <h2 class="heading heading_h2"><?php echo $cat->name; ?></h2>
    <div class="doctor-items doctor-items-black">
      <a href="#" class="doctor-item doctor-item_primary">
        <div class="doctor-item__image">
          <img src="/image/banner/doctor-item-2.png" alt="">
        </div>
        <div class="doctor-item__content">

          <div class="doctor-item__top doctor-item__top-img">

            <img src="/image/banner/logo-top-badge.svg" alt="">
            <span>
              ТОП-5 стоматологов Москвы <br />
              в номинации «Терапия»
            </span>
          </div>


          <div class="doctor-item__name">Колчин <br />
            Сергей Александрович</div>
          <div class="doctor-item__post">Челюстно-лицевой хирург</div>
          <div class="doctor-item__badge">Стаж 7 лет</div>
          <div class="doctor-item__text">
            Ювелирно лечит каналы <br>
            под микроскопом <br>
            во сне
          </div>
          <div class="doctor-item__sub-title">Ведёт приём</div>
          <div class="doctor-item__metro">
            <span></span>
            Парк Культуры
          </div>
          <div class="doctor-item__button-wrap">
            <div href="#" class="doctor-item__button">Записаться на приём</div>
          </div>
        </div>

      </a>
      <a href="#" class="doctor-item doctor-item_primary">

        <div class="doctor-item__content">
          <div class="doctor-item__top">

            <img src="/image/banner/logo-nobel-badge.svg" alt="">
            <span>
              Сертифицированный <br />
              специалист <b>Nobel</b>
            </span>
          </div>
          <div class="doctor-item__name">Колчин <br />
            Сергей Александрович</div>
          <div class="doctor-item__post">Челюстно-лицевой хирург</div>
          <div class="doctor-item__badge">Стаж 7 лет</div>
          <div class="doctor-item__text">
            Ювелирно лечит каналы <br>
            под микроскопом <br>
            во сне
          </div>
          <div class="doctor-item__sub-title">Ведёт приём</div>
          <div class="doctor-item__metro">
            <span></span>
            Парк Культуры
          </div>
          <div class="doctor-item__button-wrap">
            <div href="#" class="doctor-item__button">Записаться на приём</div>
          </div>
        </div>

      </a>


      <a href="#" class="doctor-item">
        <div class="doctor-item__image">
          <img src="<?php bloginfo('template_url'); ?>/src/img/doctor-page/doctor-item.png" alt="">
        </div>
        <div class="doctor-item__content">
          <div class="doctor-item__header">
            <div class="doctor-item__post">Челюстно-лицевой хирург</div>
            <div class="doctor-item__badge">Стаж 7 лет</div>

          </div>
          <div class="doctor-item__name">Колчин <br />
            Сергей Александрович</div>
          <div class="doctor-item__text">Спасает безнадежные зубы, приговорили и других
            клиниках текст в полные длинные две строки</div>
          <div class="doctor-item__button-wrap">
            <div href="#" class="doctor-item__button">Записаться на приём</div>
          </div>
        </div>

      </a>
      <a href="#" class="doctor-item">
        <div class="doctor-item__image">
          <img src="<?php bloginfo('template_url'); ?>/src/img/doctor-page/doctor-item.png" alt="">
        </div>
        <div class="doctor-item__content">
          <div class="doctor-item__header">
            <div class="doctor-item__post">Челюстно-лицевой хирург</div>
            <div class="doctor-item__badge">Стаж 7 лет</div>

          </div>
          <div class="doctor-item__name">Колчин <br />
            Сергей Александрович</div>
          <div class="doctor-item__text">Спасает безнадежные зубы, приговорили и других
            клиниках текст в полные длинные две строки</div>
          <div class="doctor-item__button-wrap">
            <div href="#" class="doctor-item__button">Записаться на приём</div>
          </div>
        </div>

      </a>
      <a href="#" class="doctor-item">
        <div class="doctor-item__image">
          <img src="<?php bloginfo('template_url'); ?>/src/img/doctor-page/doctor-item.png" alt="">
        </div>
        <div class="doctor-item__content">
          <div class="doctor-item__header">
            <div class="doctor-item__post">Челюстно-лицевой хирург</div>
            <div class="doctor-item__badge">Стаж 7 лет</div>
          </div>
          <div class="doctor-item__name">Колчин <br />
            Сергей Александрович</div>
          <div class="doctor-item__text">Спасает безнадежные зубы, приговорили и других
            клиниках текст в полные длинные две строки</div>
          <div class="doctor-item__button-wrap">
            <div href="#" class="doctor-item__button">Записаться на приём</div>
          </div>
        </div>

      </a>
    </div>
-->
  </main>

</div>


</div>
</div>


</div>

<?php get_footer(); ?>