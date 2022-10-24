<?php

/**
 * @class BWPostFeed
 *
 */
class BWPostFeed extends BeaverWarriorFLModule {

	/**
	 * Parent class constructor.
	 * @method __construct
	 */
	public function __construct(){
		FLBuilderModule::__construct(
			array(
				'name'            => __('Post Feed', 'fl-builder'),
				'description'     => __('A Post Feed Module', 'fl-builder'),
				'category'        => __('Space Station', 'skeleton-warrior'),
				'dir'             => $this->getModuleDirectory( __DIR__ ),
				'url'             => $this->getModuleDirectoryURI( __DIR__ ),
				'editor_export'   => true,
				'enabled'         => true,
				'partial_refresh' => true
			)
		);
	}
}

FLBuilder::register_module(
	'BWPostFeed', array(
		'general' => array(
			'title' => __( 'General', 'fl-builder'),
			'sections' => array(
				'section_general' => array(
					'fields' => [
						'posts_per_page' => [
							'type' => 'unit',
							'label' => __('Posts Per Page', 'fl-builder'),
							'default' => 8
						],
						'columns_desktop' => [
							'type' => 'unit',
							'label' => __('Columns - Desktop', 'fl-builder'),
							'default' => 4
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
							'label' => __('Default Post Image', 'fl-builder')
						]
					]
				)
			)
		),
		'blog_posts_loop' => array(
		  'title'     => __( 'Loop Settings', 'fl-builder' ),
		  'file'      => FL_BUILDER_DIR . 'includes/ui-loop-settings.php',
		),
	)
);