<?php

/**
 * Single Price Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'price-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Load values and assign defaults.
/*
$title = get_field('testimonial') ?: 'Your testimonial here...';
$caption = get_field('author') ?: 'Author name';
$list_item = get_field('role') ?: 'Author role';
*/

if( have_rows( 'price_single_groups' ) ) {
//if ( get_field( 'price_single_is_open' ) ) $is_open = 'price-open';
?>

<div class="price price-open mt-5 mb-5">
    <div class="price-header"><?php echo get_field( 'price_single_name' ); ?></div>
    <div class="price-wrap">
        
    <?php
    $n=0;
    while( have_rows('price_single_groups') ) : the_row(); $n++; ?>

        <?php if( count( get_field( 'price_single_groups' ) ) > 1 ): ?>
        <div class="price-subheader"><?php the_sub_field( 'price_single_group_name' ); ?></div>
        <?php endif; ?>
        
        <?php
        $price_items = get_sub_field( 'price_single_group_items' );
        foreach( $price_items as $price_item ) :
        
            if ( ! $price_item || get_post_status( $price_item ) !== 'publish' ) { continue; }
        ?>

        <div class="price-item">
            <div class="price-content">
                <div class="price-name">
                    <?php echo get_the_title( $price_item ); ?>
                </div>
                
                <?php if( has_excerpt( $price_item ) ) { ?>
                <div class="price-text"><?php echo get_the_excerpt( $price_item ); ?></div>
                <?php } ?>
            </div>
            <div class="price-price">
                <span>
                    <?php echo get_field( 'cost_value_max', $price_item ) ? '<i>от</i>' : ''; ?>
                    <?php if (get_field( 'cost_value', $price_item )==0) { ?>
                    Бесплатно
                    <?php } else { ?>
                    <?php echo number_format( get_field( 'cost_value', $price_item ), 0, '', ' ' ); ?>  ₽
                    <?php } ?>
                </span>
                <?php if (get_field( 'cost_date_badge', $price_item )) { ?>
                    <span class="price-badge"><?php echo get_field('price_badge', 'option'); ?></span>
                <?php } ?>
                <?php
                if ( get_field( 'cost_value_max', $price_item ) ) { ?>
                <b>до <?php echo number_format( get_field( 'cost_value_max', $price_item ), 0, '', ' ' ); ?> ₽</b>
                <?php } ?>
            </div>
        </div>

        <?php
        endforeach;
    endwhile; ?>
    
    </div>
</div>

<?php
}
?>