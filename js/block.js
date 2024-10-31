function Close_Block(post_most_id){
	if (document.getElementById('blocked'))		{
			document.getElementById('blocked').id = 'no_blocked';
		};
	if (post_most_id) {
			block_post_content_off_js(post_most_id);
		};
	
	return false;
	};
	/*timer count and end function*/
function ptpt_timer_js_counting(timer_count,u_post_id){
	setTimeout(function js_block_timer_count(){
		document.getElementById('ptpl_timer').innerHTML=(timer_count);
		timer_count--;
		tes=timer_count;
		if (tes>=0){
			ptpt_timer_js(timer_count,u_post_id)
		}
		else {Close_Block(u_post_id)
		}
		
	}
	,1000,timer_count,u_post_id)
}
function ptpt_timer_js(tes,post_id){
	ptpt_timer_js_counting(tes,post_id);
}
function block_post_content_js(is_post_id){
	var ay_es_meky='post-'+is_post_id;
	document.getElementById(ay_es_meky).style.visibility='hidden'
}
function block_post_content_off_js(is_post_id_off){
	var ay_henc_es='post-'+is_post_id_off
	document.getElementById(ay_henc_es).style.visibility='visible'
}
	
	
