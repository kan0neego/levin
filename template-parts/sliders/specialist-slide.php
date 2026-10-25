<?php
/**
 * Баннер врача для слайдера специалистов.
 *
 * @package theme
 */

$doctor_id = get_the_ID();

$experience_start = function_exists( 'get_field' ) ? get_field( 'experience', $doctor_id ) : '';
$experience_years = $experience_start ? (int) gmdate( 'Y' ) - (int) $experience_start : 0;

$doctor_title       = get_the_title( $doctor_id );
$doctor_speciality  = get_the_excerpt( $doctor_id );
$doctor_description = get_field( 'banner_text', $doctor_id );

$doctor_permalink = get_permalink( $doctor_id );
$doctor_is_active = (bool) get_field( 'is_active', $doctor_id );

$experience_text = num_decline( $experience_years, 'год, года, лет' );
$picture_url     = get_field( 'clipped_photo_list', $doctor_id );
?>

<div class="banner-specialist">
    <div class="banner-specialist__content-container">
        <?php if ( $experience_years > 0 ) : ?>
        <div class="banner-specialist__badges">
            <div class="banner-specialist__badge-exp">
                <?php echo esc_html( $experience_text . ' опыта' ); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="banner-specialist__content">
            <div class="banner-specialist__title">
                <?php echo esc_html( $doctor_title ); ?>
            </div>
            <?php if ( $doctor_speciality ) : ?>
                <div class="banner-specialist__spec">
                    <?php echo esc_html( $doctor_speciality ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $doctor_description ) : ?>
                <div class="banner-specialist__desc">
                    <?php echo wp_kses_post( $doctor_description ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="banner-specialist__btn-container">
            <button type="button" class="btn-n btn-n--blue banner-specialist__button" data-toggle="modal" data-target="#myModal2">
                Записаться на прием
            </button>
            <?php if ( $doctor_is_active && $doctor_permalink ) : ?>
                <a href="<?php echo esc_url( $doctor_permalink ); ?>"
                    class="btn-n btn-n--white banner-specialist__button">
                    О враче
                </a>
            <?php endif; ?>
        </div>
    </div>
    <figure class="banner-specialist__img-wrapper">
        <picture>
            <img 
                src="<?php echo esc_url( $picture_url ); ?>" alt="<?php the_title(); ?>"
                class="banner-specialist__img"
                loading="lazy"
            />
        </picture>
    </figure>
</div>
