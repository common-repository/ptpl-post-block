<?php /*add meta boxes facebook link for any post*/
function add_embed_ptpl_meta_box() {
    add_meta_box(
        'ptpl', // $id
        'PTPL fields', // $title
        'show_embed_ptplp_meta_box', // $callback
        'post', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_embed_ptpl_meta_box');

function show_embed_ptplp_meta_box() {
    global $post;  
        $meta_facebook_under_post_link = get_post_meta($post->ID, 'ptpl_embed_facebook_like', true);  
		$meta_google_plus_under_post_link =get_post_meta($post->ID, 'ptpl_embed_google_plus', true);
		$meta_google_plus_under_post_status =get_post_meta($post->ID, 'ptpl_google_plus_post_status', true); 
		$meta_fb_like_under_post_status =get_post_meta($post->ID, 'ptpl_fb_like_post_status', true); 
		$meta_block_mode_for_this_post =get_post_meta($post->ID, 'ptpl_content_block_for_this_post', true); 
		$meta_block_close_mode_for_this_post =get_post_meta($post->ID, 'ptpl_content_block_close_button_for_this_post', true); 
		
	
    // Use nonce for verification  
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
   
   echo '<table class="form-table">';   
        // begin a table row with
        
        echo '<tr>
            <th><label for="ptpl_embed_facebook_like">Embed Facebook link</label></th>
            <td><input style="width: 100%;" name="ptpl_embed_facebook_like" id="ptpl_embed_facebook_like" value="'.$meta_facebook_under_post_link.'"/>
		        <span class="description"></br>Use to embed facebook like link on your post, or levae it blank to recover the global settings</br>(Example https://facebook.com/brainupquiz)</span></td>
            </tr>
			<tr>
            <th><label for="ptpl_embed_google_plus">Embed Goole plus +1 link</label></th>
            <td><input style="width: 100%;" name="ptpl_embed_google_plus" id="ptpl_embed_google_plus" value="'.$meta_google_plus_under_post_link.'"/>
		        <span class="description"></br>Use to embed Google plus +1 link on your post, or levae it blank to recover the global settings </br>(Example http://www.brainupquiz.com)</span></td>
            </tr>
			<tr>
            	<th><label for="ptpl_content_block_close_button_for_this_post">Close button</label></th>
            	<td>
					<select name="ptpl_content_block_close_button_for_this_post" value="'.$meta_block_close_mode_for_this_post.'">
  						<option '; 	if ($meta_block_close_mode_for_this_post==on){echo (' selected ');};  echo 'value="on">On</option>
  						<option '; 	if ($meta_block_close_mode_for_this_post==off){echo (' selected ');};  echo 'value="off">Off</option>
						<option '; 	if ($meta_block_close_mode_for_this_post==inherit  or !($meta_block_close_mode_for_this_pos)){echo (' selected ');};  echo 'value="inherit">Inherit</option>

					</select>
		        <span class="description">Enable close button for this post</span></td>
				</td>
            </tr>
			<tr>
            	<th><label for="ptpl_content_block_for_this_post">Block this post content</label></th>
            	<td>
					<select name="ptpl_content_block_for_this_post" value="'.$meta_block_mode_for_this_post.'">
  						<option '; 	if ($meta_block_mode_for_this_post==on){echo (' selected ');};  echo 'value="on">On</option>
  						<option '; 	if ($meta_block_mode_for_this_post==off ){echo (' selected ');};  echo 'value="off">Off</option>
  						<option '; 	if ($meta_block_mode_for_this_post==inherit or !($meta_block_mode_for_this_post)){echo (' selected ');};  echo 'value="inherit">Inherit</option>
					</select>
		    	   	<span class="description">Enable blocking mode for this post </span>
				</td>
            </tr>
			<tr>
            	<th><label for="ptpl_google_plus_post_status">Goole plus +1 button status</label></th>
            	<td>
					<select name="ptpl_google_plus_post_status" value="'.$meta_google_plus_under_post_status.'">
  						<option '; 	if ($meta_google_plus_under_post_status==on){echo (' selected ');};  echo 'value="on">On</option>
  						<option '; 	if ($meta_google_plus_under_post_status==off ){echo (' selected ');};  echo 'value="off">Off</option>
  						<option '; 	if ($meta_google_plus_under_post_status==inherit or !($meta_google_plus_under_post_status)){echo (' selected ');};  echo 'value="inherit">Inherit</option>
					</select>
		    	   	<span class="description">Enable Goole plus +1 button for this post </span>
				</td>
            </tr>
			<tr>
            	<th><label for="ptpl_fb_like_post_status">Facebook like button status</label></th>
            	<td>
					<select name="ptpl_fb_like_post_status" value="'.$meta_fb_like_under_post_status.'">
  						<option '; 	if ($meta_fb_like_under_post_status==on){echo (' selected ');};  echo 'value="on">On</option>
  						<option '; 	if ($meta_fb_like_under_post_status==off){echo (' selected ');};  echo 'value="off">Off</option>
  						<option '; 	if ($meta_fb_like_under_post_status==inherit  or !($meta_fb_like_under_post_status)){echo (' selected ');};  echo 'value="inherit">Inherit</option>
					</select>
		    	   	<span class="description">Enable Facebook like button for this post </span>
				</td>
            </tr>';
			
		
			
            
    echo '</table>';}
	
	
	/**************************************************************************
 * Save the meta fields on save of the post
 **************************************************************************/
function save_embed_ptpl_meta($post_id) {   
    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
        
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
        
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }  
    /*facebook like link under post*/ 
    $old_fb_under_post_link = get_post_meta($post_id, "ptpl_embed_facebook_like", true);
    
    $new_fb_under_post_link = $_POST["ptpl_embed_facebook_like"];

    if ($new_fb_under_post_link && $new_fb_under_post_link != $old_fb_under_post_link) {
        update_post_meta($post_id, "ptpl_embed_facebook_like", $new_fb_under_post_link);
    } elseif ('' == $new_fb_under_post_link && $old_fb_under_post_link) {
        delete_post_meta($post_id, "ptpl_embed_facebook_like", $old_fb_under_post_link);
    }
    /*google plus link under post*/
	$old_google_plus_under_post_link = get_post_meta($post_id, "ptpl_embed_google_plus", true);
    $new_google_plus_under_post_link = $_POST["ptpl_embed_google_plus"];
    if ($new_google_plus_under_post_link && $new_google_plus_under_post_link != $old_google_plus_under_post_link) {
        update_post_meta($post_id, "ptpl_embed_google_plus", $new_google_plus_under_post_link);
    } elseif ('' == $new_google_plus_under_post_link && $old_google_plus_under_post_link) {
        delete_post_meta($post_id, "ptpl_embed_google_plus", $old_google_plus_under_post_link);
    }	
	 /*google plus button under post*/
	$old_google_plus_under_post_status = get_post_meta($post_id, "ptpl_google_plus_post_status", true);
    $new_google_plus_under_post_status = $_POST["ptpl_google_plus_post_status"];
    if ($new_google_plus_under_post_status && $new_google_plus_under_post_status != $old_google_plus_under_post_status) {
        update_post_meta($post_id, "ptpl_google_plus_post_status", $new_google_plus_under_post_status);
    } elseif ('' == $new_google_plus_under_post_status && $old_google_plus_under_post_status) {
        delete_post_meta($post_id, "ptpl_google_plus_post_status", $old_google_plus_under_post_status);
    }
	 /*facebook like button under post*/
	$old_fb_like_under_post_status = get_post_meta($post_id, "ptpl_fb_like_post_status", true);
    $new_fb_like_under_post_status = $_POST["ptpl_fb_like_post_status"];
    if ($new_fb_like_under_post_status && $new_fb_like_under_post_status != $old_fb_like_under_post_status) {
        update_post_meta($post_id, "ptpl_fb_like_post_status", $new_fb_like_under_post_status);
    } elseif ('' == $new_fb_like_under_post_status && $old_fb_like_under_post_status) {
        delete_post_meta($post_id, "ptpl_fb_like_post_status", $old_fb_like_under_post_status);
    }
		 /*curren post blocking mode*/
	$old_content_block_for_this_post = get_post_meta($post_id, "ptpl_content_block_for_this_post", true);
    $new_content_block_for_this_post = $_POST["ptpl_content_block_for_this_post"];
    if ($new_content_block_for_this_post && $new_content_block_for_this_post != $old_content_block_for_this_post) {
        update_post_meta($post_id, "ptpl_content_block_for_this_post", $new_content_block_for_this_post);
    } elseif ('' == $new_fb_like_under_post_status && $old_content_block_for_this_post) {
        delete_post_meta($post_id, "ptpl_content_block_for_this_post", $old_content_block_for_this_post);
    }
	 /*close button curren post blocking mode*/
	$old_content_block_close_button_for_this_post = get_post_meta($post_id, "ptpl_content_block_close_button_for_this_post", true);
    $new_content_block_close_button_for_this_post = $_POST["ptpl_content_block_close_button_for_this_post"];
    if ($new_content_block_close_button_for_this_post && $new_content_block_close_button_for_this_post != $old_content_block_close_button_for_this_post) {
        update_post_meta($post_id, "ptpl_content_block_close_button_for_this_post", $new_content_block_close_button_for_this_post);
    } elseif ('' == $new_content_block_close_button_for_this_post && $old_content_block_close_button_for_this_post) {
        delete_post_meta($post_id, "ptpl_content_block_close_button_for_this_post", $old_content_block_close_button_for_this_post);
    }
	
}

    


add_action('save_post', 'save_embed_ptpl_meta');
 

/*end adding meta boxes*/
?>