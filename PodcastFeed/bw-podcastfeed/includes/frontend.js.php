<?php
    $newPosts       = [];
    $careersPosts   = FLBuilderLoop::query( $settings );
    $posts          = $careersPosts->posts;

    if($careersPosts->query['post_type'] !== null) {
        $cpt = $careersPosts->query['post_type'];
    } else {
        $cpt = get_taxonomy(get_queried_object()->taxonomy)->object_type[0];
    }

    if($cpt === 'post') {
        $taxonomy = 'category';
    } else {
        $taxonomy = get_object_taxonomies($cpt);
    }

    for($i = 0; $i < count($posts); $i++){
        $post               = $posts[$i];
        $post_categories    = wp_get_post_categories( $post->ID, array( 'fields' => 'all' ) );
        $cat                = get_cat_name(wp_get_post_categories( $post->ID )[0]);
        $tax                = wp_get_object_terms( ($post->ID), $taxonomy, array( 'fields' => 'all' ) );
        $meta_featured      = get_post_meta($post->ID, 'featured', true); 
        $link               = get_permalink($post->ID);
        $title              = $post->post_title;
        $date               = new DateTime($post->post_date);
        $terms              = get_the_terms($post->ID, 'product_tag');
        $terms              = join(', ', wp_list_pluck($terms, 'name'));
        $pods               = pods('podcast', $post->ID); 
        $meta_featured      = $pods->field('featured'); 
        $excerpt            = $post->post_content;
        $trimmed_content    = wp_trim_words($excerpt, 8, NULL);
        $nPost              = $post;
        $nPost->content     = $trimmed_content;
        $nPost->catSlug     = $post_categories[0]->slug;
        $nPost->category    = $cat;
        $nPost->taxonomy    = $tax[0]->name;
        $nPost->slug        = $tax[0]->slug;  
        $nPost->permLink    = $link;
        $nPost->title       = $title;
        $nPost->date        = $date->format('M j, Y');
        $nPost->terms       = $terms;
        $nPost->featured    = $meta_featured;
        array_push($newPosts, $nPost);
    }

    $results_json = json_encode($newPosts); //post_date
?>

(function($){
    $(function(){
        function generatePosts(taxonomy) {
            var first_load = true;
            var results = <? echo $results_json; ?>;  

            /*Filter Results*/
            var filtered_results = new Array();
            for (let j = 0; j < results.length; j++) {  
                if(results[j].taxonomy == taxonomy || taxonomy == '') {  
                    filtered_results.push(results[j]);
                } 
                
                if(results[j].slug == taxonomy){
                    filtered_results.push(results[j]);
                } 

                if(taxonomy == 'featured' && results[j].featured == 1) { 
                    filtered_results.push(results[j]);
                }
            }
            let totalPosts = filtered_results.length; 
            $('#PodcastFeed-pagination--numbers').pagination({
                dataSource: filtered_results,
                showPrevious:false,
                showNext:false,
                pageSize: 1000, 
                callback: function(d, pagination) {
                    /*move page to top on page navigation start*/
                    var PodcastFeed_pos = jQuery('#PodcastFeed_thePostsListing').offset(); 
                    if (!first_load) {
                        jQuery(window).scrollTop(PodcastFeed_pos.top-150);
                    } else {
                        first_load=false;
                    }
                    /*move page to top on page navigation end*/
                    /* d is the data array */
                    let postHTML = [];
                    for (let i = 0; i < d.length; i++) {
                        const post = d[i];

                        let html = `<div class="PodcastFeed-contents_card">  
                                        <h6 class="PodcastFeed-postEntry">${post.terms}</h6>
                                        <h5 class="PodcastFeed-postTitle">${post.title}</h5> 
                                        <div class="PodcastFeed-postCategory">${post.taxonomy}</div>
                                        <p> ${post.content} </p>
                                        <div class="link-button"> 
                                            <a class="PodcastFeed-postLink fl-button" role="button" href="${post.permLink}">
                                                <span class="fl-button-text"> Listen Now </span>
                                            </a>
                                        </div>
                                    </div>`;
                        postHTML.push(html);
                    } 
                    
                    $('#PodcastFeed_thePostsListing').html(postHTML.join(""));

                    if (totalPosts<=0) {
                        $('#PodcastFeed_thePostsListing').html("<span class='PodcastFeed-noResults'><?php echo esc_html($settings->no_results_message);?></span>");
                    }

                    /*hide pagination if there's just one page */
                    if (totalPosts<=1000) {
                        $('#PodcastFeed-pagination').addClass('PodcastFeed-hide');
                    } else {
                        $('#PodcastFeed-pagination').removeClass('PodcastFeed-hide');
                    }
                }
            });
        }

        //initial posts display
        setTimeout(function() {
            generatePosts('');

        }, 500);
        //generatePosts('');


        $(".PodcastFeed-pagination--myPrev").on("click", function() {
            $('#PodcastFeed-pagination--numbers').pagination('previous');
        });

        $(".PodcastFeed-pagination--myNext").on("click", function() {
            $('#PodcastFeed-pagination--numbers').pagination('next');
        });

        /*dropdown category select*/
        $(".PodcastFeed-selectedDropdown .PodcastFeed-contents-filters-wrapper--li.featured").on("click", function() {
            $( ".PodcastFeed-selectedEp" ).html($(this).text());
            $(".PodcastFeed-selectedCategory").html('Sort by category');

            generatePosts($(this).attr('rel'));
        }); 

        $(".PodcastFeed-selectedDropdown .PodcastFeed-contents-filters-wrapper--li.category").on("click", function() {
            $( ".PodcastFeed-selectedCategory" ).html($(this).text());

            generatePosts($(this).attr('rel'));
        }); 

        /*dropdown category select*/
        $(".PodcastFeed-selectedDropdown-filters-mobile .PodcastFeed-contents-filters-wrapper--li").on("click", function() {
            $( ".PodcastFeed-selectedEp" ).html($(this).text());

            generatePosts($(this).attr('rel'));
        });

        $(".PodcastFeed-resetfilters-list .PodcastFeed-contents-filters--li").on("click", function() { 
            generatePosts($(this).attr('rel'));
        });

        $('.PodcastFeed-contents-filters--li').on('click', function(){
            if($(this).hasClass('active')) {
                $(this).siblings('.PodcastFeed-contents-filters--li').removeClass('active');
            }

            $(this).addClass('active');
            $(this).siblings('.PodcastFeed-contents-filters--li').removeClass('active');
        });

        $(".PodcastFeed-contents-filters--li.featured").on("click", function() { 
            $( ".PodcastFeed-selectedEp" ).html($(this).text());
            $(".PodcastFeed-selectedCategory").html('Sort by category');
            generatePosts($(this).attr('rel'));
        }); 

        $(".PodcastFeed-contents-filters--li.all").on("click", function() { 
            $( ".PodcastFeed-selectedEp" ).html($(this).text());
            $(".PodcastFeed-selectedCategory").html('Sort by category');

            generatePosts('');
        });

        $(".PodcastFeed-contents-reset-filters--li").on("click", function() {  
            $( ".PodcastFeed-selectedEp" ).html('All episodes');
            $( ".PodcastFeed-selectedCategory" ).html('Sort by category');

            generatePosts('');
        });
    });
})(jQuery);