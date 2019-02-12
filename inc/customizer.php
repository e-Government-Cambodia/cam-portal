<?php
/**
 * Cambodia Portal Theme Customizer
 *
 * @package Cambodia_Portal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cam_portal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.lg-title h1',
			'render_callback' => 'cam_portal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.lg-title span',
			'render_callback' => 'cam_portal_customize_partial_blogdescription',
		) );
	}

/************************ Removing Default option **************************/
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('custom_css');

/****************************** Theme Options ******************************/
	$wp_customize->add_section( 'custom_theme_option', array(
		'title' => __( 'Theme Options', 'cam-portal' ),
		'priority' => 30,
	) );
	$wp_customize->add_setting( 'theme_color_setting', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'theme_options',
		'default' => '#4bc598',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'color_control', 
		array(
			'label'      => __( 'Theme Color', 'cam-portal' ),
			'section'    => 'custom_theme_option',
			'settings'   => 'theme_color_setting',
		) ) 
	);
	$wp_customize->add_section( 'homepage', array(
		'title' => esc_html_x( 'Homepage Options', 'customizer section title', 'olsen-light-child' ),
	) );

	$wp_customize->add_setting( 'home_slider_category', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new My_Dropdown_Category_Control( $wp_customize, 'home_slider_category', array(
		'section'       => 'homepage',
		'label'         => esc_html__( 'Slider posts category', 'olsen-light-child' ),
		'description'   => esc_html__( 'Select the category that the slider will show posts from. If no category is selected, the slider will be disabled.', 'olsen-light-child' ),
	) ) );
/**************************** Theme Header Text ****************************/
	$wp_customize->add_setting( 'header_text', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'theme_options',
		'default' => 'ព្រះរាជាណាចក្រកម្ពុជា <br/> ជាតិ សាសនា ព្រះមហាក្សត្រ',
		'transport' => 'postMessage', // or postMessage
		'sanitize_callback' => 'sanitize_textarea_header_text',
	  ) );
	$wp_customize->add_control( 'header_text', array(
		'label'      => 'Theme Header Text: ',
		'section'    => 'header_image',
		'type'       => 'textarea',
	 ) );
}
add_action( 'customize_register', 'cam_portal_customize_register' );

function sanitize_textarea_header_text( $input ){
	$allowed = array('br' => array());
	return wp_kses($input, $allowed);
}


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cam_portal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cam_portal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cam_portal_customize_preview_js() {
	wp_enqueue_script( 'cam-portal-customizer', get_template_directory_uri() . '/asset/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cam_portal_customize_preview_js' );
if ( function_exists( 'pll_register_string' ) ) :
	/**
	* Register some string from the customizer to be translated with Polylang
	*/
	function cam_portal_pll_register_string() {
		pll_register_string( 'header_text', get_theme_mod( 'header_text' ), 'cam-portal', true );
	}
	add_action( 'after_setup_theme', 'cam_portal_pll_register_string' );
endif;