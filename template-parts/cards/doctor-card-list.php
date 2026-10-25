<?php 
/*
 *  Шаблон карточки Врача для Списка Врачей
 */

$filterClass = '';
if ( isset( $args['class'] ) ) {
    $filterClass = ' '.$args['class'];
}

$doctor_id = isset( $args['doctor_id'] ) ? $args['doctor_id'] : get_the_ID();

?>
<<?php echo ( get_field('is_active') ) ? 'a href="'.get_permalink().'"' : 'div'; ?> class="doctor-item doctor-list__section<?php echo $filterClass; ?>">
    <div class="doctor-item__image">
        <img loading="lazy" src="<?php echo get_field('clipped_photo_list', $doctor_id); ?>" alt="<?php the_title(); ?>">
    </div>
    <div class="doctor-item__content">
        <div class="doctor-item__header">
            <div class="doctor-item__post"><?php the_excerpt(); ?></div>
            <?php if( get_field( "experience" ) ): ?>
                <div class="doctor-item__badge">
                    Стаж <?php $exp = date('Y')-get_field('experience'); echo num_decline($exp, 'год, года, лет'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="doctor-item__name"><?php the_title(); ?></div>
        <?php if( get_field( "short_text" ) ): ?>
            <div class="doctor-item__text"><span><?php echo get_field('short_text'); ?></span></div>
        <?php endif; ?>
        <?php if(get_field('is_active')) : ?>
            <div class="doctor-item__button-wrap">
                <div href="<?php the_permalink(); ?>" class="doctor-item__button">Подробнее о враче</div>
            </div>
        <?php else : ?>
            <div class="doctor-item__button-wrap">
                <div data-toggle="modal" data-target="#myModal2" class="doctor-item__button">Записаться на прием</div>
            </div>
        <?php endif; ?>
    </div>
</<?php echo ( get_field('is_active') ) ? 'a' : 'div'; ?>>