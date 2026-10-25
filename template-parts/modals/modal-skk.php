<div class="modal my-modal fade" id="control" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="popup-control">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <div class="popup-control__content">
                <p class="popup-control__title">Служба контроля качества</p>
                <p class="popup-control__subtitle">
                    Я очень ценю Ваше доверие к нам
                </p>
                <p class="popup-control__text">
                    Если есть любой вопрос или комментарий о работе Центра, свяжитесь с нами для решения проблемы или оценки.
                    Спасибо за Вашу доброту и терпение.
                </p>
            </div>
            <div class="popup-control__manager manager-box">
                <div class="manager-box__img-box">
                    <picture class="picture">
                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/skk-avatar.png" alt="" class="picture__img">
                    </picture>
                </div>
                <div class="manager-box__text-side">
                    <p class="manager-box__title">Дмитрий Левин</p>
                    <p class="manager-box__text">Основатель и главный врач Центра</p>
                </div>
            </div>
            <?php echo do_shortcode( '[contact-form-7 id="cfc933a" title="Служба контроля качества"]' ); ?>
        </div>
    </div>
</div>