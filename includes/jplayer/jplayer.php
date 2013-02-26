<?php

/**
 * Enqueue jPlayer script
 */
function mp_jplayer_enqueue_jplayer_script(){
	//jplayer
	wp_enqueue_script('mp_jplayer', plugins_url('js/jquery.jplayer.min.js', dirname(__FILE__)),  array( 'jquery') );
	
	//jplayer playlist addon
	wp_enqueue_script('mp_jplayer_playlist', plugins_url('js/jplayer.playlist.min.js', dirname(__FILE__)),  array( 'jquery', 'mp_jplayer') );
	
	//Filter or set default skin for jplayer 
	$jplayer_skin_location = has_filter('mp_jplayer_skin_location') ? apply_filters( 'mp_jplayer_skin_location', $first_output) : plugins_url('css/jplayer-mp-core-skin.css', dirname(__FILE__));
	
	//Enqueue skin for jplayer
	wp_enqueue_style('mp_jplayer_mp_jplayer_skin', $jplayer_skin_location);
	
	//Filter or set default skin for jplayer 
	$jplayer_font_location = has_filter('mp_jplayer_font_location') ? apply_filters( 'mp_jplayer_font_location', $first_output) : plugins_url('css/jplayer-mp-core-icon-font.css', dirname(__FILE__));
	
	//Icon font for jplayer 
	wp_enqueue_style('mp_jplayer_mp_jplayer_icon_font', $jplayer_font_location);
	
}
add_action('wp_enqueue_scripts', 'mp_jplayer_enqueue_jplayer_script');

/**
 * Jquery for new player
 */
function mp_jplayer($post_id, $content){
	
	//If the $content variable isn't an array
	if (!is_array($content)){
		$medias = get_post_meta( $post_id, $content, $single = true );
	}
	//If the $content variable IS an array
	else{
		$medias = $content;	
	}
	
	//Set supplied array to empty array
	$supplied = array();
	
	/**
	 * Output Jquery and HTML for new player
	 */
	 
	?>
	<script type="text/javascript">

	//<![CDATA[
	
	jQuery(document).ready(function(){
	
		new jPlayerPlaylist({
	
			jPlayer: "#<?php echo $post_id; ?>_jquery_jplayer",
	
			cssSelectorAncestor: "#<?php echo $post_id; ?>_jp_container"
	
		}, [
	
		<?php 
		
		foreach ($medias as $media){
			echo '{';
				foreach ($media as $media_key => $media_item){
					/**
					 * When creating your metabox
					 * Media keys (field_ids) should be named after what they represent
					 * EG: title, poster, artist, m4v, ogv, webmv
					 */
					echo !empty($media_item) ? $media_key . ':"' . $media_item . '",' : NULL;
					
					if (!in_array($media_key, $supplied) && !empty($media_item)){
						array_push($supplied, $media_key);
					}
				}
			echo '},';
		}
				
		?>
	
		], {
			swfPath: "<?php echo plugins_url( 'jplayer', dirname(__FILE__)); ?>",
			wmode: "window",
			supplied: "<?php 
			$counter = 1;
			foreach ($supplied as $supply){
					echo $counter > 1 ? ',' : NULL;
					$counter = $counter+1;
					echo $supply;
			}?>"

		});
	
	});
	
	//]]>
	
	</script>
	<div id="<?php echo $post_id; ?>_jp_container" class="jp-video jp-video-270p">

			<div class="jp-type-playlist">
				
               
				<div id="<?php echo $post_id; ?>_jquery_jplayer" class="jp-jplayer" <?php echo in_array('m4v', $supplied) ? 'style="display:block;"' : 'style="display:none;"'; ?>></div>
			
				<div class="jp-gui">

					<div class="jp-video-play">

						<a href="javascript:;" class="jp-video-play-icon icon-play" tabindex="1"></a>

					</div>

					<div class="jp-interface">

						<div class="jp-current-time"></div>

						<div class="jp-duration"></div>

						<div class="jp-controls-holder">

							<ul class="jp-controls">
								<!--previous-->
								<li><a href="javascript:;" class="jp-previous icon-to-start" tabindex="1"></a></li>
								<!--play-->
								<li><a href="javascript:;" class="jp-play icon-play" tabindex="1"></a></li>
								<!--pause-->
								<li><a href="javascript:;" class="jp-pause icon-pause" tabindex="1"></a></li>
								<!--next-->
								<li><a href="javascript:;" class="jp-next icon-to-end" tabindex="1"></a></li>
								<!--stop-->
								<li><a href="javascript:;" class="jp-stop icon-stop" tabindex="1"></a></li>
								<!--mute-->
								<li><a href="javascript:;" class="jp-mute icon-volume-off" tabindex="1" title="mute"></a></li>
								<!--unmute-->
								<li><a href="javascript:;" class="jp-unmute icon-volume-up" tabindex="1" title="unmute"></a></li>
                                
								<?php 
								//If there is more than 1 track
								if (is_array($medias) && count($medias) > 1){?>
                                    <!--shuffle-->
                                    <li><a href="javascript:;" class="jp-shuffle icon-shuffle" tabindex="1" title="shuffle"></a></li>
                                    <!--shuffle off-->
                                    <li><a href="javascript:;" class="jp-shuffle-off icon-shuffle shuffle-off" tabindex="1" title="shuffle off"></a></li>
                                    <!--repeat-->
                                    <li><a href="javascript:;" class="jp-repeat icon-loop" tabindex="1" title="repeat"></a></li>
                                    <!--repeat off-->
                                    <li><a href="javascript:;" class="jp-repeat-off icon-loop loop-off" tabindex="1" title="repeat off"></a></li>
								<?php } ?>
                                
							</ul>
                            
                            <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            
                            <ul class="jp-toggles">
                            <?php if (in_array('m4v', $supplied)){?>
								<!--full screen-->
								<li><a href="javascript:;" class="jp-full-screen icon-resize-full-alt" tabindex="1" title="full screen" ></a></li>
								<!--restore screen-->
								<li><a href="javascript:;" class="jp-restore-screen icon-resize-small" tabindex="1" title="restore screen"></a></li>
                            <?php } ?>
							</ul>

							<div class="jp-volume-bar">

								<div class="jp-volume-bar-value"></div>

							</div>

						</div>

						<div class="jp-title">

							<ul>

								<li></li>

							</ul>

						</div>

					</div>

				</div>
	
				<div class="jp-playlist" <?php echo !is_array($medias) || count($medias) == 1 ? 'style="display:none"' : NULL; ?>>

					<ul>

						<!-- The method Playlist.displayPlaylist() uses this unordered list -->

						<li></li>

					</ul>

				</div>

				<div class="jp-no-solution">

					<span>Update Required</span>

					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.

				</div>

			</div>

		</div>

    <?php
}