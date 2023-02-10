<?php
/**
 * Tutorial functions and definitions
 *
 * @package Tutorial
 */

define( 'TUTORIAL_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'TUTORIAL_DIR', get_template_directory() );
define( 'TUTORIAL_URL', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function tutorial_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tutorial, use a find and replace
	 * to change 'tutorial' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tutorial', TUTORIAL_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'tutorial_setup' );

/**
 * Enqueue scripts and styles.
 */
function tutorial_scripts() {
	wp_enqueue_style( 'tutorial-style', get_stylesheet_uri(), array(), TUTORIAL_VERSION );
	wp_enqueue_style( 'tutorial-theme-1', TUTORIAL_URL . '/assets/css/theme-1.css', array(), TUTORIAL_VERSION );

	wp_enqueue_script( 'fontawesome', TUTORIAL_URL . '/assets/fontawesome/js/all.min.js', array(), '6.1.1', true );
	wp_enqueue_script( 'popper', TUTORIAL_URL . '/assets/plugins/popper.min.js', array(), '2.11.5', true );
	wp_enqueue_script( 'bootstrap', TUTORIAL_URL . '/assets/plugins/bootstrap/js/bootstrap.min.js', array(), '5.2.0', true );
}
add_action( 'wp_enqueue_scripts', 'tutorial_scripts' );
