<?php
/**
 * Сущность «Врач».
 *
 * @package doctorlevin
 */

if (!class_exists('Doctor')) {
    /**
     * Врач как объект: обёртка над записью типа `doctors`.
     *
     * Атрибуты читаются из записи и ACF в момент обращения, поэтому шаблоны
     * и блоки не хранят снимок полей — при смене данных врача вывод
     * обновляется сам.
     */
    class Doctor
    {
        const POST_TYPE = 'doctors';

        const FIELD_AVATAR = 'avatar';
        const FIELD_LIST_PICTURE = 'clipped_photo_list';
        const FIELD_BLOCK_PICTURE = 'clipped_photo_block_single';
        const FIELD_EXPERIENCE = 'experience';
        const FIELD_BANNER_TEXT = 'banner_text';
        const FIELD_IS_ACTIVE = 'is_active';

        /**
         * ID записи врача.
         *
         * @var int
         */
        private $id;

        /**
         * Конструктор.
         *
         * @param int $id ID записи типа `doctors`.
         */
        public function __construct($id)
        {
            $this->id = absint($id);
        }

        /**
         * Создаёт врача из текущей записи цикла.
         *
         * @return Doctor|null Врач или `null`, если текущая запись — не врач.
         */
        public static function get_current()
        {
            $current_id = get_the_ID();

            if (!$current_id) {
                return null;
            }

            $doctor = new self($current_id);

            return $doctor->exists() ? $doctor : null;
        }

        /**
         * ID записи врача.
         *
         * @return int ID записи.
         */
        public function get_id()
        {
            return $this->id;
        }

        /**
         * Проверяет, что запись существует и является врачом.
         *
         * @return bool `true`, если запись доступна как врач.
         */
        public function exists()
        {
            $post = $this->get_post();

            return $post instanceof WP_Post && self::POST_TYPE === $post->post_type;
        }

        /**
         * Заголовок записи врача.
         *
         * @return string Заголовок или пустая строка.
         */
        public function get_title()
        {
            return $this->exists() ? get_the_title($this->id) : '';
        }

        /**
         * Специализация врача (excerpt без HTML).
         *
         * @return string Специализация или пустая строка.
         */
        public function get_spec()
        {
            return $this->exists() ? wp_strip_all_tags(get_the_excerpt($this->id)) : '';
        }

        /**
         * Постоянная ссылка на запись врача.
         *
         * @return string URL или пустая строка.
         */
        public function get_permalink()
        {
            if (!$this->exists()) {
                return '';
            }

            $permalink = get_permalink($this->id);

            return $permalink ? $permalink : '';
        }

        /**
         * Опубликован ли профиль врача (страница врача доступна).
         *
         * @return bool `true`, если профиль активен.
         */
        public function is_active()
        {
            return $this->exists() && (bool) get_field(self::FIELD_IS_ACTIVE, $this->id);
        }

        /**
         * Текст баннера врача.
         *
         * @return string Текст или пустая строка.
         */
        public function get_banner_text()
        {
            if (!$this->exists()) {
                return '';
            }

            $text = get_field(self::FIELD_BANNER_TEXT, $this->id, false);

            return is_string($text) ? $text : '';
        }

        /**
         * Год начала стажа.
         *
         * @return int Год или 0.
         */
        public function get_experience_start()
        {
            if (!$this->exists()) {
                return 0;
            }

            return (int) get_field(self::FIELD_EXPERIENCE, $this->id, false);
        }

        /**
         * Стаж в полных годах.
         *
         * @return int Количество лет или 0.
         */
        public function get_experience_years()
        {
            $start = $this->get_experience_start();

            return $start ? (int) gmdate('Y') - $start : 0;
        }

        /**
         * Стаж со склонением («5 лет»).
         *
         * @return string Подпись стажа или пустая строка.
         */
        public function get_experience_label()
        {
            $years = $this->get_experience_years();

            if ($years <= 0 || !function_exists('num_decline')) {
                return '';
            }

            return num_decline($years, 'год, года, лет');
        }

        /**
         * URL аватара.
         *
         * @return string URL или пустая строка.
         */
        public function get_avatar_url()
        {
            return $this->get_image_url(self::FIELD_AVATAR);
        }

        /**
         * URL фото для списков и цитаты.
         *
         * @return string URL или пустая строка.
         */
        public function get_list_picture_url()
        {
            return $this->get_image_url(self::FIELD_LIST_PICTURE);
        }

        /**
         * URL фото для баннера и блока «Один врач».
         *
         * @return string URL или пустая строка.
         */
        public function get_block_picture_url()
        {
            return $this->get_image_url(self::FIELD_BLOCK_PICTURE);
        }

        /**
         * Плоская структура врача для REST и редактора.
         *
         * @return array Данные врача.
         */
        public function to_array()
        {
            if (!$this->exists()) {
                return [];
            }

            return [
                'id' => $this->id,
                'name' => $this->get_title(),
                'spec' => $this->get_spec(),
                'avatar' => $this->get_avatar_url(),
                'picture' => $this->get_list_picture_url(),
                'pictureBlock' => $this->get_block_picture_url(),
                'experience' => $this->get_experience_label(),
                'isActive' => $this->is_active(),
                'permalink' => $this->get_permalink(),
                'options' => [
                    'bannerDesc' => $this->get_banner_text(),
                ],
            ];
        }

        /**
         * Запись врача из базы.
         *
         * @return WP_Post|null Запись или `null`.
         */
        private function get_post()
        {
            return $this->id ? get_post($this->id) : null;
        }

        /**
         * URL изображения из ACF-поля.
         *
         * Поле может храниться как ID, массив ACF или готовый URL — метод
         * принимает любой из этих форматов.
         *
         * @param string $field_name Имя ACF-поля.
         * @return string URL или пустая строка.
         */
        private function get_image_url($field_name)
        {
            if (!$this->exists()) {
                return '';
            }

            $value = get_field($field_name, $this->id);

            if (is_array($value)) {
                if (!empty($value['url']) && is_string($value['url'])) {
                    return $value['url'];
                }

                $attachment_id = (int) ($value['ID'] ?? ($value['id'] ?? 0));

                return $attachment_id ? (string) wp_get_attachment_image_url($attachment_id, 'full') : '';
            }

            if (is_numeric($value)) {
                $url = wp_get_attachment_image_url((int) $value, 'full');

                return $url ? $url : '';
            }

            return is_string($value) ? $value : '';
        }
    }
}
