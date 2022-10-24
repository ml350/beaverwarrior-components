<?php

/**
 * @class BWRelatedEpisodes
 *
 */
class BWRelatedEpisodes extends BeaverWarriorFLModule {
	/**
	 * Parent class constructor.
	 * @method __construct
	 */
	public function __construct(){
		FLBuilderModule::__construct(
			array(
				'name'            => __('Related Episodes', 'fl-builder'),
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
	'BWRelatedEpisodes', array(
		'general' => array(
			'title' => __( 'General', 'fl-builder'),
			'sections' => array(
				'section_general' => array(
					'fields' => [
                        'section_title' => [
                            'type' => 'text',
                            'label' => __("Section Title", 'fl-builder')
                        ],
						'posts_per_page' => [
							'type' => 'unit',
							'label' => __('Posts Per Page', 'fl-builder'),
							'default' => 4
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