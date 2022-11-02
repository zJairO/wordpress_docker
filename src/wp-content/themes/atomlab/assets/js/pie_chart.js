jQuery( function( $ ) {
	'use strict';

	$( '.tm-pie-chart' ).vcwaypoint( function() {
		// Fix for different ver of waypoints plugin.
		var self = this.element ? this.element : this;
		var $el = $( self );
		var countHtml = $el.find( '.piecharts-number' );

		$el.find( '.chart' ).circleProgress( {
			startAngle: - Math.PI / 4 * 2,
			animation: { duration: 1700 }
		} ).on( 'circle-animation-progress', function( event, progress ) {

			countHtml.html( parseInt(
				(
					countHtml.data( 'max' )
				) * progress
			) + '<span>' + countHtml.data( 'units' ) + '</span>' );
		} );

		this.destroy();
	}, {
		offset: '100%',
	} );
} );
