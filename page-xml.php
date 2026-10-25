<?php
/**
 * Template Name: XML
 */
    header('Content-Type: text/xml');

?>

<yml_catalog date="2023-12-21 19:40">
    <shop>
        <name>Доктор Левин</name>
        <company>ООО ЦПС «Доктор Левин»</company>
        <url>https://doctorlevin.ru</url>
        <email>mail@doctorlevin.ru</email>
        <picture>https://doctorlevin.ru/wp-content/themes/sd-03-2_new/img/doctorlevin-logo.png</picture>
        <description>Команда врачей</description>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            <category id="1">Врач</category>
        </categories>
        <sets>
            <?php
            $categories = get_categories( array(
                'taxonomy'     => 'doctors_group',
                'type'         => 'doctors',
                'hide_empty'   => 1,
                'meta_query' => array(
                    array(
                        'key'     => 'group_active',
                        'value'   => '1'
                    )
                )
            ));

            foreach ( $categories as $cat ) {
            ?>
            <set id="<?php echo $cat->slug; ?>">
                <name><?php echo get_field('doctor_group_specialty', $cat); ?></name>
                <url><?php echo get_term_link($cat); ?></url>
            </set>
            <?php }
            ?>
        </sets>
        <offers>
        <?php

            $args = array(
                'post_type' => 'doctors',
                'meta_query' => array(
                    array(
                      'key' => 'is_active',
                      'value' => '1'
                    )
                )
            );

            $query = new WP_Query( $args );

            while ( $query->have_posts() ) {
                
                $query->the_post();
                
                $fio = explode(" ", get_the_title());
                $y = date('Y');
                $exp = get_field('experience');
                $exp = $y-$exp; //years of exp

                $terms = get_the_terms( get_the_ID(), 'doctors_group' );
                if ( !empty( $terms ) ) {
                    $term = array_shift( $terms );
                }
                
                if(get_field('doctor_branch')=='Университет') {
                    $branch_address = "просп. Вернадского, 8А";
                    $branch_name = "Доктор Левин на Университете";
                } elseif(get_field('doctor_branch')=='Парк Культуры') {
                    $branch_address = "ул. Льва Толстого, 5/1";
                    $branch_name = "Доктор Левин на Парке Культуры";
                }

                $query_reviews = new WP_Query(array(
                    'post_type' => 'otzyvy',
                    'offset' => 0,
                    'meta_query' => array(
                        'post_status' => 'publish',
                            array(
                                'key' => 'doctors',
                                'value' => '"' . get_the_ID() . '"',
                                'compare' => 'LIKE'
                            )
                        )
                ));

                $doctor_id = get_the_ID();

        ?>
        <offer id="vrach<?php echo get_the_ID(); ?>">
            <name><?php the_title(); ?></name>
            <url><?php the_permalink(); ?></url>
            <price><?php echo (get_the_ID()==5528 || get_the_ID()==7372 || get_the_ID()==5788) ? '5000' : '3000'; ?></price>
            <?php /* <oldprice><?php echo (get_the_ID()==5528 || get_the_ID()==7372 || get_the_ID()==5788) ? '5000' : '3000'; ?></oldprice> */ ?>
            <currencyId>RUR</currencyId>
            <sales_notes>Первичный прием</sales_notes>
            <set-ids><?php echo $term->slug; ?></set-ids>
            <picture><?php echo get_field('clipped_photo_list', get_the_ID()); ?></picture>
            <description><?php echo get_field('banner_text'); ?></description>
            <categoryId>1</categoryId>
            <param name="Фамилия"><?php echo $fio[0]; ?></param>
            <param name="Имя"><?php echo $fio[1]; ?></param>
            <?php if(isset($fio[2])) { ?>
            <param name="Отчество"><?php echo $fio[2]; ?></param>
            <?php } ?>
            <param name="Годы опыта"><?php echo $exp; ?></param>
            <param name="Начало карьеры"><?php echo get_field('experience'); ?>-01-01</param>
            <param name="Город">г. Москва</param>
            <param name="Взрослый врач">true</param>
            <param name="Детский врач">false</param>
            <param name="Средняя оценка">5</param>
            <param name="Число отзывов"><?php echo $query_reviews->found_posts; ?></param>
            <?php if(get_the_ID()==5528 || get_the_ID()==7372 || get_the_ID()==7366 || get_the_ID()==5788): ?>
            <param name="Степень">Кандидат наук</param>
            <?php endif; ?>
            <param name="Город клиники">г. Москва</param>
            <param name="Адрес клиники"><?php echo $branch_address; ?></param>
            <param name="Название клиники"><?php echo $branch_name; ?></param>
            <param name="Возможность записи">true</param>
            <param name="Онлайн-расписание">false</param>
            <param name="Телефон для записи">+74957752001</param>
            <?php
                $n=0;
                while( have_rows('education') ): the_row(); $n++;
                    $education_year = get_sub_field('year');
                    $education_text = get_sub_field('education_text');
            ?>
            <param name="Образование - <?php echo $n; ?>" unit="Организация"><?php echo $education_text; ?></param>
            <?php if($education_year) { ?>
            <param name="Образование - <?php echo $n; ?>" unit="Дата"><?php echo $education_year; ?></param>
            <?php } ?>
            <?php
                endwhile;
            ?>
            <?php
                if ( $query_reviews->have_posts() ) {
                    $n=0;
                    while( $query_reviews->have_posts() ) {
                        $n++;
                        $query_reviews->the_post();
            ?>
            <param name="Отзыв - <?php echo $n; ?>" unit="Автор"><?php echo get_field('author_name'); ?></param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Дата"><?php the_time('Y-m-j h:i:s'); ?></param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Отзыв проверен">true</param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Отзыв участвует в рейтинге">true</param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Оценка">5</param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Комментарий"><?php echo strip_tags(get_the_content()); ?></param>
            <param name="Отзыв - <?php echo $n; ?>" unit="Ссылка"><?php echo get_permalink($doctor_id); ?></param>
            <?php }
            } ?>
        </offer>
<?php
    }
?>
        </offers>
    </shop>
</yml_catalog>