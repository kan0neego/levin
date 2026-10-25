/**
 * lead-attribution.js
 * Первое касание сессии: точка входа, реферер и UTM-метки для заявки.
 * Пишет в sessionStorage; повторный заход в той же вкладке не перезаписывает.
 *
 * Подключается из inc/enqueues.php. forms-handler.js читает window.levinLeadAttr.
 */
function createLeadAttribution() {
    const STORAGE_KEY = "levin_lead_attr";

    function parseUtms(search) {
        const utm = {};
        if (!search) {
            return utm;
        }

        const rawQuery = String(search);
        const query =
            rawQuery.charAt(0) === "?" ? rawQuery.slice(1) : rawQuery;

        query.split("&").forEach(function (pair) {
            if (!pair) {
                return;
            }
            const parts = pair.split("=");
            try {
                const key = decodeURIComponent(
                    (parts[0] || "").replace(/\+/g, " "),
                ).toLowerCase();
                const value = decodeURIComponent(
                    (parts.slice(1).join("=") || "").replace(/\+/g, " "),
                ).trim();
                if (key.indexOf("utm_") !== 0) {
                    return;
                }
                if (!/^utm_[a-z0-9_]+$/.test(key)) {
                    return;
                }
                if (value) {
                    utm[key] = value;
                }
            } catch (e) {
                return;
            }
        });

        return utm;
    }

    function parseStored(raw) {
        if (!raw) {
            return null;
        }
        try {
            const data = JSON.parse(raw);
            if (!data || typeof data !== "object" || !data.entry) {
                return null;
            }
            if (
                !data.utm ||
                typeof data.utm !== "object" ||
                Array.isArray(data.utm)
            ) {
                data.utm = {};
            }
            return data;
        } catch (e) {
            return null;
        }
    }

    function capture(locationHref, referrer, existing) {
        if (existing && existing.entry) {
            return existing;
        }

        const href = locationHref || "";
        const queryIndex = href.indexOf("?");
        const hashIndex =
            queryIndex === -1 ? -1 : href.indexOf("#", queryIndex);
        const search =
            queryIndex === -1
                ? ""
                : hashIndex === -1
                  ? href.slice(queryIndex)
                  : href.slice(queryIndex, hashIndex);

        return {
            entry: href,
            referrer: referrer || "",
            utm: parseUtms(search),
        };
    }

    function persist(storage, locationHref, referrer) {
        const existing =
            storage && typeof storage.getItem === "function"
                ? parseStored(storage.getItem(STORAGE_KEY))
                : null;

        const data = capture(locationHref, referrer, existing);

        if (storage && typeof storage.setItem === "function") {
            try {
                storage.setItem(STORAGE_KEY, JSON.stringify(data));
            } catch (e) {
                /* quota / private mode — оставляем данные в памяти */
            }
        }

        return data;
    }

    return {
        STORAGE_KEY: STORAGE_KEY,
        parseUtms: parseUtms,
        capture: capture,
        persist: persist,
        parseStored: parseStored,
    };
}

(function (window, factory) {
    const api = factory();

    if (typeof module !== "undefined" && module.exports) {
        module.exports = api;
    }

    window.levinLeadAttribution = api;

    if (
        typeof window.sessionStorage === "undefined" ||
        typeof window.location === "undefined"
    ) {
        return;
    }

    const referrer = window.document ? window.document.referrer : "";
    window.levinLeadAttr = api.persist(
        window.sessionStorage,
        window.location.href,
        referrer,
    );
})(window, createLeadAttribution);
