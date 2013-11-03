<?php
/**
 * Represents the view for the bigfiles dashboard.
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

	<h3>Upload New Really Big File</h3>
	<div style="margin-bottom:10px;">
	<form id="BigFilesForm" action="" enctype="multipart/form-data" method="POST">

	  <input type="file" name="bigfile" />
	  <input type="submit" value="Upload" class="button">
	</form>
	<p>Really big files are a headache.  They usually exceed the upload limits of your web server.  RBF 
		uses the Transloadit service to provide a convenient uploader and URL generator for your Really Big Files.
		Transloadit handles the file uploading, conversion & other processing for your website or app. They can 
		process video, audio, images and documents.
	</p>
	</div>
	<?php
	
		// Handle the uploaded file.  Store it as a custom post type?

		global $wpdb;

		$table_name = $wpdb->prefix . "reallybigfiles";
		
		if ( isset( $_POST['transloadit'] ) ) {
			
			$transloaditData = stripslashes_deep($_POST['transloadit']);
			$transloaditData = json_decode($transloaditData, true);

			foreach ($transloaditData['results'] as $encodingResult) {
			  foreach ( $encodingResult as $fidx => $finfo ) {

					$data = array(
							'name' => $finfo['name'],
							'size' => $finfo['size'],
							'mime' => $finfo['mime'],
							'ext' => $finfo['ext'],
							'type' => $finfo['type'],
							'url' => $finfo['url'],
							'time' => current_time('mysql', 1),
							'meta' => json_encode( $finfo['meta'] )
						);
						
					$wpdb->insert( $table_name, $data ); 

			   }

			  
			}

		}


		// Get the list of the 50 most recent uploads here.
		$sql = 'SELECT * FROM  ' . $table_name . ' ORDER BY time DESC LIMIT 0 , 100';
		$result = $wpdb->get_results ( $sql );

		if ( isset( $result ) && !empty( $result )) { 
				
			print "<h4>Really Big Files</h4>";
	
			print "<div style='margin-top:10px;'>";
			print '<table class="wp-list-table widefat fixed">' 
					. '<thead><th class="manage-column column-cb">Filename</th>'
					. '<th class="manage-column column-cb">Size</th>' 
					. '<th class="manage-column column-cb">Type</th>' 
					. '<th class="manage-column column-cb">Uploaded</th>' 
				. '</thead><tbody>';
	
			foreach ( $result as $print )   {
	
				print '<tr class="status-publish hentry iedit">';
	
				print '<td><b>' . $print->name . '</b></td>';
				print '<td><b>' . $print->size . '</td>';
				print '<td><b>' . $print->mime . '</td>';
				print '<td><b>' . $print->time . '</td>';
	
				print '</tr>';
	
				print '<tr class="status-publish hentry alternate iedit">';
				print '<td colspan="4"><b>uri:</b> ' . $print->url .  ' <a href="' . $print->url 
							.  '" target="_blank">&gt;&gt;</a></td>';
				print '</tr>';
	
			}
	
			print '</tbody></table>';
			print "</div>";
			
		}
		

	
	?>

</div>

<script type="text/javascript">

(function ( $ ) {
	"use strict";

	$(function () {

		// Place your administration-specific JavaScript here
	     $('#BigFilesForm').transloadit({
	        wait: true,
	        params: {
	          auth: {key: "<?php echo get_option('transloadit_authkey'); ?>"},
	          template_id: "<?php echo get_option('transloadit_templateid'); ?>"
	          }
	        }
	     );		
	
	});

}(jQuery));

</script>