<?php
/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */

class FC_BuyFrequency {
	const SOMETIMES = 1;
	const OFTEN = 2;
	const REGULARLY = 3;

	public static $map = array(
		'soms'       => FC_BuyFrequency::SOMETIMES,
		'vaak'       => FC_BuyFrequency::OFTEN,
		'regelmatig' => FC_BuyFrequency::REGULARLY
	);

}