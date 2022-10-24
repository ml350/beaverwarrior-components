<?php 
add_action('init', function(){
    if(class_exists("FlBuilder")){
        require_once "bw-related-episodes/bw-related-episodes.php";
    }
}, 15);