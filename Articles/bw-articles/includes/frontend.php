<?php 
    $wrapper_attributes = [
        "class"     => ["Articles-content"],
        "id"        => "Articles",
        "style"     => ["background: transparent;", "padding: 0px;"]
    ]
?>

<div <? echo spacestation_render_attributes($wrapper_attributes); ?> >
    <h2 class="Articles-content--section-title"> <? if($settings->section_title) : echo $settings->section_title; endif; ?> </h2>
    <div class="Articles-content--cards-wrapper"> 
        <?
            $query = FLBuilderLoop::query( $settings );
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post(); 
                $post_type = get_post_type(get_the_ID());   
                $taxonomies = get_object_taxonomies($post_type);   
                $taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
                    ?>
                    <div class="Articles-content--card">
                        <div class="Articles-content--card-image">
                            <img src="<? echo get_the_post_thumbnail_url(); ?>" alt="<? the_title(); ?>">
                        </div>
                        <div class="Articles-content--card-content">
                            <h6 class="Articles-content--card-tag"> <? if(!empty($taxonomy_names)) : foreach($taxonomy_names as $tax_name) : echo $tax_name; endforeach; endif; ?> </h6>
                            <h5 class="Articles-content--card-title"> <? the_title(); ?> </h5>
                            <? the_excerpt(); ?>
                            <div class="link-button"> 
                                <a class="Articles-postLink fl-button" role="button" href="<? get_post_permalink(get_the_ID()); ?>">
                                    <span class="fl-button-text"> Learn More </span>
                                </a>
                            </div>
                        </div>
                    </div>
            <? endwhile;
            endif;
            wp_reset_postdata();
        ?>   
    </div>
</div>