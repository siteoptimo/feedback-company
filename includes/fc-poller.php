<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Poller {
	private static $BASE_URL = 'http://beoordelingen.feedbackcompany.nl/samenvoordeel/scripts/flexreview/getreviewxml.cfm';

	private static $sexes = array(
		'vrouw' => 0,
		'man'   => 1
	);

	public static function getRating( $params ) {
		$feed = self::getUrl( $params );

		$feedContent = @file_get_contents( $feed );

		if ( ! $feedContent ) {
			throw new Exception( __( 'Unable to access feed.', 'feedback-company' ) );
		}

		$rating = simplexml_load_string( $feedContent );

		$return = self::mapRating( $rating );

		return $return;
	}

	private static function getUrl( $params ) {
		return add_query_arg( $params, self::$BASE_URL );
	}

	private static function getScores() {
		return array(
			'aftersales'            => array( 'slug'   => 'aftersales',
			                                  'pretty' => __( 'After sales', 'feedback-company' )
			),
			'bestelgemak'           => array(
				'slug'   => 'orderingease',
				'pretty' => __( 'Ease of ordering', 'feedback-company' )
			),
			'informatievoorziening' => array( 'slug'   => 'information',
			                                  'pretty' => __( 'Information', 'feedback-company' )
			),
			'klantvriendelijk'      => array( 'slug'   => 'friendliness',
			                                  'pretty' => __( 'Customer care', 'feedback-company' )
			),
			'levertijd'             => array( 'slug' => 'delivery', 'pretty' => __( 'Delivery', 'feedback-company' ) ),
			'reactiesnelheid'       => array( 'slug'   => 'reactiontime',
			                                  'pretty' => __( 'Reaction time', 'feedback-company' )
			),
			'orderverloop'          => array( 'slug'   => 'orderprocess',
			                                  'pretty' => __( 'Order process', 'feedback-company' )
			),
		);
	}

	/**
	 * @param $rating
	 *
	 * @return FC_Rating
	 */
	private static function mapRating( SimpleXMLElement $rating ) {
		$return = new FC_Rating( (string) $rating->detailslink, (string) $rating->scoremax, (string) $rating->score );

		foreach ( $rating->reviewDetails->reviewDetail as $review ) {
			$reviewObj = new FC_Review();

			$reviewObj->setScore( (float) $review->score );
			$age = (int) $review->leeftijd;

			if ( $age ) {
				$reviewObj->setAge( $age );
			}

			$buyFrequency = (string) $review->kooptvakeronline;
			if ( $buyFrequency && ! empty( $buyFrequency ) ) {
				$reviewObj->setBuyFrequency( FC_BuyFrequency::$map[ $buyFrequency ] );
			}

			$reviewObj->setReviewer( (string) $review->user );
			$reviewObj->setReview( (string) $review->text );
			$date = DateTime::createFromFormat( 'Ymd', (string) $review->createdate );
			$date->setTime( 0, 0 );
			$reviewObj->setDate( $date );
			$reviewObj->setId( (int) $review->id );

			$improvements = (string) $review->verbeterpunten;

			if ( $improvements && ! empty( $improvements ) ) {
				$reviewObj->setImprovements( $improvements );
			}

			$strengths = (string) $review->sterkepunten;

			if ( $strengths && ! empty( $strengths ) ) {
				$reviewObj->setStrengths( $strengths );
			}

			$sex = (string) $review->geslacht;

			if ( $sex && ! empty( $sex ) ) {
				$reviewObj->setSex( self::$sexes[ $sex ] );
			}

			$recommending = (string) $review->beveeltAan;

			if ( $recommending && ! empty( $recommending ) ) {
				$reviewObj->setRecommending( ( $recommending == 'ja' ) );
			}

			$reviewObj->setMax( (float) $review->scoremax );

			$scores = array();

			$mappedScores = self::getScores();

			foreach ( $mappedScores as $score => $value ) {
				$scores[ $value['slug'] ] = (int) $review->{'score_' . $score};
			}

			$reviewObj->setScores( $scores );

			$productBought = (string) $review->gekochtproduct;

			if ( $productBought && ! empty( $productBought ) ) {
				$reviewObj->setProductBought( $productBought );
			}

			$return->addReview( $reviewObj );
		}

		return $return;
	}
}