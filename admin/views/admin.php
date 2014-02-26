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

	<textarea name="myleadassistant_script" id="jscode" class="large-text code" style="width:676px;height:350px"><?php echo get_option( 'myleadassistant_script' );?></textarea>
	
	<p>By Default, the widget is embedded on all pages.</p>
	
	<p><label><input type="radio" id="radio_on" name="pages_radio"<? echo (($on_pages = get_option( 'myleadassistant_on_pages' ))?' checked':null) ?>> To enable the widget on specific pages only, enter the page titles below, one per line:</label></p>
	<textarea id="on_pages" name="myleadassistant_on_pages" style="height:150px;resize:none;" class="regular-text"<? echo ($on_pages?null:' disabled') ?>><?php echo $on_pages ?></textarea>
	
	<p><label><input type="radio" id="radio_off" name="pages_radio"<? echo (($off_pages = get_option( 'myleadassistant_off_pages' ))?' checked':null) ?>> To exclude the widget from specific pages (but display on all others), enter the page titles below, one per line:</label></p>
	<textarea id="off_pages" name="myleadassistant_off_pages" style="height:150px;resize:none;" class="regular-text"<? echo ($off_pages?null:' disabled') ?>><?php echo $off_pages ?></textarea>
	
	<br><br><span class="description">
	Note: Do not include the file extension (like .php), quotation marks, or any other punctuation,<br>
	just the title of the page as it appears in the list of pages in the admin panel.
	<pre>Example:
  Sample Page
  Another Sample Page</pre></span>

	<?php submit_button(); ?>

</form>

</div>
