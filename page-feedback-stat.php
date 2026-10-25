<?php
/**
 * Template Name: Страница статистики отзывов
 */

if ( ! is_user_logged_in() ) {
    auth_redirect();
}

if ( ! current_user_can( 'manage_options' ) ) {
    status_header( 403 );
    nocache_headers();
    exit( 'Доступ запрещён' );
}

nocache_headers();

$data = $wpdb->get_results( "SELECT * FROM `levin_feedback_links` ORDER BY timestamp DESC" );
$link_count = count($data);
?>

<?php $directory = get_template_directory_uri() . '/src/'; ?>
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
  <main class="main main--full">
    <div class="section-statistics-table">
      <div class="section-statistics-table__wrap container">
        <h1 class="section-statistics-table__header">
          Статистика отзывов
        </h1>
        <div class="statistics-table">
          <div class="statistics-table__header" style="grid-gap: 12px">
            <p class="statistics-table__text">Дата и время</p>
            <p class="statistics-table__text">Администратор</p>
            <p class="statistics-table__text">Филиал</p>
            <p class="statistics-table__text">№ карты пациента</p>
            <p class="statistics-table__text">ФИО пациента</p>
            <p class="statistics-table__text">Врач</p>
            <p class="statistics-table__text">Кол-во переходов</p>
            <p class="statistics-table__text">Ссылка</p>
          </div>
          <div class="statistics-table__body">
            <?php
            $admin_names = array("Василевская", "Горбатенкова", "Гусева", "Дьяченко", "Сенаторова", "Устюжанина", "Цулина", "Гладышева", "Жукова");
            $places_names = array("Университет", "Парк Культуры");
            for ( $i = 0; $i < $link_count; $i++ ) {
                $date = $data[$i]->timestamp;
                $link_short = str_replace('https://', '', $data[$i]->link_short);

                if ( get_post($data[$i]->doctor_id) ) {
                    $doctor_post = get_post($data[$i]->doctor_id); // общая информация о враче
                    $doctor_name = $doctor_post->post_title;
                } else {
                    $doctor_name = "Врач удален";
                }

                $patient_name = $data[$i]->patient_name;
                $admin_id = $data[$i]->admin_id - 1;
                $place_id = $data[$i]->place_id - 1;
                $card_id = $data[$i]->card_id;
                $link_views = $data[$i]->link_views;
                ?>
            <div class="statistics-table__row" style="grid-gap: 12px">
              <p class="statistics-table__text"><?php echo $date; ?></p>
              <p class="statistics-table__text"><?php echo $admin_names[$admin_id]; ?></p>
              <p class="statistics-table__text"><?php echo $places_names[$place_id]; ?></p>
              <p class="statistics-table__text"><?php echo $card_id; ?></p>
              <p class="statistics-table__text"><?php echo $patient_name; ?></p>
              <p class="statistics-table__text"><?php echo $doctor_name; ?></p>
              <p class="statistics-table__text"><?php echo $link_views; ?></p>
              <p class="statistics-table__text"><a href="<?php echo 'https://'.$link_short; ?>" target="_blank"><?php echo $link_short; ?></a> ➡️</p>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
