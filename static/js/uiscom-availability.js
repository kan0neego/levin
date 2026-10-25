/**
 * uiscom-availability.js
 *
 * Проверяет доступность app.uiscom.ru в браузере посетителя.
 * Если хост не отвечает, в модальном окне скрывается контент
 * «онлайн»-режима и показывается блок «Позвоните по номеру телефона».
 *
 * Скрипт не зависит от селекторов темы и работает только с собственными
 * маркерами разметки:
 *   [data-uiscom-check]          — корень виджета;
 *   [data-uiscom-view="online"]  — тело, которое нужно скрыть;
 *   [data-uiscom-view="offline"] — тело, которое нужно показать.
 *
 * Подключается в inc/load-styles.php вместе с wp_localize_script('uiscomCheck').
 */
(() => {
    'use strict';

    const ROOT_SELECTOR = '[data-uiscom-check]';
    const VIEW_ATTR = 'data-uiscom-view';
    const ONLINE = 'online';
    const OFFLINE = 'offline';
    const DONE_ATTR = 'data-uiscom-offline';

    const DEFAULTS = {
        url: 'https://app.uiscom.ru/',
        timeout: 5000,
    };

    const isAvailable = async (url, timeout) => {
        const controller = new AbortController();

        const options = {
            method: 'GET',
            mode: 'no-cors',
            cache: 'no-store',
            redirect: 'follow',
        };

        if (controller) options.signal = controller.signal;

        const timer = setTimeout(() => {
            if (controller) {
                controller.abort();
            }
        }, timeout);

        const clearTimer = () => clearTimeout(timer);

        return fetch(url, options)
            .then(() => {
                clearTimer();
                return true;
            })
            .catch(() => {
                clearTimer();
                return false;
            });
    };

    // Кэш проверки: один запрос на страницу независимо от числа корней.
    let availabilityPromise = null;

    const getAvailability = (config) => {
        if (!availabilityPromise) {
            availabilityPromise = isAvailable(config.url, config.timeout);
        }
        return availabilityPromise;
    };

    const collectViews = (root) => {
        const online = [];
        const offline = [];

        root.querySelectorAll(`[${VIEW_ATTR}]`).forEach((view) => {
            const value = view.getAttribute(VIEW_ATTR);
            if (value === ONLINE) online.push(view);
            if (value === OFFLINE) offline.push(view);
        });

        return { online, offline };
    };

    const swapToPhone = (root) => {
        if (root.hasAttribute(DONE_ATTR)) return;

        const { online, offline } = collectViews(root);
        if (!online.length && !offline.length) return;

        online.forEach((view) => (view.hidden = true));
        offline.forEach((view) => (view.hidden = false));

        root.setAttribute(DONE_ATTR, '');
    };

    const handleRoot = (root, config) => {
        getAvailability(config).then((available) => {
            if (!available) swapToPhone(root);
        });
    };

    const init = () => {
        const config = window.uiscomCheck || {};
        const url = config.url || DEFAULTS.url;
        const timeout = config.timeout || DEFAULTS.timeout;

        const root = document.querySelector(ROOT_SELECTOR);

        if (root) {
            handleRoot(root, { url, timeout });
            return;
        }

        // Страховка для ленивой подгрузки модалки
        // ждём появления корня в DOM и запускаем проверку.
        if (!('MutationObserver' in window)) return;

        const observer = new MutationObserver((mutations) => {
            for (const mutation of mutations) {
                for (const node of mutation.addedNodes) {
                    if (node.nodeType !== 1) continue;

                    const matchesRoot =
                        typeof node.matches === 'function' &&
                        node.matches(ROOT_SELECTOR);
                    const target = matchesRoot
                        ? node
                        : typeof node.querySelector === 'function'
                          ? node.querySelector(ROOT_SELECTOR)
                          : null;

                    if (target) {
                        observer.disconnect();
                        handleRoot(target, { url, timeout });
                        return;
                    }
                }
            }
        });

        observer.observe(document.body, { childList: true, subtree: true });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
