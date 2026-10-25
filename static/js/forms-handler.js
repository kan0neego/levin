/**
 * ============================================================
 *  УНИВЕРСАЛЬНЫЙ ОБРАБОТЧИК ФОРМ — forms-handler.js
 *  Проект: doctorlevin.ru
 * ============================================================
 *
 * НАЗНАЧЕНИЕ
 * ----------
 * Заменяет Contact Form 7 (CF7): обрабатывает отправку форм,
 * маску телефона, валидацию, отправку на сервер и в Comagic.
 *
 * КАК ФОРМА ОПРЕДЕЛЯЕТСЯ В ОБРАБОТЧИКЕ
 * --------------------------------------
 * Каждая форма в HTML должна иметь атрибут data-form-type.
 * Возможные значения:
 *
 *   data-form-type="consultation"  — Запись на консультацию
 *   data-form-type="skk"           — Служба контроля качества
 *   data-form-type="question"      — Задать вопрос
 *   data-form-type="director"      — Написать директору клиники
 *
 * HTML-разметка форм генерируется PHP-шорткодом в файле:
 *   wp-content/themes/sd-03-2_new/inc/shortcodes.php
 *   (функции custom_cf7_consultation, custom_cf7_skk, и т.д.)
 *
 * КУДА ОТПРАВЛЯЮТСЯ ДАННЫЕ
 * ------------------------
 * 1. lead-form.php (email-уведомление на почту)
 *    Путь: /wp-content/themes/sd-03-2_new/inc/lead-form.php
 *    Метод: POST, Content-Type: application/x-www-form-urlencoded
 *    Получатели: call@doctorlevin.ru, uv@doctorlevin.ru
 *    Поля: phone, formType, initial_src, last_src, referrer, utm
 *          (+ name, email, message для skk/question/director)
 *    attribution: static/js/lead-attribution.js → sessionStorage / window.levinLeadAttr
 *    Ответ: строка "Ok" при успехе
 *
 * 2. Comagic (CRM / телефония)
 *    Вызов: window.Comagic.addOfflineRequest({ phone, name?, message? })
 *    Если Comagic не загружен на странице — вызов пропускается без ошибки.
 *
 * Отправка в ajax.php и Comagic происходит параллельно (Promise.allSettled).
 * Форма считается успешно отправленной, если хотя бы один канал вернул успех.
 *
 * ЦЕЛИ ЯНДЕКС.МЕТРИКИ
 * --------------------
 * Срабатывают только для формы consultation:
 *   ym(38009025, "reachGoal", "callback")       — Яндекс.Метрика
 *   _tmr.push({ type:"reachGoal", id:3289173, goal:"general" })  — VK Пиксель
 *
 * УСПЕШНАЯ ОТПРАВКА (UX)
 * -----------------------
 *   consultation — добавляет класс "response" на ближайший .modal
 *                  (CSS переключает .modal-content ↔ .modal-response)
 *   остальные    — скрывает .form-fields, показывает .form-success
 *
 * КАК ДОБАВИТЬ НОВУЮ ФОРМУ
 * ------------------------
 * 1. В shortcodes.php создать функцию custom_cf7_XXX() с разметкой.
 *    Указать в <form>: class="wpcf7-form init form-data" data-form-type="XXX"
 * 2. Добавить case 'ID_ФОРМЫ' в switch внутри custom_cf7_replacement().
 * 3. Телефонное поле должно иметь класс wpcf7-tel — маска и валидация
 *    подключаются автоматически.
 * 4. При необходимости добавить новый data-form-type в handleSubmit()
 *    для сбора специфических полей или нестандартного поведения после отправки.
 *
 * ФАЙЛЫ, ЗАДЕЙСТВОВАННЫЕ В СИСТЕМЕ ФОРМ
 * ----------------------------------------
 *   JS:  static/js/forms-handler.js          (этот файл)
 *   PHP: inc/shortcodes.php                  (генерация HTML форм)
 *   PHP: ajax.php                            (отправка email)
 * ============================================================
 */
(function () {
    function init() {
        // Конфигурация
        const lead = window.levin_lead || {};

        const config = {
            phonePattern: /^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/,
            ajaxUrl: lead.url || "/wp-admin/admin-ajax.php",
            action: lead.action || "levin_lead",
            nonce: lead.nonce || "",
            errorClass: "input-invalid",
        };

        // Маска телефона (как в Т-банке)
        function initPhoneInput(input) {
            if (!input) return null;

            function setCursorPosition(pos, elem) {
                elem.focus();
                if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
            }

            function mask(event) {
                let keyCode = event.keyCode;
                const selectionStart = input.selectionStart;
                const selectionEnd = input.selectionEnd;
                const oldValue = input.value;

                const matrix = "+7 (___) ___-__-__";
                let i = 0;
                const def = matrix.replace(/\D/g, "");
                let val = input.value.replace(/\D/g, "");
                let new_value = matrix.replace(/[_\d]/g, (a) =>
                    i < val.length ? val.charAt(i++) || def.charAt(i) : a
                );

                i = new_value.indexOf("_");
                if (i !== -1) {
                    if (i < 5) i = 4;
                    new_value = new_value.slice(0, i);
                }

                const reg = new RegExp(
                    "^" +
                    matrix
                        .substr(0, input.value.length)
                        .replace(/_+/g, (a) => "\\d{1," + a.length + "}")
                        .replace(/[+()]/g, "\\$&") +
                    "$"
                );

                if (
                    !reg.test(input.value) ||
                    input.value.length < 5 ||
                    (keyCode >= 48 && keyCode <= 57)
                ) {
                    input.value = new_value;
                }

                let newPos = selectionStart;
                if (document.activeElement === input) {
                    if (newPos < 4) newPos = 4;
                    else newPos = selectionEnd + (input.value.length - oldValue.length);
                    setCursorPosition(newPos, input);
                }

                if (event.type === "blur" && input.value.length <= 5) {
                    input.value = "+7 (";
                }
            }

            function onFocus(event) {
                if (input.value.length === 0) {
                    input.value = "+7 (";
                    setTimeout(() => setCursorPosition(4, input), 0);
                }
                mask(event);
            }

            input.addEventListener("input", mask);
            input.addEventListener("focus", onFocus);
            input.addEventListener("blur", mask);
            input.addEventListener("keydown", (event) => {
                if (
                    event.key === "Tab" ||
                    event.key.startsWith("Arrow") ||
                    event.key === "Backspace" ||
                    event.key === "Delete"
                )
                    return;
                mask(event);
            });

            return {
                reset() {
                    input.value = "+7 (";
                    setCursorPosition(4, input);
                },
            };
        }

        // Валидация формы
        function validateForm(form) {
            let isValid = true;

            // Обязательные поля (атрибут required)
            form.querySelectorAll("[required]").forEach((field) => {
                if (!field.value.trim()) {
                    field.classList.add(config.errorClass);
                    isValid = false;
                }
            });

            // Телефон — валидация формата если заполнен (или обязателен)
            const phoneInput = form.querySelector("input.wpcf7-tel");
            if (phoneInput) {
                const value = phoneInput.value.trim();
                const isRequired = phoneInput.hasAttribute("required") || phoneInput.getAttribute("aria-required") === "true";
                const hasContent = value && value !== "+7 (";
                if ((isRequired && !hasContent) || (hasContent && !config.phonePattern.test(value))) {
                    phoneInput.classList.add(config.errorClass);
                    isValid = false;
                }
            }

            return isValid;
        }

        // Убрать ошибку при вводе
        function attachClearError(form) {
            form.querySelectorAll("input, textarea").forEach((field) => {
                field.addEventListener("input", () =>
                    field.classList.remove(config.errorClass)
                );
            });
        }

        // Показать успех
        function showSuccess(form) {
            const modal = form.closest(".modal");
            const formType = form.dataset.formType;

            if (formType === "consultation" && modal) {
                // Добавляем класс response — CSS переключает .modal-response / .modal-content
                modal.classList.add("response");
            } else {
                const fields = form.querySelector(".form-fields");
                const success = form.querySelector(".form-success");
                if (fields) fields.style.display = "none";
                if (success) success.style.display = "block";
            }
        }

        // Сброс формы
        function resetForm(form) {
            form.querySelectorAll("input, textarea").forEach((field) => {
                if (field.classList.contains("wpcf7-tel")) {
                    field.value = "+7 (";
                } else if (field.type !== "checkbox" && field.type !== "submit") {
                    field.value = "";
                }
                field.classList.remove(config.errorClass);
            });
        }

        function getLeadAttribution() {
            const api = window.levinLeadAttribution;
            if (api && typeof api.persist === "function" && typeof sessionStorage !== "undefined") {
                return api.persist(sessionStorage, window.location.href, document.referrer || "");
            }
            if (window.levinLeadAttr && window.levinLeadAttr.entry) {
                return window.levinLeadAttr;
            }
            try {
                return JSON.parse(sessionStorage.getItem("levin_lead_attr") || "{}") || {};
            } catch (e) {
                return {};
            }
        }

        // Отправка на сервер
        function sendToServer(data) {
            var t0 = performance.now();
            return fetch(config.ajaxUrl, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams(
                    Object.assign({}, data, { action: config.action, nonce: config.nonce })
                ),
            })
                .then((r) => r.text())
                .then((text) => {
                    var ms = Math.round(performance.now() - t0);
                    var raw = text.trim();
                    var parts = raw.split(":");
                    var ok = parts[0].toLowerCase() === "ok";
                    var reqId = parts[1] || "";
                    console.log("[form-timing] ajax.php: " + ms + "ms, ответ: " + raw);
                    return { success: ok, ms: ms, reqId: reqId };
                })
                .catch((err) => {
                    var ms = Math.round(performance.now() - t0);
                    console.warn("[form-timing] ajax.php ОШИБКА: " + ms + "ms", err);
                    return { success: false, error: err, ms: ms };
                });
        }

        // Отправка в Comagic
        function sendToComagic(data) {
            var t0 = performance.now();
            return new Promise((resolve) => {
                if (!window.Comagic) {
                    console.log("[form-timing] Comagic: не загружен, пропуск");
                    resolve({ success: false, ms: 0 });
                    return;
                }
                const comagicData = { phone: data.phone };
                if (data.name) comagicData.name = data.name;
                if (data.message) comagicData.message = data.message;

                try {
                    Comagic.addOfflineRequest(
                        comagicData,
                        () => { var ms = Math.round(performance.now() - t0); console.log("[form-timing] Comagic: " + ms + "ms, ok"); resolve({ success: true, ms: ms }); },
                        () => { var ms = Math.round(performance.now() - t0); console.warn("[form-timing] Comagic: " + ms + "ms, fail"); resolve({ success: false, ms: ms }); }
                    );
                } catch (e) {
                    var ms = Math.round(performance.now() - t0);
                    console.warn("[form-timing] Comagic: " + ms + "ms, exception", e);
                    resolve({ success: false, ms: ms });
                }
            });
        }

        // Основной обработчик отправки
        async function handleSubmit(form) {
            if (!validateForm(form)) return;

            const submitBtn = form.querySelector('[type="submit"]');
            const formType = form.dataset.formType || "consultation";
            const formData = new FormData(form);

            // Телефон — ищем по классу (имя поля зависит от формы)
            const phoneInput = form.querySelector("input.wpcf7-tel");
            const phoneValue = phoneInput?.value?.trim() || "";

            const data = {
                formType,
                phone: phoneValue,
                last_src: window.location.href,
            };

            const attribution = getLeadAttribution();
            data.initial_src = attribution.entry || "";
            data.referrer = attribution.referrer || "";
            data.utm = JSON.stringify(attribution.utm || {});

            // Дополнительные поля для СКК и вопроса
            // Поддерживаем все варианты имён CF7-полей
            if (formType !== "consultation") {
                const name = (formData.get("person-name") || formData.get("text-273") || formData.get("name") || "").trim();
                const email = (formData.get("person-email") || formData.get("email-299") || formData.get("email") || "").trim();
                const message = (formData.get("person-comment") || formData.get("textarea-438") || formData.get("message") || "").trim();
                if (name) data.name = name;
                if (email) data.email = email;
                if (message) data.message = message;
            }

            // Honeypot (скрытое поле levin_hp): если оно заполнено — заявку отправил бот.
            // Сервер ответит «Ok», но письмо не отправит (см. inc/lead-form.php).
            const honeypot = formData.get("levin_hp");
            if (honeypot) data.levin_hp = honeypot;

            submitBtn && (submitBtn.disabled = true);
            submitBtn?.classList.add("is-loading");

            try {
                var t0Total = performance.now();
                console.log("[form-timing] === Отправка формы: " + formType + " ===");
                const isCanary = data.phone === '+7 (000) 000-00-00' || data.email === 'health-check@canary.test';
                const [serverResult, comagicResult] = await Promise.allSettled([
                    sendToServer(data),
                    isCanary ? Promise.resolve({ success: true }) : sendToComagic(data),
                ]);

                const serverOk = serverResult.value?.success;
                const comagicOk = comagicResult.value?.success;
                var totalMs = Math.round(performance.now() - t0Total);
                var ajaxMs = serverResult.value?.ms || '?';
                var comagicMs = comagicResult.value?.ms || '?';
                var comagicStatus = comagicResult.value?.success ? 'ok' : 'fail';
                console.log("[form-timing] ИТОГО: " + totalMs + "ms | ajax=" + ajaxMs + "ms | comagic=" + comagicMs + "ms | результат: " + (serverOk || comagicOk ? 'ОК' : 'ОШИБКА'));

                // Отправляем тайминги Comagic и итого в серверный лог
                try {
                    var logReqId = serverResult.value?.reqId || '?';
                    fetch(config.ajaxUrl, {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: new URLSearchParams({
                            formType: "_timing",
                            req_id: logReqId,
                            line: "COMAGIC " + comagicMs + "ms result=" + comagicStatus + " | ИТОГО " + totalMs + "ms",
                            action: config.action,
                            nonce: config.nonce,
                        }),
                    });
                } catch (e) { /* тайминг-лог не критичен */ }

                if (serverOk || comagicOk) {
                    showSuccess(form);
                    resetForm(form);

                    // Цели Яндекс.Метрики
                    if (formType === "consultation") {
                        if (typeof ym !== "undefined")
                            ym(38009025, "reachGoal", "callback");
                        if (typeof _tmr !== "undefined")
                            _tmr.push({ type: "reachGoal", id: 3289173, goal: "general" });
                        console.log("Goal reached: callback");
                    }
                } else {
                    console.warn("Ошибка отправки формы", { serverResult, comagicResult });
                }
            } catch (e) {
                console.error("Неожиданная ошибка формы:", e);
            } finally {
                submitBtn && (submitBtn.disabled = false);
                submitBtn?.classList.remove("is-loading");
            }
        }

        // Инициализация форм
        window.initForms = function () {
            document.querySelectorAll(".form-data").forEach((form) => {
                const phoneInput = form.querySelector("input.wpcf7-tel");

                if (phoneInput) {
                    const handler = initPhoneInput(phoneInput);
                    // В модальном окне сразу ставим +7 (
                    if (form.closest(".modal")) handler?.reset();
                }

                attachClearError(form);

                form.addEventListener("submit", (e) => {
                    e.preventDefault();
                    handleSubmit(form);
                });
            });
        };

        initForms();
    }

    if (document.readyState !== 'loading') {
        init();
    } else {
        document.addEventListener('DOMContentLoaded', init);
    }

    // Ширина скроллбара в CSS-переменную — используется для компенсации при открытии модалок
    (function () {
        const w = window.innerWidth - document.documentElement.clientWidth;
        document.documentElement.style.setProperty('--scrollbar-width', w + 'px');
    })();

    // Блокировка скролла при открытии Bootstrap-модалок (без overflow на body — иначе ломается sticky)
    (function () {
        function preventScroll(e) {
            if (e.target && e.target.closest && e.target.closest('.modal')) return;
            e.preventDefault();
        }
        const scrollKeys = ['ArrowUp', 'ArrowDown', 'PageUp', 'PageDown', 'Home', 'End', ' '];
        function preventKeys(e) { if (scrollKeys.includes(e.key)) e.preventDefault(); }

        function lockScroll() {
            document.documentElement.style.overflowY = 'hidden';
            document.addEventListener('wheel', preventScroll, { passive: false });
            document.addEventListener('touchmove', preventScroll, { passive: false });
            document.addEventListener('keydown', preventKeys);
        }

        function unlockScroll() {
            document.documentElement.style.overflowY = '';
            document.removeEventListener('wheel', preventScroll);
            document.removeEventListener('touchmove', preventScroll);
            document.removeEventListener('keydown', preventKeys);
        }

        function attachModalScrollLock() {
            if (typeof jQuery === 'undefined') return;
            jQuery(document)
                .on('show.bs.modal', lockScroll)
                .on('hidden.bs.modal', unlockScroll);
        }

        if (document.readyState !== 'loading') {
            attachModalScrollLock();
        } else {
            document.addEventListener('DOMContentLoaded', attachModalScrollLock);
        }
    })();
})();
