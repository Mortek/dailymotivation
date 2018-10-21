<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wimplepro
 */
?>
		  
<?php
	$limit_slide = 5;
	$cats = get_theme_mod('superads_lite_slideshow_category_type');



	$args = array( 
		'category__in' 		=> $cats, 
		'posts_per_page' 	=> $limit_slide
	);
	
	$slide_posts = new WP_Query( $args );

	if ( $slide_posts->have_posts() ) :

	?>
	<div class="section-slide">
		<!--  Outer wrapper for presentation only, this can be anything you like -->
		<div id="bannerSlide">
			<div class="flexslider">
			<!-- Place somewhere in the <body> of your page -->
				<ul class="slides">
					<?php /* Start the Loop */ ?>
					<?php 
						while ( $slide_posts->have_posts() ) : $slide_posts->the_post();
						if (has_post_thumbnail()) :
					 ?>
						<li>
							<a href="<?php the_permalink() ?>">
								<?php the_post_thumbnail('superads-lite-homepage-thumb-slider') ?>
							</a>
							<p class="flex-caption"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
						</li>
				
					<?php 
						endif;
						endwhile; 
					?>
				</ul>
			</div>
		</div>
	<!-- End outer wrapper -->
	</div>

	<?php
	endif;
	wp_reset_postdata();
	?>


		