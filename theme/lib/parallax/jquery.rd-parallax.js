/*
 * Author: Evgeniy Gusarov StMechanus (Diversant)
 * Under the MIT License
 *
 * Version: 2.0.1
 *
 */

!function(i){var t=function(t,e){this.options=e,this.settings={imageClass:"parallax_image",patternClass:"parallax_pattern",contentClass:"parallax_cnt",wrapClass:"parallax"},this.$wrap=i(t),this.$image=i.noop()};t.prototype={init:function(){var i=this;i.isInit=!0,i.createDOM(),i.blur(),i.createListeners()},createDOM:function(){var t=this;t.$wrap.addClass(t.settings.wrapClass).wrapInner(i("<div/>",{"class":t.settings.contentClass})).prepend(i("<div/>",{"class":t.options.pattern?t.settings.patternClass:t.settings.imageClass}).css({"background-image":"url("+t.options.url+")","background-color":t.options.color})),t.$image=t.options.pattern?t.$wrap.find("."+t.settings.patternClass):t.$wrap.find("."+t.settings.imageClass)},createListeners:function(){this.createResizeListener(),this.createScrollListener()},createScrollListener:function(){var t=this;(!t.isMobile()||t.options.mobile)&&(i(window).bind("touchstart",function(){t.isTouched=!0}),i(window).bind("touchend",function(){t.timer&&clearTimeout(t.timer),t.timer=setTimeout(function(){t.isTouched=!1},1200)}),i(window).bind("scroll",function(){t.move()}),t.move())},createResizeListener:function(){var t=this;(!t.isMobile()||t.options.mobile)&&(t.isMobile()||i(window).bind("resize",function(){t.resize()}),i(window).bind("orientationchange",function(){setTimeout(function(){t.resize()},300)}),t.resize())},move:function(){var t=this;if(t.isVisible()&&(!t.isMobile()||t.options.mobile)){var e=i(window).scrollTop(),n=t.$wrap.offset().top,o=i(window).height(),a=t.$wrap.outerHeight(),r=t.$image.height(),s=t.options.speed;0>s&&(s=0),s>1&&(s=1);var l=(e-(n-o))/(n+a-(n-o))*s;if("normal"==t.options.direction)var c=l*(a-r);else var c=(1-l)*(a-r);t.isIE()&&t.ieVersion()<=10?t.$image.css("top",""+c+"px"):t.isMobile()&&t.options.mobile?(t.isTouched||t.isInit)&&(t.$image.stop().animate({pos:c},{step:function(t){i(this).css("transform","translate3d(0, "+t+"px, 0)")},duration:t.options.duration},t.options.easing),t.isInit=!1):t.$image.css("transform","translate3d(0, "+c+"px, 0)"),t.isFirefox()&&window.devicePixelRatio<1&&(t.$image.css("background-color","#010101"),setTimeout(function(){t.$image.css("background-color",t.options.color)},10))}},resize:function(){var t=this,e=Math.max(i(window).height(),500);e<t.$wrap.outerHeight()&&(e=t.$wrap.outerHeight()+i(window).height()*t.options.speed),t.$image.height(e),setTimeout(function(){t.move(),t.blur()},300)},blur:function(){var t=this;!t.options.blur||t.isIE()||t.options.pattern||i("<img/>",{src:t.options.url}).load(function(){var i=t.$image.height()/this.height,e=t.$image.width()/this.width,n=Math.floor(Math.max(i,e));n>2?t.$image.css({filter:"blur("+n+"px)","-webkit-filter":"blur("+n+"px)"}):t.$image.css({filter:"blur(0px)","-webkit-filter":"blur(0px)"})})},isVisible:function(){var t=this,e=i(window).scrollTop(),n=i(window).height(),o=t.$wrap.offset().top,a=t.$wrap.outerHeight();return o+a>=e&&e+n>=o},isIE:function(){return-1!=navigator.appVersion.indexOf("MSIE")?!0:!1},isMobile:function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)},ieVersion:function(){return parseFloat(navigator.appVersion.split("MSIE")[1])},isFirefox:function(){return"undefined"!=typeof InstallTrigger}},i.fn.rdparallax=function(e){var n=this.each(function(){var n=i.extend({},i.fn.rdparallax.defaults,e);n.url?new t(this,n).init():console.error("RD Parallax: data-url is not defined")});return n},i.fn.rdparallax.defaults={speed:.4,direction:"normal",blur:!1,mobile:!1,url:!1,pattern:!1,duration:200,easing:"linear",color:"inherit"},window.RDParallax_autoinit=function(e){i(e).each(function(){var e=i.extend({},i.fn.rdparallax.defaults,{url:i(this).data("url"),speed:i(this).data("speed"),direction:i(this).data("direction"),blur:i(this).data("blur"),mobile:i(this).data("mobile"),pattern:i(this).data("pattern"),color:i(this).data("color")});e.url?new t(this,e).init():console.error("RD Parallax: data-url is not defined")})}}(jQuery),$(document).ready(function(){RDParallax_autoinit(".parallax")});

/*
;
(function ($) {

    var RDParallax = function (element, options) {
        this.options = options;

        this.settings = {
            'imageClass': 'parallax_image',
            'patternClass': 'parallax_pattern',
            'contentClass': 'parallax_cnt',
            'wrapClass': 'parallax'
        }

        this.$wrap = $(element);

        this.$image = $.noop();
    };

    RDParallax.prototype = {
        init: function () {
            var parallax = this;
            parallax.isInit = true;
            parallax.createDOM();
            parallax.blur();
            parallax.createListeners();
        },

        createDOM: function () {
            var parallax = this;

            parallax
                .$wrap
                .addClass(parallax.settings.wrapClass)
                .wrapInner($('<div/>', {
                    'class': parallax.settings.contentClass
                }))
                .prepend($('<div/>', {
                    'class': (parallax.options.pattern ? parallax.settings.patternClass : parallax.settings.imageClass)
                }).css({
                    'background-image': 'url(' + parallax.options.url + ')',
                    'background-color': parallax.options.color
                }));

            parallax.$image = parallax.options.pattern ? parallax.$wrap.find('.' + parallax.settings.patternClass) : parallax.$wrap.find('.' + parallax.settings.imageClass);
        },

        createListeners: function () {
            this.createResizeListener();
            this.createScrollListener();
        },

        createScrollListener: function () {
            var parallax = this;

            if (parallax.isMobile()) {
                if (!parallax.options.mobile) {
                    return;
                }
            }

            $(window).bind('touchstart', function () {
                parallax.isTouched = true;
            });

            $(window).bind('touchend', function () {
                if(parallax.timer){
                    clearTimeout(parallax.timer);
                }

                parallax.timer = setTimeout(function () {
                    parallax.isTouched = false;
                }, 1200);
            });

            $(window).bind('scroll', function () {
                parallax.move();
            });
            parallax.move();
        },

        createResizeListener: function () {
            var parallax = this;

            if (parallax.isMobile()) {
                if (!parallax.options.mobile) {
                    return;
                }
            }

            if (!parallax.isMobile()) {
                $(window).bind('resize', function () {
                    parallax.resize();
                });
            }

            $(window).bind('orientationchange', function () {
                setTimeout(function () {
                    parallax.resize();
                }, 300);
            });

            parallax.resize();
        },

        move: function () {
            var parallax = this;

            if (!parallax.isVisible()) {
                return;
            }

            if (parallax.isMobile()) {
                if (!parallax.options.mobile) {
                    return;
                }
            }

            var st = $(window).scrollTop(),
                off = parallax.$wrap.offset().top,
                wh = $(window).height(),
                h = parallax.$wrap.outerHeight(),
                ph = parallax.$image.height();

            var speed = parallax.options.speed;
            if (speed < 0) {
                speed = 0;
            }
            if (speed > 1) {
                speed = 1;
            }

            var step = (st - (off - wh)) / ((off + h) - (off - wh)) * speed;


            if (parallax.options.direction == 'normal') {
                var pos = step * (h - ph);
            } else {
                var pos = (1 - step) * (h - ph);
            }

            if (parallax.isIE() && parallax.ieVersion() <= 10) {
                parallax.$image.css('top', '' + pos + 'px');
            }
            else if (parallax.isMobile() && parallax.options.mobile) {
                if (parallax.isTouched || parallax.isInit) {
                    parallax.$image.stop().animate({pos: pos}, {
                        step: function (pos) {
                            $(this).css('transform', 'translate3d(0, ' + pos + 'px, 0)');
                        },
                        duration: parallax.options.duration
                    }, parallax.options.easing);

                    parallax.isInit = false;
                }
            } else {
                parallax.$image.css('transform', 'translate3d(0, ' + pos + 'px, 0)');
            }

            if (parallax.isFirefox() && window.devicePixelRatio < 1){
                parallax.$image.css('background-color', '#010101');

                setTimeout(function () {
                    parallax.$image.css('background-color', parallax.options.color);
                }, 10);
            }
        },

        resize: function () {
            var parallax = this,
                h = Math.max($(window).height(), 500);

            if(h < parallax.$wrap.outerHeight()){
                h = parallax.$wrap.outerHeight() + $(window).height() * parallax.options.speed;
            }

            parallax.$image.height(h);

            setTimeout(function () {
                parallax.move();
                parallax.blur();
            }, 300);
        },

        blur: function () {
            var parallax = this;

            if (parallax.options.blur && !parallax.isIE() && !parallax.options.pattern) {

                $('<img/>', {src: parallax.options.url}).load(function () {
                    var dh = parallax.$image.height() / this.height,
                        dw = parallax.$image.width() / this.width,
                        blur = Math.floor(Math.max(dh, dw));


                    if (blur > 2) {
                        parallax.$image.css({
                            'filter': 'blur(' + blur + 'px)',
                            '-webkit-filter': 'blur(' + blur + 'px)'
                        });
                    } else {
                        parallax.$image.css({
                            'filter': 'blur(' + 0 + 'px)',
                            '-webkit-filter': 'blur(' + 0 + 'px)'
                        });
                    }
                });

            }
        },

        isVisible: function () {
            var parallax = this,

                windowScroll = $(window).scrollTop(),
                windowHeight = $(window).height(),
                parallaxOffset = parallax.$wrap.offset().top,
                parallaxHeight = parallax.$wrap.outerHeight();

            return (parallaxOffset + parallaxHeight >= windowScroll) && (parallaxOffset <= windowScroll + windowHeight)
        },

        isIE: function () {
            if (navigator.appVersion.indexOf("MSIE") != -1) {
                return true;
            }
            return false;
        },

        isMobile: function () {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        },

        ieVersion: function () {
            return parseFloat(navigator.appVersion.split("MSIE")[1]);
        },

        isFirefox: function () {
            return typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
        }
    };

    $.fn.rdparallax = function (option) {
        var element = this.each(function () {
            var options = $.extend({}, $.fn.rdparallax.defaults, option);

            if (options.url) {
                new RDParallax(this, options).init();
            } else {
                console.error('RD Parallax: data-url is not defined');
            }
        });
        return element;
    };

    $.fn.rdparallax.defaults = {
        speed: 0.4,
        direction: 'normal',
        blur: false,
        mobile: false,
        url: false,
        pattern: false,
        duration: 200,
        easing: 'linear',
        color: 'inherit'
    };

    window.RDParallax_autoinit = function (selector) {
        $(selector).each(function () {
            var options = $.extend({}, $.fn.rdparallax.defaults, {
                url: $(this).data('url'),
                speed: $(this).data('speed'),
                direction: $(this).data('direction'),
                blur: $(this).data('blur'),
                mobile: $(this).data('mobile'),
                pattern: $(this).data('pattern'),
                color: $(this).data('color')
            });

            if (options.url) {
                new RDParallax(this, options).init();
            } else {
                console.error('RD Parallax: data-url is not defined');
            }
        });
    };
})(jQuery);

$(document).ready(function () {
    RDParallax_autoinit('.parallax');
});
*/
