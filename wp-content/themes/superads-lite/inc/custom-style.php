<?php 

/**
|------------------------------------------------------------------------------
| Generate custom style from theme option
|------------------------------------------------------------------------------
 */

function superads_lite_custom_style() {
	?>
	<style type="text/css">

		/* Main Navigtiona  */
		
		.main-nav {
			background: <?php echo esc_html( get_theme_mod('superads_lite_style_primary_bg_color') ) ?>;
		}

		ul.menu li:hover, 
		ul.menu li a:hover, 
		ul.menu li.current-menu-parent > a, 
		ul.menu li.current-menu-ancestor > a, 
		ul.menu li.current_page_ancestor > a, 
		ul.menu li.current-menu-item > a {
			background: <?php echo esc_html( get_theme_mod('superads_lite_style_primary_hover_active_bg_color') ) ?>;
		}
		ul.menu ul {
			background: <?php echo esc_html( get_theme_mod('superads_lite_style_primary_sub_bg_color') ) ?>;
		}
		ul.menu li .arrow-sub-menu,
		.site-header .main-nav .mobile-menu,
		.main-nav ul.menu li a {
			  color: <?php echo esc_html( get_theme_mod('superads_lite_style_primary_item_color') ) ?>;
		}
		.main-nav ul.menu > li {
			border-color: <?php echo esc_html( get_theme_mod('superads_lite_style_primary_border_color') ) ?>;
		}

		/* Link color */
		a, .widget ul li a, .f-widget ul li a .site-footer .textwidget {
			color: <?php echo esc_html( get_theme_mod('superads_lite_anchor_text_color') ) ?>;
		}

	</style>
	<?php
}
add_action('wp_head','superads_lite_custom_style');