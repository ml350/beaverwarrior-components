(($)=>{
	ArticleSlider = class{
		constructor(settings){
			this.element = settings.element;
			this.slideNum = 0;
			this.init();
		}

		init(){
			var _this = this;
			var self = this;
			window.addEventListener("load", ()=>{
				if ( $(window).width() > 768 ) {
					
					self.initCarousel();
				} else {
				  self.stopCarousel();
				}
                this.slideNum = $(".article-slider-container .owl-dot").length;
				this.updateNavLine((1 / this.slideNum) * 100);
			});
			  
			$(window).resize(function() {
			
				if ( $(window).width() > 768 ) {
				self.initCarousel();
				} else {
				self.stopCarousel();
				}
			});
		}

		initCarousel(){
			this.carousel = $(this.element).find('.article-slider-container .owl-carousel').owlCarousel({
				stagePadding:80,
				margin: 40,
				loop: true,
                dots: true,
				onChanged: this.handleCarouselChange.bind(this),
				nav:true,
				navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: 2.5,
                        center: true,
					},
					992: {
						items: 3.5,
                        center: true,
					},
					1500: {
						items: 5.5,
                        center: true,
					}
				}
			})
		}

		stopCarousel() {
			var owl = $('.article-slider-container .owl-carousel');
			owl.trigger('destroy.owl.carousel');
			owl.addClass('off');
		}

		handleCarouselChange(e){
			const buttons = $('.article-slider-container .owl-dot');
			const button = buttons.filter(".active");
			let	i = buttons.index(button) + 1;
			if(i<=0) i = 1;
			setTimeout(()=>{
				const centered = this.element.querySelector(".center");
				if(centered){
					const width = (parseInt(i) / this.slideNum) * 100;
					this.updateNavLine(width);
				}
			}, 100);
		}

		updateNavLine(width){
			const navLine = this.element.querySelector(".article-slider-container .line-inner");
			navLine.style.width = `${width}%`;
		}
	}
})(jQuery);