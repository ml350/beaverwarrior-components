(($)=>{
	CategoryFeed = class{
		constructor(settings){
			this.element = settings.element;
			this.categories = settings.categories;
			this.filteredPosts = this.categories;
			this.defaultImage = settings.defaultImage;
			this.postsPerPage = settings.postsPerPage;
			this.initPostPerPage = settings.postsPerPage;
			this.init();
		}
		init(){
			window.addEventListener("load", ()=>{
				this.buildPagination(this.filteredPosts);
			})
		}

        buildPagination(data) {
            $(this.element)
            .find(".pagination")
            .pagination({
                dataSource: data,
                pageSize: this.postsPerPage,
                callback: (d, pagination) => {
                    let postHTML = [];
                    for (let i = 0; i < d.length; i++) {
                        const category = d[i];
                        let image;
                        if (!category.image || category.image === "") {
                            image = this.defaultImage;
                        } else {
                            image = category.image;
                        }
                        let html = `<a class='category' href='${category.link}'>
                                        <div class='image-container'>
                                            <img class='img-class' src='${image}' />
                                            <div class='category-content'>
                                                <h3 class='category-title'>${category.cat_name}</h3>
                                                <div class='category-excerpt'>${category.category_description}</div>
                                            </div>
                                        </div>
                                    </a>`;
                        postHTML.push(html);
                    }
                    this.element.querySelector(".category-container").innerHTML = postHTML.join("");
                },
            });
            const numberOfPages = this.element.querySelectorAll(".paginationjs-page").length;
            if (numberOfPages < 2) {
                this.element.querySelector(".paginationjs").style.display = "none";
            } else {
                this.element.querySelector(".paginationjs").style.display = "block";
            }
            this.handleNextPrevClick();
        }

		handleNextPrevClick(){
			$(".paginationjs-next").click(()=>{
				this.scrollToTop();
				setTimeout(()=>{
					this.handleNextPrevClick();
				}, 500);
			});
			$(".paginationjs-prev").click(()=>{
				this.scrollToTop();
				setTimeout(()=>{
					this.handleNextPrevClick();
				}, 500);
			});
			$(".paginationjs-page").click(()=>{
				this.scrollToTop();
				setTimeout(()=>{
					this.handleNextPrevClick();
				}, 500);
			});
		}
		scrollToTop(){
			const top = $('.category-container').offset().top - 300;
			$('body,html').animate({
				scrollTop: top
			}, 600);
		}
	}
})(jQuery);