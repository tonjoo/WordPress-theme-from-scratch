<?php
/**
 * The main template file
 *
 * @package Tutorial
 */

get_header();
?>

	<section class="cta-section theme-bg-light py-5">
		<div class="container text-center single-col-max-width">
			<h2 class="heading">DevBlog - A Blog Template Made For Developers</h2>
			<div class="intro">Welcome to my blog. Subscribe and get my latest blog post in your inbox.</div>
			<div class="single-form-max-width pt-3 mx-auto">
				<form class="signup-form row g-2 g-lg-2 align-items-center">
					<div class="col-12 col-md-9">
						<label class="sr-only" for="semail">Your email</label>
						<input type="email" id="semail" name="semail1" class="form-control me-md-1 semail" placeholder="Enter email">
					</div>
					<div class="col-12 col-md-2">
						<button type="submit" class="btn btn-primary">Subscribe</button>
					</div>
				</form><!--//signup-form-->
			</div><!--//single-form-max-width-->
		</div><!--//container-->
	</section>


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

				<nav class="blog-nav nav nav-justified my-5">
				  <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
				  <a class="nav-link-next nav-item nav-link rounded" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav>

			</div>
		</section>
	<?php endif; ?>

<?php
get_footer();
