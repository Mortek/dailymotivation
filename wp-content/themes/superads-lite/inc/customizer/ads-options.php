<?php
	/**
	|------------------------------------------------------------------------------
	| OPTIONS
	|------------------------------------------------------------------------------
	*/
	$wp_customize->add_panel( 'tc_panel_ads', array(
			'priority' 				=> 34,
			'capability' 			=> 'edit_theme_options',
			'theme_supports'		=> '',
			'title' 				=> __( 'Ads Managment', 'superads-lite' )
	));

	/****************************
	* Section: Ad Banner Header *
	*****************************/
	
	$wp_customize->add_section( 'superads_lite_ad_banner_header_section' , array(
			'title'       		=> __( 'Header Banner', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));

	/* Ads Header */
	$wp_customize->add_setting( 'superads_lite_banner_ad_header', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_banner_ad_header', array(
			'label'   			=> __( 'Header Banner Ad (728 X 90)', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_ad_banner_header_section',				
			'priority' 			=> 1
	));

	/* Version PRO info */
	$wp_customize->add_setting( 'superads_lite_banner_ad_header_pro_info', array('sanitize_callback' => 'superads_lite_banner_ad_header_pro_info'));
	$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_banner_ad_header_pro_info',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to choose where banner ad to show on Home Page, Single Post, Archive Page, Single Page.', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_ad_banner_header_section',
	            	'priority'		=> 2
	            )
	     )
	);

	/****************************
	* Section: Banner Under Nav *
	*****************************/
	$wp_customize->add_section( 'superads_lite_ad_under_nav_section' , array(
			'title'       		=> __( 'Banner Ad Under Navigation', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));

	/* Ad Under Nav Bar */
	$wp_customize->add_setting( 'superads_lite_banner_ad_under_nav', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_banner_ad_under_nav', array(
			'label'   			=> __( 'Banner Ad Under Navigation Bar (Recommend 970 X 90)', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_ad_under_nav_section',				
			'priority' 			=> 1
	));


	/* Version PRO info */
	$wp_customize->add_setting( 'superads_lite_banner_ad_under_nav_info', array('sanitize_callback' => 'superads_lite_banner_ad_under_nav_info'));
	$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_banner_ad_under_nav_info',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to choose where banner ad to show on Home Page, Single Post, Archive Page, Single Page.', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_ad_under_nav_section',
	            	'priority'		=> 2
	            )
	     )
	);

	/*************************************
	* Section: Banner Ad Under Slideshow *
	**************************************/
	$wp_customize->add_section( 'superads_lite_banner_ad_under_slideshow_section' , array(
			'title'       		=> __( 'Banner Ad Under Featured Slider', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));

	/* Banner Ad Under Slideshow */ 
	$wp_customize->add_setting( 'superads_lite_banner_ad_under_slideshow', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_banner_ad_under_slideshow', array(
			'label'   			=> __( 'Banner Ad Under Featured Slider (Recommend 640 X 90)', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_banner_ad_under_slideshow_section',				
			'priority' 			=> 1
	));

	/****************************
	* Section: Banner Ad Footer *
	*****************************/
	$wp_customize->add_section( 'superads_lite_banner_ad_footer_section' , array(
			'title'       		=> __( 'Banner Ad in Footer', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));

	/* Banner Ad in Footer */
	$wp_customize->add_setting( 'superads_lite_banner_ad_footer', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_banner_ad_footer', array(
			'label'   			=> __( 'Banner Ad in Footer (Recommend 970 X 90)', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_banner_ad_footer_section',				
			'priority' 			=> 1
	));

	/* Version PRO info */
	$wp_customize->add_setting( 'superads_lite_banner_ad_footer_info', array('sanitize_callback' => 'superads_lite_banner_ad_footer_info'));
	$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_general_disable_info',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to choose where banner ad to show on Home Page, Single Post, Archive Page, Single Page.', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_banner_ad_footer_section',
	            	'priority'		=> 2
	            )
	     )
	);


	/*****************************
	* Section: Ad Before Content *
	******************************/
	$wp_customize->add_section( 'superads_lite_ads_before_content_section' , array(
			'title'       		=> __( 'Before Content', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));
		

	/* Before Content */   
	$wp_customize->add_setting( 'superads_lite_ads_before_content', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_ads_before_content', array(
			'label'   			=> __( 'Paste Your Ad Code Here', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_ads_before_content_section',				
			'priority' 			=> 1
	));
	/* Ads Alignment */
	$wp_customize->add_setting( 'superads_lite_ads_before_content_align', array( 'sanitize_callback' => 'superads_lite_sanitize_text', 'default' => 'ad-left') );
	$wp_customize->add_control( 'superads_lite_ads_before_content_align', array(
			'description'   	=> __( 'Choose Alignment for your Ads.', 'superads-lite' ),
			'type'				=> 'select',
			'section' 			=> 'superads_lite_ads_before_content_section',				
			'priority' 			=> 1,
			'choices'    		=> array(
				'none'				=> __('None', 'superads-lite'),
	            'ad-left' 			=> __('Left', 'superads-lite'),
	            'ad-center' 		=> __('Center', 'superads-lite'),
	            'ad-right' 			=> __('Right', 'superads-lite'),
	        ),
	));
	/******************************
	* Section: Middle Content Ads *
	*******************************/
	$wp_customize->add_section( 'superads_lite_ads_middle_content_section' , array(
			'title'       		=> __( 'Middle Content', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));
		
	/* Before Content */   
	$wp_customize->add_setting( 'superads_lite_ads_middle_content', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_ads_middle_content', array(
			'label'   			=> __( 'Paste Your Ads Code Here', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_ads_middle_content_section',				
			'priority' 			=> 1
	));
	/* Ads Alignment */
	$wp_customize->add_setting( 'superads_lite_ads_middle_content_align', array( 'sanitize_callback' => 'superads_lite_sanitize_text', 'default' => 'ad-left') );
	$wp_customize->add_control( 'superads_lite_ads_middle_content_align', array(
			'description'   	=> __( 'Choose Alignment for your Ads.', 'superads-lite' ),
			'type'				=> 'select',
			'section' 			=> 'superads_lite_ads_middle_content_section',				
			'priority' 			=> 1,
			'choices'    		=> array(
				'none'				=> __('None', 'superads-lite'),
	            'ad-left' 				=> __('Left', 'superads-lite'),
	            'ad-center' 			=> __('Center', 'superads-lite'),
	            'ad-right' 			=> __('Right', 'superads-lite'),
	        ),
	));
	/******************************
	* Section: After Content Ads *
	*******************************/
	$wp_customize->add_section( 'superads_lite_ads_after_content_section' , array(
			'title'       		=> __( 'After Content', 'superads-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'tc_panel_ads'
	));
		
	/* After Content */   
	$wp_customize->add_setting( 'superads_lite_ads_after_content', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
	$wp_customize->add_control( 'superads_lite_ads_after_content', array(
			'label'   			=> __( 'Paste Your Ads Code Here', 'superads-lite' ),
			'type'				=> 'textarea',
			'description'   	=> __( 'Ex: Adsense, Buy Sell Ads or Custom Code.', 'superads-lite' ),
			'section' 			=> 'superads_lite_ads_after_content_section',				
			'priority' 			=> 1
	));
	/* Ads Alignment */
	$wp_customize->add_setting( 'superads_lite_ads_after_content_align', array( 'sanitize_callback' => 'superads_lite_sanitize_text', 'default' => 'ad-left') );
	$wp_customize->add_control( 'superads_lite_ads_after_content_align', array(
			'description'   	=> __( 'Choose Alignment for your Ads.', 'superads-lite' ),
			'type'				=> 'select',
			'section' 			=> 'superads_lite_ads_after_content_section',				
			'priority' 			=> 1,
			'choices'    		=> array(
				'none'				=> __('None', 'superads-lite'),
	            'ad-left' 				=> __('Left', 'superads-lite'),
	            'ad-center' 			=> __('Center', 'superads-lite'),
	            'ad-right' 			=> __('Right', 'superads-lite'),
	        ),
	));