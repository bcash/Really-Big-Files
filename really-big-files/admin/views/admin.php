<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Really_Big_Files
 * @author    Brian Cash <bcash@alpineinternet.com>
 * @license   GPL-2.0+
 * @link      http://alpineinternet.com
 * @copyright 2013 Alpine Internet Solutions, Inc.
 */
?>



<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<form method="post" action="options.php"> 

	<?php settings_fields( 'rbfoption-group' ); ?>
	
	<?php do_settings_sections( 'myoption-group' ); ?>

	<p>Really big files are a headache.  They usually exceed the upload limits of your web server.  The Really Big Files plugin 
		uses the Transloadit service to provide a convenient uploader and URL generator for your Really Big Files.
		Transloadit handles the file uploading, conversion & other processing for your website or app. They can 
		process video, audio, images and documents.
	</p>
	<p>To get started, visit <a href="https://transloadit.com/">transloadit.com</a>, create an account and a template.  
		Come back here with your <a href="https://transloadit.com/accounts/credentials">auth key</a> and 
		<a href="https://transloadit.com/templates">template id</a>.  Plug them in here and upload some Really Big Files. 
	</p>
	<p>Single files are really just the start, have a look at the Transloadit <a href="https://transloadit.com/demos">Demos</a> page
	for more Really Big Files procesing ideas.
	</p>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Your Transloadit auth key:</th>
        <td><input type="text" name="transloadit_authkey" value="<?php echo get_option('transloadit_authkey'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Transloadit Template ID:</th>
        <td><input type="text" name="transloadit_templateid" value="<?php echo get_option('transloadit_templateid'); ?>" /></td>
        </tr>
    </table>

	<?php submit_button(); ?>
	</form>

</div>
