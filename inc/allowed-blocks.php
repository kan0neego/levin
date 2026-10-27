<?php
/*
 * Whitelist specific Gutenberg blocks (paragraph, heading, image and lists)
 *
 * @author Misha Rudrastyh
 * @link https://rudrastyh.com/gutenberg/remove-default-blocks.html#allowed_block_types_all
 */
add_filter( 'allowed_block_types_all', 'allowed_block_types', 25, 2 );
 
function allowed_block_types( $allowed_blocks, $editor_context ) {
 
    return array(
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/quote',
        //'core/code',
        'core/list-item',
        'core/table',
        'core/image',
        //'core/gallery',
        //'core/media-text',
        //'core/group',
        //'core/row',
        //'core/stack',
        'core/html',
        'core/shortcode',
        'shortcoder/shortcoder',
        //'advanced-custom-html/advanced-custom-html',
        'lazyblock/faq',
        'lazyblock/video-body',
        'lazyblock/tabs',
        'lazyblock/quote-with-title',
        'lazyblock/caution',
        'lazyblock/no-slug',
        'lazyblock/sovet-vracha',
        'lazyblock/pros-and-cons',
        'lazyblock/stages-big',
        'lazyblock/cards-wide',
        'acf/standards',
        'acf/price-single'
    );
 
}