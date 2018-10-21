<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SuperAds
 */

get_header(); ?>

	<div id="primary" class="content-area content-left" itemprop="mainContentOfPage">
		<main id="main" class="site-main" role="main" itemtype="http://schema.org/Blog" itemscope="itemscope">

		<?php 
			if ( is_home() ) {
				get_template_part( 'content', 'slide' ); 
			}
		?>
		<!-- ads after slideshow -->
		<?php superads_lite_ads_bellow_slideshow(); ?>

		<!-- Render Post -->
		<?php superads_lite_post_render(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
