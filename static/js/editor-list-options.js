(function () {
    const { addFilter } = wp.hooks;
    const { createHigherOrderComponent } = wp.compose;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, RadioControl, ToggleControl } = wp.components;
    const el = wp.element.createElement;
    const Fragment = wp.element.Fragment;

    const ICON_STYLES = [
        { value: "", label: "По умолчанию" },
        { value: "is-style-check", label: "✓ Галочки" },
        { value: "is-style-cross", label: "✕ Крестики" },
        { value: "is-style-roundplus", label: "⊕ Круг плюс" },
        { value: "is-style-roundminus", label: "⊖ Круг минус" },
    ];

    const ICON_VALUES = ICON_STYLES.map(function (s) {
        return s.value;
    }).filter(Boolean);

    const MODIFIERS = [
        { cls: "menu-col-two", label: "2 колонки" },
        { cls: "article__list_color_blue", label: "● Синие маркеры" },
        { cls: "article__list_color_black", label: "● Тёмные маркеры" },
    ];

    const withListOptions = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== "core/list") {
                return el(BlockEdit, props);
            }

            const classes = (props.attributes.className || "")
                .split(" ")
                .filter(Boolean);
            const currentStyle =
                classes.find(function (c) {
                    return ICON_VALUES.includes(c);
                }) || "";

            function setStyle(value) {
                const next = classes
                    .filter(function (c) {
                        return !ICON_VALUES.includes(c);
                    })
                    .concat(value ? [value] : []);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            function toggle(cls) {
                const next = classes.includes(cls)
                    ? classes.filter(function (c) {
                          return c !== cls;
                      })
                    : classes.concat(cls);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: "Параметры списка", initialOpen: true },
                        el(RadioControl, {
                            label: "Стиль маркеров",
                            selected: currentStyle,
                            options: ICON_STYLES,
                            onChange: setStyle,
                        }),
                        MODIFIERS.map(function (mod) {
                            return el(ToggleControl, {
                                key: mod.cls,
                                label: mod.label,
                                checked: classes.includes(mod.cls),
                                onChange: function () {
                                    toggle(mod.cls);
                                },
                            });
                        }),
                    ),
                ),
            );
        };
    }, "withListOptions");

    addFilter("editor.BlockEdit", "theme/list-options", withListOptions);

    const PARA_STYLES = [
        { value: "", label: "По умолчанию" },
        { value: "is-style-description", label: "Описание" },
    ];

    const PARA_STYLE_VALUES = PARA_STYLES.map(function (s) {
        return s.value;
    }).filter(Boolean);

    const withParagraphOptions = createHigherOrderComponent(function (
        BlockEdit,
    ) {
        return function (props) {
            if (props.name !== "core/paragraph") {
                return el(BlockEdit, props);
            }

            const classes = (props.attributes.className || "")
                .split(" ")
                .filter(Boolean);
            const currentStyle =
                classes.find(function (c) {
                    return PARA_STYLE_VALUES.includes(c);
                }) || "";

            function setStyle(value) {
                const next = classes
                    .filter(function (c) {
                        return !PARA_STYLE_VALUES.includes(c);
                    })
                    .concat(value ? [value] : []);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            function toggle(cls) {
                const next = classes.includes(cls)
                    ? classes.filter(function (c) {
                          return c !== cls;
                      })
                    : classes.concat(cls);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: "Параметры абзаца", initialOpen: true },
                        el(RadioControl, {
                            label: "Стиль",
                            selected: currentStyle,
                            options: PARA_STYLES,
                            onChange: setStyle,
                        }),
                    ),
                ),
            );
        };
    }, "withParagraphOptions");

    addFilter(
        "editor.BlockEdit",
        "theme/paragraph-options",
        withParagraphOptions,
    );

    const NUMBER_STYLES = [
        { value: "", label: "Без номера" },
        { value: "number_1", label: "1" },
        { value: "number_2", label: "2" },
        { value: "number_3", label: "3" },
        { value: "number_4", label: "4" },
        { value: "number_5", label: "5" },
        { value: "number_6", label: "6" },
        { value: "number_7", label: "7" },
        { value: "number_8", label: "8" },
    ];

    const NUMBER_VALUES = NUMBER_STYLES.map(function (s) {
        return s.value;
    }).filter(Boolean);

    const withHeadingOptions = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== "core/heading") {
                return el(BlockEdit, props);
            }

            const level = props.attributes.level;
            const classes = (props.attributes.className || "")
                .split(" ")
                .filter(Boolean);

            function toggle(cls) {
                const next = classes.includes(cls)
                    ? classes.filter(function (c) {
                          return c !== cls;
                      })
                    : classes.concat(cls);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            function setNumber(value) {
                const next = classes
                    .filter(function (c) {
                        return !NUMBER_VALUES.includes(c);
                    })
                    .concat(value ? [value] : []);
                props.setAttributes({ className: next.join(" ") || undefined });
            }

            const currentNumber =
                classes.find(function (c) {
                    return NUMBER_VALUES.includes(c);
                }) || "";

            if (level !== 3 && level !== 4) {
                return el(BlockEdit, props);
            }

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: "Параметры заголовка", initialOpen: true },
                        level === 3 &&
                            el(ToggleControl, {
                                label: "По центру",
                                checked: classes.includes("heading_center"),
                                onChange: function () {
                                    toggle("heading_center");
                                },
                            }),
                        level === 3 &&
                            el(ToggleControl, {
                                label: "mb-30 (отступ вниз)",
                                checked: classes.includes("mb-30"),
                                onChange: function () {
                                    toggle("mb-30");
                                },
                            }),
                        level === 4 &&
                            el(ToggleControl, {
                                label: "Нумерованный заголовок",
                                checked: classes.includes("number-heading"),
                                onChange: function () {
                                    toggle("number-heading");
                                },
                            }),
                        level === 4 &&
                            el(RadioControl, {
                                label: "Номер",
                                selected: currentNumber,
                                options: NUMBER_STYLES,
                                onChange: setNumber,
                            }),
                    ),
                ),
            );
        };
    }, "withHeadingOptions");

    addFilter("editor.BlockEdit", "theme/heading-options", withHeadingOptions);
})();
