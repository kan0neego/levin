(function () {
    const { registerBlockType } = wp.blocks;
    const { MediaUpload, RichText } = wp.blockEditor;
    const { Button, TextControl } = wp.components;
    const el = wp.element.createElement;

    function emptyCard() {
        return { image: '', heading: '', text: '', items: [''] };
    }

    function updateCard(cards, index, key, value) {
        return cards.map(function (card, i) {
            return i === index ? Object.assign({}, card, { [key]: value }) : card;
        });
    }

    registerBlockType('theme/standards', {
        title: 'Стандарты / Этапы',
        icon: 'list-view',
        category: 'common',

        attributes: {
            cards: { type: 'array', default: [emptyCard()], items: { type: 'object' } }
        },

        edit: function (props) {
            const { attributes, setAttributes } = props;
            const cards = attributes.cards;

            function setCards(next) { setAttributes({ cards: next }); }

            return el('div', { className: 'standards' },

                cards.map(function (card, index) {
                    const reverse = index % 2 !== 0;
                    const items = Array.isArray(card.items) ? card.items : [''];

                    function setItems(newItems) {
                        setCards(updateCard(cards, index, 'items', newItems));
                    }

                    return el('div', {
                        key: index,
                        className: 'row row_center row_sm_center' + (reverse ? ' reverse' : ''),
                        style: { border: '1px dashed #ccc', marginBottom: '24px', padding: '16px', position: 'relative' }
                    },
                        el(Button, {
                            variant: 'tertiary',
                            isDestructive: true,
                            onClick: function () { setCards(cards.filter(function (_, i) { return i !== index; })); },
                            style: { position: 'absolute', top: '8px', right: '8px' }
                        }, '✕ Удалить'),

                        el('div', { className: 'col col-sm-12 col-md-5' },
                            el(MediaUpload, {
                                onSelect: function (media) { setCards(updateCard(cards, index, 'image', media.url)); },
                                allowedTypes: ['image'],
                                value: card.image,
                                render: function (obj) {
                                    return card.image
                                        ? el('div', { style: { textAlign: 'center' } },
                                            el('img', { src: card.image, style: { maxWidth: '100%' } }),
                                            el(Button, { onClick: obj.open, variant: 'link', style: { marginTop: '8px' } }, 'Заменить')
                                          )
                                        : el('div', {
                                            onClick: obj.open,
                                            style: {
                                                width: '100%',
                                                aspectRatio: '1',
                                                borderRadius: '50%',
                                                border: '2px dashed #aaa',
                                                background: '#f5f5f5',
                                                display: 'flex',
                                                flexDirection: 'column',
                                                alignItems: 'center',
                                                justifyContent: 'center',
                                                cursor: 'pointer',
                                                color: '#999',
                                                fontSize: '14px',
                                                gap: '8px',
                                            }
                                        },
                                            el('span', { style: { fontSize: '32px', lineHeight: 1 } }, '+'),
                                            el('span', null, 'Выбрать фото')
                                        );
                                }
                            })
                        ),

                        el('div', { className: 'col col-sm-12 col-md-7' },
                            el(RichText, {
                                tagName: 'h3',
                                className: 'heading heading_h2',
                                value: card.heading,
                                onChange: function (v) { setCards(updateCard(cards, index, 'heading', v)); },
                                placeholder: 'Заголовок',
                                allowedFormats: ['core/bold'],
                            }),
                            el(RichText, {
                                tagName: 'p',
                                className: 'text text_medium',
                                value: card.text,
                                onChange: function (v) { setCards(updateCard(cards, index, 'text', v)); },
                                placeholder: 'Описание...',
                                allowedFormats: [],
                            }),

                            el('ul', { className: 'list text mb-30' },
                                items.map(function (item, itemIndex) {
                                    return el('li', {
                                        key: itemIndex,
                                        style: { display: 'flex', alignItems: 'baseline', gap: '4px' }
                                    },
                                        el(RichText, {
                                            tagName: 'span',
                                            value: item,
                                            onChange: function (v) {
                                                var next = items.slice();
                                                next[itemIndex] = v;
                                                setItems(next);
                                            },
                                            placeholder: 'Пункт списка...',
                                            allowedFormats: ['core/bold'],
                                            style: { flex: 1 },
                                        }),
                                        items.length > 1 && el(Button, {
                                            variant: 'tertiary',
                                            isDestructive: true,
                                            onClick: function () {
                                                setItems(items.filter(function (_, i) { return i !== itemIndex; }));
                                            },
                                            style: { padding: '0 4px', minWidth: 'auto', flexShrink: 0, opacity: 0.4, fontSize: '12px' }
                                        }, '✕')
                                    );
                                })
                            ),
                            el(Button, {
                                variant: 'secondary',
                                onClick: function () { setItems(items.concat('')); },
                                style: { marginTop: '6px', marginBottom: '8px' }
                            }, '+ Добавить пункт')
                        )
                    );
                }),

                el(Button, {
                    variant: 'primary',
                    onClick: function () { setCards(cards.concat(emptyCard())); },
                    style: { marginTop: '12px' }
                }, '+ Добавить карточку')
            );
        },

        save: function (props) {
            const cards = props.attributes.cards;

            return el('div', { className: 'standards' },
                cards.map(function (card, index) {
                    const reverse = index % 2 !== 0;
                    const items = Array.isArray(card.items)
                        ? card.items.filter(function (i) { return i && i.trim(); })
                        : [];

                    return el('div', {
                        key: index,
                        className: 'row row_center row_sm_center' + (reverse ? ' reverse' : '')
                    },
                        el('div', { className: 'col col-sm-5' },
                            card.image && el('img', {
                                decoding: 'async',
                                className: 'd-block mx-auto',
                                src: card.image,
                                alt: card.heading ? card.heading.replace(/<[^>]+>/g, '') : ''
                            })
                        ),
                        el('div', { className: 'col col-sm-7' },
                            el(RichText.Content, { tagName: 'h3', className: 'heading heading_h2', value: card.heading }),
                            el('p', { className: 'text text_medium' }, card.text),
                            items.length > 0 && el('ul', { className: 'list text mb-30' },
                                items.map(function (item, i) {
                                    return el('li', { key: i },
                                        el(RichText.Content, { tagName: 'span', value: item })
                                    );
                                })
                            )
                        )
                    );
                })
            );
        }
    });
})();
