// Woocommerce wishlist.
$( '.add_to_wishlist' ).on( 'click', function() {
	$( this ).addClass( 'loading' );
} );

$( document ).on( 'insightGridBeforeInit', function( e, $wrapper ) {
	if ( ! $wrapper.hasClass( 'tm-product' ) ) {
		return false;
	}

	var $queryInput = $wrapper.find( '.tm-grid-query' )
	                          .first();
	$wrapper.find( '.price_slider' )
	        .on( 'slidechange', function( event, ui ) {

		        var query = jQuery.parseJSON( $queryInput.val() );
		        query.minPrice = ui.values[ 0 ];
		        query.maxPrice = ui.values[ 1 ];

		        $queryInput.val( JSON.stringify( query ) );

		        $( document )
			        .trigger( 'insightGridInfinityLoad', $wrapper );
	        } );

	$wrapper.find( '.tm-grid-ajax-field' ).on( 'change', function() {
		var query = jQuery.parseJSON( $queryInput.val() );
		var _val = $( this )
			.val();
		if ( $( this ).hasClass( 'product-sorting' ) ) {
			var _order = _val.split( ':' );

			switch ( _order[ 0 ] ) {
				case 'popularity' :
					query.meta_key = 'total_sales';
					query.orderby = 'meta_value_num';
					query.order = 'desc';
					break;
				case 'rating' :
					query.meta_key = '_wc_average_rating';
					query.orderby = 'meta_value_num';
					query.order = 'desc';
					break;
				case 'price' :
					query.meta_key = '_price';
					query.orderby = 'meta_value_num';
					query.order = _order[ 1 ];
					break;
				case 'date' :
					query.meta_key = '';
					query.orderby = 'date';
					query.order = _order[ 1 ];
					break;
			}
		}

		$queryInput.val( JSON.stringify( query ) );

		$( document ).trigger( 'insightGridInfinityLoad', $wrapper );
	} );
} );

$( document ).on( 'insightGridInit', function( e, $wrapper, $grid ) {
	if ( $wrapper.hasClass( 'equal-thumbnail-height' ) ) {
		$grid.find( '.product-thumbnail' ).matchHeight();
	}
} );

$( document ).on( 'insightSwiperInit', function( e, $swiper, $wrapper ) {
	if ( $wrapper.hasClass( 'equal-thumbnail-height' ) ) {
		$wrapper.find( '.product-thumbnail' ).matchHeight();
	}
} );

$( document ).on( 'insightGridUpdate', function( e, $wrapper, $grid, $newItems ) {
	if ( $wrapper.hasClass( 'tm-product' ) && $wrapper.hasClass( 'style-grid' ) ) {
		$newItems.find( '.product-thumbnail' ).matchHeight();

		if ( typeof isw.Swatches !== 'undefined' ) {
			isw.Swatches.init();
		}
	}
} );

initMiniCart();
handlerWooCompare();
initQuickViewPopup();
initQuantityButtons();
shopLayoutSwitcher();
initCookieNotice();

$( window ).on( 'load', function( e ) {
	changeProductSlideWhenChangeAttribute();
} );

function initCookieNotice() {
	if ( $insight.noticeCookieEnable == 1 && $insight.noticeCookieConfirm === 'no' && $insight.noticeCookieMessages != '' ) {

		$.growl( {
			location: 'br',
			fixed: true,
			duration: 3600000,
			title: '',
			message: $insight.noticeCookieMessages
		} );

		$( '#tm-button-cookie-notice-ok' ).on( 'click', function() {
			$( this ).parents( '.growl-message' ).first().siblings( '.growl-close' ).trigger( 'click' );

			var _data = {
				action: 'notice_cookie_confirm'
			};

			_data = $.param( _data );

			$.ajax( {
				url: $insight.ajaxurl,
				type: 'POST',
				data: _data,
				dataType: 'json',
				success: function( results ) {

					$.growl.notice( {
						location: 'br',
						duration: 5000,
						title: '',
						message: $insight.noticeCookieOKMessages
					} );

				},
				error: function( errorThrown ) {
					alert( errorThrown );
				}
			} );
		} );
	}
}

function shopLayoutSwitcher() {
	$( '.switcher-item' ).on( 'click', function() {

		if ( $( this ).hasClass( 'active' ) ) {
			return;
		}

		var _data = {
			action: 'shop_layout_change'
		};

		if ( $( this ).hasClass( 'list' ) ) {
			_data.shop_layout = 'list';
		} else {
			_data.shop_layout = 'grid';
		}

		_data = $.param( _data );

		$.ajax( {
			url: $insight.ajaxurl,
			type: 'POST',
			data: _data,
			dataType: 'json',
			success: function( results ) {
				location.reload();
			},
			error: function( errorThrown ) {
				alert( errorThrown );
			}
		} );
	} );
}

function initMiniCart() {
	var $miniCart = $( '#mini-cart' );
	$miniCart.on( 'click', function() {
		if ( ! SmartPhone.isAny() ) {
			$( this ).addClass( 'open' );
		} else {
			window.location.href = $( this ).data( 'url' );
		}
	} );

	$( document ).on( 'click', function( e ) {
		if ( $( e.target ).closest( $miniCart ).length == 0 ) {
			$miniCart.removeClass( 'open' );
		}
	} );
}

function handlerWooCompare() {
	// Woocommerce compare.
	$body.on( 'click', '.yith-compare-btn .compare', function() {
		$( this ).addClass( 'loading' );
	} );

	$body.on( 'yith_woocompare_open_popup', function() {
		$( '.yith-compare-btn .compare' ).removeClass( 'loading' );
		$body.addClass( 'compare-popup-opened' );
	} );

	$body.on( 'click', '#cboxClose, #cboxOverlay', function() {
		$body.removeClass( 'compare-popup-opened' );
	} );
}

function changeProductSlideWhenChangeAttribute() {
	if ( ! $body.hasClass( 'single-product' ) ) {
		return false;
	}

	var $form = $( '.isw-swatches--in-single' );
	var variations = $form.data( 'product_variations' );
	var $slider = $( '.woo-single-images .tm-swiper' );
	var swiper = $slider.children( '.swiper-container' )[ 0 ].swiper;

	$form.find( 'select' ).on( 'change', function() {
		var test = true;
		var globalAttrs = {};

		var formValues = $form.serializeArray();
		for ( var i = 0; i < formValues.length; i ++ ) {

			var _name = formValues[ i ].name;
			if ( _name.substring( 0, 10 ) === 'attribute_' ) {

				globalAttrs[ _name ] = formValues[ i ].value;

				if ( formValues[ i ].value === '' ) {
					test = false;

					break;
				}
			}
		}

		// When all variations selected.
		if ( test === true ) {
			var url = '';

			for ( var i = 0; i < variations.length; i ++ ) {
				var currentAttrs = variations[ i ].attributes;

				var valid = true;
				var pass = true;

				for ( var globalKey in globalAttrs ) {
					for ( var currentKey in currentAttrs ) {
						var globalVal = globalAttrs[ globalKey ];
						var currentVal = currentAttrs[ currentKey ];

						if ( currentKey === globalKey ) {
							if ( currentVal === '' ) {
								pass = false;
								continue;
							}

							if ( currentVal !== globalVal ) {
								valid = false;
							}
						}
					}
				}

				if ( valid === true ) {
					url = variations[ i ].image.url;
				}

				if ( valid === true && pass === true ) {
					break;
				}
			}

			if ( url !== '' ) {
				$slider.find( 'a' ).each( function() {
					var _fullImage = $( this ).attr( 'href' );

					if ( _fullImage == url ) {
						var _slide = $( this )
							.parents( '.swiper-slide' )
							.first();

						var _index = _slide.index();


						swiper.slideTo( _index );

						return true;
					}
				} );
			}
		} else {
			// Reset to main image.
			var $mainImage = $slider.find( '.woocommerce-main-image' );
			var index = $mainImage.parents( '.swiper-slide' ).first().index();
			swiper.slideTo( index );
		}
	} );
}

function initQuickViewPopup() {


	$( '.quickview-btn' ).each( function() {
		var $popup = $( this ).siblings( '.woo-quick-view-popup' )

		$( this ).magnificPopup( {
			items: {
				src: $popup.html(),
				type: 'inline',
			},
			callbacks: {
				open: function() {
					if ( typeof isw != 'undefined' && typeof isw.Swatches !== 'undefined' ) {
						isw.Swatches.init();
					}

					$( '.woo-quick-view-popup-content .tm-swiper' ).insightSwiper();

					$( '.woo-quick-view-popup-content .entry-summary' ).slimScroll( {
						height: 600 + 'px',
						size: '5px',
						borderRadius: 0,
						distance: 0
					} );
				},
			}
		} );
	} );
}

function initQuantityButtons() {
	$( document ).on( 'click', '.increase, .decrease', function() {

		// Get values
		var $qty       = $( this ).siblings( '.qty' ),
		    currentVal = parseFloat( $qty.val() ),
		    max        = parseFloat( $qty.attr( 'max' ) ),
		    min        = parseFloat( $qty.attr( 'min' ) ),
		    step       = $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
			currentVal = 0;
		}
		if ( max === '' || max === 'NaN' ) {
			max = '';
		}
		if ( min === '' || min === 'NaN' ) {
			min = 0;
		}
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
			step = 1;
		}

		// Change the value
		if ( $( this ).is( '.increase' ) ) {

			if ( max && (
				max == currentVal || currentVal > max
			) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && (
				min == currentVal || currentVal < min
			) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event.
		$qty.trigger( 'change' );
	} );
}
