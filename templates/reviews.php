<?php
/**
 * @var $fc_rating FC_Rating
 */
global $fc_rating;
$reviews = $fc_rating->getReviews();
?>
<section id="fc-reviews">
	<header>
		<h2><?php _e( 'Reviews', 'feedback-company' ); ?></h2>
	</header>
	<div class="fc-reviews-list">
		<?php
		/**
		 * @var $review FC_Review
		 */
		foreach ( $reviews as $review ) : ?>
			<blockquote class="fc-review">
				<p><?php printf( __( 'Score: <span class="score">%.2f/%.2f</span>.', 'feedback-company' ), $review->getScore(), $fc_rating->getScale() ); ?></p>

				<p><?php echo $review->getReview(); ?></p>
				<footer>&mdash; <?php echo $review->getReviewer(); ?></footer>
			</blockquote>
		<?php endforeach; ?>
	</div>
</section>