(function () {
  function init() {
    const burger = document.querySelector(`.burger`);
    const navBox = document.querySelector(`.sidebar-new__navn-box`);
    const firstNavLinks = document.querySelectorAll(`.navn__item .navn__link`);
    const secondNavClose = document.querySelector(`.second-navn__close`);
    const secondNavItems = document.querySelectorAll(`.second-navn__item`);
    const secondNavLinks = document.querySelectorAll(
      `.second-navn .second-navn__link`,
    );
    const contactBtn = document.querySelector(`.sidebar-new__contact-btn`);
    const sidebarTopInfo = document.querySelector(`.sidebar-new__top-info`);
    const sidebarFooter = document.querySelector(`.sidebar-new__footer`);
    const thirdNavCross = document.querySelectorAll(`.third-navn__cross`);

    function preventScroll(e) {
      // Разрешаем скролл внутри меню (third-navn на десктопе, sidebar__item на мобиле)
      if (e.target.closest(".third-navn, .second-navn, .sidebar__item")) return;
      e.preventDefault();
    }
    const scrollKeys = [
      "ArrowUp",
      "ArrowDown",
      "PageUp",
      "PageDown",
      "Home",
      "End",
      " ",
    ];
    function preventKeys(e) {
      if (scrollKeys.includes(e.key)) e.preventDefault();
    }

    function lockScroll() {
      document.documentElement.style.overflowY = "hidden";
      document.body.classList.add("menu-open");
      document.addEventListener("wheel", preventScroll, { passive: false });
      document.addEventListener("touchmove", preventScroll, { passive: false });
      document.addEventListener("keydown", preventKeys);
    }

    function unlockScroll() {
      document.documentElement.style.overflowY = "";
      document.body.classList.remove("menu-open");
      document.removeEventListener("wheel", preventScroll);
      document.removeEventListener("touchmove", preventScroll);
      document.removeEventListener("keydown", preventKeys);
    }

    if (burger) {
      burger.addEventListener(`click`, burgerHandler);
    }

    function burgerHandler() {
      const isOpening = !burger.classList.contains(`active`);
      burger.classList.toggle(`active`);
      navBox.classList.toggle(`active`);
      sidebarTopInfo.classList.toggle(`active`);
      sidebarFooter.classList.toggle(`active`);
      isOpening ? lockScroll() : unlockScroll();
    }

    function resizeHandler() {
      if (window.innerWidth >= 768) {
        burger && burger.classList.remove(`active`);
        navBox && navBox.classList.remove(`active`);
        sidebarTopInfo && sidebarTopInfo.classList.remove(`active`);
        sidebarFooter && sidebarFooter.classList.remove(`active`);
        unlockScroll();
        if (contactBtn) {
          contactBtn.innerHTML = `Контактная информация`;
        }
        footerMob && footerMob.classList.remove(`active`);
      } else {
        if (contactBtn) {
          contactBtn.innerHTML = `Контакты`;
        }
      }
    }

    window.addEventListener(`resize`, resizeHandler);

    firstNavLinks.forEach((element) => {
      element.addEventListener(`click`, (event) => {
        const navItem = event.target.closest(`.navn__item`);
        if (navItem.querySelector(`.second-navn`)) {
          event.preventDefault();
          const isOpening = !navItem.classList.contains(`active`);
          navItem.classList.toggle(`active`);

          if (window.innerWidth >= 1025) {
            isOpening ? lockScroll() : unlockScroll();
          }
        }
      });
    });

    secondNavLinks.forEach((element) => {
      element.addEventListener(`click`, (event) => {
        event.preventDefault();
        if (
          event.target
            .closest(`.second-navn__item`)
            .classList.contains(`active`)
        ) {
          event.target.closest(`.second-navn__item`).classList.remove(`active`);
        } else {
          secondNavItems.forEach((item) => {
            item.classList.remove(`active`);
          });
          event.target.closest(`.second-navn__item`).classList.add(`active`);
        }
      });
    });

    thirdNavCross.forEach((element) => {
      element.addEventListener(`click`, (event) => {
        event.target.closest(`.second-navn__item`).classList.remove(`active`);
        event.target.closest(`.navn__item`).classList.remove(`active`);

        unlockScroll();
      });
    });

    if (secondNavClose) {
      secondNavClose.addEventListener(`click`, (event) => {
        event.target.closest(`.navn__item`).classList.remove(`active`);
        
        unlockScroll();
      });
    }

    if (window.innerWidth < 1025) {
      secondNavItems.forEach((item) => {
        item.classList.remove(`active`);
      });
    }

    const footerMob = document.querySelector(`.mobile-navn`);

    if (footerMob && window.innerWidth < 767) {
      footerMob.classList.remove(`active`);
      window.addEventListener(`scroll`, function () {
        if (window.scrollY > window.innerHeight) {
          footerMob.classList.add(`active`);
        } else {
          footerMob.classList.remove(`active`);
        }
      });
    }

    const accordionContactsItems = document.querySelectorAll(
      `.contacts-accordion__item`,
    );
    accordionContactsItems.forEach((element) => {
      const header = element.querySelector(`.contacts-accordion__header`);
      if (!header) return;
      header.addEventListener(`click`, (event) => {
        event.target
          .closest(`.contacts-accordion__header`)
          .classList.toggle(`active`);
        event.target
          .closest(`.contacts-accordion__item`)
          .querySelector(`.contacts-accordion__content`)
          .classList.toggle(`active`);
      });
    });
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }
})();
