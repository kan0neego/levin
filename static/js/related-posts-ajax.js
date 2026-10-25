/**
 * related-posts-ajax.js
 * AJAX infinite scroll для похожих записей (.js-ajax-load)
 */

jQuery(function ($) {
    $('.js-ajax-load').each(function () {
        var $ajaxLoader = $(this);
        var $preloader  = $ajaxLoader.find('.js-ajax-load__preloader');
        var $listing    = $ajaxLoader.find('.js-ajax-load__listing');
        var $tpl        = $ajaxLoader.find('.js-ajax-load__item-tpl');
        var $firstItem  = false;
        var tplHtml     = $tpl.html();
        var url         = $ajaxLoader.data('url');
        var id          = $ajaxLoader.data('id');
        var got         = $ajaxLoader.data('got').split(',');
        var finish      = false;
        var loading     = false;

        $(window).on('scroll', function () {
            var scrollBottom = $(window).scrollTop() + $(window).height();
            var firstItemTop = $firstItem && $firstItem.length ? $firstItem.offset().top : 300;

            if (scrollBottom >= firstItemTop && !finish && !loading) {
                loading = true;
                $preloader.addClass('active');

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: { id: id, got: got.join(',') },
                    success: function (response) {
                        if (!response) { $preloader.removeClass('active'); loading = false; return; }
                        if (response.items.length) {
                            response.items.forEach(function (item, k) {
                                var html = tplHtml;
                                for (var key in item) {
                                    if (item.hasOwnProperty(key)) html = html.replace('${' + key + '}', item[key]);
                                }
                                var $item = $(html);
                                $listing.append($item);
                                if (k === 0) $firstItem = $item;
                                got.push(item.id);
                            });
                        }
                        finish = response.finish;
                    },
                    complete: function () { $preloader.removeClass('active'); loading = false; }
                });
            }
        });
    });
});
