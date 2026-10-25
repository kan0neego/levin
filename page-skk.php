<?php
/**
 * Template Name: Страница СКК (mobile)
 */
?>

<?php get_header();?>
<?php $directory = get_template_directory_uri() . '/src/'; ?>

<main class="main">
      <div id="#mail-manager" class="section-mail-manager section-thoughts-disabled" style="display: inherit">
        <div class="section-mail-manager__box mail-manager-box">
          <div class="mail-manager-box__header wrap wrap--720px">
            <h2 class="mail-manager-box__title">Написать директору</h2>
          </div>
          <!-- /.mail-manager-box__header wrap -->
          <picture class="mail-manager-box__picture picture">
            <source type="image/svg+xml" srcset="<?php echo $directory; ?>img/manager-box-doc.webp">
            <img alt="Левин Дмитрий Валерьевич" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/manager-box-doc.webp" srcset="<?php echo $directory; ?>img/manager-box-doc.webp">
          </picture>
          <!-- /.mail-manager-box__picture picture -->
          <div class="mail-manager-box__text-box wrap wrap--720px">
            <img class="mail-manager-box__icon" alt="" src="<?php echo $directory; ?>img/shield-check.svg" loading="lazy"> 
            <p class="mail-manager-box__quote">Я очень ценю Ваше
              доверие к нам</p>
            <p class="mail-manager-box__text">
              Если есть любой вопрос 
              или комментарий о работе Центра, свяжитесь с нами для решения проблемы или оценки. Спасибо
              за Вашу доброту и терпение!
            </p>
            <p class="mail-manager-box__name">Дмитрий Левин</p>
            <p class="mail-manager-box__votation">Основатель и главный врач Центра</p>
          </div>
          <!-- /.mail-manager-box__text-box -->
        </div>
        <!-- /.section-mail-manager__main mail-manager-box -->
        <div class="section-mail-manager__form-wrap wrap wrap--720px">
          <div class="form-manager-n">
          <?php echo do_shortcode( '[contact-form-7 id="20502" title="Страница оставить отзыв"]' ); ?>
          <div>
        </div>
        <!-- /.section-mail-manager__form-wrap -->
      </div>
      <!-- /.section-mail-manager -->
    </main>
    <!-- /.main -->

<?php get_footer(); ?>
