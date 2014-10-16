<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_MultiLingual {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! self::wpml_enabled() ) {
			return;
		}

		add_filter( 'fc_settings_id', array( $this, 'multilingual_id' ) );
	}

	public function multilingual_id( $description ) {

		$languages = self::get_languages();

		return $description . ' (' . implode( ', ', $languages ) . ')';

	}

	public static function get_languages() {
		if ( ! self::wpml_enabled() ) {
			return array();
		}

		$languages = array();

		global $sitepress;
		$langs = $sitepress->get_active_languages();

		$default_lang = $sitepress->get_default_language();

		foreach ( $langs as $short => $lang ) {
			if ( $short == $default_lang ) {
				array_unshift( $languages, $short );
			} else {
				array_push( $languages, $short );
			}
		}

		return $languages;
	}

	public static function wpml_enabled() {
		return class_exists( 'SitePress' );
	}

}