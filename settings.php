<?php
//PTPL plugin settings menu

//add settings item in dashboard menu
add_action('admin_menu', 'pt_fb_create_menu');
function pt_fb_create_menu() {
	//create new top-level menu
	echo("<div class='pt_set_menu'>");
	add_menu_page('PTPL Plugin Settings', 'PTPL Settings', 'administrator', __FILE__, 'pt_fb_settings_page',plugins_url('/images/setting_icon.png', __FILE__));
 	echo("</div>");
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

//add settings option in plugin settings panel
function register_mysettings() {
	//register settings
	register_setting( 'ptpl_settings-group', 'ptpl_block_is_active' );
	register_setting( 'ptpl_settings-group', 'ptpl_fb_like_timer' );
	register_setting( 'ptpl_settings-group', 'ptpl_fb_like_message' );
	register_setting( 'ptpl_settings-group', 'ptpl_fb_like_page_url' );
	register_setting( 'ptpl_settings-group', 'ptpl_fb_like_multi_mode' );
	register_setting( 'ptpl_settings-group', 'ptpl_block_close' );
	register_setting( 'ptpl_settings-group', 'ptpl_google_plus_page_url' );
	register_setting( 'ptpl_settings-group', 'ptpl_google_plus_multi_mode' );
	register_setting( 'ptpl_settings-group', 'ptpl_google_plus_on_off' );
	register_setting( 'ptpl_settings-group', 'ptpl_fb_like_on_off' );
	

}
function pt_fb_settings_page() {
?>
<div class="wrap">
<h2>PTPL plugin settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'ptpl_settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Activate Blocking mode</th>
        <!--  Adding blocking status change checkbox-->
        <td><input type="checkbox" name="ptpl_block_is_active" value="1" 
        <?php checked( '1', get_option( 'ptpl_block_is_active' ) ); ?> />
        <span class="description">Check if you want Eisable global blocking mode (only for posts)</span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Facebook like button</th>
        <!--  Enable/Disable fb like button -->
        <td><input type="checkbox" name="ptpl_fb_like_on_off" value="1" 
        <?php checked( '1', get_option( 'ptpl_fb_like_on_off' ) ); ?> />
        <span class="description">Check if you want Enable fb like button</span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Google plus +1 button</th>
        <!--  Enable/Disable Google plus +1 button -->
        <td><input type="checkbox" name="ptpl_google_plus_on_off" value="1" 
        <?php checked( '1', get_option( 'ptpl_google_plus_on_off' ) ); ?> />
        <span class="description">Check if you want Enable Google plus +1 button</span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Enable multipage like mode</th>
        <!--  Add custom facebook like url under all posts-->
        <td><input type="checkbox" name="ptpl_fb_like_multi_mode" value="1" 
        <?php checked( '1', get_option( 'ptpl_fb_like_multi_mode' ) ); ?> />
        <span class="description">Check, if you want to add different like url's for any posts  </span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Enable multipage google plus +1  mode</th>
        <!--  Add custom google plus url under all posts-->
        <td><input type="checkbox" name="ptpl_google_plus_multi_mode" value="1" 
        <?php checked( '1', get_option( 'ptpl_google_plus_multi_mode' ) ); ?> />
        <span class="description">Check if you want to add different google plus +1 url's for any posts  </span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Close button</th>
        <!--  Enable/Disable close button -->
        <td><input type="checkbox" name="ptpl_block_close" value="1" 
        <?php checked( '1', get_option( 'ptpl_block_close' ) )?> />
        <span class="description">Enable/Disable close button  </span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Page url for Faceebok</th>
        <!--  Adding facebook like page url-->
        <td><input type="text" id="ptpl_fb_like_page_url" name="ptpl_fb_like_page_url"value="<?php echo get_option('ptpl_fb_like_page_url'); ?>" />
        <span class="description"></br> Example https://facbook.com/brainupquiz  </br> Example http://www.brainupquiz.com </span>
        </td>
        </tr>
        
          <tr valign="top">
        <th scope="row">Page url for Google plus</th>
        <!--  Adding google plus +1  page url-->
        <td><input type="text" id="ptpl_google_plus_page_url" name="ptpl_google_plus_page_url"value="<?php echo get_option('ptpl_google_plus_page_url'); ?>" />
        <span class="description"></br> </br> Example http://www.brainupquiz.com </span>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Time lock (in seconds)</th>
        <!--  Adding facebook like blocking time (in seconds)-->
        <td><input type="number" id="ptpl_fb_like_timer" maxlength="3" max="600" name="ptpl_fb_like_timer" 
        value="<?php echo get_option('ptpl_fb_like_timer'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Block message</th>
        <!--  Adding facebook like blocking message-->
        <td>
        <textarea rows="3" id="ptpl_fb_like_message" name="ptpl_fb_like_message" /> <?php echo get_option('ptpl_fb_like_message'); ?>
        </textarea>
         <span class="description"></br> Message, that users see in blocked page </span>
        </td>
        </tr>
        
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
    </p>

</form>
</div>
<?php } ?>