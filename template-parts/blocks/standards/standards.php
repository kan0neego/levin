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
$id = 'standards-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'standards';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$title = get_field('testimonial') ?: 'Your testimonial here...';
$caption = get_field('author') ?: 'Author name';
$list_item = get_field('role') ?: 'Author role';

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<?php

    if( have_rows('standards')) {
        $n=0;
        while ( have_rows('standards') ) { the_row();
            $n++;
        ?>

        <div class="row row_center row_sm_center <?=($n %2 == 0) ? "reverse" : "" ?>">
            <div class="col col-sm-5">
                <img class="d-block mx-auto" src="<?php echo get_template_directory_uri()."/image/standards/".get_sub_field('standard_item_image').".png"; ?>" alt="<?php echo strip_tags( get_sub_field('standard_item_title') ); ?>">
            </div>
            <div class="col col-sm-7">
                <h3 class="heading heading_h2"><?php the_sub_field('standard_item_title'); ?></h3>
                <?php
                if(get_sub_field('standard_item_caption')): ?>
                <p class="text  text_medium">
                    <?php the_sub_field('standard_item_caption'); ?>
                </p>
                <?php
                endif; ?>
                
                <ul class="list text mb-30">
                    <?php if( have_rows('standard_item_list')): ?>
                        <?php while ( have_rows('standard_item_list') ) : the_row();  ?>
                            <li><?php the_sub_field('standard_item_list_item'); ?></li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <!--<a href="/lechenie-vo-sne/" class="section-button">
            Подробнее
            </a>-->
                </ul>
            </div>
        </div>

        <?php
        }
    
    } else {
        // default values
    ?>
        
        <div class="row row_center row_sm_center">
            <div class="col col-sm-5">
                <img class="d-block mx-auto" src="<?php echo get_template_directory_uri(); ?>/image/standards/blank-2.png">
            </div>
            <div class="col col-sm-7">
                <h2 class="heading heading_h2 mb-30">Стандарт лечения — <strong>заголовок</strong></h2>
                <p class="text  text_medium mb-30">
                    Описание стандарта ...
                </p>
                <ul class="list text mb-30">
                    <li>Элемент списка ...</li>
                </ul>
            </div>
        </div>

    <?php

    }

?>
</div>

