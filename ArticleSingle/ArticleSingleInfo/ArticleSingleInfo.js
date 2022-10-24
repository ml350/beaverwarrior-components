/*global define, console, document, window*/
(function (root, factory) {
    "use strict";
    if (typeof define === 'function' && define.amd) {
        define("ArticleSingleInfo", ["jquery", "Behaviors"], factory);
    } else {
        root.ArticleSingleInfo = factory(root.jQuery, root.Behaviors);
    }
}(this, function ($, Behaviors) {
    "use strict";
    
    var module = {};

    function initStickyScroll(){
        if($('.ArticleSingleInfo-wrapper_sidebar').length){
            
            var headerHeight = $('header.siteheader').height()+30;
            var top = $('.ArticleSingleInfo-wrapper_sidebar').offset().top - headerHeight;
            var footTop = $('.more-like').offset().top - $('.more-like').outerHeight() + 130;
            var maxY = footTop - $('.ArticleSingleInfo-wrapper_sidebar').outerHeight();
            
            var lastScrollTop = 0;
            $(window).scroll(function(evt) {

                var y = $(this).scrollTop();

                if (y > top) {
                    
                    if (y > lastScrollTop){
                        // downscroll code
                        if (y < maxY) {
                            $('.ArticleSingleInfo-wrapper_sidebar').addClass('fixed')
                            $('.ArticleSingleInfo-wrapper_sidebar .fl-col-content').css({
                                position: 'fixed',
                                top: headerHeight + 'px'
                            });
                        } else {
                            $('.ArticleSingleInfo-wrapper_sidebar').removeClass('fixed');
                            $('.ArticleSingleInfo-wrapper_sidebar .fl-col-content').css({
                                position: 'absolute',
                                top: (maxY - top) + 'px'
                            });
                        }
                    } else {
                        // upscroll code
                        if (y < maxY && y > $('.fl-module-bw-article-single-info').offset().top ) {
                            $('.ArticleSingleInfo-wrapper_sidebar').addClass('fixed')
                            $('.ArticleSingleInfo-wrapper_sidebar .fl-col-content').css({
                                position: 'fixed',
                                top: headerHeight + 'px'
                            });
                        } else if(y < $('.fl-module-bw-article-single-info').offset().top){
                            $('.ArticleSingleInfo-wrapper_sidebar').removeClass('fixed');
                            $('.ArticleSingleInfo-wrapper_sidebar .fl-node-content').css({
                                position: 'unset',
                            });
                        }
                    }
                    lastScrollTop = y;
                } else {
                $('.ArticleSingleInfo-wrapper_sidebar').removeClass('fixed');
                }
            });
            
        }
    }
    
    function addTitle(){
        var headings = [];
        $('.ArticleSingleInfo-wrapper .ArticleSingleInfo-content > h2').each(function(index, value){
            headings.push($(this).text());
            if(index == 0){
                var heading = $('.ArticleSingleInfo-wrapper .ArticleSingleInfo-content h2').first();
            }
            
            index += 1;
            $(this).prepend('<span id="nav-'+index+'"></span>');
        });

        $.each(headings, function( index, value ) {
            index += 1;
            $('.ArticleSingleInfo-sidebar-list').append('<li class="toc-li ArticleSingleInfo-sidebar-list-item"><div class="top"><a class="subtitle" href="#nav-'+index+'">'+value+'</a></div></li>');
        });

        $('.ArticleSingleInfo-sidebar-list .toc-li:first-child a[href*="#"]').addClass('active');
        $('.ArticleSingleInfo-sidebar-list .toc-li a[href*="#"]').on('click', function(event){  
            var headerHeight = $('header.siteheader').height()+30;   
            event.preventDefault();
            $(this).parent().parent().siblings('.toc-li').children('.top').children('a').removeClass('active');
            $(this).addClass('active');
            $('html,body').animate({scrollTop:$(this.hash).offset().top - headerHeight}, 800);
        });

        $(".ArticleSingleInfo-sidebar-list li a").each(function() {
            $(this).click(function(){
                $(".ArticleSingleInfo-sidebar-list li a").css('color','#7F7F7F');
                $(this).css('color','#000');
            })
        });
    }
    
    initStickyScroll();
    addTitle();
    
    module.initStickyScroll = initStickyScroll;
    module.addTitle = addTitle;

    return module;
}));
