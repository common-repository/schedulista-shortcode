<?php
/*
Plugin Name: Schedulista - Online Scheduling
Description: Embed the Schedulista online scheduling widget on your website.
Plugin URI: https://wordpress.org/plugins/schedulista-shortcode/
Version: 2.2
License: GPL
Author: Schedulista
Author URI: https://www.schedulista.com
*/

function createSchedulista($atts, $content = null) {
	extract(shortcode_atts(array(
		'type'   => 'button',
		'code'   => '',
		'width'     => '500',
		'height'     => '700',
    ), $atts));

	if (!$code) {

		$error = "
		<div style='border: 20px solid red; border-radius: 40px; padding: 40px; margin: 50px 0 70px;'>
			<h3>Copy & Paste Error</h3>
			<p style='margin: 0;'>Something is wrong with your Schedulista shortcode.</p>
		</div>";

		return $error;

	} elseif (strcmp(strtolower($type), 'widget') == 0) {
	    return createSchedulistaEmbedWidget($code, $width, $height);
	} else {
	    return createSchedulistaEmbedButton($code);
	}
}

function createSchedulistaEmbedButton($code) {
    $html =  <<<EOS
<a
href='https://$code.schedulista.com/?utm_source=schedule-now-button&utm_medium=link&utm_campaign=wordpress-plugin'>
<img title='Schedule an Appointment Online'
    src='https://www.schedulista.com/assets/schedule_button@2x.png'
    style="height: 44px"
    alt='Online Scheduling Software'>
</a>
EOS;
    return $html;
}

function createSchedulistaEmbedWidget($code, $width, $height) {
    $html = <<<EOS
<iframe id="schedulista-widget-00"
src="https://www.schedulista.com/schedule/$code?mode=widget&utm_source=widget&utm_medium=link&utm_campaign=wordpress-plugin"
allowtransparency="true" frameborder="0" scrolling="no" width="100%"
height="900px"></iframe>
<script id="schedulista-widget-script-00" type="text/javascript"
src="https://www.schedulista.com/schedule/$code/widget.js"></script>
EOS;
    return $html;
}

add_shortcode('schedulista', 'createSchedulista');

?>
