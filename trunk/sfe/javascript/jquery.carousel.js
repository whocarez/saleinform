/*
  jquery.carousel
  made by Robin Duckett in 2009
  http://twitter.com/robinduckett
  You are free to use, modify or distribute this code as long as it retains this header.
*/
(function($) {
    $.fn.carousel = function(options) {

        var defaults = {
            start: 0,
            duration: 10000,
            hide: 'fadeOut',
            show: 'fadeIn',
            speed: 'slow',
            seed: 5,
            timer: 0,
            animate: true,
            slideshow: true
        };
        
				function _rand(lbound, ubound) {
            return (Math.floor(Math.random() * (ubound - lbound)) + lbound);
        }

        function _generateId(seed) {
            var randoChar = 'abcdefghijklmnopqrstuvwxyz0123456789';
            var sSeed = '';
            for (i = 0; i < seed; i++) {
                sSeed += randoChar.charAt(_rand(0, randoChar.length - 1));
            }
            return sSeed;
        }

        function _init() {
            $(element).children('li').each(function(index) {
            	if (options.slideshow) {
            		$(this)[index == slide ? options.show : 'hide'](index == slide ? options.speed : '').addClass(selector + index).addClass('slide')[index == slide ? 'addClass': 'removeClass']('active');
            	} else {
            		$(this).addClass(selector + index).addClass('slide')[index == slide ? 'addClass': 'removeClass']('active');
            	}
              slides = index;
            });
						
            // total time = 2*D + 2*S;
            
            options.timer = setTimeout(function() {
                var callee = arguments.callee;
                if (options.animate && options.slideshow) {
	                $(element).children('li.' + selector + slide)[options.hide](options.speed,
	                function() {
	                	$(this).removeClass('active');
	                  slide = slide == slides ? 0: slide + 1;
	                  $(element).children('li.' + selector + slide).addClass('active');
	                  $(element).children('li.' + selector + slide)[options.show](options.speed,
	                  function() {
	                      options.timer = setTimeout(callee, options.duration);
		                });
	                });
	              } else if (!options.slideshow && !options.animate) {
	              	setTimeout(function() {
	              		$(element).children('li.' + selector + slide).removeClass('active');
	              		slide = slide == slides ? 0: slide + 1;
	                  $(element).children('li.' + selector + slide).addClass('active');
	                  setTimeout(function() {
	                  	options.timer = setTimeout(callee, options.duration);
	                  }, options.speed);
	              	}, options.speed);
	              } else if (options.slideshow && !options.animate) {
	              	setTimeout(function() {
	              		$(element).children('li.' + selector + slide).removeClass('active').hide();
	              		slide = slide == slides ? 0: slide + 1;
	                  $(element).children('li.' + selector + slide).addClass('active').show();
	                  setTimeout(function() {
	                  	options.timer = setTimeout(callee, options.duration);
	                  }, options.speed);
	              	}, options.speed);
	              }
            },
            options.duration);
        }

        options = jQuery.extend(defaults, options);
        var element = this;
        var slides;
        var slide = options.start;
        var selector = _generateId(options.seed);
        $(element).load(_init());
    };
})(jQuery);