<?php
/**
 * Tutorial functions and definitions
 *
 * @package Tutorial
 */

define( 'TUTORIAL_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'TUTORIAL_DIR', get_template_directory() );
define( 'TUTORIAL_URL', get_template_directory_uri() );

include TUTORIAL_DIR . '/inc/class-profile-widget.php';

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'tutorial' ),
		)
	);
}
add_action( 'after_setup_theme', 'tutorial_setup' );

/**
 * Register widget area.
 */
function tutorial_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tutorial' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tutorial' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_widget( 'Tutorial\Profile_Widget' );
}
add_action( 'widgets_init', 'tutorial_widgets_init' );

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

/**
 * Display featured image caption
 */
function tutorial_post_thumbnail_caption() {
	$thumbnail_id = get_post_thumbnail_id();
	$thumbnail    = get_post( $thumbnail_id );
	if ( ! empty( $thumbnail->post_excerpt ) ) {
		echo '<figcaption class="mt-2 text-center image-caption">';
		echo wp_kses_post( $thumbnail->post_excerpt );
		echo '</figcaption>';
	}
}

/**
 * Display single post navigation
 */
function tutorial_post_navigation() {
	$previous = get_previous_post_link(
		'%link',
		esc_html__( 'Previous', 'tutorial' ) . '<i class="arrow-prev fas fa-long-arrow-alt-left"></i>'
	);
	$next = get_next_post_link(
		'%link',
		esc_html__( 'Next', 'tutorial' ) . '<i class="arrow-next fas fa-long-arrow-alt-right"></i>'
	);
	$previous = str_replace( 'rel="prev"', 'rel="prev" class="nav-link-prev nav-item nav-link rounded-left"', $previous );
	$next     = str_replace( 'rel="next"', 'rel="next" class="nav-link-next nav-item nav-link rounded-right"', $next );

	if ( $previous || $next ) {
		echo '<nav class="blog-nav nav nav-justified my-5">';
		echo wp_kses_post( $previous );
		echo wp_kses_post( $next );
		echo '</nav';
	}
}

/**
 * Display posts navigation
 */
function tutorial_posts_navigation() {
	global $paged, $wp_query;
	if ( $wp_query->max_num_pages > 1 ) {
		if ( ! $paged ) {
			$paged = 1;
		}
		$nextpage = (int) $paged + 1;
		$max_page = $wp_query->max_num_pages;

		$prev_link = previous_posts( false );
		$next_link = next_posts( $max_page, false );

		echo '<nav class="blog-nav nav nav-justified my-5">';
		if ( $paged > 1 ) {
			echo '<a class="nav-link-prev nav-item nav-link rounded" href="' . esc_attr( $prev_link ) . '">' . esc_html__( 'Previous', 'tutorial' ) . '<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>&nbsp;';
		}
		if ( $nextpage <= $max_page ) {
			echo '<a class="nav-link-next nav-item nav-link rounded" href="' . esc_attr( $next_link ) . '">' . esc_html__( 'Next', 'tutorial' ) . '<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>';
		}
		echo '</nav>';
	}
}

/**
 * Add classes to menu item list
 *
 * @param  array $classes Classes.
 * @param  obj   $item    Menu item object.
 * @param  obj   $args    Menu arguments.
 * @return array
 */
function tutorial_menu_item_list_class( $classes, $item, $args ) {
	if ( 'menu-1' === $args->theme_location ) {
		$classes[] = 'nav-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'tutorial_menu_item_list_class', 10, 3 );

/**
 * Add classes to menu item link
 *
 * @param  array $atts HTML attributes.
 * @param  obj   $item Menu item object.
 * @param  obj   $args Menu arguments.
 * @return array
 */
function tutorial_menu_item_link_class( $atts, $item, $args ) {
	if ( 'menu-1' === $args->theme_location ) {
		$atts['class'] = 'nav-link';
		if ( in_array( 'current-menu-item', $item->classes ) ) {
			$atts['class'] .= ' active';
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'tutorial_menu_item_link_class', 10, 3 );
