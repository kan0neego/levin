<?php 
$doctor = get_post_author();

if( $doctor ) : 
    $doctor_name    = get_the_title($doctor->ID);
    $doctor_link    = get_permalink($doctor->ID);
    $doctor_caption = get_the_excerpt($doctor->ID);
    $doctor_avatar  = get_field('avatar', $doctor->ID);
?>
<div class="author-article">
    <a href="<?php echo esc_url($doctor_link); ?>" class="author-article__left author-article__link">
        <div class="author-article__avatar">
            <?php if ( $doctor_avatar ) : ?>
                <img src="<?php echo esc_url($doctor_avatar); ?>" alt="<?php echo esc_attr($doctor_name); ?>" loading="lazy">
            <?php endif; ?>
        </div>
        <div class="author-article__content">
            <div class="author-article__name"><?php echo esc_html($doctor_name); ?></div>
            <div class="author-article__text">Автор статьи. <?php echo esc_html($doctor_caption); ?></div>
        </div>
    </a>
</div>
<?php endif; ?>