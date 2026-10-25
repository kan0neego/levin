/**
 * utils.js
 * Глобальные утилиты: --vh, is_mobile(), видео-хуки ховера
 */

// ─── CSS-переменная --vh ───────────────────────────────────────────────────

(function () {
    var vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', vh + 'px');
})();

// ─── is_mobile ─────────────────────────────────────────────────────────────

function is_mobile() {
    return (/iphone|ipod|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) && (screen.width < 767);
}

