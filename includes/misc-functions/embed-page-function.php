<?php
/**
 * Shortcode which is used by our custom page to embed the player and nothing else on a page
 */
function mp_jplayer_embed_page( $atts ) {
	
	
	$jplayer_embed = isset($_GET['jplayer_embed']) ? $_GET['jplayer_embed'] : NULL;
	
	if ($jplayer_embed == true){
		
		//sanitize ID 
		$post_id = get_the_id();
		
		//sanitize slug
		$slug = get_post_meta($post_id, 'jplayer', true);
		
		//Move the player outside the body
		?>
		<script type="application/javascript">
		jQuery(document).ready(function($){
		
		   $('#mp_embedable_video').insertAfter('body');
			
		});
		</script>
		<?php
		
		//CSS - hide everything in the body
		echo '<style scoped>';
		echo 'body{display:none;}';
		echo '.jp-toggles{display:none;}';
		echo '</style>';
		
		//Display Player
		echo '<div id="mp_embedable_video">';
		echo mp_jplayer($post_id, $slug);
		echo '</div>';
		
		exit;
	}
}
add_action( 'loop_start', 'mp_jplayer_embed_page' );