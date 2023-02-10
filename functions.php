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

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/ featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
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

/**
 * Display publish date.
 */
function tutorial_publish_date() {
	echo sprintf(
		/* translators: %s: time */
		esc_html__( 'Published %s ago', 'tutorial' ),
		esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) )
	);
}
/**
 * Display reading time.
 */
function tutorial_reading_time() {
	$content = get_the_content( null, false, get_the_ID() );
	$content = strip_shortcodes( $content );
	$content = wp_strip_all_tags( $content );

	$word_count = count( preg_split( '/\s+/', $content ) );

	$wpm  = 161;
	$time = ceil( $word_count / $wpm );
	$time = max( 1, $time );

	$read_time = sprintf(
		/* translators: %s: Number of minutes. */
		__( '%s min read', 'tutorial' ),
		$time
	);
	echo esc_html( $read_time );
}

/**
 * Generate a trimmed-down version of the full post content for archive & home
 *
 * @param  string $content Content of the current post.
 * @return string
 */
function tutorial_the_content( $content ) {
	if ( is_archive() || is_home() ) {
		$content = wp_trim_words( $content, 36 );
	}
	return $content;
}
add_filter( 'the_content', 'tutorial_the_content' );
