/**
 * Colors
 */
.fl-node-<?php echo $id; ?> .FeaturedSpeakers-wrapper > h2 {
    color: <?php echo FLBuilderColor::hex_or_rgb($settings->speakers_heading_color); ?>;
}
.fl-node-<?php echo $id; ?> .FeaturedSpeakers-wrapper > p {
    color: <?php echo FLBuilderColor::hex_or_rgb($settings->speakers_heading_color); ?>;
}

.fl-node-<?php echo $id; ?> .FeaturedSpeakers--media__body--heading {
    color: <?php echo FLBuilderColor::hex_or_rgb($settings->speakers_heading_color); ?>;
}
.fl-node-<?php echo $id; ?> .FeaturedSpeakers--media__body--p{
    color: <?php echo FLBuilderColor::hex_or_rgb($settings->speakers_content_color); ?>;
}

.fl-node-<?php echo $id; ?> .FeaturedSpeakers--media__body--link{
    color: <?php echo FLBuilderColor::hex_or_rgb($settings->speakers_link_color ); ?>;
}

<?php

/**
 * Typography
 */
FLBuilderCSS::typography_field_rule( array(
    'settings'    => $settings,
    'setting_name'    => 'speakers_title_typography', 
    'selector'    => ".fl-node-$id .FeaturedSpeakers-wrapper > h2",
) );

FLBuilderCSS::typography_field_rule( array(
    'settings'    => $settings,
    'setting_name'    => 'speakers_desc_typography', 
    'selector'    => ".fl-node-$id .FeaturedSpeakers-wrapper > p",
) );


FLBuilderCSS::typography_field_rule( array(
    'settings'    => $settings,
    'setting_name'    => 'speakers_heading_typography', 
    'selector'    => ".fl-node-$id .FeaturedSpeakers--media__body--heading",
) );
FLBuilderCSS::typography_field_rule( array(
    'settings'    => $settings,
    'setting_name'    => 'speakers_content_typography', 
    'selector'    => ".fl-node-$id .FeaturedSpeakers--media__body--p",
) );

FLBuilderCSS::typography_field_rule( array(
    'settings'    => $settings,
    'setting_name'    => 'speakers_link_typography', 
    'selector'    => ".fl-node-$id .FeaturedSpeakers--media__body--link",
) );

?>
