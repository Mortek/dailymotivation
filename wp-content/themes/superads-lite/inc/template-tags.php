<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package SuperAds
 */

if ( ! function_exists('superads_lite_header_title') ) :
	function superads_lite_header_title() {
		$logo = get_theme_mod('superads_lite_logo');
		?>
			<?php if ( !empty($logo) ) : ?>
				<meta itemprop="logo" content="<?php echo esc_url($logo); ?>">
				<?php if( is_front_page() || is_home() ) : ?>
				<h1 class="site-title logo" itemprop="headline">
					<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'description' ); ?>">
						<img src="<?php echo esc_url($logo ); ?>" alt="<?php bloginfo( 'description' ); ?>" />
					</a>
				</h1>
				<?php else : ?>
					<h2 class="site-title logo" itemprop="headline">
						<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'description' ); ?>">
							<img src="<?php echo esc_url($logo ); ?>" alt="<?php bloginfo( 'description' ); ?>" />
						</a>
					</h2>
				<?php endif ?>
			<?php else : ?>

				<?php if( is_front_page() || is_home() ) : ?>
					<h1 itemprop="headline" class="site-title">
						<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'description' ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php else : ?>
						<h2 class="site-title">
						<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'description' ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
						</h2>
						<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
					<?php endif ?>
			<?php endif ?>
		<?php
	}
endif;
if ( ! function_exists( 'superads_lite_footer_copyright' ) ) :

	function superads_lite_footer_copyright() {
		
		printf( __( '&copy; <b>Daily Motivation</b> ' . date('Y')));
 
	}

endif;
if ( ! function_exists( 'superads_lite_the_posts_navigation' ) ) :
/**
 |------------------------------------------------------------------------------
 | Display navigation to next/previous set of posts when applicable.
 |------------------------------------------------------------------------------
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 */
function superads_lite_the_posts_navigation() {
	
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$nav_style = get_theme_mod ('superads_lite_general_pagination_mode', 'default');

	if ( $nav_style == 'auto') :
		superads_lite_infinite_loading('infinite');
	
	elseif ( $nav_style == 'numberal') :
		// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'superads-lite' ),
				'next_text'          => __( 'Next page', 'superads-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'superads-lite' ) . ' </span>',
			) );
	elseif ($nav_style == 'loadmore') :
		superads_lite_infinite_loading();
	else :
		
	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
		<span class="screen-reader-text"><?php _e( 'Posts navigation', 'superads-lite' ); ?></span>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'superads-lite' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'superads-lite' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	
	
	endif;
}
endif;

/**
|------------------------------------------------------------------------------
| Infinite loading and more button
|------------------------------------------------------------------------------
| 
| @return void
|
*/

function superads_lite_infinite_loading($load_style = 'loadding') {
	global $wp_query;
	$totalPages = $wp_query->max_num_pages;

	if ($totalPages > 1) :

		if ($load_style != 'infinite'):
		?>
			<div id="load-more-wrap">
				<a id="load-more-post" href="#" data-loading="<?php _e('Loading...', 'superads-lite') ?>" data-more="Load More..."><?php _e('Load More...', 'superads-lite') ?></a>
			</div>
			
		<?php

		endif;
		?>

		<script type="text/javascript">
			var totalPages = <?php echo $totalPages ?>;
			var loadStyle = '<?php echo $load_style; ?>';
		</script>

		<?php

	endif;
}

if ( ! function_exists( 'superads_lite_the_post_navigation' ) ) :
/**
 |------------------------------------------------------------------------------
 | Display navigation to next/previous post when applicable.
 |------------------------------------------------------------------------------
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 */
function superads_lite_the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'superads-lite' ); ?></h2>
		<div class="nav-links clearfix">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', 'Previous quote' );
				next_post_link( '<div class="nav-next">%link</div>', 'Next quote' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'superads_lite_posted_on' ) ) :

/**
|------------------------------------------------------------------------------
| Prints HTML with meta information for the current post-date/time and author.\
|------------------------------------------------------------------------------
|
*/

function superads_lite_posted_on() {
	$time_string = '<time class="meta entry-date published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'On %s&nbsp;', 'post date', 'superads-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on"> ' . $posted_on . '</span>';
	

}
endif;

if ( ! function_exists( 'superads_lite_entry_footer' ) ) :

/**
|------------------------------------------------------------------------------
| Prints HTML with meta information for the categories, tags and comments.
|------------------------------------------------------------------------------
|
*/

function superads_lite_entry_footer() {
	
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'superads-lite' ) );
		if ( $categories_list && superads_lite_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'In %1$s&nbsp;', 'superads-lite' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'superads-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s&nbsp;', 'superads-lite' ) . '</span>', $tags_list );
		}
	}

	if ( (is_single() && ! post_password_required()) && ( comments_open() || get_comments_number()) ) {

		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment&nbsp;', 'superads-lite' ), __( '1 Comment&nbsp;', 'superads-lite' ), __( '% Comments', 'superads-lite' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'superads-lite' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 |------------------------------------------------------------------------------
 | Shim for `the_archive_title()`.
 |
 | Display the archive title based on the queried object.
 |------------------------------------------------------------------------------
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 | @param string $before Optional. Content to prepend to the title. Default empty.
 | @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'superads-lite' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'superads-lite' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'superads-lite' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'superads-lite' ), get_the_date( _x( 'Y', 'yearly archives date format', 'superads-lite' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'superads-lite' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'superads-lite' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'superads-lite' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'superads-lite' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'superads-lite' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'superads-lite' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'superads-lite' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'superads-lite' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'superads-lite' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 |------------------------------------------------------------------------------
 | Shim for `the_archive_description()`.
 |------------------------------------------------------------------------------
 |
 | Display category, tag, or term description.
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 | @param string $before Optional. Content to prepend to the description. Default empty.
 | @param string $after  Optional. Content to append to the description. Default empty.
 |
 */

function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 |------------------------------------------------------------------------------
 | Returns true if a blog has more than 1 category.
 |------------------------------------------------------------------------------
 |
 | @return bool
 */
function superads_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'superads_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'superads_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so superads_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so superads_lite_categorized_blog should return false.
		return false;
	}
}

/**
|------------------------------------------------------------------------------
| Flush out the transients used in superads_lite_categorized_blog.
|------------------------------------------------------------------------------
|
*/

function superads_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'superads_lite_categories' );
}
add_action( 'edit_category', 'superads_lite_category_transient_flusher' );
add_action( 'save_post',     'superads_lite_category_transient_flusher' );

if (!function_exists('superads_lite_social_icons')) :
	/**
	|------------------------------------------------------------------------------
	| Social Sharing Buttons
	|------------------------------------------------------------------------------
	|
	*/
	function superads_lite_social_icons($position) {
		global $post;
		
	?>
		<div class="superads-social-sharing <?php echo $position ?>">
		<ul class="superads-social-icons">
			
			<li class="facebook">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()) ?>" class="social-popup">
					<i class="fa fa-facebook-square"></i>
			        <span class="text">facebook</span>
				</a>
			</li>
			
			<li class="twitter">
				<a href="http://twitter.com/share?url=<?php echo esc_url(get_the_permalink()) ?>&text=<?php the_title() ?>" class="social-popup">
					<i class="fa fa-twitter"></i>
			        <span class="text">tweet</span>
				</a>
			</li> 
			
			<li class="googleplus">
				<a href="https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()) ?>" class="social-popup">
					<i class="fa fa-google-plus"></i>
			        <span class="text">google+</span>
				</a>
			</li>
			
		</ul>
		</div>
		<?php
	}
endif;
