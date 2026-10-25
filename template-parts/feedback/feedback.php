<?php
/*
    Шаблон для оценки врача по ссылке из мессенджера
    Генерируется ссылка здесь - https://doctorlevin.ru/wa-link/
    Далее пользователь переходит по уникальной ссылке
    Статистика отзывов отображается по ссылке - https://doctorlevin.ru/stat/
*/

$row = feedback_link_row();

if ( ! $row ) {
    return;
}

$count = (int) $row->link_views + 1;
$wpdb->update(
    'levin_feedback_links',
    array( 'link_views' => $count ),
    array( 'id' => (int) $row->id ),
    array( '%d' ),
    array( '%d' )
);

$doctor_id = $row->doctor_id;
$patient_name = $row->patient_name;
$patient_sex = $row->patient_sex;
$admin = $row->admin_id;
$place = $row->place_id;

$post = get_post($doctor_id); // общая информация о враче

if ( $place == 1 ) { // unv
    //$link_y = "https://yandex.ru/maps/org/doktor_levin/182066545872/reviews/?add-review=true&indoorLevel=1&ll=37.527157%2C55.689730&tab=reviews&z=16.97";
    //$link_g = "https://maps.app.goo.gl/GVc8jDLxXCAod2Bk6";
    $link_pd = "https://prodoctorov.ru/new/rate/lpu/84340/";
    $link_dd = "https://docdoc.ru/clinic/doktor_levin_na_universitete#reviews";
} elseif ( $place == 2 ) { // park
    //$link_y = "https://yandex.ru/maps/org/doktor_levin/1150624676/reviews/?add-review=true&ll=37.588763%2C55.732155&tab=reviews&z=16.97";
    //$link_g = "https://maps.app.goo.gl/GVc8jDLxXCAod2Bk6";
    $link_pd = "https://prodoctorov.ru/new/rate/lpu/72645/";
    $link_dd = "https://docdoc.ru/clinic/doktor_levin_na_parke_kultury#reviews";
}

$doctor_sources = get_field('sources', $doctor_id);

if ( $doctor_sources ) {
    if ( $doctor_sources['prodoctorov'] ) $link_pd = $doctor_sources['prodoctorov'];
    if ( $doctor_sources['docdoc'] ) $link_dd = $doctor_sources['docdoc'];
}

$doctor_photo = get_field('clipped_photo_list', $doctor_id);
$doctor_name = explode(" ", $post->post_title);
$doctor_cat = mb_strtolower($post->post_excerpt);

?>

<main class="main"> 
    <div class="section-thoughts">
        <div class="section-thoughts__bubble thoughts-bubble">
            <div class="thoughts-bubble__wrap wrap--720px">
                <div class="thoughts-bubble__header wrap wrap--720px">
                    <h1 class="thoughts-bubble__title">Нам важно ваше мнение!</h1>
                </div>
                <picture class="thoughts-bubble__picture picture">
                    <source type="image/svg+xml" srcset="<?php echo $doctor_photo; ?>">
                    <img alt="<?php echo $post->post_title; ?>" class="picture__img" loading="lazy" src="<?php echo $doctor_photo; ?>" srcset="<?php echo $doctor_photo; ?>">
                </picture>
                <div class="thoughts-bubble__text-box wrap wrap--720px">
                    <p class="thoughts-bubble__name">
                        <span><?php echo $doctor_name[0] ?? ''; ?></span> 
                        <?php echo ($doctor_name[1] ?? '') . ' ' . ($doctor_name[2] ?? ''); ?>
                    </p>
                    <p class="thoughts-bubble__description">
                        Ваш лечащий врач, <?php echo $doctor_cat; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="section-thoughts__appeal appeal">
            <div class="appeal__wrap wrap wrap--720px">
                <div class="appeal__text-box">
                    <p class="appeal__title">
                        <?php if ( $patient_sex == 'female' ) { echo 'Уважаемая'; } else { echo 'Уважаемый'; } ?>, <?php echo $patient_name; ?>!
                    </p>
                    <p class="appeal__description">
                        Спасибо Вам за то, что помогаете нам стать лучше ❤️
                    </p>
                    <p class="appeal__description">
                        Нажмите «Понравилось», если у Вас положительные впечатления о лечении в ЦПС «Доктор Левин». Если есть замечания, напишите, пожалуйста, Директору
                    </p>
                    <p class="appeal__signature">
                        С уважением
                        <?php
                            echo ($doctor_name[0] ?? '');
                        if ( ! empty($doctor_name[1]) ) {
                            echo ' ' . mb_strtoupper(mb_substr(trim($doctor_name[1]), 0, 1)) . '.';
                        }
                        if ( ! empty($doctor_name[2]) ) {
                            echo mb_strtoupper(mb_substr(trim($doctor_name[2]), 0, 1)) . '.';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="section-thoughts__btns wrap wrap--720px">
            <a href="#convenient-platforms" class="section-thoughts__btn btn-n btn-n--blue">Понравилось 👍🏻</a>
            <a href="#mail-manager" class="section-thoughts__btn btn-n btn-n--crystal">Написать директору</a>
        </div>
    </div>
    <div id="#convenient-platforms" class="section-convenient-platforms section-thoughts-disabled">
        <!-- <div class="section-convenient-platforms section-convenient-platforms--white"> -->
        <div class="section-convenient-platforms__wrap wrap wrap--720px">
            <h2 class="section-convenient-platforms__title">Где Вам удобнее оставить отзыв?</h2>
            <div class="section-convenient-platforms__list convenient-platforms">
                <!--
                <a href="<?php //echo $link_y; ?>" class="convenient-platform">
                    <picture class="convenient-platform__picture">
                        <img alt="Яндекс" class="picture__img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/src/img/convenient-platform-yandex.svg" srcset="<?php echo get_template_directory_uri(); ?>/src/img/convenient-platform-yandex.svg">
                    </picture>
                </a>
                <a href="<?php //echo $link_g; ?>" class="convenient-platform">
                    <picture class="convenient-platform__picture">
                        <img alt="google" class="picture__img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/src/img/convenient-platform-google.svg" srcset="<?php echo get_template_directory_uri(); ?>/src/img/convenient-platform-google.svg">
                    </picture>
                </a>
                -->
                <?php if ( isset($link_pd) ) : ?>
                    <a href="<?php echo @$link_pd; ?>" class="convenient-platform">
                        <picture class="convenient-platform__picture">
                            <img alt="ПроДокторов" class="picture__img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/src/img/portals/prodoctorov.svg" srcset="<?php echo get_template_directory_uri(); ?>/src/img/portals/prodoctorov.svg">
                        </picture>
                    </a>
                <?php endif; ?>
                <?php if ( isset($link_dd) ) : ?>
                    <a href="<?php echo $link_dd; ?>" class="convenient-platform">
                        <picture class="convenient-platform__picture">
                            <img alt="СберЗдоровье" class="picture__img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/src/img/portals/sberhealth.svg" srcset="<?php echo get_template_directory_uri(); ?>/src/img/portals/sberhealth.svg">
                        </picture>
                    </a>
                <?php endif; ?>
            </div>
            <!--
            <div class="section-convenient-platforms__footer">
                <p>Для размещения отзыва Вам понадобится действующий аккаунт Яндекс.</p>
                <p>Спасибо за уделенное нам время!</p>
            </div>
            -->
        </div>
    </div>
    <div id="#mail-manager" class="section-mail-manager section-thoughts-disabled">
        <div class="section-mail-manager__box mail-manager-box">
            <div class="mail-manager-box__header wrap wrap--720px">
                <h2 class="mail-manager-box__title">Написать директору</h2>
            </div>
            <picture class="mail-manager-box__picture picture">
                <source type="image/svg+xml" srcset="<?php echo get_template_directory_uri(); ?>/src/img/manager-box-doc.webp">
                <img alt="Левин Дмитрий Валерьевич" class="picture__img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/src/img/manager-box-doc.webp" srcset="<?php echo get_template_directory_uri(); ?>/src/img/manager-box-doc.webp">
            </picture>
            <div class="mail-manager-box__text-box wrap wrap--720px">
                <img class="mail-manager-box__icon" alt="" src="<?php echo get_template_directory_uri(); ?>/src/img/shield-check.svg" loading="lazy"> 
                <p class="mail-manager-box__quote">
                    Я очень ценю Ваше доверие к нам
                </p>
                <p class="mail-manager-box__text">
                    Если есть любой вопрос или комментарий о работе Центра, свяжитесь с нами для решения проблемы или оценки. Спасибо за Вашу доброту и терпение!
                </p>
                <p class="mail-manager-box__name">
                    Дмитрий Левин
                </p>
                <p class="mail-manager-box__votation">
                    Основатель и главный врач Центра
                </p>
            </div>
        </div>
        <div class="section-mail-manager__form-wrap wrap wrap--720px">
            <div class="form-manager-n">
                <?php echo do_shortcode( '[contact-form-7 id="20277" title="Страница оставить отзыв"]' ); ?>
            </div>
        </div>
    </div>
</main>

<script>
    const thoughtsBtns = document.querySelectorAll(`.section-thoughts__btn`)
    const thoughtsDisabled = document.querySelectorAll(`.section-thoughts-disabled`)
    
    thoughtsBtns && accordionThoughts(thoughtsBtns)

    function accordionThoughts(btns) {
        for (const btn of btns) {
            btn.addEventListener(`click`, (event) => {
                event.preventDefault()
                btn.closest(`.section-thoughts`).classList.add(`hide`)
                const hash = btn.attributes.href.value
                thoughtsDisabled.forEach((element) => {
                    element.classList.remove(`active`)
                })
                document.getElementById(hash).classList.add(`active`)
                window.scrollTo(0, document.getElementById(hash).offsetTop)
            })
        }
    }
</script>
