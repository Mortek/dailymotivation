<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package SuperAds
 */

if (! function_exists('superads_lite_header_code')):
	
	/**
	|------------------------------------------------------------------------------
	| Header Code Theme Option
	|------------------------------------------------------------------------------
	| 
	| @return void
	|
	*/

	function superads_lite_header_code() {
		echo html_entity_decode (get_theme_mod('superads_lite_header_code'), ENT_QUOTES);
	}
	add_action('wp_head','superads_lite_header_code');
endif;

if (! function_exists('superads_lite_tracking_code')):

	/**
	|------------------------------------------------------------------------------
	| Tracking Code Theme Option
	|------------------------------------------------------------------------------
	| 
	| @return void
	|
	*/

	function superads_lite_tracking_code() {
		echo html_entity_decode(get_theme_mod('superads_lite_footer_code'), ENT_QUOTES);
	}

	add_action('wp_footer','superads_lite_tracking_code');

endif;
/**
 |------------------------------------------------------------------------------
 | Adds custom classes to the array of body classes.
 |------------------------------------------------------------------------------
 |
 | @param array $classes Classes for the body element.
 | @return array
 |
 */
 
function superads_lite_body_classes( $classes ) {
		
	// Switch Sidebar Layout to left
	if ( 'left-sidebar' == get_theme_mod('superads_lite_sidebar_layout') ) {
		$classes[] = 'left-sidebar';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'superads_lite_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :

	/**
	|------------------------------------------------------------------------------
	| Filters wp_title to print a neat <title> tag based on what is being viewed.
	|------------------------------------------------------------------------------
	|
	| @param string $title Default title text for current view.
	| @param string $sep Optional separator.
	| @return string The filtered title.
	|
	*/

	function superads_lite_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'superads-lite' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'superads_lite_wp_title', 10, 2 );

	/**
	|------------------------------------------------------------------------------
	| Title shim for sites older than WordPress 4.1.
	|------------------------------------------------------------------------------
	| @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	| @todo Remove this function when WordPress 4.3 is released.
	| 
	*/
	function superads_lite_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'superads_lite_render_title' );
endif;

if ( ! function_exists( 'superads_lite_excerpt_more' ) ) {
	/**
	|------------------------------------------------------------------------------
	| Excerpt ending
	|------------------------------------------------------------------------------
	| 
	| @return string
	|
	*/

	function superads_lite_excerpt_more( $more ) {
		return get_theme_mod('superads_lite_general_excerpt_end_text', '...');
	}
	
}

add_filter( 'excerpt_more', 'superads_lite_excerpt_more' );

if ( ! function_exists( 'superads_lite_excerpt_length' ) ) {

	/**
	|------------------------------------------------------------------------------
	| Excerpt length
	|------------------------------------------------------------------------------
	| 
	| @return integer
	|
	*/

	function superads_lite_excerpt_length($length) {

		$number = intval (get_theme_mod('superads_lite_general_excerpt_lengh')) > 0 ?  intval (get_theme_mod('superads_lite_general_excerpt_lengh')) : $length;
		return $number;
	}
	
}

add_filter( 'excerpt_length', 'superads_lite_excerpt_length', 999 );


if (! function_exists('superads_lite_related_posts') ):

	/**
	|------------------------------------------------------------------------------
	| Related Posts
	|------------------------------------------------------------------------------
	|
	| You can show related posts by Categories or Tags. 
	| It has two options to show related posts
	|
	| 1. Thumbnail related posts (default)
	| 2. List of related posts
	| 
	| @return void
	|
	*/

	function superads_lite_related_posts() {
		global $post;

		$taxonomy = get_theme_mod('superads_lite_single_related_post_taxonomy', 'category');
		$numberRelated = 3; 
		$args =  array();

		if ($taxonomy == 'tag') {

			$tags = wp_get_post_tags($post->ID);
			$arr_tags = array();
			foreach($tags as $tag) {
				array_push($arr_tags, $tag->term_id);
			}
			
			if (!empty($arr_tags)) { 
			    $args = array(  
				    'tag__in' => $arr_tags,  
				    'post__not_in' => array($post->ID),  
				    'posts_per_page'=> $numberRelated,
			    ); 
			}

		} else {

			 $args = array( 
			 	'category__in' => wp_get_post_categories($post->ID), 
			 	'posts_per_page' => $numberRelated, 
			 	'post__not_in' => array($post->ID) 
			 );

		}

		if (! empty($args) ) {
			$posts = get_posts($args);

			if ($posts) {

			?>
			<h3><?php _e('Related quotes and videos', 'superads-lite') ?></h3>
				<ul class="related grid">
				<?php
				foreach ($posts as $p) {
					
					?>

					<li>
						<div class="related-entry">
							<?php if (has_post_thumbnail($p->ID)) : ?>
							<div class="thumbnail">
								<a href="<?php echo get_the_permalink($p->ID) ?>">
								<?php 
									echo get_the_post_thumbnail($p->ID, 'post_thumbnail') 
								?>
								</a>
							</div>
							<?php endif; ?>
							<a href="<?php echo get_the_permalink($p->ID) ?>"><?php echo get_the_title($p->ID) ?></a>
						</div>
					</li>
					<?php
				}
				?>
				</ul>
				<?php
			}
		}
	}
endif;

/**
	|------------------------------------------------------------------------------
	| Post Render
	|------------------------------------------------------------------------------
	| 
	| @return void
	|
	*/
function superads_lite_post_render() {
	 if ( have_posts() ) : ?>
			<?php if (get_theme_mod('superads_lite_general_layout') != 'grid_post') : ?>
			<div id="post-container" class="post-item-list-view">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div id="post-container" class="post-item-grid-view clearfix">
				
				<?php /* Start the Loop */ ?>
				<?php
				 	while ( have_posts() ) : the_post(); 
				 ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'grid' );
					?>

				<?php 
					
					endwhile; 
				?>
				
			</div>
		<?php endif; ?>

			<?php superads_lite_the_posts_navigation(); ?>

	<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif;
}

/**
	|------------------------------------------------------------------------------
	| Array Category
	|------------------------------------------------------------------------------
	| 
	| @return array
	|
	*/
function superads_lite_get_category_list() {
	$categories = get_categories();
	$cats = array();
	
	foreach ($categories as $cat) {
		
		$cats[$cat->cat_ID] = $cat->name;
	}

	return $cats;
}