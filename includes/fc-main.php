<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Main {
	private static $BASE_URL = 'http://beoordelingen.feedbackcompany.nl/samenvoordeel/scripts/flexreview/getreviewxml.cfm';

	private static $DEFAULTS = array(
		'ws'             => '0',
		'basescore'      => '5',
		'publishids'     => '1',
		'publishdetails' => '1',
		'sort'           => 'desc',
		'nor'            => '100',
		'start'          => '1'
	);

	public function __construct() {
		var_export( wp_parse_args( 'ws=%d&basescore=%d&publishids=%d&publishdetails=%d&sort=%s&nor=%d&start=%d' ) );

		var_dump(add_query_arg(self::$DEFAULTS, self::$BASE_URL));
	}

	public static function getReviews() {

	}
}