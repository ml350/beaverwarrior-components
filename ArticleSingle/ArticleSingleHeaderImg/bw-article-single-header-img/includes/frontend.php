<?php

$wrapper_classes = [
    "class" => ["ArticleSingleHeaderImg-wrapper"],
    "id" => 'ArticleSingleHeaderImg-'.$id,
];

?>
<section <?php echo spacestation_render_attributes($wrapper_classes); ?>>
    <div class="ArticleSingleHeaderImg-inner" >   
        <?php if (FLBuilderModel::is_builder_active() ): ?>
            <div class="fl-builder-module-placeholder-message">
                <?php _e( 'article_single_header_img', 'skeleton-warrior' ); ?>
            </div>
        <?php else: ?>
            <div class="ArticleSingleHeaderImg--main">
                <?php 
                    $articleImage = the_post_thumbnail('custom_article_thumbnail');
                    if($articleImage ): ?>
                        <div class="img-responsive">
                            <?php echo $articleImage ?>
                        </div>
                <?php endif ?>
            </div>
        <?php endif; ?>
    </div>
</section>
