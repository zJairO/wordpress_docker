var $window            = $( window ),
    $html              = $( 'html' ),
    $body              = $( 'body' ),
    $pageWrapper       = $( '#page' ),
    $pageHeader        = $( '#page-header' ),
    $headerInner       = $( '#page-header-inner' ),
    $pageContent       = $( '#page-content' ),
    headerStickyEnable = $insight.header_sticky_enable,
    headerStickyHeight = parseInt( $insight.header_sticky_height ),
    wWidth             = window.innerWidth;
/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
$( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

var itemQueue = [],
    delay     = 200,
    queueTimer;

function processItemQueue( _delay ) {
	if ( _delay === undefined ) {
		_delay = delay;
	}
	// We're already processing the queue
	if ( queueTimer ) {
		return;
	}
	queueTimer = window.setInterval( function() {
		if ( itemQueue.length ) {
			$( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
			queueTimer = null;
		}
	}, _delay );
}

$( window ).on( 'resize', function() {
	$body.addClass( 'window-resized' );
	wWidth = window.innerWidth;
	calMobileMenuBreakpoint();
	boxedFixVcRow();
	calculateContentWidthSize();
	calculateLeftHeaderSize();
	initStickyHeader();
	initFooterParallax();
	singlePortfolioFullscreen();
} );

$( window ).on( 'load', function() {
	$body.addClass( 'loaded' );
	setTimeout( function() {
		$( '#page-preloader' ).remove();
	}, 600 );

	initFooterParallax();
} );

$( '.tm-animation-queue' ).each( function() {
	var _delay = $( this ).data( 'animation-delay' )
	$( this ).children( '.item' ).vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		itemQueue.push( _self );
		processItemQueue( _delay );
		this.destroy();
	}, {
		offset: '90%'
	} );
} );

calMobileMenuBreakpoint();
boxedFixVcRow();
initStickyHeader();
insightInitSmartmenu();
handlerPageNotFound();
marqueBackground();
singlePortfolioFullscreen();
handlerTestimonials();
scrollToTop();
// Remove empty p tags form wpautop.
$( 'p:empty' ).remove();

calculateContentWidthSize();
calculateLeftHeaderSize();
initAnimationForElements();

insightInitGrid();

$( '.tm-swiper' ).insightSwiper();

setTimeout( function() {
	navOnePage();
}, 100 );

initLazyLoadImages();
initSmoothScrollLinks();
initLightGalleryPopups();
initVideoPopups();
initSearchPopup();
initMobileMenu();
initOffCanvasMenu();

function initLightGalleryPopups() {
	$( '.tm-light-gallery' ).each( function() {
		insightInitLightGallery( $( this ) );
	} );
}

function initVideoPopups() {
	$( '.tm-popup-video' ).each( function() {
		var options = {
			fullScreen: false,
			zoom: false
		};
		$( this ).lightGallery( options );
	} );
}

function initLazyLoadImages() {
	if ( $insight.lazyLoadImages != 1 ) {
		return;
	}

	var myLazyLoad = new LazyLoad( {
		elements_selector: '.tm-lazy-load'
	} );
}

function marqueBackground() {
	$( '.background-marque' ).each( function() {
		var $el = $( this );
		var x = 0;
		var step = 1;
		var speed = 10;

		if ( $el.hasClass( 'to-left' ) ) {
			step = - 1;
		}

		$el.css( 'background-repeat', 'repeat-x' );

		var loop = setInterval( function() {
			x += step;
			$el.css( 'background-position-x', x + 'px' );
		}, speed );

		if ( $el.data( 'marque-pause-on-hover' ) == true ) {
			$( this ).on( 'mouseenter', function() {
				clearInterval( loop );
			} ).on( 'mouseleave', function() {
				loop = setInterval( function() {
					x += step;
					$el.css( 'background-position-x', x + 'px' );
				}, speed );
			} );
		}
	} );
}

function initSmoothScrollLinks() {
	// Allows for easy implementation of smooth scrolling for buttons.
	$( '.smooth-scroll-link' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );

		if ( ! href ) {
			href = $( this ).data( 'href' );
		}

		var _wWidth = window.innerWidth;
		if ( href.match( /^([.#])(.+)/ ) ) {
			e.preventDefault();
			var offset = 0;
			if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {

				if ( $headerInner.data( 'header-position' ) === 'left' ) {
					if ( _wWidth < $insight.mobile_menu_breakpoint ) {
						offset += headerStickyHeight;
					}
				} else {
					offset += headerStickyHeight;
				}
			}

			// Add offset of admin bar when viewport min-width 600.
			if ( _wWidth > 600 ) {
				var adminBarHeight = $( '#wpadminbar' ).height();
				offset += adminBarHeight;
			}

			$.smoothScroll( {
				offset: - offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}
	} );
}

function initAnimationForElements() {
	$( '.tm-animation' ).vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		$( _self ).addClass( 'animate' );
	}, {
		offset: '100%'
	} );
}

function insightInitSmartmenu() {
	var $primaryMenu = $pageHeader.find( '#page-navigation' ).find( 'ul' ).first();

	if ( ! $primaryMenu.hasClass( 'sm' ) ) {
		return;
	}

	$primaryMenu.smartmenus( {
		subMenusSubOffsetX: - 2,
		subMenusSubOffsetY: - 17
	} );

	// Add animation for sub menu.
	$primaryMenu.on( {
		'show.smapi': function( e, menu ) {
			$( menu ).removeClass( 'hide-animation' ).addClass( 'show-animation' );
		},
		'hide.smapi': function( e, menu ) {
			$( menu ).removeClass( 'show-animation' ).addClass( 'hide-animation' );
		}
	} ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
		$( this ).removeClass( 'show-animation hide-animation' );
		e.stopPropagation();
	} );
}

function insightInitLightGallery( $gallery ) {
	var _download   = (
		    $insight.light_gallery_download === '1'
	    ),
	    _autoPlay   = (
		    $insight.light_gallery_auto_play === '1'
	    ),
	    _zoom       = (
		    $insight.light_gallery_zoom === '1'
	    ),
	    _fullScreen = (
		    $insight.light_gallery_full_screen === '1'
	    ),
	    _share      = (
		    $insight.light_gallery_share === '1'
	    ),
	    _thumbnail  = (
		    $insight.light_gallery_thumbnail === '1'
	    );

	var options = {
		selector: '.zoom',
		thumbnail: _thumbnail,
		download: _download,
		autoplay: _autoPlay,
		zoom: _zoom,
		share: _share,
		fullScreen: _fullScreen,
		hash: false,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};

	$gallery.lightGallery( options );
}

function animateMagicLineOnScroll( $li, $magicLine, onScroll, id ) {
	if ( onScroll == false ) {
		$li.each( function() {
			var link = $( this ).children( 'a[href*="#"]:not([href="#"])' );
			if ( link.attr( 'href' ) == id ) {

				if ( $magicLine ) {
					var left = $( this ).position().left + link.padding().left;
					var width = link.width();
					$magicLine.stop().animate( {
						left: left,
						width: width
					} );
					$magicLine
						.attr( 'data-left', left )
						.attr( 'data-width', width );
				}

				$( this ).siblings( 'li' ).removeClass( 'current-menu-item' );
				$( this ).addClass( 'current-menu-item' );

				return true;
			}
		} );
	}
}

function navOnePage() {
	if ( ! $body.hasClass( 'one-page' ) ) {
		return;
	}
	var $header = $( '#page-header' );
	var $headerInner = $header.children( '#page-header-inner' );
	var isMagicLine = $headerInner.data( 'magic-line' );
	var $el,
	    newWidth,
	    $mainNav = $( '#page-navigation' ).find( '.menu__container' ).first();
	var $li = $mainNav.children( '.menu-item' );
	var $links = $li.children( 'a[href^="#"]:not([href="#"])' );
	var onScroll = false;
	var $magicLine;

	if ( isMagicLine ) {
		$mainNav.append( '<li id="magic-line"></li>' );
		$magicLine = $( '#magic-line' );
	}

	$li.each( function() {
		var link = $( this ).children( 'a[href^="#"]:not([href="#"])' );

		if ( link.length > 0 ) {
			var id = link.attr( 'href' );
			if ( $( id ).length > 0 ) {
				$( id ).vcwaypoint( function( direction ) {
					if ( direction === 'down' ) {
						animateMagicLineOnScroll( $li, $magicLine, onScroll, id );
					}
				}, {
					offset: '25%'
				} );

				$( id ).vcwaypoint( function( direction ) {
					if ( direction === 'up' ) {
						animateMagicLineOnScroll( $li, $magicLine, onScroll, id );
					}
				}, {
					offset: '-25%'
				} );
			}
		}
	} );

	if ( $magicLine ) {
		$li.on( 'mouseenter', function() {
			$el = $( this );

			var link = $el.children( 'a' );
			var left = $( this ).position().left + link.padding().left;
			newWidth = $el.children( 'a' ).width();
			$magicLine.stop().animate( {
				left: left,
				width: newWidth
			} );
		} ).on( 'mouseleave', function() {
			if ( ! $( this ).hasClass( 'current-menu-item' ) ) {
				$magicLine.stop().animate( {
					left: $magicLine.attr( 'data-left' ),
					width: $magicLine.attr( 'data-width' )
				} );
			}
		} );
	}

	// Allows for easy implementation of smooth scrolling for navigation links.
	$links.on( 'click', function() {
		var $this = $( this );
		var href = $( this ).attr( 'href' );
		var offset = 0;

		if ( $body.hasClass( 'admin-bar' ) ) {
			offset += 32;
		}

		if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
			offset += headerStickyHeight;
			offset = - offset;
		}

		var parent = $this.parent( 'li' );

		if ( $magicLine ) {
			var left = parent.position().left + $this.padding().left;
			$magicLine.attr( 'data-left', left )
			          .attr( 'data-width', $this.width() );
		}

		parent.siblings( 'li' ).removeClass( 'current-menu-item' );
		parent.addClass( 'current-menu-item' );

		$.smoothScroll( {
			offset: offset,
			scrollTarget: $( href ),
			speed: 600,
			easing: 'linear',
			beforeScroll: function() {
				onScroll = true;
			},
			afterScroll: function() {
				onScroll = false;
			}
		} );
		return false;
	} );
}

function initFooterParallax() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'parallax' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );
		if ( wWidth >= 1024 ) {
			var fwHeight = footerWrap.height();
			$body.addClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: 0
			} );
		}
	}
}

function scrollToTop() {
	if ( $insight.scroll_top_enable != 1 ) {
		return;
	}
	var $scrollUp = $( '#page-scroll-up' );
	var lastScrollTop = 0;

	$window.on( 'scroll', function() {
		var st = $( this ).scrollTop();
		if ( st > lastScrollTop ) {
			$scrollUp.removeClass( 'show' );
		} else {
			if ( $window.scrollTop() > 200 ) {
				$scrollUp.addClass( 'show' );
			} else {
				$scrollUp.removeClass( 'show' );
			}
		}
		lastScrollTop = st;
	} );

	$scrollUp.on( 'click', function( evt ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		evt.preventDefault();
	} );
}

function openMobileMenu() {
	$body.addClass( 'page-mobile-menu-opened' );
}

function closeMobileMenu() {
	$body.removeClass( 'page-mobile-menu-opened' );
}

function calMobileMenuBreakpoint() {
	var _breakpoint = $insight.mobile_menu_breakpoint;
	if ( wWidth <= _breakpoint ) {
		$body.removeClass( 'desktop-menu' ).addClass( 'mobile-menu' );
	} else {
		$body.addClass( 'desktop-menu' ).removeClass( 'mobile-menu' );
	}
}

function initMobileMenu() {
	$( '#page-open-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		openMobileMenu();
	} );

	$( '#page-close-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		closeMobileMenu();
	} );

	var menu = $( '#mobile-menu-primary' );

	menu.on( 'click', 'a', function( e ) {
		var $this = $( this );
		var _li = $( this ).parent( 'li' );
		var href = $this.attr( 'href' );

		if ( $body.hasClass( 'one-page' ) && href && href.match( /^([.#])(.+)/ ) ) {
			closeMobileMenu();
			var offset = 0;

			if ( $body.hasClass( 'admin-bar' ) ) {
				offset += 32;
			}

			if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
				offset += headerStickyHeight;
			}

			if ( offset > 0 ) {
				offset = - offset;
			}

			_li.siblings( 'li' ).removeClass( 'current-menu-item' );
			_li.addClass( 'current-menu-item' );

			setTimeout( function() {
				$.smoothScroll( {
					offset: offset,
					scrollTarget: $( href ),
					speed: 600,
					easing: 'linear'
				} );
			}, 300 );

			return false;
		}
	} );

	menu.on( 'click', '.toggle-sub-menu', function( e ) {
		var _li = $( this ).parents( 'li' ).first();

		e.preventDefault();
		e.stopPropagation();

		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );

	var $_mobileMenuWrap = $( '#page-mobile-main-menu' );

	var _headerH = $_mobileMenuWrap.children( '.page-mobile-menu-header' ).outerHeight();

	$_mobileMenuWrap.css( {
		paddingTop: _headerH + 'px'
	} );

	$( '.page-mobile-menu-content' ).css( {
		height: 'calc( 100vh - ' + _headerH + 'px )'
	} );
}

function initOffCanvasMenu() {
	var menu = $( '#off-canvas-menu-primary' );
	var _lv1 = menu.children( 'li' );

	$( '#page-open-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'page-off-canvas-menu-opened' );
	} );

	$( '#page-close-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();

		menu.fadeOut( function() {
			$body.removeClass( 'page-off-canvas-menu-opened' );
			menu.fadeIn();
			menu.find( '.sub-menu' ).slideUp();
		} );
	} );

	var transDelay = 0.1;
	_lv1.each( function() {
		$( this )[ 0 ].setAttribute( 'style', '-webkit-transition-delay:' + transDelay + 's; -moz-transition-delay:' + transDelay + 's; -ms-transition-delay:' + transDelay + 's; -o-transition-delay:' + transDelay + 's; transition-delay:' + transDelay + 's' );
		transDelay += 0.1;
	} );

	menu.on( 'click', '.menu-item-has-children > a', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		var _li = $( this ).parent( 'li' );
		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );
}

function initStickyHeader() {
	if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
		if ( $headerInner.data( 'header-position' ) != 'left' ) {
			var _hOffset = $headerInner.offset().top;

			if ( _hOffset < 0 ) {
				_hOffset = 0;
			}

			var _hHeight = $headerInner.outerHeight();
			var offset = _hOffset + _hHeight;

			$pageHeader.headroom( {
				offset: offset,
				onTop: function() {
					if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {
						$pageWrapper.css( {
							paddingTop: 0
						} );
					}
				},
				onNotTop: function() {
					if ( ! $pageHeader.hasClass( 'header-layout-fixed' ) ) {
						$pageWrapper.css( {
							paddingTop: _hHeight + 'px'
						} );
					}
				}
			} );
		} else {
			if ( wWidth <= $insight.mobile_menu_breakpoint ) {
				if ( ! $pageHeader.data( 'headroom' ) ) {
					var _hOffset = $headerInner.offset().top;

					if ( _hOffset < 0 ) {
						_hOffset = 0;
					}

					var _hHeight = $headerInner.outerHeight();
					var offset = _hOffset + _hHeight;

					$pageHeader.headroom( {
						offset: offset
					} );
				}
			} else {
				if ( $pageHeader.data( 'headroom' ) ) {
					$pageHeader.data( 'headroom' ).destroy();
					$pageHeader.removeData( 'headroom' );
				}
			}
		}
	}
}

function initSearchPopup() {
	var popupSearch = $( '#page-popup-search' );
	var searchField = popupSearch.find( '.search-field' );
	$( '#btn-open-popup-search' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'popup-search-opened' );
		$html.css( {
			'overflow': 'hidden'
		} );
		searchField.val( '' );
		setTimeout( function() {
			searchField.focus();
		}, 500 )
	} );

	$( '#popup-search-close' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.removeClass( 'popup-search-opened' );
		$html.css( {
			'overflow': ''
		} );
	} );

	$( document ).on( 'keyup', function( ev ) {
		// escape key.
		if ( ev.keyCode == 27 ) {
			$body.removeClass( 'popup-search-opened' );
			$html.css( {
				'overflow': ''
			} );
		}
	} );
}

function calculateLeftHeaderSize() {
	if ( $headerInner.data( 'header-position' ) != 'left' ) {
		return;
	}
	var _wWidth = window.innerWidth;
	var _containerWidth = parseInt( $body.data( 'content-width' ) );
	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$html.css( {
			marginLeft: 0
		} );
	} else {
		var headerWidth = $headerInner.outerWidth();
		$html.css( {
			marginLeft: headerWidth + 'px'
		} );

		var rows = $( '#page-main-content' ).children( 'article' ).children( '.vc_row' );
		var $contentWidth = $( '#page' ).width();
		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;
				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}
				var width = $contentWidth + 'px';
				$( this ).css( {
					left: left,
					width: width
				} );
				if ( $( this ).attr( 'data-vc-stretch-content' ) ) {

				} else {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );

		if ( typeof revapi6 !== 'undefined' ) {
			revapi6.revredraw();
		}
	}
}

function calculateContentWidthSize() {
	if ( $headerInner.data( 'has-fixed-section' ) != '1' ) {
		return;
	}

	var _wWidth = window.innerWidth;
	var _wHeight = window.innerHeight;
	var _containerWidth = parseInt( $body.data( 'content-width' ) );

	var _avaiHeight = window.innerHeight;
	var _headerH = $headerInner.outerHeight();
	var _offsetTop = $headerInner.outerHeight();
	if ( $body.hasClass( 'admin-bar' ) ) {
		var _adminBarH = $( '#wpadminbar' ).outerHeight();
		_avaiHeight -= _adminBarH;
		_offsetTop += _adminBarH;
	}

	_avaiHeight -= _headerH;
	_offsetTop -= 1;

	var $_leftSectionFixed = $( '#header-left-fixed' );
	var $_rightSectionFixed = $( '#header-right-fixed' );

	if ( $_leftSectionFixed.length > 0 ) {
		$_leftSectionFixed.css( {
			top: _offsetTop + 'px',
			height: _avaiHeight + 'px'
		} );

		var $_leftInner = $_leftSectionFixed.children( '.inner' );

		if ( $_leftInner.data( 'slim-scroll' ) == '1' ) {
			$_leftInner.slimScroll( {
				height: _avaiHeight + 'px',
				size: '5px',
				borderRadius: 0,
				distance: 0
			} );
		}
	}

	if ( $_rightSectionFixed.length > 0 ) {
		$_rightSectionFixed.css( {
			top: _offsetTop + 'px',
			height: _avaiHeight + 'px'
		} );

		var $_rightInner = $_rightSectionFixed.children( '.inner' );

		if ( $_rightInner.data( 'slim-scroll' ) == '1' ) {
			$_rightInner.slimScroll( {
				height: _avaiHeight + 'px',
				size: '5px',
				borderRadius: 0,
				distance: 0
			} );
		}
	}

	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$html.css( {
			marginLeft: 0
		} );

		$html.css( {
			marginRight: 0
		} );
	} else {
		if ( $_leftSectionFixed.length > 0 ) {
			var _leftSectionWidth = $_leftSectionFixed.outerWidth();
			$html.css( {
				marginLeft: _leftSectionWidth + 'px'
			} );
		}

		if ( $_rightSectionFixed.length > 0 ) {
			var _rightSectionWidth = $_rightSectionFixed.outerWidth();
			$html.css( {
				marginRight: _rightSectionWidth + 'px'
			} );
		}

		var rows          = $pageWrapper.find( '.vc_row' ),
		    $contentWidth = $pageWrapper.width();

		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;
				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}
				var width = $contentWidth + 'px';
				$( this ).css( {
					left: left,
					width: width
				} );
				if ( $( this ).attr( 'data-vc-stretch-content' ) ) {

				} else {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );

		if ( typeof revapi6 !== 'undefined' ) {
			revapi6.revredraw();
		}
	}
}

function boxedFixVcRow() {
	if ( $body.hasClass( 'boxed' ) ) {
		var contentWidth = $( '#page' ).outerWidth();
		$( '#page-content' ).find( '.vc_row' ).each( function() {
			if ( $( this ).data( 'vc-stretch-content' ) == true && $( this )
				.data( 'vc-stretch-content' ) == true ) {
				$( this ).css( {
					left: 0,
					width: contentWidth + 'px'
				} );
			}
		} );
	}
}

function singlePortfolioFullscreen() {
	if ( ! $body.hasClass( 'single-portfolio-style-fullscreen' ) ) {
		return;
	}

	var _scrollH = window.innerHeight;

	if ( $body.hasClass( 'admin-bar' ) ) {
		var _adminBarH = $( '#wpadminbar' ).outerHeight();
		_scrollH -= _adminBarH;
	}

	$( '#portfolio-main-info-wrap' ).slimScroll( {
		height: _scrollH + 'px',
		size: '5px',
		borderRadius: 0,
		distance: 0
	} );
}

function handlerPageNotFound() {
	if ( ! $body.hasClass( 'error404' ) ) {
		return;
	}

	var page = $( '#page' ).children( '.content-wrapper' );
	var height = $( window ).height();
	page.css( {
		'min-height': height
	} );
	$( window ).resize( function() {
		height = $( window ).height();
		page.css( {
			'min-height': height
		} );
	} );
}

function handlerTestimonials() {
	$( '.tm-testimonial' ).each( function() {
		var $slider = $( this );

		if ( ! $slider.hasClass( 'style-1' ) ) {
			return;
		}

		var $sliderContainer = $slider.children( '.swiper-container' ).first();
		var lgItems = $slider.data( 'lg-items' ) ? $slider.data( 'lg-items' ) : 1;
		var mdItems = $slider.data( 'md-items' ) ? $slider.data( 'md-items' ) : lgItems;
		var smItems = $slider.data( 'sm-items' ) ? $slider.data( 'sm-items' ) : mdItems;
		var xsItems = $slider.data( 'xs-items' ) ? $slider.data( 'xs-items' ) : smItems;

		var lgGutter = $slider.data( 'lg-gutter' ) ? $slider.data( 'lg-gutter' ) : 0;
		var mdGutter = $slider.data( 'md-gutter' ) ? $slider.data( 'md-gutter' ) : lgGutter;
		var smGutter = $slider.data( 'sm-gutter' ) ? $slider.data( 'sm-gutter' ) : mdGutter;
		var xsGutter = $slider.data( 'xs-gutter' ) ? $slider.data( 'xs-gutter' ) : smGutter;

		var autoPlay = $slider.data( 'autoplay' );
		var speed = $slider.data( 'speed' ) ? $slider.data( 'speed' ) : 1000;
		var nav = $slider.data( 'nav' );
		var pagination = $slider.data( 'pagination' );

		var options = {
			loop: true,
			slidesPerView: lgItems,
			spaceBetween: lgGutter,
			breakpoints: {
				// when window width is <=
				767: {
					slidesPerView: xsItems,
					spaceBetween: xsGutter
				},
				990: {
					slidesPerView: smItems,
					spaceBetween: smGutter
				},
				1199: {
					slidesPerView: mdItems,
					spaceBetween: mdGutter
				}
			}
		};

		if ( speed ) {
			options.speed = speed;
		}

		if ( autoPlay ) {
			options.autoplay = {
				delay: autoPlay,
				disableOnInteraction: false
			};
		}

		if ( nav ) {
			var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
			var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

			$slider.append( $swiperPrev ).append( $swiperNext );

			options.navigation = {
				nextEl: $swiperNext,
				prevEl: $swiperPrev,
			};
		}

		if ( pagination ) {
			var $swiperPagination = $( '<div class="swiper-pagination"></div>' );
			$slider.addClass( 'has-pagination' );

			$slider.append( $swiperPagination );

			options.pagination = {
				el: $swiperPagination,
				clickable: true,
			};
		}

		var $swiper = new Swiper( $sliderContainer, options );

		var $testimonial_thumbs_container = $slider.children( '.tm-testimonial-pagination' )
		                                           .children( '.swiper-container' )
		                                           .first();

		var $swiperThumbs = new Swiper( $testimonial_thumbs_container, {
			slidesPerView: 3,
			spaceBetween: 30,
			centeredSlides: true,
			loop: true
		} );

		$swiper.on( 'slideChange', function() {
			var $_slides = $testimonial_thumbs_container.children( '.swiper-wrapper' )
			                                            .children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( $( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( $( this ).data( 'swiper-slide-index' ) === $swiper.realIndex ) {
					$swiperThumbs.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'slideChange', function() {
			var $_slides = $sliderContainer.children( '.swiper-wrapper' ).children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( $( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( $( this ).data( 'swiper-slide-index' ) === $swiperThumbs.realIndex ) {
					$swiper.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'click', function() {
			$swiperThumbs.slideTo( $swiperThumbs.clickedIndex );
		} );
	} );
}
