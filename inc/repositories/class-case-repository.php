<?php
/**
 * Репозиторий кейсов.
 *
 * @package doctorlevin
 */

if ( ! class_exists( 'Case_Repository' ) ) {

    /**
     * Слой доступа к данным кейсов.
     *
     * Скрывает детали хранения связей «кейс ↔ врач» и детали WP-запроса.
     * Сущность `Doctor` про них не знает, поэтому смена способа хранения связи
     * (ACF-поле, отдельная таблица, связь через термин) затрагивает только
     * этот класс.
     */
    class Case_Repository {

        const POST_TYPE = 'cases';

        /**
         * ACF-поле «Родственные связи» на стороне кейса: хранит ID врачей.
         *
         * @var string
         */
        const RELATED_DOCTORS_FIELD = 'case_related_doctors';

        /**
         * ID кейсов, привязанных к врачу.
         *
         * Связь хранится в ACF-поле кейса, поэтому выборка идёт по метаданным:
         * значение поля — сериализованный массив ID врачей, отсюда сравнение
         * `LIKE` по ID в кавычках.
         *
         * Используется `get_posts()`: в отличие от `WP_Query`, она не
         * перезаписывает глобальный `$post`, поэтому контекст записи не
         * теряется и `wp_reset_postdata()` после выборки не нужен.
         *
         * @param int   $doctor_id ID записи типа `doctors`.
         * @param array $args      Дополнительные аргументы выборки.
         * @return int[] ID записей типа `cases`, отсортированные по заголовку.
         */
        public function find_ids_by_doctor( $doctor_id, $args = array() ) {
            $doctor_id = absint( $doctor_id );

            if ( ! $doctor_id ) {
                return array();
            }

            $defaults = array(
                'post_type'           => self::POST_TYPE,
                'post_status'         => 'publish',
                'posts_per_page'      => -1,
                'orderby'             => 'title',
                'order'               => 'ASC',
                'fields'              => 'ids',
                'ignore_sticky_posts' => true,
                'meta_query'          => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                    array(
                        'key'     => self::RELATED_DOCTORS_FIELD,
                        'value'   => '"' . $doctor_id . '"',
                        'compare' => 'LIKE',
                    ),
                ),
            );

            $cases = get_posts( wp_parse_args( $args, $defaults ) );

            return array_map( 'absint', $cases );
        }

        /**
         * Кейсы врача в формате слайдов блока: `[ [ 'caseId' => id ], … ]`.
         *
         * Единая точка сборки для вывода на сайте и для предпросмотра в
         * редакторе: обе стороны получают одинаковый список.
         *
         * @param int   $doctor_id ID записи типа `doctors`.
         * @param array $args      Дополнительные аргументы выборки.
         * @return array Слайды для блока «Кейсы».
         */
        public function find_slides_by_doctor( $doctor_id, $args = array() ) {
            return array_map(
                static function ( $case_id ) {
                    return array( 'caseId' => $case_id );
                },
                $this->find_ids_by_doctor( $doctor_id, $args )
            );
        }
    }
}
