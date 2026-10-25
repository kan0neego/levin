/**
 * reviews-load-more.js
 * Догрузка отзывов по кнопке «Показать ещё».
 * Параметры (type, doctor_id, базовый URL) приходят
 * из wp_localize_script() в window.reviewsLoadMore.
 */

(function ($) {
    'use strict';

    function init(config) {
        var $button = $('.reviews-load_more__button');
        var $preloader = $('.reviews-preloader');

        // Данные приходят из PHP (wp_localize_script в load-more-reviews.php).
        var type = (config && config.type) || 'all';
        var doctorId = (config && config.doctor_id) || '';
        var homeUrl = (config && config.home_url) || '';
        var iconUrl = (config && config.icon_url) || '';

        function reviewCard(r) {
            return '' +
                '<div class="reviews-card reviews-card_page">' +
                '  <div class="reviews-card__header">' +
                '    <div class="reviews-card__header-author">' +
                '      <div class="reviews-card__wrap">' +
                '        <div class="reviews-card__wrap-name">' +
                '          <div class="rating-star">' +
                '            <span class="rating-star__active"></span>' +
                '            <span class="rating-star__active"></span>' +
                '            <span class="rating-star__active"></span>' +
                '            <span class="rating-star__active"></span>' +
                '            <span class="rating-star__active"></span>' +
                '          </div>' +
                '          <span></span>' +
                '          <span>' + r.author_name + ', ' + r.date + '</span>' +
                '        </div>' +
                '        <a href="#"><img src="' + r.source + '" alt=""></a>' +
                '      </div>' +
                '    </div>' +
                '  </div>' +
                '  <div class="reviews-card__body">' +
                '    <div class="reviews-card__name">' + r.post_title + '</div>' +
                '    <div class="reviews-card__text">' + r.post_content + '</div>' +
                '  </div>' +
                '  ' + r.doctors +
                '</div>';
        }

        function insertDoctors(doctors) {
            if (!doctors || doctors.length === 0 || type !== 'all') {
                return '';
            }

            var html = '<span class="reviews-card_subtitle">Лечащие врачи</span> <div class="reviews-card__footer">';

            doctors.forEach(function (doctor) {
                html += '<a href="' + homeUrl + '/' + doctor.post_name + '">' +
                    '<div class="doctor-content">' +
                    '<div class="doctor-content__image"><img src="' + doctor.ava + '"></div>' +
                    '<div class="doctor-content__text">' +
                    '<b>' + doctor.post_title + '</b>' +
                    '<span>' + doctor.post_excerpt + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</a>';
            });

            html += '</div> <img class="iconreviews" src="' + iconUrl + '">';

            return html;
        }

        $button.on('click', function () {
            var $buttonEl = $(this);
            $preloader.css('display', 'block');

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                dataType: 'json',
                data: {
                    type: type,
                    doctor_id: doctorId,
                    action: 'get_reviews',
                    posts_per_page: 10,
                    offset: $('.reviews-card').length
                },
                success: function (data) {
                    $preloader.css('display', 'none');

                    var reviews = (data && data.reviews) || [];

                    if (data && (data.reviews_end === true || reviews.length === 0)) {
                        $buttonEl.css('display', 'none');
                    }

                    reviews.forEach(function (review) {
                        review.doctors = insertDoctors(review.doctors || []);
                    });

                    var newCardsHtml = reviews.map(reviewCard).join('');
                    $('.reviews-card_page:last').after(newCardsHtml);
                }
            });
        });
    }

    if (typeof window.reviewsLoadMoreConfig !== 'undefined') {
        $(function () {
            init(window.reviewsLoadMoreConfig);
        });
    }
})(jQuery);
