<?php
/**
 * Superads Theme Customizer
 *
 * @package Superads
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function superads_lite_customize_register( $wp_customize ) {
	require get_template_directory(). '/inc/customizer/custom-controls/load-customiz.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Remove Default Section
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image');

	/**
	|------------------------------------------------------------------------------
	| GENERAL OPTIONS
	|------------------------------------------------------------------------------
	*/
	if ( class_exists( 'WP_Customize_Panel' ) ):

		/* LOGO	*/
		$wp_customize->add_setting( 'superads_lite_logo', array('sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
				'label'    => __( 'Site Logo', 'superads-lite' ),
				'section'  => 'title_tagline',
				'settings' => 'superads_lite_logo',
				'priority'    => 1,
		)));


		/**
		|-------------------------------------------------------------------------------
		| Panel: General Options
		|-------------------------------------------------------------------------------
		|
		*/

		require_once get_template_directory() . '/inc/customizer/general-options.php';


		/**
		|-------------------------------------------------------------------------------
		| Panel: Slideshow Options
		|-------------------------------------------------------------------------------
		|
		*/

		require_once get_template_directory() . '/inc/customizer/slide-options.php';


		/**
		|-------------------------------------------------------------------------------
		| Panel: Style Options
		|-------------------------------------------------------------------------------
		|
		*/
		require_once get_template_directory() . '/inc/customizer/style-color-options.php';

		/**
		|-------------------------------------------------------------------------------
		| Panel: Single Options
		|-------------------------------------------------------------------------------
		|
		*/
		require_once get_template_directory() . '/inc/customizer/single-options.php';

		/**
		|-------------------------------------------------------------------------------
		| Panel: Ads Managment Options
		|-------------------------------------------------------------------------------
		|
		*/
		require_once get_template_directory() . '/inc/customizer/ads-options.php';


	endif;
}
add_action( 'customize_register', 'superads_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function superads_lite_customize_preview_js() {
	wp_enqueue_script( 'superads_lite_customizer_script', get_template_directory_uri() . '/js/customizer.js', array( 'jquery'), '20151108', true );

	wp_localize_script( 'superads_lite_customizer_script', 'superadsCustomizerObject', array(
		
		'documentation' => __( 'View Documentation', 'superads-lite' ),
		'pro' 			=> __('Upgrade to PRO','superads-lite'),
		'proUrl'		=> superads_lite_PRO_URL,

	) );
}

//add_action( 'customize_preview_init', 'superads_lite_customize_preview_js' );
add_action( 'customize_controls_enqueue_scripts', 'superads_lite_customize_preview_js' );

/**
|------------------------------------------------------------------------------
| Callback Functions
|------------------------------------------------------------------------------
*/
function superads_lite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function superads_lite_sanitize_textarea($input) {
	return esc_textarea($input);
}

/**
 * Sanitize checkbox values
 * @since 1.0.0
 */
function superads_lite_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

/* Pro Version Sanitize */
function superads_lite_sanitize_pro_version( $input ) {
    return $input;
}