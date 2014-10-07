<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Rating {
	private $score;
	private $scale;
	private $reviews = array();
	private $detailsLink;

	/**
	 * @param $detailsLink
	 * @param $scale
	 * @param $score
	 */
	function __construct( $detailsLink, $scale, $score ) {
		$this->detailsLink = $detailsLink;
		$this->scale       = $scale;
		$this->score       = $score;
	}

	public function addReview(FC_Review $review) {
		$this->reviews[$review->getId()] = $review;
	}


	/**
	 * @return mixed
	 */
	public function getDetailsLink() {
		return $this->detailsLink;
	}

	/**
	 * @param mixed $detailsLink
	 */
	public function setDetailsLink( $detailsLink ) {
		$this->detailsLink = $detailsLink;
	}

	/**
	 * @return mixed
	 */
	public function getReviews() {
		return $this->reviews;
	}

	/**
	 * @param mixed $reviews
	 */
	public function setReviews( $reviews ) {
		$this->reviews = $reviews;
	}

	/**
	 * @return mixed
	 */
	public function getScale() {
		return $this->scale;
	}

	/**
	 * @param mixed $scale
	 */
	public function setScale( $scale ) {
		$this->scale = $scale;
	}

	/**
	 * @return mixed
	 */
	public function getScore() {
		return $this->score;
	}

	/**
	 * @param mixed $score
	 */
	public function setScore( $score ) {
		$this->score = $score;
	}

}