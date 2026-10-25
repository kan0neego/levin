<?php
/**
 * The fallback lead form modal.
 *
 * @package levin
 */

$phone = get_site_phone();
?>

<div class="modal my-modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-uiscom-check>
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <img loading="lazy" class="girl" src="<?php echo get_stylesheet_directory_uri(); ?>/img/girl.webp" />
        <div class="modal-response" data-uiscom-view="online">
            <i class="icon icon-response"></i>
            <div>
                <h4 class="response-title" id="myModalLabel">Спасибо за обращение</h4>
                <span>Наши специалисты обязательно свяжутся с Вами в ближайшее время</span>
                <button class="my-modal__close" data-dismiss="modal" aria-label="Close">Закрыть окно</button>
            </div>
        </div>
        <div class="modal-content" data-uiscom-view="online">
            <div class="modal-col1">
                <h4 class="modal-title modal-while" id="myModalLabel">Запишитесь на консультацию</h4>
                <div><span>Оставьте заявку, и наш администратор свяжется с Вами в течение одной минуты!</span></div>
            </div>
            <div class="modal-col2">
                <?php echo do_shortcode( '[contact-form-7 id="7261" html_class="callback-form" html_id="callback_form_1"]' ); ?>
            </div>
        </div>
        <div class="uiscom-check-offline" data-uiscom-view="offline" hidden>
            <div class="uiscom-check-heading">Позвоните нам для записи</div>
            <p class="uiscom-check-text">
                Сервис обратного звонка временно недоступен. <br/> Позвоните нам -
                Администратор запишет вас на приём.
            </p>
            <?php if ( $phone ) : ?>
                <a class="uiscom-check-phone" href="<?php echo esc_url( phone_link( $phone ) ); ?>">
                    <?php echo esc_html( phone_format( $phone ) ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>