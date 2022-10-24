<?php

/**
 * @class BWArticleSlider
 *
 */
class BWArticleSlider extends BeaverWarriorFLModule {

	/**
	 * Parent class constructor.
	 * @method __construct
	 */
	public function __construct(){
		FLBuilderModule::__construct(
			array(
				'name'            => __('Article Slider', 'fl-builder'),
				'description'     => __('A Article Slider Module', 'fl-builder'),
				'category'        => __('Space Station', 'fl-builder'),
				'dir'             => $this->getModuleDirectory( __DIR__ ),
				'url'             => $this->getModuleDirectoryURI( __DIR__ ),
				'editor_export'   => true,
				'enabled'         => true,
				'partial_refresh' => true
			)
		);
	}
}

FLBuilder::register_module('BWArticleSlider', array(
    'settings' => array(
    'title' => __( 'Settings', 'fl-builder'),
    'sections' => array(
        'title' => array(
            'fields' => array(
                'posts_per_page' => array(
                'type'        => 'unit',
                'label'       => 'Show Posts',
                'default'     => 3,
                ),
                'article_main_name' => array(
                    'type'  => 'text',
                    'label' => __( 'Main Title', 'fl-builder' ),
                ),
                'article_button' => array(
                    'type'  => 'text',
                    'label' => __( 'Button Text', 'fl-builder' ),
                ),
                'article_button_link' => array(
                    'type'          => 'link',
                    'label'         => __('Button Link', 'fl-builder'),
                    'show_target'   => true,
                    'show_nofollow' => false
                  ),
            )
        )
    )
    ),
    'blog_posts_loop' => array(
      'title'     => __( 'Loop Settings', 'fl-builder' ),
      'file'      => FL_BUILDER_DIR . 'includes/ui-loop-settings.php',
    ),
));