<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SuperAds
 */

get_header(); ?>
<div id="primary" class="content-area content-left" itemprop="mainContentOfPage">
		<main id="main" class="site-main" role="main" itemtype="https://schema.org/Blog" itemscope="itemscope">

		<!-- ads after slideshow -->
		<?php superads_lite_ads_bellow_slideshow(); ?>

		<!-- Render Post -->
		<?php superads_lite_post_render(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
