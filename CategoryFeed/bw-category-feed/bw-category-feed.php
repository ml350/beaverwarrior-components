<?php

/**
 * @class BWCategoryFeed
 *
 */
class BWCategoryFeed extends BeaverWarriorFLModule {

	/**
	 * Parent class constructor.
	 * @method __construct
	 */
	public function __construct(){
		FLBuilderModule::__construct(
			array(
				'name'            => __('Category Feed', 'fl-builder'),
				'description'     => __('A Category Feed Module', 'fl-builder'),
				'category'        => __('Space Station', 'skeleton-warrior'),
				'dir'             => $this->getModuleDirectory( __DIR__ ),
				'url'             => $this->getModuleDirectoryURI( __DIR__ ),
				'editor_export'   => true,
				'enabled'         => true,
				'partial_refresh' => true
			)
		);
	}

	public static function get_categories( $args, $display_data ) {
		$all_categories = array();

		if ( 'children_only' === $display_data ) {
			if ( isset( $args['parent'] ) && is_array( $args['parent'] ) && intval( $args['parent'][0] ) > 0 ) {
				$parents = $args['parent'];
				unset( $args['parent'] );
				foreach ( $parents as $parent_id ) {
					$args['child_of'] = $parent_id;
					$tmp_categories   = get_categories( $args );
					if ( count( $tmp_categories ) > 0 ) {
						foreach ( $tmp_categories as $cat ) {
							$all_categories[] = $cat;
						}
					}
				}
			} else {
				$all_categories = get_categories( $args );
			}
		} elseif ( 'default' === $display_data ) {
			if ( isset( $args['parent'] ) && is_array( $args['parent'] ) && intval( $args['parent'][0] ) > 0 ) {
				$parents = $args['parent'];
				unset( $args['parent'] );
				foreach ( $parents as $parent_id ) {
					$args['child_of'] = $parent_id;
					$tmp_categories   = get_categories( $args );
					if ( count( $tmp_categories ) > 0 ) {
						foreach ( $tmp_categories as $cat ) {
							$all_categories[] = $cat;
						}
					}
				}
				unset( $args['child_of'] );
				//include parent also
				$args['hierarchical'] = 0;
				$args['include'] = $parents;

				$tmp_categories = get_categories( $args );
				if ( count( $tmp_categories ) > 0 ) {
					foreach ( $tmp_categories as $cat ) {
						$all_categories[] = $cat;
					}
				}
			} else {
				unset( $args['parent'] );
				$all_categories = get_categories( $args );
			}
		} else {
			$all_categories = get_categories( $args );
		}
		return $all_categories;
	}
	
}

FLBuilder::register_module(
	'BWCategoryFeed', array(
		'general' => array(
			'title' => __( 'General', 'fl-builder'),
			'sections' => array(
				'section_general' => array(
					'fields' => [
						'category_main_name' => [
							'type'  => 'text',
							'label' => __( 'Main Title', 'fl-builder' ),
						],
						'posts_per_page' => [
							'type' => 'unit',
							'label' => __('Category Per Page', 'fl-builder'),
							'default' => 9
						],
						'columns_desktop' => [
							'type' => 'unit',
							'label' => __('Columns - Desktop', 'fl-builder'),
							'default' => 3
						],
						'columns_tablet' => [
							'type' => 'unit',
							'label' => __('Columns - Tablet', 'fl-builder'),
							'default' => 2
						],
						'columns_mobile' => [
							'type' => 'unit',
							'label' => __('Columns - Mobile', 'fl-builder'),
							'default' => 1
						],
						'default_image' => [
							'type' => 'photo',
							'label' => __('Default Category Image', 'fl-builder')
						]
					]
				)
			)
		),
		'category_loop' => array(
		  'title'     => __( 'Loop Settings', 'fl-builder' ),
		  'file'  => __DIR__  . '/loop-settings.php',
		),
	)
);