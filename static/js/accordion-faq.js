/**
 * accordion-faq.js
 * Аккордеон вопрос-ответ (.question / .accordeon).
 * Свёрнутая/развёрнутая высота вычисляется динамически из реальной высоты
 * .accordeon__head и .accordeon__body — поддерживает заголовки на 2+ строки.
 */

(function () {
    function Accordion( el ) {
        this.accordeon = el;
        this.closedHeight = el.querySelector( '.accordeon__head' ).clientHeight;
        this.openHeight = this.closedHeight + el.querySelector( '.accordeon__body' ).clientHeight;
    }

    Accordion.prototype.open = function () {
        this.accordeon.classList.add( 'accordeon_open' );
        this.accordeon.style.maxHeight = this.openHeight + 'px';
        this.accordeon.dataset.isopen = 'true';

        if ( is_mobile() ) {
            var hash = $( '.accordeon_open' ).position().top;
            $( 'body,html' ).animate( { scrollTop: hash }, 100 );
        }
    };

    Accordion.prototype.close = function () {
        this.accordeon.classList.remove( 'accordeon_open' );
        this.accordeon.style.maxHeight = this.closedHeight + 'px';
        this.accordeon.dataset.isopen = 'false';
    };

    Accordion.prototype.init = function () {
        var self = this;
        var el = this.accordeon;

        window.addEventListener( 'resize', function () {
            self.closedHeight = el.querySelector( '.accordeon__head' ).clientHeight;
            self.openHeight = self.closedHeight + el.querySelector( '.accordeon__body' ).clientHeight;
            el.style.maxHeight = ( el.classList.contains( 'accordeon_open' ) ? self.openHeight : self.closedHeight ) + 'px';
        } );

        if ( el.classList.contains( 'accordeon_open' ) ) {
            this.open();
        } else {
            this.close();
        }

        el.querySelector( '.accordeon__head' ).addEventListener( 'click', function () {
            if ( el.dataset.isopen === 'true' ) {
                self.close();
            } else if ( el.dataset.isopen === 'false' ) {
                self.open();
            }
        } );
    };

    document.querySelectorAll( '.question' ).forEach( function ( el ) {
        new Accordion( el ).init();
    } );
})();
