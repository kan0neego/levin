global.window = globalThis;

const { describe, it } = require('node:test');
const assert = require('node:assert/strict');
const attr = require('./lead-attribution.js');

function memoryStore(seed) {
    const data = Object.assign({}, seed);
    return {
        getItem(key) {
            return Object.prototype.hasOwnProperty.call(data, key) ? data[key] : null;
        },
        setItem(key, value) {
            data[key] = String(value);
        },
        _data: data,
    };
}

describe('parseUtms', () => {
    it('collects utm_* pairs and ignores other query keys', () => {
        assert.deepEqual(
            attr.parseUtms('?utm_source=yandex&utm_medium=cpc&utm_campaign=implants&yclid=1'),
            {
                utm_source: 'yandex',
                utm_medium: 'cpc',
                utm_campaign: 'implants',
            }
        );
    });

    it('decodes plus-spaces and mixed case keys', () => {
        assert.deepEqual(attr.parseUtms('UTM_SOURCE=avito+ads&utm_term=all-on-4'), {
            utm_source: 'avito ads',
            utm_term: 'all-on-4',
        });
    });

    it('skips empty values and malformed keys', () => {
        assert.deepEqual(attr.parseUtms('utm_source=&utm_medium=cpc&utm_bad-key=x'), {
            utm_medium: 'cpc',
        });
    });
});

describe('capture / persist', () => {
    it('stores entry, referrer and utm on first hit', () => {
        const href = 'https://doctorlevin.ru/implanty/?utm_source=avito&utm_medium=cpc';
        const data = attr.capture(href, 'https://www.avito.ru/item/1', null);
        assert.equal(data.entry, href);
        assert.equal(data.referrer, 'https://www.avito.ru/item/1');
        assert.deepEqual(data.utm, { utm_source: 'avito', utm_medium: 'cpc' });
    });

    it('does not overwrite an existing session snapshot', () => {
        const store = memoryStore({
            [attr.STORAGE_KEY]: JSON.stringify({
                entry: 'https://doctorlevin.ru/first/',
                referrer: 'https://yandex.ru/',
                utm: { utm_source: 'yandex' },
            }),
        });
        const next = attr.persist(
            store,
            'https://doctorlevin.ru/other/?utm_source=google',
            'https://google.com/'
        );
        assert.equal(next.entry, 'https://doctorlevin.ru/first/');
        assert.equal(next.referrer, 'https://yandex.ru/');
        assert.deepEqual(next.utm, { utm_source: 'yandex' });
    });
});
