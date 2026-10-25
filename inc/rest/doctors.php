<?php
/**
 * REST-роут «врачи» для блоков редактора.
 *
 * Отдаёт живые данные врача из сущности `Doctor`. ACF-поля типа записи
 * `doctors` не попадают в стандартный REST-ответ, поэтому редактор
 * запрашивает этот роут вместо того, чтобы сохранять снимок полей в атрибутах блока.
 *
 * @package levin
 */

if (!function_exists('get_doctor_data')) {
    /**
     * Собирает данные одного врача в плоскую структуру.
     *
     * @param int $post_id ID записи типа `doctors`.
     * @return array Плоская структура врача.
     */
    function get_doctor_data($post_id)
    {
        $doctor = new Doctor($post_id);

        return $doctor->to_array();
    }
}

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/doctors/(?P<id>\d+)', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => function (WP_REST_Request $request) {
            $doctor = get_doctor_data($request->get_param('id'));

            if (empty($doctor)) {
                return new WP_Error('doctor_not_found', 'Запись типа «doctors» не найдена.', ['status' => 404]);
            }

            return rest_ensure_response($doctor);
        },
        'permission_callback' => '__return_true',
    ]);
});
