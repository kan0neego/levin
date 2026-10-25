/**
 * lazy-video.js
 * Ленивая загрузка видео через IntersectionObserver (video.lazy)
 */

// Поддержка динамической загрузки: если 'DOMContentLoaded' уже сработал — вызываем сразу
(function () {
    function initLazyVideo() {
        var lazyVideos = [].slice.call(document.querySelectorAll('video.lazy'));
        if (!('IntersectionObserver' in window)) return;

        var lazyVideoObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var video = entry.target;
                for (var i = 0; i < video.children.length; i++) {
                    var source = video.children[i];
                    if (source.tagName === 'SOURCE') source.src = source.dataset.src;
                }
                video.load();
                video.classList.remove('lazy');
                lazyVideoObserver.unobserve(video);
            });
        });

        lazyVideos.forEach(function (v) { lazyVideoObserver.observe(v); });
    }

    if (document.readyState !== 'loading') {
        initLazyVideo();
    } else {
        document.addEventListener('DOMContentLoaded', initLazyVideo);
    }
})();
