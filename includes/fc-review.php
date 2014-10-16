<?php

/**
 * @author Koen Van den Wijngaert <koen@siteoptimo.com>
 */
class FC_Review {
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var float
	 */
	private $score;
	/**
	 * @var float
	 */
	private $max;
	/**
	 * @var string
	 */
	private $review;
	/**
	 * @var string
	 */
	private $reviewer;
	/**
	 * @var bool
	 */
	private $recommending;
	/**
	 * @var DateTime
	 */
	private $date;
	/**
	 * @var array
	 */
	private $scores = array();
	/**
	 * @var int
	 */
	private $sex;
	/**
	 * @var int
	 */
	private $age;
	/**
	 * @var int
	 */
	private $buyFrequency;
	/**
	 * @var string
	 */
	private $productBought;
	/**
	 * @var string
	 */
	private $strengths;
	/**
	 * @var string
	 */
	private $improvements;


	/**
	 * @return int
	 */
	public function getAge() {
		return $this->age;
	}

	/**
	 * @param int $age
	 */
	public function setAge( $age ) {
		$this->age = $age;
	}

	/**
	 * @return int
	 */
	public function getBuyFrequency() {
		return $this->buyFrequency;
	}

	/**
	 * @param int $buyFrequency
	 */
	public function setBuyFrequency( $buyFrequency ) {
		$this->buyFrequency = $buyFrequency;
	}

	/**
	 * @return DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param DateTime $date
	 */
	public function setDate( $date ) {
		$this->date = $date;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getImprovements() {
		return $this->improvements;
	}

	/**
	 * @param string $improvements
	 */
	public function setImprovements( $improvements ) {
		$this->improvements = $improvements;
	}

	/**
	 * @return float
	 */
	public function getMax() {
		return $this->max;
	}

	/**
	 * @param float $max
	 */
	public function setMax( $max ) {
		$this->max = $max;
	}

	/**
	 * @return string
	 */
	public function getProductBought() {
		return $this->productBought;
	}

	/**
	 * @param string $productBought
	 */
	public function setProductBought( $productBought ) {
		$this->productBought = $productBought;
	}

	/**
	 * @return boolean
	 */
	public function isRecommending() {
		return $this->recommending;
	}

	/**
	 * @param boolean $recommending
	 */
	public function setRecommending( $recommending ) {
		$this->recommending = $recommending;
	}

	/**
	 * @return string
	 */
	public function getReview() {
		return trim( $this->review );
	}

	/**
	 * @param string $review
	 */
	public function setReview( $review ) {
		$this->review = $review;
	}

	/**
	 * @return string
	 */
	public function getReviewer() {
		return $this->reviewer;
	}

	/**
	 * @param string $reviewer
	 */
	public function setReviewer( $reviewer ) {
		$this->reviewer = $reviewer;
	}

	/**
	 * @return float
	 */
	public function getScore() {
		return $this->score;
	}

	/**
	 * @param float $score
	 */
	public function setScore( $score ) {
		$this->score = $score;
	}

	/**
	 * @return array
	 */
	public function getScores() {
		return $this->scores;
	}

	/**
	 * @param array $scores
	 */
	public function setScores( $scores ) {
		$this->scores = $scores;
	}

	/**
	 * @return int
	 */
	public function getSex() {
		return $this->sex;
	}

	/**
	 * @param int $sex
	 */
	public function setSex( $sex ) {
		$this->sex = $sex;
	}

	/**
	 * @return string
	 */
	public function getStrengths() {
		return $this->strengths;
	}

	/**
	 * @param string $strengths
	 */
	public function setStrengths( $strengths ) {
		$this->strengths = $strengths;
	}
}