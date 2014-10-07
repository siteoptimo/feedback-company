<form action='options.php' method='post'>

	<h2><?php _ex( 'The Feedback Company', 'Settings page main title', 'feedback-company' ); ?></h2>

	<?php
	settings_fields( 'feedback-company' );
	do_settings_sections( 'feedback-company' );
	submit_button();
	?>

</form>