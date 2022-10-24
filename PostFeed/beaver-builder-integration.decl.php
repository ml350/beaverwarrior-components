<?php
add_action('init', function(){
	if(class_exists('FlBuilder')){
		require_once "bw-post-feed/bw-post-feed.php";
	}
}, 15);