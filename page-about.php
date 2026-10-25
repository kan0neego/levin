<?php
/**
 * Template Name: О центре
 */

get_header();

$theme_path = get_stylesheet_directory_uri();
if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail-size', true);
    $header_image = $image_url[0];
} else {
    $header_image = home_url() . '/wp-content/uploads/2016/01/bg_levin.jpg';
}

$excerpt = get_the_excerpt();
$h1 = get_field('h1');

?>
<style>
    .hat {
        background-image: url(<?php echo $header_image; ?>);
    }
</style>

<article class="post page">

    <header class="hat">
        <div class="banner">
            <div class="banner__content">
                <?php levin_breadcrumbs(); ?>

                <h1 class="banner__name"><?= $h1 ? $h1 : get_the_title(); ?></h1>

                <?php if (get_field('subtitle')): ?>
                <b><?php echo get_field('subtitle'); ?></b>
                <?php endif; ?>

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
        <div class="banner-info">
            <a href="/nomer1-v-rejtinge-id-kommersant/" class="banner-info__item">
                <i></i>
                <span>Номер 1 в рейтинге <b>ИД «КоммерсантЪ»</b></span>
            </a>
            <a href="#nobelcenter" class="banner-info__item">
                <i></i>
                <span>Центр клинического мастерства <b>Nobel Biocare</b></span>
            </a>
        </div>
    </header>
    <div class="section quote-section quote-section_theme_light" id="indexTwoScreen">
        <div class="page__container_index page__container_full page__container_full quote-section__wrap mt-0">
            <div class="quote-section__col ">
                <div class="quote-section__block">
                    <h2 class="quote-section__name section__head">
                        Предоставляем пациентам — <br />
                        <b>кастомизированную <br />
                            персональную помощь</b>
                    </h2>
                    <div class="quote-section__text section__text fw-3">
                        Врачи Центра имеют возможность не работать в режиме «аврала» и спешки. Наша задача — провести
                        лечение «раз и
                        навсегда», а не принять как можно больше пациентов.
                    </div>
                    <div class="quote-section__author">
                        <div class="quote-section__author-name">
                            Левин Дмитрий Валерьевич
                        </div>
                        <div class="quote-section__author-text ff-sf">Главный врач и основатель ЦПС «Доктор Левин»</div>
                    </div>
                </div>
            </div>
            <div class="quote-section__wrap">
                <img src="<?php bloginfo('template_url'); ?>/src/img/index/quote-levin-new.png" alt="">
            </div>
        </div>
    </div>

    <div class="section section-card-list ">
        <div class="page__container_index page__container_full page__container_full ">
            <div class="row row_flex mb-0">
                <div class="col-sm-6  col-md-4">
                    <div class="card card-new">
                        <div class="card-body">
                            <div class="card-name">Dr. Levin LifeTime Warranty</div>
                            <div class="card-text">Наш Центр предоставляет эксклюзивную гарантию совместно с Nobel
                                Biocare и Straumann Group</div>
                            <ul class="card-list">
                                <li>Пожизненная гарантия на имплантацию</li>
                                <li>Гарантия на коронки и виниры 25 лет</li>
                                <li>Пожизненная гарантия на эндодонтическое лечение</li>
                            </ul>
                        </div>
                        <a href="#" class="card__button">
                            Подробнее
                        </a>
                        <img class="image" src="<?php bloginfo('template_url'); ?>/src/img/card-about-1.png" alt="">
                    </div>
                </div>
                <div class="col-sm-6  col-md-4">
                    <div class="card card-new">
                        <div class="card-body">
                            <div class="card-name">Технологии и инновации</div>
                            <div class="card-text">Используем самые современные технологии цифровой стоматологии</div>
                            <ul class="card-list">
                                <li>Дентальный томограф Sirona Galileos (Германия) с ЛОР-режимом</li>
                                <li>Ультразвуковая хирургическая система c оптикой NSK VarioSurg 3</li>
                                <li>Операции проводятся под оптическим увеличением микроскопа Seiler</li>
                            </ul>
                        </div>
                        <a href="#" class="card__button">
                            Подробнее
                        </a>
                        <img class="image" src="<?php bloginfo('template_url'); ?>/src/img/card-about-2.png" alt="">
                    </div>
                </div>
                <div class="col-sm-6  col-md-4">
                    <div class="card card-new">
                        <div class="card-body">
                            <div class="card-name">Награды и достижения</div>
                            <div class="card-text">Лучшая стоматологическая клиника России по версии Всероссийского
                                рейтинга Startsmile при поддержке ИД КоммерсантЪ</div>
                            <ul class="card-list">
                                <li>1 место в рейтинге КоммерсантЪ</li>
                                <li>Лауреат премии Хрустальный Лотос</li>
                                <li>Центр клинического мастерства Nobel Biocare в Восточной Европе с 2004 года</li>
                            </ul>
                        </div>
                        <a href="#" class="card__button">
                            Подробнее
                        </a>
                        <img class="image" src="<?php bloginfo('template_url'); ?>/src/img/card-about-3.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-card-about cards-about pt-0">
        <div class="page__container_index page__container_full page__container_full">
            <div class="cards-about__wrap">
                <div class="card-about">
                    <div class="card-about__content">
                        <div class="card-about__title">№1</div>
                        <div class="card-about__text">в рейтинге «КоммерсантЪ»
                            в 2022 году</div>
                    </div>
                    <div class="card-about__image">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/svg/card-about-1.svg" alt="">
                    </div>
                </div>
                <div class="card-about">
                    <div class="card-about__content">
                        <div class="card-about__title">4.9</div>
                        <div class="card-about__text">средняя оценка
                            на независимых площадках</div>
                    </div>
                    <div class="card-about__image">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/svg/card-about-2.svg" alt="">
                    </div>
                </div>
                <div class="card-about">
                    <div class="card-about__content">
                        <div class="card-about__title">19 лет</div>
                        <div class="card-about__text">клиника работает
                            с 2003 года
                            в 2022 году</div>
                    </div>
                    <div class="card-about__image">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/svg/card-about-3.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--1-->
    <!--
  <div class="section section-about section-about_black">
    <div class="page__container page__container_index page__container_full section-about__container">
      <div class="section-about__col">
        <div class="section-about__text">
          В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного
          исполнения, начиная от анестезиологической медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы.
        </div>
        <ul class="list">
          <li>Требования к специалистам нашего Центра максимально
            строгие — опыт от 10 лет, подтвержденные мануальные </li>
          <li>Теоретические знания, в том числе по смежным направлениям</li>
          <li>Не берем студентов, врачей по объявлению, только
            по рекомендации</li>
        </ul>
        <a href="#" class="section-about__button ">
          Подробнее
        </a>
      </div>
      <div class="section-about__info">
        <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-1.png" alt=""
          class="section-about__num">
        <div class="section-about__title">
          <span>Клиника</span>
          <br>не работает
          <br>«на потоке»
        </div>
      </div>
    </div>
  </div>
  -->
    <!--/1-->
    <!--1-->
    <div class="section section-about section-about_black">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    В Центре проводятся уникальные в России операции, требующие ювелирного планирования и
                    безукоризненного
                    исполнения, начиная от анестезиологической медсестры, заканчивая стоматологом-ортопедом, фиксирующим
                    протезы.
                </div>
                <p>
                    Например, за 5-часовую операцию в седации гигиенист проводит комплексную предоперационную гигиену,
                    стоматолог-терапевт лечит кариес на 2 зубах и каналы еще на 2 зубах, причем с применением
                    дентального
                    микроскопа, хирург проводит удаление всех 4 зубов мудрости и устанавливает 2 имплантата, а ортопед
                    фиксирует
                    временные мостовидные конструкции. Со всей России приезжают пациенты с экстремальными атрофиями
                    костной ткани
                    и пограничными случаями, требующими нестандартного подхода, например ЛОР-стоматология. Врачи Центра
                    имеют
                    возможность не работать в режиме «аврала» и спешки. Наша задача — провести лечение «раз и навсегда»,
                    но не
                    принять как можно больше пациентов.
                </p>
                <a href="#" class="section-about__button ">
                    Подробнее
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-1.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Клиника</span>
                    <br>не работает
                    <br>«на потоке»
                </div>
            </div>
        </div>
    </div>
    <!--/1-->

    <!--2-->
    <div class="section section-about">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    Знаменитая фирменная гарантия Dr. Levin LifeTime Warranty — исторически самая первая отличительная
                    черта
                    Центра и «первая ласточка» в становлении клиники именно такой, какой она известна сегодня.
                </div>
                <ul class="list">
                    <li>Требования к специалистам нашего Центра максимально
                        строгие — опыт от 10 лет, подтвержденные мануальные навыки</li>
                    <li>Теоретические знания, в том числе по смежным направлениям</li>
                    <li>Не берем студентов, врачей по объявлению, только
                        по рекомендации</li>
                </ul>
                <a href="/garantija-na-implantaciju-zubov/" class="section-about__button section-button">
                    Подробнее о гарантии
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-2.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Пожизненная<br>
                        гарантия</span> Dr. Levin<br>
                    Lifetime Warranty
                </div>
            </div>
        </div>
    </div>
    <!--/2-->
    <!--3-->
    <div class="section section-about section-about_black">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    С целью обеспечения максимального комфорта лечебный процесс планируется таким образом, чтобы после
                    хирургического вмешательства пациент покинул стены клиники с временной ортопедической конструкций,
                    замещающей
                    косметический дефект.
                </div>
                <p>
                    Интернет пестрит лозунгами «зубы за 1 день!», при этом, фактически, протез устанавливается, в лучшем
                    случае,
                    на 3-ий день, а чаще даже на 7-10 день. При полном отсутствии зубов сложно недооценить уровень
                    дискомфорта,
                    который доставляет ожидание. Для решения задачи установки протеза день-в-день в 2010 году мы
                    сформировали
                    собственную зуботехническую лабораторию, на организацию безошибочной работы которой потратили
                    несколько лет.
                    Лаборатория компьютеризирована на 100% и выпускает протезы с точностью до нескольких микронов.
                    Применяем только классические протоколы цифрового планирования и немедленной нагрузки компаний Nobel
                    Biocare и Straumann Group. К сожалению, практика 20-летней работы показала, что только имплантаты
                    Nobel (США) и Straumann (Швейцария), установленные в точном соответствии с цифровым планом, не дают
                    «осечек», в отличие от корейских и даже немецких производителей.
                </p>
                <a href="#" class="section-about__button ">
                    Подробнее
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-3.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Зубы</span>
                    <br>в тот же день
                </div>
            </div>
        </div>
    </div>
    <!--/3-->
    <!--4-->
    <div class="section section-about">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    Фундаментальный принцип лечения в нашем Центре — максимальный объем лечения в минимально допустимые
                    сроки.
                    Лечебный процесс организован из соображений оптимизации количества посещений.
                </div>
                <p>
                    «Боль» большинства наших пациентов — нехватка времени. Банально некогда заниматься собственным
                    здоровьем. При
                    наличии большого желания, просто нет возможности запускать «стоматологический сериал» в «четыре
                    сезона» и
                    посещать клинику несколько раз в неделю месяцами. Секрет заключается в длительном, скрупулезном и
                    ювелирном
                    цифровом планировании в течение нескольких недель. На потоке подобные операции планировать просто
                    невозможно.
                    70% операций проводятся врачами в 4 руки, подключается до 6 врачей в рамках 1 операционного дня.
                    Срок лечения
                    сокращается на 6-12 месяцев.
                </p>
                <a href="#" class="section-about__button section-button">
                    Подробнее
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-4.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Максимум<br>
                        лечения</span><br>
                    за 1 визит
                </div>
            </div>
        </div>
    </div>
    <!--/4-->
    <!--5-->
    <div class="section section-about section-about_black">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    Почему одни клиники закрываются через год, а другие лечат людей десятилетиями? Отличительная
                    особенность всех
                    приличных медицинских учреждений — выверенная, автоматизированная, не допускающая ошибок система
                    контроля
                    качества лечебного процесса.
                </div>
                <p>
                    Реализовать амбициозную цель оказания стоматологической помощи в формате бессрочных гарантий было бы
                    попросту
                    невозможно без организации контроля каждого этапа лечения. На ежедневной основе в нашем Центре
                    проверяются:
                    планы лечения, рентгеновские снимки до и после любого вмешательства, результаты фотофиксации (в том
                    числе при
                    ортодонтическом лечении) и многое другое, вплоть до результатов кардиомониторирования в процессе
                    лечения в
                    седации. Ответственные лица: Левин Дмитрий Валерьевич, главный врач и медицинский директор Центра и
                    ведущие
                    стоматологи-ортопеды, планирующие лечение и отвечающие за получение конечного результата — красивые
                    зубы с
                    пожизненным сроком службы.
                </p>
                <a href="#" class="section-about__button ">
                    Подробнее
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-5.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Медицинский</span><br>
                    контроль
                </div>
            </div>
        </div>
    </div>
    <!--/5-->
    <!--6-->
    <div class="section section-about">
        <div class="page__container page__container_index page__container_full section-about__container">
            <div class="section-about__col">
                <div class="section-about__text">
                    В Центре применяются только классические протоколы лечения, гарантирующие стабильные долгосрочные
                    результаты.
                    Никакой экспериментальной медицины. Мы не имеем права рисковать или экономить «на спичках».
                    Репутация прежде
                    всего!
                </div>
                <p>
                    Устанавливаем премиальные имплантаты Nobel Biocare и Straumann. Костнопластические операции с
                    применением стимулятор
                    роста кости BioOss, без использовния синтетических или аутотрансплантатов. Не применяем средств
                    карательной
                    хирургии вроде долота и пилы, строго современный ультразвуковой протокол PiezoSurgery. Лечение зубов
                    и
                    каналов, препарирование зубов под коронки и виниры, фиксация протезов, хирургия — только с
                    применением
                    дентального микроскопа без исключений Материалы терапевтического приема только из линейки мирового
                    «золотого
                    стандарта», например Harmonyze от Kerr и Ah Plus от Dentsply, закупаются только у официальных
                    представителей в
                    России и оригинальные на 100%. Применение Коффердам и Оптрагейт обязательно.
                </p>
                <a href="#" class="section-about__button section-button">
                    Подробнее
                </a>
            </div>
            <div class="section-about__info">
                <img src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/about/princip-6.png" alt=""
                    class="section-about__num">
                <div class="section-about__title">
                    <span>Только</span><br>
                    лучшее
                </div>
            </div>
        </div>
    </div>
    <!--/6-->

    <div class="section section-gallery">
        <div class="page__container page__container_index page__container_full">
            <div class="swiper-container gallery-new">
                <div class="swiper-wrapper">
                    <!--1-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/1.webp" alt="">
                        </div>
                    </div>
                    <!--/1-->
                    <!--2-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/2.webp" alt="">
                        </div>
                    </div>
                    <!--/2-->
                    <!--3-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/3.webp" alt="">
                        </div>
                    </div>
                    <!--/3-->
                    <!--4-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/4.webp" alt="">
                        </div>
                    </div>
                    <!--/4-->
                    <!--5-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/5.webp" alt="">
                        </div>
                    </div>
                    <!--/5-->
                    <!--6-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/6.webp" alt="">
                        </div>
                    </div>
                    <!--/6-->
                    <!--7-->
                    <div class="swiper-slide">
                        <div class="gallery-new__item">
                            <!--
                  <div class="gallery-new__content">
                    <div class="gallery-new__name">Пожизненная гарантия Dr Levin <br />LifeTime Warranty</div>
                    <div class="gallery-new__text">
                        В Центре проводятся уникальные в России операции, требующие ювелирного планирования и безукоризненного исполнения, от анестезиологической  медсестры, заканчивая стоматологом-ортопедом, фиксирующим протезы
                    </div>
                  </div>
              -->
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/7.webp" alt="">
                        </div>
                    </div>
                    <!--/7-->

                </div>
                <div class="section-button-prev"></div>
                <div class="section-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-container gallery-new-thumbs">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/1-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/2-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/3-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/4-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/5-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/6-thumb.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-new-thumbs__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/image/slider/thumbs/7-thumb.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="section   pt-5 pb-5">
        <div class="page__container page__container_index page__container_full">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/o-centre/lab/" class="card-small">
                        <div class="card-small__text">Собственная цифровая зуботехническая лаборатория</div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="#" class="card-small">
                        <div class="card-small__text">Центр клинического мастерства Nobel Biocare</div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/garantija-na-implantaciju-zubov/" class="card-small">
                        <div class="card-small__text">Пожизненная гарантия Dr. Levin Lifetime Warranty</div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/press/" class="card-small">
                        <div class="card-small__text">О нас пишут в СМИ</div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a href="#" class="card-small">
                        <div class="card-small__text">История открытия Центра</div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/lechenie-vseh-zubov-za-1-den-vo-sne/" class="card-small">
                        <div class="card-small__text">Все зубы за 1 визит</div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="#" class="card-small">
                        <div class="card-small__text">Технологии и оборудование</div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/nomer1-v-rejtinge-id-kommersant/" class="card-small">
                        <div class="card-small__text">№1 в рейтинге КоммерсантЪ</div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="#" class="card-small">
                        <div class="card-small__text">Единые стандарты качества</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section rating-section rating-section_page_about">
        <div class="page__container_index page__container_full">
            <h2 class="rating-section__title section__head mt-0">
                Рейтинг и отзывы
            </h2>
            <div class="rating-list">
                <a href="https://yandex.ru/maps/org/doktor_levin/1150624676/" rel="nofollow" target="_blank"
                    class="rating-card">
                    <div class="rating__item">
                        <div class="rating-star">
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span></span>
                        </div>
                        <div class="rating-info ff-sf">
                            4.4 <span>из 5</span>
                        </div>
                    </div>
                    <div class="rating__item">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/yandex.svg" alt="">
                        <div class="rating-amount ff-sf">
                            62 отзыва
                        </div>
                    </div>

                </a>
                <a href="https://www.google.com/maps/place/%D0%A6%D0%B5%D0%BD%D1%82%D1%80+%D0%BF%D1%80%D0%B8%D0%B2%D0%B0%D1%82%D0%BD%D0%BE%D0%B9+%D1%81%D1%82%D0%BE%D0%BC%D0%B0%D1%82%D0%BE%D0%BB%D0%BE%D0%B3%D0%B8%D0%B8+%D0%94%D0%BE%D0%BA%D1%82%D0%BE%D1%80+%D0%9B%D0%B5%D0%B2%D0%B8%D0%BD/"
                    rel="nofollow" target="_blank" class="rating-card">
                    <div class="rating__item">
                        <div class="rating-star">
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                        </div>
                        <div class="rating-info ff-sf">
                            4.7 <span>из 5</span>
                        </div>
                    </div>
                    <div class="rating__item">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/google.svg" alt="">
                        <div class="rating-amount ff-sf">
                            44 отзыва
                        </div>
                    </div>

                </a>
                <a href="https://zoon.ru/msk/medical/tsentr_privatnoj_stomatologii_doktor_levin/" rel="nofollow"
                    target="_blank" class="rating-card">
                    <div class="rating__item">
                        <div class="rating-star">
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span></span>
                        </div>
                        <div class="rating-info ff-sf">
                            4 <span>из 5</span>
                        </div>
                    </div>
                    <div class="rating__item">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/zoon.svg" alt="">
                        <div class="rating-amount ff-sf">
                            157 отзывов
                        </div>
                    </div>

                </a>
                <a href="https://prodoctorov.ru/moskva/lpu/72645-centr-privatnoy-stomatologii-doktora-levina/"
                    rel="nofollow" target="_blank" class="rating-card">
                    <div class="rating__item">
                        <div class="rating-star">
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span class="rating-star__active"></span>
                            <span></span>
                        </div>
                        <div class="rating-info ff-sf">
                            4 <span>из 5</span>
                        </div>
                    </div>
                    <div class="rating__item">
                        <img src="<?php bloginfo('template_url'); ?>/src/img/index/company/prodoctorov.svg" alt="">
                        <div class="rating-amount ff-sf">
                            17 отзывов
                        </div>
                    </div>

                </a>
            </div>
            <div class="rating-list__button-wrap">
                <a href="/otzyvy/" class="b-button doctor-section__button rating-list__button">Смотреть все отзывы</a>
            </div>
        </div>
    </div>
</article>

<?php
get_footer();