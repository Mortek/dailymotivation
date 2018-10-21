<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SuperAds
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/BlogPosting" itemscope="itemscope">
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php superads_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php superads_lite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
