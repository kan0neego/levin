<?php
/**
 * Получаем пути всех шаблонов для ServerSideRender
 *
 * @package doctorlevin
 */

add_action(
    'init',
    function () {
        $registry_dir   = get_theme_file_path( '/inc/blocks-registry/templates/' );
        $registry_files = glob( $registry_dir . '*.php' );

        if ( ! empty( $registry_files ) ) {
            foreach ( $registry_files as $file ) {
                require_once $file;
            }
        }
    }
);
