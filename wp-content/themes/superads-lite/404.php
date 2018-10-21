<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package SuperAds
 */

get_header(); ?>

	<div id="primary" class="content-area content-left" itemprop="mainContentOfPage">
		<main id="main" class="site-main" role="main" itemtype="http://schema.org/Blog" itemscope="itemscope">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title" itemprop="headline"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'superads-lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'superads-lite' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
