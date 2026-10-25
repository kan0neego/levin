/**
 * mobile-header.js
 * Открытие/закрытие сайдбара по клику на .mobile-header__trigger.
 */
(function () {
    var sidebar = document.querySelector('.sidebar');
    var header  = document.querySelector('.mobile-header');
    if (!sidebar || !header) return;

    var trigger = header.querySelector('.mobile-header__trigger');
    if (!trigger) return;

    function close() {
        var wrapper = document.getElementById('wrapper');
        if (wrapper) wrapper.classList.remove('shade');
        header.classList.remove('mobile-header_active');
        trigger.classList.remove('mobile-header__trigger_active');
        sidebar.style.display = '';
        sidebar.classList.remove('sidebar_active');
        header.dataset.mobileOpen = 'false';
    }

    function open() {
        var wrapper = document.getElementById('wrapper');
        if (wrapper) wrapper.classList.add('shade');
        header.classList.add('mobile-header_active');
        trigger.classList.add('mobile-header__trigger_active');
        sidebar.style.display = 'block';
        sidebar.classList.add('sidebar_active');
        header.dataset.mobileOpen = 'true';
    }

    close();

    trigger.addEventListener('click', function () {
        if (header.dataset.mobileOpen === 'true') {
            close();
        } else {
            open();
        }
    });

    var wrapper = document.getElementById('wrapper');
    if (wrapper) {
        wrapper.addEventListener('click', function () {
            close();
        });
    }
})();
