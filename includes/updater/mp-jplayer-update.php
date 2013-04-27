<?php
/**
 * Check for updates for this Theme
 *
 */
 if (!function_exists('mp_jplayer_update')){
	function mp_jplayer_update() {
		$args = array(
			'software_name' => 'MP JPlayer', //<- The exact name of this Plugin. Make sure it matches the title in your mp_repo, edd, and the WP.org repo
			'software_api_url' => 'http://moveplugins.com',//The URL where EDD and mp_repo are installed and checked
			'software_filename' => 'mp-jplayer.php',
			'software_licenced' => false, //<-Boolean
		);
		
		//Since this is a theme, call the Plugin Updater class
		$mp_jplayer_plugin_updater = new MP_CORE_Plugin_Updater($args);
	}
 }
add_action( 'init', 'mp_jplayer_update' );
