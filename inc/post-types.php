<?php
/*----------  Добавление разделов  ----------*/
add_action('init', 'custom_posts');
function custom_posts() {
    // Врачи
    $labels = array(
        'name'                => 'Врачи',
        'singular_name'       => 'Врач',
        'menu_name'           => 'Врачи',
        'all_items'           => 'Все врачи',
        'add_new'             => 'Добавить',
        'add_new_item'        => 'Добавить врача',
        'edit'                => 'Редактировать',
        'edit_item'           => 'Редактирование врача',
        'new_item'            => 'Новые врачи',
        'view'                => 'Просмотр',
        'view_item'           => 'Просмотр',
        'search_items'        => 'найти',
        'not_found'           => 'Врач не найден',
        'not_found_in_trash'  => 'Врач в корзине не найдена',
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Врачи',
        'hierarchical'        => false,
        'public'              => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'map_meta_cap'        => true,
        'has_archive'         => false,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'doctors', 'with_front' => false),
        'capability_type'     => 'page',
        'show_in_rest' => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'custom-fields'),
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-businessperson',   
    );
    register_post_type('doctors', $args);

    // Фото Работ
    $labels = array(
        'name'                => 'Фото работ',
        'singular_name'       => 'Фото работ',
        'menu_name'           => 'Фото работ',
        'all_items'           => 'Все Фото работ',
        'add_new'             => 'Добавить',
        'add_new_item'        => 'Добавить Новые Фото работ',
        'edit'                => 'Редактировать',
        'edit_item'           => 'Редактирование',
        'new_item'            => 'Новые Фото работ',
        'view'                => 'Просмотр',
        'view_item'           => 'Просмотр',
        'search_items'        => 'найти',
        'not_found'           => 'Работа не найдена',
        'not_found_in_trash'  => 'Работа в корзине не найдена',
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Фото работ',
        'hierarchical'        => false,
        'public'              => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'map_meta_cap'        => true,
        'has_archive'         => false,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'portfolio'),
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'supports'            => array('title', 'page-attributes', 'custom-fields'),
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-images-alt2',
    );
    register_post_type('works_foto', $args);

    // Отзывы
    $labels = array(
        'name'                => 'Отзывы',
        'singular_name'       => 'Отзывы',
        'menu_name'           => 'Отзывы',
        'all_items'           => 'Все Отзывы',
        'add_new'             => 'Добавить',
        'add_new_item'        => 'Добавить новый Отзыв',
        'edit'                => 'Редактировать',
        'edit_item'           => 'Редактирование',
        'new_item'            => 'Новые Отзывы',
        'view'                => 'Просмотр',
        'view_item'           => 'Просмотр',
        'search_items'        => 'найти',
        'not_found'           => 'Отзыв не найден',
        'not_found_in_trash'  => 'Отзыв в корзине не найдена',
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Отзывы',
        'hierarchical'        => false,
        'public'              => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'map_meta_cap'        => true,
        'has_archive'         => false,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'otzyvy'),
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'supports'            => array('title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-status',
    );
    register_post_type('otzyvy', $args);

    // СМИ
    $labels = array(
        'name'                => 'Публикации в СМИ',
        'singular_name'       => 'Публикации в СМИ',
        'menu_name'           => 'Пресса о нас',
        'all_items'           => 'Все публикации',
        'add_new'             => 'Добавить',
        'add_new_item'        => 'Добавить новую Публикацию в СМИ',
        'edit'                => 'Редактировать',
        'edit_item'           => 'Редактирование',
        'new_item'            => 'Новые Публикации в СМИ',
        'view'                => 'Просмотр',
        'view_item'           => 'Просмотр',
        'search_items'        => 'найти',
        'not_found'           => 'Публикация не найдена',
        'not_found_in_trash'  => 'Публикация в корзине не найдена',
    );
    $args = array(
        'labels'              => $labels,
        'description'         => 'Пресса о нас',
        'hierarchical'        => false,
        'public'              => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'map_meta_cap'        => true,
        'has_archive'         => false,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'press'),
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields'),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-megaphone',
    );
    register_post_type('press', $args);

    register_taxonomy( 'works_foto_group',
        array('works_foto', 'otzyvy'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
            'labels' => array(
                'name' => __( 'Группы услуг' ),
                'singular_name' => __( 'Группы услуг' ),
                'search_items' =>  __( 'Поиск групп услуг' ),
                'all_items' => __( 'Все группы услуг' ),
                'parent_item' => __( 'Родительская группа услуг' ),
                'parent_item_colon' => __( 'Родительская группа услуг:' ),
                'edit_item' => __( 'Редактировать группы услуг' ),
                'update_item' => __( 'Обновить группу услуг' ),
                'add_new_item' => __( 'Добавить новую группу услуг' ),
                'new_item_name' => __( 'Имя новой группы услуг' ),
            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'works_foto-group' ),
            'publicly_queryable'  => false
        )
    );

    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type('works_foto_group', 'works_foto');

    register_taxonomy( 'doctors_group',
        array('doctors'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
            'labels' => array(
                'name' => __( 'Отделения врачей' ),
                'singular_name' => __( 'Отделения врачей' ),
                'search_items' =>  __( 'Поиск отделений врачей' ),
                'all_items' => __( 'Все отделения врачей' ),
                'parent_item' => __( 'Родительское отделение врачей' ),
                'parent_item_colon' => __( 'Родительское отделение врачей:' ),
                'edit_item' => __( 'Редактировать отделения врачей' ),
                'update_item' => __( 'Обновить отделения врачей' ),
                'add_new_item' => __( 'Добавить новое отделение врачей' ),
                'new_item_name' => __( 'Имя нового отделения врачей' ),
            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => array( 'slug' => 'doctors-group' ),
        )
    );

    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type('doctors_group', 'doctors');

    $labels = array(
        'name'                => __( 'Цены' ),
        'singular_name'       => __( 'Цены' ),
        'menu_name'           => __( 'Цены' ),
        'all_items'           => __( 'Все Цены' ),
        'add_new'             => __( 'Добавить' ),
        'add_new_item'        => __( 'Добавить новую цену' ),
        'edit'                => __( 'Редактировать' ),
        'edit_item'           => __( 'Редактирование' ),
        'new_item'            => __( 'Новые Цены' ),
        'view'                => __( 'Просмотр' ),
        'view_item'           => __( 'Просмотр' ),
        'search_items'        => __( 'найти' ),
        'not_found'           => __( 'Цена не найдена' ),
        'not_found_in_trash'  => __( 'Цена в корзине не найдена' ),
    );
    $args = array(
        'labels'              => $labels,
        'description'         => __( 'Цены' ),
        'hierarchical'          => false,
        'public'                => false,   // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable'    => true,    // you should be able to query it
        'show_ui'               => true,    // you should be able to edit it in wp-admin
        'exclude_from_search'   => false,   // you should exclude it from search results
        'show_in_nav_menus'     => false,   // you shouldn't be able to add it to menus
        'has_archive'           => false,   // it shouldn't have archive page
        'map_meta_cap'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'prices' ),
        'capability_type'       => 'post',
        'supports'              => array( 'title', 'editor', 'excerpt', 'page-attributes', 'custom-fields' ),
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-money-alt',
    );
    register_post_type( 'prices', $args );

    register_taxonomy_for_object_type( 'group_price', 'prices' );

    register_taxonomy( 'group_price', array( 'prices' ),
        array(
            'hierarchical'      => true,
            'labels'            => array(
                'name'              => __( 'Группы цен' ),
                'singular_name'     => __( 'Группы цен' ),
                'search_items'      => __( 'Поиск групп цен' ),
                'all_items'         => __( 'Все группы цен' ),
                'parent_item'       => __( 'Родительская группа цен' ),
                'parent_item_colon' => __( 'Родительская группа цен:' ),
                'edit_item'         => __( 'Редактировать группы цен' ),
                'update_item'       => __( 'Обновить группу цен' ),
                'add_new_item'      => __( 'Добавить новую группу цен' ),
                'new_item_name'     => __( 'Имя новой группы цен' ),
            ),
            'show_admin_column' => true,
            'publicly_queryable' => true,
            'public' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'group_price' ),
        )
    );
}

    $labels = array(
        'name'                => __( 'Блоки цен' ),
        'singular_name'       => __( 'Блок цен' ),
        'menu_name'           => __( 'Блоки цен' ),
        'all_items'           => __( 'Все Блоки цен' ),
        'add_new'             => __( 'Добавить' ),
        'add_new_item'        => __( 'Добавить новый Блок цен' ),
        'edit'                => __( 'Редактировать' ),
        'edit_item'           => __( 'Редактирование' ),
        'new_item'            => __( 'Новый Блок цен' ),
        'view'                => __( 'Просмотр' ),
        'view_item'           => __( 'Просмотр' ),
        'search_items'        => __( 'найти' ),
        'not_found'           => __( 'Цена не найдена' ),
        'not_found_in_trash'  => __( 'Цена в корзине не найдена' ),
    );
    $args = array(
        'labels'              => $labels,
        'description'         => __( 'Блоки цен' ),
        'hierarchical'          => false,
        'public'                => false,   // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable'    => true,    // you should be able to query it
        'show_ui'               => true,    // you should be able to edit it in wp-admin
        'exclude_from_search'   => false,   // you should exclude it from search results
        'show_in_nav_menus'     => false,   // you shouldn't be able to add it to menus
        'has_archive'           => false,   // it shouldn't have archive page
        'map_meta_cap'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'prices_blocks' ),
        'capability_type'       => 'post',
        'supports'              => array( 'title', 'page-attributes', 'custom-fields' ),
        'menu_position'         => 12,
        'menu_icon'             => 'dashicons-money-alt',
    );
    register_post_type( 'prices_blocks', $args );


/**
 * 1. Убираем папку CPT из генерируемых ссылок
 */
/*
function wpfix_remove_cpt_slug( $post_link, $post, $leavename ) {
    $target_types = array( 'doctors', 'cases', 'services' );

    if ( ! is_object( $post ) || ! isset( $post->post_type ) ) {
        return $post_link;
    }

    if ( ! in_array( $post->post_type, $target_types, true ) ) {
        return $post_link;
    }

    if ( 'publish' !== $post->post_status ) {
        return $post_link;
    }

    return str_replace( '/' . $post->post_type . '/', '/', $post_link );
}
add_filter( 'post_type_link', 'wpfix_remove_cpt_slug', 10, 3 );
*/
/**
 * 2. Разрешаем WordPress находить плоские URL
 */
/*
function wpfix_parse_flat_url( $query ) {
    if ( is_admin() || ! $query instanceof WP_Query ) {
        return;
    }

    if ( ! $query->is_main_query() ) {
        return;
    }

    // Если уже задан post_type (архив, таксономия и т.п.) — не вмешиваемся
    if ( ! empty( $query->query['post_type'] ) ) {
        return;
    }

    // Реагируем только на запросы одиночных страниц/записей
    $has_name = ! empty( $query->query['name'] ) || ! empty( $query->query['pagename'] );
    if ( ! $has_name ) {
        return;
    }

    $query->set( 'post_type', array( 'post', 'page', 'doctors', 'cases', 'services' ) );
}
add_action( 'pre_get_posts', 'wpfix_parse_flat_url' );
*/
/**
 * 3. 301-редирект со старого URL (с папкой) на плоский
 */
/*
function wpfix_redirect_cpt_slug() {
    if ( is_admin() ) {
        return;
    }

    if ( ! is_singular( array( 'doctors', 'cases', 'services' ) ) ) {
        return;
    }

    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) {
        return;
    }

    if ( empty( $_SERVER['REQUEST_URI'] ) ) {
        return;
    }

    $request_uri = wp_unslash( $_SERVER['REQUEST_URI'] );

    if ( false !== strpos( $request_uri, '/' . $post->post_type . '/' ) ) {
        wp_safe_redirect( home_url( '/' . $post->post_name . '/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'wpfix_redirect_cpt_slug' );
*/
/**
 * Добавляем правило для плоских URL иерархических services
 */
/*
function wpfix_services_rewrite_rule() {
	add_rewrite_rule(
	    '^([^/]+)/?$',
	    'index.php?post_type=services&name=$matches[1]',
	    'bottom' // или просто уберите третий параметр
	);
}
add_action( 'init', 'wpfix_services_rewrite_rule' );
*/
/*
function remove_post_slug( $post_link, $post, $leavename ) {
    if ( ! in_array( $post->post_type, array( 'doctors', 'cases' ), true ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}
add_filter( 'post_type_link', 'remove_post_slug', 10, 3 );
*/

function parse_request_trick( $query ) {
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'doctors', 'cases', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'parse_request_trick' );

/**
 * Отменим показ выбранного термина наверху в checkbox списке терминов.
 */

function set_checked_ontop_default( $args ) {
    // изменим параметр по умолчанию на false
    if ( ! isset($args['checked_ontop']) )
        $args['checked_ontop'] = false;

    return $args;
}
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );

/*
 * Add columns to exhibition post list
 */
function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array (
        'id' => __ ( 'ID' ),
        'price'   => __ ( 'Price' )
    ) );
}
//add_filter ( 'manage_prices_posts_columns', 'add_acf_columns' );

/*
 * Add columns to exhibition post list
 */
function prices_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'id':
            echo $post_id;
            break;
        case 'price':

            echo number_format( get_post_meta ( $post_id, 'cost_value', true ), 0, ' ', '' ) . ' ₽';
            break;
    }
}
//add_action ( 'manage_prices_posts_custom_column', 'prices_custom_column', 10, 2 );

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
    
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'standards',
            'title'             => __('Стандарты лечения'),
            'description'       => __('Блок стандартов лечения.'),
            'render_template'   => 'template-parts/blocks/standards/standards.php',
            'category'          => 'formatting',
            'icon'              => 'shield-alt',
            'keywords'          => array( 'standards', 'стандарты' ),
        ));

        acf_register_block_type(array(
            'name'              => 'doctor-single',
            'title'             => __('Один врач'),
            'description'       => __('Блок с одним врачом'),
            'render_template'   => 'template-parts/blocks/doctor-single/doctor-single.php',
            'category'          => 'formatting',
            'icon'              => 'businessman',
            'keywords'          => array( 'doctor', 'врач' ),
        ));

        acf_register_block_type(array(
            'name'              => 'price-single',
            'title'             => __('Один прайс'),
            'description'       => __('Произвольный аккордеон с ценами'),
            'render_template'   => 'template-parts/blocks/price-single/price-single.php',
            'category'          => 'formatting',
            'icon'              => 'money-alt',
            'keywords'          => array( 'цены', 'прайс' ),
            'mode'              => 'edit'
        ));

    }

} 