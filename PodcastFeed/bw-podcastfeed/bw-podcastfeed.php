<?php 
/**
 * @class BWPodcastFeed
 * 
 */ 
class BWPodcastFeed extends BeaverWarriorFLModule {
    /**
     * Parent class constructor
     * @method __construct
     */
    public function __construct(){
        FLBuilderModule::__construct(
            array(
                'name'              =>  __("Podcast Feed", "fl-builder"),
                'description'       =>  __("Podcast Feed grid with filtering and pagination", "fl-builder"),
                'category'          =>  __("Space Station", "fl-builder"),
                'dir'               => $this->getModuleDirectory(__DIR__),
                'url'               => $this->getModuleDirectory(__DIR__),
                'ediotr_export'     => true,
                'enabled'           => true,
                'partial_refresh'   => true
            )
        );


        // Register and enqueue your own 
        $this->add_css('pagination-css', get_stylesheet_directory_uri() . '/assets/vendor/pagination/pagination.min.css');
        $this->add_js('pagination-js', get_stylesheet_directory_uri() . '/assets/vendor/pagination/pagination.min.js', array(), '', true);
    }

    
}   

FLBuilder::register_module(
    'BWPodcastFeed', array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'fields' => array( 
                        'posts_per_page' => [
                            'type' => 'unit',
                            'label' => __('Posts Per Page', 'fl-builder'),
                            'default' => 12
                        ],
                        'post_type' => [
                            'type' => 'text',
                            'label' => __('Select post type to loop.'),
                            'default' => 'podcast'
                        ], 
                        'no_results_message' => array(
                            'type'      => 'text',
                            'label'     => __('No resulsts message')
                        )
                    )
                ),
            )
        ),
        'loop_settings' => [
            'title' => __('Loop Settings', 'fl-builder'),
            'file'  => FL_BUILDER_DIR . 'includes/ui-loop-settings.php'
        ]
    )
);
