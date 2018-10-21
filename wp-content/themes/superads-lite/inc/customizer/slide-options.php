<?php
	/**
	|------------------------------------------------------------------------------
	| OPTIONS
	|------------------------------------------------------------------------------

	/****************************
	* Section: Ad Banner Header *
	*****************************/
	
	$wp_customize->add_section( 'superads_lite_slideshow_section' , array(
			'title'       		=> __( 'Slideshow', 'superads-lite' ),
			'priority'    		=> 31,
	));

	/* What to Show in Meta Info */
		$wp_customize->add_setting(
	        'superads_lite_slideshow_category_type',
	        array(
	            'sanitize_callback' => 'tc_sanitize_checkbox_multiple'
	        )
	    );
	    $wp_customize->add_control(
	        new TC_Customize_Control_Checkbox_Multiple(
	            $wp_customize,
	            'superads_lite_slideshow_category_type',
	            array(
	                'section' 			=> 'superads_lite_slideshow_section',
	                'priority'		=> 1,
	                'label'   			=> __( 'Choose Categories to Display Post in Slideshow', 'superads-lite' ),
	                'choices' 			=> superads_lite_get_category_list()
	            )
	        )
	    );

	/* Version PRO info */
		$wp_customize->add_setting( 'superads_lite_typography_pro_info1', array('sanitize_callback' => 'superads_lite_sanitize_pro_version'));
		$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_typography_pro_info1',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to hide/show slideshow and use customize slideshow.', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_slideshow_section',
	            	'priority'		=> 2
	                )
	        )
	    );