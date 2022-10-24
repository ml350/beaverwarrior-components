<?php 
add_action('init', function(){
    if(class_exists("FlBuilder")){
        require_once "bw-podcastfeed/bw-podcastfeed.php";
    }
}, 15);