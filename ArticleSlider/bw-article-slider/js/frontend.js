"use strict"; var _createClass = function() { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function(Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }(function($) { ArticleSlider = function() { function ArticleSlider(settings) { _classCallCheck(this, ArticleSlider); this.element = settings.element; this.slideNum = 0; this.init(); } _createClass(ArticleSlider, [{ key: "init", value: function init() { var _this = this; var self = this; window.addEventListener("load", function() { if ($(window).width() > 768) { self.initCarousel(); } else { self.stopCarousel(); } _this.slideNum = $(".article-slider-container .owl-dot").length; _this.updateNavLine(1 / _this.slideNum * 100); }); $(window).resize(function() { if ($(window).width() > 768) { self.initCarousel(); } else { self.stopCarousel(); } }); } }, { key: "initCarousel", value: function initCarousel() { this.carousel = $(this.element).find('.article-slider-container .owl-carousel').owlCarousel({ stagePadding: 80, margin: 40, loop: true, dots: true, onChanged: this.handleCarouselChange.bind(this), nav:true, navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'], responsive: { 0: { items: 1, center: true, dots: true, }, 768: { items: 2.5, center: true, dots: true, }, 992: { items: 3.5, center: true, dots: true, }, 1500: { items: 5.5, center: true, dots: true, } } }); } }, { key: "stopCarousel", value: function stopCarousel() { var owl = $('.article-slider-container .owl-carousel'); owl.trigger('destroy.owl.carousel'); owl.addClass('off'); } }, { key: "handleCarouselChange", value: function handleCarouselChange(e) { var _this2 = this; var buttons = $('.article-slider-container .owl-dot'); var button = buttons.filter(".active"); var i = buttons.index(button) + 1; if (i <= 0) i = 1; setTimeout(function() { var centered = _this2.element.querySelector(".center"); if (centered) { var width = parseInt(i) / _this2.slideNum * 100; _this2.updateNavLine(width); } }, 100); } }, { key: "updateNavLine", value: function updateNavLine(width) { var navLine = this.element.querySelector(".article-slider-container .line-inner"); navLine.style.width = width + "%"; } }]); return ArticleSlider; }(); })(jQuery);