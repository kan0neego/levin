<?php
/*
 *  Шаблон вывода секции соц. сетей
 */

$wa_number = get_field('whatsapp', 'option');
$vk_link = get_field('vk_link', 'option');
$tg_channel_link = get_field('tg_channel_link', 'option');
$youtube_link = get_field('youtube_link', 'option');
$rutube_link = get_field('rutube_link', 'option');
$dzen_link = get_field('dzen_link', 'option');
?>

<div class="site-menu__socialmedia site-menu__segment">
    <?php if( $vk_link ) : ?>
        <a target="_blank" href="<?php echo esc_url($vk_link); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_vk" aria-label="VK"></a>
    <?php endif; ?>
    <?php if( $wa_number ) : ?>
        <a target="_blank" href="https://wa.me/<?php echo esc_url($wa_number); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_wa" aria-label="WhatsApp"></a>
    <?php endif; ?>
    <?php if( $tg_channel_link ) : ?>
        <a target="_blank" href="<?php echo esc_url($tg_channel_link); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_telegram" aria-label="Telegram"></a>
    <?php endif; ?>
    <?php if( $rutube_link ) : ?>
        <a target="_blank" href="<?php echo esc_url($rutube_link); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_rutube" aria-label="Rutube"></a>
    <?php endif; ?>
    <?php if( $youtube_link ) : ?>
        <a target="_blank" href="<?php echo esc_url($youtube_link); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_youtube" aria-label="YouTube"></a>
    <?php endif; ?>
    <?php if( $dzen_link ) : ?>
        <a target="_blank" href="<?php echo esc_url($dzen_link); ?>" rel="nofollow" class="site-menu__social-icon site-menu__social-icon_dzen" aria-label="Дзен"></a>
    <?php endif; ?>
</div>