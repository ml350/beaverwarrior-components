<?php
add_action('init', function(){
	if(class_exists('FlBuilder')){
		require_once "bw-category-feed/bw-category-feed.php";
	}
}, 15);

register_custom_image_size( 'select_category_image', 50, 50, true );