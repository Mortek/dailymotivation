<?php
	
	/**
	|------------------------------------------------------------------------------
	| OPTIONS
	|------------------------------------------------------------------------------
	*/
	$wp_customize->add_panel( 'tc_panel_single', array(
		'priority'			=> 33,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> __( 'Single Options', 'superads-lite' )
	));

	/**************************
	* Section: Related Posts *
	**************************/
	$wp_customize->add_section( 'superads_lite_single_related_post_section' , array(
			'title'			=> __( 'Related Posts', 'superads-lite' ),
			'priority'		=> 5,
			'panel'			=> 'tc_panel_single'
	));

	/* Related Post Taxonmy */
	$wp_customize->add_setting('superads_lite_single_related_post_taxonomy', array(
		'default'				=> 'category',
		'sanitize_callback'		=> 'superads_lite_sanitize_text'
	));

	$wp_customize->add_control('superads_lite_single_related_post_taxonomy', array(
		'label'					=> __('Related Posts Taxonomy', 'superads-lite'),
		'section'				=> 'superads_lite_single_related_post_section',
		'type'					=> 'radio',
		'priority'				=> 2,
		'choices'				=> array(
			'category'				=> __('Categories', 'superads-lite'),
			'tag'					=> __('Tags', 'superads-lite'),
		),
	));

	/* Version PRO info */
	$wp_customize->add_setting( 'superads_lite_single_related_post_pro_info', array('sanitize_callback' => 'superads_lite_sanitize_pro_version'));
	$wp_customize->add_control(
		new superads_lite_Theme_Info(
			$wp_customize,
			'superads_lite_single_related_post_pro_info',
			array(
				'description'	=> sprintf(__('Check out the <a href="%s">PRO version</a> to use options show and hide related post, choose related posts type grid or list to display and number related post to show.', 'superads-lite'), superads_lite_PRO_URL),
				'section'		=> 'superads_lite_single_related_post_section',
				'priority'		=> 3
			)
		)
	);