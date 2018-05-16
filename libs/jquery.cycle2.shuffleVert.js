/*! shuffle transition plugin for Cycle2;  version: 20140128 */
(function($) {
"use strict";

$.fn.cycle.transitions.shuffleVert = {

    transition: function( opts, currEl, nextEl, fwd, callback ) {
        $( nextEl ).css({
            display: 'block',
            visibility: 'visible'
        });
        var height = opts.container.css( 'overflow', 'visible' ).height();
        var speed = opts.speed / 2; // shuffle has 2 transitions
        var element = fwd ? currEl : nextEl;

        opts = opts.API.getSlideOpts( fwd ? opts.currSlide : opts.nextSlide );
        var props1 = { top:height, left:15 };
        var props2 =  opts.slideCss || { top:0, left:0};

        if ( opts.shuffleTop !== undefined ) {
            props1.top = props1.top + parseInt(opts.shuffleTop, 10) || 0;
        } 
        else if ( opts.shuffleBottom !== undefined ) {
            props1.top = height + parseInt(opts.shuffleBottom, 10) || 0;
        } 
        if ( opts.shuffleLeft ) {
            props1.left = opts.shuffleLeft;
        }

        // transition slide in 3 steps: move, re-zindex, move
        $( element )
            .animate( props1, speed, opts.easeIn || opts.easing )
            .queue( 'fx', $.proxy(reIndex, this))
            .animate( props2, speed, opts.easeOut || opts.easing, callback );

        function reIndex(nextFn) {
            /*jshint validthis:true */
            this.stack(opts, currEl, nextEl, fwd);
            nextFn();
        }
    },

    stack: function( opts, currEl, nextEl, fwd ) {
        var i, z;

        if (fwd) {
            opts.API.stackSlides( nextEl, currEl, fwd );
            // force curr slide to bottom of the stack
            $(currEl).css( 'zIndex', 1 );
        }
        else {
            z = 1;
            for (i = opts.nextSlide - 1; i >= 0; i--) {
                $(opts.slides[i]).css('zIndex', z++);
            }
            for (i = opts.slideCount - 1; i > opts.nextSlide; i--) {
                $(opts.slides[i]).css('zIndex', z++);
            }
            $(nextEl).css( 'zIndex', opts.maxZ );
            $(currEl).css( 'zIndex', opts.maxZ - 1 );
        }
    }
};

})(jQuery);
