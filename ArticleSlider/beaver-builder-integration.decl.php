<?php
add_action('init', function(){
	if(class_exists('FlBuilder')){
		require_once "bw-article-slider/bw-article-slider.php";
	}
}, 15);