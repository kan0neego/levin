<?php
if (!is_page_template('page-feedback.php') && !is_page_template('page-skk.php')) {

    if ( is_singular( 'doctors' ) == false  && is_post_type_archive( 'doctors' ) == false && is_page( 11708 ) == false && is_page( 12684 ) == false && is_page( 20486 ) == false ) {
        get_template_part('template-parts/footer/footer-gallery');
    }

    if ( is_page( 20486 ) == true ) {
        get_template_part('template-parts/footer/footer-gallery-unv');
    }
?>
                            <div class="footer-block">
                                <div class="page__container">
                                    <div class="footer-block__wrap">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'footer_primary',
                                            'walker' => new Footer_Primary_Menu_Walker(),
                                                'container' => '',
                                            'container_class' => '',
                                            'menu_class' => '',
                                            'items_wrap'      => '%3$s',
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="footer-white">
                                <div class="page__container">
                                    <div class="footer-white__name">О Центре</div>
                                    <div class="footer-white__wrap">
                                        <div class="footer-white__col">
                                            <div class="footer-white__menu">
                                                <div class="footer-white__menu-col">
                                                    <?php 
                                                        wp_nav_menu( array(
                                                            'theme_location'  => 'footer_secondary',
                                                            'container'       => false,
                                                            'menu_class'      => '',
                                                            'items_wrap'      => '<ul>%3$s</ul>',
                                                            'echo'            => true,
                                                            'fallback_cb'     => '__return_false'
                                                        ) ); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php get_template_part('template-parts/footer/footer-brand'); ?>
            </div><!-- page-content-wrapper -->
        </div><!-- wrapper -->

    <?php get_template_part('template-parts/modals/modal-feedback'); ?>

    <?php get_template_part('template-parts/modals/modal-leadform'); ?>

    <?php get_template_part('template-parts/modals/modal-offer'); ?>

    <?php get_template_part('template-parts/modals/modal-skk'); ?>

    <?php
    } // закрываем проверку на шаблон отзывов 
    ?>

    <?php
    if( is_page( 20501 ) == false && is_page( 20662 ) == false ) :
        get_template_part('template-parts/menu/mobile-menu');
    endif;
    ?>
    <?php wp_footer(); ?>
    </body>
</html>
