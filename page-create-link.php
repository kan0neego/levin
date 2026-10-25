<?php
/**
 * Template Name: Страница формирования ссылки
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Левин Д.В">
  <meta name="theme-color" content="#313640">
  <meta name="format-detection" content="telephone=no">
  <link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/img/icon-highres.png">
  <link rel="dns-prefetch" href="//vk.com">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <?php wp_head(); ?>
  </head>
<body>
<div class="corpus">
<main class="main"> 
<section class="section-mail-manager">
  <div class="section-mail-manager__box mail-manager-box">
    <div class="mail-manager-box__header wrap wrap--720px">
      <h2 class="mail-manager-box__title">Сгенерировать сообщение</h2>
    </div>
  </div>
  <div class="section-mail-manager__form-wrap wrap wrap--720px">
    <div class="form-manager-n">
      <div class="form-manager-n__fields">
        <div class="form-manager-n__wrapper">
          <select id="place" name="place" class="form-manager-n__input form-manager-n__select" placeholder="Филиал">
            <option value="">Филиал</option>
            <option value="1">Университет</option>
            <option value="2">Парк Культуры</option>
          </select>
        </div>
        <div class="form-manager-n__wrapper">
          <select id="admin" name="admin" class="form-manager-n__input form-manager-n__select" placeholder="Администратор">
            <option value="">Выберите администратора</option>
            <option value="1">Бочарова Диана</option>
            <option value="2">Василевская Екатерина</option>
            <option value="3">Гладышева Виктория</option>
            <option value="4">Дьяченко Елизавета</option>
            <option value="5">Жукова Валерия</option>
            <option value="6">Логинова Ксения</option>
            <option value="7">Миловидова Вероника</option>
            <option value="8">Устюжанина Анастасия</option>
            <option value="9">Яковлева Дарья</option>
          </select>
        </div>
        <div class="form-manager-n__wrapper">
          <input id="patient_card" name="patient_card" placeholder="Номер карты пациента" type="number" class="form-manager-n__input" autofocus autocomplete="off">
        </div>
        <div class="form-manager-n__wrapper">
          <input id="name" name="name" placeholder="Имя пациента" type="text" class="form-manager-n__input" autofocus autocomplete="off">
        </div>
        <div class="form-manager-n__wrapper">
          <select id="patient_sex" name="patient_sex" class="form-manager-n__input form-manager-n__select" placeholder="Пол пациента">
            <option value="">Пол пациента</option>
            <option value="male">мужской</option>
            <option value="female">женский</option>
          </select>
        </div>
        <div class="form-manager-n__wrapper">
          <select id="doctors" name="doctors" class="form-manager-n__input form-manager-n__select" placeholder="Лечащий врач">
            <option value="" >Выберите врача</option>
            <?php 
            $query = new WP_Query( [
              'post_type'    => 'doctors',
              'posts_per_page' => -1,
              'orderby' => 'title',
              'order' => 'ASC',
              'post__not_in' => [ 5543, 19136 ], // массив для id врачей, которых не надо показывать
              /*
              'meta_query'    => array(
                    array(
                        'key'       => 'doctor_branch',
                        'value'     => array('Университет'),
                        'compare'   => 'IN',
                    )
                )*/
            ] ); 

            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post(); ?>
                <option value="<?php echo $post->ID; ?>" ><?php the_title(); ?></option>
              <?php }
            }
            wp_reset_postdata();
            ?>
          </select>
        </div>
        <div class="form-manager-n__wrapper">
          <div id="textLink" class="form-manager-n__textarea form-control-n__input"></div>
        </div>
      </div>
      <button class="form-manager-n__btn btn-n btn-n--blue btn-n--disabled">Сгенерировать<span class="tooltip-copy">Скопировано</span></button>
    </div>
  </div>
</section>
</main>
</div>
<?php
wp_footer();
?>

<script>
document.addEventListener(`DOMContentLoaded`, () => {
  const patientName = document.getElementById(`name`)
  const patientSex = document.getElementById(`patient_sex`)
  const doctorId = document.getElementById(`doctors`)
  const placeId = document.getElementById(`place`)
  const adminId = document.getElementById(`admin`)
  const cardId = document.getElementById(`patient_card`)
  
  const button = document.querySelector(`.form-manager-n__btn`)
  const text = document.getElementById(`textLink`)
  
  patientName.oninput = doctorId.oninput = place.oninput = admin.oninput = () => {
    if ( adminId.value && placeId.value && doctorId.value && patientName.value) {
    button.classList.remove(`btn-n--disabled`)
    } else {
      !button.classList.contains(`btn-n--disabled`) ? button.classList.add(`btn-n--disabled`) : ''
      text.innerHTML = ''
    }
  }



  button.addEventListener(`click`, () => {
    if (!button.classList.contains(`btn-n--disabled`) && adminId.value && placeId.value && doctorId.value && patientName.value && cardId.value) {
      const uuid = `${(+new Date).toString(32)}`
      const timestamp = (new Date()).toISOString().slice(0, 19).replace('T', ' ')
      const link_short = `<?php echo site_url(); ?>/f/?${uuid.substr(3)}`

      /*




      */

      text.innerHTML = `Здравствуйте, ${patientName.value}!<br><br>Спасибо Вам за то, что выбрали нашу клинику! Будем безмерно благодарны Вам 🤗 за отзыв о нашей работе!<br><br>Оставить отзыв можно по ссылке ниже 👇<br><br><?php echo site_url(); ?>/f/?${uuid.substr(3)}`

      document.querySelector(`.form-manager-n__btn span`).style = 'opacity: 1; transform: translateY(30px)'

      navigator.clipboard.writeText(text.innerHTML.replace(/<br\s*[\/]?>/gi, "\n"))
      setTimeout(() => {
        document.querySelector(`.form-manager-n__btn span`).style = ''
      }, 1000);

      text.addEventListener(`click`, () => {
        let rng = document.createRange()
        rng.selectNode(text)
        let sel = window.getSelection()
        sel.removeAllRanges()
        sel.addRange(rng)
      })

      $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            'action': 'created_link', 
            'link_short': link_short,
            'doctor_id': doctorId.value,
            'patient_name': patientName.value,
            'patient_sex': patientSex.value,
            'admin_id': adminId.value,
            'place_id': placeId.value,
            'timestamp': timestamp,
            'card_id': cardId.value,
        }
      });
    }
  })

})
</script>

</body>
</html>
