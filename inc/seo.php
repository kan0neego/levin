<?php
// Закрываем от индексации в head страницы с параметрами
// 1. Меняем метатег Yoast SEO внутри самой страницы
add_filter('wpseo_robots', 'yoast_noindex_all_parameters');
function yoast_noindex_all_parameters($robots_string) {
    if (!empty($_SERVER['QUERY_STRING'])) {
        // Полностью заменяем строку Yoast на noindex
        return 'noindex, follow';
    }
    return $robots_string;
}

// 2. Оставляем HTTP-заголовок для подстраховки
add_action('send_headers', 'header_noindex_all_parameters');
function header_noindex_all_parameters() {
    if (!empty($_SERVER['QUERY_STRING'])) {
        header('X-Robots-Tag: noindex, follow', true);
    }
}