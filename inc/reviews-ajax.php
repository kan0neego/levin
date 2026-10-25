<?php

add_action('wp_ajax_get_reviews', 'get_reviews');
add_action('wp_ajax_nopriv_get_reviews', 'get_reviews');

function get_reviews()
{
    // Данные запроса читаем безопасно (дефект SEC-09): без isset были
    // предупреждения PHP 8, а нечисловой offset приводил к TypeError/HTTP 500.
    $type      = isset( $_POST['type'] ) ? sanitize_key( wp_unslash( $_POST['type'] ) ) : '';
    $offset    = isset( $_POST['offset'] ) ? absint( $_POST['offset'] ) : 0;
    $doctor_id = isset( $_POST['doctor_id'] ) ? absint( $_POST['doctor_id'] ) : 0;

    $reviews_args = null;
    // Если тип отзыва доктор, то выводим отзыввы относящиеся только к нему
    // Если тип all выводим все

    if ('doctor' === $type) {
        $reviews_args = array(
            'post_type' => 'otzyvy',
            'post_status' => 'publish', // было внутри meta_query — игнорировалось (LOG-01); вынесено в корень
            'posts_per_page' => 10,
            'offset' => $offset,
            'meta_query' => array(
                array(
                    'key' => 'doctors',
                    'value' => '"' . $doctor_id . '"',
                    'compare' => 'LIKE'
                )
            )
        );
    } else {
        $reviews_args = array(
            'post_type' => 'otzyvy',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 10,
            'offset' => $offset
        );
    }

    $query = new WP_Query($reviews_args);
    $new_reviews = $query->posts;

    foreach ($new_reviews as $new_review) :
        
        if( get_field("author_name", $new_review->ID) ) :
            $new_review->author_name = get_field("author_name", $new_review->ID);
        else :
            $new_review->author_name = 'Пациент';
        endif;

        $new_review->source = get_bloginfo('template_directory') . "/src/img/index/company/" . get_field("source", $new_review->ID) . ".svg";
        $new_review->date = /*date_i18n("j F Y",$new_review->date)*/
        get_the_date('j F Y', $new_review->ID);

        // получить аватарку и вставить массив докторов
        $doctors_array = get_field('doctors', $new_review->ID);
        $doctors = [];
        
        if( is_iterable($doctors_array) ) :
        
            foreach( $doctors_array as $doctor ) :
        
                $doctor->ava = get_field( 'avatar', $doctor->ID );
                array_push($doctors,$doctor);
        
            endforeach;
        endif;

        $new_review->doctors = $doctors;

    endforeach;

    // Делаем проверку, это последние отзывы или нет. Чтобы кнопка загрузить еще пропала
    $reviews_end = false;
    $reviews_args['offset'] = $offset + 10;
    $query = new WP_Query($reviews_args);
    $checkArr = $query->posts;
    if (count($checkArr) == 0) {
        $reviews_end = true;
    }

    // wp_send_json отдаёт чистый JSON с корректным Content-Type: предупреждения
    // PHP больше не могут попасть в тело ответа и сломать JSON.parse на клиенте.
    wp_send_json(array(
        'reviews' => $new_reviews,
        'reviews_end' => $reviews_end,
    ));

}