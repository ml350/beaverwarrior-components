<?php
add_action ('init', function(){
    if (class_exists("FlBuilder")) {
        require_once "ArticleSingleInfo/bw-article-single-info/bw-article-single-info.php";
        require_once "ArticleSingleHeaderInfo/bw-article-single-header-info/bw-article-single-header-info.php";
        require_once "ArticleSingleHeaderImg/bw-article-single-header-img/bw-article-single-header-img.php";
    }

}, 15);

