<div class="footer-brand">
    <div class="page__container">
        <div class="footer-brand__wrap">
            <div class="footer-brand-logo">
                <div class="footer-brand-logo-text">
                    © 2007-<?php echo date("Y"); ?> <?php the_field( 'copyright_footer','option' ); ?>
                </div>
            </div>
            <div class="footer-brand-info">
                <?php the_field( 'copyright_footer_license','option' ); ?>
            </div>
        </div>
    </div>
</div>