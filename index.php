<?php
/*
Plugin Name: PTPL post block
Plugin URI: http://www.brainupquiz.com
Description: "PTPL post block" is plugin that blocks your post content, and unlock blocking mode, when visitor like your link on facebook or wait any time what you want. You can add any link to any post for like. So you use one plugin and promoting many pages and links on facebook.
Version: 1.1.0
Author: PTuruz
Author URI: http://www.brainupquiz.com
*/ 
require_once('functions.php');
require_once('settings.php');

/*call blocker function*/

	add_filter( 'the_content', 'check_block_status' );

/*
$isFan = file_get_contents('https://graph.facebook.com/PTuruz');
*/
?>
