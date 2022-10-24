<?php
	wp_enqueue_script(
		"pagination-js",
		get_stylesheet_directory_uri() . "/assets/vendor/pagination/pagination.min.js"
	);

	wp_enqueue_style(
		"pagination-css",
		get_stylesheet_directory_uri() . "/assets/vendor/pagination/pagination.min.css"
	);

	$blogPosts = FLBuilderLoop::query( $settings );

	if($blogPosts->query['post_type'] !== null) {
	$cpt = $blogPosts->query['post_type'];
	} else {
	$cpt = get_taxonomy(get_queried_object()->taxonomy)->object_type[0];
	}
	
	if($cpt === 'post') {
		$taxonomy = 'category';
	} else {
		$taxonomy = get_object_taxonomies($cpt);
	}

	$args_pt = [
		'post_type' => $cpt
	];
	$posts = get_posts($args_pt);
	$ocats = ['All'];
	$otags = ['All'];
	for($i = 0; $i < count($posts); $i++){
		$post = $posts[$i];
		$taxy = array('taxonomy' => 'post_tag', 'hide_empty' => true);
		$cat = get_categories($taxy);
		for($j = 0; $j < count($cat); $j++){
			array_push($ocats, $cat[$j]->name);
		}
		$tax = array('taxonomy' => 'product_tag', 'hide_empty' => true);
		$tag = get_categories($tax);

		for($j = 0; $j < count($tag); $j++){
			array_push($otags, $tag[$j]->name);
		}
	}
	$cats = array_values(array_unique($ocats));
	$tags = array_values(array_unique($otags));
//ww($tags);

?>

<div class='post-feed-container'>
	<div class='filter-container'>
		<div class='dropdown-container'>
		<div class='category-dropdown cat'>
			
				<div class='cat-label cat'><?php _e( 'Tags', 'skeleton_warrior' ); ?></div>
					<svg class='cat' width="13px" height="6px" viewBox="0 0 13 6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g class='cat' id="icons---nav---arrow---black" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path class='cat' d="M10.2238576,2.27614237 L7.44280904,5.05719096 C6.92210999,5.57789001 6.07789001,5.57789001 5.55719096,5.05719096 L2.77614237,2.27614237 C2.25544332,1.75544332 2.25544332,0.911223347 2.77614237,0.390524292 C3.02619088,0.140475787 3.36532943,2.8700391e-16 3.71895142,0 L9.28104858,0 C10.0174282,8.67738547e-17 10.6143819,0.596953667 10.6143819,1.33333333 C10.6143819,1.68695532 10.4739061,2.02609387 10.2238576,2.27614237 Z" id="arrow" fill="#D62D80"></path></g></svg>
			
				<ul class='categories cat'>
				<?php if ($settings->post_type === 'post' ) : ?> 
					<?php for($i=0; $i < count($cats); $i++): $cat = $cats[$i]; ?>
						<li class='category' data-filter='<?php echo $cat; ?>'><?php echo $cat; ?></li>
					<?php endfor; ?>
				<?php endif;?>

				<?php if ($settings->post_type !== 'post' ) : ?> 
					<?php for($i=0; $i < count($tags); $i++): $cat = $tags[$i]; ?>
						<li class='category' data-filter='<?php echo $cat; ?>'><?php echo $cat; ?></li>
					<?php endfor; ?>
				<?php endif;?>

				</ul>
			</div>

			<div class='view-button-container'>
				<div class='grid-button active'>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
					<div class='grid-box'></div>
				</div>
				<div class='list-button'>
					<div class='line'></div>
					<div class='line'></div>
					<div class='line'></div>
				</div>
			</div>
		</div>

	</div>
	<div class='post-container grid'></div>
	<div class='pagination'></div>
  	<?php wp_reset_query(); ?>
</div>