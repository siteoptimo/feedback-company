<?php
global $fc_rating;

$review = array_shift( $fc_rating->getReviews() );
?>
<blockquote class="fc-review">
	<p><?php printf( __( 'Score: <span class="score">%.2f/%.2f</span>.', 'feedback-company' ), $review->getScore(), $fc_rating->getScale() ); ?></p>

	<p><?php echo $review->getReview(); ?></p>
	<footer>&mdash; <?php echo $review->getReviewer(); ?></footer>
</blockquote>