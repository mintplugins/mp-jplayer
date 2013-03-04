<?php
/**
 * Shortcode which is used by our custom page to embed the player and nothing else on a page
 */
function mp_jplayer_embed_page_shortcode( $atts ) {
	
	//sanitize ID 
	$post_id = sanitize_text_field($_GET['id']);
	
	//sanitize slug
	$slug = sanitize_text_field($_GET['slug']);
	
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
	mp_jplayer($post_id, $slug);
	echo '</div>';
			
	//Return
	return $html_output;
}
add_shortcode( 'mp_jplayer_embed_page_shortcode', 'mp_jplayer_embed_page_shortcode' );