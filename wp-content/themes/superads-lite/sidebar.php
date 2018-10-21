<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package SuperAds
 */


?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area sidebar" role="complementary" itemtype="http://schema.org/WPSideBar" itemscope="itemscope">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>