<?php
/*
 *  Модальное окно Контакты
 */

$phone = get_field( 'phone', 'option' );
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" data-uiscom-view="online">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Обратная связь</h4>
            </div>
            <div class="modal-body" data-uiscom-view="online">
                <a class="modal__btn blue vertical-align" href="<?php echo phone_link( get_site_phone() ); ?>"
                    onclick="ym(38009025,'reachGoal','phone_click'); return true;">
                    <i><img src="<?php bloginfo( 'template_url' ); ?>/img/phone-forwarded.svg" alt=""></i>
                    <span>
                        <?php echo phone_format( get_site_phone() ); ?>
                    </span>
                </a>
                <a class="modal__btn blue-while" href="<?php the_field( 'tg_profile_link', 'option' ); ?>"
                    onclick="ym(38009025,'reachGoal','whatsapp_click'); return true;">
                    <i><img src="<?php bloginfo( 'template_url' ); ?>/img/telegram.svg" alt="Telegram"></i>
                    <span>Написать в Telegram</span>
                </a>
                <button class="modal__btn blue-while" type="button" data-toggle="collapse" data-target="#vopros"
                    aria-expanded="false">
                    <span>Задать вопрос</span>
                </button>
                <div class="collapse" id="vopros">
                    <div class="well">
                        <?php echo do_shortcode( '[contact-form-7 id="20968" ]' ); ?>
                    </div>
                </div>
                <button class="modal__btn blue-while" type="button" data-toggle="collapse" data-target="#privatmess"
                    aria-expanded="false">
                    <span>Написать директору клиники</span>
                </button>
                <div class="collapse" id="privatmess">
                    <div class="well">
                        <?php echo do_shortcode( '[contact-form-7 id="249" ]' ); ?>
                    </div>
                </div>
                <div>
                    <div class="modal__text mt-4">
                        <p class="adress-jobs">
                            <span>Клиника на <span class="site-menu__center-icon metro-icon red"></span> Университете</span>
                        </p>
                        <div>
                            <span>проспект Вернадского, д. 8А, «Сильвер Хаус», 1 этаж</span>
                        </div>
                        <div class="info-jobs-clinik" style="margin: 10px 0;">
                            <div class="info-jobs-clinik--item">
                                <img class="" src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/park-icon.svg">
                                <span>Бесплатная охраняемая парковка</span>
                            </div>
                        </div>
                        <h3 class="time-jobs-clinik--name">Время работы Центра</h3>
                        <div class="time-jobs-clinik--row">
                            <div class="time-jobs-clinik--item green"><b>Будние дни</b>
                                <span>10:00 до 20:00</span>
                            </div>
                            <div class="time-jobs-clinik--item green">
                                <b>Выходные</b>
                                <span>10:00 до 19:00</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="map_contact" id="mapConctUnv"></div>
                    </div>
                </div>
                <div style="margin-top: 30px">
                    <div class="modal__text">
                        <p class="adress-jobs">
                            <span>Клиника на <span class="site-menu__center-icon metro-icon red"
                                    style="background-color: #8D5B2D;"></span> Парке Культуры</span>
                        </p>
                        <div>
                            <span>ул. Льва Толстого, д. 5, стр. 1 (вход с Несвижского переулка)</span>
                        </div>
                        <div class="info-jobs-clinik" style="margin: 10px 0;">
                            <div class="info-jobs-clinik--item">
                                <img class="" src="https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/park-icon.svg">
                                <span>Бесплатная охраняемая парковка</span>
                            </div>
                        </div>
                        <h3 class="time-jobs-clinik--name">Время работы Центра</h3>
                        <div class="time-jobs-clinik--row">
                            <div class="time-jobs-clinik--item green"><b>Будние дни</b>
                                <span>10:00 до 20:00</span>
                            </div>
                            <div class="time-jobs-clinik--item gray">
                                <b>Суббота, воскресенье</b>
                                <span>выходной</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="map_contact" id="mapConct"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>