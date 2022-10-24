<?php

/**
 * @class BWArticleSingleHeaderImg
 *
 */
class BWArticleSingleHeaderImg extends BeaverWarriorFLModule {

    /**
     * Parent class constructor.
     * @method __construct
     */
    public function __construct(){
        FLBuilderModule::__construct(
            [
                'name'            => __('Article Single Header Img', 'skeleton-warrior'),
                'description'     => __('Single Header Img', 'skeleton-warrior'),
                'category'        => __('Space Station', 'skeleton-warrior'),
                'dir'             => $this->getModuleDirectory( __DIR__ ),
                'url'             => $this->getModuleDirectoryURI( __DIR__ ),
                'editor_export'   => true,
                'enabled'         => true,
                'partial_refresh' => true
            ]
        );
        register_custom_image_size( 'custom_article_thumbnail', 509, 509, true );
    }
}


FLBuilder::register_module( 'BWArticleSingleHeaderImg', array(

) );

