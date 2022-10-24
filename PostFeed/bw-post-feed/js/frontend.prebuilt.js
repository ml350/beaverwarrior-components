(($)=>{
	PostFeed = class{
		constructor(settings){
			this.element = settings.element;
			this.posts = settings.posts;
			this.filteredPosts = this.posts;
			this.defaultImage = settings.defaultImage;
			this.postsPerPage = settings.postsPerPage;
			this.initPostPerPage = settings.postsPerPage;
			this.init();
		}
		init(){
			$(".list-button").click(()=>{
				this.changeNumberOfPosts(8);
			})

			$(".grid-button").click(()=>{
				console.log("GRID-BUTTON")
				this.changeNumberOfPosts(this.initPostPerPage);
			})
			
			window.addEventListener("load", ()=>{
				this.buildPagination(this.filteredPosts);
				this.showDropdown();
				this.handleFilterClick();
				this.handleGridListClick();
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
              const post = d[i];
              let image;
              if (!post.image || post.image === "") {
                image = this.defaultImage;
              } else {
                image = post.image;
              }
              let html = `<a class='post' href='${post.permLink}'>
										<div class='image-container'>
                      <img class='img-class' src='${image}' />
                    </div>
										<div class='post-content'>
                      <h3 class='post-title'>${post.title}</h3>
                      <div class='post-author'> ${post.post_author}</div>
                      <div class='post-excerpt'>${post.excerpt}</div>
                    </div>
									</a>`;
              postHTML.push(html);
            }
            this.element.querySelector(".post-container").innerHTML = postHTML.join("");
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

    changeNumberOfPosts(numberOfPosts) {
		this.postsPerPage = numberOfPosts;
		this.buildPagination(this.filteredPosts);
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
			const top = $('.post-container').offset().top - 300;
			$('body,html').animate({
				scrollTop: top
			}, 600);
		}
		showDropdown(){
			const cat = this.element.querySelector(".category-dropdown");
			const catList = this.element.querySelector(".categories");
			cat.addEventListener("click", ()=>{
				catList.classList.toggle("active");
			});
			document.body.addEventListener("click", (e)=>{
				if(!e.target.classList.contains('cat')){
					catList.classList.remove('active');
				}

			})
		}
		handleFilterClick(){
			const cats = this.element.querySelectorAll(".category");
			for(let i = 0; i < cats.length; i++){
				cats[i].addEventListener("click", ()=>{
					const filter = cats[i].dataset.filter;
					this.filterData(filter);
					if(filter === 'All'){
						this.element.querySelector(".cat-label").innerText = 'All';
					}else{
						this.element.querySelector(".cat-label").innerText = filter;
					}
				})
			}
		}

		filterData(filter){
			const filteredPosts = [];
			if(filter == 'All'){
				this.filteredPosts = this.posts;
			}else{
				for(let i = 0; i < this.posts.length; i++){
					if(filter == this.posts[i].post_tag){
						filteredPosts.push(this.posts[i]);
					}
          if(filter == this.posts[i].tag){
						filteredPosts.push(this.posts[i]);
					}
				}
				this.filteredPosts = filteredPosts;
			}
			this.buildPagination(this.filteredPosts);
		}

		handleGridListClick(){
			const gridButton = this.element.querySelector(".grid-button");
			const listButton = this.element.querySelector(".list-button");
			const postContainer = this.element.querySelector(".post-container");

			gridButton.addEventListener("click", ()=>{
				postContainer.classList.add("grid-view");
				postContainer.classList.remove("list-view");

				gridButton.classList.add("active");
				listButton.classList.remove("active");
			});

			listButton.addEventListener("click", ()=>{
				postContainer.classList.remove("grid-view");
				postContainer.classList.add("list-view");

				gridButton.classList.remove("active");
				listButton.classList.add("active");
			});
		}

	}
})(jQuery);