/**
 * yandex-maps.js
 * Инициализация Яндекс.Карт (перенесено из custom.js)
 * — Страница контактов: contactsMap, contactsMapUnv, contactsMapFoot
 * — Карты в модальном окне #myModal: mapConctUnv, mapConct
 */

// ─── Карты на странице контактов ───────────────────────────────────────────

// Поддержка динамической загрузки: если 'load' уже сработал — вызываем сразу
(function () {
    function initMaps() {
        var hasMap = document.getElementById('contactsMap') ||
                     document.getElementById('contactsMapBranch') ||
                     document.getElementById('contactsMapUnv') ||
                     document.getElementById('contactsMapFoot');
        if (!hasMap) return;

        $.getScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=4faa739a-3fde-4da7-ad0f-3f9f571a716e', function () {

            ymaps.ready(function () {
                var w = $(window).width();
                var mapZoom     = w <= 767 ? 15 : (w <= 1025 ? 15 : 17);
                var mapZoomFoot = w <= 767 ? 15 : (w <= 1025 ? 15 : 16);
                var mapZoomUnv  = w <= 767 ? 13 : (w <= 1025 ? 13 : 16);

                // Страница отдельного филиала (координаты из data-атрибутов)
                if ($('#contactsMapBranch').length > 0) {
                    var branchEl  = document.getElementById('contactsMapBranch');
                    var centerStr = w <= 767
                        ? branchEl.dataset.centerMobile
                        : branchEl.dataset.centerDesktop;
                    var markerStr = branchEl.dataset.marker;
                    var branchCenter = centerStr.split(',').map(Number);
                    var branchMarkerCoords = markerStr.split(',').map(Number);
                    var branchZoom = w <= 767 ? 15 : 17;

                    var branchMap = new ymaps.Map('contactsMapBranch', {
                        center: branchCenter,
                        zoom: branchZoom,
                        controls: ['zoomControl']
                    });

                    var branchPlacemark = new ymaps.Placemark(branchMarkerCoords, {
                        hintContent: 'Центр приватной стоматологии Доктор Левин'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/src/img/marker-map.svg',
                        iconImageSize: [116, 130],
                        iconImageOffset: [-58, -85]
                    });

                    branchMap.geoObjects.add(branchPlacemark);
                    branchMap.behaviors.disable('multiTouch');
                    branchMap.behaviors.disable('scrollZoom');
                    if (w <= 768) {
                        branchMap.behaviors.disable('drag');
                        branchMap.controls.remove('zoomControl');
                    }
                }

                // Парк Культуры
                if ($('#contactsMap').length > 0) {
                    var myPlacemark, myPlacemarkLogo;
                    var contactsMap = new ymaps.Map('contactsMap', {
                        center: [55.732318, 37.592139],
                        zoom: mapZoom,
                        controls: ['zoomControl']
                    });

                    myPlacemark = new ymaps.Placemark([55.732022627516756, 37.589098746032406], {
                        hintContent: 'Парковка'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/parking-map.svg',
                        iconImageSize: [29, 34],
                        iconImageOffset: [-14, -33]
                    });

                    myPlacemarkLogo = new ymaps.Placemark([55.732120, 37.588526], {
                        hintContent: 'Центр приватной стоматологии Доктор Левин'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/map_logo.svg',
                        iconImageSize: [53, 53],
                        iconImageOffset: [-26.5, -36.5]
                    });

                    // var multiRoute = new ymaps.multiRouter.MultiRoute({
                    //     referencePoints: [
                    //         [55.73307037420295, 37.592708999365975],
                    //         [55.732022627516756, 37.589098746032406]
                    //     ],
                    //     params: { routingMode: 'auto', multiRoute: true }
                    // }, { wayPointVisible: false });

                    contactsMap.geoObjects.add(myPlacemark);
                    contactsMap.geoObjects.add(myPlacemarkLogo);
                    // contactsMap.geoObjects.add(multiRoute);
                    contactsMap.behaviors.disable('multiTouch');
                    contactsMap.behaviors.disable('scrollZoom');
                    if (w <= 768) contactsMap.behaviors.disable('drag');
                }

                // Университет
                if ($('#contactsMapUnv').length > 0) {
                    var contactsMapUnv = new ymaps.Map('contactsMapUnv', {
                        center: [55.68973896351863, 37.527121343200704],
                        zoom: mapZoomUnv,
                        controls: ['zoomControl']
                    });

                    var placemarkUnvParking = new ymaps.Placemark([55.69009804741229, 37.52770606476594], {
                        hintContent: 'Парковка'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/parking-map.svg',
                        iconImageSize: [29, 34],
                        iconImageOffset: [-0, -33]
                    });

                    var placemarkUnvLogo = new ymaps.Placemark([55.68967684318415, 37.527362742012045], {
                        hintContent: 'Центр приватной стоматологии Доктор Левин'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/map_logo.svg',
                        iconImageSize: [53, 53],
                        iconImageOffset: [-32, -63.5]
                    });

                    contactsMapUnv.geoObjects.add(placemarkUnvParking);
                    contactsMapUnv.geoObjects.add(placemarkUnvLogo);
                    contactsMapUnv.behaviors.disable('multiTouch');
                    contactsMapUnv.behaviors.disable('scrollZoom');
                    if (w <= 768) contactsMapUnv.behaviors.disable('drag');
                }

                // Пешеходный маршрут
                if ($('#contactsMapFoot').length > 0) {
                    var contactsMapFoot = new ymaps.Map('contactsMapFoot', {
                        center: [55.733887, 37.594496],
                        zoom: mapZoomFoot,
                        controls: ['zoomControl']
                    });

                    var placemarkFootLogo = new ymaps.Placemark([55.73226371413773, 37.58854608468744], {
                        hintContent: 'Собственный значок метки'
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/map_logo.svg',
                        iconImageSize: [53, 53],
                        iconImageOffset: [-37, -37]
                    });

                    var multiRouteFoot = new ymaps.multiRouter.MultiRoute({
                        referencePoints: [
                            [55.73532231057912, 37.59335272952943],
                            [55.73188260528515, 37.59161823336156],
                            [55.732058, 37.588320]
                        ],
                        params: { routingMode: 'pedestrian' }
                    }, { wayPointVisible: false });

                    contactsMapFoot.geoObjects.add(multiRouteFoot);
                    contactsMapFoot.geoObjects.add(placemarkFootLogo);
                    contactsMapFoot.behaviors.disable('scrollZoom');
                    contactsMapFoot.behaviors.disable('multiTouch');
                    if (w <= 768) contactsMapFoot.behaviors.disable('drag');
                }
            });
        });
    }

    if (document.readyState === 'complete') {
        initMaps();
    } else {
        window.addEventListener('load', initMaps);
    }
})();

// ─── Карты в модальном окне #myModal ───────────────────────────────────────

jQuery(function ($) {
    var mapsLoaded = false;

    $('#myModal').on('show.bs.modal', function () {
        if (mapsLoaded) return;

        $.getScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=4faa739a-3fde-4da7-ad0f-3f9f571a716e', function () {

            // Университет
            ymaps.ready(function () {
                var myMap1 = new ymaps.Map('mapConctUnv', {
                    center: [55.68973896351863, 37.527121343200704],
                    controls: ['zoomControl'],
                    zoom: 16
                });
                var pm1 = new ymaps.Placemark([55.68967684318415, 37.527362742012045], {
                    hintContent: 'Центр приватной стоматологии Доктор Левин'
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/map_logo.svg',
                    iconImageSize: [48, 48],
                    iconImageOffset: [-30, -60]
                });
                myMap1.geoObjects.add(pm1);
                myMap1.behaviors.disable('multiTouch');
                myMap1.behaviors.disable('scrollZoom');
                if ($(window).width() <= 768) myMap1.behaviors.disable('drag');
            });

            // Парк Культуры
            ymaps.ready(function () {
                var myMap2 = new ymaps.Map('mapConct', {
                    center: [55.73209, 37.58861],
                    controls: ['zoomControl'],
                    zoom: 16
                });
                var pm2 = new ymaps.Placemark([55.73209, 37.58861], {
                    hintContent: 'Центр приватной стоматологии Доктор Левин'
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '//doctorlevin.ru/wp-content/themes/sd-03-2_new/img/map_logo.svg',
                    iconImageSize: [48, 48],
                    iconImageOffset: [-36.5, -36.5]
                });
                myMap2.geoObjects.add(pm2);
                myMap2.behaviors.disable('multiTouch');
                myMap2.behaviors.disable('scrollZoom');
                if ($(window).width() <= 768) myMap2.behaviors.disable('drag');
            });

            mapsLoaded = true;
        });
    });
});
