<?php
/*
	Шаблон Главной страницы	
 */

get_header();
?>

<?php get_template_part('template-parts/index/index-welcome'); ?>

<?php get_template_part('template-parts/sections/awards-image'); ?> 

<?php get_template_part('template-parts/sections/awards-badges'); ?> 

<?php //get_template_part('template-parts/sections/startsmile'); ?> 

<?php get_template_part('template-parts/index/index-quote'); ?>

<?php get_template_part('template-parts/index/index-services'); ?>

<?php get_template_part('template-parts/index/index-doctors'); ?>

<?php get_template_part('template-parts/index/index-standards'); ?>

<?php get_template_part('template-parts/sections/awards-cards'); ?> 

<?php get_template_part('template-parts/index/index-rating'); ?>

<?php get_footer();