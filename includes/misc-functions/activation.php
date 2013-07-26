<?php
/**
 * Activation Hook for jPlayer
 * CURRENTLY DISABLED AND NOT INCLUDED!!!
 */
function mp_jplayer_activate(){
	
	//Create embed page for jplayer
	mp_jplayer_create_embed_page();	
	
}

/**
 * Create embed page for jplayer
 */
function mp_jplayer_create_embed_page(){
	$mp_jplayer_embed_page_args = array(
	  'post_title'    => 'jPlayer Embed Page',
	  'post_content'  => '[mp_jplayer_embed_page_shortcode]',
	  'post_status'   => 'publish',
	  'post_author'   => 1,
	  'post_type'     => 'page'
	);
		
	// Insert the post into the database
	$mp_jplayer_embed_page_id = wp_insert_post( $mp_jplayer_embed_page_args );
	
	// Insert this page id in the database so we can use it later
	if (isset($mp_jplayer_embed_page_id)){
		update_option( 'mp_jplayer_embed_page_id', $mp_jplayer_embed_page_id );
	}
}