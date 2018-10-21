<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SuperAds
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<div id="page" class="hfeed site container">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'superads-lite' ); ?></a>

	<header id="masthead" class="site-header header" role="banner" itemtype="http://schema.org/WPHeader" itemscope="itemscope">
		<?php if ( has_nav_menu( 'top' ) ) : ?>
		<div class="top-nav primary-navigation"> <!-- Top MENU -->
			<div class="inner">
				<a class="mobile-only mobile-menu toggle-mobile-menu" href="#" title="Menu"><?php _e('Main Navigation', 'superads-lite') ?> <i class="fa fa-bars"></i></a>
				<?php wp_nav_menu( array('theme_location' => 'top', 'container' => false, 'menu_class' => 'menu clearfix') ); ?> 
			</div>
		</div> <!-- ./Top MENU -->
	<?php endif; ?>
		<div class="site-branding"> <!-- Site Branding -->
			<div class="inner clearfix">
				<div class="logo">
					<?php superads_lite_header_title() ?>
				</div>
				
				<?php superads_lite_ads_header() ?>

			</div>
		</div> <!-- ./Site Branding -->
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="site-navigation" class="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<div  class="main-nav">
						<div class="inner clearfix">
							<a class="mobile-only mobile-menu toggle-mobile-menu" href="#" title="Menu"><?php _e('Main Navigation', 'superads-lite') ?> <i class="fa fa-bars"></i></a>
							<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu clearfix') ); ?> 
						</div>
					</div>
					<div id="catcher"></div>
				</nav><!-- #site-navigation -->
			<?php else : ?>
				<nav id="site-navigation" class="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<div class="main-nav">
						<div class="inner clearfix">
							<a class="mobile-only mobile-menu toggle-mobile-menu" href="#" title="Menu"><?php _e('Main Navigation', 'superads-lite') ?> <i class="fa fa-bars"></i></a>
							<ul id="menu-main-menu" class="menu clearfix">
								<?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
							</ul>
						</div>
					</div>
					<div id="catcher"></div>
				</nav><!-- #site-navigation -->
			<?php endif; ?>
	</header><!-- #masthead -->

	<?php
		// for page condition
		$class = '';
		if (is_page()) {
			if ( is_page_template( 'page-sidebar-left.php' )) {
				$class = 'sidebar-left';
			} else if ( is_page_template( 'page-no-sidebar.php' )) {
				$class = 'no-sidebar';
			} else {
				$class = 'sidebar-right';
			}
		}
	?>

	<div id="content" class="site-content content <?php echo $class; ?>">
	<div class="inner clearfix">
	<?php  superads_lite_ads_after_main_nav() ?>
		<div class="main-content clearfix">
