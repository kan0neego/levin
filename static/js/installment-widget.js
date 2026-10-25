(function () {
  function widgetInit() {
    if (typeof installmentWidgetConfig === "undefined") {
      console.log("Widget disabled: installmentWidgetConfig not defined");
      return;
    }

    const defaultOptions = {
      disableOnDesktop: false,
      disableOnMobile: false,
      showCircle: true,
      animation: true,
      sizeDesktop: 120,
      sizeMobile: 80,
      slides: [],
      slideInterval: 3000,
      transitionDuration: 600, // Длительность анимации перехода в миллисекундах
      maskedTimeout: 400,
      scrollTimeout: 400,
      mobileWidth: 768,
      order: 0,
      link: {
        href: "#order", // Ссылка виджета
        additionalClasses: "", // Дополнительные классы
      },
      circle: {
        desktop: {
          fontSize: 16,        // Размер шрифта на десктопе
          letterSpacing: 2,    // Межбуквенный интервал на десктопе
          radius: 80,          // Радиус круга на десктопе
          text: 'АКЦИЯ · АКЦИЯ · АКЦИЯ · АКЦИЯ · АКЦИЯ · АКЦИЯ ·', // Текст по кругу на десктопе
        },
        mobile: {
          fontSize: 22,        // Размер шрифта на мобилке
          letterSpacing: 3,    // Межбуквенный интервал на мобилке
          radius: 75,          // Радиус круга на мобилке
          text: 'АКЦИЯ · АКЦИЯ · АКЦИЯ · АКЦИЯ ·', // Текст по кругу на мобилке
        }
      }
    };

    const options = {
      ...defaultOptions,
      ...installmentWidgetConfig,
      link: {
        ...defaultOptions.link,
        ...(installmentWidgetConfig.link || {}),
      },
      circle: {
        desktop: {
          ...defaultOptions.circle.desktop,
          ...(installmentWidgetConfig.circle?.desktop || {}),
        },
        mobile: {
          ...defaultOptions.circle.mobile,
          ...(installmentWidgetConfig.circle?.mobile || {}),
        }
      }
    };

    // Проверяем, нужно ли отключать виджет на текущем устройстве
    const isMobile = window.innerWidth <= (options.mobileWidth || 768);

    if ((isMobile && options.disableOnMobile) || (!isMobile && options.disableOnDesktop)) {
      console.log("Widget disabled for current device type");
      return;
    }

    // Создаем wrapper для виджета
    const widgetWrapper = document.createElement("div");
    widgetWrapper.classList.add("widget-wrapper");
    widgetWrapper.classList.add("installment-widget_masked");

    // Создаем сам виджет
    const widget = document.createElement("a");
    widget.href = options.link.href;

    // Формируем классы
    let widgetClasses = ['installment-widget'];

    if (!options.showCircle) {
      widgetClasses.push('--no-circle');
    }

    if (!options.animation) {
      widgetClasses.push('--no-animation');
    }

    if (options.link.additionalClasses) {
      widgetClasses.push(options.link.additionalClasses);
    }

    widget.className = widgetClasses.join(' ');
    widget.id = "installment-widget";

    // Создаем SVG круг с текстом "АКЦИЯ АКЦИЯ", если опция включена
    if (options.showCircle) {
      const circle = document.createElement("div");
      circle.className = "installment-widget__circle";

      // Определяем какой SVG использовать - десктопный или мобильный
      function createSVG() {
        const isMobile = window.innerWidth <= (options.mobileWidth || 768);
        const config = isMobile ? options.circle.mobile : options.circle.desktop;

        // Создаем SVG с настраиваемыми параметрами
        return `
          <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <defs>
              <path id="circlePath" d="M 100, 100 m -${config.radius}, 0 a ${config.radius},${config.radius} 0 1,1 ${config.radius * 2},0 a ${config.radius},${config.radius} 0 1,1 -${config.radius * 2},0" />
            </defs>
            <text fill="#fff" font-size="${config.fontSize}" font-weight="900" letter-spacing="${config.letterSpacing}">
              <textPath href="#circlePath" startOffset="0%">
                ${config.text}
              </textPath>
            </text>
          </svg>
        `;
      }

      circle.innerHTML = createSVG();

      // Обновляем SVG при изменении размера окна
      window.addEventListener("resize", () => {
        circle.innerHTML = createSVG();
      });

      widget.appendChild(circle);
    }

    // Генерируем слайды из конфига
    if (options.slides && options.slides.length > 0) {
      options.slides.forEach((slide) => {
        const container = document.createElement("div");
        container.className = `installment-widget__container ${slide.class || ''}`;

        // В зависимости от типа слайда создаем разметку
        switch (slide.type) {
          case 'image':
            container.innerHTML = `<img class="installment-widget__image" src="${slide.image}" alt="">`;
            break;

          case 'text':
            container.innerHTML = `<div class="installment-widget__text">${slide.text}</div>`;
            break;

          case 'price':
            container.innerHTML = `
              <div class="installment-widget__price-after">${slide.priceAfter}</div>
              <div class="installment-widget__price-before">${slide.priceBefore}</div>
            `;
            break;

          case 'date':
            container.innerHTML = `<div class="installment-widget__date">${slide.text}</div>`;
            break;

          default:
            // Если тип не указан, просто вставляем текст
            container.innerHTML = slide.text || '';
        }

        widget.appendChild(container);
      });
    }

    // Добавляем виджет в wrapper
    widgetWrapper.appendChild(widget);

    // Ищем или создаем контейнер для виджетов
    let widgetsContainer = document.querySelector(".widgets.widgets-col");
    if (!widgetsContainer) {
      widgetsContainer = document.createElement("div");
      widgetsContainer.className = "widgets widgets-col";
      document.body.appendChild(widgetsContainer);
    }

    widgetWrapper.style.visibility = "hidden";
    widgetWrapper.style.transform = "translateX(150%)";

    widgetsContainer.appendChild(widgetWrapper);

    // Базовые стили только для размеров и порядка
    const style = document.createElement("style");
    style.textContent = `
    .widgets.widgets-col {
      z-index: 999;
      position: fixed;
      left: ${widgetsColConfig.left || "initial"};
      right: ${widgetsColConfig.right || "initial"};
      top: ${widgetsColConfig.top || "initial"};
      bottom: ${widgetsColConfig.bottom || "initial"};
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 20px;
      pointer-events: none;
    }

    .widgets.widgets-col>* {
      pointer-events: all;
    }

    .widget-wrapper {
      transition-property: transform;
      transition-duration: 0.7s;
    }

    .installment-widget {
      position: relative;
      width: ${options.sizeDesktop}px;
      height: ${options.sizeDesktop}px;
      transition-property: transform, opacity, visibility;
      transition-duration: 0.7s, 0.7s, 0.7s;
    }

    .installment-widget_masked {
      transform: translateX(150%) !important;
      visibility: hidden;
    }

    .installment-widget_hidden {
      opacity: 0 !important;
      visibility: hidden !important;
    }

    .installment-widget__container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      visibility: hidden;
      transition: opacity ${options.transitionDuration}ms ease-in-out, visibility ${options.transitionDuration}ms;
    }

    .installment-widget__container.active {
      opacity: 1;
      visibility: visible;
    }

    .installment-widget-slide {
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    .installment-widget-slide.active {
      opacity: 1;
    }

    @media screen and (max-width: ${options.mobileWidth}px) {
      .widgets.widgets-col {
        left: ${widgetsColConfig.mobile.left || "initial"};
        right: ${widgetsColConfig.mobile.right || "initial"};
        top: ${widgetsColConfig.mobile.top || "initial"};
        bottom: ${widgetsColConfig.mobile.bottom || "initial"};
        gap: 12px;
      }

      .installment-widget {
        order: ${options.order};
        width: ${options.sizeMobile}px;
        height: ${options.sizeMobile}px;
      }
    }
  `;
    document.head.appendChild(style);

    // Логика смены слайдов
    let currentSlideIndex = 0;
    const allContainers = widget.querySelectorAll(".installment-widget__container");

    function changeSlide() {
      if (allContainers.length === 0) return;

      // Убираем класс active у текущего контейнера
      allContainers[currentSlideIndex].classList.remove("active");

      // Переходим к следующему слайду
      currentSlideIndex = (currentSlideIndex + 1) % allContainers.length;

      // Небольшая задержка перед показом следующего слайда для плавности
      setTimeout(() => {
        allContainers[currentSlideIndex].classList.add("active");
      }, 50);
    }

    // Устанавливаем первый контейнер как активный
    if (allContainers.length > 0) {
      allContainers[0].classList.add("active");
    }

    // Запускаем интервал смены слайдов
    if (allContainers.length > 1) {
      setInterval(changeSlide, options.slideInterval);
    }

    // Добавление отслеживания скролла
    function enableScrollTracking() {
      let scrollTimeout;

      function handleScroll() {
        const isMobile = window.innerWidth <= (options.mobileWidth || 768);
        if (isMobile) {
          if (!widget.classList.contains("installment-widget_hidden")) {
            widget.classList.add("installment-widget_hidden");
          }

          clearTimeout(scrollTimeout);

          scrollTimeout = setTimeout(() => {
            const isLocked =
              document.body.classList.contains("lock") ||
              document.documentElement.classList.contains("lock") ||
              getComputedStyle(document.body).overflow === "hidden" ||
              getComputedStyle(document.documentElement).overflow === "hidden";

            if (!isLocked) {
              widget.classList.remove("installment-widget_hidden");
            }
          }, options.scrollTimeout);
        }
      }

      window.addEventListener("scroll", handleScroll);
    }

    // Проверяет текущий overflow и обновляет класс
    function updateScrollbarCompensator() {
      const bodyOverflow = getComputedStyle(document.body).overflow;
      const htmlOverflow = getComputedStyle(document.documentElement).overflow;
      const hasLockClass =
        document.body.classList.contains("lock") ||
        document.documentElement.classList.contains("lock");
      const hasOverflowHidden =
        bodyOverflow === "hidden" || htmlOverflow === "hidden";

      if (hasLockClass || hasOverflowHidden) {
        widget.classList.add("installment-widget_hidden");
      } else {
        widget.classList.remove("installment-widget_hidden");
      }
    }

    // Включение отслеживания скролла на мобильных устройствах
    if (window.innerWidth <= (options.mobileWidth || 768)) {
      enableScrollTracking();
    }

    window.addEventListener("resize", () => {
      updateScrollbarCompensator();
      enableScrollTracking();
    });

    setTimeout(() => {
      widgetWrapper.classList.remove("installment-widget_masked");
      widgetWrapper.style.visibility = "visible";
      widgetWrapper.style.transform = "none";
    }, options.maskedTimeout);

    // Отслеживание изменений overflow
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (
          mutation.attributeName === "class" ||
          mutation.attributeName === "style"
        ) {
          updateScrollbarCompensator();
        }
      });
    });

    observer.observe(document.body, {
      attributes: true,
      attributeFilter: ["style", "class"],
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["style", "class"],
    });
  }

  // Функция ожидания загрузки опций
  function waitForOptions(callback) {
    if (typeof installmentWidgetConfig !== "undefined") {
      callback();
    } else {
      setTimeout(() => waitForOptions(callback), 100);
    }
  }

  // Проверяем, нужно ли вообще запускать виджет
  if (
    typeof installmentWidgetEnabled === "undefined" ||
    installmentWidgetEnabled !== false
  ) {
    // Запускаем ожидание опций
    waitForOptions(widgetInit);
  } else {
    console.log("Widget disabled: installmentWidgetEnabled is false");
  }
})();
