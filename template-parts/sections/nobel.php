<?php
$directory = get_template_directory_uri() . '/src/';
$items = ['Фирменная пожизненная гарантия Dr. Levin Lifetime Warranty', 'Полный пакет оригинальных лекарственных препаратов', 'Письменные послеоперационные рекомендации', 'Паспорт Nobel Biocare на каждый установленный имплантат'];
?>

<div class="nobel" id="nobelcenter">
    <div class="container-2xl">
        <div class="nobel__layout">
            <div class="nobel__media">
                <span class="nobel__glow" aria-hidden="true"></span>
                <div class="nobel__frame">
                    <img class="nobel__photo" src="<?php echo esc_url($directory . 'img/nobel/certificate.webp'); ?>"
                        alt="Сертификат Центра клинического мастерства Nobel Biocare" width="909" height="642"
                        loading="lazy" decoding="async">
                </div>
            </div>
            <div class="nobel__copy">
                <h2 class="nobel__title">Центр клинического<br>мастерства Nobel Care</h2>
                <p class="nobel__text">
                    В нашем Центре используются только оригинальные<br>
                    Оригинальные комплектующие — гарант долгой службы<br>
                    Мы не имеем права рисковать и использовать неоригинальные<br>
                    наших врачей по установке имплантов
                </p>
                <ul class="nobel__list">
                    <?php foreach ($items as $item) : ?>
                    <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a class="nobel__btn" href="<?php echo esc_url(home_url('/implanty-nobel-biocare/')); ?>">Подробнее</a>
            </div>
        </div>
    </div>
</div>
