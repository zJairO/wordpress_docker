jQuery(document).ready(function ($) {
    "use strict";

    $('a[href=\\#]').on('click', function (e) {
        e.preventDefault();
    })

    $('#myTab a').on('click', function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	
	/* Page scroll Bottom To Top */
    if ($(".scroll-wrap").length) {
        var progressPath = document.querySelector('.scroll-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function() {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.scroll-wrap').addClass('active-scroll');
            } else {
                jQuery('.scroll-wrap').removeClass('active-scroll');
            }
        });
        jQuery('.scroll-wrap').on('click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, duration);
            return false;
        })
    }


    /*---------------------------------------
    Background Parallax
    --------------------------------------- */
    if ($(".rt-parallax-bg-yes").length) {
        $(".rt-parallax-bg-yes").each(function () {
            var speed = $(this).data('speed');
            $(this).parallaxie({
                speed: speed ? speed : 0.5,
                offset: 0,
            });
        })
    }

    /*ISOTOPE HTML START*/
    var $container = $(".isotope-wrap");
    if ($container.length > 0) {
        var $isotope;
        var blogGallerIso = $(".featuredContainer", $container).imagesLoaded(function () {
            $isotope = $(".featuredContainer", $container).isotope({
                filter: "*",
                transitionDuration: "1s",
                hiddenStyle: {
                    opacity: 0,
                    transform: "scale(0.001)"
                },
                visibleStyle: {
                    transform: "scale(1)",
                    opacity: 1
                }
            });
            $(".hide-all .isotope-classes-tab a").first().trigger('click');
        });
        $container.find(".isotope-classes-tab").on("click", "a", function () {
            var $this = $(this);
            $this
                .parent(".isotope-classes-tab")
                .find("a")
                .removeClass("current");
            $this.addClass("current");
            var selector = $this.attr("data-filter");
            $isotope.isotope({
                filter: selector
            });
            return false;
        });
    }
    /* Theia Side Bar */
    if (typeof ($.fn.theiaStickySidebar) !== "undefined") {
        $('.has-sidebar .fixed-bar-coloum').theiaStickySidebar({'additionalMarginTop': 150});
        $('.shop-page .fixed-bar-coloum').theiaStickySidebar({'additionalMarginTop': 150});
    }

    /* Header Search */
    $('a[href="#header-search"]').on("click", function (event) {
        event.preventDefault();
        $("#header-search").addClass("open");
        $('#header-search > form > input[type="search"]').focus();
    });

    $("#header-search, #header-search button.close").on("click keyup", function (event) {
        if (
            event.target === this ||
            event.target.className === "close" ||
            event.keyCode === 27
        ) {
            $(this).removeClass("open");
        }
    });

    /* masonary */
    var gridIsoContainer = $(".rt-masonry-grid");
    if (gridIsoContainer.length) {
        var imageGallerIso = gridIsoContainer.imagesLoaded(function () {
            imageGallerIso.isotope({
                itemSelector: ".rt-grid-item",
                percentPosition: true,
                isAnimated: true,
                masonry: {
                    columnWidth: ".rt-grid-item",    
                    horizontalOrder: true                    
                },
                animationOptions: {
                    duration: 700,
                    easing: 'linear',
                    queue: false
                }
            });
        });
    }
    
    /* Mobile menu */
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 100) {
            $("body").addClass("not-top");
            $("body").removeClass("top");
        } else {
            $("body").addClass("top");
            $("body").removeClass("not-top");
        }
    });

    /*button animation*/
    $(".btn-common").hover(
        function() {
            $(this).removeClass("rt-animation-out");
        },
        function() {
            $(this).addClass("rt-animation-out");
        }
    );

    /*Hover animation*/
    if( techkitObj.rtl =='yes'  ) {    
        $(".animted-bg-wrap").on("mouseenter", function(e) {
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.right,
                relY = e.pageY - parentOffset.top;
            if ($(this).find(".animted-bg-wrap .animted-bg")) {
                $(".animted-bg-wrap .animted-bg").css({
                    top: relY,
                    right: relX,
                });
            }
        });    
        $(".animted-bg-wrap").on("mouseout", function(e) {
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.right,
                relY = e.pageY - parentOffset.top;
            if ($(this).find(".animted-bg-wrap .animted-bg")) {
                $(".animted-bg-wrap .animted-bg").css({
                    top: relY,
                    right: relX,
                });
            }
        });
    }else {
        $(".animted-bg-wrap").on("mouseenter", function(e) {
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
            if ($(this).find(".animted-bg-wrap .animted-bg")) {
                $(".animted-bg-wrap .animted-bg").css({
                    top: relY,
                    left: relX,
                });
            }
        });    
        $(".animted-bg-wrap").on("mouseout", function(e) {
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
            if ($(this).find(".animted-bg-wrap .animted-bg")) {
                $(".animted-bg-wrap .animted-bg").css({
                    top: relY,
                    left: relX,
                });
            }
        });
    }


    /* Search Box */
    $(".search-box-area").on('click', '.search-button, .search-close', function (event) {
        event.preventDefault();
        if ($('.search-text').hasClass('active')) {
            $('.search-text, .search-close').removeClass('active');
        } else {
            $('.search-text, .search-close').addClass('active');
        }
        return false;
    });

    /* Header Right Menu */
    var menuArea = $('.additional-menu-area');
    menuArea.on('click', '.side-menu-trigger', function (e) {
        e.preventDefault();
        var self = $(this);
        if (self.hasClass('side-menu-open')) {
            $('.sidenav').css('transform', 'translateX(0%)');
            if (!menuArea.find('> .rt-cover').length) {
                menuArea.append("<div class='rt-cover'></div>");
            }
            self.removeClass('side-menu-open').addClass('side-menu-close');
        }
    });
	
	/*-------------------------------------
	Offcanvas Menu activation code
	-------------------------------------*/
    function closeMenuArea() {
        var trigger = $('.side-menu-trigger', menuArea);
        trigger.removeClass('side-menu-close').addClass('side-menu-open');
        if (menuArea.find('> .rt-cover').length) {
            menuArea.find('> .rt-cover').remove();
        }

        if( techkitObj.rtl =='yes'  ) {
            $('.sidenav').css('transform', 'translateX(-100%)');
        }else {
            $('.sidenav').css('transform', 'translateX(100%)');
        }
    }

    menuArea.on('click', '.closebtn', function (e) {
        e.preventDefault();
        closeMenuArea();
    });

    $(document).on('click', '.rt-cover', function () {
        closeMenuArea();
    });

    /*-------------------------------------
    MeanMenu activation code
    --------------------------------------*/
    var a = $('.offscreen-navigation .menu');

    if (a.length) {
        a.children("li").addClass("menu-item-parent");
        a.find(".menu-item-has-children > a").on("click", function (e) {
            e.preventDefault();
            $(this).toggleClass("opened");
            var n = $(this).next(".sub-menu"),
                s = $(this).closest(".menu-item-parent").find(".sub-menu");
            a.find(".sub-menu").not(s).slideUp(250).prev('a').removeClass('opened'), n.slideToggle(250)
        });
        a.find('.menu-item:not(.menu-item-has-children) > a').on('click', function (e) {
            $('.rt-slide-nav').slideUp();
            $('body').removeClass('slidemenuon');
        });
    }

    $('.mean-bar .sidebarBtn').on('click', function (e) {
        e.preventDefault();
        if ($('.rt-slide-nav').is(":visible")) {
            $('.rt-slide-nav').slideUp();
            $('body').removeClass('slidemenuon');
        } else {
            $('.rt-slide-nav').slideDown();
            $('body').addClass('slidemenuon');
        }

    });

    /*Header and mobile menu stick*/
    $(window).on('scroll', function () {
        if ($('body').hasClass('sticky-header')) {            

            // Sticky header
            var stickyPlaceHolder = $("#sticky-placeholder"),
                menu = $("#header-menu"),
                menuH = menu.outerHeight(),
                topHeaderH = $('#tophead').outerHeight() || 0,
                middleHeaderH = $('#header-top-fix').outerHeight() || 0,
                targrtScroll = topHeaderH + middleHeaderH;
            if ($(window).scrollTop() > targrtScroll) {
                menu.addClass('rt-sticky');
                stickyPlaceHolder.height(menuH);
            } else {
                menu.removeClass('rt-sticky');
                stickyPlaceHolder.height(0);
            }

            // Sticky mobile header
            var stickyPlaceHolder = $("#rt-sticky-placeholder"),
                menu = $(".mean-container"),
                menuH = menu.outerHeight(),
                topHeaderH = $('#mobile-top-fix').outerHeight() || 0,
                topAdminH = $('#wpadminbar').outerHeight() || 0,
                targrtScroll = topHeaderH + topAdminH;
            if ($(window).scrollTop() > targrtScroll) {
                menu.addClass('mobile-sticky');
               stickyPlaceHolder.height(menuH);
            } else {
                menu.removeClass('mobile-sticky');
                stickyPlaceHolder.height(0);
            }
        }
    });

    /* Woocommerce Shop change view */
    $('#shop-view-mode li a').on('click', function () {
        $('body').removeClass('product-grid-view').removeClass('product-list-view');

        if ($(this).closest('li').hasClass('list-view-nav')) {
            $('body').addClass('product-list-view');
            Cookies.set('shopview', 'list');
        } else {
            $('body').addClass('product-grid-view');
            Cookies.remove('shopview');
        }
        return false;
    });

    // Popup - Used in video
    if (typeof $.fn.magnificPopup == 'function') {
        $('.rt-video-popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }
    if (typeof $.fn.magnificPopup == 'function') {
        if ($('.zoom-gallery').length) {
            $('.zoom-gallery').each(function () { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a.techkit-popup-zoom', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        }
    }

    /* Hoverdir Initialization  */
    $(".multi-side-hover").each(function() {
        $(this).hoverdir({
            hoverDelay: 5,
        });
    });

    /* when product quantity changes, update quantity attribute on add-to-cart button */
    $("form.cart").on("change", "input.qty", function () {
        if (this.value === "0")
            this.value = "1";

        $(this.form).find("button[data-quantity]").data("quantity", this.value);
    });

    /* remove old "view cart" text, only need latest one thanks! */
    $(document.body).on("adding_to_cart", function () {
        $("a.added_to_cart").remove();
    });

    /*variable ajax cart end*/
    $('.quantity').on('click', '.plus', function (e) {
        var self = $(this),
            $input = self.prev('input.qty'),
            target = self.parents('form').find('.product_type_simple'),
            val = parseInt($input.val(), 10) + 1;
        target.attr("data-quantity", val);
        $input.val(val);

        return false;
    });

    $('.quantity').on('click', '.minus', function (e) {
        var self = $(this),
            $input = self.next('input.qty'),
            target = self.parents('form').find('.product_type_simple'),
            val = parseInt($input.val(), 10);
        val = (val > 1) ? val - 1 : val;
        target.attr("data-quantity", val);
        $input.val(val);
        return false;
    });

});

function techkit_load_content_area_scripts($) {

    /* progress circle */
    $('.rt-progress-circle').each(function () {
        var startcolor = $(this).data('rtstartcolor'),
            endcolor = $(this).data('rtendcolor'),
            num = $(this).data('rtnum'),
            speed = $(this).data('rtspeed'),
            suffix = $(this).data('rtsuffix');
        $(this).circleProgress({
            value: 1,
            fill: endcolor,
            emptyFill: startcolor,
            thickness: 5,
            size: 140,
            animation: {duration: speed, easing: "circleProgressEasing"},
        }).on('circle-animation-progress', function (event, progress) {
            $(this).find('.rtin-num').html(Math.round(num * progress) + suffix);
        });
    });

}

//function Load
function techkit_content_load_scripts() {
    var $ = jQuery;
    // Preloader
    $('#preloader').fadeOut('slow', function () {
        $(this).remove();
    });

    var windowWidth = $(window).width();

    /* Owl Custom Nav */
    if (typeof $.fn.owlCarousel == 'function') {
        $(".owl-custom-nav .owl-next").on('click', function () {
            $(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
        });
        $(".owl-custom-nav .owl-prev").on('click', function () {
            $(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
        });

        $(".rt-owl-carousel").each(function () {
            var options = $(this).data('carousel-options');
            if (techkitObj.rtl == 'yes') {
                options['rtl'] = true; //@rtl
            }
            $(this).owlCarousel(options);
        });
    }

    /* Isotope */
    if (typeof $.fn.isotope == 'function') {
        var $parent = $('.rt-isotope-wrapper'),
            $isotope;
        var blogGallerIso = $(".rt-isotope-content", $parent).imagesLoaded(function () {
            $isotope = $(".rt-isotope-content", $parent).isotope({
                filter: "*",
                transitionDuration: "1s",
                hiddenStyle: {
                    opacity: 0,
                    transform: "scale(0.001)"
                },
                visibleStyle: {
                    transform: "scale(1)",
                    opacity: 1
                }
            });
            $('.rt-isotope-tab a').on('click', function () {
                console.log('click');
                var $parent = $(this).closest('.rt-isotope-wrapper'),
                    selector = $(this).attr('data-filter');
                console.log($parent);
                $parent.find('.rt-isotope-tab .current').removeClass('current');
                $(this).addClass('current');
                $isotope.isotope({
                    filter: selector
                });

                return false;
            });

            $(".hide-all .rt-portfolio-tab a").first().trigger('click');
        });
    }

    // Banner slider
    $('.rt-banner-slider').each(function() {
        var $this = $(this);
        var settings = $this.data('options');
        var autoplayconditon= settings['auto'];
        let swiper = new Swiper('.rt-banner-slider', {  
            slidesPerView: 1,
            spaceBetween: 0,
            speed: settings['speed'],
            loop:  settings['loop'],
            autoplay:   autoplayconditon,
            autoplayTimeout: settings['autoplay']['delay'],
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                type: 'bullets',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        swiper.init();
    });

    imageFunction();

    function imageFunction() {
        $("[data-bg-image]").each(function () {
        let img = $(this).data("bg-image");
            $(this).css({
                backgroundImage: "url(" + img + ")",
            });
        });
    }

    /* Counter */
    var counterContainer = $('.counter');
    if (counterContainer.length) {
        counterContainer.counterUp({
            delay: counterContainer.data('rtsteps'),
            time: counterContainer.data('rtspeed')
        });
    }

    /* Circle Bars - Knob */
    if (typeof ($.fn.knob) !== undefined) {
        $('.knob.knob-percent.dial').each(function () {
            var $this = $(this),
                knobVal = $this.attr('data-rel');
            $this.knob({
                'draw': function () {
                },
                'format': function (value) {
                    return value + '%';
                }
            });
            $this.appear(function () {
                $({
                    value: 0
                }).animate({
                    value: knobVal
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function () {
                        $this.val(Math.ceil(this.value)).trigger('change');
                    }
                });
            }, {
                accX: 0,
                accY: -150
            });
        });
    }
	
	/* Multiscroll activation code */
   if ($.fn.multiscroll !== undefined) {
        $('#multiscroll').multiscroll({
            anchors: ['p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15'],
            menu: '#msmenu',
            verticalCentered: true,
            navigation: true,
			navigationPosition: 'right',
            css3: true,
            responsiveWidth: 992,
            responsiveExpand: true,
            scrollingSpeed: 700,
			keyboardScrolling: true,
			loopBottom: true,
			loopTop: true,
			easing: "easeInQuart",
            onLeave: function (index, nextIndex, direction) {
            },
            afterLoad: function (anchorLink, index) {
            },
            afterRender: function () {
            }
        });
    }
		
	/* vanilla Tilt Effect */
	var tiltBlock = $(".js-tilt");
    if (tiltBlock.length) {
        $(".js-tilt").tilt({
            glare: true,
            maxGlare: 0.4,
        });
    }
	
    /* Wow Js Init */
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true,
        scrollContainer: null,
    });

    new WOW().init();

}

(function ($) {
    "use strict";

    // Window Load+Resize
    $(window).on('load resize', function () {

        // Define the maximum height for mobile menu
        var wHeight = $(window).height();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('max-height', wHeight + 'px');

        // Elementor Frontend Load
        $(window).on('elementor/frontend/init', function () {
            if (elementorFrontend.isEditMode()) {
                elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
                    techkit_content_load_scripts();
                });
            }
        });

    });

    // Window Load
    $(window).on('load', function () {
        techkit_content_load_scripts();
    });


    /*Single case like*/
    $('.techkit-like').on('click', function(e){
        var $element = $(this);
        if($element.hasClass('unregistered')){
            alert('You need to register to like this post');
            return;
        }
        var data = {
            action: 'techkit_like',
            post_id: parseInt($element.data('id'), 10) || 0
        };

        $.ajax({
          method: "POST",
          url: techkitObj.ajaxURL,
          data: data,
          dataType: "json",
          beforeSend: function(){
            console.log(data);
          },
          success:function(res){
            console.log(res);
            if(res.success === true){
                if(res.data.action == 'unliked' ){
                    $element.removeClass('liked');

                }else if(res.data.action == 'liked'){
                    $element.addClass('liked');
                }
            }else{
                alert(res.data);
            }
          }
        });

    });

    //woocommerce ajax  
    var WooCommerce = {
       quantity_change: function quantity_change() {
           $(document).on('click', '.quantity .input-group-btn .quantity-btn', function() {
               var $input = $(this).closest('.quantity').find('.input-text');

               if ($(this).hasClass('quantity-plus')) {
                   $input.trigger('stepUp').trigger('change');
               }

               if ($(this).hasClass('quantity-minus')) {
                   $input.trigger('stepDown').trigger('change');
               }
           });
       },
       wishlist_icon: function wishlist_icon() {
           $(document).on('click', '.rdtheme-wishlist-icon', function() {
               if ($(this).hasClass('rdtheme-add-to-wishlist')) {
                   var $obj = $(this),
                       productId = $obj.data('product-id'),
                       afterTitle = $obj.data('title-after');
                   var data = {
                       'action': 'techkit_add_to_wishlist',
                       'context': 'frontend',
                       'nonce': $obj.data('nonce'),
                       'add_to_wishlist': productId
                   };
                   $.ajax({
                       url: techkitObj.ajaxURL,
                       type: 'POST',
                       data: data,
                       beforeSend: function beforeSend() {
                           $obj.find('.wishlist-icon').hide();
                           $obj.find('.ajax-loading').show();
                           $obj.addClass('rdtheme-wishlist-ajaxloading');
                       },
                       success: function success(data) {
                           if (data['result'] != 'error') {
                               $obj.find('.ajax-loading').hide();
                               $obj.removeClass('rdtheme-wishlist-ajaxloading');
                               $obj.find('.wishlist-icon').removeClass('far fa-heart').addClass('fas fa-heart').show();
                               $obj.removeClass('rdtheme-add-to-wishlist').addClass('rdtheme-remove-from-wishlist');
                               $obj.attr('title', afterTitle);
                               $obj.find('.wl-btn-text').text(afterTitle);
                               $(".wl-btn-text").text(function(index, text){
                                   return text.replace( "Add to Wishlist", "Added in Wishlist! View Wishlist" );  
                               });
                           } else {
                               console.log(data['message']);
                           }
                       }
                   });
                   return false;
               }
           });
       }
    };
    WooCommerce.wishlist_icon();
    WooCommerce.quantity_change();

})(jQuery);
