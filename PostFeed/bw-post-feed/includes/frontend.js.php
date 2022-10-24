<?php
	$jsPagi = $settings->posts_per_page;
	$settings->posts_per_page = 1000;
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


	$posts = $blogPosts->posts;
	$newPosts = [];
	for($i = 0; $i < count($posts); $i++){
		$post = $posts[$i];
		$author_id = get_post_field( 'post_author', $post->ID );
		$author_name = get_the_author_meta( 'display_name', $author_id );
		$get_products_tag = get_the_terms( $post->ID, 'product_tag' );
		$get_post_tag = get_the_terms( $post->ID, 'post_tag' );
		$post_categories = wp_get_post_categories( $post->ID, array( 'fields' => 'all' ) );
		$cat = get_cat_name(wp_get_post_categories( $post->ID )[0]);
		$tax = wp_get_object_terms( ($post->ID), $taxonomy, array( 'fields' => 'all' ) );
		$image = $image = get_the_post_thumbnail_url($post->ID);
		$link = get_permalink($post->ID);
		$title = $post->post_title;
		$excerpt = $post->post_content;
		$trimmed_content = wp_trim_words( $excerpt, 50, NULL );
		$date = new DateTime($post->post_date);
		$nPost = $post;
		$nPost->catSlug = $post_categories[0]->slug;
		$nPost->category = $cat;
		$nPost->taxonomy = $tax[0]->name;
		$nPost->slug = $tax[0]->slug;
		$nPost->image = $image;
		$nPost->permLink = $link;
		$nPost->title = $title;
		$nPost->post_author = $author_name;
		$nPost->tag = $get_products_tag[0]->name;
		$nPost->post_tag = $get_post_tag[0]->name;
		$nPost->excerpt = $trimmed_content;
		$nPost->date = $date->format('M j, Y');
		array_push($newPosts, $nPost);
	}
	
?>
(function(){
var ele = document.querySelector(".fl-module-bw-post-feed.fl-node-<?php echo $id; ?>");
new PostFeed({
	element: ele,
	postsPerPage: <?php echo $jsPagi; ?>,
	posts: <?php echo json_encode($newPosts); ?>,
	defaultImage: '<?php echo $settings->default_image_src; ?>'
})
})();