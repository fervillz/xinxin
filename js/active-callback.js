/**
 * Theme Customizer enhancements for active callback
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    // Site title and description.
 wp.customize.bind( 'ready', function () {
    wp.customize.control( 'archive_show_more_link', function( control ) {
        var setting = wp.customize( 'archive_link_tile_size' );
        control.active.set( true === setting.get() );
        setting.bind( function( value ) {
            control.active.set( true === value );
        } );
    } );
} );

} )( jQuery );
