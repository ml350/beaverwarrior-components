<?php
	wp_enqueue_script(
		"owl-carousel-js",
		get_stylesheet_directory_uri() . "/assets/vendor/owl-carousel/owl.carousel.min.js",
		array("jquery")
	);

	wp_enqueue_style(
		"owl-carousel-css",
		get_stylesheet_directory_uri() . "/assets/vendor/owl-carousel/assets/owl.carousel.min.css"
	);

	wp_enqueue_script(
		"owl-carousel-js-mousewheel",
		get_stylesheet_directory_uri() . "/assets/vendor/owl-carousel/jquery.mousewheel.min.js",
		array("jquery")
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
	
?>
<div class='article-slider-container'>
	<div class="article-title-wrapp">
		<?php if ( $settings->article_main_name): ?>
			<h2 class="article-title"><?php echo $settings->article_main_name; ?></h2>
		<?php endif; ?>
		<?php if($settings->article_button_link) : ?>
			<div class="black-button">
				<a href="<?php echo $settings->article_button_link ?>" target="<?php echo $settings->article_button_link_target ?>" role="button" class="btn-link">
					<span> <?php echo $settings->article_button ?> </span> 
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div class='desktop-posts-container'>
		<div class='owl-carousel'>
			<?php
			
				$i=0;
				if ( $blogPosts->have_posts() ) :
				while ( $blogPosts->have_posts() ) :
				$blogPosts->the_post();
				$i++; 
				$postCategories = get_the_terms($post->ID, $taxonomy);
				$date = get_the_date( 'F j, Y', $post->ID);
				$primary_term_name = yoast_get_primary_term($tax = "product_cat", $post = null);
					
			?>
				
			<a class='post-link' href='<?php echo get_the_permalink(); ?>'>
				<div class='slide-container' data-index='<?php echo $i; ?>'>

					<?php
						if ($primary_term_name) {
							echo "<div class='card__tags'>";
							echo "<span class='card__tag'>" . $primary_term_name . " </span>";
							echo "</div>";
						} elseif ($postCategories) {
							echo "<div class='card__tags'>";
							foreach($postCategories as $category) {
							echo "<span class='card__tag'>" . $category->name . " </span>";
							}
							echo "</div>";
						}
					?>
				
					<h3 class='post-title'>
						<?php the_title(); ?>
					</h3>

					<p class='post-date'><?php echo $date; ?> <?php _e( 'by', 'skeleton_warrior' ); ?> <?php echo get_the_author(); ?></p>

				</div>
			</a>
			
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>

		</div>

		<div class='mobile-nav'>
			<div class='line-outer'>
				<div class='line-inner'></div>
			</div>
		</div>
		<?php if($settings->article_button_link) : ?>
			<div class="black-button mob">
				<a href="<?php echo $settings->article_button_link ?>" target="<?php echo $settings->article_button_link_target ?>" role="button" class="btn-link mob">
					<span class="mob"> <?php echo $settings->article_button ?> </span> 
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>