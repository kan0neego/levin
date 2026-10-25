<?php
/**
 * Template Name: Гнатология
 */

get_header();
?>

<div class="banner gnathology-banner">
  <div class="banner__content">
    <?php levin_breadcrumbs(); ?>

    <h1 class="banner__name">Отделение гнатологии</h1>


    <p class="banner__subtext">Комплексная диагностика и лечение нарушений прикуса</p>
    <p class="banner__text">Гнатология — точная диагностика и лечение дисфункций ВНЧС, прикуса и жевательной
      системы</p>

    <div class="banner__price-container">
      <div class="banner__price-subheading">Цена консультации</div>
      <div class="banner__price">5 000 ₽</div>
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

<div class="section section-default section-anchors pt-40 pt-20-mob pb-0">
  <div class="page__container_index page__container_full">
    <div class="anchors__container">
      <div class="anchors__item">Этапы лечения</div>
      <div class="anchors__item">Кому подходит</div>
      <div class="anchors__item">Преимущества</div>
      <div class="anchors__item">Анализы</div>
      <div class="anchors__item">Альтернативы</div>
      <div class="anchors__item">Сравнения</div>
      <div class="anchors__item">Цены</div>
      <div class="anchors__item">Слово врача</div>
      <div class="anchors__item">Вопросы и ответы</div>
    </div>
  </div>
</div>

<div class="section section-default section-page-intro">
  <div class="page__container_index page__container_full">
    <div class="page-intro__text">Современная стоматология не имеет ничего общего с тем, что с детства
      запомнилось
      людям среднего и старшего возраста больше нет ужасающих механических бормашин, огромных стеклянных
      шприцев с толстыми, плохо заточенными иглами и слов «ну ничего, потерпишь»</div>
  </div>
</div>

<div class="section section-default section-treat-list pt-0">
  <div class="page__container_index page__container_full">
    <div class="treat-list__container">
      <div class="treat-list__heading">
        Что мы лечим
      </div>
      <ul class="treat-list__links">
        <li><a href="#">Боль в виске при жевании</a></li>
        <li><a href="#">Боль в шее из-за ВНЧС</a></li>
        <li><a href="#">Хрустит челюсть</a></li>
        <li><a href="#">Миофасциальный болевой синдром</a></li>
        <li><a href="#">Смещение сустава челюсти</a></li>
        <li><a href="#">Вывих челюсти</a></li>
        <li><a href="#">Подвывих нижней челюсти</a></li>
        <li><a href="#">Асимметрия лица</a></li>
        <li><a href="#">Заклинило челюсть</a></li>
        <li><a href="#">Щелкает сустав челюсти</a></li>
        <li><a href="#">Лечение дисфункции височно-нижнечелюстного сустава (ВНЧС)</a></li>
        <li><a href="#">Болит челюсть при жевании и открывании рта</a></li>
        <li><a href="#">Cиновит сустава челюсти</a></li>
        <li><a href="#">Контрактура нижней челюсти</a></li>
      </ul>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/gnathology/identification-symptoms'); ?>

<div class="section section-default">
  <div class="page__container_index page__container_full">
    <?php get_template_part('template-parts/common/topic-snippet'); ?>
  </div>
</div>

<div class="section section-default section-photos-cards">
  <div class="page__container_index page__container_full">
    <h2 class="heading heading_h2 section-heading_h2 heading_border" id="photos-cards">
      Диагностика и лечение в нашем Центре</h2>
    <p class="section-subheading_p">Комплексная диагностика и лечение в одном центре по единым клиническим
      стандартам</p>
    <div class="swiper-container photos-cards-swiper">
      <div class="swiper-wrapper">

        <div class="photo-card swiper-slide">
          <div class="photo-card__image-container">
            <img class="photo-card__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/photo-card-1.png" alt="">
          </div>
          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              Диагностика
              в артикуляторе
            </a>
            <div class="photo-card__subheading">
              Функциональная диагностика прикуса и работы ВНЧС
              с использованием артикулятора
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__image-container">
            <img class="photo-card__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/photo-card-2.png" alt="">
          </div>

          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              Фотопротокол
            </a>
            <div class="photo-card__subheading">
              Клиническая фотофиксация состояния зубов и прикуса на всех этапах лечения
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__image-container">
            <img class="photo-card__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/photo-card-3.png" alt="">
          </div>

          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              Аксиография
            </a>
            <div class="photo-card__subheading">
              Функциональная диагностика ВНЧС
              с помощью аксиографии
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__image-container">
            <img class="photo-card__image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/photo-card-4.png" alt="">
          </div>

          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              Ботулинотерапия
            </a>
            <div class="photo-card__subheading">
              Анализ траекторий движения челюсти при функциональных нарушениях
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              КЛКТ ВНЧС
            </a>
            <div class="photo-card__subheading">
              Функциональная диагностика прикуса и работы ВНЧС
              с использованием артикулятора
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              ЭМГ
            </a>
            <div class="photo-card__subheading">
              Клиническая фотофиксация состояния зубов и прикуса на всех этапах лечения
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              3D-сканирование челюстей
            </a>
            <div class="photo-card__subheading">
              Функциональная диагностика ВНЧС
              с помощью аксиографии
            </div>
          </div>
        </div>

        <div class="photo-card swiper-slide">
          <div class="photo-card__text-container">
            <a href="#" class="photo-card__heading сard-link">
              Сплинт-терапия
            </a>
            <div class="photo-card__subheading">
              Анализ траекторий движения челюсти при функциональных нарушениях
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- section-dark-gray -->
<!-- section-dark-blue -->
<div class="section section-default section-body-structure pt-0">
  <div class="page__container_index page__container_full">
    <div class="body-structure__main-container">
      <div class="body-structure__container">
        <div class="body-structure__media-container">
          <img class="body-structure__media"
            src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/body-structure.png" alt="">
        </div>
        <div class="body-structure__text-container">
          <div class="body-structure__heading">Височно-нижнечелюстной сустав</div>
          <p>
            Височно-нижнечелюстной сустав (ВНЧС) — это сложный
            и высоконагруженный сустав, который соединяет нижнюю челюсть с височной костью черепа и
            обеспечивает
            согласованную работу всей жевательной системы
          </p>
          <p>
            Своевременная комплексная диагностика позволяет выявить функциональные нарушения на ранних
            этапах,
            определить их истинную причину и подобрать индивидуальное лечение, направленное на
            восстановление
            правильной работы сустава, комфорта и качества жизни пациента.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- section-dark-blue -->
<div class="section section-default section-doctors-team section-dark-gray pt-0">
  <div class="page__container_index page__container_full">
    <h2 class="heading heading_h2 section-heading_h2 heading_border" id="doctors-team">
      Команда врачей</h2>
    <p class="section-subheading_p">Команда врачей-стоматологов, и персональным подходом к каждому пациенту
    </p>
    <div class="swiper-container doctors-team-swiper">
      <div class="swiper-wrapper">

        <div class="doctors-team__card swiper-slide">
          <div class="doctors-team__card-content-container">
            <div class="doctors-team__card-text-container">
              <div class="stage-poster">
                <span class="stage-poster--big">17</span>
                <span class="stage-poster--small">лет</span>
              </div>
              <div class="doctors-team__doctor-name">Крыга
                Евгений Александрович</div>
              <div class="doctors-team__doctor-position">Врач-ортодонт</div>
              <div class="doctors-team__doctor-text">Объединённых клиническим опытом, современными
                протоколами
                лечения и персональным подходом к каждому пациенту. Работаем точно, системно и на результат
                —
                от диагностики до полного восстановления функции и эстетики.</div>
              <div class="doctors-team__buttons">
                <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2">
                  Записаться на приём
                </a>
                <a href="#" class="b-button b-button--outline ">
                  Подробнее</a>
              </div>
            </div>
          </div>
          <div class="doctors-team__card-image-container">
            <img class="doctors-team__card-image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/doctors-team-1.png" alt="">
          </div>
        </div>

        <div class="doctors-team__card swiper-slide">
          <div class="doctors-team__card-content-container">
            <div class="doctors-team__card-text-container">
              <div class="stage-poster">
                <span class="stage-poster--big">17</span>
                <span class="stage-poster--small">лет</span>
              </div>
              <div class="doctors-team__doctor-name">Крыга
                Евгений Александрович</div>
              <div class="doctors-team__doctor-position">Врач-ортодонт</div>
              <div class="doctors-team__doctor-text">Работаем точно, системно и на результат
                —
                от диагностики до полного восстановления функции и эстетики.</div>
              <div class="doctors-team__buttons">
                <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2">
                  Записаться на приём
                </a>
                <a href="#" class="b-button b-button--outline ">
                  Подробнее</a>
              </div>
            </div>
          </div>
          <div class="doctors-team__card-image-container">
            <img class="doctors-team__card-image"
              src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/doctors-team-1.png" alt="">
          </div>
        </div>

      </div>

      <div class="swiper-container doctors-team-miniatures-swiper">
        <div class="swiper-wrapper">

          <div class="doctors-team-miniatures__card swiper-slide">
            <div class="doctors-team-miniatures__card-container">
              <div class="doctors-team-miniatures__card-image-container">
                <img class="doctors-team-miniatures__card-image"
                  src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/doctors-team-1.png" alt="">
              </div>
              <div class="doctors-team-miniatures__card-text-container">
                <div class="doctors-team-miniatures__doctor-name">Крыга
                  Евгений Александрович</div>
                <div class="doctors-team-miniatures__doctor-name-short">Крыга Е.А.</div>
                <div class="doctors-team-miniatures__doctor-position">Челюстно-лицевой хирург</div>
              </div>
            </div>
          </div>

          <div class="doctors-team-miniatures__card swiper-slide">
            <div class="doctors-team-miniatures__card-container">
              <div class="doctors-team-miniatures__card-image-container">
                <img class="doctors-team-miniatures__card-image"
                  src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/doctors-team-1.png" alt="">
              </div>
              <div class="doctors-team-miniatures__card-text-container">
                <div class="doctors-team-miniatures__doctor-name">Крыга
                  Евгений Александрович</div>
                <div class="doctors-team-miniatures__doctor-name-short">Крыга Е.А.</div>
                <div class="doctors-team-miniatures__doctor-position">Врач-ортодонт</div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- section-dark-gray -->
<!-- section-dark-blue -->
<div class="section section-default section-accordions section-prices section-dark-gray pt-0">
  <div class="page__container_index page__container_full">
    <div class="prices__main-container">

      <div class="prices__text-container">
        <h2 class="heading heading_h2 section-heading_h2 heading_border" id="prices">
          Цены</h2>
        <div class="prices__subheading">Прозрачная стоимость стоматологических услуг
          без скрытых платежей.
          Итоговая цена формируется после консультации и диагностики.</div>
        <a href="#" class="b-button b-button--primari" data-toggle="modal" data-target="#myModal2">
          Записаться на приём
        </a>
      </div>

      <div class="prices__content-container article">

        <div class="accordeon question prices load accordeon_open" data-isopen="true">
          <div class="accordeon__head question__head"><span>Диагоностика</span></div>
          <div class="accordeon__body question__body">
            <div class="accordeon__content question__content">

              <div class="accordion__row accordion__row--accent">
                <div class="prices__text">
                  <a href="" class="prices__heading">Консультация врача-гнатолога</a>

                  <div class="prices__text-box article">
                    <div class="prices__text-subheading">КЛКТ ВНЧС, фотопротокол, проведение
                      ЭМГ(электромиография), аксиография,
                      цефалометрия, 3D-сканирование челюстей, изготовление моделей челюстей и фиксация
                    </div>
                  </div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__badge">
                    <span class="prices__stock">🔥 Акция до 28.02</span>
                  </div>
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

              <div class="accordion__row accordion__row--accent">
                <div class="prices__text">
                  <a href="" class="prices__heading">Консультация врача-гнатолога</a>

                  <div class="prices__text-box article">
                    <div class="prices__list-heading">В СТОИМОСТЬ ВХОДИТ</div>
                    <ul class="article__list_check gray">
                      <li>
                        Контрольные снимки на этапах лечения
                      </li>
                      <li>
                        ВНЧС
                      </li>
                      <li>
                        Контрольные снимки на этапах лечения
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__badge">
                    <span class="prices__stock">🔥 Акция до 28.02</span>
                  </div>
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

              <div class="accordion__row">
                <div class="prices__text">
                  <div class="prices__heading">Консультация врача-гнатолога</div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

              <div class="accordion__row">
                <div class="prices__text">
                  <div class="prices__heading">Консультация врача-гнатолога</div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__cost">
                    <div class="prices__cost-main"><span class="prices__cost-from">от</span> 90 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="accordeon question prices load accordeon_open" data-isopen="true">
          <div class="accordeon__head question__head"><span>Диагоностика</span></div>
          <div class="accordeon__body question__body">
            <div class="accordeon__content question__content">

              <div class="accordion__row accordion__row--accent">
                <div class="prices__text">
                  <a href="" class="prices__heading">Консультация врача-гнатолога</a>

                  <div class="prices__text-box article">
                    <div class="prices__text-subheading">КЛКТ ВНЧС, фотопротокол, проведение
                      ЭМГ(электромиография), аксиография,
                      цефалометрия, 3D-сканирование челюстей, изготовление моделей челюстей и фиксация
                    </div>
                  </div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__badge">
                    <span class="prices__stock">🔥 Акция до 28.02</span>
                  </div>
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

              <div class="accordion__row accordion__row--accent">
                <div class="prices__text">
                  <a href="" class="prices__heading">Консультация врача-гнатолога</a>

                  <div class="prices__text-box article">
                    <div class="prices__list-heading">В СТОИМОСТЬ ВХОДИТ</div>
                    <ul class="article__list_check gray">
                      <li>
                        Контрольные снимки на этапах лечения
                      </li>
                      <li>
                        ВНЧС
                      </li>
                      <li>
                        Контрольные снимки на этапах лечения
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__badge">
                    <span class="prices__stock">🔥 Акция до 28.02</span>
                  </div>
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

              <div class="accordion__row">
                <div class="prices__text">
                  <div class="prices__heading">Консультация врача-гнатолога</div>
                </div>

                <div class="prices__price-box">
                  <div class="prices__cost">
                    <div class="prices__cost-main">5 000 ₽</div>
                  </div>
                  <div class="b-button b-button--primari prices__button" data-toggle="modal" data-target="#myModal2">
                    Записаться</div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>

    </div>

  </div>
</div>

<div class="section section-default section-doctors-advice pt-0">
  <div class="page__container_index page__container_full">

    <div class="doctors-advice bn">
      <div class="doctors-advice__container">
        <img decoding="async" class="doctors-advice__image two-doctors" src="/images/bp/bozhkov-kolchin.png" alt="">
        <div class="doctors-advice__text-container">
          <div class="doctors-advice__text-date">
            <span>
              🎁 Акция до 30 апреля
            </span>
          </div>
          <h2>
            Экспертная
            консультация
            стоматолога-гнатолога
          </h2>
          <p>
            Специальное предложение на комплексную консультацию ведущего гнатолога Центра
          </p>
          <div class="doctors-advice__price-main-container">
            <div class="doctors-advice__price-title">Цена под ключ</div>
            <div class="doctors-advice__price-container">
              <div class="doctors-advice__price-after">
                <span>5 000 ₽</span>
              </div>
              <div class="doctors-advice__price-before">
                <span>10 000 ₽</span>
              </div>
            </div>
          </div>
          <a class="b-button b-button--primari bn__button" data-toggle="modal" data-target="#myModal2">
            Записаться
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="section section-default pt-0">
  <div class="page__container_index page__container_full">

    <div class="cards-number__wrapper">
      <div class="card-number">
        <div class="card-number__order"></div>
        <div class="card-number__text-container">
          <div class="card-number__heading">Диагностика</div>
          <div class="card-number__subheading">Ключевой фактор — хронический гипертонус жевательных мышц, который
            запускает каскад мышечного
            перенапряжения в области шеи</div>
          <ul class="default-list">
            <li>При бруксизме, стрессовом сжатии зубов или нарушении прикуса жевательные мышцы (в первую очередь
              жевательная и височная) находятся в состоянии постоянного напряжения. Их тонус повышается, формируются
              триггерные точки.</li>
            <li>Чтобы компенсировать перегрузку и стабилизировать положение нижней челюсти,
              в работу активно включаются мышцы шеи: грудинно-ключично-сосцевидная, ременные мышцы головы, подзатылочная
              группа.</li>
            <li>Возникает перераспределение нагрузки: гипертонус челюсти → компенсация через шею → стойкий спазм → боль
              в затылке и задней поверхности шеи.</li>
          </ul>
          <p>Так формируется хронический миогенный болевой синдром.</p>
        </div>
      </div>
      <div class="card-number">
        <div class="card-number__order"></div>
        <div class="card-number__text-container">
          <div class="card-number__heading">Диагностика</div>
          <div class="card-number__subheading">Ключевой фактор — хронический гипертонус жевательных мышц, который
            запускает каскад мышечного
            перенапряжения в области шеи</div>
          <ul class="default-list">
            <li>При бруксизме, стрессовом сжатии зубов или нарушении прикуса жевательные мышцы (в первую очередь
              жевательная и височная) находятся в состоянии постоянного напряжения. Их тонус повышается, формируются
              триггерные точки.</li>
            <li>Чтобы компенсировать перегрузку и стабилизировать положение нижней челюсти,
              в работу активно включаются мышцы шеи: грудинно-ключично-сосцевидная, ременные мышцы головы, подзатылочная
              группа.</li>
            <li>Возникает перераспределение нагрузки: гипертонус челюсти → компенсация через шею → стойкий спазм → боль
              в затылке и задней поверхности шеи.</li>
          </ul>
          <p>Так формируется хронический миогенный болевой синдром.</p>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="section section-default section-accordions pt-0">
  <div class="page__container_index page__container_full">
    <h2 class="heading heading_h2 section-heading_h2 heading_border" id="faq">
      Ответы на вопросы</h2>
    <div class="article">
      <div class="lazyblock-faq-2v8qkM wp-block-lazyblock-faq">
        <div class="accordeon question load" data-isopen="false" style="max-height: 80px;">
          <div class="accordeon__head question__head"><span>Какой вид наркоза вы применяете?</span></div>
          <div class="accordeon__body question__body">
            <div class="accordeon__content question__content">
              <p>Всего существует два вида общего наркоза не только в стоматологии, но и в других сферах
                медицины:</p>
              <ol>
                <li aria-level="1">Ингаляционный. При таком виде общего обезболивания пациент вдыхает
                  препарат
                  через специальную маску. Требуется всего несколько вдохов для погружения в сон. Чаще всего
                  стоматологи используют для ингаляционного наркоза «Севоран». В отличие от многих других
                  лекарственных средств, он обладает приятным запахом и не раздражает дыхательные пути.</li>
                <li aria-level="1">Внутривенный. При таком виде обезболивания препарат вводится внутривенно.
                  Стоматологи используют «Пропофол», который действует очень быстро. После окончания эффекта
                  препарата человек просыпается быстро, легко и без проявлений каких-либо побочных действий.
                  Исчезает из кровотока через час, не оставляя никаких следов.</li>
              </ol>
              <p>В нашем Центре применяется только внутривенный способ седации, который зарекомендовал себя
                самым эффективным и надежным способом анестезии, как в момент проведения операции, так и
                после
                нее.</p>
              <a class="doctor-content" href="https://doctorlevin.ru/zinovev-sergej-alekseevich/">
                <div class="doctor-content__image">
                  <img decoding="async" src="https://doctorlevin.ru/wp-content/uploads/2021/09/levin-faq-avatar.png">
                </div>
                <div class="doctor-content__text">
                  <b>Левин Дмитрий Валерьевич</b>
                  <span>Челюстно-лицевой хирург, главный врач Центра</span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="accordeon question load" data-isopen="false" style="max-height: 80px;">
          <div class="accordeon__head question__head"><span>Какие препараты применяете?</span></div>
          <div class="accordeon__body question__body">
            <div class="accordeon__content question__content">
              <p>При седации применяются препараты только одной группы гипнотиков. При общей анестезии
                (наркоз) используется «микс» препаратов, включая наркотические вещества, например опиаты.
                Вследствие использования разных групп препаратов, развивается сильное токсическое действие
                на
                организм.</p>
              <p>В нашем Центре применяются только «Пропофол» или «Диприван» (Франция) без добавления
                наркотических веществ, благодаря чему “выход” из медикаментозного сна — 30-40 минут и нет
                побочных эффектов в виде тошноты, рвоты, головокружения и т.п.</p>
              <a class="doctor-content" href="https://doctorlevin.ru/zinovev-sergej-alekseevich/">
                <div class="doctor-content__image">
                  <img decoding="async" src="https://doctorlevin.ru/wp-content/uploads/2021/09/levin-faq-avatar.png">
                </div>
                <div class="doctor-content__text">
                  <b>Левин Дмитрий Валерьевич</b>
                  <span>Челюстно-лицевой хирург, главный врач Центра</span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="accordeon question load" data-isopen="false" style="max-height: 80px;">
          <div class="accordeon__head question__head"><span>Сколько обычно длится сеанс седации?</span>
          </div>
          <div class="accordeon__body question__body">
            <div class="accordeon__content question__content">
              <p>В среднем, обычный сеанс лечения зубов под наркозом или седацией длится 1-2 часа, при
                необходимости его продлевают без какого-либо риска для пациента. После окончания лечения
                пациент просыпается сам через 10-20 минут.</p>
              <p>В соответствии с международными нормами, максимально допустимая продолжительность одной
                непрерывной операции — 14 часов без какого-либо вреда для здоровья пациента. Самое
                продолжительное лечение в нашем Центре началось в 9.30 утра и завершилось в 22.30 с двумя
                перерывами на посещение пациентом уборной.</p>
              <a class="doctor-content" href="https://doctorlevin.ru/zinovev-sergej-alekseevich/">
                <div class="doctor-content__image">
                  <img decoding="async" src="https://doctorlevin.ru/wp-content/uploads/2021/09/levin-faq-avatar.png">
                </div>
                <div class="doctor-content__text">
                  <b>Левин Дмитрий Валерьевич</b>
                  <span>Челюстно-лицевой хирург, главный врач Центра</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>