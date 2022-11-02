jQuery( document ).ready( function ( $ ) {
    'use strict';

    $( '.tm-svg' ).each( function () {
        var _settings = $( this ).data(),
            _type     = _settings.type ? _settings.type : 'oneByOne',
            _duration = _settings.duration ? _settings.duration : 150,
            _options  = {
                type: _type,
                duration: _duration,
                file: _settings.svg
            };

        var _vivus = new Vivus( $( this )[0], _options );

        if ( _settings.hover ) {
            $( _settings.hover ).hover( function () {
                _vivus.stop()
                      .reset()
                      .play( 2 );
            }, function () {
                _vivus.finish();
            } );
        }
    } );
} );
