<?php

/**
 * @class BWCategories
 *
 */
class BWCategories extends BeaverWarriorFLModule {

    /**
     * Parent class constructor.
     * @method __construct
     */
    public function __construct(){
        FLBuilderModule::__construct(
            [
                'name'            => __('Categories', 'skeleton-warrior'),
                'description'     => __('Pull One Or Multiple Categories', 'fl-builder'),
                'category'        => __('Space Station', 'skeleton-warrior'),
                'dir'             => $this->getModuleDirectory( __DIR__ ),
                'url'             => $this->getModuleDirectoryURI( __DIR__ ),
                'editor_export'   => true,
                'enabled'         => true,
                'partial_refresh' => true
            ]
        );
    }
    
    public function load_categories() {
        $return_array = array();
        foreach(get_categories() as $category){
            $return_array[$category->cat_ID] = $category->cat_name;
        }
        return $return_array;
    }
    
    public function load_cpt() {
        $return_array = array();
        
        $args = array(
        'public'   => true,
        '_builtin' => false,
        );

        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'

        $post_types = get_post_types( $args, $output, $operator ); 
        foreach($post_types as $type){
            if ($type != 'fl-builder-template' || $type != 'skw_widget') {
                 $return_array[$type] = $type;
            }
//            
        }
//         ww($return_array);
        return $return_array;
    }
};

FLBuilder::register_module('BWCategories', array(
        'general' => array (
            'title' => __('General', 'fl-builder'),
            'sections' => array (
                'general' => array (
                    'title' => "",
                    'fields' => array( 
                        'text_or_catgory' => array(
                            'type'          => 'select',
                            'label'         => __( 'Select option', 'fl-builder' ),
                            'default'       => 'one',
                            'options'       => array(
                                'custom_text'      => __( 'Text', 'fl-builder' ),
                                'category'      => __( 'Category', 'fl-builder' ),
                            ),
                            'toggle'        => array(
                                'custom_text'      => array(
                                    'fields'        => array( 'select_text' ),
                                ),
                                'category'      => array(
                                    'fields'        => array( 'one_or_many, select_category' ),
                                ),
                            )
                        ),
                        'select_text' => array (
                            'type'          => 'text',
                            'label'         => __( 'Add text', 'fl-builder' ),
                            'default'       => '',
                        ),
                        'one_or_many' => array(
                            'type'          => 'select',
                            'label'         => __( 'Select Category', 'fl-builder' ),
                            'default'       => 'one',
                            'options'       => array(
                                'one'      => __( 'One', 'fl-builder' ),
                                'many'      => __( 'Many', 'fl-builder' ),
                                'from_posts'      => __( 'From Custom Post Type', 'fl-builder' )
                            ),
                            'toggle'        => array(
                                'one'      => array(
                                    'fields'        => array( 'select_category' ),
                                ),
                                'many'      => array(
                                    'fields'        => array( 'select_multiple_categories' ),
                                ),
                                'from_posts'      => array(
                                    'fields'        => array( 'select_from_posts_type' ),
                                )
                            )
                        ),
                        'select_category' => array(
                            'type' => 'select',
                            'label' => __("Load categories"),
                            'options' => BWCategories::load_categories(),
                            'description' => __("this works only if category option is selected")
                        ),
                        'select_multiple_categories' => array(
                            'type' => 'select',
                            'label' => __("Load categories"),
                            'options' => BWCategories::load_categories(),
                            'description' => __(""),
                            'multi-select'  => true
                        ),
                        'select_from_posts_type' => array(
                            'type' => 'select',
                            'label' => __("Select custom post type"),
                            'options' => BWCategories::load_cpt(),
                            'description' => __(""),
                        ),
                    )
                ),
            )
        ),
    )
);
