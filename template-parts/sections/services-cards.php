<!-- data-visiblecards для изначального кол-ва карточек -->

<?php
    $limit = 12;
    $n = 0;

    $related_services = get_field('related_services');

    if( $related_services ) { ?>

<div class="section section--gray cards-links-section" data-visiblecards="<?php echo $limit; ?>">
    <div class="cont-container">
        <h2 class="title white">Услуги по направлению</h2>
        <div class="cards-links__container">
            <?php foreach( $related_services as $post ) { setup_postdata($post); $n++; ?>
            <a href="<?php the_permalink(); ?>" class="card-link visible-item">
                <div class="card-link__heading"><?php if ( get_field('title_short') ) { echo get_field('title_short'); } else { the_title(); } ?></div>
                <div class="arrow-button"></div>
            </a>
            <?php } ?>
        </div>
        <?php if($n>$limit) { ?>
        <div class="show-more">Показать ещё</div>
        <?php } ?>
    </div>
</div>
    <?php
    wp_reset_postdata(); ?>
<?php } ?>