<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'dc-prose' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dc-prose';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$doctor = get_field('doctor');

if($doctor && !$is_preview) {

    $title_alt = $doctor->post_title;
    $title = explode(" ", $doctor->post_title);
    $title = '<span>'.$title[0].'</span>'.' '.$title[1].' '.$title[2];

    $experience = date('Y')-get_field('experience', $doctor->ID);
    $experience = 'Cтаж '.num_decline($experience, 'год, года, лет');

    if( $doctor->post_excerpt ) $caption = $doctor->post_excerpt;

    if(get_field('is_custom_desc')) $desc = get_field('desc');
    else $desc = get_field('banner_text', $doctor->ID);

    $photo_src = get_field('clipped_photo_block_single', $doctor->ID);

    if( get_field('is_active', $doctor->ID) ) {
        $button_link = get_permalink($doctor->ID);
        $button_attr = 'target="_blank"';
        $button_text = 'Подробнее о враче';
    } else {
        $button_link = '#';
        $button_attr = 'data-toggle="modal" data-target="#myModal2"';
        $button_text = 'Записаться на прием';
    }
    
    /*
    if ( get_field('badge', $doctor->ID) ) {
        $badge = get_field('badge', $doctor->ID);
    }
    */
?>

    <div class="<?php echo esc_attr($className); ?>">
        <div class="dc-prose__img-wrapper">
            <div class="dc-prose__image">
                <img alt="<?php echo $title_alt; ?>" src="<?php echo $photo_src; ?>">
            </div>
        </div>
        <div class="dc-prose__content">
            <div class="dc-prose__header">
                <div class="dc-prose__name">
                    <?php echo $title; ?>
                </div>
                <div class="dc-prose__snippet">
                    <?php echo $caption; ?>
                </div>
            </div>
            <div class="dc-prose__b-wr">
                <div class="dc-prose__b">
                    <?php echo esc_html( $experience ); ?>
                </div>
            </div>
            <div class="dc-prose__text">
                <?php echo $desc; ?>
            </div>
            <div class="dc-prose__footer">
                <a href="<?php echo $button_link; ?>" <?php echo $button_attr; ?> class="section-button">
                    <?php echo $button_text; ?>
                </a>
            </div>
        </div>
    </div>

<?php

} elseif ( $is_preview ) { // доктор не выбран, превью (инициализация добавления блока)
    
    echo '<div style="width:100%;background-color:#EBEDF0;color:#A5B1BD;text-align:center;padding:60px 0;font-size:2em"><div>Один врач</div><div style="font-size:0.5em">Нажимте для настройки...</div></div>';

}

?>
