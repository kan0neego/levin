

$(document).ready(() => {
  AOS.init();
  function is_mobile() {
    var mobile = (/iphone|ipod|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) && (screen.width < 767)
    if (mobile) {
        return true
    } else {
        return false
    }
}
  $(".banner-video__mouse").on("click", function (event) {
    // исключаем стандартную реакцию браузера
    event.preventDefault();

    // получем идентификатор блока из атрибута href
    var id = $(this).attr('href'),

      // находим высоту, на которой расположен блок
      top = $(id).offset().top;

    // анимируем переход к блоку, время: 800 мс

    $('body,html').animate({
      scrollTop: top
    }, 2000);

  });
   
    let video = $('video.banner-video__video');
    let videoProgress = $('.banner-video__progress span')
    video.on("timeupdate", function() {
        videoProgress.css('width', (100 / video[0].duration) * video[0].currentTime + '%')
    });

    // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
    let vh = window.innerHeight * 0.01;
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`);

  
    if ($(".logo-slider").length > 0) {
      var docSlider = new Swiper('.swiper-container.logo-slider', {
        loop: true,
        slidesPerView: 'auto',
        allowTouchMove: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        spaceBetween: 95,
        centeredSlides: true,
        breakpoints: {
       
          476: {
            slidesPerView: 'auto',
        allowTouchMove: true,
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        slideToClickedSlide: true,


          },
          992: {
              slidesPerView: 'auto',
            slidesPerView: 4,
            allowTouchMove: true,
            slideToClickedSlide: true,
            centeredSlides: true,
        loop: true,


           }
           
        }
      })
    }
    if ($(".info-slider-swiper").length > 0) {
   
      // Slider
      var infoSlider = new Swiper('.swiper-container.info-slider-swiper', {
        loop: true,
        slidesPerView: 1,
        autoHeight: true,
        autoplay: {
          delay: 5000,
        },
        pagination: {
          el: '.info-slider-swiper .swiper-pagination',
          clickable: true
        },
        breakpoints: {
          993: {
            autoplay: false
          }
        },
        navigation: {
          nextEl: '.info-slider-swiper .section-button-next',
          prevEl: '.info-slider-swiper .section-button-prev',
        },
        spaceBetween: 0,
      })
      
    }
    
    $('.logo-slider__slide').on('mouseenter', function(e){
        var $this = $(this);
        $this.addClass('is-temp-open');
        
            setTimeout(function(){
                if($this.hasClass('is-temp-open')){
                    $this.addClass('is-open');
                    
                }
            },100);
        
    });

    $('.logo-slider__slide').on('mouseleave', function(e){
        var $this = $(this);
        $this.removeClass('is-temp-open');
        
            setTimeout(function(){
                if(!$this.hasClass('is-temp-open')){
                    $this.removeClass('is-open');
                    
                }
            },300);
        
    });

})
