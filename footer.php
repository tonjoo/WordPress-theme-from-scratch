<?php
/**
 * The template for displaying the footer
 *
 * @package Tutorial
 */

$options = get_option( 'tutorial_options' );
?>

	<footer class="footer text-center py-2 theme-bg-dark">

		<?php if ( empty( $options['footer_text'] ) ) : ?>

			<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="https://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

		<?php else : ?>

			<?php echo wp_kses_post( $options['footer_text'] ); ?>

		<?php endif; ?>

	</footer>

</div><!--//main-wrapper-->


<?php wp_footer(); ?>

</body>
</html>
