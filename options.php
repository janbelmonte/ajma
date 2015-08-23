<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_funky_theme
 */

function optionsframework_options() {

	$options = array();
	
	// ------------------------------------
	//	GENERAL SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "General", "funky_theme" ),
					"type"	=> "heading" );
		
		//  Logo				
		$options['logo'] = array(
							"name"		 => __( "Site Logo", "funky_theme" ),
							"desc"		 => __( "Upload a custom site logo. This will appear in your website's header(Max height 60px.).", "funky_theme" ),
							"short_desc" => __( "Site Logo", "funky_theme" ),
							"id"		 => "logo",
							"type"		 => "upload" );
							
		
		// Enable Tagline
		$options['enable_tagline'] = array(
							"name"		=> __( "Enable Tagline", "funky_theme" ),
							"desc"		=> __( "Show tagline in navigation sidebar", "funky_theme" ),
							"short_desc"=> __( "Enable Tagline", "funky_theme" ),
							"id"		=> "enable_tagline",
							"std"		=> "true",
							"type"		=> "checkbox");
							
							
		// Custom Favicon
		$options["custom_favicon"] = array(
							"name"		 => __( "Custom Favicon", "funky_theme" ),
							"desc"		 => __( "Upload or enter the file URL for the 16x16px .png/.ico image that will be used as your website's favicon.", "funky_theme" ),
							"short_desc" => __( "Custom Favicon", "funky_theme" ),
							"id"		 => "custom_favicon",
							"type"		 => "upload" );
							
		
		// Apple Icons
		$options[] = array( "name"	=> __( "Apple Bookmark Icons", "funky_theme" ),
							"desc"	=> "Upload or enter the file URL for the Apple bookmark icon .png images.",
							"type"	=> "info");
							
						
		// Custom Apple Icon (57x57)
		$options["apple_bookmark_57"] = array(
							"desc"		 => __( "Non Retina iPhones (57x57px).", "funky_theme" ),
							"short_desc" => __( "Non Retina iPhones (57x57px)", "funky_theme" ),
							"id"		 => "apple_bookmark_57",
							"type"		 => "upload" );
							
		
		// Custom Apple Icon (114x114)
		$options["apple_bookmark_114"] = array(
							"desc"		 => __( "Retina iPhones (114x114px).", "funky_theme" ),
							"short_desc" => __( "Retina iPhones (114x114px)", "funky_theme" ),
							"id"		 => "apple_bookmark_114",
							"type"		 => "upload" );
							
		
		// Custom Apple Icon (72x72)
		$options["apple_bookmark_72"] = array(
							"desc"		 => __( "Non Retina iPads (72x72px).", "funky_theme" ),
							"short_desc" => __( "Non Retina iPhones (72x72px)", "funky_theme" ),
							"id"		 => "apple_bookmark_72",
							"type"		 => "upload" );
							
							
		// Custom Apple Icon (144x144)
		$options["apple_bookmark_144"] = array(
							"desc"		 => __( "Retina iPads (144x144px).", "funky_theme" ),
							"short_desc" => __( "Retina iPads (144x144px)", "funky_theme" ),
							"id"		 => "apple_bookmark_144",
							"type"		 => "upload" );
							
							
		// Custom CSS
		$options['custom_css'] = array(
							"name"		 => __( "Custom CSS", "funky_theme" ),
							"desc"		 => __( "CSS placed here overrides any other stylesheets. Note this is intended for small pieces of CSS only. eg: a.button{ color: #FFF }.", "funky_theme" ),
							"short_desc" => __( "Custom CSS (All layouts)", "funky_theme" ),
							"id"		 => "custom_css",
							"type"		 => "textarea" );
							

		// Custom CSS Desktop
		$options['custom_css_desktop'] = array(
							"name"		 => __( "Custom CSS Desktop", "funky_theme" ),
							"desc"		 => __( "Custom CSS applied to default layout. The CSS entered here will only be used when the browser has a width wider than 767px", "funky_theme" ),
							"short_desc" => __( "Custom CSS (Desktop layout)", "funky_theme" ),
							"id"		 => "custom_css_desktop",
							"type"		 => "textarea" );
							
							
		// Custom CSS Mobile
		$options['custom_css_mobile'] = array(
							"name"		 => __( "Custom CSS Mobile", "funky_theme" ),
							"desc"		 => __( "Custom CSS only applied to mobile layout. The CSS entered here will only be used when the browser has a width narrower than 768px.", "funky_theme" ),
							"short_desc" => __( "Custom CSS (Mobile layout)", "funky_theme" ),
							"id"		 => "custom_css_mobile",
							"type"		 => "textarea" );
							
	// ------------------------------------
	//	COLOUR SETTINGS
	// ------------------------------------
	
	$options[] = array( 
					"name"	=> __( "Appearance", "funky_theme" ),
					"type"	=> "heading" );
		
		// Preloader Colour
		$options['color_preloader'] = array(
							"name"		=> __( "Preloader", "funky_theme" ),
							"desc"		=> __( "Preloader colour.", "funky_theme" ),
							"short_desc"=> __( "Preloader Colour", "funky_theme" ),
							"id"		=> "color_preloader",
							"std"		=> "#FEC80E",
							"type"		=> "color" );								

							
		// Accent
		$options['color_accent'] = array(
							"name"		=> __( "Accent", "funky_theme" ),
							"desc"		=> __( "Accent colour.", "funky_theme" ),
							"short_desc"=> __( "Accent Colour", "funky_theme" ),
							"id"		=> "color_accent",
							"std"		=> "#FEC80E",
							"type"		=> "color" );	
							
		
		// Accent Text (dark/light)
		$options['color_accent_text'] = array(
							"desc"		=> __( "Colour of text and icons placed over accent colour.", "funky_theme" ),
							"short_desc"=> __( "Accent Text", "funky_theme" ),
							"id"		=> "color_accent_text",
							"options"	=> array(
								__( "Light", "funky_theme" ),
								__( "Dark", "funky_theme" )
							),
							"std"		=> "1",
							"type"		=> "select" );
							

		// Navigation Bar Background
		$options['color_header'] = array( 
							"name"		=> __( "Navigation Bar", "funky_theme" ),
							"desc"		=> __( "Navigation bar background colour.", "funky_theme" ),
							"short_desc"=> __( "Navigation Bar Background Colour", "funky_theme" ),
							"id"		=> "color_header",
							"std"		=> "#070707",
							"type"		=> "color" );
							
		
		// Navigation Bar Text (dark/light)
		$options['color_header_text'] = array( 
							"desc"		=> __( "Colour of text and icons in the navigation bar.", "funky_theme" ),
							"short_desc"=> __( "Navigation Bar Text", "funky_theme" ),
							"id"		=> "color_header_text",
							"options"	=> array( __( "Dark", "funky_theme" ), __( "Light", "funky_theme" ) ),
							"std"		=> "1",
							"type"		=> "select" );
							
		
		// Feature Content Background
		$options['color_feature_content'] = array( 
							"name"		=> __( "Feature Content Background", "funky_theme" ),
							"desc"		=> __( "The colour used for feature content displayed at the top of posts and portfolio items.", "funky_theme" ),
							"short_desc"=> __( "Feature Content Background Colour", "funky_theme" ),
							"id"		=> "color_feature_content",
							"std"		=> "#070707",
							"type"		=> "color" );
							
		// Links
		$options['color_link'] = array(
							"name"		=> __( "Links", "funky_theme" ),
							"desc"		=> __( "Link colour.", "funky_theme" ),
							"short_desc"=> __( "Link Colour", "funky_theme" ),
							"id"		=> "color_link",
							"std"		=> "#070707",
							"type"		=> "color" );
							
						
		// Link Hover
		$options['color_link_hover'] = array(
							"desc"		=> __( "Link hover colour.", "funky_theme" ),
							"short_desc"=> __( "Link Hover Colour", "funky_theme" ),
							"id"		=> "color_link_hover",
							"std"		=> "#5e5e5e",
							"type"		=> "color" );
							

		// Button
		$options['color_button'] = array(
							"name"		=> __( "Buttons", "funky_theme" ),
							"desc"		=> __( "Button background.", "funky_theme" ),
							"short_desc"=> __( "Button Colour", "funky_theme" ),
							"id"		=> "color_button",
							"std"		=> "#070707",
							"type"		=> "color" );
							
						
		// Button Text
		$options['color_button_text'] = array(
							"desc"		=> __( "Button text.", "funky_theme" ),
							"short_desc"=> __( "Button Text Colour", "funky_theme" ),
							"id"		=> "color_button_text",
							"std"		=> "#070707",
							"type"		=> "color" );
		
	
	// ------------------------------------
	//	POST SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Post", "funky_theme" ),
					"type"	=> "heading" );
		
		// Author meta
		$options['post_author_meta'] = array(
							"name"		=> __( "Post Meta", "funky_theme" ),
							"desc"		=> __( "Show post author", "funky_theme" ),
							"short_desc"=> __( "Show post author", "funky_theme" ),
							"id"		=> "post_author_meta",
							"std"		=> "true",
							"type"		=> "checkbox");
							
							
		// Date meta
		$options['post_date_meta'] = array( 
							"desc"		=> __( "Show post date", "funky_theme" ),
							"short_desc"=> __( "Show post date", "funky_theme" ),
							"id"		=> "post_date_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
							
							
		// Category meta
		$options['post_category_meta'] = array(
							"desc"		=> __( "Show post category", "funky_theme" ),
							"short_desc"=> __( "Show post category", "funky_theme" ),
							"id"		=> "post_category_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
							
		
		// Comments meta
		$options['post_comments_meta'] = array( 
							"desc"		=> __( "Show number of comments", "funky_theme" ),
							"short_desc"=> __( "Show number of comments", "funky_theme" ),
							"id"		=> "post_comments_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
							

		// Share Buttons
		$options['post_share_buttons'] = array( 
							"desc"		=> __( "Show post share buttons", "funky_theme" ),
							"short_desc"=> __( "Show post share buttons", "funky_theme" ),
							"id"		=> "post_share_buttons",
							"std"		=> "true",
							"type"		=> "checkbox" );
							
		
		// Tags meta
		$options['post_tags_meta'] = array( 
							"desc"		=> __( "Show post tags", "funky_theme" ),
							"short_desc"=> __( "Show post tags", "funky_theme" ),
							"id"		=> "post_tags_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );

							
	// ------------------------------------
	//	POST ARCHIVE SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Post Archives", "funky_theme" ),
					"type"	=> "heading" );
		
		// AJAX pagination
		$options['archive_ajax_pagination'] = array(
							"name"		=> __( "Pagination", "funky_theme" ),
							"desc"		=> __( "Load more posts via AJAX", "funky_theme" ),
							"short_desc"=> __( "Load more posts via AJAX", "funky_theme" ),
							"id"		=> "archive_ajax_pagination",
							"std"		=> "true",
							"type"		=> "checkbox");
							
							
		// Author meta
		$options['archive_author_meta'] = array(
							"name"		=> __( "Post Meta", "funky_theme" ),
							"desc"		=> __( "Show post author", "funky_theme" ),
							"short_desc"=> __( "Show post author", "funky_theme" ),
							"id"		=> "archive_author_meta",
							"std"		=> "true",
							"type"		=> "checkbox");
							
							
		// Date meta
		$options['archive_date_meta'] = array( 
							"desc"		=> __( "Show post date", "funky_theme" ),
							"short_desc"=> __( "Show post date", "funky_theme" ),
							"id"		=> "archive_date_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
							
							
		// Category meta
		$options['archive_category_meta'] = array(
							"desc"		=> __( "Show post category", "funky_theme" ),
							"short_desc"=> __( "Show post category", "funky_theme" ),
							"id"		=> "archive_category_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
							
		
		// Comments meta
		$options['archive_comments_meta'] = array( 
							"desc"		=> __( "Show number of comments", "funky_theme" ),
							"short_desc"=> __( "Show number of comments", "funky_theme" ),
							"id"		=> "archive_comments_meta",
							"std"		=> "true",
							"type"		=> "checkbox" );
	
	
	// ------------------------------------
	//	PORTFOLIO ARCHIVE SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Portfolio Archives", "funky_theme" ),
					"type"	=> "heading" );
		
		// Thumbnail Style
		$options['portfolio_archive_thumbnail_style'] = array(
							"name"		=> __( "Thumbnail Style.", "funky_theme" ),
							"desc"		=> __( "Select whether post thumbnails on the portfolio page should be cropped to the same dimensions or left uncropped and scaled down to the same width.", "funky_theme" ),
							"short_desc"=> __( "Thumbnail Style", "funky_theme" ),
							"id"		=> "portfolio_archive_thumbnail_style",
							"options"	=> array(
								__( "Square",		"funky_theme" ),
								__( "Landscape",	"funky_theme" ),
								__( "Portrait",		"funky_theme" )
								//__( "Uncropped",	"funky_theme" )
							),
							"type"		=> "select" );
							
		// Show Category Label
		$options['portfolio_archive_category_label'] = array( 
							"Name"		=> __( "Show portfolio category labels", "funky_theme" ),
							"desc"		=> __( "Select this option to hide portfolio category labels on the portfolio archive", "funky_theme" ),
							"short_desc"=> __( "Show portfolio category labels", "funky_theme" ),
							"id"		=> "portfolio_archive_category_label",							
							"type"		=> "checkbox" );
							
							
	// ------------------------------------
	//	404 SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "404", "funky_theme" ),
					"type"	=> "heading" );
		
		// 404 Background
		$options["404_background"] = array(
							"desc"		 => __( "404 page background image.", "funky_theme" ),
							"short_desc" => __( "404 Page Background", "funky_theme" ),
							"id"		 => "404_background",
							"type"		 => "upload" );
							
							
		// 404 Title
		$options['404_title'] = array(
							"desc"		 => __( "Title", "funky_theme" ),
							"short_desc" => __( "404 Page Title", "funky_theme" ),
							"id"		 => "404_title",
							"type"		 => "text" );
							
							
		// 404 Subtitle
		$options['404_subtitle'] = array(
							"desc"		 => __( "Subtitle", "funky_theme" ),
							"short_desc" => __( "404 Page Subtitle", "funky_theme" ),
							"id"		 => "404_subtitle",
							"type"		 => "textarea" );
							
	
	// ------------------------------------
	//	SEARCH SETTINGS
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Search Results", "funky_theme" ),
					"type"	=> "heading" );
		
		// Search Results Background
		$options["search_background"] = array(
							"desc"		 => __( "search results page background image.", "funky_theme" ),
							"short_desc" => __( "Search Page Background", "funky_theme" ),
							"id"		 => "search_background",
							"type"		 => "upload" );
							
							
	// ------------------------------------
	//	SOCIAL NETWORKING
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Social Networks", "funky_theme" ),
					"type"	=> "heading" );
		
	$options[] = array( "name"	=> "Social Network Buttons",
						"desc"	=> "Enter the URL to the social network profile each of the following buttons will link to. The social buttons are shown in the website's footer.",
						"type"	=> "info");							
						
		// Facebook
		$options['facebook_url'] = array(
							"desc"		 => __( "Facebook", "funky_theme" ),
							"short_desc" => __( "Facebook URL", "funky_theme" ),
							"id"		 => "facebook_url",
							"type"		 => "text" );
							
		
		// Twitter
		$options['twitter_url'] = array(
							"desc"		 => __( "Twitter", "funky_theme" ),
							"short_desc" => __( "Twitter URL", "funky_theme" ),
							"id"		 => "twitter_url",
							"type"		 => "text" );
							
		
		// Google+
		$options['google_plus_url'] = array(
							"desc"		 => __( "Google+", "funky_theme" ),
							"short_desc" => __( "Google+ URL", "funky_theme" ),
							"id"		 => "google_plus_url",
							"type"		 => "text" );
							
		
		// YouTube
		$options['youtube_url'] = array(
							"desc"		 => __( "YouTube", "funky_theme" ),
							"short_desc" => __( "YouTube URL", "funky_theme" ),
							"id"		 => "youtube_url",
							"type"		 => "text" );
							
		
		// Vimeo
		$options['vimeo_url'] = array(
							"desc"		 => __( "Vimeo", "funky_theme" ),
							"short_desc" => __( "Vimeo URL", "funky_theme" ),
							"id"		 => "vimeo_url",
							"type"		 => "text" );
							
							
		// Flickr
		$options['flickr_url'] = array(
							"desc"		 => __( "Flickr", "funky_theme" ),
							"short_desc" => __( "Flickr URL", "funky_theme" ),
							"id"		 => "flickr_url",
							"type"		 => "text" );
							
							
		// Dribbble
		$options['dribbble_url'] = array( 
							"desc"	     => __( "Dribbble ", "funky_theme" ),
							"short_desc" => __( "Dribbble URL", "funky_theme" ),
							"id"		 => "dribbble_url",
							"type"		 => "text" );
							
		
		// Instagram
		$options['instagram_url'] = array( 
							"desc"		 => __( "Instagram", "funky_theme" ),
							"short_desc" => __( "Instagram URL", "funky_theme" ),
							"id"		 => "instagram_url",
							"type"		 => "text" );
							
		
		// Pinterest
		$options['pinterest_url'] = array(
							"desc"		 => __( "Pinterest", "funky_theme" ),
							"short_desc" => __( "Pinterest URL", "funky_theme" ),
							"id"		 => "pinterest_url",
							"type"		 => "text" );
							
							
		// Behance
		$options['behance_urlbehance_url'] = array(
							"desc"	 	 => __( "Behance", "funky_theme" ),
							"short_desc" => __( "Behance URL", "funky_theme" ),
							"id"		 => "behance_url",
							"type"		 => "text" );							
							
		
	
	// ------------------------------------
	//	FOOTER
	// ------------------------------------
	
	$options[] = array(
					"name"	=> __( "Footer", "funky_theme" ),
					"type"	=> "heading" );
					
		// Copyright Text
		$options['copyright_text'] = array(
							"name"		 => __( "Copyright Text", "funky_theme" ),
							"desc"		 => __( "Enter text to be displayed beside the copyright symbol in the site footer.", "funky_theme" ),
							"short_desc" => __( "Copyright Text", "funky_theme" ),
							"id"		 => "copyright_text",
							"type"		 => "text" );
					
	return $options;
	
}


function options_theme_customizer_register( $wp_customize ) {
	
	$options = optionsframework_options();
	$optionsframework_settings = get_option( 'optionsframework' );
	$options_id = $optionsframework_settings['id'];
	
	/**
	 * Although all code necessary to add all current options is present, many of
	 * the options are disabled in the Customiser as previewing them is not possible
	 * due to the CSS transient needing to be generated.
	 **/
	
	// GENERAL SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_general', array(
        'title'		=> __( "General", "funky_theme" ),
        'priority'	=> 201
	));
		
		// Logo		
		$wp_customize->add_setting( $options_id .'[logo]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[logo]', array(
			'priority'	=> 1,
			'label' 	=> $options['logo']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[logo]'
		)));
		
		
		// Enable Tagline
		$wp_customize->add_setting( $options_id .'[enable_tagline]', array(
			'default'	=> $options['enable_tagline']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[enable_tagline]', array(
			'priority'	=> 2,
			'label'		=> $options['enable_tagline']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[enable_tagline]',
			'type'		=> $options['enable_tagline']['type']
		));
		
		
		// Custom Favicon
		$wp_customize->add_setting( $options_id .'[custom_favicon]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[custom_favicon]', array(
			'priority'	=> 3,
			'label' 	=> $options['custom_favicon']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[custom_favicon]'
		)));
		
		
		// Custom Apple Icon (57x57)
		$wp_customize->add_setting( $options_id .'[apple_bookmark_57]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[apple_bookmark_57]', array(
			'priority'	=> 4,
			'label' 	=> $options['apple_bookmark_57']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[apple_bookmark_57]'
		)));
		
		
		// Custom Apple Icon (114x114)
		$wp_customize->add_setting( $options_id .'[apple_bookmark_114]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[apple_bookmark_114]', array(
			'priority'	=> 5,
			'label' 	=> $options['apple_bookmark_114']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[apple_bookmark_114]'
		)));
		
		
		// Custom Apple Icon (72x72)
		$wp_customize->add_setting( $options_id .'[apple_bookmark_72]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[apple_bookmark_72]', array(
			'priority'	=> 6,
			'label' 	=> $options['apple_bookmark_72']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[apple_bookmark_72]'
		)));
		
		
		// Custom Apple Icon (144x144)
		$wp_customize->add_setting( $options_id .'[apple_bookmark_144]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[apple_bookmark_144]', array(
			'priority'	=> 7,
			'label' 	=> $options['apple_bookmark_144']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[apple_bookmark_144]'
		)));
		
		
		// Custom CSS
		$wp_customize->add_setting( $options_id .'[custom_css]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[custom_css]', array(
			'priority'	=> 8,
			'label'		=> $options['custom_css']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[custom_css]',
			'type'		=> 'text'
		));
		
		
		// Custom CSS
		$wp_customize->add_setting( $options_id .'[custom_css_desktop]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[custom_css_desktop]', array(
			'priority'	=> 9,
			'label'		=> $options['custom_css_desktop']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[custom_css_desktop]',
			'type'		=> 'text'
		));
		
		
		// Custom CSS
		$wp_customize->add_setting( $options_id .'[custom_css_mobile]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[custom_css_mobile]', array(
			'priority'	=> 10,
			'label'		=> $options['custom_css_mobile']['short_desc'],
			'section'	=> 'options_theme_customizer_general',
			'settings'	=> $options_id .'[custom_css_mobile]',
			'type'		=> 'text'
		));
	
		
	// COLOUR SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_appearance', array(
        'title' => __( "Appearance", "funky_theme" ),
        'priority' => 202
	));
		
		// Preloader		
		$wp_customize->add_setting( $options_id .'[color_preloader]', array(
			'default'	=> $options['color_preloader']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_preloader]', array(
			'priority'	=> 1,
			'label'		=> $options['color_preloader']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_preloader]'
		)));
		
		
		// Accent
		$wp_customize->add_setting( $options_id .'[color_accent]', array(
			'default'	=> $options['color_accent']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_accent]', array(
			'priority'	=> 2,
			'label'		=> $options['color_accent']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_accent]'
		)));
	
		
		// Accent Text
		$wp_customize->add_setting( $options_id .'[color_accent_text]', array(
			'default'	=> $options['color_accent_text']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[color_accent_text]', array(
			'priority'	=> 3,
			'label'		=> $options['color_accent_text']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_accent_text]',
			'type'		=> $options['color_accent_text']['type'],
			'choices'	=> $options['color_accent_text']['options']
		));
		
		
		// Header Background
		$wp_customize->add_setting( $options_id .'[color_header]', array(
			'default'	=> $options['color_header']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_header]', array(
			'priority'	=> 4,
			'label'		=> $options['color_header']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_header]'
		)));
		
		
		// Header Text (dark/light)
		$wp_customize->add_setting( $options_id .'[color_header_text]', array(
			'default'	=> $options['color_header_text']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[color_header_text]', array(
			'priority'	=> 5,
			'label'		=> $options['color_header_text']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_header_text]',
			'type'		=> $options['color_header_text']['type'],
			'choices'	=> $options['color_header_text']['options']
		));
		
		
		// Feature Content Background
		$wp_customize->add_setting( $options_id .'[color_feature_content]', array(
			'default'	=> $options['color_feature_content']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_feature_content]', array(
			'priority'	=> 6,
			'label'		=> $options['color_feature_content']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_feature_content]'
		)));
		
		
		// Links
		$wp_customize->add_setting( $options_id .'[color_link]', array(
			'default'	=> $options['color_link']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_link]', array(
			'priority'	=> 7,
			'label'		=> $options['color_link']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_link]'
		)));
		
		
		// Link Hover
		$wp_customize->add_setting( $options_id .'[color_link_hover]', array(
			'default'	=> $options['color_link_hover']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_link_hover]', array(
			'priority'	=> 8,
			'label'		=> $options['color_link_hover']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_link_hover]'
		)));
		
		
		// Button
		$wp_customize->add_setting( $options_id .'[color_button]', array(
			'default'	=> $options['color_button']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_button]', array(
			'priority'	=> 9,
			'label'		=> $options['color_button']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_button]'
		)));
		
		
		// Button Text
		$wp_customize->add_setting( $options_id .'[color_button_text]', array(
			'default'	=> $options['color_button_text']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $options_id .'[color_button_text]', array(
			'priority'	=> 10,
			'label'		=> $options['color_button_text']['short_desc'],
			'section'	=> 'options_theme_customizer_appearance',
			'settings'	=> $options_id .'[color_button_text]'
		)));
		
	
	// POST SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_post', array(
        'title'		=> __( "Posts", "funky_theme" ),
        'priority'	=> 203
	));	
	
		
		// Author Meta
		$wp_customize->add_setting( $options_id .'[post_author_meta]', array(
			'default'	=> $options['post_author_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_author_meta]', array(
			'priority'	=> 3,
			'label'		=> $options['post_author_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_author_meta]',
			'type'		=> $options['post_author_meta']['type']
		));
		
		
		// Date Meta
		$wp_customize->add_setting( $options_id .'[post_date_meta]', array(
			'default'	=> $options['post_date_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_date_meta]', array(
			'priority'	=> 4,
			'label'		=> $options['post_date_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_date_meta]',
			'type'		=> $options['post_date_meta']['type']
		));
		
		
		// Category Meta
		$wp_customize->add_setting( $options_id .'[post_category_meta]', array(
			'default'	=> $options['post_category_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_category_meta]', array(
			'priority'	=> 5,
			'label'		=> $options['post_category_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_category_meta]',
			'type'		=> $options['post_category_meta']['type']
		));
		
		
		// Comments Meta
		$wp_customize->add_setting( $options_id .'[post_comments_meta]', array(
			'default'	=> $options['post_comments_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_comments_meta]', array(
			'priority'	=> 6,
			'label'		=> $options['post_comments_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_comments_meta]',
			'type'		=> $options['post_comments_meta']['type']
		));
		
		
		// Tags Meta
		$wp_customize->add_setting( $options_id .'[post_tags_meta]', array(
			'default'	=> $options['post_tags_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_tags_meta]', array(
			'priority'	=> 7,
			'label'		=> $options['post_tags_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_tags_meta]',
			'type'		=> $options['post_tags_meta']['type']
		));
		
		// Share Buttons
		$wp_customize->add_setting( $options_id .'[post_share_buttons]', array(
			'default'	=> $options['post_share_buttons']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[post_share_buttons]', array(
			'priority'	=> 8,
			'label'		=> $options['post_share_buttons']['short_desc'],
			'section'	=> 'options_theme_customizer_post',
			'settings'	=> $options_id .'[post_share_buttons]',
			'type'		=> $options['post_share_buttons']['type']
		));
		
		
	// POST ARCHIVE SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_post_archive', array(
        'title'		=> __( "Post Archives", "funky_theme" ),
        'priority'	=> 204
	));	
	
		
		// AJAX Pagination
		$wp_customize->add_setting( $options_id .'[archive_ajax_pagination]', array(
			'default'	=> $options['archive_ajax_pagination']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[archive_ajax_pagination]', array(
			'priority'	=> 1,
			'label'		=> $options['archive_ajax_pagination']['short_desc'],
			'section'	=> 'options_theme_customizer_post_archive',
			'settings'	=> $options_id .'[archive_ajax_pagination]',
			'type'		=> $options['archive_ajax_pagination']['type']
		));
		
		
		// Author Meta
		$wp_customize->add_setting( $options_id .'[archive_author_meta]', array(
			'default'	=> $options['archive_author_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[archive_author_meta]', array(
			'priority'	=> 3,
			'label'		=> $options['archive_author_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post_archive',
			'settings'	=> $options_id .'[archive_author_meta]',
			'type'		=> $options['archive_author_meta']['type']
		));
		
		
		// Date Meta
		$wp_customize->add_setting( $options_id .'[archive_date_meta]', array(
			'default'	=> $options['archive_date_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[archive_date_meta]', array(
			'priority'	=> 4,
			'label'		=> $options['archive_date_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post_archive',
			'settings'	=> $options_id .'[archive_date_meta]',
			'type'		=> $options['archive_date_meta']['type']
		));
		
		
		// Category Meta
		$wp_customize->add_setting( $options_id .'[archive_category_meta]', array(
			'default'	=> $options['category_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[archive_category_meta]', array(
			'priority'	=> 5,
			'label'		=> $options['archive_category_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post_archive',
			'settings'	=> $options_id .'[archive_category_meta]',
			'type'		=> $options['archive_category_meta']['type']
		));
		
		
		// Comments Meta
		$wp_customize->add_setting( $options_id .'[archive_comments_meta]', array(
			'default'	=> $options['archive_comments_meta']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[archive_comments_meta]', array(
			'priority'	=> 6,
			'label'		=> $options['archive_comments_meta']['short_desc'],
			'section'	=> 'options_theme_customizer_post_archive',
			'settings'	=> $options_id .'[archive_comments_meta]',
			'type'		=> $options['archive_comments_meta']['type']
		));
		
		
	// PORTFOLIO ARCHIVE SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_portfolio_archive', array(
		'title'		=> __( "Portfolio Archives", "funky_theme" ),
		'priority'	=> 206
	));
	
	
		// Thumbnail Style
		$wp_customize->add_setting( $options_id .'[portfolio_archive_thumbnail_style]', array(
			'default'	=> $options['portfolio_archive_thumbnail_style']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[portfolio_archive_thumbnail_style]', array(
			'priority'	=> 1,
			'label'		=> $options['portfolio_archive_thumbnail_style']['short_desc'],
			'section'	=> 'options_theme_customizer_portfolio_archive',
			'settings'	=> $options_id .'[portfolio_archive_thumbnail_style]',
			'type'		=> $options['portfolio_archive_thumbnail_style']['type'],
			'choices'	=> $options['portfolio_archive_thumbnail_style']['options']
		));
	
		
		// Hide Portfolio Category Labels
		$wp_customize->add_setting( $options_id .'[portfolio_archive_category_label]', array(
			'default'	=> $options['portfolio_archive_category_label']['std'],
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[portfolio_archive_category_label]', array(
			'priority'	=> 2,
			'label'		=> $options['portfolio_archive_category_label']['short_desc'],
			'section'	=> 'options_theme_customizer_portfolio_archive',
			'settings'	=> $options_id .'[portfolio_archive_category_label]',
			'type'		=> $options['portfolio_archive_category_label']['type']
		));
	
	
	
	// 404 SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_404', array(
		'title'		=> __( "404 Page", "funky_theme" ),
		'priority'	=> 207
	));	
	
		// 404 Background		
		$wp_customize->add_setting( $options_id .'[404_background]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[404_background]', array(
			'priority'	=> 1,
			'label' 	=> $options['404_background']['short_desc'],
			'section'	=> 'options_theme_customizer_404',
			'settings'	=> $options_id .'[404_background]'
		)));
		
	
		// 404 Title
		$wp_customize->add_setting( $options_id .'[404_title]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[404_title]', array(
			'priority'	=> 1,
			'label'		=> $options['404_title']['short_desc'],
			'section'	=> 'options_theme_customizer_404',
			'settings'	=> $options_id .'[404_title]',
			'type'		=> 'text'
		));
		
		
		// 404 Subtitle
		$wp_customize->add_setting( $options_id .'[404_subtitle]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[404_subtitle]', array(
			'priority'	=> 2,
			'label'		=> $options['404_subtitle']['short_desc'],
			'section'	=> 'options_theme_customizer_404',
			'settings'	=> $options_id .'[404_subtitle]',
			'type'		=> 'text'
		));
	
	
	// SEARCH SETTINGS
	$wp_customize->add_section( 'options_theme_customizer_search', array(
        'title'		=> __( "Search", "funky_theme" ),
        'priority'	=> 208
	));
		
		// Search Background		
		$wp_customize->add_setting( $options_id .'[search_background]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $options_id .'[search_background]', array(
			'priority'	=> 1,
			'label' 	=> $options['search_background']['short_desc'],
			'section'	=> 'options_theme_customizer_search',
			'settings'	=> $options_id .'[search_background]'
		)));
		

	// SOCIAL NETWORKING
	$wp_customize->add_section( 'options_theme_customizer_social_networks', array(
        'title'		=> __( "Social Networks", "funky_theme" ),
        'priority'	=> 209
	));	
		
		
		// Facebook
		$wp_customize->add_setting( $options_id .'[facebook_url]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[facebook_url]', array(
			'priority'	=> 1,
			'label'		=> $options['facebook_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[facebook_url]',
			'type'		=> 'text'
		));
		
		
		// Twitter
		$wp_customize->add_setting( $options_id .'[twitter_url]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[twitter_url]', array(
			'priority'	=> 2,
			'label'		=> $options['twitter_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[twitter_url]',
			'type'		=> 'text'
		));
		
		
		// Google+
		$wp_customize->add_setting( $options_id .'[google_plus_url]', array(
			'type'		=> 'option'
		));

		$wp_customize->add_control( $options_id .'[google_plus_url]', array(
			'priority'	=> 3,
			'label'		=> $options['google_plus_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[google_plus_url]',
			'type'		=> 'text'
		));
		

		// YouTube
		$wp_customize->add_setting( $options_id .'[youtube_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[youtube_url]', array(
			'priority'	=> 4,
			'label'		=> $options['youtube_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[youtube_url]',
			'type'		=> 'text'
		));
		
		
		// Vimeo
		$wp_customize->add_setting( $options_id .'[vimeo_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[vimeo_url]', array(
			'priority'	=> 5,
			'label'		=> $options['vimeo_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[vimeo_url]',
			'type'		=> 'text'
		));
		
		
		// Flickr
		$wp_customize->add_setting( $options_id .'[flickr_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[flickr_url]', array(
			'priority'	=> 6,
			'label'		=> $options['flickr_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[flickr_url]',
			'type'		=> 'text'
		));
		
		
		// Dribbble
		$wp_customize->add_setting( $options_id .'[dribbble_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[dribbble_url]', array(
			'priority'	=> 7,
			'label'		=> $options['dribbble_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[dribbble_url]',
			'type'		=> 'text'
		));
		
		
		// Instagram
		$wp_customize->add_setting( $options_id .'[instagram_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[instagram_url]', array(
			'priority'	=> 8,
			'label'		=> $options['instagram_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[instagram_url]',
			'type'		=> 'text'
		));
		
		
		// Pinterest
		$wp_customize->add_setting( $options_id .'[pinterest_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[pinterest_url]', array(
			'priority'	=> 9,
			'label'		=> $options['pinterest_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[pinterest_url]',
			'type'		=> 'text'
		));
		
		// Behance
		$wp_customize->add_setting( $options_id .'[behance_url]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[behance_url]', array(
			'priority'	=> 10,
			'label'		=> $options['behance_url']['short_desc'],
			'section'	=> 'options_theme_customizer_social_networks',
			'settings'	=> $options_id .'[behance_url]',
			'type'		=> 'text'
		));
		
	
	
	// FOOTER
	$wp_customize->add_section( 'options_theme_customizer_footer', array(
        'title'		=> __( "Footer", "funky_theme" ),
        'priority'	=> 210
	));
	
		// Copyright Text
		$wp_customize->add_setting( $options_id .'[copyright_text]', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( $options_id .'[copyright_text]', array(
			'priority'	=> 1,
			'label'		=> $options['copyright_text']['short_desc'],
			'section'	=> 'options_theme_customizer_footer',
			'settings'	=> $options_id .'[copyright_text]',
			'type'		=> 'text'
		));		
	
	
	// HIDDEN OPTION
	$wp_customize->add_section( 'options_theme_customizer_hidden_option', array(
        'title'		=> __( "Nothing To See Here...", "funky_theme" ),
        'priority'	=> 999
	));	
		
		
		// Option used to check all other options have been saved before generating CSS
		$wp_customize->add_setting( 'last-setting', array(
			'type'		=> 'option'
		));		
		
		$wp_customize->add_control( 'last-setting', array(
			'priority'	=> 999,
			'label'		=> __( "This is a hidden option. It's not important", "funky_theme" ),
			'section'	=> 'options_theme_customizer_hidden_option',
			'settings'	=> 'last-setting',
			'type'		=> 'text'
		));
		
}
add_action( 'customize_register', 'options_theme_customizer_register' );


function funky_customizer_styles() { ?>
	<style>
		#accordion-section-options_theme_customizer_hidden_option { display: none; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'funky_customizer_styles' );


function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	
		jQuery(document).ready(function() {			
			
		});
		
	</script> 
	
<?php }
// add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );