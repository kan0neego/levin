jQuery(document).ready(function ($) {
  $.post(
    promo_ajax.ajax_url,
    {
      action: "load_promo_banner",
      nonce: promo_ajax.nonce,
    },
    function (html) {
      if (html.trim()) {
        $("#promo-stb-container")
          .removeClass("promo-banner-skeleton") 
          .addClass("promo-loaded")
          .html(html);
        initCloseButton();
      }
    }
  );
});

function initCloseButton() {
  const closeButton = document.querySelector(".site-notice__button-close");
  const noticeWrapper = document.querySelector("#promo-stb-container");

  if (closeButton && noticeWrapper) {
    closeButton.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      noticeWrapper.style.display = "none";
    });
  }
}
