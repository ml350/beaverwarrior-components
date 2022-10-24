<?php
add_action ('init', function(){
    if (class_exists("FlBuilder")) {
        require_once "bw-categories/bw-categories.php";
    }

}, 15);


