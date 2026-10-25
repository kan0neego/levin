<?php
/**
 * Карточка кейса для Списка кейсов
 *
 * @package levin
 */

$categories        = get_the_category();
$related_doctors   = get_field( 'case_related_doctors' );
$case_image_before = get_field( 'case_photo_before' );
$case_image_after  = get_field( 'case_photo_after' );
$case_image_single = get_acf_image_html( get_field( 'case_photo_single' ), 'full', get_the_title() . ' - фото' );
?>

<div class="case-card">
    <div class="case-card__image-wrapper">
        <a href="<?php the_permalink(); ?>" class="stretch-link"></a>
        <?php if ( $case_image_before && $case_image_after ) : ?>
            <?php if ( $case_image_before ) : ?>
                <img width="550" height="336" src="<?php echo esc_url( $case_image_before['url'] ); ?>" alt="<?php the_title(); ?> - фото до" loading="lazy">
            <?php endif; ?>
            <?php if ( $case_image_after ) : ?>
                <img width="550" height="336" src="<?php echo esc_url( $case_image_after['url'] ); ?>" alt="<?php the_title(); ?> - фото после" loading="lazy">
            <?php endif; ?>
            <div class="case-card__badge"></div>
        <?php elseif ( $case_image_single ) : ?>
            <?php echo $case_image_single //phpcs:ignore ?>
        <?php endif; ?>
    </div>
    <div class="case-card__content-wr">
        <div class="case-card__badge-wrapper">
            <?php foreach ( $categories as $category ) : ?>
                <div class="case-card__badge-item">
                    <?php echo esc_html( $category->name ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="case-card__content">
            <div class="case-card__header">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php the_title(); ?>
                </a>
            </div>
            <?php if ( get_field( 'case_problem_text' ) ) : ?>
                <div class="case-card__paragraph">
                    <div class="case-card__paragraph-header">
                        Клинический случай
                    </div>
                    <div class="case-card__paragraph-text">
                        <?php the_field( 'case_problem_text' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( get_field( 'case_treatment_text' ) ) : ?>
                <div class="case-card__paragraph">
                    <div class="case-card__paragraph-header">
                        Проведенное лечение
                    </div>
                    <div class="case-card__paragraph-text">
                        <?php the_field( 'case_treatment_text' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( get_field( 'case_description' ) ) : ?>
                <div class="case-card__description">
                    <div class="case-card__description-text">
                        <?php the_field( 'case_description' ); ?>
                    </div>
                </div>
            <?php endif; ?> 
            <?php if ( $related_doctors ) : ?>
                <div class="case-card__paragraph">
                    <div class="case-card__paragraph-header">
                        Лечащие врачи
                    </div>
                    <div class="case-card__author-row">
                        <?php foreach ( $related_doctors as $doctor ) : ?>
                            <div class="case-card__author-thumb">
                                <div class="avatar">
                                    <div class="avatar__img">
                                        <img width="62" height="62" src="<?php the_field( 'avatar', $doctor->ID ); ?>" alt="<?php echo esc_attr( get_the_title( $doctor->ID ) ); ?>" loading="lazy">
                                    </div>
                                    <div class="avatar__meta">
                                        <a href="<?php the_permalink( $doctor->ID ); ?>" class="avatar__title stretch-link">
                                            <?php echo esc_html( get_the_title( $doctor->ID ) ); ?>
                                        </a>
                                        <div class="avatar__description">
                                            <?php echo esc_html( get_the_excerpt( $doctor->ID ) ); ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="case-card__footer">
            <a href="<?php the_permalink(); ?>" class="btn-n btn-n--blue">
                Читать историю
            </a>
        </div>
    </div>
</div>
