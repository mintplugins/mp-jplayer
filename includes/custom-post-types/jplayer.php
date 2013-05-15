<?php
/**
 * Custom Post Types
 *
 * @package mp_jplayer
 * @since mp_jplayer 1.0
 */

/**
 * jPlayer Custom Post Type
 */
function mp_jplayer_post_type() {
	
	if (mp_core_get_option( 'mp_jplayer_settings_general',  'enable_disable' ) != 'disabled' ){
		$slide_labels =  apply_filters( 'mp_jplayer_slide_labels', array(
			'name' 				=> 'jPlayers',
			'singular_name' 	=> 'jPlayer Item',
			'add_new' 			=> __('Add New', 'mp_jplayer'),
			'add_new_item' 		=> __('Add New jPlayer', 'mp_jplayer'),
			'edit_item' 		=> __('Edit jPlayer', 'mp_jplayer'),
			'new_item' 			=> __('New jPlayer', 'mp_jplayer'),
			'all_items' 		=> __('All jPlayers', 'mp_jplayer'),
			'view_item' 		=> __('View jPlayers', 'mp_jplayer'),
			'search_items' 		=> __('Search jPlayers', 'mp_jplayer'),
			'not_found' 		=>  __('No jPlayers found', 'mp_jplayer'),
			'not_found_in_trash'=> __('No jPlayers found in Trash', 'mp_jplayer'), 
			'parent_item_colon' => '',
			'menu_name' 		=> __('jPlayers', 'mp_jplayer')
		) );
		
			
		$slide_args = array(
			'labels' 			=> $slide_labels,
			'public' 			=> true,
			'publicly_queryable'=> true,
			'show_ui' 			=> true, 
			'show_in_menu' 		=> true, 
			'show_in_nav_menus' => false,
			'menu_position'		=> 5,
			'query_var' 		=> true,
			'rewrite' 			=> array( 'slug' => 'jplayer' ),
			'capability_type' 	=> 'post',
			'has_archive' 		=> true, 
			'hierarchical' 		=> false,
			'supports' 			=> apply_filters('mp_jplayer_slide_supports', array( 'title' ) ),
		); 
		register_post_type( 'mp_jplayer', apply_filters( 'mp_jplayer_slide_post_type_args', $slide_args ) );
	}
}
add_action( 'init', 'mp_jplayer_post_type', 0 );

/**
 * jPlayer Taxonomy
 */
 
 /**
 * jPlayer Cat taxonomy
 */
function mp_jplayer_taxonomy() {  
	if (mp_core_get_option( 'mp_jplayer_settings_general',  'enable_disable' ) != 'disabled' ){
		
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'                => __( 'jPlayer Groups', 'mp_core' ),
			'singular_name'       => __( 'jPlayer Group', 'mp_core' ),
			'search_items'        => __( 'Search jPlayer Groups', 'mp_core' ),
			'all_items'           => __( 'All jPlayer Groups', 'mp_core' ),
			'parent_item'         => __( 'Parent jPlayer Group', 'mp_core' ),
			'parent_item_colon'   => __( 'Parent jPlayer Group:', 'mp_core' ),
			'edit_item'           => __( 'Edit jPlayer Group', 'mp_core' ), 
			'update_item'         => __( 'Update jPlayer Group', 'mp_core' ),
			'add_new_item'        => __( 'Add New jPlayer Group', 'mp_core' ),
			'new_item_name'       => __( 'New jPlayer Group Name', 'mp_core' ),
			'menu_name'           => __( 'jPlayer Groups', 'mp_core' ),
		); 	
  
		register_taxonomy(  
			'mp_jplayer_groups',  
			'mp_jplayer',  
			array(  
				'hierarchical' => true,  
				'label' => 'jPlayer Groups',  
				'labels' => $labels,  
				'query_var' => true,  
				'with_front' => false, 
				'rewrite' => array('slug' => 'jPlayers')  
			)  
		);  
	}
}  
add_action( 'init', 'mp_jplayer_taxonomy' );  