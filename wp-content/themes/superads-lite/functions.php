<?php
/**
 * SuperAds functions and definitions
 *
 * @package SuperAds
 */
/* Pro URL */
define('SUPERADS_LITE_PRO_URL', 'https://themecountry.com/themes/superads/');


/** 
|------------------------------------------------------------------------------
| Set the content width based on the theme's design and stylesheet.
|------------------------------------------------------------------------------
*/
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'superads_lite_setup' ) ) :
/** 
|------------------------------------------------------------------------------
| Sets up theme defaults and registers support for various WordPress features.
|------------------------------------------------------------------------------
|
| Note that this function is hooked into the after_setup_theme hook, which
| runs before the init hook. The init hook is too late for some features, such
| as indicating support for post thumbnails.
|
*/


function superads_lite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on SuperAds, use a find and replace
	 * to change 'superads-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'superads-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	 add_theme_support( 'post-thumbnails' );
	 set_post_thumbnail_size( 200 );
	 add_image_size( 'superads-lite-post-thumbnails-grid', 200 , 241, false );
	 add_image_size( 'superads-lite-homepage-thumb-slider', 640 , 250, true );
	 add_image_size( 'superads-lite-widget-thumbnail', 100, 80, true ); //widget

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu', 'superads-lite' ),
		'top'	=> __( 'Top Menu', 'superads-lite' ),
		'footer' => __('Footer Menu', 'superads-lite')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// This theme styles the visual editor to resemble the theme style.
	$google_font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:700,400' );
	add_editor_style( array( 'css/editor-style.css', $google_font_url ) );

}
endif; // superads_lite_setup
add_action( 'after_setup_theme', 'superads_lite_setup' );

function superads_lite_reset_theme_options() { 
    remove_theme_mods();
}
add_action( 'after_switch_theme', 'superads_lite_reset_theme_options' );


/** 
|------------------------------------------------------------------------------
| Register widget area.
|------------------------------------------------------------------------------
|
| @link https://codex.wordpress.org/Function_Reference/register_sidebar
|
*/

function superads_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'superads-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'superads_lite_widgets_init' );

/**
|------------------------------------------------------------------------------
| Enqueue scripts and styles.
|------------------------------------------------------------------------------
*/

function superads_lite_scripts() {
	/**
	* Engueue Style
	*/
	
	wp_enqueue_style( 'superads-google-font-style', '//fonts.googleapis.com/css?family=Open+Sans:normal|Open+Sans:700');
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() .  '/css/font-awesome.min.css');
	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() .  '/css/flexslider.css');
	wp_enqueue_style( 'superads-style', get_stylesheet_uri() );
	wp_enqueue_style( 'superads-responsive-style', get_template_directory_uri() .  '/css/responsive.css');
	
	/**
	* Engueue Script
	*/
	wp_enqueue_script( 'superads-html5shiv', get_template_directory_uri() . '/js/html5.js', array(), '3.7.0', false );
	wp_script_add_data( 'superads-html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'superads-jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '20150423', true );
	wp_enqueue_script( 'superads-script', get_template_directory_uri() . '/js/script.js', array('jquery', 'superads-jquery-flexslider'), '20150423', true );
	wp_localize_script( 'superads-script', 'SuperAdsAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'superads-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'superads_lite_scripts' );

/**
|------------------------------------------------------------------------------
| Enqueue Admin scripts and styles.
|------------------------------------------------------------------------------
*/

function superads_lite_admin_scripts() {
        wp_enqueue_style( 'superads-admin-css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_script( 'superads-admin-script', get_template_directory_uri() . '/js/admin-script.js', array('jquery'), '20150226', true );

}
add_action( 'admin_enqueue_scripts', 'superads_lite_admin_scripts' );

/**
|------------------------------------------------------------------------------
| Truncate string to x letters/words
|------------------------------------------------------------------------------
*/

function superads_lite_tc_truncate( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
    if ( $units == 'letters' ) {
        if ( mb_strlen( $str ) > $length ) {
            return mb_substr( $str, 0, $length ) . $ellipsis;
        } else {
            return $str;
        }
    } else {
        $words = explode( ' ', $str );
        if ( count( $words ) > $length ) {
            return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
        } else {
            return $str;
        }
    }
}

if ( ! function_exists( 'superads_lite_tc_excerpt' ) ) {
    function superads_lite_tc_excerpt( $limit = 40 ) {
      return superads_lite_tc_truncate( get_the_excerpt(), $limit, 'words' );
    }
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* Ads Functions
*/
require get_template_directory() . '/inc/ads-managment.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/** 
|------------------------------------------------------------------------------
|  Remove comment box
|
*/
function superads_lite_comments_form_defaults($default) {
        $default['comment_notes_after'] = '';
        return $default;
}

add_filter('comment_form_defaults','superads_lite_comments_form_defaults');

/**
* Custom Style 
*/
load_template( get_template_directory() . '/inc/custom-style.php' );
