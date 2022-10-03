<?php
/**
 * Abandoned Oreder Settings Page
 */

$delay = get_option( 'cao_client_delay', 1000 );
?>
<div class="wrap">
	<h1>
		Order Abandoned Recording Delay
	</h1>
	<form class="cao-settings-form" method="post">
	<?php wp_nonce_field( 'cao-settings-save', 'cao-settings-nonce' ); ?>
	<div class="fields">
		<input type="number" name="cao-delay" value="<?php echo sanitize_text_field( $delay ); ?>" max=10000 min=500 >
		<label for="cao-delay">Time waited until the abandoned order saved ( in Milliseconds ) </label>
	</div>
	<input type="submit" value="Submit" class="button button-primary" >
</form>
</div>
