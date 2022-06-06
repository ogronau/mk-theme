<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );



function add_google_fonts() {
	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&amp;family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&amp;family=Roboto:wght@400;700;900&amp;display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );



function register_my_menus() {
	unregister_nav_menu('primary');
	register_nav_menu('footer', __( 'Footer' ));
	register_nav_menu('kontext', __( 'Kontext' ));
	register_nav_menu('kinderhaus', __( 'Kinderhaus' ));
	register_nav_menu('kinderdorf', __( 'Kinderdorf' ));
}
add_action( 'init', 'register_my_menus' );



function set_montessori_context() {
	$montessoriContextCookie = isset($_COOKIE['wp-montessori-context']) ? $_COOKIE['wp-montessori-context'] : null;

	$ancestors = get_post_ancestors($post->ID);
	if (count($ancestors) === 0) {
	    $montessoriRootId = $post->ID;
	} else {
	    $montessoriRootId = $ancestors[count($ancestors)-1];
	}
	$montessoriContext = get_post_field('post_name', $montessoriRootId);

	if (in_array($montessoriContext, ['kinderhaus', 'kinderdorf']) && ($montessoriContext != $montessoriContextCookie)) {
		setcookie('wp-montessori-context', $montessoriContext, time() + 31556926, '/');
		set_query_var( 'montessoriContext', $montessoriContext );
	} else if (in_array($montessoriContextCookie, ['kinderhaus', 'kinderdorf'])) {
		set_query_var( 'montessoriContext', $montessoriContextCookie );
	} else {
		set_query_var( 'montessoriContext', null );
	}
}
add_action( 'template_redirect', 'set_montessori_context' );
