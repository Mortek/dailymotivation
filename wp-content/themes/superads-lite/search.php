<?php
/**
 * The template for displaying search results pages.
 *
 * @package SuperAds
 */

get_header(); ?>

	<section id="primary" class="content-area content-left" itemprop="mainContentOfPage">
		<main id="main" class="site-main" role="main" itemtype="http://schema.org/Blog" itemscope="itemscope">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title" itemprop="headline"><?php printf( __( 'Search Results for: %s', 'superads-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
