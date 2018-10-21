<?php
/**
|------------------------------------------------------------------------------
| Static Control
|------------------------------------------------------------------------------
*/

class superads_lite_Theme_Info extends WP_Customize_Control
	{
		public function render_content()
		{
			echo $this->description;
		}
	}
/**
|------------------------------------------------------------------------------
| OPTIONS
|------------------------------------------------------------------------------
*/

		$wp_customize->add_panel( 'panel_general', array(
			'priority' => 30,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'General Options', 'superads-lite' )
		));
		
		/*******************
		* Section: General *
		********************/
		$wp_customize->add_section( 'superads_lite_general_section' , array(
				'title'       		=> __( 'General', 'superads-lite' ),
				'priority'    		=> 1,
				'panel' 			=> 'panel_general'
		));
		
		/* Header Code */   
		$wp_customize->add_setting( 'superads_lite_header_code', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
		$wp_customize->add_control( 'superads_lite_header_code', array(
				'label'   			=> __( 'Header Code', 'superads-lite' ),
				'type'				=> 'textarea',
				'section' 			=> 'superads_lite_general_section',				
				'description' 		=> __( 'If you have any code you want to appear between Heading and Paste it here. For example: Google Web Master Tool Code or Pinterest Verify Code.', 'superads-lite' ),
				'priority' 			=> 1
			)
		);

		/* Footer Code */   
		$wp_customize->add_setting( 'superads_lite_footer_code', array( 'sanitize_callback' => 'superads_lite_sanitize_textarea') );
		$wp_customize->add_control( 'superads_lite_footer_code', array(
				'label'   			=> __( 'Footer Code', 'superads-lite' ),
				'type'				=> 'textarea',
				'section' 			=> 'superads_lite_general_section',
				'description'		=> __('If you have tracking code (Google Analytic or other ), Paste Your Code here which will be inserted before the closing body tag of your theme.', 'superads-lite'),
				'priority' 			=> 2
		) );

		/* Version PRO info */
		$wp_customize->add_setting( 'superads_lite_general_disable_info', array('sanitize_callback' => 'superads_lite_sanitize_pro_version'));
		$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_general_disable_info',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to <em>Show</em> or <em>Hide</em> Top Menu, Primary Menu, Footer Menu, FLoating Navigation Menu, Back to Top Button.', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_general_section',
	            	'priority'		=> 2
	                )
	        )
	    );

	    /******************
		* Section: Layout *
		*******************/
		$wp_customize->add_section( 'superads_lite_general_layout_section' , array(
				'title'       		=> __( 'Layout', 'superads-lite' ),
				'priority'    		=> 2,
				'panel' 			=> 'panel_general'
		));
		// Add the layout control.
		$wp_customize->add_setting(
	        'superads_lite_general_layout',
	        array(
	            'default'           => 'list_post',
	            'sanitize_callback' => 'sanitize_key',
	        )
    	);
	   $wp_customize->add_control(
	        new TC_Customize_Control_Radio_Image(
	            $wp_customize,
	            'superads_lite_general_layout',
	            array(
	                'label'    		=> esc_html__( 'Choose Post Render Style', 'superads-lite' ),
	                'section'  		=> 'superads_lite_general_layout_section',
	                'priority'			=> 1,
	                'choices'  		=> array(
	                    'list_post' => array(
	                        'label' 		=> esc_html__( 'List Style', 'superads-lite' ),
	                        'url'   		=> '%s/images/layout/list.png'
	                    ),
	                    'grid_post' => array(	
	                        'label' 		=> esc_html__( 'Grid Style', 'superads-lite' ),
	                        'url'   		=> '%s/images/layout/grid.png'
	                    )
	                )
	            )
	        )
	    );

		/* Version PRO info */
		$wp_customize->add_setting( 'superads_lite_general_layout_pro_version', array('sanitize_callback' => 'superads_lite_sanitize_pro_version'));
		$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_general_layout_pro_version',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> to change layout with left sidebar, right sidebar or none sidebar (one column)', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_general_layout_section',
	            	
	                )
	        )
	    );

		

		/*******************
		* Section: Excerpt *
		********************/
		$wp_customize->add_section( 'superads_lite_general_excerpt_section' , array(
				'title'       		=> __( 'Excerpt', 'superads-lite' ),
				'priority'    		=> 2,
				'panel' 			=> 'panel_general'
		));

		/* Excerpt Length */
		$wp_customize->add_setting('superads_lite_general_excerpt_lengh', array('sanitize_callback' => 'superads_lite_sanitize_text', 'default' => 34));
		$wp_customize->add_control( 'superads_lite_general_excerpt_lengh', array(
		  	'type' 					=> 'number',
		  	'section' 				=> 'superads_lite_general_excerpt_section',
		  	'label' 				=> __( 'Excerpt Length', 'superads-lite' ),
		  	'description' 			=> __( 'Number of word as Expert Length To be Shown in Home/Archive pages when you choose to show entry text as Excerpt.', 'superads-lite'),
		));

		/* Excerpt End Text */
		$wp_customize->add_setting('superads_lite_general_excerpt_end_text', array('sanitize_callback' => 'superads_lite_sanitize_text', 'default' => '...'));
		$wp_customize->add_control( 'superads_lite_general_excerpt_end_text', array(
		  	'type' 					=> 'text',
		  	'section' 				=> 'superads_lite_general_excerpt_section',
		  	'label' 				=> __( 'Excerpt Length', 'superads-lite' ),
		));

		

		/**********************
		* Section: Pagination *
		***********************/
		$wp_customize->add_section( 'superads_lite_general_pagination_section' , array(
			'title'       			=> __( 'Pagination Mode', 'superads-lite' ),
			'priority'    			=> 4,
			'panel' 				=> 'panel_general'
		));

		$wp_customize->add_setting('superads_lite_general_pagination_mode', array(
        	'default'        	=> 'default',
        	'capability'     	=> 'edit_theme_options',
        	'sanitize_callback' => 'superads_lite_sanitize_text',
	    ));
	    $wp_customize->add_control( 'superads_lite_general_pagination_mode', array(
	        'label'   			=> 'Choose Pagination Type',
	        'section' 			=> 'superads_lite_general_pagination_section',
	        'type'    			=> 'radio',
	        'priority'			=> 1,
	        'choices'    		=> array(
	            'default' 				=> __('Default (Older Posts/Newer Posts)', 'superads-lite'),
	            'numberal' 				=> __('Numberal (1 2 3 ..)', 'superads-lite'),
	        ),
	    ));

	    /* Version PRO info */
		$wp_customize->add_setting( 'superads_lite_general_pagination_mode_info', array('sanitize_callback' => 'superads_lite_sanitize_pro_version'));
		$wp_customize->add_control(
	        new superads_lite_Theme_Info(
	            $wp_customize,
	            'superads_lite_general_pagination_mode_info',
	            array(
	            	'description' 	=> sprintf(__('Check out the <a href="%s">PRO version</a> for two more options <em>Auto Infinite Scroll</em> and <em>Load More...</em>', 'superads-lite'), superads_lite_PRO_URL),
	            	'section' 		=> 'superads_lite_general_pagination_section',
	            	'priority'		=> 2
	                )
	        )
	    );


	    /***********************
		* Section: Sidebar *
		************************/

		$wp_customize->add_section( 'superads_lite_general_sidebar_section' , array(
			'title'       			=> __( 'Sidebar', 'superads-lite' ),
			'priority'    			=> 3,
			'panel' 				=> 'panel_general'
		));


	    // Add the Sidebar control.
		$wp_customize->add_setting(
	        'superads_lite_sidebar_layout',
	        array(
	            'default'           => 'right-sidebar',
	            'sanitize_callback' => 'superads_lite_sanitize_pro_version',
	        )
    	);

	    $wp_customize->add_control( 'superads_lite_sidebar_layout', array(
	        'label'   			=> 'Choose Sidebar',
	        'section' 			=> 'superads_lite_general_sidebar_section',
	        'type'    			=> 'radio',
	        'priority'			=> 2,
	        'choices'    		=> array(
	            'left-sidebar' 				=> __('Left Sidebar', 'superads-lite'),
	            'right-sidebar' 				=> __('Right Sidebar', 'superads-lite'),
	        ),
	    ));

		
		/***********************
		* Section: Pro Version *
		************************/
		$wp_customize->add_section( 'superads_lite_general_pro_version_section' , array(
				'title'       => __( 'Pro Verion Info', 'superads-lite' ),
				'priority'    => 6,
				'panel' => 'panel_general'
		));