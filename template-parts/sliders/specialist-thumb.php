<?php
/**
 * Тумблер врача для слайдера специалистов.
 *
 * @package theme
 */

$doctor_id         = (int) $args['post_id'];
$doctor_title      = get_the_title( $doctor_id );
$doctor_speciality = get_the_excerpt( $doctor_id );
$image_url         = get_field( 'avatar', $doctor_id );

if ( '' === $doctor_id || empty( $doctor_id ) ) {
    return;
}

?>

<div class="specialist-thumb-card">
    <div class="avatar specialist-thumb-card__avatar">
        <div class="avatar__img">
            <?php if ( $image_url ) : ?>
                <img width="62" height="62" src="<?php echo esc_url( $image_url ); ?>" />
            <?php endif; ?>
        </div>
        <div class="specialist-thumb-card__meta">
            <div class="meta-title">
                <?php echo esc_html( $doctor_title ); ?>
            </div>
            <div class="meta-desc">
                <?php echo esc_html( $doctor_speciality ); ?>
            </div>
        </div>
    </div>
</div>
