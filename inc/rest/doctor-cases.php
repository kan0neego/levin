<?php
/**
 * REST-роут «кейсы врача» для предпросмотра в редакторе.
 *
 * @package doctorlevin
 */

add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'theme/v1',
            '/doctor/(?P<id>\d+)/cases',
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => 'rest_doctor_cases',
                'permission_callback' => function () {
                    return current_user_can( 'edit_posts' );
                },
                'args'                => array(
                    'id' => array(
                        'required'          => true,
                        'validate_callback' => function ( $value ) {
                            return is_numeric( $value ) && absint( $value ) > 0;
                        },
                    ),
                ),
            )
        );
    }
);

/**
 * Отдаёт кейсы, привязанные к врачу.
 *
 * @param WP_REST_Request $request Запрос.
 * @return WP_REST_Response|WP_Error Кейсы врача в формате слайдов блока.
 */
function rest_doctor_cases( WP_REST_Request $request ) {
    $doctor = new Doctor( $request->get_param( 'id' ) );

    if ( ! $doctor->exists() ) {
        return new WP_Error(
            'doctor_not_found',
            'Запись типа «doctors» не найдена.',
            array( 'status' => 404 )
        );
    }

    $repository = new Case_Repository();
    $slides     = $repository->find_slides_by_doctor( $doctor->get_id() );

    return rest_ensure_response( $slides );
}
