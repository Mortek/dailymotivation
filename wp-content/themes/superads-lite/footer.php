<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SuperAds
 */
?>
			</div> <!-- .main-content -->
			<?php superads_lite_ads_before_footer() ?>
		</div> <!-- .inner -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		<div class="inner clearfix">
			<div class="f-left">
			<?php superads_lite_footer_copyright(); ?>
			</div>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<div class="f-right">
					<?php wp_nav_menu( array('theme_location' => 'footer', 'container' => false, 'menu_class' => 'menu') ); ?> 
				</div>
			<?php endif; ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<span class="back-to-top"><i class="fa fa-angle-double-up"></i></span>
</body>
</html>
