<?php
// Load the plugin stylesheets for admin panel
function ptpl_wp_admin_style() {
        wp_register_style( 'ptpl_wp_admin_css', plugins_url() . '/ptpl-post-block/styles/admin.css', false, '' );
        wp_enqueue_style( 'ptpl_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'ptpl_wp_admin_style' );
// Load the plugin stylesheets and scripts for user panel
function ptpl_wp_user_style() {
        wp_register_style( 'ptpl_wp_user_css', plugins_url() . '/ptpl-post-block/styles/style.css', false, '' );
        wp_enqueue_style( 'ptpl_wp_user_css' );
        wp_enqueue_script( 'ptpl_wp_user_js', plugins_url() . '/ptpl-post-block/js/block.js');
		

}
add_action( 'wp_enqueue_scripts', 'ptpl_wp_user_style' );

/*blocker*/
function check_block_status($content) 
 {
	 if (get_post_type(get_the_ID())=='post' and is_single())
	 		{
				 if (get_post_meta(get_the_ID(), 'ptpl_content_block_for_this_post', true)=='inherit' or !get_post_meta(get_the_ID(), 'ptpl_content_block_for_this_post', true))
						{
							if ( get_option( 'ptpl_block_is_active' )==1    )
								{
										$block_this_post_content=1;return (adding_block( $content ));
								}
							else  $block_this_post_content=0; return $content;
						}
				else if (get_post_meta(get_the_ID(), 'ptpl_content_block_for_this_post', true)=='on')
						{
							$block_this_post_content=1;return (adding_block( $content ));
						}
				else  	{
						$block_this_post_content=0; return $content;
						}

				
			}
		else return $content;
		
 }

function adding_block( $content ){
	
		block_poost_content(get_the_ID());
	  	$content = ucwords($content).blocked_text();
		block_timer_count(get_option('ptpl_fb_like_timer'),get_the_ID());
	  	return $content;
	}


function blocked_text()
{
	if (get_option("ptpl_fb_like_multi_mode")!=1 || get_post_meta(get_the_ID(), 'ptpl_embed_facebook_like', true)==''){
			$like_url=get_option("ptpl_fb_like_page_url");	
	}
	else {
		$like_url=get_post_meta(get_the_ID(), 'ptpl_embed_facebook_like', true);
	 } 
	if (get_option("ptpl_google_plus_multi_mode")!=1 || get_post_meta(get_the_ID(), 'ptpl_embed_google_plus', true)==''){
			$plus_url=get_option("ptpl_google_plus_page_url");
	}
	else {
		$plus_url=get_post_meta(get_the_ID(), 'ptpl_embed_google_plus', true);
	 }	 
	 
	 
	 
echo ('<div id="blocked" >
</br>
<div class="blocked_message">
	<div class="block_text_area">'.get_option("ptpl_fb_like_message").'</div>
	<div class="ptpl_buttons" >
	<table class="buttons_table"><tr>
		');
/*check fb like button status for this post*/
$show_fb_on_this_post=0;
if (get_post_meta(get_the_ID(), 'ptpl_fb_like_post_status', true)=='inherit' or !get_post_meta(get_the_ID(), 'ptpl_fb_like_post_status', true)) 
	{
		if (get_option("ptpl_fb_like_on_off")==1) 
			{
				$show_fb_on_this_post=1;	
			}
		else 
			{
				$show_fb_on_this_post=0;
			}
	}
else if (get_post_meta(get_the_ID(), 'ptpl_fb_like_post_status', true)=='on')
	{
		$show_fb_on_this_post=1;	
	}

/*check google plus button status for this post*/
$show_google_plus_on_this_post=0;
if (get_post_meta(get_the_ID(), 'ptpl_google_plus_post_status', true)=='inherit' or !get_post_meta(get_the_ID(), 'ptpl_google_plus_post_status', true) ) 
	{
		if (get_option("ptpl_google_plus_on_off")==1) 
			{
				$show_google_plus_on_this_post=1;	
			}
		else 
			{
				$show_google_plus_on_this_post=0;
			}
	}
else if (get_post_meta(get_the_ID(), 'ptpl_google_plus_post_status', true)=='on')
	{
		$show_google_plus_on_this_post=1;	
	}

/*add fb like button */
	
	
if ($show_fb_on_this_post==1) {
	
	
echo(' <td>		
<div class="fb_like_cube"> 
	<fb:like href="'.$like_url.'" layout="button" action="like" show_faces="false" share="false" kid_directed_site="false"></fb:like>
  	<div id="fb-root"></div>
 	<script src="https://connect.facebook.net/en_US/all.js#xfbml=1"></script>
  	<script>
   		FB.Event.subscribe("edge.create",
    		function(response) {
        		Close_Block('.get_the_ID().')
   			}
		);
		</script>
	</div></td>' );
}
/*add google plus button*/
if ($show_google_plus_on_this_post==1) {	
echo ('
<script src="https://apis.google.com/js/platform.js" async defer></script>
<td><div class="google_plus_share_cube" >
	<script type="text/javascript">
  		(
		function() 
			{
    		var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    		po.src = "https://apis.google.com/js/plusone.js";
    		var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  			}
		)();
	</script>

	<g:plusone size="medium" annotation="none" callback="google_plus_event"  recommendations="false" href="'.$plus_url.'"></g:plusone>
	<script>
		window.___gcfg = 
			{
  			lang: "en-US",
  			parsetags: "onload"
			};
	</script>
</div></td>'); }

/*get goolge plus event */
echo(	'<script>
			function google_plus_event(jsonParam) {
													
														if (jsonParam.state=="on")
														{
															Close_Block('.get_the_ID().')
														};
													};
		</script>');	
		
function close_button(){
$close_button_status=0;
if (get_post_meta(get_the_ID(), 'ptpl_content_block_close_button_for_this_post', true)=='inherit' or !get_post_meta(get_the_ID(), 'ptpl_content_block_close_button_for_this_post', true) )
		{
			if (get_option("ptpl_block_close")==1)
					{
						$close_button_status=1;
					}
			else {$close_button_status=0;}
		}
		
else if (get_post_meta(get_the_ID(), 'ptpl_content_block_close_button_for_this_post', true)=='on'){$close_button_status=1;}
return $close_button_status;
};
if ( close_button()==1 )
	echo ('<td><a title="Close" href="#" class="block_close" onclick="Close_Block('.get_the_ID().')" >X</a></td>');
else echo ('<td><span class="block_close" >OR</span></td>'); 

/*add timemr*/
echo ('<td><div id="ptpl_timer"></div></td>

</tr></table>
</div> ');


echo ('</div></div>');
}
function block_timer_count($current_timer,$esi_post_idna){
	echo '	<script type="text/javascript">
   				ptpt_timer_js('.$current_timer.','.$esi_post_idna.');
   			</script>';
};
function block_poost_content($current_post_id) {
	echo '<script type="text/javascript">
   			block_post_content_js('.$current_post_id.');
   			</script>';
};
require_once('fields.php');

?>