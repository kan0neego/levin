<?php $directory = get_template_directory_uri() . '/src/'; ?>

<div class="about-biocare ">
  <div class="about-biocare__header wrap">
    <h2 class="about-biocare__title">
      О Центре
    </h2>
    <picture class="about-biocare__logo picture">
      <source>
      <img src="<?php echo $directory; ?>img/biocare-logo.svg" alt="" class="picture__img">
    </picture>
  </div>
  <!-- /.about-biocare__header -->
  <div  class="about-biocare-main swiper">
    
    <div class="swiper-wrapper">
      <div class="swiper-slide about-biocare-main-slide">
        <div class="about-biocare-main-slide__video-box">
          <video poster="<?php echo $directory; ?>img/video-preview.webp" autoplay loop muted playsinline>
            <source src="<?php echo $directory; ?>video/levin-promo-desktop.webm" type="video/webm; codecs=&quot;vp8, vorbis&quot;" media="screen and (min-width : 481px)">
            <source src="<?php echo $directory; ?>video/levin-promo-mobile-800.webm" type="video/webm; codecs=&quot;vp8, vorbis&quot;" media="screen and (min-width : 320px) and (max-width : 480px)">

            <source src="<?php echo $directory; ?>video/levin-promo-desktop.mp4" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;" media="screen and (min-width : 481px)">
            <source src="<?php echo $directory; ?>video/levin-promo-mobile-800.mp4" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;" media="screen and (min-width : 320px) and (max-width : 480px)">
          </video>
        </div>
        <!-- /.about-biocare-main-slide__video-box -->
        <div class="about-biocare-main-slide__wrap wrap ">
          <div class="about-biocare-main-slide__content">
            <div class="about-biocare-main-slide__header">
              
              <h3 class="about-biocare-main-slide__title">
                Nobel Biocare
              </h3>
              <p class="about-biocare-main-slide__subtitle">
                Центр клинического мастерства
              </p>
              
            </div>
            <!-- /.about-biocare-main-slide__header -->
            <div class="about-biocare-main-slide__text-box">
              <p>
                С 2004 года ЦПС «Доктор Левин» — Центр клинического мастерства Nobel Biocare в Восточной Европе. Врачи ежегодно повышают квалификацию на базе образовательных программ компании Nobel Biocare.
              </p>
            </div>
          </div>
          <!-- /.about-biocare-main-slide__content -->
        </div>
        <!-- /.about-biocare-main-slide__wrap -->
      </div>
      <!-- /.swiper-slide about-biocare-main-slide -->
      <div class="swiper-slide about-biocare-main-slide">
        <div class="about-biocare-main-slide__video-box">
          <picture class="picture">
            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/division-banner.jpg">
            <img src="<?php echo $directory; ?>img/division-banner.jpg" alt="" class="picture__img">
          </picture>
        </div>
        <!-- /.about-biocare-main-slide__video-box -->
        <div class="about-biocare-main-slide__wrap wrap">
          <div class="about-biocare-main-slide__content">
            <div class="about-biocare-main-slide__header">
              
              <h3 class="about-biocare-main-slide__title">
                Пожизненная гарантия
              </h3>
              <p class="about-biocare-main-slide__subtitle">
                Dr. Levin LifeTime Warranty
              </p>
              
            </div>
            <!-- /.about-biocare-main-slide__header -->
            <div class="about-biocare-main-slide__text-box">
              <p>
                Знаменитая фирменная гарантия Dr. Levin LifeTime Warranty — исторически самая первая отличительная черта Центра и «первая ласточка» в становлении клиники именно такой, какой она известна сегодня.
              </p>
            </div>
          </div>
          <!-- /.about-biocare-main-slide__content -->
        </div>
        <!-- /.about-biocare-main-slide__wrap -->
      </div>
      <!-- /.swiper-slide about-biocare-main-slide -->
      <div class="swiper-slide about-biocare-main-slide">
        <div class="about-biocare-main-slide__video-box">
          <picture class="picture">
            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/division-banner-3.jpg">
            <img src="<?php echo $directory; ?>img/division-banner-3.jpg" alt="" class="picture__img">
          </picture>
        </div>
        <!-- /.about-biocare-main-slide__video-box -->
        <div class="about-biocare-main-slide__wrap wrap">
          <div class="about-biocare-main-slide__content">
            <div class="about-biocare-main-slide__header">
              
              <h3 class="about-biocare-main-slide__title">
                Индивидуальный подход
              </h3>
              <p class="about-biocare-main-slide__subtitle">
                Помощь в самых сложных случаях
              </p>
              
            </div>
            <!-- /.about-biocare-main-slide__header -->
            <div class="about-biocare-main-slide__text-box">
              <p>
                Врачи Центра имеют возможность не работать в режиме «аврала» и спешки. Наша задача — провести лечение «раз и навсегда», а не принять как можно больше пациентов.
              </p>
            </div>
          </div>
          <!-- /.about-biocare-main-slide__content -->
        </div>
        <!-- /.about-biocare-main-slide__wrap -->
      </div>
      <!-- /.swiper-slide about-biocare-main-slide -->

    </div>
    <!-- /.swiper-wrapper -->
    <div class="about-biocare-main-slide__arrows-wrap">
      <div class="slider-arrow swiper-button-prev about-biocare-main-slide__arrow about-biocare-main-slide__arrow--prev"></div>
      <div class="slider-arrow swiper-button-next about-biocare-main-slide__arrow about-biocare-main-slide__arrow--next"></div>
    </div>
    <!-- /.section-specialists__arrows-wrap -->
    <!-- Add Pagination -->
    
    <div class="about-biocare-main-slide__progress-box progress-box wrap">
      <div class="about-biocare-main-slide__pagination swiper-pagination"></div>
    </div>
    <!-- /.about-biocare-main-slide__progress-box -->

    <div class="about-biocare-list-wrap container">
      <div class="about-biocare-list swiper">
        <div class="swiper-wrapper">
          <div class="about-biocare-list-slide swiper-slide">
            <picture class="about-biocare-list-slide__picture picture">
              <source>
              <img src="<?php echo $directory; ?>img/biocare-slide-1.webp" alt="" class="picture__img">
            </picture>
            <!-- /.about-biocare-list-slide__picture -->
            <div class="about-biocare-list-slide__text-box">
              <p class="about-biocare-list-slide__title">
                Nobel Biocare
              </p>
              <p class="about-biocare-list-slide__subtitle">
                Центр клинического мастерства
              </p>
            </div>
            <!-- /.about-biocare-list-slide__text-box -->
          </div>
          <!-- /.about-biocare-list-slide -->
          <div class="about-biocare-list-slide swiper-slide">
            <picture class="about-biocare-list-slide__picture picture">
              <source>
              <img src="<?php echo $directory; ?>img/biocare-slide-2.jpg" alt="" class="picture__img">
            </picture>
            <!-- /.about-biocare-list-slide__picture -->
            <div class="about-biocare-list-slide__text-box">
              <p class="about-biocare-list-slide__title">
                Пожизненная гарантия
              </p>
              <p class="about-biocare-list-slide__subtitle">
                Dr. Levin Lifetime Warranty
              </p>
            </div>
            <!-- /.about-biocare-list-slide__text-box -->
          </div>
          <!-- /.about-biocare-list-slide -->
          <div class="about-biocare-list-slide swiper-slide">
            <picture class="about-biocare-list-slide__picture picture">
              <source>
              <img src="<?php echo $directory; ?>img/division-slide-3.jpg" alt="" class="picture__img">
            </picture>
            <!-- /.about-biocare-list-slide__picture -->
            <div class="about-biocare-list-slide__text-box">
              <p class="about-biocare-list-slide__title">
                Индивидуальный подход
              </p>
              <p class="about-biocare-list-slide__subtitle">
                к каждому пациенту
              </p>
            </div>
            <!-- /.about-biocare-list-slide__text-box -->
          </div>
          <!-- /.about-biocare-list-slide -->
        </div>
        <!-- /.swiper-wrapper -->
      </div>
      <!-- /.about-biocare-list -->
    </div>
    <!-- /.about-biocare-list-wrap -->

  </div>
  <!-- /.about-biocare-main-screen -->
</div>
<!-- /.about-biocare -->