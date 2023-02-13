<?php
/**
 * The header for our theme
 *
 * @package Tutorial
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<header class="header text-center">
		<h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="<?php echo esc_url( home_url( '/' ) ); ?>">Anthony's Blog</a></h1>

		<nav class="navbar navbar-expand-lg navbar-dark" >

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >

				<?php dynamic_sidebar( 'sidebar-1' ); ?>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'navbar-nav flex-column text-start',
					)
				);
				?>

				<div class="my-2 my-md-3">
					<a class="btn btn-primary" href="https://themes.3rdwavemedia.com/" target="_blank">Get in Touch</a>
				</div>
			</div>
		</nav>
	</header>

	<div class="main-wrapper">
