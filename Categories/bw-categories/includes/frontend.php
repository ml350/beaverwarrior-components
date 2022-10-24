<?php

$wrapper_classes = [
    "class" => ["Categories-wrapper"],
    "id" => 'Categories-'.$id,
];

?>
<section <?php echo spacestation_render_attributes($wrapper_classes); ?>>

    <div class="Categories-inner row">
        <?php if($settings->select_text): ?>
            <p class="Categories-inner--p"><?php echo $settings->select_text; ?></p>
        <?php else: ?>
            <?php if($settings->one_or_many == 'one'): ?>
                <p class="Categories-inner--p"><?php echo get_cat_name($settings->select_category); ?></p>
            <?php endif; ?>
            
            <?php if($settings->one_or_many == 'many'): ?>
                <?php foreach($settings->select_multiple_categories as $cat): ?>
                    <label><?php echo get_cat_name($cat); ?></label>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if($settings->one_or_many == 'from_posts'): ?>
                <?php
                    $cpt = get_the_category(get_the_ID());
                    
                foreach($cpt as $cat): 
                    if($cat->name != 'Locked Content'): ?>
                    <label><?php echo $cat->name; ?></label>
                <?php endif; endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</section>
