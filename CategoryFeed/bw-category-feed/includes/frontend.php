<?php
	wp_enqueue_script(
		"pagination-js",
		get_stylesheet_directory_uri() . "/assets/vendor/pagination/pagination.min.js"
	);

	wp_enqueue_style(
		"pagination-css",
		get_stylesheet_directory_uri() . "/assets/vendor/pagination/pagination.min.css"
	);

?>

<div class='category-feed-container'>
	<?php if ( $settings->category_main_name): ?>
		<h2 class="category-main-title"><span class="category-heading-text"><?php echo $settings->category_main_name; ?></span></h2>
	<?php endif; ?>
	<div class='category-container grid'></div>
	<div class='pagination'></div>
  	<?php wp_reset_query(); ?>
</div>