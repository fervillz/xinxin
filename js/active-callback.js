/**
 * Theme Customizer enhancements for active callback
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    // Site title and description.
 wp.customize.bind( 'ready', function () {
    wp.customize.control( 'xx_date_icon', function( control ) {
        var setting = wp.customize( 'xx_entry_meta_type' );
        control.active.set( true === setting.get() );
        setting.bind( function( value ) {
            control.active.set( true === value );
        } );
    } );

     wp.customize.control( 'xx_author_icon', function( control ) {
        var setting = wp.customize( 'xx_entry_meta_type' );
        control.active.set( true === setting.get() );
        setting.bind( function( value ) {
            control.active.set( true === value );
        } );
    } );
     
} );

} )( jQuery );
