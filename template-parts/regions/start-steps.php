<?php
$directory = get_template_directory_uri() . '/src/';
$start_steps = [
    [
        'title' => 'Дистанционная диагностика',
        'points' => ['Сделайте <strong>рентген-снимок КТ</strong>', '<strong>Вышлите</strong> снимок на электронную почту Центра', 'Подробно <strong>опишите в письме</strong>, что Вас беспокоит'],
    ],
    [
        'title' => 'Предварительное заключение',
        'points' => ['<strong>Доктор созвонится с Вами</strong> и задаст уточняющие вопросы', 'Составляем один или несколько планов лечения', 'Утверждаем с Вами окончательную тактику и стратегию'],
    ],
    [
        'title' => 'Планирование лечения',
        'points' => ['Планируем лечение в рамках <strong>одного операционного дня</strong>', 'Согласовываем дату, время и финансовые вопросы'],
    ],
];
?>

<div class="grid-list">
    <?php foreach ($start_steps as $step_index => $step) : ?>
    <div class="grid-list-item">
        <div class="start-cards__card">
            <?php if ($step_index === 0) : ?>
            <div class="start-cards__media" aria-hidden="true">
                <img class="start-cards__photo" src="<?php echo $directory; ?>img/start-cards/consult-bg.webp" alt=""
                    width="720" height="555">
                <div class="start-cards__plate">
                    <p class="start-cards__num">.1</p>
                    <img class="start-cards__arrow" src="<?php echo $directory; ?>img/start-cards/arrow.svg" alt=""
                        width="23" height="44">
                </div>
                <div class="start-cards__fade"></div>
            </div>
            <?php elseif ($step_index === 1) : ?>
            <div class="start-cards__media" aria-hidden="true">
                <img class="start-cards__photo" src="<?php echo $directory; ?>img/start-cards/plan.webp" alt=""
                    width="720" height="555">
                <div class="start-cards__plate">
                    <p class="start-cards__num">.2</p>
                    <img class="start-cards__arrow" src="<?php echo $directory; ?>img/start-cards/arrow.svg" alt=""
                        width="23" height="44">
                </div>
                <div class="start-cards__fade"></div>
            </div>
            <?php else : ?>
            <div class="start-cards__media" aria-hidden="true">
                <img class="start-cards__photo" src="<?php echo $directory; ?>img/start-cards/visit.webp" alt=""
                    width="720" height="555">
                <div class="start-cards__plate">
                    <p class="start-cards__num">.3</p>
                    <img class="start-cards__logo" src="<?php echo $directory; ?>img/start-cards/logo.svg" alt=""
                        width="54" height="54">
                </div>
                <div class="start-cards__fade"></div>
            </div>
            <?php endif; ?>
            <div class="start-cards__body">
                <h3 class="start-cards__title"><?php echo esc_html($step['title']); ?></h3>
                <ul class="start-cards__list">
                    <?php foreach ($step['points'] as $point) : ?>
                    <li>
                        <img src="<?php echo $directory; ?>img/start-cards/check.svg" alt="" width="17"
                            height="17">
                        <span><?php echo wp_kses($point, ['strong' => []]); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
