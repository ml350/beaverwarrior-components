<?php

$wrapper_classes = [
    "class" => ["ArticleSingleInfo-wrapper"],
    "id" => 'ArticleSingleInfo-'.$id,
];

$url = urlencode(get_permalink());
$title = urlencode(get_the_title());

$twitter = "https://twitter.com/intent/tweet?text=" . $title . "&url=" . $url;

$twitter_user = get_theme_mod('skeleton_warrior_social_twitteruser');
if ($twitter_user === FALSE || $twitter_user === "") {
    $twitter .= "&via=" . $twitter_user;
}

$facebook = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
$linkedin = "https://www.linkedin.com/sharing/share-offsite/?url=" . $url;


$author = get_field('author_settings');
$repeaters = $author['follow_author'];

?>

<section <?php echo spacestation_render_attributes($wrapper_classes); ?>>
    <div class="ArticleSingleInfo-inner" >   
    <?php if (FLBuilderModel::is_builder_active() ): ?>
        <div class="fl-builder-module-placeholder-message">
            <?php _e( 'article_single_info', 'skeleton-warrior' ); ?>
        </div>
    <?php else: ?>
        <?php 
            if($settings->position == 'sidebar'):
            ?>
            <div class="ArticleSingleInfo-sidebar">
                <div class="ArticleSingleInfo-author">
                    <div class="ArticleSingleInfo-author-wrapper">
                        <span><img class="ArticleSingleInfo-author_image" src="<?php echo $author['icon']['sizes']['custom_article_author'] ?>"></span>
                        <span><h4 class="ArticleSingleInfo-author_name"><?php echo $author['title'] ?></h4></span>
                        <?php echo $author['content']?>
                    </div>
                </div>
                <h5 class="fl-heading">
                    <span class="fl-heading-text"><?php _e( 'Jump to Section', 'skeleton-warrior' ); ?></span>
                </h5>

                <ol class="ArticleSingleInfo-sidebar-list"></ol>
                <nav class="ArticleSingleInfo-share">
                    <h4><?php echo __('Share Now', 'skeleton_warrior'); ?></h4>
                    <ul class="Article-share_links">
                        <li><a href="<?php echo $facebook; ?>" class="ArticleSingleInfo-share_link--facebook" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/share-fb.svg" class="facebook_icon"></a></li>
                        <li><a href="<?php echo $linkedin; ?>" class="ArticleSingleInfo-share_link--linkedin" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/share-ln.svg" class="linkedin_icon"></a></li>
                        <li><a href="<?php echo $twitter; ?>" class="ArticleSingleInfo-share_link--twitter" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/share-tw.svg" class="twitter_icon"></a></li>
                    </ul>
                </nav>
            </div> 
            <?php else: ?>
            
            <div class="ArticleSingleInfo-content">

                <?php  the_content();?>

                <?php if($author): ?>
                    <div class="ArticleSingleInfo-author">
                        <div class="ArticleSingleInfo-SectionTitle" >- <?php _e('About The Author', 'skeleton-warrior') ?></div>
                        <div class="ArticleSingleInfo-author-wrapper">
                            <span><img class="ArticleSingleInfo-author_image" src="<?php echo $author['icon']['sizes']['custom_article_author'] ?>"></span>
                            <span><h4 class="ArticleSingleInfo-author_name"><?php echo $author['title'] ?></h4></span>
                            <?php echo $author['content']?>
                            <?php if($repeaters): ?>
                                <div class="ArticleSingleInfo-author_share">
                                    <div class="ArticleSingleInfo-author_share_title"><?php echo $author['follow_title']; ?> </div>
                                    <ul class="ArticleSingleInfo-author_icons">
                                    <?php foreach($repeaters as $repeater): ?>
                                        <li class="ArticleSingleInfo-author_icons-item">
                                            <span class="ArticleSingleInfo-author_icons-span">
                                                <a href="<?php echo $repeater['icon_url']['url']; ?>" target="<?php echo $repeater['icon_url']['target']; ?>">
                                                    <img class="ArticleSingleInfo-author_icons_image" src="<?php echo $repeater['icon_share']['url'] ?>">
                                                </a>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="ArticleSingleInfo-comments">
                    <?php 
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif; ?>
                </div>
            </div>
        <?php endif; ?>
     <?php endif; ?>
    </div>
</section>
