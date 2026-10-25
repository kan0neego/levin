<?php

// Шорткод для специализации
function skills_function()
{

    if (get_field('skills')):
        ob_start();
    ?>
<h2 class="heading heading_h2 heading_border heading_center" id="specialty">Специализация</h2>
<ul class="list list_spaces ff-sf fw-3 list-column">
  <?php while( have_rows('skills') ): the_row(); ?>
  <li>
    <?php the_sub_field('skill_name'); ?>
  </li>
  <?php endwhile; ?>
</ul>
<?php
        return ob_get_clean();
    endif;
}
add_shortcode('skills', 'skills_function');

// Шорткод для фотографий работ
function portfolio_function()
{

    if ( is_singular( 'doctors' ) ) {

        $doctor_id = get_the_ID();
        $works_foto = get_posts(array(
                'post_type' => 'works_foto',
                'meta_query' => array(
                'post_status' => 'publish',
                  array(
                    'key' => 'doctor',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                  )
                )
              ));
    
    } else {

        $works_foto = get_field('related_portfolio');

    }
    

    if( $works_foto ):
        
        ob_start();
    
    ?>

<?php if( is_singular( 'doctors') ): ?>

<h2 class="heading heading_h2 heading_border heading_center" id="raboty">Фото до и после лечения</h2>

<?php endif; ?>

<div class="swiper-container" id="portfolio-slider">
  <div class="swiper-wrapper">

    <?php
                    foreach( $works_foto as $work_foto ):

                        $query = new WP_Query(
                            array(
                                'post_type' => 'doctors',
                                'post__in' => $work_foto->doctor
                            )
                        );
                ?>

    <div class="swiper-slide">
      <div class="portfolio-card">
        <div class="portfolio-card__image portfolio-card__image_before">
          <img class="image-blur" src="<?php echo get_field('photo_before', $work_foto->ID) ?>">
        </div>
        <div class="portfolio-card__image portfolio-card__image_after">
          <img src="<?php echo get_field('photo_after', $work_foto->ID) ?>">
        </div>
        <div class="portfolio-card__content">
          <div class="portfolio-card__name">
            <?php echo get_the_title($work_foto->ID); ?>
          </div>

          <?php if(get_field('diagnosis', $work_foto->ID)): ?>

          <div class="portfolio-card__text">
            <b>Диагноз:</b>
            <?php echo get_field('diagnosis', $work_foto->ID); ?>
          </div>

          <?php endif; ?>
          <?php if(get_field('treatment', $work_foto->ID)): ?>

          <div class="portfolio-card__text">
            <b>Лечение:</b>
            <?php echo get_field('treatment', $work_foto->ID); ?>
          </div>

          <?php endif; ?>
        </div>
        <div class="portfolio-card__footer">


          <?php if ( $query->have_posts() ) :
                                    
                                    while ( $query->have_posts() ):
                                        
                                        $query->the_post();
                            ?>

          <div class="portfolio-card__author author">
            <div class="author__portrait">
              <img src="<?php echo get_field('avatar'); ?>">
            </div>
            <div class="author__content">
              <div class="author__heading">Лечащий врач</div>
              <div class="author__name">
                <?php echo get_the_title(); ?>
              </div>
            </div>
          </div>

          <?php endwhile;

                        endif; ?>

          <?php if(get_field('period', $work_foto->ID)): ?>

          <div class="portfolio-card__author author">
            <div class="author__portrait">
              <img src="<?php echo get_template_directory_uri(); ?>/image/author-time.svg">
            </div>

            <div class="author__content">
              <div class="author__heading">Срок лечения</div>
              <div class="author__name">
                <?php echo get_field('period', $work_foto->ID); ?>
              </div>
            </div>

          </div>

          <?php endif; ?>

          <a class="portfolio-card__button button button_gradient-blue" data-toggle="modal" data-target="#myModal2"
            onclick="ym(38009025,'reachGoal','portfolio_open'); return true;">Узнать
            цену</a>
        </div>
      </div>
    </div>
    <?php
                    endforeach;
                    wp_reset_postdata();
                ?>

  </div>
  <div class="swiper-slider__pagination" id="portfolio-slider-pagination"></div>
  <div
    class="swiper-slider__button swiper-slider__button_white swiper-slider__button_left swiper-slider__button_left_inset"
    id="portfolio-slider-prev"><svg width="22" height="15" viewBox="0 0 22 15" fill="none"
      xmlns="https://www.w3.org/2000/svg">
      <path d="M21.1421 8.1428H1.14209V6.1428H21.1421V8.1428Z"></path>
      <path d="M1.41417 5.6573L8.48524 12.7284L7.07102 14.1426L-4.57764e-05 7.07151L1.41417 5.6573Z"></path>
      <path d="M8.48524 1.41466L1.41417 8.48572L-4.57764e-05 7.07151L7.07102 0.000442505L8.48524 1.41466Z"></path>
    </svg></div>
  <div
    class="swiper-slider__button swiper-slider__button_white swiper-slider__button_right swiper-slider__button_right_inset"
    id="portfolio-slider-next"><svg width="22" height="15" viewBox="0 0 22 15" fill="none"
      xmlns="https://www.w3.org/2000/svg">
      <path d="M0 5.99978H20V7.99978H0V5.99978Z"></path>
      <path d="M19.7279 8.48528L12.6569 1.41421L14.0711 0L21.1421 7.07107L19.7279 8.48528Z"></path>
      <path d="M12.6569 12.7279L19.7279 5.65685L21.1421 7.07107L14.0711 14.1421L12.6569 12.7279Z"></path>
    </svg></div>
</div>
<?php
    return ob_get_clean();
    endif; ?>
<?php
}

add_shortcode('portfolio', 'portfolio_function');

// Шорткод для специализации
function free_cons_function()
{

    $enable = true;

    ob_start();

if ( $enable ) {

    $tpl = get_field('free_cons_template');

    // По умолчанию
    $title      = 'Экспертная консультация';
    $subtitle   = 'Консультация до 4 специалистов за 1 визит в сложных или нестандартных случаях';
    $img        = '/images/bp/bozhkov-kolchin.png';
    
    if ($tpl=='default') {

        $title      = 'Экспертная консультация';
        $subtitle   = 'Консультация до 4 специалистов за 1 визит в сложных или нестандартных случаях';
        $img        = '/images/bp/bozhkov-kolchin.png';

    } elseif($tpl=='implantaciya') {
        
        $title      = 'Экспертная консультация<br><span class="light-font">по имплантации зубов</span>';
        $subtitle   = 'Консультация до 4 специалистов за 1 визит в сложных или нестандартных случаях';
        $img        = '/images/bp/bozhkov-kolchin.png';

    } elseif($tpl=='narkoz') {

        $title      = 'Экспертная консультация';
        $subtitle   = 'Консультация до 4 специалистов за 1 визит в сложных или нестандартных случаях';
        $img        = '/images/bp/zinovyev-bozhkov.png';

    } elseif($tpl=='ortodontiya') {

        $title      = 'Экспертная консультация<br><span class="light-font">стоматолога-ортодонта</span>';
        $subtitle   = 'Более 3000 успешно завершенных кейсов ортодонтического лечения на элайнерах и брекет-системах';
        $img        = '/images/bp/kuznetsov-kompaniets.png';

    } elseif($tpl=='terapiya' || $tpl=='otbelivanie') {

        $title      = 'Экспертная консультация';
        $subtitle   = 'Комплексный осмотр и консультация стоматолога терапевта-эндодонтиста';
        $img        = '/images/bp/shishov-klimova.png';

    } elseif($tpl=='chlkh') {

        $title      = 'Экспертная консультация<br><span class="light-font">челюстно-лицевого хирурга</span>';
        $subtitle   = 'Более 10.000 успешно проведенных костно-пластических операций за 20 лет'; /*"Комплексный осмотр и консультация врачей высшей категории и К.М.Н."*/
        $img        = '/images/bp/bozhkov-kolchin.png';

    } elseif($tpl=='lor') {

        $title      = 'Экспертная консультация<br><span class="light-font">челюстно-лицевого хирурга c ЛОР-подготовкой</span>';
        $subtitle   = 'Комплексный осмотр и консультация при одонтогенных ЛОР-заболеваниях';
        $img        = '/images/bp/bozhkov-kolchin.png';

    } elseif($tpl=='gnatolog') {

        $title      = 'Экспертная консультация<br><span class="light-font">стоматолога-гнатолога</span>';
        $subtitle   = 'Результативные методики лечения болей и дисфункции ВНЧС';
        $img        = '/images/bp/dementyev-kryga.png';

    } elseif($tpl=='ortoped' || $tpl=='viniry') {

        $title      = 'Экспертная консультация<br><span class="light-font">стоматолога-ортопеда</span>';
        $subtitle   = 'Исповедуем комплексный научный подход при протезировании зубов';
        $img        = '/images/bp/druzhinin-kryga.png';

    } elseif($tpl=='parodontolog') {

        $title      = 'Экспертная консультация<br><span class="light-font">пародонтолога</span>';
        $subtitle   = 'Комплексная консультация специалиста по лечению десен и сохранению зубов';
        $img        = '/images/bp/vereshagina-medvedeva.png';

    } elseif($tpl=='parodontolog-terapevt') {

        $title      = 'Экспертная консультация';
        $subtitle   = 'Консультация до 4 специалистов за 1 визит в сложных или нестандартных случаях';
        $img        = '/images/bp/bozhkov-kolchin.png';

    } elseif($tpl=='parodontolog-hirurg') {

        $title      = 'Экспертная консультация<br><span class="light-font">пародонтолога и хирурга</span>';
        $subtitle   = 'Комплексный <strong>осмотр и консультация</strong> при заболеваниях мягких тканей';
        $img        = '/images/bp/vereshagina-bozhkov.png';

    } elseif($tpl=='terapevt-hirurg') {

        $title      = 'Экспертная консультация<br><span class="light-font">терапевта и хирурга</span>';
        $subtitle   = 'Сохраняем зубы с удалением кист в сложных и нестандартных случаях';
        $img        = '/images/bp/shishov-bozhkov.png';

    } /* elseif($tpl=='detskaya') {

        $title      = 'Бесплатная</span> консультация<br><span class="light-font">терапевта и хирурга</span>';
        $subtitle   = 'Сохраняем зубы с удалением кист в сложных и нестандартных случаях';
        $img        = '/images/bp/bozhkov-druzhinin.png';

    } */ 
    if ($tpl!='empty') {
    ?>
    <!--  
    <div class="three-specialists">
        <div class="three-specialists__image-container element-animation">
            <img class="three-specialists__image" src="<?php echo $img; ?>" alt="Три специалиста">
        </div>
        <div class="three-specialists__main-container">
            <div class="three-specialists__container">
                <div class="three-specialists__content-container element-animation">
                    <div class="three-specialists__stock">Акция до 30 апреля</div>
                    <h2 class="three-specialists__title">
                        <span class="three-specialists__title-span"><?php echo $title; ?></span>
                    </h2>
                    <p class="three-specialists__subtitle">
                        <?php echo $subtitle; ?>
                    </p>
                    <div class="three-specialists__price-container">
                        <span class="three-specialists__price_after">0 ₽</span>
                        <span class="three-specialists__price_before"><span class="three-specialists__price-line">2000 ₽</span></span>
                    </div>
                    <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2">
                        <i class="b-icon b-icon--edit"></i>
                        Записаться на приём
                    </a>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- 
            Доп стили:
            two-doctors
            single-doctor 
            Название картинок:
            1-doc.png
            2-doc.png
            3-doc.png
            -->

<div class="doctors-advice bn">
    <div class="doctors-advice__container">
        <img class="doctors-advice__image two-doctors" src="<?php echo $img; ?>" alt="" loading="lazy">
            <div class="doctors-advice__text-container">
                <?php if( get_field('offer_badge_month','option') ) : ?>
                    <div class="doctors-advice__text-date">
                        <span>
                            <?php the_field('offer_badge_month','option'); ?>
                        </span>
                    </div>
                <?php endif; ?>
            <h2><?php echo $title; ?></h2>
            <p>
                <?php echo $subtitle; ?>
            </p>
            <p>
                <span style="font-size:16px">*Действует в клинике на Университете</span>
            </p>
            <div class="doctors-advice__price-container">
                <div class="doctors-advice__price-after">
                    <span>0 ₽</span>
                </div>
                <div class="doctors-advice__price-before">
                    <span>3 000 ₽</span>
                </div>
            </div>
            <a class="b-button b-button--primari bn__button" data-toggle="modal" data-target="#myModal2">
                <i class="b-icon b-icon--edit"></i>
                Записаться на приём
            </a>
        </div>
    </div>
</div>

<?php
        }
    }
        return ob_get_clean();
    }
add_shortcode('free_cons', 'free_cons_function');

/**
 * Замена Contact Form 7 — кастомные формы без зависимости от плагина.
 * Подключается после CF7 (приоритет 20) и перезаписывает его шорткод.
 * После деактивации CF7 работает автономно.
 * Файлы modal-*.php не изменяются.
 */
add_action( 'init', function () {
    remove_shortcode( 'contact-form-7' );
    add_shortcode( 'contact-form-7', 'custom_cf7_replacement' );
}, 20 );

function custom_cf7_replacement( $atts ) {
    $atts = shortcode_atts(
        array(
            'id'         => 0,
            'html_class' => '',
            'html_id'    => '',
        ),
        $atts
    );

    $id         = trim( $atts['id'] ); // оставляем строкой — prod использует slug-ID
    $html_class = $atts['html_class'] ? ' ' . esc_attr( $atts['html_class'] ) : '';
    $html_id    = $atts['html_id'] ? $atts['html_id'] : '';

    switch ( $id ) {
        case '7261':  // Запись на консультацию
            return custom_cf7_consultation( $html_class, $html_id );
        case '20268': // Служба контроля качества (local)
        case '22898': // Служба контроля качества (local alt)
        case 'cfc933a': // Служба контроля качества (prod)
            return custom_cf7_skk();
        case '20968': // Задать вопрос
            return custom_cf7_question();
        case '249':   // Написать директору
        case '20277': // Написать директору — страница отзыва (/f/, template-parts/feedback/feedback.php)
        case '20502': // Написать директору — страница СКК (/skk/, page-skk.php)
            return custom_cf7_director();
        default:
            return '';
    }
}

function custom_cf7_consultation( $extra_class = '', $form_id = 'form-consultation' ) {
    if ( ! $form_id ) $form_id = 'form-consultation';
    ob_start(); ?>
<div class="wpcf7">
    <form class="wpcf7-form init<?php echo $extra_class; ?> form-data"
          id="<?php echo esc_attr( $form_id ); ?>"
          data-form-type="consultation"
          novalidate>
        <input type="text" name="levin_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px">
        <div class="form-group">
            <span class="wpcf7-form-control-wrap" data-name="callback_form_phone">
                <input type="tel" name="phone"
                       class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required form-control-n__input input"
                       aria-required="true"
                       placeholder="+7 (___) ___-__-__"
                       autocomplete="tel">
            </span>
        </div>
        <div class="form-group">
            <button class="callback-form__submit" type="submit">
                <i class="icon-pen"></i>Записаться на прием
            </button>
        </div>
        <div class="call-block__agreement">
            <div class="checkbox-input call-block__checkbox-input">
                <span><span class="wpcf7-list-item">
                    <label>
                        <input type="checkbox" name="acceptance" value="1" checked
                               class="checkbox-input__input"
                               id="acceptance-<?php echo esc_attr( $form_id ); ?>">
                        <span class="checkbox-input__visual"></span>
                    </label>
                </span></span>
            </div>
            <label for="acceptance-<?php echo esc_attr( $form_id ); ?>" class="call-block__privacy">
                Я согласен на обработку моих <a href="https://doctorlevin.ru/obrabotka-dannih.pdf">персональных данных</a> (в соответствии с Федеральным законом №152-ФЗ «О персональных данных»)
            </label>
        </div>
    </form>
</div>
    <?php return ob_get_clean();
}

function custom_cf7_skk() {
    ob_start(); ?>
<div class="wpcf7">
    <form class="wpcf7-form init form-data"
          id="form-skk"
          data-form-type="skk"
          novalidate>
        <input type="text" name="levin_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px">
        <div class="form-fields">
            <div class="form-control-n__fields">
                <div class="form-control-n__wrapper">
                    <span class="wpcf7-form-control-wrap" data-name="person-name">
                        <input type="text" name="person-name"
                               class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control-n__input input"
                               aria-required="true"
                               placeholder="Имя"
                               required>
                    </span>
                </div>
                <div class="form-control-n__wrapper">
                    <span class="wpcf7-form-control-wrap" data-name="person-email">
                        <input type="email" name="person-email"
                               class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required form-control-n__input input"
                               aria-required="true"
                               placeholder="Email"
                               required>
                    </span>
                </div>
                <div class="form-control-n__wrapper">
                    <span class="wpcf7-form-control-wrap" data-name="person-phone">
                        <input type="tel" name="person-phone"
                               class="wpcf7-form-control wpcf7-tel form-control-n__input input"
                               placeholder="Телефон"
                               autocomplete="tel">
                    </span>
                </div>
                <div class="form-control-n__wrapper form-control-n__wrapper--textarea">
                    <span class="wpcf7-form-control-wrap" data-name="person-comment">
                        <textarea name="person-comment"
                                  class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control-n__input form-control-n__textarea"
                                  aria-required="true"
                                  placeholder="Комментарий"
                                  required></textarea>
                    </span>
                </div>
            </div>
            <div class="form-control-n__footer">
                <button type="submit" class="form-control-n__btn btn-n btn-n--blue">Отправить</button>
                <div class="form-control-n__phone-box">
                    <p class="form-control-n__phone-title">Директор отдела контроля качества</p>
                    <a href="tel:+74953202147" class="form-control-n__phone">+7 495 320-21-47</a>
                </div>
            </div>
        </div>
        <div class="form-success" style="display:none;">
            <p>Спасибо за обращение! Мы обязательно рассмотрим Ваш вопрос.</p>
        </div>
    </form>
</div>
    <?php return ob_get_clean();
}

// Задать вопрос (id=20968) — без телефона
function custom_cf7_question() {
    ob_start(); ?>
<div class="wpcf7">
    <form class="wpcf7-form init form-data"
          id="form-question"
          data-form-type="question"
          novalidate>
        <input type="text" name="levin_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px">
        <div class="form-fields">
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="text-273">
                    <input type="text" name="text-273"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                           aria-required="true"
                           placeholder="Ваше имя"
                           required>
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="email-299">
                    <input type="email" name="email-299"
                           class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required form-control"
                           aria-required="true"
                           placeholder="Ваш e-mail"
                           required>
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="textarea-438">
                    <textarea name="textarea-438"
                              class="wpcf7-form-control wpcf7-textarea form-control"
                              placeholder="Текст сообщения"></textarea>
                </span>
            </div>
            <div class="form-group">
                <label for="acceptance-question" style="font-size:12px;">
                    <input class="wpcf7-form-control-wrap" type="checkbox" name="acceptance" value="1" checked
                           id="acceptance-question">
                    Я согласен на обработку моих <a href="https://doctorlevin.ru/obrabotka-dannih.pdf" target="_blank">персональных данных</a> (в соответствии с Федеральным законом №152-ФЗ «О персональных данных»)
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control-n__btn btn-n btn-n--blue">Отправить</button>
            </div>
        </div>
        <div class="form-success" style="display:none;">
            <p>Спасибо! Мы ответим в ближайшее время.</p>
        </div>
    </form>
</div>
    <?php return ob_get_clean();
}

// Написать директору (id=249) — с телефоном (необязательным) и обязательным сообщением
function custom_cf7_director() {
    ob_start(); ?>
<div class="wpcf7">
    <form class="wpcf7-form init form-data"
          id="form-director"
          data-form-type="director"
          novalidate>
        <input type="text" name="levin_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;top:-9999px">
        <div class="form-fields">
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="text-273">
                    <input type="text" name="text-273"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                           aria-required="true"
                           placeholder="Ваше имя"
                           required>
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="email-299">
                    <input type="email" name="email-299"
                           class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required form-control"
                           aria-required="true"
                           placeholder="Ваш e-mail"
                           required>
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="tel-993">
                    <input type="tel" name="tel-993"
                           class="wpcf7-form-control wpcf7-tel form-control"
                           placeholder="Ваш телефон"
                           autocomplete="tel">
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="textarea-438">
                    <textarea name="textarea-438"
                              class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control"
                              aria-required="true"
                              placeholder="Текст сообщения"
                              required></textarea>
                </span>
            </div>
            <div class="form-group">
                <label for="acceptance-director" style="font-size:12px;">
                    <input type="checkbox" name="acceptance" value="1" checked
                           id="acceptance-director">
                    Я согласен на обработку моих <a href="https://doctorlevin.ru/obrabotka-dannih.pdf" target="_blank">персональных данных</a> (в соответствии с Федеральным законом №152-ФЗ «О персональных данных»)
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control-n__btn btn-n btn-n--blue">Отправить</button>
            </div>
        </div>
        <div class="form-success" style="display:none;">
            <p>Спасибо! Мы ответим в ближайшее время.</p>
        </div>
    </form>
</div>
    <?php return ob_get_clean();
}