<?php
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 1.9.9
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

if ( is_admin() ) {
	
	global $funky_shortname;
	
	/* 
	 * prefix of meta keys, optional
	 */
	$prefix = $funky_shortname;
  
  
	/* 
	 * configure your meta box
	 */
	$config = array(
		'id'				=> 'portfolio-layout-options',												// meta box id, unique per meta box
		'title'				=> 'Portfolio Layout Options',												// meta box title
		'pages'				=> array( 'portfolio_category', 'portfolio_tag' ),							// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'			=> 'normal',																// where the meta box appear: normal (default), advanced, side; optional
		'fields'			=> array(),																	// list of meta fields (can be added by field arrays)
		'local_images' 		=> false,																	// use local or hosted images (meta box images for add/remove)
		'use_with_theme'	=> trailingslashit( get_template_directory_uri() ) .'inc/taxonomy_options'	// change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
  
  
	/*
	 * Initiate your meta box
  	 */
	$my_meta =  new Tax_Meta_Class($config);
  
	/*
	 * Add fields to your meta box
	 */
	
	// Thumbnail Style
	$my_meta->addSelect( $prefix .'_portfolio_thumbnail_style',
		array (
			'0'	=> __( "Square", 	"funky_theme" ),
			'1'	=> __( "Landscape", "funky_theme" ),
			'2'	=> __( "Portrait", 	"funky_theme" )
			//'3'	=> __( "Mixed", 	"funky_theme" )
		),
		array (
			'name'	=> __( "Thumbnail Style", "funky_theme" ),
			'std'	=> array( '0' ) 
		)
	);
	
	// Show Category Label
	$my_meta->addCheckbox( $prefix .'_portfolio_category_label',
		array(
			'name'	=>	__( "Show category label", "funky_theme" ),
		)
	);
	
	// Show Social Share Buttons
	$my_meta->addCheckbox( $prefix .'_portfolio_share_buttons',
		array(
			'name'	=>	__( "Show social share buttons on portfolio items", "funky_theme" )
		)
	);
  

	/*
	 * Don't Forget to Close up the meta box decleration
	 */
	
	//Finish Meta Box Decleration
	$my_meta->Finish();

}