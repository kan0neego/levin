(function () {
  function init() {
    var videos = document.querySelectorAll("video");
    videos.forEach(function (video) {
      var videoSrc = video.currentSrc || video.src;
      var progressBar = document.querySelector('progress[data-progress-id="' + videoSrc + '"]');
      if (!progressBar) return;

      video.addEventListener("timeupdate", function () {
        if (video.duration) {
          progressBar.value = (video.currentTime / video.duration) * 100;
        }
      });
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
