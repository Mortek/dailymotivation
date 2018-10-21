<?php
/**
 * Default post render
 *
 * @package SuperAds
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item clearfix'); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php endif; ?>
		<div class="post-item-desc">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php 
					the_excerpt();
				?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'superads-lite' ),
						'after'  => '</div>',
					) );
				?>

			</div><!-- .entry-content -->
		</div>
	</article><!-- #post-## -->