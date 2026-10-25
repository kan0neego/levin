<?php
/**
 * Yoast SEO theme integration.
 *
 * @package levin
 */
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );
function yoast_seo_breadcrumb_append_link( $links ) {
	global $post;    
	
	if ( !is_404() ) {

		/*if ( get_post_type( get_the_ID() ) == 'post' ) {
			$breadcrumb[] = array(
				'url' => get_permalink( 1136 ),
				'text' => get_the_title( 1136 ),
			);
			array_splice( $links, 1, -2, $breadcrumb );
		}*/
		if ( get_post_type( get_the_ID() ) == 'services' ) {
			$breadcrumb[] = array(
				'url' => get_permalink( 11708 ),
				'text' => get_the_title( 11708 ),
			);
			array_splice( $links, 1, -3, $breadcrumb );
		}
		if ( get_post_type( get_the_ID() ) == 'cases' ) {
			$breadcrumb[] = array(
				'url' => get_permalink( 34812 ),
				'text' => get_the_title( 34812 ),
			);
			array_splice( $links, 1, -2, $breadcrumb );
		}
		if ( get_post_type( get_the_ID() ) == 'doctors' ) {
			$breadcrumb[] = array(
				'url' => get_permalink( 5526 ),
				'text' => get_the_title( 5526 ),
			);
			array_splice( $links, 1, -2, $breadcrumb );
		}

	}

    return $links;
}


/**
 * Remove date published and date modified from the Yoast SEO plugin schema
 *
 * @param array $graph_piece Yoast schema pieces.
 *
 * @return array
 */
function yoast_remove_published_modified_dates($graph_piece)
{
    unset($graph_piece['datePublished'], $graph_piece['dateModified']);

    return $graph_piece;
}
add_filter('wpseo_schema_webpage', 'yoast_remove_published_modified_dates');
add_filter('wpseo_schema_article', 'yoast_remove_published_modified_dates');

add_filter('wpseo_frontend_presenter_classes', function ($filter) {
    return array_diff($filter, ['Yoast\WP\SEO\Presenters\Open_Graph\Article_Published_Time_Presenter', 'Yoast\WP\SEO\Presenters\Open_Graph\Article_Modified_Time_Presenter']);
});

/**
 * Theme breadcrumbs via Yoast. Separator arrows come from CSS on `.breadcrumbs__link`.
 *
 * @param string $before Markup before the crumb list.
 * @param string $after  Markup after the crumb list.
 */
function levin_breadcrumbs($before = '<nav class="breadcrumbs">', $after = '</nav>')
{
    if (!function_exists('yoast_breadcrumb')) {
        return;
    }

    yoast_breadcrumb($before, $after);
}

add_filter('wpseo_breadcrumb_separator', 'levin_yoast_breadcrumb_separator');
/**
 * Drop Yoast's text separator; theme CSS draws arrows.
 *
 * @return string
 */
function levin_yoast_breadcrumb_separator()
{
    return '';
}

add_filter('wpseo_breadcrumb_single_link', 'levin_yoast_breadcrumb_link', 10, 2);
/**
 * Match theme markup: every crumb is `.breadcrumbs__link`.
 *
 * @param string $link_output Yoast HTML for one crumb.
 * @param array  $link        Crumb data.
 *
 * @return string
 */
function levin_yoast_breadcrumb_link($link_output, $link)
{
    $text = isset($link['text']) ? $link['text'] : '';

    if (!empty($link['url']) && false !== strpos($link_output, '<a ')) {
        if (false === strpos($link_output, 'class=')) {
            $link_output = str_replace('<a ', '<a class="breadcrumbs__link" ', $link_output);
        }

        return $link_output;
    }

    return '<span class="breadcrumbs__link">' . $text . '</span>';
}

// Убираем мета-тег author
add_filter( 'wpseo_meta_author', '__return_false' );

// Убрать article:author из Open Graph
add_filter( 'wpseo_opengraph_author_facebook', '__return_false' );

// Убрать автора из схемы Person в JSON-LD (если нужно)
add_filter( 'wpseo_schema_needs_author', '__return_false' );

// Удаляем автора из схемы Article (вариант с принудительной очисткой)
add_filter( 'wpseo_schema_article', 'remove_author_from_yoast_article_schema' );
function remove_author_from_yoast_article_schema( $data ) {
    // Вместо unset явно задаем пустое значение
    if ( isset( $data['author'] ) ) {
        $data['author'] = '';
    }
    return $data;
}