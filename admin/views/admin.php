<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   My_Lead_Assistant
 * @author    Leadrush Ltd. <support@reallysuccessful.com>
 * @license   GPL-2.0+
 * @link      http://leadrushsupport.com/
 * @copyright 2014 Leadrush Ltd.
 */
?>

<div class="wrap">
<form method="POST" action="options.php">
	
	<?php settings_fields( 'mla-settings-group' ); ?>

	<h2 class="title">My Lead Assistant Embed Code</h2>

	<p><label for="myleadassistant_script">Please enter the embed code provided by your My Lead Assistant Application here.</label></p>

	<textarea name="myleadassistant_script" id="jscode" class="large-text code" rows="3"><?php echo get_option( 'myleadassistant_script' );?></textarea>

	<?php submit_button(); ?>

</form>

</div>
