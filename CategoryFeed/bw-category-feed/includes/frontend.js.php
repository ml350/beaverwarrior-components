<?php
if ( ! isset( $settings->post_type ) ) {
	$post_type = 'post';
} else {
	$post_type = $settings->post_type;
}
$var_tax_type = 'posts_' . $post_type . '_tax_type';
$tax_type     = $var_cat_matching = $var_cat = '';
if ( isset( $settings->$var_tax_type ) ) {
	$tax_type         = $settings->$var_tax_type;
	$var_cat          = 'tax_' . $post_type . '_' . $tax_type;
	$var_cat_matching = $var_cat . '_matching';
}

$cat_match    = isset( $settings->$var_cat_matching ) ? $settings->$var_cat_matching : false;
$ids          = isset( $settings->$var_cat ) ? explode( ',', $settings->$var_cat ) : array();
$taxonomy     = isset( $tax_type ) ? $tax_type : '';
$orderby      = isset( $settings->order_by ) ? $settings->order_by : 'name';
$order        = isset( $settings->order ) ? $settings->order : 'ASC';
$show_count   = 1;
$pad_counts   = 1;
$hierarchical = 1;
$title        = '';
$empty        = ( isset( $settings->show_empty ) && 'yes' === $settings->show_empty ) ? false : true;

$args = array(
	'taxonomy'     => $taxonomy,
	'orderby'      => $orderby,
	'order'        => $order,
	'show_count'   => $show_count,
	'pad_counts'   => $pad_counts,
	'hierarchical' => $hierarchical,
	'title_li'     => $title,
	'hide_empty'   => $empty,
);


if ( $cat_match && 'related' !== $cat_match && ! empty( $ids ) ) {
	if ( isset( $settings->display_data ) && ( 'children_only' === $settings->display_data || 'default' === $settings->display_data ) && ! empty( $ids[0] ) ) {
		//only single value is allowed so we have made new custom function, get_child_categories()
		$args['parent'] = $ids;
	} else {
		$args['include'] = $ids;
	}
}
if ( ( ! $cat_match || 'related' === $cat_match ) && ! empty( $ids ) ) {
	if ( isset( $settings->display_data ) && ( 'parent_only' !== $settings->display_data ) && ! empty( $ids[0] ) ) {

		foreach ( $ids as $term_id ) {
			$tmp_ids = get_term_children( $term_id, $taxonomy );
			$ids     = array_merge( $ids, $tmp_ids );
		}
		$args['exclude'] = $ids;
	} else {
		$args['exclude'] = $ids;
	}
}

$args = apply_filters( 'category_grid_query_args', $args, $settings );

if ( isset( $settings->display_data ) && 'children_only' === $settings->display_data && isset( $args['parent'] ) && ! empty( $args['parent'][0] ) ) {
	$all_categories = BWCategoryFeed::get_categories( $args, 'children_only' );
} elseif ( isset( $settings->display_data ) && 'default' === $settings->display_data && isset( $args['parent'] ) && ! empty( $args['parent'][0] ) ) {
	$all_categories = BWCategoryFeed::get_categories( $args, 'default' );
} else {
	$all_categories = get_categories( $args );
}

// TODO: Selection Order.
if ( $cat_match == 1 && 'term_order' === $orderby && ! empty( $ids ) ) {
	$_all_categories = $all_categories;
	$all_categories = array();
	$ordered = array();

	foreach ( $_all_categories as $_category ) {
		$all_categories[ $_category->term_id ] = $_category;
	}

	foreach ( $ids as $id ) {
		if ( isset( $all_categories[ $id ] ) ) {
			$ordered[ $id ] = $all_categories[ $id ];
		}
	}

	$all_categories = $ordered;
}

global $post;

$current_post_terms = array();
$assigned_only = isset( $settings->on_post ) && 'assigned_only' === $settings->on_post;

if ( is_single() && $post && $post->ID ) {
	$current_post_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'fields' => 'slugs' ) );
}

$is_tax_archive = is_tax() || is_category() || is_tag();
$queried_object = $is_tax_archive ? get_queried_object() : false;
$exclude_current_cat = apply_filters( 'category_grid_exclude_current_category', true );


	$jsPagi = $settings->posts_per_page;
	$settings->posts_per_page = 1000;
	$newCategory = [];
	for($i = 0; $i < count($all_categories); $i++){

		$cat = $all_categories[$i];
		$cat_thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$category_image = wp_get_attachment_image_src( $cat_thumb_id, 'select_category_image' );
		$term_link = get_term_link( $cat, $taxonomy );
		$nCategory = $cat;
		$nCategory->image = $category_image[0];
		$nCategory->link = $term_link;
		array_push($newCategory, $nCategory);
	}
	
?>
(function(){
var ele = document.querySelector(".fl-module-bw-category-feed.fl-node-<?php echo $id; ?>");
new CategoryFeed({
	element: ele,
	postsPerPage: <?php echo $jsPagi; ?>,
	categories: <?php echo json_encode($newCategory); ?>,
	defaultImage: '<?php echo $settings->default_image_src; ?>'
})
})();