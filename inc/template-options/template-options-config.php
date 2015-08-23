<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_action( 'cmb_render_info', 'funky_cmb_render_info', 10, 2 );
function funky_cmb_render_info( $field, $meta ) {
    echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
}

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	global $funky_shortname;
	
	// Portfolio categories list
	if ( taxonomy_exists( 'portfolio_category' ) ) {
	
		$portfolios = array();

		$terms = get_terms( 'portfolio_category' );	
		
		if ( $terms ) {
			foreach ( $terms as $term ) {	
				$category = array(
					'name'	=> $term->name,
					'value'	=> $term->slug
				);		
				array_push( $portfolios, $category );		
			}
		}
	
	} else {
	
		$portfolios = array();
		$category = array(
			'name'	=> 'No portfolios to show',
			'value'	=> '-1'
		);		
		array_push( $portfolios, $category );
	
	}
	
	
	/* --------------------------------------------------
		PAGE
	-------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		 => 'page-options-box',
		'title' 	 => __( "Page Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Page Title
			array(
				"name"	=> __( "Page Title", "funky_theme" ),
				"desc"	=> __( "Use this option to output a different title on the page.", "funky_theme" ),
				"id"	=> $funky_shortname ."_page_title",
				"type"	=> "text"
			),
			
			// Page Title Display
			array(
				"name"	=> __( "Hide Page Title", "funky_theme" ),
				"desc"	=> __( "Select this option to hide the page title.", "funky_theme" ),
				"id"	=> $funky_shortname ."_hide_page_title",
				'type'		=> 'checkbox'
			),
	
			// Show Subtitle
			array(
				'name'	=> __( "Show Subtitle", "funky_theme" ),
				'desc'	=> __( "Show page excerpt as subtitle. Enter the subtitle text into the page's <a href=\"http://codex.wordpress.org/Excerpt#How_to_add_excerpts_to_posts\">excerpt</a> text area.", "funky_theme" ),
				'id'	=> $funky_shortname .'_show_subtitle',
				'type'	=> 'checkbox'
			)	
		
		)
	
	);
	
	
	/* --------------------------------------------------
		PAGE (HEADER)
	-------------------------------------------------- */

	$meta_boxes[] = array(
		'id'		 => 'header-options-box',
		'title' 	 => __( "Header Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Page Header
			array(
				'name'	=> __( "Page Header",			"funky_theme" ),
				'desc'	=> __( "Select page header",	"funky_theme" ),
				'id'	=> $funky_shortname .'_page_header',
				'type'	=> 'select',
				'options'	=> array(
					array( 'name' => __( "None",			"funky_theme"),	'value' => 'none' ),
					array( 'name' => __( "Feature Image",	"funky_theme"),	'value' => 'image' ),
					array( 'name' => __( "Video",			"funky_theme"),	'value' => 'video' )
				),
				'std'		=> 'none'
			),
			
			// Header Style
			array(
				"name"	=> __( "Header Style",			"funky_theme" ),
				"desc"	=> __( "Select header style.",	"funky_theme" ),
				"id"	=> $funky_shortname ."_header_style",
				'type'		=> 'select',
				'options'	=> array(
					array( 'name' => __( "Top of content (cropped)",		"funky_theme"),	'value' => 'default' ),
					array( 'name' => __( "Top of content (fill screen)",	"funky_theme"),	'value' => 'fill' ),
					array( 'name' => __( "Left of content (fill screen)",	"funky_theme"),	'value' => 'half' )
				),
				'std'		=> 'default'
			),
			
			// Show Page Title In Header
			array(
				'name'	=> __( "Show Title In Header",													"funky_theme" ),
				'desc'	=> __( "Select this option to move the page title and subtitle to the header",	"funky_theme" ),
				'id'	=> $funky_shortname .'_show_title_in_header',
				'type'	=> 'checkbox'
			),
			
			// Text Colour
			array(
				"name"	=> __( "Header Text Colour",								"funky_theme" ),
				"desc"	=> __( "Select the colour of the page title & subtitle.",	"funky_theme" ),
				"id"	=> $funky_shortname ."_header_text_colour",
				'type'		=> 'select',
				'options'	=> array(
					array( 'name' => __( "Dark",			"funky_theme"),	'value' => 'dark' ),
					array( 'name' => __( "Light",			"funky_theme"),	'value' => 'light' )
				),
				'std'		=> 'default'
			),
			
			// Header Video WebM
			array(
				'name' => __( "WebM Video Source", "funky_theme" ),
				'desc' => __( "Upload or enter a valid URL to a WebM format video.", "funky_theme" ),
				'id'   => $funky_shortname .'_header_video_webm',
				'type' => 'file',
			),
			
			// Header Video MP4
			array(
				'name' => __( "MP4 Video Source", "funky_theme" ),
				'desc' => __( "Upload or enter a valid URL to a MP4 format video.", "funky_theme" ),
				'id'   => $funky_shortname .'_header_video_mp4',
				'type' => 'file',
			)
			
		)
		
	);

	
	/* --------------------------------------------------
		PAGE-ARCHIVE
	-------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		 => 'archive-options-box',
		'title' 	 => __( "Archive Template Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Archive Page Template Help
			array(
				"name"	=> __( "!", 'funky_theme' ),
				"desc"	=> __( "The archive template generates a list of latest posts as well as links to month and post category archives.", 'funky_theme' ),
				"id"	=> $funky_shortname ."_archive_template_help",
				"type"	=> "info"
			)			
			
		)
		
	);
	
	
	/* --------------------------------------------------
		PAGE-CONTACT
	-------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		 => 'contact-options-box',
		'title' 	 => __( "Contact Template Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Contact Page Template Help
			array(
				"name"	=> __( "!", 'funky_theme' ),
				"desc"	=> __( "The contact page template allows you to output a google map on the page. You can set the map location and styling using the options below.", 'funky_theme' ),
				"id"	=> $funky_shortname ."_contact_template_help",
				"type"	=> "info"
			),
			
			// Map Address
			array(
				"name"	=> __( "Map Address", "funky_theme" ),
				"desc"	=> __( "Enter the street address to be shown on the map on this page.", "funky_theme" ),
				"id"	=> $funky_shortname ."_map_address",
				"type"	=> "text"
			),
			
			// Zoom
			array(
				'name'		=> __( "Zoom", "funky_theme" ),
				'desc'		=> __( "Map zoom amount.", "funky_theme" ),
				'id'		=> $funky_shortname ."_map_zoom",
				'type'		=> 'select',
				'options'	=> array(
					array( 'name' => __( "0",	"funky_theme"),	'value' => '0' ),
					array( 'name' => __( "1",	"funky_theme"),	'value' => '1' ),
					array( 'name' => __( "2",	"funky_theme"),	'value' => '2' ),
					array( 'name' => __( "3",	"funky_theme"),	'value' => '3' ),
					array( 'name' => __( "4",	"funky_theme"),	'value' => '4' ),
					array( 'name' => __( "5",	"funky_theme"),	'value' => '5' ),
					array( 'name' => __( "6",	"funky_theme"),	'value' => '6' ),
					array( 'name' => __( "7",	"funky_theme"),	'value' => '7' ),
					array( 'name' => __( "8",	"funky_theme"),	'value' => '8' ),
					array( 'name' => __( "9",	"funky_theme"),	'value' => '9' ),
					array( 'name' => __( "10",	"funky_theme"),	'value' => '10' ),
					array( 'name' => __( "11",	"funky_theme"),	'value' => '11' ),
					array( 'name' => __( "12",	"funky_theme"),	'value' => '12' ),
					array( 'name' => __( "13",	"funky_theme"),	'value' => '13' ),
					array( 'name' => __( "14",	"funky_theme"),	'value' => '14' ),
					array( 'name' => __( "15",	"funky_theme"),	'value' => '15' ),
					array( 'name' => __( "16",	"funky_theme"),	'value' => '16' ),
					array( 'name' => __( "17",	"funky_theme"),	'value' => '17' ),
					array( 'name' => __( "18",	"funky_theme"),	'value' => '18' ),
					array( 'name' => __( "19",	"funky_theme"),	'value' => '19' )
				),
				'std'		=> '11'
				
			),
			
			// Map Hue
			array(
	            'name' => __( "Map Colour", "funky_theme" ),
				'desc' => __( "Set map hue colour.", "funky_theme" ),
	            'id'   => $funky_shortname .'_map_hue',
	            'type' => 'colorpicker',
				'std'  => false
	        ),
			
			// Saturation
			array(
				"name"	=> __( "Saturation", "funky_theme" ),
				"desc"	=> __( "Map colour saturation amount(-100 - 100).", "funky_theme" ),
				"id"	=> $funky_shortname ."_map_saturation",
				"type"	=> "text_small",
				"std"	=> "0"
				
			),
			
			// Map Simplify
			array(
				'name'	=> __( "Smiplify Map", "funky_theme" ),
				'desc'	=> __( "Simplify map geometry.", "funky_theme" ),
				'id'	=> $funky_shortname ."_map_simplify",
				'type'	=> 'checkbox',
				'std'	=> false
			),
			
			// Custom Map Pin
			array(
				'name' => __( "Custom Map Pin", "funky_theme" ),
				'desc' => __( "Upload an image or enter a valid URL.", "funky_theme" ),
				'id'   => $funky_shortname .'_custom_map_pin',
				'type' => 'file',
			),
			
			// Width
			array(
				"name"	=> __( "Custom Pin Width", "funky_theme" ),
				"desc"	=> __( "Custom pin width in px", "funky_theme" ),
				"id"	=> $funky_shortname ."_custom_map_pin_width",
				"type"	=> "text_small",
				"std"	=> "75"				
			),
			
			// Height
			array(
				"name"	=> __( "Custom Pin Height", "funky_theme" ),
				"desc"	=> __( "Custom pin height in px", "funky_theme" ),
				"id"	=> $funky_shortname ."_custom_map_pin_height",
				"type"	=> "text_small",
				"std"	=> "75"
			)
		
		)
	
	);
	
	
	/* --------------------------------------------------
		PAGE-FULLSCREEN
	-------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		 => 'fullscreen-options-box',
		'title' 	 => __( "Fullscreen Template Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Fullscreen Page Template Help
			array(
				"name"	=> __( "!", 'funky_theme' ),
				"desc"	=> __( "The Fullscreen template outputs the specified image or video as a fullscreen background. Any content added to the page is displayed over the background. If you are using a background video it is recommended you also give the page a feature image. This will be used as the background on smaller screen devices.", 'funky_theme' ),
				"id"	=> $funky_shortname ."fullscreen_template_help",
				"type"	=> "info"
			)			
			
		)
		
	);
	
	/* --------------------------------------------------
		PAGE-PORTFOLIO
	-------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		 => 'portfolio-options-box',
		'title' 	 => __( "Portfolio Template Options", "funky_theme" ),
		'pages' 	 => array( 'page' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Portfolio Page Template Help
			array(
				"name"	=> __( "!", 'funky_theme' ),
				"desc"	=> __( "The portfolio page templates outputs a grid of portfolio items. You can set which portfolio category the portfolio items should be pulled from using the option below. All portfolio items in the specified portfolio will be shown on the page.", 'funky_theme' ),
				"id"	=> $funky_shortname ."_portfolio_template_help",
				"type"	=> "info"
			),
			
			// Portfolio Category
			array(
				"name"		=> __( "Portfolio Category", 'funky_theme' ),
				"desc"		=> __( "Select a Portfolio Category to display on this page.", 'funky_theme' ),
				"id"		=> $funky_shortname."_portfolio_category",
				"type"		=> "select",
				"options"	=> $portfolios
			),
			
			// Thumbnail Style
			array(
				"name"		=> __( "Thumbnail Style", 'funky_theme' ),
				"desc"		=> __( "Select a layout for this portfolio item.", 'funky_theme' ),
				"id"		=> $funky_shortname."_thumbnail_style",
				"type"		=> "select",
				"options"	=> array (
					array( 'name' => __( "Square",		"funky_theme"),	'value' => '0' ),
					array( 'name' => __( "Landscape",	"funky_theme"),	'value' => '1' ),
					array( 'name' => __( "Portrait",	"funky_theme"),	'value' => '2' )
					//array( 'name' => __( "Mixed",	"funky_theme"),	'value' => '3' )
				),
				'std'		=> "default"
			),
			
			// Show Category
			array(
				'name'	=> __( "Category Label", "funky_theme" ),
				'desc'	=> __( "Enable to show portfolio category label beside each portfolio item's title.", "funky_theme" ),
				'id'	=> $funky_shortname ."_portfolio_category_label",
				'type'	=> 'checkbox',
				'std'	=> false
			),
			
			// Posts Per Page
			array(
				"name"	=> __( "Posts Per Page", "funky_theme" ),
				"desc"	=> __( "Enter the number of portfolio items to be shown per page. Leave blank to show all portfolio items", "funky_theme" ),
				"id"	=> $funky_shortname ."_portfolio_posts_per_page",
				"type"	=> "text_small"				
			)
			
		)
		
	);
	
	
	/* --------------------------------------------------
		PORTFOLIO
	-------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id'		 => 'page-options-box',
		'title' 	 => __( "Page Options", "funky_theme" ),
		'pages' 	 => array( 'portfolio' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Page Title
			array(
				"name"	=> __( "Page Title", "funky_theme" ),
				"desc"	=> __( "Use this option to output a different title on the page.", "funky_theme" ),
				"id"	=> $funky_shortname ."_page_title",
				"type"	=> "text"
			),
			
			// Page Title Display
			array(
				"name"	=> __( "Hide Page Title", "funky_theme" ),
				"desc"	=> __( "Select this option to hide the page title.", "funky_theme" ),
				"id"	=> $funky_shortname ."_hide_page_title",
				'type'		=> 'checkbox'
			),
	
			// Show Subtitle
			array(
				'name'	=> __( "Show Subtitle", "funky_theme" ),
				'desc'	=> __( "Show page excerpt as subtitle. Enter the subtitle text into the page's <a href=\"http://codex.wordpress.org/Excerpt#How_to_add_excerpts_to_posts\">excerpt</a> text area.", "funky_theme" ),
				'id'	=> $funky_shortname .'_show_subtitle',
				'type'	=> 'checkbox'
			)
		
		)
	
	);
	
	
	$meta_boxes[] = array(
		'id'		 => 'portfolio-options-box',
		'title' 	 => __( "Portfolio Options", "funky_theme" ),
		'pages' 	 => array( 'portfolio' ),
		'context' 	 => 'normal',
		'priority' 	 => 'high',
		'show_names' => true,
		'fields' 	 => array(
			
			// Layout
			array(
				"name"		=> __( "Layout", 'funky_theme' ),
				"desc"		=> __( "Select a layout for this portfolio item.", 'funky_theme' ),
				"id"		=> $funky_shortname."_portfolio_item_layout",
				"type"		=> "select",
				"options"	=> array (
					array( 'name' => __( "Standard",				"funky_theme"),	'value' => 'default' ),
					array( 'name' => __( "Standard (Width 50%)",	"funky_theme"),	'value' => 'half' ),
					array( 'name' => __( "Audio",					"funky_theme"),	'value' => 'audio' ),
					array( 'name' => __( "Gallery",					"funky_theme"),	'value' => 'gallery' ),
					array( 'name' => __( "Slider",					"funky_theme"),	'value' => 'slider' ),
					array( 'name' => __( "Video",					"funky_theme"),	'value' => 'video' )
				),
				'std'		=> "default"
			),
			
			// ---------- AUDIO ---------- //
			
			// Audio Layout Help
			array(
				"name"		=> __( "!", 'funky_theme' ),
				'desc' 	=> __( "<p>The audio portfolio item layout outputs an audio player generated from the first URL found in the page content. The audio URL should be the first URL found in the content.</p>", "funky_theme" ),
				'id' 	=> $funky_shortname .'_layout_audio_help',
				'type' 	=> 'info'
			),
			
			
			// ---------- STANDARD (HALF) ---------- //
			
			// Standard (Width 50%) Layout Help
			array(
				"name"		=> __( "!", 'funky_theme' ),
				'desc' 	=> __( "<p>The Standard (Width 50%) portfolio item layout outputs a page split into two halves. The left half contains any content you place in the content editor. The right halve displays either the portfolio item feature image or (if the exclude feature image option is enabled) the first image to the portfolio item that is not the feature image.</p>
				<p><a href='http://codex.wordpress.org/Using_Image_and_File_Attachments#Attachment_to_a_Post' target='_blank'>Attachment To Page Help</a></p>", "funky_theme" ),
				'id' 	=> $funky_shortname .'_layout_standard_half_help',
				'type' 	=> 'info'
			),
			
			// ---------- GALLERY ---------- //
			
			// Gallery Layout Help
			array(
				"name"		=> __( "!", 'funky_theme' ),
				'desc' 	=> __( "<p>The gallery portfolio item layout automatically outputs a gallery consisting of images specified in the first [gallery] shortcode found in the page content. If no [gallery] shortcode is found in the page content any images that are attached to the page will be shown instead. N.B Images must be attached to the page but must <strong>NOT</strong> be inserted into the page content.</p>
				<p><a href='http://codex.wordpress.org/Using_Image_and_File_Attachments#Attachment_to_a_Post' target='_blank'>Attachment To Page Help</a></p>", "funky_theme" ),
				'id' 	=> $funky_shortname .'_layout_gallery_help',
				'type' 	=> 'info'
			),
			
			// Exclude Feature Image
			array(
				'name' 	=> __( "Exclude Feature Image", "funky_theme" ),
				'desc' 	=> __( "Select this option to exclude the page feature image from the gallery or slider.", "funky_theme" ),
				'id' 	=> $funky_shortname .'_exclude_feature_image',
				'type' 	=> 'checkbox'
			),
			

			// ---------- SLIDER ---------- //
			
			// Slider Layout Help
			array(
				"name"		=> __( "!", 'funky_theme' ),
				'desc' 	=> __( "<p>The slider portfolio item layout automatically outputs a fullscreen slider consisting of images specified in the first [gallery] shortcode found in the page content. If no [gallery] shortcode is found in the page content any images that are attached to the page will be shown instead. N.B Images must be attached to the page but must <strong>NOT</strong> be inserted into the page content.</p>
				<p><a href='http://codex.wordpress.org/Using_Image_and_File_Attachments#Attachment_to_a_Post' target='_blank'>Attachment To Page Help</a></p>", "funky_theme" ),
				'id' 	=> $funky_shortname .'_layout_slider_help',
				'type' 	=> 'info'
			),
			
			// Animation Type
			array(
				"name"		=> __( "Animation Type", 'funky_theme' ),
				"desc"		=> __( "Select the animation used to transition between slides.", 'funky_theme' ),
				"id"		=> $funky_shortname."_slider_fx",
				"type"		=> "select",
				"options"	=> array (
					array( 'name' => __( "Fade",		"funky_theme"),	'value' => 'fade' ),
					array( 'name' => __( "Fade Out",	"funky_theme"),	'value' => 'fadeout' ),
					array( 'name' => __( "Scroll",		"funky_theme"),	'value' => 'scrollHorz' ),
					array( 'name' => __( "none",		"funky_theme"),	'value' => 'none' )
				),
				'std'		=> "fade"
			),
			
			// Animation Duration
			array(
				"name"	=> __( "Animation Duration", "funky_theme" ),
				"desc"	=> __( "The speed of the transition effect in milliseconds", "funky_theme" ),
				"id"	=> $funky_shortname ."_slider_speed",
				"type"	=> "text_small",
				"std"	=> "500"
			),
			
			// Timeout		
			array(
				"name"	=> __( "Slide Duration", "funky_theme" ),
				"desc"	=> __( "The time between slide transitions in milliseconds", "funky_theme" ),
				"id"	=> $funky_shortname ."_slider_timeout",
				"type"	=> "text_small",
				"std"	=> "4000"
			),
			
			// ---------- VIDEO ---------- //
			
			// Video Layout Help
			array(
				"name"		=> __( "!", 'funky_theme' ),
				'desc' 	=> __( "<p>The video portfolio item layout outputs a video player generated from the first URL found in the page content. The video URL should be the first URL found in the content.</p>", "funky_theme" ),
				'id' 	=> $funky_shortname .'_layout_video_help',
				'type' 	=> 'info'
			),
			
			// Background Image	
			array(
				"name"	=> __( "Media Background Image", "funky_theme" ),
				"desc"	=> __( "Upload, Select or enter the URL to an image to be used as the background for the media player section of this page.", "funky_theme" ),
				"id"	=> $funky_shortname ."_media_background_image",
				"type"	=> "file"
			)
			
		)
		
	);
	
	return $meta_boxes;
	
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'template-options.php';

}