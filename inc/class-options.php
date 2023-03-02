<?php
/**
 * Options page
 *
 * @package Tutorial
 */

namespace Tutorial;

/**
 * Options class
 */
class Options {

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Options page slug
	 *
	 * @var string
	 */
	private $page = 'tutorial-options';

	/**
	 * Options group name
	 *
	 * @var string
	 */
	private $group = 'tutorial_group';

	/**
	 * Option name
	 *
	 * @var string
	 */
	private $option_name = 'tutorial_options';

	/**
	 * Sets options page and menu.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_action( 'admin_menu', array( $this, 'add_page' ) );
	}

	/**
	 * Add options page
	 */
	public function add_page() {
		add_theme_page(
			__( 'Theme Options', 'tutorial' ),
			__( 'Theme Options', 'tutorial' ),
			'manage_options',
			$this->page,
			array( $this, 'display' )
		);
	}

	/**
	 * Add settings
	 */
	public function settings_init() {
		register_setting(
			$this->group,
			$this->option_name,
			array(
				$this,
				'sanitize',
			)
		);

		add_settings_section(
			'tutorial_section_cta',
			__( 'CTA', 'tutorial' ),
			array(
				$this,
				'section_cta',
			),
			$this->page
		);

		add_settings_section(
			'tutorial_section_contact',
			__( 'Contact', 'tutorial' ),
			array(
				$this,
				'section_contact',
			),
			$this->page
		);

		add_settings_section(
			'tutorial_section_footer',
			__( 'Footer', 'tutorial' ),
			array(
				$this,
				'section_footer',
			),
			$this->page
		);

		add_settings_field(
			'cta_title',
			__( 'CTA Title', 'tutorial' ),
			array( $this, 'field_cta_title' ),
			$this->page,
			'tutorial_section_cta'
		);

		add_settings_field(
			'cta_description',
			__( 'CTA Description', 'tutorial' ),
			array( $this, 'field_cta_description' ),
			$this->page,
			'tutorial_section_cta'
		);

		add_settings_field(
			'cta_form',
			__( 'CTA Form', 'tutorial' ),
			array( $this, 'field_cta_form' ),
			$this->page,
			'tutorial_section_cta'
		);

		add_settings_field(
			'contact_title',
			__( 'Contact Title', 'tutorial' ),
			array( $this, 'field_contact_title' ),
			$this->page,
			'tutorial_section_contact'
		);

		add_settings_field(
			'contact_url',
			__( 'Contact URL', 'tutorial' ),
			array( $this, 'field_contact_url' ),
			$this->page,
			'tutorial_section_contact'
		);

		add_settings_field(
			'footer_text',
			__( 'Footer Text', 'tutorial' ),
			array(
				$this,
				'field_footer_text',
			),
			$this->page,
			'tutorial_section_footer'
		);
	}

	/**
	 * Display section
	 */
	public function section_cta() {
		?>
		<p><?php esc_html_e( 'Options for CTA section.', 'tutorial' ); ?></p>
		<?php
	}

	/**
	 * Display section
	 */
	public function section_contact() {
		?>
		<p><?php esc_html_e( 'Options for contact section.', 'tutorial' ); ?></p>
		<?php
	}

	/**
	 * Display section
	 */
	public function section_footer() {
		?>
		<p><?php esc_html_e( 'Options for footer section.', 'tutorial' ); ?></p>
		<?php
	}

	/**
	 * Display field
	 */
	public function field_cta_title() {
		$name = $this->option_name . '[cta_title]';
		$val  = $this->options['cta_title'];
		?>
		<input type="text" class="regular-text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $val ); ?>">
		<?php
	}

	/**
	 * Display field
	 */
	public function field_cta_description() {
		$name = $this->option_name . '[cta_description]';
		$val  = $this->options['cta_description'];
		?>
		<textarea class="regular-text" rows="5" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $val ); ?></textarea>
		<?php
	}

	/**
	 * Display field
	 */
	public function field_cta_form() {
		$name = $this->option_name . '[cta_form]';
		$val  = $this->options['cta_form'];
		?>
		<textarea class="regular-text" rows="5" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $val ); ?></textarea>
		<?php
	}

	/**
	 * Display field
	 */
	public function field_contact_title() {
		$name = $this->option_name . '[contact_title]';
		$val  = $this->options['contact_title'];
		?>
		<input type="text" class="regular-text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $val ); ?>">
		<?php
	}

	/**
	 * Display field
	 */
	public function field_contact_url() {
		$name = $this->option_name . '[contact_url]';
		$val  = $this->options['contact_url'];
		?>
		<input type="text" class="regular-text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $val ); ?>">
		<?php
	}

	/**
	 * Display field
	 */
	public function field_footer_text() {
		$name = $this->option_name . '[footer_text]';
		$val  = $this->options['footer_text'];
		?>
		<textarea class="regular-text" rows="5" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $val ); ?></textarea>
		<?php
	}

	/**
	 * Sanitize input data
	 *
	 * @param  array $input Input data.
	 * @return array
	 */
	public function sanitize( $input ) {
		$input['cta_title']       = sanitize_text_field( $input['cta_title'] );
		$input['cta_description'] = wp_kses_post( $input['cta_description'] );
		$input['cta_form']        = wp_kses_post( $input['cta_form'] );
		$input['contact_title']   = sanitize_text_field( $input['contact_title'] );
		$input['contact_url']     = sanitize_text_field( $input['contact_url'] );
		$input['footer_text']     = wp_kses_post( $input['footer_text'] );
		return $input;
	}

	/**
	 * Display settings page
	 */
	public function display() {
		$this->options = get_option( $this->option_name );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( $this->group );
				do_settings_sections( $this->page );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}

new Options();
