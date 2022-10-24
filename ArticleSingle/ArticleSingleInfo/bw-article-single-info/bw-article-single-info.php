<?php

/**
 * @class BWArticleSingleInfo
 *
 */
class BWArticleSingleInfo extends BeaverWarriorFLModule {

    /**
     * Parent class constructor.
     * @method __construct
     */
    public function __construct(){
        FLBuilderModule::__construct(
            [
                'name'            => __('Article Single Info', 'skeleton-warrior'),
                'description'     => __('Article Single Info', 'skeleton-warrior'),
                'category'        => __('Space Station', 'skeleton-warrior'),
                'dir'             => $this->getModuleDirectory( __DIR__ ),
                'url'             => $this->getModuleDirectoryURI( __DIR__ ),
                'editor_export'   => true,
                'enabled'         => true,
                'partial_refresh' => true
            ]
        );
        register_custom_image_size( 'custom_article_author', 51, 51, true );

    }
}


FLBuilder::register_module( 'BWArticleSingleInfo', array(
    'general' => array(
		'title'    => __( 'General', 'skeleton-warrior' ),
		
		'sections' => array(
			'general'  => array(
				'title'  => 'Position Widget',
				'fields' => array(
                    'position' => array(
                        'type'          => 'select',
                        'label'         => __( 'Select Position', 'skeleton-warrior' ),
                        'default'       => 'main-content',
                        'options'       => array(
                            'main-content'      => __( 'Main Content', 'skeleton-warrior' ),
                            'sidebar'      => __( 'Sidebar', 'skeleton-warrior' )
                        ),
                    ),
                ),
			),
		),
	),
) );

