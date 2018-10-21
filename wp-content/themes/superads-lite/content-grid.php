	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('superads-lite-post-thumbnails-grid'); ?></a>
			</div>
		<?php endif; ?>
		<div class="post-item-desc">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header><!-- .entry-header -->
		</div>
	</article>
