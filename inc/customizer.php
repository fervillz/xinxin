<?php
/**
 * xinxin Theme Customizer.
 *
 * @package xinxin
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function xinxin_customize_register( $wp_customize ) {

    //Customizer guide
    xinxin_guide( $wp_customize );

    //call builtin customizer settings
    xinxin_builtin( $wp_customize );

    //site logo
    xinxin_logo( $wp_customize );

    /* more link */
   xinxin_readmore( $wp_customize );

    //Entry meta
    xinxin_customize_entry_meta( $wp_customize );
    xinxin_test1( $wp_customize );

    //Typo
    section_typo ($wp_customize );

}
add_action( 'customize_register', THEME_DOMAIN.'_customize_register' );

/**



**/

function xinxin_guide( $wp_customize ) {

     $wp_customize->add_section(
    'xx_help',
    array(
        'title' => esc_attr('Help', THEME_DOMAIN),
        'description' => esc_attr('A guide for beginners', THEME_DOMAIN ),
        'priority' => 1,
    )
    );

    $wp_customize->add_setting(
        'xx_guide',
        array(
            'default' => true,
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'xx_guide',
        array(
            'type' => 'checkbox',
            'label' => esc_attr('Guide', THEME_DOMAIN ),
            'description' => 'Check to see which part of the site you are editing',
            'section' => 'xx_help',
        )
    );

}

function xinxin_builtin( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}

function xinxin_logo( $wp_customize ) {

    $wp_customize->add_section( THEME_DOMAIN.'_logo_section' , array(
    'title'       => esc_attr( 'Logo', THEME_DOMAIN ),
    'priority'    => 30,
    'description' => esc_attr('Upload a logo to replace the default site name and description in the more', THEME_DOMAIN ),
    ) );

    $wp_customize->add_setting( THEME_DOMAIN.'_logo',
        array(
            'transport' => 'postMessage'
        )

    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, THEME_DOMAIN.'_logo', array(
        'label'    => esc_attr( 'Logo', THEME_DOMAIN ),
        'section'  => THEME_DOMAIN.'_logo_section',
        'settings' => THEME_DOMAIN.'_logo',
    ) ) );
}

function xinxin_readmore( $wp_customize ) {
     $wp_customize->add_section(
    'more_options',
    array(
        'title' => esc_attr('More Link Options', THEME_DOMAIN),
        'description' => esc_attr('Customize your read more link', THEME_DOMAIN ),
        'priority' => 1,
    )
    );

    $wp_customize->add_setting(
        'xx_excerpt_type',
        array(
            'default' => 'option2',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
        )
    );

    $wp_customize->add_control(
        'xx_excerpt_type',
        array(
            'type' => 'select',
            'label' => esc_attr('Excerpt type', THEME_DOMAIN ),
            'section' => 'more_options',
            'choices' => array(
                'option1' => 'More Tag',
                'option2' => 'Excerpt',
            ),
        )
    );

    //more type
    $wp_customize->add_setting(
        'xx_more_type',
        array(
            'default' => 'option1',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
        )
    );

    $wp_customize->add_control(
        'xx_more_type',
        array(
            'type' => 'select',
            'label' => esc_attr('Read More Type', THEME_DOMAIN ),
            'section' => 'more_options',
            'choices' => array(
                'option1' => 'None',
                'option2' => 'Text',
                'option3' => 'Text + Button',
            ),
        )
    );

    //more type - text
    $wp_customize->add_setting(
        'xx_more_text',
        array(
            'sanitize_callback' => 'esc_attr',
            'default' => 'Read More &raquo;',
        )
    );

    $wp_customize->add_control(
        'xx_more_text',
        array(
            'label' => esc_attr('Read More Text', THEME_DOMAIN ),
            'section' => 'more_options',
        )
    );


    //more position
    $wp_customize->add_setting(
        'xx_more_position',
        array(
            'default' => 'option1',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',

        )
    );

    $wp_customize->add_control(
        'xx_more_position',
        array(
            'type' => 'select',
            'label' => esc_attr('Read More Position', THEME_DOMAIN ),
            'description' => esc_attr('Only works if read more type is button', THEME_DOMAIN ),
            'section' => 'more_options',
            'choices' => array(
                'left' => 'Left',
                'right' => 'Right',
            ),
        )
    );


    //more type - text + button
    $wp_customize->add_setting(
        'xx_more_button',
        array(
            'default' => 'option1',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
        )
    );

    $wp_customize->add_control(
        'xx_more_button',
        array(
            'type' => 'select',
            'label' => esc_attr('Read More Button Style', THEME_DOMAIN ),
            'section' => 'more_options',
            'choices' => array(
                'option1' => 'Sharp Edges',
                'option2' => 'Rounded Corners',
            ),
        )
    );

    //background color
    $wp_customize->add_setting(
        'xx_button_bg',
        array(
            'default' => '#c7c7c7',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );


    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'xx_button_bg',
        array(
            'label' => esc_attr( 'Button Background Color', THEME_DOMAIN ),
            'section' => 'more_options',
    ) ) );


    //text color
    $wp_customize->add_setting(
        'xx_text_color',
        array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );


    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'xx_text_color',
        array(
            'label' => esc_attr( 'Button Text Color', THEME_DOMAIN ),
            'section' => 'more_options',
    ) ) );

}


/**



**/

function xinxin_test1( $wp_customize ) {
        $wp_customize->add_section('section_template_archive' , array(
        'title'             => __('Archive Pages', THEME_DOMAIN),
        'priority'          => 60
    ));

    /**
     * Link tile size (overrides General setting)
     */

    $wp_customize->add_setting('archive_link_tile_size', array(
        'default'   => 'default',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control('archive_link_tile_size', array(
        'label'         => __('Link tile size', THEME_DOMAIN),
        'section'       => 'section_template_archive',
        'type'          => 'checkbox',
        'description'   => __('The size of link tile that you wish to dsipay on archive pages.', THEME_DOMAIN),
    ));

    /**
     * Show 'More...' link
     */

    $wp_customize->add_setting('archive_show_more_link', array(
        'default'   => false,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control('archive_show_more_link', array(
        'label'             => __('Show link to Link/Post', THEME_DOMAIN),
        'section'           => 'section_template_archive',
        'type'              => 'checkbox',
        'description'       => __('Whether or not to show the \'More...\' link underneath a large link tile on archive pages.  Note that links cannot be displayed in conjunction with \'Small\' Link Tiles.', THEME_DOMAIN),
        'active_callback'   => '_check_is_link_tile_size_large'
    ));

}

function _check_is_link_tile_size_large($control){

    $control_id = $control->id;

    switch($control_id):

        case 'archive_show_more_link' :
            $validation_setting = 'archive_link_tile_size';
            break;

    endswitch;

    return ($control->manager->get_setting($validation_setting)->value() === 'large');

}


/**



**/

/**
 * Callback meta entry
 */
function xx_meta_callback(){

    if ( get_theme_mod( 'xx_entry_meta_type', false ) == true ) {
        return true;
    }
    else {
        return false;
    }

}


/**
 * Entry meta
 */
function xinxin_customize_entry_meta( $wp_customize ) {

    $wp_customize->add_section(
    'entry_meta_options',
    array(
        'title' => esc_attr('Entry Meta Options', THEME_DOMAIN),
        'description' => esc_attr('Customize your read more link', THEME_DOMAIN ),
        'priority' => 1,
    )
    );

    $wp_customize->add_setting(
        'xx_entry_meta_type',
        array(
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'xx_entry_meta_type',
        array(
            'type' => 'checkbox',
            'label' => esc_attr('Replace entry meta with icons', THEME_DOMAIN ),
            'description' => esc_attr('If Checked, default text will be replace with icons. Entry meta are the information below the post title (ie: admin ) for post author or (ie: 12/02/2016) for post date', THEME_DOMAIN ),
            'section' => 'entry_meta_options',
        )
    );

    /**

    * Date icon

    **/
    $wp_customize->add_setting(
        'xx_date_icon',
        array(
            'default' => 'fa-calendar',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'xx_date_icon',
        array(
            'type' => 'radio',
            'label' => esc_attr('Date/Time Icon', THEME_DOMAIN ),
            'description' => esc_attr('' ),
            'section' => 'entry_meta_options',
            'active_callback'   => 'xx_meta_callback',
            'choices' => array(
                'fa-calendar' => 'fa-calendar',
                'fa-calendar-check-o' => 'fa-calendar-check-o',
                'fa-calendar-minus-o' => 'fa-calendar-minus-o',
                'fa-calendar-o' => 'fa-calendar-o',
                'fa-calendar-plus-o' => 'fa-calendar-plus-o',
                'fa-calendar-times-o' => 'fa-calendar-times-o',
                'fa-clock-o' => 'fa-clock-o',
            ),
        )
    );

    /**

    * Author icon

    **/

    $wp_customize->add_setting(
        'xx_author_icon',
        array(
            'default' => 'fa-user',
            'sanitize_callback' => THEME_DOMAIN.'_sanitize_choices',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'xx_author_icon',
        array(
            'type' => 'radio',
            'label' => esc_attr('Author Icon', THEME_DOMAIN ),
            'description' => esc_attr('' ),
            'section' => 'entry_meta_options',
            'active_callback'   => 'xx_meta_callback',
            'choices' => array(
                'fa-user' => 'fa-user',
                'fa-pencil' => 'fa-pencil',
                'fa-pencil-square' => 'fa-pencil-square',
                'fa-pencil-square-o' => 'fa-pencil-square-o',
            ),
        )
    );

}

function section_typo($wp_customize){

    $wp_customize->add_section(
        'font_settings',
        array(
            'title' => esc_html__( 'Typography' ),
            'description' => 'Link your favorite social sites links. ',
            'priority' => 3,
    ) );

    $wp_customize->add_setting(
        'font_family',
        array(
            'default' => 'none',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'font_family',
            array(
                'type' => 'select',
                'label' => 'Theme Fonts',
                'section' => 'font_settings',
                'choices'  => array(
                    'times'     => 'Times New Roman',
                    'arial'     => 'Arial',
                    'courier'   => 'Courier New',
                    'helvetica'   => 'Helvetica',
                    'courier2'   => 'Courier New',
                    'courier3'   => 'Courier New',
                    'courier4'   => 'Courier New',
                    'courier5'   => 'Courier New',
                    'courier6'   => 'Courier New',
                    'courier7'   => 'Courier New',
                    'courier8'   => 'Courier New',
                    'courier9'   => 'Courier New',
                    'courier22'   => 'Courier New',
                    'courier0'   => 'Courier New',
            )
        )
    );
}

function xinxin_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

