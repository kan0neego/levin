(() => {
    const throttle = (type, name, obj) => {
        obj = obj || window;
        let running = !1;
        const func = () => {
            if (running) {
                return
            }
            running = !0;
            requestAnimationFrame( () => {
                obj.dispatchEvent(new CustomEvent(name));
                running = !1
            }
            )
        }
        ;
        obj.addEventListener(type, func)
    }
    ;
    throttle('resize', 'optimizedResize')
}
)();
(obj => {
    obj = obj || window;
    obj.animation = (elem, prop, cb) => {
        const count = prop.count;
        let counter = 0;
        if (prop.start) {
            prop.start.forEach(item => {
                elem.style[item[0]] = item[1]
            }
            )
        }
        const allAnimation = [];
        prop.anim.forEach( ([style,from,to]) => {
            const max = Math.max(from, to);
            const min = Math.min(from, to);
            const step = (max - min) / count;
            allAnimation.push({
                style,
                from,
                to,
                step,
                reverse: min === to
            })
        }
        );
        const rafAnimation = () => {
            allAnimation.forEach(item => {
                if (item.reverse) {
                    item.from -= item.step
                } else {
                    item.from += item.step
                }
                elem.style[item.style] = item.from
            }
            );
            counter++;
            if (counter < count) {
                requestAnimationFrame(rafAnimation)
            } else {
                if (prop.end) {
                    prop.end.forEach(item => {
                        elem.style[item[0]] = item[1]
                    }
                    )
                }
                if (cb)
                    cb();
            }
        }
        ;
        requestAnimationFrame(rafAnimation)
    }
}
)();
const init = () => {
    const overlay = document.createElement('div');
    overlay.className = 'videotube-modal-overlay';
    document.body.insertAdjacentElement('beforeend', overlay);
    
    const videotubeModalOverlay = document.querySelector(".videotube-modal-overlay");
    const video = document.createElement('div');
    video.id = 'videotube-modal-container';
    
    const sizeBlockList = [[3840, 2160], [2560, 1440], [1920, 1080], [1280, 720], [854, 420], [640, 360], [426, 240], ];
    const sizeVideo = () => {
        const sizeBlock = sizeBlockList.find(item => item[0] < window.visualViewport.width) || sizeBlockList[sizeBlockList.length - 1];
        let interval = setInterval(() => {
            let iframe = document.getElementById('videotube-modal-container');
            if (iframe) {
                clearInterval(interval);
                iframe.style.width = sizeBlock[0] + 'px';
                iframe.style.height = sizeBlock[1] + 'px';
            }
        }, 500);
    };
    const sizeContainer = () => {
        const wh = window.visualViewport.height;
        const ww = window.visualViewport.width;
        const fw = video.style.width;
        const fh = video.style.height;
        video.style.left = (ww - fw) / 2;
        video.style.top = (wh - fh) / 2;
        overlay.style.height = document.documentElement.clientHeight;
    }
    ;
    const sizeVideoTubeModal = () => {
        sizeContainer();
        sizeVideo();
    }
    ;
    const closeVideoTubeModal = () => {
        videotubeModalOverlay.style.pointerEvents = 'none';
        animation(overlay, {
            end: [['display', 'none']],
            anim: [['opacity', 1, 0]],
            count: 20,
        }, );
        window.removeEventListener('optimizedResize', sizeVideoTubeModal);
        document.removeEventListener('keyup', closeContainerEsc);
        document.querySelector('#videotube-modal-container > iframe').src = '';
    };
    const closeContainerEsc = e => {
        if (e.keyCode === 27) {
            closeVideoTubeModal();
        }
    };
    const openVideoTubeModal = e => {
        if (e.target.closest(".tube")) {
            videotubeModalOverlay.style.pointerEvents = 'all'
        }
        const target = e.target.closest('.tube');
        if (!target)
            return;
        
        const href = target.href;
        const search = href.includes('rutube');
        let idVideo = search ? href.match(/\/video\/([^\/]+)/)[1] : null;
        if (idVideo.length === 0)
            return;
        
        e.preventDefault();
        animation(overlay, {
            start: [['display', 'block']],
            anim: [['opacity', 0, 1]],
            count: 20,
        });
        
        
        
        if (!document.querySelector("#videotube-modal-container")) {
            overlay.insertAdjacentHTML('beforeend', `
        <div id="videotube-modal-close">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306C514.019,27.23,514.019,14.135,505.943,6.058z"></path></g></g><g><g><path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"></path></g></g></svg>
        </div>
        <div class="preloader preloader_active">
          <div class="preloader__container">
            <div class="preloader__round"></div>
          </div>
        </div>
        <div id="videotube-modal-container">
            <iframe width="100%" height="100%" src="" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div>
      `);
        }
        document.querySelector('#videotube-modal-container > iframe').src = 'https://rutube.ru/play/embed/' + idVideo + '/';
        
        const preloader = document.querySelector(".preloader:not(.preloader_iframe)");
        const preloaderRound = preloader && preloader.querySelector(".preloader__round");
        if (preloaderRound) {
            preloaderRound.style.background = "rgb(25 0 84)";
        }
        
        sizeVideo();
        sizeContainer();
        window.addEventListener('optimizedResize', sizeVideoTubeModal);
        document.addEventListener('keyup', closeContainerEsc);
        
        const videotubeModalContainer = document.querySelector("#videotube-modal-container");
        videotubeModalContainer.style.display = "initial";
        if (preloader) {
            preloader.classList.remove("preloader_active");
        }
    }
    ;
    overlay.addEventListener('click', closeVideoTubeModal);
    document.addEventListener('click', openVideoTubeModal)
};
window.addEventListener("DOMContentLoaded", init);
