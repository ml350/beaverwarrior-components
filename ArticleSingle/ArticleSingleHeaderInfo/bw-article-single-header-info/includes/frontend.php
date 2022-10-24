<?php

$wrapper_classes = [
    "class" => ["ArticleSingleHeaderInfo-wrapper"],
    "id" => 'ArticleSingleHeaderInfo-'.$id,
];

$date_format = get_option( 'date_format' );
$post_description_below_title = get_field( 'post_description_below_title' );
$authors = get_field('select_authors'); 
?>
<section <?php echo spacestation_render_attributes($wrapper_classes); ?>>
    <div class="ArticleSingleHeaderInfo-wrapp">   
        <div class="ArticleSingleHeaderInfo-inner">   
            <?php if (FLBuilderModel::is_builder_active() ): ?>
                <div class="fl-builder-module-placeholder-message">
                    <?php _e( 'article_single_header_info', 'skeleton-warrior' ); ?>
                </div>
            <?php else: ?>
                <div class="ArticleSingleHeaderInfo--top">
                    <span class="ArticleSingleHeaderInfo-date gradient-underline">
                        <p><?php echo get_the_date( $date_format, $post_id ) ?></p>
                    </span>
    
                    <?php the_title( '<h1 class="ArticleSingleHeaderInfo-article_title ArticleSingleHeaderInfo--common">', '</h1>' ); ?>
                    <div class="ArticleSingleHeaderInfo-author_title"><?php _e( 'By', 'skeleton_warrior' ); ?> <?php echo get_the_author(); ?></div>

                    <?php if($post_description_below_title): ?>
                        <div class="ArticleSingleHeaderInfo-description ">
                            <?php echo $post_description_below_title ?>
                        </div>
                    <?php endif ?>
                   
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
