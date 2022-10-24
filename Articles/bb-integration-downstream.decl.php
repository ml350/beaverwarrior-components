<?php 
add_action('init', function(){
    if(class_exists("FlBuilder")){
        require_once "bw-articles/bw-articles.php";
    }
}, 15);