(function () {
  const { registerBlockType } = wp.blocks;
  const { InspectorControls, MediaUpload, RichText } = wp.blockEditor;
  const { PanelBody, TextControl, Button } = wp.components;
  const el = wp.element.createElement;

  registerBlockType("theme/doctor-card", {
    title: "Карточка врача",
    icon: "id",
    category: "common",

    attributes: {
      image: { type: "string", default: "" },
      lastName: { type: "string", default: "" },
      fullName: { type: "string", default: "" },
      snippet: { type: "string", default: "" },
      text: { type: "string", default: "" },
      link: { type: "string", default: "" },
    },

    edit: function (props) {
      const { attributes, setAttributes } = props;

      return el(
        "div",
        { className: "card-doctor mt-5 mb-90" },

        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "Данные врача", initialOpen: true },
            el(TextControl, {
              label: "Ссылка на страницу врача",
              value: attributes.link,
              onChange: function (v) {
                setAttributes({ link: v });
              },
            }),
          ),
        ),

        el(
          "div",
          { className: "row" },
          el(
            "div",
            { className: "col col-sm-12 col-md-6" },
            el(
              "div",
              { className: "card-doctor__image" },
              el(MediaUpload, {
                onSelect: function (media) {
                  setAttributes({ image: media.url });
                },
                allowedTypes: ["image"],
                value: attributes.image,
                render: function (obj) {
                  return attributes.image
                    ? el(
                        "div",
                        null,
                        el("img", { src: attributes.image }),
                        el(
                          Button,
                          {
                            onClick: obj.open,
                            variant: "link",
                            style: { display: "block", marginTop: "8px" },
                          },
                          "Заменить фото",
                        ),
                      )
                    : el(
                        Button,
                        { onClick: obj.open, variant: "secondary" },
                        "Выбрать фото",
                      );
                },
              }),
            ),
          ),
          el(
            "div",
            { className: "col col-sm-12 col-md-6" },
            el(
              "div",
              { className: "card-doctor__name" },
              el(RichText, {
                tagName: "span",
                value: attributes.lastName,
                onChange: function (v) {
                  setAttributes({ lastName: v });
                },
                placeholder: "Фамилия",
              }),
              el(RichText, {
                tagName: "span",
                value: attributes.fullName,
                onChange: function (v) {
                  setAttributes({ fullName: v });
                },
                placeholder: "Имя Отчество",
              }),
            ),
            el(RichText, {
              tagName: "div",
              className: "card-doctor__snippet",
              value: attributes.snippet,
              onChange: function (v) {
                setAttributes({ snippet: v });
              },
              placeholder: "Специализация, стаж",
            }),
            el(RichText, {
              tagName: "div",
              className: "card-doctor__text",
              value: attributes.text,
              onChange: function (v) {
                setAttributes({ text: v });
              },
              placeholder: "Описание врача",
            }),
            el("div", { className: "section-button" }, "Подробнее о враче"),
          ),
        ),
      );
    },

    save: function (props) {
      const { attributes } = props;
      return el(
        "div",
        { className: "card-doctor mt-5 mb-90" },
        el(
          "div",
          { className: "row" },
          el(
            "div",
            { className: "col col-sm-12 col-md-6" },
            el(
              "div",
              { className: "card-doctor__image" },
              attributes.image &&
                el("img", {
                  src: attributes.image,
                  alt: attributes.lastName + " " + attributes.fullName,
                  decoding: "async",
                }),
            ),
          ),
          el(
            "div",
            { className: "col col-sm-12 col-md-6" },
            el(
              "div",
              { className: "card-doctor__name" },
              el("span", null, attributes.lastName),
              attributes.fullName,
            ),
            el(
              "div",
              { className: "card-doctor__snippet" },
              attributes.snippet,
            ),
            el(RichText.Content, {
              tagName: "div",
              className: "card-doctor__text",
              value: attributes.text,
            }),
            attributes.link &&
              el(
                "a",
                { href: attributes.link, target: "_blank" },
                el("div", { className: "section-button" }, "Подробнее о враче"),
              ),
          ),
        ),
      );
    },
  });
})();
