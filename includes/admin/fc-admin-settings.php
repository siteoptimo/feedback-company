<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Admin_Settings {

	const OPTION_NAME = 'fc_settings';

	private static $options;

	private $scales = array(
		4,
		5,
		6,
		10,
		100
	);

	private static $default_options = array(
		'fc_general_id'      => '',
		'fc_defaults_scale'  => 5,
		'fc_defaults_amount' => 10,
		'fc_defaults_order'  => 'desc',
		'fc_defaults_start'  => 1
	);

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'init_settings' ) );

		$this->set_options();
	}

	public static function get_defaults() {
		return self::$default_options;
	}

	private static function set_options() {
		self::$options = array_merge( self::$default_options, get_option( self::OPTION_NAME, array() ) );
	}

	public static function get_options() {
		if ( self::$options == null ) {
			self::set_options();
		}

		return self::$options;
	}

	public function add_admin_menu() {
		add_menu_page( _x( 'Feedback Company', 'Page title', 'feedback-company' ), _x( 'Feedback Company', 'Menu title', 'feedback-company' ), 'manage_options', 'feedback_company', array(
			$this,
			'options_page'
		) );
	}

	public function options_page() {
		fc_get_template( 'admin/options' );
	}

	public function init_settings() {
		register_setting( 'feedback-company', self::OPTION_NAME );

		add_settings_section( 'fc_general_section', _x( 'General options', 'feedback-company' ), array(
			$this,
			'general_callback'
		), 'feedback-company' );

		add_settings_field(
			'fc_general_id',
			__( 'Your company ID', 'feedback-company' ),
			array( $this, 'render_id' ),
			'feedback-company',
			'fc_general_section'
		);

		add_settings_section( 'fc_defaults_section', _x( 'Default values', 'feedback-company' ), array(
			$this,
			'default_callback'
		), 'feedback-company' );

		add_settings_field(
			'fc_defaults_scale',
			__( 'Scale', 'feedback-company' ),
			array( $this, 'render_scale' ),
			'feedback-company',
			'fc_defaults_section'
		);

		add_settings_field(
			'fc_defaults_amount',
			__( 'Number of reviews', 'feedback-company' ),
			array( $this, 'render_amount' ),
			'feedback-company',
			'fc_defaults_section'
		);

		add_settings_field(
			'fc_defaults_start',
			__( 'Start at', 'feedback-company' ),
			array( $this, 'render_start' ),
			'feedback-company',
			'fc_defaults_section'
		);

		add_settings_field(
			'fc_defaults_order',
			__( 'Order', 'feedback-company' ),
			array( $this, 'render_order' ),
			'feedback-company',
			'fc_defaults_section'
		);
	}

	public function general_callback() {
		echo __( 'Manage the general feedback company settings over here.', 'feedback-company' );
	}

	public function default_callback() {
		echo __( 'Manage the default behaviour of the displaying of reviews.', 'feedback-company' );
	}

	public function render_id() {
		?>
		<input type='text' name='fc_settings[fc_general_id]' value='<?php echo self::$options['fc_general_id']; ?>'
		       size="5">
		<p class="description">
			<?php _e( 'Enter your company ID. eg: https://beoordelingen.feedbackcompany.nl/reviews/<strong>YOUR_ID</strong>/<em>YOUR_COMPANY</em>.html', 'feedback-company' ); ?>
		</p>
	<?php
	}

	public function render_start() {
		?>
		<input type='text' name='fc_settings[fc_defaults_start]' size="5"
		       value='<?php echo self::$options['fc_defaults_start']; ?>'>
		<p class="description">
			<?php _e( 'Enter the default start position that should be listed.', 'feedback-company' ); ?>
		</p>
	<?php
	}

	public function render_amount() {
		?>
		<input type='text' name='fc_settings[fc_defaults_amount]' size="5"
		       value='<?php echo self::$options['fc_defaults_amount']; ?>'>
		<p class="description">
			<?php _e( 'Enter the default amount of reviews that should be listed.', 'feedback-company' ); ?>
		</p>
	<?php
	}

	public function render_scale() {
		$default = self::$options['fc_defaults_scale'];
		?>
		<select name="fc_settings[fc_defaults_scale]">
			<?php foreach ( $this->scales as $scale ): ?>
				<option value="<?php echo $scale; ?>" <?php selected( $scale, $default ); ?>>
					<?php printf( __( '1 to %d scale', 'feedback-company' ), $scale ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	<?php
	}

	public function render_order() {
		$default = self::$options['fc_defaults_order'];
		$orders  = array(
			'asc'  => __( 'Oldest first', 'feedback-company' ),
			'desc' => __( 'Newest first', 'feedback-company' )
		);
		?>
		<select name="fc_settings[fc_defaults_order]">
			<?php foreach ( $orders as $order => $value ): ?>
				<option value="<?php echo $order; ?>" <?php selected( $order, $default ); ?>>
					<?php echo $value; ?>
				</option>
			<?php endforeach; ?>
		</select>
	<?php
	}
}