<?php
if ( ! function_exists( 'levin_setup' ) ) {

    function levin_setup() {
        add_image_size( 'portfolio_thumbs', 512, 338 );
        add_image_size( 'serteficats', 200, 111 );
        add_image_size( 'doctors_thumbs', 9999, 315 );
        add_image_size( 'doctor_card', 500, 400, array( 'right', 'bottom' ) );

        register_nav_menus(
            array(
                'footer_primary'   => 'Подвал — основное меню',
                'footer_secondary' => 'Подвал — меню «О Центре»',
            )
        );

        if ( ! is_admin() ) {
            add_filter( 'widget_text', 'do_shortcode' );
            add_filter( 'category_description', 'do_shortcode' );
        }

        add_filter(
            'wp_editor_set_quality',
            function ( $arg ) {
                return 90;
            }
        );

        add_filter(
            'jpeg_quality',
            function ( $arg ) {
                return 90;
            }
        );

        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'editor-styles' );

        add_editor_style( 'static/css/bundle-editor.css' );
        add_editor_style( 'static/css/editor-classic.css' );
    }

    add_action( 'after_setup_theme', 'levin_setup' );

}

require get_template_directory() . '/inc/blocks-registry/blocks.php';
require get_template_directory() . '/inc/load-styles.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/yoast.php';
require get_template_directory() . '/inc/enqueues.php';
require get_template_directory() . '/inc/wp-remove.php';
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/localization.php';
require get_template_directory() . '/inc/utils.php';
require get_template_directory() . '/inc/menu-walkers/footer-primary-menu-walker.php';


require 'inc/lead-form.php';

// Entities
require 'inc/entities/class-doctor.php';

// Repositories
require 'inc/repositories/class-case-repository.php';

// REST
require 'inc/rest/doctors.php';
require 'inc/rest/doctor-cases.php';

add_action(
    'init',
    function () {
        add_post_type_support( 'page', 'excerpt' );
    }
);

/**
 * Возвращает WP_Post врача, привязанного к текущей записи через ACF-поле 'doctor'.
 * Используется в template-parts/service/post-author.php.
 */
function get_post_author() {
    return get_field( 'doctor' ) ?: null;
}

add_action(
    'init',
    function () {
        register_block_style(
            'core/table',
            array(
                'name'  => 'cards',
                'label' => 'Карточки',
            )
        );
        register_block_style(
            'core/table',
            array(
                'name'  => 'scroll',
                'label' => 'Скролл',
            )
        );
    }
);

add_action(
    'enqueue_block_editor_assets',
    function () {
        $editor_js = array(
            'theme-list-options' => array(
                'url'  => get_template_directory_uri() . '/static/js/editor-list-options.js',
                'deps' => array( 'wp-hooks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-compose' ),
            ),
            'theme-doctor-card'  => array(
                'url'  => get_template_directory_uri() . '/static/js/editor-doctor-card.js',
                'deps' => array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components' ),
            ),
            'theme-standards'    => array(
                'url'  => get_template_directory_uri() . '/static/js/editor-standards.js',
                'deps' => array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components' ),
            ),
        );

        foreach ( $editor_js as $handle => $script ) {
            $file = get_template_directory() . str_replace( get_template_directory_uri(), '', $script['url'] );
            $ver  = file_exists( $file ) ? filemtime( $file ) : wp_get_theme()->get( 'Version' );
            wp_enqueue_script( $handle, $script['url'], $script['deps'], $ver );
        }
    }
);

// Регистрация блоков, собранных через @wordpress/scripts (папка /blocks).
add_action(
    'init',
    function () {
        $blocks_dir = get_template_directory() . '/blocks/';

        if ( ! file_exists( $blocks_dir ) ) {
            return;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator( $blocks_dir, FilesystemIterator::SKIP_DOTS )
        );

        foreach ( $files as $file ) {
            if ( 'block.json' !== $file->getFilename() ) {
                continue;
            }

            $block_path = wp_normalize_path( $file->getPath() );

            if ( str_contains( $block_path, '/src' ) ) {
                continue;
            }

            register_block_type( $block_path );
        }
    }
);

/**
 * Related Posts Ajax
 */
add_action( 'wp_ajax_related_posts', 'related_posts_ajax_handler' );
add_action( 'wp_ajax_nopriv_related_posts', 'related_posts_ajax_handler' );

function related_posts_ajax_handler() {
    $taxonomy = 'category';
    $per_page = 6;
    $finish   = false;

    // Поля запроса читаем безопасно (дефект SEC-09): без isset были предупреждения PHP 8.
    $post_id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : 0;
    $got_raw = isset( $_POST['got'] ) ? wp_unslash( $_POST['got'] ) : '';
    $got     = array_filter( array_map( 'absint', explode( ',', (string) $got_raw ) ) );

    // Получаем термины поста
    $post_terms = wp_get_post_terms(
        $post_id,
        $taxonomy,
        array(
            'orderby' => 'id',
            'order'   => 'ASC',
            'fields'  => 'ids',
        )
    );

    // Получаем остальные термины таксономии
    $taxonomy_terms = $terms = get_terms(
        array(
            'taxonomy'   => array( $taxonomy ),
            'orderby'    => 'id',
            'order'      => 'ASC',
            'hide_empty' => true,
            'exclude'    => $post_terms,
            'fields'     => 'ids',
        )
    );

    // объединяем сохраняя порядок
    $terms_order = array( $post_terms, $taxonomy_terms );

    foreach ( $terms_order as $terms_ids ) {
        $query = new WP_Query(
            array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'paged'          => 1,
                'posts_per_page' => $per_page,
                'tax_query'      => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => $terms_ids,
                    ),
                ),
                'post__not_in'   => $got,
            )
        );

        $posts = $query->posts;

        if ( count( $posts ) >= $per_page ) {
            break;
        }
    }

    if ( count( $posts ) < $per_page ) {
        $finish = true;
    } else {
        $posts = array_slice( $posts, 0, 6 );
    }

    $items = array();
    foreach ( $posts as $post ) {
        if ( has_post_thumbnail( $post->ID ) ) {
            $image_id   = get_post_thumbnail_id( $post->ID );
            $image_url  = wp_get_attachment_image_src( $image_id, 'full', true ); // 'post_thumbs' не зарегистрирован (PHP-01)
            $post_image = is_array( $image_url ) ? $image_url[0] : '/wp-content/uploads/2019/10/bg_levin_thumb.jpg';
        } else {
            $post_image = '/wp-content/uploads/2019/10/bg_levin_thumb.jpg';
        }

        $cat = get_the_category( $post->ID );
        $cat_name = ! empty( $cat ) ? $cat[0]->cat_name : '';

        $items[] = array(
            'id'         => $post->ID,
            'permalink'  => get_the_permalink( $post->ID ),
            'post_image' => $post_image,
            'cat_name'   => $cat_name,
            'title'      => get_the_title( $post->ID ),
            'post_type'  => $post->post_type,
        );
    }

    // wp_send_json: чистый JSON и корректный Content-Type (фронтенд ждёт json — dataType: 'json').
    wp_send_json(
        array(
            'finish' => $finish,
            'items'  => $items,
        )
    );
}

/**
 * Get запрос на получение отзывов по ajax
 */
require get_template_directory() . '/inc/reviews-ajax.php';

add_action( 'wp_ajax_nopriv_created_link', 'created_link' );
add_action( 'wp_ajax_created_link', 'created_link' );

/*
 * Модуль оставить отзыв QR/WA
 */
function created_link() {

    global $wpdb;
    $wpdb->insert(
        'levin_feedback_links',
        array(
            'link_short'   => $_POST['link_short'],
            'doctor_id'    => $_POST['doctor_id'],
            'patient_name' => $_POST['patient_name'],
            'patient_sex'  => $_POST['patient_sex'],
            'admin_id'     => $_POST['admin_id'],
            'place_id'     => $_POST['place_id'],
            'timestamp'    => $_POST['timestamp'],
            'card_id'      => $_POST['card_id'],
        )
    );
}

/**
 * Word declension after a number.
 *
 *     // Examples of invocation:
 *     num_decline( $num, 'книга,книги,книг' )
 *     num_decline( $num, 'book,books' )
 *     num_decline( $num, [ 'книга','книги','книг' ] )
 *     num_decline( $num, [ 'book','books' ] )
 *
 * @param int|string   $number       The number that is followed by the word. You can use HTML tags.
 * @param string|array $titles       Variants of words for numbers.
 * @param bool         $show_number  Set to `false`, when you don't want to output the number itself.
 *
 * @return string For example: 1 book, 2 books, 10 books.
 *
 * @version 3.1
 */
function num_decline( $number, $titles, $show_number = true ) {

    if ( is_string( $titles ) ) {
        $titles = preg_split( '/, */', $titles );
    }

    // когда указано 2 элемента
    if ( empty( $titles[2] ) ) {
        $titles[2] = $titles[1];
    }

    $cases = array( 2, 0, 1, 1, 1, 2 );

    $intnum = abs( (int) strip_tags( $number ) );

    $title_index = ( $intnum % 100 > 4 && $intnum % 100 < 20 )
        ? 2
        : $cases[ min( $intnum % 10, 5 ) ];

    return ( $show_number ? "$number " : '' ) . $titles[ $title_index ];
}

function custom_acf_css() {
    echo "<style>
            [data-key='field_67638b9cc7584']  .list {
            height: 600px !important;
            }
        </style>";
}

add_action( 'admin_head', 'custom_acf_css' );

/**
 * Promo Banner AJAX из template-parts
 */
add_action( 'wp_ajax_nopriv_load_promo_banner', 'load_promo_banner' );
add_action( 'wp_ajax_load_promo_banner', 'load_promo_banner' );

function load_promo_banner() {
    $template_path = get_template_directory() . '/template-parts/common/notice.php';

    if ( file_exists( $template_path ) ) {
        ob_start();
        include $template_path;
        echo ob_get_clean();
    }
    wp_die();
}

/* Функция вывода ссылки по номеру телефона */
function phone_link( $phone ) {

    $phone_link = 'tel:+' . preg_replace( '/[\D]/', '', $phone ?? '' );

    return ( $phone_link );
}

function phone_format( $phone, $brackets = false ) {
    $phone = trim( $phone ?? '' );
    if ( ! $phone ) {
        return '';
    }

    // Определяем формат: со скобками или просто через пробел
    $format = $brackets ? '+7 ($2) $3-$4-$5' : '+7 $2 $3-$4-$5';
    // Для коротких кодов (последние два шаблона в вашем списке)
    $formatShort = $brackets ? '+7 ($2) $3-$4' : '+7 $2 $3-$4';

    $res = preg_replace(
        array(
            '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
            '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
            '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
            '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
            '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
            '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
        ),
        array(
            $format,
            $format,
            $format,
            $format,
            $formatShort,
            $formatShort,
        ),
        $phone
    );

    return $res;
}

function get_site_phone() {
    static $phone = null;
    if ( $phone === null ) {
        $phone = get_field( 'phone', 'option' );
    }
    return $phone;
}
function get_site_email() {
    static $email = null;
    if ( $email === null ) {
        $email = get_field( 'email', 'option' );
    }
    return $email;
}
// Gets Categories by Post Type
// returns categories that aren't empty
function get_categories_for_post_type( $post_type = 'post', $taxonomy = '' ) {
    $exclude    = array();
    $args       = array(
        'taxonomy' => $taxonomy,
    );
    $categories = get_categories( $args );

    // Check ALL categories for posts of given post type
    foreach ( $categories as $category ) {
        $posts = get_posts(
            array(
                'post_type' => $post_type,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $category->term_id,
                    ),
                ),
            )
        );

        // If no posts in category, add to exclude list
        if ( empty( $posts ) ) {
            $exclude[] = $category->term_id;
        }
    }

    // If exclude list, add to args
    if ( ! empty( $exclude ) ) {
        $args['exclude'] = implode( ',', $exclude );
    }

    // List categories
    return get_categories( $args );
}
