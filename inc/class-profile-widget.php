<?php
/**
 * Profile Widget
 *
 * @package Tutorial
 */

namespace Tutorial;

/**
 * Profile widget class
 */
class Profile_Widget extends \WP_Widget {

	/**
	 * Sets up a new Profile widget instance.
	 */
	public function __construct() {
		parent::__construct(
			'tutorial-profile',
			esc_html__( 'Profile', 'tutorial' ),
			array(
				'description' => esc_html__( 'Displays photo, bio and social media links.', 'tutorial' ),
			)
		);
	}

	/**
	 * Outputs the content for the current Profile widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$bio   = ! empty( $instance['bio'] ) ? $instance['bio'] : '';

		$socials = array();
		if ( ! empty( $instance['facebook'] ) ) {
			$socials['facebook'] = $instance['facebook'];
		}
		if ( ! empty( $instance['linkedin'] ) ) {
			$socials['linkedin'] = $instance['linkedin'];
		}
		if ( ! empty( $instance['github'] ) ) {
			$socials['github'] = $instance['github'];
		}
		if ( ! empty( $instance['stackoverflow'] ) ) {
			$socials['stackoverflow'] = $instance['stackoverflow'];
		}
		if ( ! empty( $instance['codepen'] ) ) {
			$socials['codepen'] = $instance['codepen'];
		}
		?>
		<div class="profile-section pt-3 pt-lg-0">
			<?php if ( $image ) : ?>
				<img class="profile-image mb-3 rounded-circle mx-auto" src="<?php echo esc_url( $image ); ?>" alt="" >
			<?php endif; ?>

			<?php if ( $bio ) : ?>
				<div class="bio mb-3"><?php echo wp_kses_post( wpautop( $bio ) ); ?></div><!--//bio-->
			<?php endif; ?>

			<?php if ( $socials ) : ?>
				<ul class="social-list list-inline py-3 mx-auto">
					<?php if ( $socials['facebook'] ) : ?>
						<li class="list-inline-item"><a href="<?php echo esc_url( $socials['facebook'] ); ?>"><i class="fab fa-twitter fa-fw"></i></a></li>
					<?php endif; ?>
					<?php if ( $socials['linkedin'] ) : ?>
						<li class="list-inline-item"><a href="<?php echo esc_url( $socials['linkedin'] ); ?>"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
					<?php endif; ?>
					<?php if ( $socials['github'] ) : ?>
						<li class="list-inline-item"><a href="<?php echo esc_url( $socials['github'] ); ?>"><i class="fab fa-github-alt fa-fw"></i></a></li>
					<?php endif; ?>
					<?php if ( $socials['stackoverflow'] ) : ?>
						<li class="list-inline-item"><a href="<?php echo esc_url( $socials['stackoverflow'] ); ?>"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
					<?php endif; ?>
					<?php if ( $socials['codepen'] ) : ?>
						<li class="list-inline-item"><a href="<?php echo esc_url( $socials['codepen'] ); ?>"><i class="fab fa-codepen fa-fw"></i></a></li>
					<?php endif; ?>
				</ul><!--//social-list-->
			<?php endif; ?>
			<hr>
		</div><!--//profile-section-->
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Profile widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['image']         = sanitize_text_field( $new_instance['image'] );
		$instance['bio']           = wp_kses_post( $new_instance['bio'] );
		$instance['facebook']      = sanitize_text_field( $new_instance['facebook'] );
		$instance['linkedin']      = sanitize_text_field( $new_instance['linkedin'] );
		$instance['github']        = sanitize_text_field( $new_instance['github'] );
		$instance['stackoverflow'] = sanitize_text_field( $new_instance['stackoverflow'] );
		$instance['codepen']       = sanitize_text_field( $new_instance['codepen'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Profile widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$image         = isset( $instance['image'] ) ? sanitize_text_field( $instance['image'] ) : '';
		$bio           = isset( $instance['bio'] ) ? wp_kses_post( $instance['bio'] ) : '';
		$facebook      = isset( $instance['facebook'] ) ? sanitize_text_field( $instance['facebook'] ) : '';
		$linkedin      = isset( $instance['linkedin'] ) ? sanitize_text_field( $instance['linkedin'] ) : '';
		$github        = isset( $instance['github'] ) ? sanitize_text_field( $instance['github'] ) : '';
		$stackoverflow = isset( $instance['stackoverflow'] ) ? sanitize_text_field( $instance['stackoverflow'] ) : '';
		$codepen       = isset( $instance['codepen'] ) ? sanitize_text_field( $instance['codepen'] ) : '';
		?>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['image'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'bio' ) ); ?>"><?php esc_html_e( 'Bio:', 'tutorial' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bio' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bio' ) ); ?>" rows="5"><?php echo esc_textarea( $bio ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'github' ) ); ?>"><?php esc_html_e( 'Github URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['github'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'stackoverflow' ) ); ?>"><?php esc_html_e( 'Stackoverflow URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stackoverflow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stackoverflow' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['stackoverflow'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'codepen' ) ); ?>"><?php esc_html_e( 'Codepen URL:', 'tutorial' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'codepen' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'codepen' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['codepen'] ); ?>" />
		</p>
		<?php
	}
}
