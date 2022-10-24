<?php 

    $query = FLBuilderLoop::query( $settings );

    $wrapper_attributes = [
        "class"     => ["RelatedEpisodes-content"],
        "id"        => "RelatedEpisodes",
        "style"     => ["background: transparent;", "padding: 0px;"]
    ]
?>

<div <? echo spacestation_render_attributes($wrapper_attributes); ?> >
    <h2 class="RelatedEpisodes-content--section-title"> <? if($settings->section_title) : echo $settings->section_title; endif; ?> </h2>
    <div class="RelatedEpisodes-content--cards-wrapper"> 
        <?
            $query = FLBuilderLoop::query( $settings );
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post(); 
                $post_type = get_post_type(get_the_ID());   
                $taxonomies = get_object_taxonomies($post_type);   
                $taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
                    ?>
                    <div class="RelatedEpisodes-content--card">  
                        <h6 class="RelatedEpisodes-content--card-tag"> <?  $terms = get_the_terms(get_the_ID(), 'product_tag'); $terms = join(', ', wp_list_pluck($terms, 'name')); echo $terms;?> </h6>
                        <h5 class="RelatedEpisodes-content--card-title"> <? the_title(); ?> </h5>
                        <div class="RelatedEpisodes-content--card-category"><? $terms = get_the_terms(get_the_ID(), 'product_cat'); $terms = join(', ', wp_list_pluck($terms, 'name')); echo $terms; ?></div>
                        <p> <? $excerpt = get_the_content(); $trim = wp_trim_words($excerpt, 10, NULL); echo $trim; ?> </p>
                        <div class="link-button"> 
                            <a class="RelatedEpisodes-postLink fl-button" role="button" href="<? echo get_post_permalink(get_the_ID()); ?>">
                                <span class="fl-button-text"> Listen Now </span>
                            </a>
                        </div> 
                    </div>
            <? endwhile;
            endif;
            wp_reset_postdata();
        ?>   
    </div>
</div>