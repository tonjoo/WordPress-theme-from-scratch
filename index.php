<?php
/**
 * The main template file
 *
 * @package Tutorial
 */

$options = get_option( 'tutorial_options' );
get_header();
?>

	<?php if ( ! empty( $options['cta_title'] ) ) : ?>
		<section class="cta-section theme-bg-light py-5">
			<div class="container text-center single-col-max-width">
				<h2 class="heading"><?php echo esc_html( $options['cta_title'] ); ?></h2>

				<?php if ( ! empty( $options['cta_description'] ) ) : ?>
					<div class="intro"><?php echo wp_kses_post( $options['cta_description'] ); ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $options['cta_form'] ) ) : ?>
					<div class="single-form-max-width pt-3 mx-auto">
						<?php echo do_shortcode( $options['cta_form'] ); ?>
					</div><!--//single-form-max-width-->
				<?php endif; ?>

			</div><!--//container-->
		</section>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<section class="blog-list px-3 py-5 p-md-5">
			<div class="container single-col-max-width">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<div class="item mb-5">
						<div class="row g-3 g-xl-0">
							<div class="col-2 col-xl-3">
								<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid post-thumb' ) ); ?>
							</div>
							<div class="col">
								<h3 class="title mb-1"><a class="text-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="meta mb-1">
									<span class="date"><?php tutorial_publish_date(); ?></span>
									<span class="time"><?php tutorial_reading_time(); ?></span>
									<span class="comment"><?php comments_popup_link( false, false, false, 'text-link' ); ?></span>
								</div>
								<div class="intro"><?php the_content(); ?></div>
								<a class="text-link" href="<?php the_permalink(); ?>">Read more &rarr;</a>
							</div><!--//col-->
						</div><!--//row-->
					</div><!--//item-->
				<?php endwhile; ?>

				<?php tutorial_posts_navigation(); ?>

			</div>
		</section>
	<?php endif; ?>

<?php
get_footer();
