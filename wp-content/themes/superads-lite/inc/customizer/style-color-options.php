<?php
	  $wp_customize->add_panel( 'panel_styles_colors', array(
			'priority' 			=> 31,
			'capability' 		=> 'edit_theme_options',
			'theme_supports' 	=> '',
			'title' 			=> __( 'Style & Color Options', 'superads-lite' )
		));

		/************************
		* Section: Header Color *
		*************************/
		$wp_customize->add_section( 'superads_lite_style_primary_menu_section' , array(
				'title'      	 	=> __( 'Primary Navigation', 'superads-lite' ),
				'priority'    		=> 1,
				'panel' 			=> 'panel_styles_colors'
		));

		/* Bg Color*/
		$wp_customize->add_setting( 'superads_lite_style_primary_bg_color' , array(
		    'default' 				=> '#f3f2f2',
		    'sanitize_callback' 	=> 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_style_primary_bg_color', array(
		    'label'    				=> __( 'Background Color', 'superads-lite' ),
		    'section'  				=> 'superads_lite_style_primary_menu_section',		    
		    'priority'    			=> 1,
		)));

		/* Hover Color*/
		$wp_customize->add_setting( 'superads_lite_style_primary_hover_active_bg_color' , array(
		    'default' 				=> '#e5e5e5',
		    'sanitize_callback' 	=> 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_style_primary_hover_active_bg_color', array(
		    'label'    				=> __( 'Hover & Active Background', 'superads-lite' ),
		    'section'  				=> 'superads_lite_style_primary_menu_section',
		    'priority'    			=> 2,
		)));

		/* Sub Menu Bg */
		$wp_customize->add_setting( 'superads_lite_style_primary_sub_bg_color' , array(
		    'default' 				=> '#f3f2f2',
		    'sanitize_callback' 	=> 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_style_primary_sub_bg_color', array(
		    'label'    				=> __( 'Sub Menu Background Color', 'superads-lite' ),
		    'section'  				=> 'superads_lite_style_primary_menu_section',
		    'priority'    			=> 3,
		)));
		/* Menu Item Color */
		$wp_customize->add_setting( 'superads_lite_style_primary_item_color' , array(
		    'default' 				=> '#010101',
		    'sanitize_callback' 	=> 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_style_primary_item_color', array(
		    'label'    				=> __( 'Menu Item Color', 'superads-lite' ),
		    'section'  				=> 'superads_lite_style_primary_menu_section',
		    'priority'    			=> 3,
		)));

		/* Border Color */
		$wp_customize->add_setting( 'superads_lite_style_primary_border_color' , array(
		    'default' 				=> '#e2e0e0',
		    'sanitize_callback' 	=> 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_style_primary_border_color', array(
		    'label'    				=> __( 'Border Color', 'superads-lite' ),
		    'section'  				=> 'superads_lite_style_primary_menu_section',
		    'priority'    			=> 3,
		)));

		/**********************
		* Section: Link Color *
		***********************/
		$wp_customize->add_section( 'superads_lite_anchor_text_color_section' , array(
				'title'       	=> __( 'Anchor Text Color (Color Links)', 'superads-lite' ),
				'priority'    	=> 2,
				'panel' 		=> 'panel_styles_colors'
		));

		/* Anchor Text Color*/
		$wp_customize->add_setting( 'superads_lite_anchor_text_color' , array(
		    'default' 			=> '#737373',
		    'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'superads_lite_anchor_text_color', array(
		    'label'    			=> __( 'Anchor Text Color', 'superads-lite' ),
		    'section'  			=> 'superads_lite_anchor_text_color_section',
		    'settings' 			=> 'superads_lite_anchor_text_color',
		    'priority'    		=> 3,
		)));