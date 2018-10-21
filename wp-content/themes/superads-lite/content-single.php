<?php
/**
 * @package SuperAds
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
	<header class="entry-header">
		
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
			<div class="entry-meta">
				<?php 
					superads_lite_posted_on(); 
					superads_lite_entry_footer();
				?>
			</div><!-- .entry-meta -->		
		<div class="floating-to-right sharing-top-float"><?php superads_lite_social_icons('social-sharing-left');?></div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'superads-lite' ),
				'after'  => '</div>',
			) );
		?>
		
	</div><!-- .entry-content -->
</article><!-- #post-## -->

<div class="related-posts clear">
		<?php superads_lite_related_posts() ?>
</div>


