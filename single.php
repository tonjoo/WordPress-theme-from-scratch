<?php
/**
 * The template for displaying all single posts
 *
 * @package Tutorial
 */

get_header();
?>

	<article class="blog-post px-3 py-5 p-md-5">
		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<div class="container single-col-max-width">
				<header class="blog-post-header">
					<h2 class="title mb-2"><?php the_title(); ?></h2>
					<div class="meta mb-3">
						<span class="date"><?php tutorial_publish_date(); ?></span>
						<span class="time"><?php tutorial_reading_time(); ?></span>
						<span class="comment"><?php comments_popup_link( false, false, false, 'text-link' ); ?></span>
					</div>
				</header>

				<div class="blog-post-body">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="blog-banner">
							<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
							<?php tutorial_post_thumbnail_caption(); ?>
						</figure>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>

				<?php tutorial_post_navigation(); ?>

				<div class="blog-comments-section">
					<div id="disqus_thread"></div>
					<script>
						/**
						 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT
						 *  THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR
						 *  PLATFORM OR CMS.
						 *
						 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT:
						 *  https://disqus.com/admin/universalcode/#configuration-variables
						 */
						/*
						var disqus_config = function () {
							// Replace PAGE_URL with your page's canonical URL variable
							this.page.url = PAGE_URL;

							// Replace PAGE_IDENTIFIER with your page's unique identifier variable
							this.page.identifier = PAGE_IDENTIFIER;
						};
						*/

						(function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
							var d = document, s = d.createElement('script');

							// IMPORTANT TODO: Replace 3wmthemes with your forum shortname!
							s.src = 'https://3wmthemes.disqus.com/embed.js';

							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
						})();
					</script>
					<noscript>
						Please enable JavaScript to view the
						<a href="https://disqus.com/?ref_noscript" rel="nofollow">
								comments powered by Disqus.
						</a>
					</noscript>
				</div><!--//blog-comments-section-->

			</div><!--//container-->
		<?php endwhile; ?>
	</article>

<?php
get_footer();
