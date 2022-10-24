<?php
$desktop_width = 100 / (float)$module->settings->columns_desktop;
$tablet_width = 100 / (float)$module->settings->columns_tablet;
$mobile_width = 100 / (float)$module->settings->columns_mobile;
?>

.fl-module-bw-category-feed .category-feed-container .category-container .category{
	width: calc(<?php echo $desktop_width; ?>% - 30px);
}
@media screen and (max-width: 1024px){
	.fl-module-bw-category-feed .category-feed-container .category-container .category{
		width: calc(<?php echo $tablet_width; ?>% - 30px);
	}
}

@media screen and (max-width: 768px){
	.fl-module-bw-category-feed .category-feed-container .category-container .category{
		width: calc(<?php echo $mobile_width; ?>% - 30px);
	}
}