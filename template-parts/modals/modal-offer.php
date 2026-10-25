<div class="modal my-modal consultation-modal fade" id="myModalConsultation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="consultation-modal__container modal-dialog" role="document">
        <button type="button" class="consultation-modal__close" data-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
            <div class="doctors-advice__text-container bn">
                <div class="doctors-advice__text-date">
                    <span><?php echo get_field('price_badge', 'option'); ?></span>
                </div>
                <h2><span class="blue-line">Бесплатная</span> консультация</h2>
                <p>Консультация <strong>до 4 специалистов</strong> за 1 визит в сложных или нестандартных случаях</p>
                <div class="modal-col2">
                    <?php echo do_shortcode( '[contact-form-7 id="7261" html_class="callback-form" html_id="callback_form_3"]' ); ?>
                </div>
            </div>
        </div>
        <div class="modal-response">
            <i class="icon icon-response"></i>
            <div>
                <h4 class="response-title" id="myModalLabel">Спасибо за обращение</h4>
                <span>Наши специалисты обязательно свяжутся с Вами в ближайшее время</span>
            </div>
        </div>
    </div>
</div>