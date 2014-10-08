<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Main {

	const CACHE_TIME = DAY_IN_SECONDS;

	public function __construct() {
		add_shortcode( 'feedback', array( $this, 'doShortCode' ) );
	}

	public static function getRating( $options = array() ) {
		$params = self::getParams( $options );

		$transientName = self::getTransientName( $params );

		$rating = get_transient( $transientName );

		if ( $rating === false ) {
			$rating = FC_Poller::getRating( $params );

			set_transient( $transientName, $rating, self::CACHE_TIME );
		}

		return $rating;
	}

	public static function getParams( $options = array() ) {
		$options = shortcode_atts( FC_Admin_Settings::get_options(), $options );

		return array(
			'ws'             => $options['fc_general_id'],
			'basescore'      => $options['fc_defaults_scale'],
			'publishids'     => '1',
			'publishdetails' => '1',
			'sort'           => $options['fc_defaults_order'],
			'nor'            => $options['fc_defaults_amount'],
			'start'          => $options['fc_defaults_start']
		);

	}

	public function doShortCode( $atts ) {
		$rating = self::getRating( $atts );

		$amountOfReviews = sizeof( $rating->getReviews() );

		$template = $amountOfReviews > 1 ? 'reviews' : 'review';


		return self::displayReviews($rating, $template, false);
	}

	private static function getTransientName( $params ) {
		return 'fc_' . implode( '_', $params );
	}

	private static function displayReviews( FC_Rating $rating, $template, $echo = true ) {
		global $fc_rating;
		$fc_rating = $rating;
		if ( $echo ) {
			fc_get_template( $template );

			return null;
		}

		ob_start();
		fc_get_template( $template );
		$return = ob_get_clean();

		return $return;
	}
}