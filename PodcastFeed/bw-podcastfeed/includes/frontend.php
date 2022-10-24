<?php 
    $wrapper_attributes = [
        "class"     => ["PodcastFeed-contents"],
        "id"        => "PodcastFeed",
        "style"     => ["background: transparent;", "padding: 0px;"]
    ]
?>

<div <? echo spacestation_render_attributes($wrapper_attributes); ?> >
    <div class="PodcastFeed-contents_header"> 
        <div class="PodcastFeed-contents-filter-wrapper"> 
            <div class="PodcastFeed-resetfilters">
                <ul class="PodcastFeed-resetfilters-list">
                    <li class="PodcastFeed-contents-filters--li all active" rel=""> All Episodes </li>
                    <li class="PodcastFeed-contents-filters--li featured" rel="featured"> Featured Episodes </li> 
                    <div class="dropdown PodcastFeed-selectedDropdown-filters-mobile">
                        <button id="dLabel2" class="PodcastFeed-filter-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="PodcastFeed-selectedEp">All Episodes</span>
                            <svg class="cat" width="13px" height="6px" viewBox="0 0 13 6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g class="cat" id="icons---nav---arrow---black" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path class="cat" d="M10.2238576,2.27614237 L7.44280904,5.05719096 C6.92210999,5.57789001 6.07789001,5.57789001 5.55719096,5.05719096 L2.77614237,2.27614237 C2.25544332,1.75544332 2.25544332,0.911223347 2.77614237,0.390524292 C3.02619088,0.140475787 3.36532943,2.8700391e-16 3.71895142,0 L9.28104858,0 C10.0174282,8.67738547e-17 10.6143819,0.596953667 10.6143819,1.33333333 C10.6143819,1.68695532 10.4739061,2.02609387 10.2238576,2.27614237 Z" id="arrow" fill="#D62D80"></path></g></svg>
                        </button>
                        <ul class="dropdown-menu" id="PodcastFeed-dropmenu" aria-labelledby="drop4">
                            <li class="PodcastFeed-contents-filters-wrapper--li all active" rel=""> All Episodes </li>
                            <li class="PodcastFeed-contents-filters-wrapper--li featured" rel="featured"> Featured Episodes </li> 
                        </ul>
                    </div>
                    <div class="dropdown PodcastFeed-selectedDropdown date">
                        <button id="dLabel" class="PodcastFeed-filter-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="PodcastFeed-selectedCategory">Sort by category</span>
                            <svg class="cat" width="13px" height="6px" viewBox="0 0 13 6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g class="cat" id="icons---nav---arrow---black" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path class="cat" d="M10.2238576,2.27614237 L7.44280904,5.05719096 C6.92210999,5.57789001 6.07789001,5.57789001 5.55719096,5.05719096 L2.77614237,2.27614237 C2.25544332,1.75544332 2.25544332,0.911223347 2.77614237,0.390524292 C3.02619088,0.140475787 3.36532943,2.8700391e-16 3.71895142,0 L9.28104858,0 C10.0174282,8.67738547e-17 10.6143819,0.596953667 10.6143819,1.33333333 C10.6143819,1.68695532 10.4739061,2.02609387 10.2238576,2.27614237 Z" id="arrow" fill="#D62D80"></path></g></svg>
                        </button>
                        <ul class="dropdown-menu" id="PodcastFeed-dropmenu2" aria-labelledby="drop4">
                        <li class="PodcastFeed-contents-filters-wrapper--li category" rel=""> All </li>
                        <? $tax = get_categories(array('taxonomy' => 'product_cat', 'hide_empty' => true)); foreach($tax as $t): ?>
                            <li class="PodcastFeed-contents-filters-wrapper--li category" rel="<? echo $t->slug; ?>"> <? echo $t->name ;?> </li> 
                        <? endforeach; ?>
                        </ul>
                    </div>

                    <div class="PodcastFeed-searchinput">
                        <form action="/" method="get" autocomplete="off">
                        <input type="text" name="s" placeholder="Search" id="keyword" class="input_search" onkeyup="fetch_posts()"> 
                            <svg width="15px" enable-background="new 0 0 512.005 512.005" viewBox="0 0 512.005 512.005" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m505.749 475.587-145.6-145.6c28.203-34.837 45.184-79.104 45.184-127.317 0-111.744-90.923-202.667-202.667-202.667s-202.666 90.922-202.666 202.666 90.923 202.667 202.667 202.667c48.213 0 92.48-16.981 127.317-45.184l145.6 145.6c4.16 4.16 9.621 6.251 15.083 6.251s10.923-2.091 15.083-6.251c8.341-8.341 8.341-21.824-.001-30.165zm-303.082-112.918c-88.235 0-160-71.765-160-160s71.765-160 160-160 160 71.765 160 160-71.766 160-160 160z"></path></svg>    
                        </form>
                    </div>
                    
                    <div class="PodcastFeed-resetfilters-mobile">
                        <a class="PodcastFeed-contents-reset-filters--li" style="color: #000;" rel=""> CLEAR FILTERS </a>
                    </div>
                </ul>
            </div>  
        </div>
    </div>
    <div id="PodcastFeed_thePostsListing">
        <!--<p>Reading data...</p>-->
    </div>    
    <div id="PodcastFeed-pagination">
        <div class="PodcastFeed-pagination--myPrev">PREVIOUS</div>
        <div id="PodcastFeed-pagination--numbers"></div>
        <div class="PodcastFeed-pagination--myNext">
            <div class="link-button"> 
                <a class="fl-button" role="button" href="">
                    <span class="fl-button-text"></span>
                </a>
            </div>
        </div>
    </div>
</div>