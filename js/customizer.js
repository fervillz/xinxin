/**
 * Theme Customizer enhancements for a better user experiences.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// meta date
	var icondateFont
	wp.customize( 'xx_date_icon', function( value ) {
		value.bind( function( to ) {
			
			switch( to.toString().toLowerCase() ) {
 
            case 'fa-calendar':
                icondateFont = 'fa-calendar';
                break;
 
			case 'fa-calendar-check-o':
				icondateFont = 'fa-calendar-check-o';
				break;

			case 'fa-calendar-minus-o':
				icondateFont = 'fa-calendar-minus-o';
				break;

			case 'fa-calendar-o':
				icondateFont = 'fa-calendar-o';
				break;

			case 'fa-calendar-plus-o':
				icondateFont = 'fa-calendar-plus-o';
				break;

			case 'fa-calendar-times-o':
				icondateFont = 'fa-calendar-times-o';
				break;

			case 'fa-clock-o':
				icondateFont = 'fa-clock-o';
				break;
 
            default:
                icondateFont = 'fa-calendar';
                break;
 
        }

        $( 'span.posted-on i' ).attr('class','fa '+icondateFont);
				
		} );
	} );

	// meta date
	var iconauthorFont
	wp.customize( 'xx_author_icon', function( value ) {
		value.bind( function( to ) {
			
			switch( to.toString().toLowerCase() ) {
 
            case 'fa-user':
                iconauthorFont = 'fa-user';
                break;
 
			case 'fa-pencil':
				iconauthorFont = 'fa-pencil';
				break;

			case 'fa-pencil-square':
				iconauthorFont = 'fa-pencil-square';
				break;

			case 'fa-pencil-square-o':
				iconauthorFont = 'fa-pencil-square-o';
				break;

            default:
                iconauthorFont = 'fa-user';
                break;
 
        }

        $( 'span.byline i' ).attr('class','fa '+iconauthorFont);
				
		} );
	} );

	//Typography
	var sFont
	wp.customize( 'font_family', function( value ) {
    value.bind( function( to ) {
 
        switch( to.toString().toLowerCase() ) {
 
            case 'times':
                sFont = 'Times New Roman';
                break;
 
            case 'arial':
                sFont = 'Arial';
                break;
 
            case 'courier':
                sFont = 'Courier New, Courier';
                break;
 
            case 'helvetica':
                sFont = 'Helvetica';
                break;
 
            default:
                sFont = 'Times New Roman';
                break;
 
        }
 
        $( 'body' ).css({
            fontFamily: sFont
	        });
	 
	    });
	 
	});

} )( jQuery );
