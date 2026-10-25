(function () {
  // Основная функция инициализации виджета
  function widgetInit() {
    // Проверяем, существует ли widgetConsultationOptions
    if (typeof widgetConsultationOptions === "undefined") {
      console.log("Widget disabled: widgetConsultationOptions not defined");
      return; // Отключаем виджет, если опции не определены
    }

    const defaultOptions = {
      disableOnDesktop: false,
      disableOnMobile: false,
      color: "#409ADD",
      position: "middle-right",
      bottom: 40,
      mobileWidth: 768,
      mobilePosition: null,
      mobileBottom: 40,
      linkType: "href",
      link: "",
      data: "target",
      additionalClass: "",
      zIndex: 100002,
      id: "consultation-widget",
      customAttributes: ``,
      sizeDesktop: 80,
      sizeMobile: 60,
      fontSizeDesktop: 12,
      fontSizeMobile: 10,
      textColor: "#FFFFFF",
      backgroundColor: "rgba(64, 154, 221, 0.8)",
      colorType: "solid",
      color1: "#409ADD",
      color2: "#409ADD",
      text: "Консультация",
      maskedTimeout: 400,
      scrollTimeout: 400,
    };

    // Объединяем настройки с дефолтными
    const options = {
      ...defaultOptions,
      ...widgetConsultationOptions,
    };

    // Проверяем, нужно ли отключать виджет на текущем устройстве
    const isMobile = window.innerWidth <= (options.mobileWidth || 768);

    if ((isMobile && options.disableOnMobile) || (!isMobile && options.disableOnDesktop)) {
      console.log("Consultation widget disabled for current device type");
      return;
    }

    // Создаем элемент виджета
    const widget = document.createElement(
      options.linkType === "href" ? "a" : "div"
    );

    const widgetWrapper = document.createElement("div");
    widgetWrapper.classList.add("widget-wrapper");
    widgetWrapper.classList.add("cons-widget_masked");

    widget.id = options.id || "consultation-widget";
    widget.classList.add("cons-widget");

    if (options.linkType === "href" && options.link) {
      widget.href = options.link;
    }

    const span = document.createElement("span");
    span.textContent = options.text;
    widget.appendChild(span);

    // Создание SVG
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 104 104");
    svg.innerHTML = `
     <g clip-path="url(#clip0_9476_5874)">
     <path d="M52.1117 98.9224C45.0813 98.9101 38.1428 97.3237 31.8048 94.2795C25.4667 91.2352 19.8897 86.8103 15.4826 81.329C11.0755 75.8478 7.94992 69.4491 6.33506 62.6021C4.7202 55.755 4.65695 48.6331 6.14994 41.7584" stroke="url(#paint0_linear_9476_5874)" stroke-width="9" stroke-miterlimit="10"/>
     <path d="M12.0763 36.0918L4.10986 32.2023L6.84991 26.5966L8.58527 27.4497L6.9108 30.8923L7.8343 31.3493L8.23008 30.5369C8.51066 29.9285 8.91508 29.3855 9.41744 28.9425C9.83454 28.5668 10.3473 28.3137 10.8991 28.2113C11.4404 28.1254 11.9949 28.2143 12.4822 28.4652C12.9829 28.7025 13.3977 29.0892 13.6696 29.5721C13.9384 30.0701 14.0682 30.6314 14.0451 31.1969C14.0091 31.866 13.8327 32.52 13.5275 33.1163L12.0763 36.0918ZM11.4268 33.0452L11.8226 32.2328C11.9416 32.0105 12.0075 31.7638 12.0154 31.5118C12.0193 31.3084 11.9666 31.108 11.8632 30.9329C11.752 30.7662 11.5977 30.6328 11.4167 30.547C11.287 30.4841 11.1447 30.4514 11.0006 30.4514C10.8564 30.4514 10.7142 30.4841 10.5845 30.547C10.2689 30.7026 10.0227 30.9707 9.89441 31.2985L9.48847 32.1211L11.4268 33.0452Z" fill="${
       options.textColor
     }"/>
     <path d="M15.3645 29.5416L8.15918 24.3828L11.8633 19.1833L13.4465 20.3105L11.1326 23.5602L12.3504 24.4234L14.4714 21.4581L16.014 22.5548L13.8828 25.5303L15.1818 26.4544L17.4855 23.2251L19.0585 24.3625L15.3645 29.5416Z" fill="${
       options.textColor
     }"/>
     <path d="M22.4683 21.0011C21.9303 21.5351 21.2675 21.9261 20.5401 22.1385C19.8346 22.3464 19.0841 22.3464 18.3785 22.1385C17.5724 21.8347 16.8438 21.3556 16.2453 20.7356C15.6468 20.1157 15.1934 19.3704 14.918 18.5537C14.7096 17.8408 14.7096 17.0832 14.918 16.3703C15.1524 15.6554 15.5604 15.0099 16.1053 14.4916C16.481 14.109 16.9163 13.7901 17.3942 13.5471C17.819 13.3337 18.2805 13.2028 18.754 13.1612C19.2183 13.1318 19.6837 13.1939 20.124 13.344C20.6003 13.5249 21.0402 13.7897 21.423 14.126L19.6775 15.7813C19.5347 15.6563 19.3739 15.5536 19.2006 15.4766C19.0358 15.412 18.8599 15.3809 18.683 15.3852C18.5003 15.3867 18.3201 15.4283 18.1553 15.5071C17.9664 15.5989 17.7947 15.7225 17.6479 15.8727C17.3766 16.1129 17.1883 16.4328 17.11 16.7867C17.0575 17.1308 17.1032 17.4829 17.2419 17.8022C17.6249 18.6684 18.2807 19.3853 19.1092 19.8434C19.4244 19.9954 19.7782 20.0485 20.124 19.9957C20.4689 19.92 20.7833 19.7433 21.0273 19.4879C21.1757 19.3525 21.3024 19.195 21.4027 19.0208C21.4824 18.8652 21.5339 18.6968 21.555 18.5232C21.5901 18.3592 21.5901 18.1896 21.555 18.0256C21.5066 17.8506 21.4276 17.6855 21.3216 17.5381L23.0569 15.7813C23.3008 16.0862 23.4928 16.4293 23.6252 16.7968C23.7729 17.2171 23.8383 17.6618 23.818 18.1068C23.8026 18.6016 23.6887 19.0884 23.4831 19.5387C23.2439 20.088 22.8991 20.5849 22.4683 21.0011Z" fill="${
       options.textColor
     }"/>
     <path d="M27.7152 6.00177L32.4544 13.4862L30.4248 14.7658L26.7003 8.88588L24.1835 10.4802L27.908 16.3601L25.8783 17.6397L21.1289 10.1451L27.7152 6.00177Z" fill="${
       options.textColor
     }"/>
     <path d="M32.9416 13.2018L32.282 11.4653L32.5052 11.3434C32.7522 11.2091 32.9457 10.994 33.0532 10.7341C33.1612 10.3787 33.1821 10.0025 33.1141 9.63734C33.0149 9.01828 32.8587 8.40976 32.6473 7.81955L31.46 4.28551L37.4475 2.01074L40.5934 10.2974L38.4217 11.12L35.9455 4.61049L34.1899 5.28074L35.0423 7.94141C35.3298 8.73073 35.4941 9.55963 35.5294 10.399C35.563 10.9732 35.3942 11.541 35.0525 12.0035C34.6311 12.4704 34.0962 12.8203 33.4998 13.019L32.9416 13.2018Z" fill="${
       options.textColor
     }"/>
     <path d="M43.3333 9.77952L40.7759 10.1857L42.2575 0.974916L45.505 0.446838L49.7876 8.7437L47.2302 9.1499L44.3075 3.11768H44.2365L43.3333 9.77952ZM42.3184 6.39782L47.1287 5.62603L47.4129 7.4032L42.5924 8.17499L42.3184 6.39782Z" fill="${
       options.textColor
     }"/>
     <path d="M48.793 1.93964V0L56.4854 0.121858V2.06152H53.8265L53.7149 8.98739H51.3503L51.462 2.06152L48.793 1.93964Z" fill="${
       options.textColor
     }"/>
     <path d="M56.6074 8.96707L58.3326 0.27417L60.6972 0.741319L60.0173 4.14332L63.1429 4.76279L63.8229 1.36079L66.1773 1.83809L64.4521 10.531L62.0469 10.0638L62.7269 6.66184L59.6012 6.04236L59.0024 9.43422L56.6074 8.96707Z" fill="${
       options.textColor
     }"/>
     <path d="M67.0196 11.5364L64.6348 10.5209L70.7846 3.49341L73.8291 4.77298L73.0579 14.0854L70.673 13.0698L71.3935 6.39781H71.3327L67.0196 11.5364ZM67.9431 8.13437L72.4388 10.0334L71.7386 11.7192L67.2429 9.82015L67.9431 8.13437Z" fill="${
       options.textColor
     }"/>
     <path d="M77.2695 12.1152L79.3905 13.5573L75.3311 15.7L73.1797 14.2377L77.2695 12.1152ZM79.2991 18.4013L77.2695 17.0507L81.1664 11.3028L80.4662 10.8356C80.2706 10.6858 80.046 10.5786 79.8065 10.5208C79.6187 10.4589 79.4159 10.4589 79.2281 10.5208C79.025 10.6034 78.8542 10.7494 78.741 10.9372C78.6112 11.1109 78.537 11.3197 78.5278 11.5364C78.535 11.7314 78.6024 11.9194 78.7207 12.0746C78.874 12.2702 79.0593 12.4384 79.2687 12.5722L80.7503 13.5877L79.7355 15.1313L77.8479 13.8416C77.3431 13.5094 76.9114 13.0774 76.5794 12.5722C76.293 12.1315 76.1445 11.6152 76.1531 11.0895C76.1796 10.5259 76.3701 9.98232 76.7012 9.52561C77.0076 9.05131 77.4398 8.67158 77.9494 8.42884C78.4272 8.20552 78.9612 8.13122 79.4818 8.21559C80.0701 8.31234 80.6288 8.54153 81.1157 8.88584L84.2718 11.0388L79.2991 18.4013Z" fill="${
       options.textColor
     }"/>
     <path d="M84.8705 24.0984L85.7026 19.6809L85.4692 19.427L82.8104 21.8744L81.1968 20.0972L87.7627 14.1361L89.3763 15.9133L86.9001 18.1576L87.1132 18.3912L91.2944 18.0256L93.324 20.28L87.9048 20.6355L86.89 26.3732L84.8705 24.0984Z" fill="${
       options.textColor
     }"/>
     <path d="M88.6761 29.6229C88.2719 28.977 88.0347 28.2406 87.986 27.4801C87.9481 26.7386 88.1243 26.0018 88.4934 25.3577C88.9374 24.6163 89.567 24.0037 90.3201 23.5805C91.046 23.1069 91.881 22.8272 92.7456 22.7681C93.4895 22.7273 94.2285 22.9112 94.8666 23.2962C95.5244 23.6935 96.0694 24.2529 96.4497 24.921C96.8523 25.5639 97.0894 26.2966 97.1398 27.0536C97.1777 27.7952 97.0015 28.532 96.6324 29.1761C96.1665 29.9054 95.5404 30.5188 94.8017 30.9693C94.0631 31.4198 93.2314 31.6957 92.3701 31.7758C91.6303 31.8068 90.8974 31.6234 90.2592 31.2477C89.6014 30.8504 89.0564 30.291 88.6761 29.6229ZM90.4622 28.5363C90.6419 28.8455 90.9107 29.0933 91.2335 29.2471C91.5547 29.3798 91.9086 29.4117 92.2483 29.3385C92.6925 29.2437 93.1156 29.0682 93.4965 28.8206C93.883 28.5908 94.2264 28.2952 94.5114 27.9473C94.7395 27.6742 94.8778 27.3372 94.9072 26.9825C94.9124 26.6237 94.8137 26.2709 94.623 25.967C94.4433 25.6578 94.1745 25.41 93.8517 25.2561C93.5305 25.1235 93.1766 25.0916 92.8369 25.1647C92.3895 25.2595 91.9631 25.435 91.5785 25.6826C91.1895 25.9089 90.8455 26.205 90.5637 26.556C90.338 26.8296 90.2032 27.1669 90.178 27.5207C90.1666 27.8804 90.2658 28.2349 90.4622 28.5363Z" fill="${
       options.textColor
     }"/>
     <path d="M91.1724 33.6342L99.5143 30.6486L100.316 32.9132L97.0584 34.0607L98.1341 37.1073L101.392 35.9395L102.204 38.2041L93.8617 41.1694L93.0498 38.9048L96.3074 37.7369L95.2317 34.6903L91.9741 35.848L91.1724 33.6342Z" fill="${
       options.textColor
     }"/>
     <path d="M94.5214 45.851C94.3962 45.1012 94.4661 44.3317 94.7243 43.6168C94.9811 42.922 95.4364 42.3181 96.0335 41.8803C96.7517 41.4035 97.5676 41.094 98.4211 40.9745C99.2747 40.855 100.144 40.9285 100.966 41.1897C101.636 41.4546 102.217 41.9056 102.64 42.4896C103.077 43.0887 103.359 43.7863 103.462 44.5206C103.549 45.0383 103.549 45.5668 103.462 46.0845C103.388 46.5523 103.222 47.0008 102.975 47.4047C102.734 47.8047 102.412 48.1504 102.031 48.4202C101.607 48.7084 101.132 48.9118 100.631 49.0194L100.286 46.6025C100.472 46.566 100.651 46.4972 100.813 46.3993C100.963 46.3019 101.094 46.178 101.199 46.0338C101.295 45.8809 101.364 45.7126 101.402 45.5362C101.438 45.3278 101.438 45.1148 101.402 44.9065C101.367 44.5305 101.214 44.1752 100.966 43.891C100.716 43.6343 100.394 43.4606 100.042 43.3934C99.5994 43.3105 99.1452 43.3105 98.7025 43.3934C98.2449 43.4473 97.8011 43.585 97.3933 43.7996C97.0778 43.9682 96.8225 44.2309 96.6627 44.5511C96.5192 44.8692 96.4767 45.2236 96.5409 45.5666C96.5631 45.7671 96.6179 45.9627 96.7033 46.1455C96.7785 46.3017 96.8817 46.4428 97.0077 46.5618C97.1321 46.6757 97.2766 46.7653 97.4339 46.8259C97.6063 46.8883 97.7885 46.9192 97.9718 46.9173L98.3168 49.3342C97.9153 49.3512 97.5138 49.2997 97.1295 49.1819C96.703 49.0529 96.3039 48.8464 95.9523 48.5726C95.5652 48.2653 95.2413 47.886 94.9983 47.4555C94.7374 46.9564 94.5755 46.4116 94.5214 45.851Z" fill="${
       options.textColor
     }"/>
     <path d="M94.9477 51.5481L96.8149 51.6395V52.066C96.7791 52.3386 96.8177 52.6158 96.9266 52.8683C97.0616 53.063 97.2641 53.2006 97.4949 53.2541L97.7486 53.3659L104.02 50.3193L103.898 52.7768L100.204 54.4525L103.736 56.0468L103.624 58.4739L96.8555 55.0821C96.4962 54.9042 96.1562 54.6898 95.8407 54.4423C95.5443 54.1932 95.3024 53.8855 95.1303 53.5385C94.9445 53.1355 94.8676 52.6908 94.9071 52.2488L94.9477 51.5481Z" fill="${
       options.textColor
     }"/>
     <path d="M94.7955 57.8951L96.5917 58.342V58.5857C96.5608 58.8674 96.629 59.1511 96.7846 59.388C97.0145 59.6771 97.3103 59.9069 97.6472 60.0582C98.2184 60.3253 98.8129 60.5394 99.4231 60.698L103.005 61.7135L101.483 67.9488L92.8774 65.8569L93.4255 63.6024L100.225 65.2577L100.661 63.4298L97.9821 62.6275C97.1693 62.4016 96.3935 62.0596 95.6784 61.612C95.2021 61.3024 94.8444 60.8407 94.6635 60.3019C94.4974 59.6936 94.4974 59.0518 94.6635 58.4435L94.7955 57.8951Z" fill="${
       options.textColor
     }"/>
     <path d="M97.424 70.0611L96.673 71.7368C96.4043 72.3507 96.0182 72.9062 95.5364 73.3718C95.1297 73.7589 94.6239 74.026 94.075 74.1436C93.536 74.2511 92.9766 74.1797 92.4817 73.9404C91.98 73.7372 91.5542 73.3821 91.2639 72.9249C90.9725 72.434 90.8248 71.871 90.8377 71.3001C90.8506 70.6273 91.0099 69.9653 91.3045 69.3604L92.6542 66.3138L100.773 69.9494L99.7581 72.1531L93.3951 69.2893L93.0297 70.1018C92.9273 70.3326 92.8688 70.5806 92.8572 70.8329C92.8619 71.0393 92.9253 71.2401 93.0399 71.4118C93.1566 71.5724 93.3143 71.6987 93.4965 71.7774C93.626 71.8348 93.766 71.8644 93.9076 71.8644C94.0491 71.8644 94.1891 71.8348 94.3186 71.7774C94.6355 71.6068 94.8778 71.3245 94.9985 70.9853L95.7495 69.3198L97.424 70.0611Z" fill="${
       options.textColor
     }"/>
     <path d="M95.9928 75.7684L97.6165 76.7839L93.4151 83.2427L91.7914 82.2272L93.2426 79.993L87.4175 76.2153L88.7063 74.1842L94.501 77.962L95.9928 75.7684Z" fill="${
       options.textColor
     }"/>
     <path d="M84.9617 79.5157L86.7173 77.6065L91.2435 85.7307L89.021 88.1477L80.5269 84.2785L82.2825 82.3693L88.3106 85.3042L88.3614 85.2534L84.9617 79.5157ZM87.8539 81.5468L84.5456 85.1316L83.2263 83.9129L86.5347 80.3281L87.8539 81.5468Z" fill="${
       options.textColor
     }"/>
     <path d="M73.9101 91.2044L71.7485 87.9445L73.5752 86.6548L74.7727 88.3711L75.2802 88.0156L76.295 89.4983L73.9101 91.2044ZM80.3949 84.4207L85.4691 91.6715L83.5916 92.9612L79.5323 87.2336L77.0054 89.0108L81.0647 94.7384L79.1365 96.0992L74.0624 88.8484L80.3949 84.4207Z" fill="${
       options.textColor
     }"/>
     <path d="M76.2547 97.8459L74.0525 98.8005L72.1953 94.5454H72.1344L71.1196 100.06L69.2422 100.872L65.7207 92.748L67.9229 91.7934L69.7699 96.0586H69.8308L70.9065 90.5138L72.7433 89.7217L76.2547 97.8459Z" fill="${
       options.textColor
     }"/>
     <path d="M57.9873 94.5251L60.3316 93.9869L61.8538 100.76L62.6758 100.568C62.9213 100.527 63.156 100.437 63.3659 100.303C63.5321 100.195 63.6626 100.039 63.7414 99.8567C63.7983 99.6472 63.7983 99.4263 63.7414 99.2169C63.6985 99.0064 63.5964 98.8126 63.4471 98.6583C63.3003 98.5267 63.1155 98.4449 62.9194 98.4248C62.6741 98.4069 62.4276 98.4275 62.1887 98.4857L60.4331 98.8817L60.0271 97.0538L62.2496 96.5562C62.8369 96.408 63.4487 96.3838 64.0459 96.4851C64.5635 96.5789 65.0409 96.8267 65.4159 97.196C65.8133 97.5993 66.0818 98.1119 66.1872 98.6685C66.3464 99.2087 66.3464 99.7835 66.1872 100.324C66.02 100.825 65.7095 101.267 65.2941 101.593C64.8236 101.958 64.2746 102.208 63.6907 102.324L59.9662 103.167L57.9873 94.5251ZM63.9342 97.3483L61.4479 97.9068L62.6555 93.4588L65.2028 92.8901L63.9342 97.3483Z" fill="${
       options.textColor
     }"/>
     </g>
     <defs>
     <linearGradient id="paint0_linear_9476_5874" x1="5.73462" y1="51.3182" x2="51.1331" y2="52.3321" gradientUnits="userSpaceOnUse">
         <stop stop-color="${
           options.colorType === "solid" ? options.color : options.color1
         }" offset="0"/>
         <stop stop-color="${
           options.colorType === "solid" ? options.color : options.color2
         }" offset="1"/>
     </linearGradient>
     <clipPath id="clip0_9476_5874">
     <rect width="104" height="104" fill="white"/>
     </clipPath>
     </defs>
   `;

    function updateSVGSize() {
      const isMobile = window.innerWidth <= (options.mobileWidth || 768);
      const size = isMobile
        ? options.sizeMobile - 10
        : options.sizeDesktop - 20;
      svg.setAttribute("width", size);
      svg.setAttribute("height", size);
    }

    updateSVGSize();
    window.addEventListener("resize", updateSVGSize);

    widget.appendChild(svg);

    // Применяем кастомные атрибуты
    if (options.customAttributes) {
      options.customAttributes.split(" ").forEach((attr) => {
        let [key, value] = attr.split("=");
        if (key && value) widget.setAttribute(key, value.replace(/"/g, ""));
      });
    }

    // Дополнительные классы
    if (options.additionalClass) {
      widget.classList.add(...options.additionalClass.split(" "));
    }

    let widgetsContainer = document.querySelector(".widgets.widgets-col");
    if (!widgetsContainer) {
      widgetsContainer = document.createElement("div");
      widgetsContainer.className = "widgets widgets-col";
      document.body.appendChild(widgetsContainer);
    }

    widgetWrapper.style.visibility = "hidden";
    widgetWrapper.style.transform = "translateX(150%)";
    widgetWrapper.appendChild(widget);

    widgetsContainer.appendChild(widgetWrapper);

    // Стили для элемента
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

    .scrollbar-compensator {
      margin: 0 ${getScrollbarWidth()}px;
    }

    .widget-wrapper {
      transition-property: transform;
      transition-duration: 0.7s;
    }

    .cons-widget {
      display: flex !important;
      justify-content: center;
      align-items: center;
      border-radius: 555px;
      border: none;
      text-decoration: none;
      width: ${options.sizeDesktop}px;
      height: ${options.sizeDesktop}px;
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 15px 0 rgba(0, 0, 0, 0.3);
      background: ${options.backgroundColor};
      transition-property: transform, opacity, visibility, height;
      transition-duration: 0.7s, 0.7s, 0.7s, 1.4s;
      cursor: pointer;
    }

    .cons-widget_masked {
      transform: translateX(150%) !important;
      visibility: hidden;
    }

    .cons-widget_hidden {
      opacity: 0 !important;
      visibility: hidden !important;
    }

    .cons-widget span {
      font-family: Rubik, sans-serif;
      font-weight: 700;
      font-size: ${options.fontSizeDesktop}px;
      line-height: 122%;
      text-align: center;
      color: ${options.textColor};
      max-width: 60px;
      transform: translateY(-3px);
      border: none;
      text-transform: uppercase;
    }

    .cons-widget svg {
      position: absolute;
      left: 50%;
      bottom: 50%;
      transform: translateX(-50%) translateY(50%);
      fill: none;
      width: calc(100% - 20px);
      height: calc(100% - 20px);
      animation: ${
        options.animationTime || "12s"
      } linear infinite rotate-round-widget;
      pointer-events: none;
    }

    @media screen and (max-width: ${options.mobileWidth}px) {
      .widgets.widgets-col {
        left: ${widgetsColConfig.mobile.left || "initial"};
        right: ${widgetsColConfig.mobile.right || "initial"};
        top: ${widgetsColConfig.mobile.top || "initial"};
        bottom: ${widgetsColConfig.mobile.bottom || "initial"};
        gap: 12px;
      }

      .cons-widget {
        order: ${options.order};
        width: ${options.sizeMobile}px;
        height: ${options.sizeMobile}px;
      }

      .cons-widget span {
        font-size: ${options.fontSizeMobile}px;
        transform: translateY(-1px);
      }

      .cons-widget svg {
        width: calc(100% - 10px);
        height: calc(100% - 10px);
      }
    }

    @keyframes rotate-round-widget {
      from {
        transform: translateX(-50%) translateY(50%) rotate(0deg);
      }

      to {
        transform: translateX(-50%) translateY(50%) rotate(360deg);
      }
    }

    @media (pointer: fine) {
      .cons-widget:hover {
        opacity: 0.7;
      }
    }
  `;
    document.head.appendChild(style);

    // Добавление отслеживания скролла
    function enableScrollTracking() {
      let scrollTimeout;

      function handleScroll() {
        const isMobile = window.innerWidth <= (options.mobileWidth || 768);
        if (isMobile) {
          // Не скрываем, если уже скрыто из-за overflow: hidden
          if (!widget.classList.contains("cons-widget_hidden")) {
            widget.classList.add("cons-widget_hidden");
          }

          clearTimeout(scrollTimeout);

          scrollTimeout = setTimeout(() => {
            // Показываем только если нет overflow: hidden
            const isLocked =
              document.body.classList.contains("lock") ||
              document.documentElement.classList.contains("lock") ||
              getComputedStyle(document.body).overflow === "hidden" ||
              getComputedStyle(document.documentElement).overflow === "hidden";

            if (!isLocked) {
              widget.classList.remove("cons-widget_hidden");
            }
          }, options.scrollTimeout);
        }
      }

      window.addEventListener("scroll", handleScroll);
    }

    // Вычисляет ширину полосы прокрутки
    function getScrollbarWidth() {
      const scrollDiv = document.createElement("div");
      scrollDiv.style.overflow = "scroll";
      scrollDiv.style.position = "absolute";
      scrollDiv.style.top = "-9999px";
      scrollDiv.style.width = "50px";
      document.body.appendChild(scrollDiv);

      const scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
      document.body.removeChild(scrollDiv);
      return scrollbarWidth;
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
        widget.classList.add("scrollbar-compensator");
        widget.classList.add("cons-widget_hidden"); // Скрываем виджет
      } else {
        widget.classList.remove("scrollbar-compensator");
        widget.classList.remove("cons-widget_hidden"); // Показываем виджет
      }
    }

    // Включение отслеживания скролла на мобильных устройствах
    if (window.innerWidth <= (options.mobileWidth || 768)) {
      enableScrollTracking();
    }

    window.addEventListener("resize", () => {
      updateScrollbarCompensator();
      updateSVGSize();
      enableScrollTracking();
    });

    setTimeout(() => {
      widgetWrapper.classList.remove("cons-widget_masked");
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
      attributeFilter: ["style", "class"], // Отслеживаем и стили, и классы
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ["style", "class"],
    });
  }

  // Функция ожидания загрузки опций
  function waitForOptions(callback) {
    if (typeof widgetConsultationOptions !== "undefined") {
      callback();
    } else {
      setTimeout(() => waitForOptions(callback), 100);
    }
  }

  // Проверяем, нужно ли вообще запускать виджет
  if (
    typeof widgetConsultationEnabled === "undefined" ||
    widgetConsultationEnabled !== false
  ) {
    // Запускаем ожидание опций
    waitForOptions(widgetInit);
  } else {
    console.log("Widget disabled: widgetConsultationEnabled is false");
  }
})();
