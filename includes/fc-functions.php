<?php
/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */

function fc_get_template( $template ) {
	$plugin_path = trailingslashit( fc_get_plugin_path() );

	require_once $plugin_path . 'templates/' . $template . '.php';
}

function fc_get_plugin_path() {
	global $FC;

	return $FC->plugin_path();
}