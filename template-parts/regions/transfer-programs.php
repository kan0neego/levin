<?php
$transfer_directory = get_template_directory_uri() . '/src/img/transfer-programs/';
$steps = [
    [
        'num' => '1',
        'photo' => 'phone',
        'label' => '<strong>Дистанционная</strong><br>консультация врача<br>онлайн',
    ],
    [
        'num' => '2',
        'photo' => 'car',
        'label' => '<strong>Организация</strong><br>приезда и<br>размещения',
        'width' => 2048,
        'height' => 1360,
    ],
    [
        'num' => '3',
        'photo' => 'chair',
        'label' => '<strong>Восстановление</strong><br>зубов за<br>1-3 дня',
        'width' => 1011,
        'height' => 1156,
    ],
    [
        'num' => '4',
        'photo' => 'hands',
        'label' => '<strong>Забота и уход</strong><br>во время лечения',
        'width' => 1088,
        'height' => 781,
    ],
    [
        'num' => '5',
        'photo' => 'plane',
        'label' => '<strong>Проводы</strong><br>домой и поддержка<br>после',
        'width' => 1024,
        'height' => 1024,
    ],
];
$allowed = ['strong' => [], 'br' => []];
?>

<div class="transfer-programs__scene">
    <div class="transfer-programs__stage">
        <?php foreach ($steps as $step) : ?>
        <div class="transfer-programs__card transfer-programs__card--<?php echo esc_attr($step['num']); ?>">
            <div class="transfer-programs__gem">
                <div class="transfer-programs__face">
                    <?php if ($step['photo'] === 'phone') : ?>
                    <div class="transfer-programs__phone" aria-hidden="true">
                        <img class="transfer-programs__doctor" src="<?php echo esc_url($transfer_directory . 'doctor.webp'); ?>" alt="" width="838"
                            height="1024" loading="lazy" decoding="async">
                        <img class="transfer-programs__notch" src="<?php echo esc_url($transfer_directory . 'phone-top.svg'); ?>" alt="" width="77"
                            height="18">
                        <img class="transfer-programs__call" src="<?php echo esc_url($transfer_directory . 'phone-call.svg'); ?>" alt="" width="69"
                            height="69">
                    </div>
                    <?php else : ?>
                    <img class="transfer-programs__photo transfer-programs__photo--<?php echo esc_attr($step['photo']); ?>"
                        src="<?php echo esc_url($transfer_directory . $step['photo'] . '.webp'); ?>" alt="" width="<?php echo esc_attr($step['width']); ?>"
                        height="<?php echo esc_attr($step['height']); ?>" loading="lazy" decoding="async">
                    <?php endif; ?>
                    <div class="transfer-programs__copy">
                        <p class="transfer-programs__num"><?php echo esc_html($step['num']); ?></p>
                        <p class="transfer-programs__label"><?php echo wp_kses($step['label'], $allowed); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
