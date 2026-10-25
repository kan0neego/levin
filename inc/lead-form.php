<?php
/**
 * Приём заявок с форм сайта + лог таймингов.
 * Идёт через admin-ajax.php, где доступны nonce, санитизация и wp_mail.
 *
 * AJAX-действие: action=levin_lead
 * Поля: formType, phone, initial_src, last_src, referrer, utm (+ name, email, message);
 *       formType=_timing — запись строки таймингов в лог.
 * Ответ: «OK» или «OK:<req_id>» — формат сохранён для static/js/forms-handler.js.
 *
 * @package doctorlevin
 */

if ( ! defined( 'LEVIN_LEAD_ACTION' ) ) {
    define( 'LEVIN_LEAD_ACTION', 'levin_lead' );   // имя AJAX-действия.
}
if ( ! defined( 'LEVIN_LEAD_NONCE' ) ) {
    define( 'LEVIN_LEAD_NONCE', 'levin_lead_form' ); // контекст nonce.
}
if ( ! defined( 'LEVIN_LEAD_LIMIT' ) ) {
    define( 'LEVIN_LEAD_LIMIT', 5 );               // заявок с одного IP.
}
if ( ! defined( 'LEVIN_LEAD_WINDOW' ) ) {
    define( 'LEVIN_LEAD_WINDOW', 600 );            // ...за такое окно, секунд.
}

/**
 * Путь к файлу лога таймингов: каталог темы /log (закрыт от HTTP через log/.htaccess).
 *
 * @return string Путь к файлу либо пустая строка, если каталог недоступен на запись.
 */
function log_path() {
    static $path = null;

    if ( null !== $path ) {
        return $path;
    }

    $dir = get_template_directory() . '/log';
    if ( ! is_dir( $dir ) ) {
        wp_mkdir_p( $dir );
    }

    $path = ( is_dir( $dir ) && is_writable( $dir ) ) ? $dir . '/form-timing.log' : '';

    return $path;
}

/**
 * Очищает значение перед записью в лог и тело письма: без переводов строк, с обрезкой.
 *
 * @param mixed $value Значение из запроса.
 * @param int   $max   Максимальная длина.
 * @return string
 */
function sanitize_value( $value, $max = 300 ) {
    $value = is_string( $value ) ? wp_unslash( $value ) : '';
    $value = preg_replace( '/[\r\n]+/', ' ', $value );

    return mb_substr( sanitize_text_field( $value ), 0, $max );
}

/**
 * Пишет строку в лог таймингов (если каталог доступен).
 *
 * @param string $log_file Путь к логу.
 * @param string $req_id   Идентификатор запроса.
 * @param float  $t_start  Время старта запроса.
 * @param string $msg      Текст строки.
 */
function write_log( $log_file, $req_id, $t_start, $msg ) {
    if ( '' === $log_file ) {
        return;
    }

    $elapsed = round( ( microtime( true ) - $t_start ) * 1000 );
    file_put_contents( $log_file, date( 'Y-m-d H:i:s' ) . " [{$req_id}] +{$elapsed}ms {$msg}\n", FILE_APPEND | LOCK_EX );
}

/**
 * Простой лимит частоты по IP на транзиентах.
 *
 * @param string $ip IP клиента.
 * @return bool true, если лимит превышен.
 */
function is_flood( $ip ) {
    if ( '' === $ip ) {
        return false;
    }

    $key   = 'levin_lead_rl_' . md5( $ip );
    $count = (int) get_transient( $key );

    if ( $count >= LEVIN_LEAD_LIMIT ) {
        return true;
    }

    set_transient( $key, $count + 1, LEVIN_LEAD_WINDOW );

    return false;
}

/**
 * Строки письма: страница отправки, точка входа, реферер и UTM по отдельности.
 *
 * @param string       $page     URL страницы отправки формы (last_src).
 * @param string       $entry    URL точки входа в сессию (initial_src).
 * @param string       $referrer HTTP-реферер точки входа.
 * @param string|array $utm_raw  JSON-объект меток или уже разобранный массив.
 * @return string Фрагмент тела письма без завершающего перевода строки.
 */
function lead_attribution_message( $page, $entry, $referrer, $utm_raw ) {
    $lines = array();

    if ( '' !== $page ) {
        $lines[] = 'Страница: ' . $page;
    }
    if ( '' !== $entry ) {
        $lines[] = 'Точка входа: ' . $entry;
    }
    if ( '' !== $referrer ) {
        $lines[] = 'Реферер: ' . $referrer;
    } elseif ( '' !== $page || '' !== $entry ) {
        $lines[] = 'Реферер: прямой заход';
    }

    $utm = array();
    if ( is_array( $utm_raw ) ) {
        $utm = $utm_raw;
    } elseif ( is_string( $utm_raw ) && '' !== $utm_raw ) {
        $decoded = json_decode( $utm_raw, true );
        if ( is_array( $decoded ) ) {
            $utm = $decoded;
        }
    }

    if ( ! empty( $utm ) ) {
        ksort( $utm );
        foreach ( $utm as $key => $value ) {
            if ( ! is_string( $key ) || ! is_scalar( $value ) ) {
                continue;
            }
            $key = strtolower( $key );
            if ( 0 !== strpos( $key, 'utm_' ) ) {
                $key = 'utm_' . $key;
            }
            if ( ! preg_match( '/^utm_[a-z0-9_]+$/', $key ) ) {
                continue;
            }
            $value = sanitize_value( (string) $value, 300 );
            if ( '' === $value ) {
                continue;
            }
            $lines[] = $key . ': ' . $value;
        }
    }

    return implode( "\r\n", $lines );
}


/**
 * Отдаёт ответ в формате, который разбирает static/js/forms-handler.js.
 *
 * @param string $req_id Идентификатор запроса.
 */
function response_success( $req_id ) {
    header( 'Content-Type: text/plain; charset=utf-8' );
    echo 'Ok:' . $req_id;
    exit;
}

/**
 * Обработчик заявки: admin-ajax action=levin_lead.
 */
function handle_request() {
    $log_file = log_path();
    $req_id   = substr( uniqid(), -6 );
    $t_start  = microtime( true );
    $method   = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) ) : '';

    // 1. Только POST: GET больше не отправляет письмо (SEC-07).
    if ( 'POST' !== $method ) {
        status_header( 405 );
        exit( 'Method Not Allowed' );
    }

    // 2. nonce: защита от подделки запросов с чужих сайтов (SEC-02).
    if ( ! check_ajax_referer( LEVIN_LEAD_NONCE, 'nonce', false ) ) {
        status_header( 403 );
        exit( 'Forbidden' );
    }

    $type = sanitize_value( isset( $_POST['formType'] ) ? $_POST['formType'] : '', 32 );

    // 3. Строки таймингов от JS: только запись в лог, без письма и без расхода лимита.
    if ( '_timing' === $type ) {
        write_log(
            $log_file,
            sanitize_value( isset( $_POST['req_id'] ) ? $_POST['req_id'] : '?', 16 ),
            $t_start,
            sanitize_value( isset( $_POST['line'] ) ? $_POST['line'] : '', 300 )
        );
        header( 'Content-Type: text/plain; charset=utf-8' );
        echo 'Ok';
        exit;
    }

    $phone = sanitize_value( isset( $_POST['phone'] ) ? $_POST['phone'] : '', 32 );
    $src   = sanitize_value( isset( $_POST['last_src'] ) ? $_POST['last_src'] : '', 500 );
    $entry = sanitize_value( isset( $_POST['initial_src'] ) ? $_POST['initial_src'] : '', 500 );
    $ref   = sanitize_value( isset( $_POST['referrer'] ) ? $_POST['referrer'] : '', 500 );
    $utm   = isset( $_POST['utm'] ) ? wp_unslash( $_POST['utm'] ) : '';

    // 4. Honeypot: скрытое поле заполняют только боты — письмо не отправляем (SEC-07).
    if ( ! empty( $_POST['levin_hp'] ) ) {
        write_log( $log_file, $req_id, $t_start, "BOT honeypot type={$type} phone={$phone} page={$src}" );
        response_success( $req_id );
    }

    // 5. Лимит частоты по IP (SEC-07).
    $ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
    if ( is_flood( $ip ) ) {
        write_log( $log_file, $req_id, $t_start, "RATE-LIMIT ip={$ip}" );
        status_header( 429 );
        exit( 'Too Many Requests' );
    }

    $email = sanitize_value( isset( $_POST['email'] ) ? $_POST['email'] : '', 254 );

    // 6. Канареечный автопровер: теперь доступен только с валидным nonce (SEC-11).
    if ( '+7 (000) 000-00-00' === $phone || 'health-check@canary.test' === $email ) {
        write_log( $log_file, $req_id, $t_start, 'АВТОТЕСТ — skip mail, Ok' );
        response_success( $req_id );
    }

    // Заявку не теряем: неполный телефон только фиксируем в логе.
    if ( strlen( preg_replace( '/\D/', '', $phone ) ) < 11 ) {
        write_log( $log_file, $req_id, $t_start, "WEAK-PHONE type={$type}" );
    }

    if ( '' !== $log_file ) {
        file_put_contents( $log_file, "────────────────────────────────────────\n", FILE_APPEND | LOCK_EX );
    }
    write_log( $log_file, $req_id, $t_start, "START type={$type} phone={$phone} page={$src}" );

    $to      = 'call@doctorlevin.ru, uv@doctorlevin.ru';
    $subject = 'Запись с сайта doctorlevin.ru';
    $message = 'Запись с сайта doctorlevin.ru' . "\r\n" . 'Телефон: ' . $phone;

    $name    = sanitize_value( isset( $_POST['name'] ) ? $_POST['name'] : '', 120 );
    $comment = sanitize_value( isset( $_POST['message'] ) ? $_POST['message'] : '', 2000 );

    if ( '' !== $name ) {
        $message .= "\r\n" . 'Имя: ' . $name;
    }
    if ( '' !== $email ) {
        $message .= "\r\n" . 'E-mail: ' . $email;
    }
    if ( '' !== $comment ) {
        $message .= "\r\n" . 'Сообщение: ' . $comment;
    }

    $tracking = lead_attribution_message( $src, $entry, $ref, $utm );
    if ( '' !== $tracking ) {
        $message .= "\r\n" . $tracking;
    }
    if ( '' !== $type ) {
        $message .= "\r\n" . 'Тип формы: ' . $type;
    }
    $headers = array(
        'From: info@doctorlevin.ru',
        'Bcc: fatseo@gmail.com, viktor.khvatikov@yandex.ru',
        'Reply-To: no-reply@doctorlevin.ru',
        'Content-Type: text/plain; charset=UTF-8',
    );

    write_log( $log_file, $req_id, $t_start, 'MAIL_START' );
    $mail_ok = wp_mail( $to, $subject, $message, $headers );
    write_log( $log_file, $req_id, $t_start, 'MAIL_END result=' . ( $mail_ok ? 'ok' : 'fail' ) );
    write_log( $log_file, $req_id, $t_start, 'DONE' );

    if ( $mail_ok ) {
        response_success( $req_id );
    }

    status_header( 500 );
    exit( 'Mail error' );
}
add_action( 'wp_ajax_nopriv_' . LEVIN_LEAD_ACTION, 'handle_request' );
add_action( 'wp_ajax_' . LEVIN_LEAD_ACTION, 'handle_request' );
