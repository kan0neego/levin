<?php $directory = get_template_directory_uri() . '/src/'; ?>
<div class="section-consult__wrap ">
    <div class="consult-box">
      <div class="consult-box__content">
        <div class="consult-box__header">
          <h3 class="consult-box__title">
            Задайте вопрос!
          </h3>
          <p class="consult-box__subtitle">
            Консультация врача по всем каналам связи!
          </p>
        </div>
        <!-- /.consult-box__header -->
        <a href="tel:+74957752001" class="consult-box__phone">
          +7 495 775-20-01
        </a>
        <div class="consult-box__btns">
          <a href="#" class="consult-box__btn-n btn-n btn-n--crystal" data-toggle="modal" data-target="#myModal2">
            Обратный звонок
          </a>
          <a href="https://wa.me/74957555007" target="_blank" rel="nofollow" class="consult-box__btn-n btn-n btn-n--wa">
            <i class="icon icon-wa-btn"></i>
            Написать в WhatsApp
          </a>
        </div>
        <!-- /.consult-box__btns -->

      </div>
      <!-- /.consult-box__content -->
      <div class="consult-box__img-side">
        <div class="consult-box__human consult-human">
          <picture class="consult-human__picture">
            <img src="<?php echo $directory; ?>img/consult-human.png" loading="lazy" alt="">
          </picture>
          <!--
          <div class="consult-human__content">
            <p class="consult-human__name">
              Смирнова Екатерина
            </p>
            <p class="consult-human__description">
              Встретит вас на ресепшене подпись
            </p>
          </div>
          -->
          <!-- /.consult-human__content -->
        </div>
        <!-- /.consult-box__human consult-human -->
      </div>
      <!-- /.consult-box__img-side -->
    </div>
    <!-- /.consult-box -->
</div>
<!-- /.consult-box__wrap  -->