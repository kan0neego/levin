<?php $directory = get_template_directory_uri() . '/src/'; ?>
<div id="quotation" class="banner-quotation-new banner-quotation--regions section--smoke">
  <div class="banner-quotation-new__wrap wrap">
    <div class="banner-quotation-new__text-side">
      <h2 class="banner-quotation-new__title title-quotation">
        Мы <strong>каждый день</strong> лечим пациентов из самых дальних уголков России и других стран
      </h2>
      <div class="banner-quotation-new__text-box">
        <p>
          Лечебный процесс организован из соображений <strong>оптимизации числа посещений</strong> пациентом медицинского учреждения.
        </p>
      </div>
      <div class="banner-quotation-new__footer">
        <p class="banner-quotation-new__name">Левин Дмитрий Валерьевич</p>
        <p class="banner-quotation-new__votation">Главный врач и основатель ЦПС «Доктор Левин»</p>
        <div class="banner-quotation-new__signature signature">
          <img src="<?php echo $directory; ?>img/signature.svg" alt="Левин">
        </div>
        <!-- /.banner-quotation__signature signature -->
      </div>
      <!-- /.banner-quotation__footer -->
    </div>
    <!-- /.banner-quotation__text-side -->
    <div class="banner-quotation-new__img-side">
      <picture class="picture">
        <source type="image/png" media="(min-width: 992px)" src="<?php echo $directory; ?>img/banner-quotation-bg.png">
        <source type="image/png" media="(min-width: 768px)" src="<?php echo $directory; ?>img/banner-quotation-bg.png">
        <source type="image/svg+xml" src="<?php echo $directory; ?>img/banner-quotation-bg.png">
        <img alt="Левин Дмитрий Валерьевич" class="picture__img" loading="lazy" src="<?php echo $directory; ?>img/banner-quotation-bg.png" src="<?php echo $directory; ?>img/banner-quotation-bg.png">
      </picture>
    </div>
    <!-- /.banner-quotation__img-side -->
  </div>
  <!-- /.banner-quotation__wrap  -->
</div>
<!-- /.banner-quotation -->