<?php
/**
 * Template Name: No Sidebar
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SuperAds
 */

get_header(); ?>

	<div id="primary" class="content-area content-left" itemprop="mainContentOfPage">
		<main id="main" class="site-main" role="main" itemtype="http://schema.org/Blog" itemscope="itemscope">


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>
				
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
