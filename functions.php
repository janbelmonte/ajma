<?php
/**
 * SoapBox functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/


/** 
 * Theme namespace
 * 
 * @var string
 **/
$funky_shortname  = "soapbox";


/** 
 * Theme name
 * 
 * @var string
 **/
$theme = wp_get_theme();
$funky_themename  = preg_replace( "/\W/", "_", strtolower( $theme->Name ) );


/*-----------------------------------------------------------------------------------
	OPTIONS FRAMEWORK
-----------------------------------------------------------------------------------*/
 
function funky_framework_setup () {

	/**
	 * Set the file path based on whether the Options Framework Theme is a parent theme or child theme
	 **/
 
	if ( !function_exists( 'optionsframework_init' ) ) {
		
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) .'inc/theme-options/' );
		require_once dirname( __FILE__ ) . '/inc/theme-options/options-framework.php';
		require_once dirname( __FILE__ ) .'/options.php'; // Loaded specifically for WP Customizer support
		
	}
	
	/*-----------------------------------------------------------------------------------
		FRAMEWORK FILES
	-----------------------------------------------------------------------------------*/

	require_once( trailingslashit( get_template_directory() ) .'inc/taxonomy_options/taxonomy_options.php' );
	require_once( trailingslashit( get_template_directory() ) .'inc/taxonomy_options/taxonomy_options_config.php' );
	require_once( trailingslashit( get_template_directory() ) .'inc/template-options/template-options-config.php' );
	require_once( trailingslashit( get_template_directory() ) .'inc/funky-comments.php' );

}
add_action( 'after_setup_theme', 'funky_framework_setup' );


/*-----------------------------------------------------------------------------------
	THEME SETUP
-----------------------------------------------------------------------------------*/

/**
 * Sets up the content width value based on the theme's design.
 *
 * @var integer
 **/
 
if ( !isset( $content_width ) ) {
	$content_width = 980;
}

	
/**
 * Sets up theme defaults and registers the various supported WordPress features.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/

function funky_theme_setup() {

	/**
	 * Makes the theme available for translation.
	 *
	 **/
	load_theme_textdomain( 'funky_theme', trailingslashit( get_template_directory() ) .'lang/' );
	
	
	/**
	 * Adds RSS feed links to <head> for posts and comments.
	 **/
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * This theme supports all available post formats although not all have unique post layouts.
	 * See http://codex.wordpress.org/Post_Formats
	 **/
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 **/
	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'funky_theme' )
		)
	);	
	
	
	/**
	 * This theme uses two custom image sizes. "dashboard" for for portfolio posts
	 * displayed in the admin dashboard and "archive" for post archive thumbnail images.
	 **/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 470, 470, true );		// Not sure if this is working.	
	add_image_size( 'gallery', 1024, 9999, false );	// Used on gallery posts and portfolio items
	add_image_size( 'archive', 950, 570, true );	// Used on post archives
	
	
	/**
	 * Disable [gallery] shortcode default styles because this theme uses its own gallery styles.
	 **/
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	
}	
add_action( 'after_setup_theme', 'funky_theme_setup' );


/**
 * Flush rewrite rules
 * Function that causes all site permalinks to regenerate when this theme is switched to.
 * Used to prevent custom post type 404 errors.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
 
function funky_flush_rewrite() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'funky_flush_rewrite' );


/*-----------------------------------------------------------------------------------
	LOAD SCRIPTS
-----------------------------------------------------------------------------------*/

/**
 * Enqueues scripts and styles for front end.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/

function funky_enqueue_scripts() {
	
	global $wp_styles, $funky_shortname, $funky_themename, $post;
	
	if ( !is_admin() ) {
	
		
		/* --------- JavaScript ---------- */
		
		// jQuery
		wp_enqueue_script( 'jquery' );
		
		// Comment reply
		wp_enqueue_script( 'comment-reply' );		
		
		// Custom Content Scroller
		wp_enqueue_script( 'custom-content-scroller', trailingslashit( get_template_directory_uri() ) .'js/jquery.mCustomScrollbar.min.js', array( 'jquery' ), false, 1  );				
		wp_enqueue_style( 'custom-content-scroller', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css' );
		
		// Cycle2
		if ( get_post_type() == "portfolio" && get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider' ) {			
			wp_enqueue_script( 'cycle2', trailingslashit( get_template_directory_uri() ) .'js/jquery.cycle2.min.js', array( 'jquery' ), false, 1  );
		}
		
		// Isotope
		if( is_archive( 'portfolio') || is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) || is_page_template( 'page-portfolio.php' ) ) {
			wp_enqueue_script( 'isotope', trailingslashit( get_template_directory_uri() ) .'js/jquery.isotope.min.js', array( 'jquery' ), false, 1 );
			wp_enqueue_script( 'isotope-perfectmasonry', trailingslashit( get_template_directory_uri() ) .'js/jquery.isotope.perfectmasonry.js', array( 'jquery' ), false, 1 );
		}
		
		// ImagesLoaded
		wp_enqueue_script( 'imagesloaded', trailingslashit( get_template_directory_uri() ) .'js/imagesloaded.min.js', false, false, 1  );
		
		// Resize Images To parent
		wp_enqueue_script( 'resizeimagetoparent', trailingslashit( get_template_directory_uri() ) .'js/jquery.resizeimagetoparent.min.js', array( 'jquery' ), false, 1  );
		
		// Modernizr
		wp_enqueue_script( 'modernizr', trailingslashit( get_template_directory_uri() ) .'js/modernizr.min.js', array( 'jquery' ) );
		
		// Preloader
		wp_enqueue_script( 'preloader', trailingslashit( get_template_directory_uri() ) .'js/preloader.js' );
		
		// Smoothscroll			
		wp_enqueue_script( 'smoothscroll', trailingslashit( get_template_directory_uri() ) .'js/smoothscroll.js', array( 'jquery' ), false, 1  );
		
		// jQuery Custom (Must load last)
		wp_enqueue_script( $funky_shortname .'-custom', trailingslashit( get_template_directory_uri() ) .'js/jquery.custom.min.js', array( 'jquery' ), false, 1 );

		
		/* ---------- CSS ---------- */
		
		# Google Font (Noto Sans)
		wp_enqueue_style( 'noto-sans','http://fonts.googleapis.com/css?family=Noto+Sans:400,700&subset=latin-ext' );
		
		# Google Font (Montserrat)
		wp_enqueue_style( 'montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700' );

		# Google Font (Open Sans)
		wp_enqueue_style( 'raleway', 'http://fonts.googleapis.com/css?family=Raleway:400,700' );

		# Google Font (Roboto Slab)
		wp_enqueue_style( 'roboto slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab' );

		
		# Main stylesheet
		wp_enqueue_style( $funky_shortname .'-style', get_stylesheet_uri() );		
	
		# Responsive stylesheet
		wp_enqueue_style( $funky_shortname .'-responsive', trailingslashit( get_template_directory_uri() ).'responsive.css', $funky_shortname .'-style' );		
		
		# Internet Explorer stylesheet.
		wp_enqueue_style( $funky_shortname .'-ie', get_template_directory_uri() . '/css/ie.css', array( $funky_shortname .'-style' ) );
		$wp_styles->add_data( $funky_shortname .'-ie', 'conditional', 'lt IE 9' );
	
	}

}
add_action( 'wp_enqueue_scripts', 'funky_enqueue_scripts' );


/*-----------------------------------------------------------------------------------
	LOAD ADMIN SCRIPTS
-----------------------------------------------------------------------------------*/

/**
 * Enqueues admin scripts and styles for back end.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
 
function funky_enqueue_admin_scripts( $hook ) {

	global $funky_shortname;
	
	if (
		'post.php' == $hook
		|| 'edit.php' == $hook
		|| 'post-new.php' == $hook
	){	
		wp_enqueue_script( $funky_shortname .'-admin-custom', trailingslashit( get_template_directory_uri() ) .'inc/js/jquery.admin.js', array( 'jquery' ), false );
	}
	
}
add_action( 'admin_enqueue_scripts', 'funky_enqueue_admin_scripts' );


/**
 * Localize JS variables
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
function funky_localize_js_strings () {
	
	global $funky_shortname, $post;
	
	$load_more_button_text_string	= __( 'Load More', 'funky_theme' );
	$loading_text_string			= __( 'Loading...', 'funky_theme' );
	$no_more_post_text_string		= __( 'No More Posts', 'funky_theme' );
	
	if ( of_get_option( 'color_header_text' ) == 1 ) {
		$nav_text_color = "light";
	} else {
		$nav_text_color = "dark";
	}
	
	wp_localize_script(
		$funky_shortname .'-custom',
		'funky_localized_js',
		array(
			'load_more_button_text_sring'	=> $load_more_button_text_string,
			'loading_text_sring'			=> $loading_text_string,
			'no_more_posts_text_string'		=> $no_more_post_text_string,
			'navTextColour' 				=> $nav_text_color
		)	
	);

}
add_action( 'wp_enqueue_scripts', 'funky_localize_js_strings' );


/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since SoapBox 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string		The filtered title.
 */
function funky_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	
	/**
	 * Add the site name.
	 **/
	$title .= get_bloginfo( 'name' );

	/**
	 * Add the site description for the home/front page.
	 **/
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = $title .' '. $sep .' '. $site_description;
	}

	/**
	 * Add a page number if necessary.
	 **/
	if ( $paged >= 2 || $page >= 2 ) {
		$title = $title .' '. $sep .' '. sprintf( __( 'Page %s', 'funky_theme' ), max( $paged, $page ) );
	}
	
	return $title;
	
}
add_filter( 'wp_title', 'funky_wp_title', 10, 2 );


/**
 * Outputs title of current page or post
 *
 * @since SoapBox 1.0
 *
 * @return string title.
 **/
 
if ( !function_exists( 'funky_the_title' ) ) {

	function funky_the_title( $echo = true ) {
		
		global $post, $funky_shortname;
		
		if ( get_post_meta( $post->ID, $funky_shortname .'_page_title', true ) != '' ) {
			$title = get_post_meta( $post->ID, $funky_shortname .'_page_title', true );
			apply_filters( 'the_title', $title );
		} else {
			$title = get_the_title();
		}		
		
		if ( $echo == false ) {
			return $title;
		} else {
			echo $title;
		}

	}

}


/*-----------------------------------------------------------------------------------
	DYNAMIC CSS
-----------------------------------------------------------------------------------*/

/**
 * Generate dynamic CSS and save as blog specific transient.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
 
function funky_generate_dynamic_css() {
	
	global $funky_shortname, $post;
	
	$output = '';
	
	
	// Preloader
	$output .= '#percent-bar { background-color: '. of_get_option( 'color_preloader' ) .'; }';
	
	
	// Accent
	$output .= '.pagination,
				.menu-toggle,
				.sidebar-toggle,
				.cycle-overlay { background-color:'. of_get_option( 'color_accent' ) .'; }';
	
	$output .= 'blockquote,
				span.required { color: '. of_get_option( 'color_accent' ) .'; }';
	
	
	// Accent Text
	if ( of_get_option( 'color_accent_text' ) == '1' ) {
	
		$output .= 'span.menu-toggle > span,
					span.sidebar-toggle > span,
					.cycle-overlay { color: #000; }';					
	
	}

	
	// Navigation
	$output .= '.header-wrapper,
				.footer,
				.pagination,
				.page-template-page-portfolio-php,
				body.blog,
				body.archive { background-color: '. of_get_option( 'color_header' ) .';}';
	
	
	// Navigation Text
	if ( of_get_option( 'color_header_text' ) == '0' ) {
		
		$output .= '.header-content h1 > a,
					.header-content h1 > .header-tagline,
					.header-content .title,
					.header-content nav ul a,
					.social-buttons a,
					.copyright,
					.pagination,
					.pagination a,
					.pagination a:hover,
					.page-template-page-portfolio-php,
					body.blog,
					body.archive{ color: #111; }
					
					.copyright a { 
						color: #111;
						border-bottom: 1px dotted #111;
					}
					
					.copyright a:hover { 
						color: #111;
						border: none;
					}'; 
		
	}
	
	
	// Feature Content
	$output .= '.feature-content { background-color: '. of_get_option( 'color_feature_content' ) .';}';

	
	// Links
	$output .= 'a { color: '. of_get_option( 'color_link' ) .'; }';
	
	$output .= 'a:hover,
				.post-meta a:hover,	
				.comment-author a:hover, 	
				.comment-navigation a:hover,	
				.comment-footer a:hover { color: '. of_get_option( 'color_link_hover' ) .'; }';

				
	// Buttons
	$output .= '.funky-button,
				.funky-button:visited,
				input[type="button"],
				input[type="submit"],
				button,
				button[type="submit"],
				input[type="reset"],
				input[type="file"],
				.tagcloud a,
				.tagcloud a:hover {
					background: none;
					border-color: '. of_get_option( 'color_button' ) .'; 
					color: '. of_get_option( 'color_button' ) .';
				}';
				
	$output .= '.funky-button:hover,
				.funky-button:visited:hover,
				input[type="button"]:hover,
				input[type="submit"]:hover,
				button:hover,
				button[type="submit"]:hover,
				input[type="reset"]:hover,
				input[type="file"]:hover,
				.tagcloud a:hover {
					color: '. of_get_option( 'color_button' ) .';
				}';	
	
	
	// Compress the CSS
	$output = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $output );
	$output = str_replace( ': ', ':', $output );
	$output = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $output );
	
	
	// Output dynamic styles
	wp_add_inline_style( 'soapbox-style', $output );	
	
}
add_action( 'wp_enqueue_scripts', 'funky_generate_dynamic_css' );


/*-----------------------------------------------------------------------------------
	ADD FAVICON & APPLE BOOKMARK ICON
-----------------------------------------------------------------------------------*/

/**
 * Outputs favicon and Apple bookmark head link tags from theme options.
 *
 * @since SoapBox 1.0
 *
 * @return string Favicon and bookmark icon html head link tags.
 **/
 
function add_custom_favicon() {
	
	if ( of_get_option( 'custom_favicon' ) != '' ) {
		echo "<link rel='shortcut icon' href='". of_get_option( 'custom_favicon' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_57' ) != '' ) {
		echo "<!-- Non retina display devices -->\n<link rel='apple-touch-icon' sizes='57x57' href='". of_get_option( 'apple_bookmark_57' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_114' ) != '' ) {
		echo "<!-- Retina display iPhone -->\n<link rel='apple-touch-icon' sizes='114x114' href='". of_get_option( 'apple_bookmark_114' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_72' ) != '' ) {
		echo "<!-- Non retina display iPad -->\n<link rel='apple-touch-icon' sizes='72x72' href='". of_get_option( 'apple_bookmark_72' ) ."'/>\n";
	}
	if ( of_get_option( 'apple_bookmark_144' ) != '' ) {
		echo "<!-- Retina display iPad -->\n<link rel='apple-touch-icon' sizes='144x144' href='". of_get_option( 'apple_bookmark_144' ) ."'/>\n";
	}
	
}
add_action( 'wp_head', 'add_custom_favicon' );


/*-----------------------------------------------------------------------------------
	BODY CLASS
-----------------------------------------------------------------------------------*/

/**
 * Extends the default WordPress body class to denote:
 * 1. Archive AJAX pagination enable
 *
 * @since SoapBox 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 **/
 
function funky_body_class ( $classes ) {
	
	if ( of_get_option( 'archive_ajax_pagination' ) == '1' ) {
		$classes[] = 'ajax-pagination';
	}
	
	return $classes;
	
}
add_filter( 'body_class', 'funky_body_class' );


/*-----------------------------------------------------------------------------------
	POST CLASS
-----------------------------------------------------------------------------------*/

/**
 * Extends the default WordPress post class.
 * 
 * @since SoapBox 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 **/

function funky_post_classes( $classes ) {
	
	return $classes;
	
}
//add_filter( 'post_class', 'funky_post_classes' );


/**
 * Sets the image size of 1 column [gallery] shortcode to full.
 *
 * @since SoapBox 1.0
 *
 * @param array $atts Combined and filtered attribute list.
 * @return array
 **/
 
function funky_gallery_atts( $atts ) {
	if ( $atts['columns'] == 1 ) {
		$atts['size'] = 'full';
	}
	
	return $atts;
	
}
add_filter( 'shortcode_atts_gallery', 'funky_gallery_atts' );

	
/*-----------------------------------------------------------------------------------
  ADD CUSTOM CSS
-----------------------------------------------------------------------------------*/

/**
 * Output custom CSS from theme options in page head.
 *
 * @since SoapBox 1.0
 *
 * @return string Custom CSS styles
 **/
 
function funky_add_custom_css () {

	if (
		( of_get_option( 'custom_css' ) != '' )
		|| ( of_get_option( 'custom_css_desktop' ) != '' )
		|| ( of_get_option( 'custom_css_mobile' ) != '' )
	) {
		echo "<!-- Custom CSS -->\n
		<style type=\"text/css\">";
			
			if ( of_get_option( 'custom_css' ) != '' ) {
				echo of_get_option( 'custom_css' );
			}
			
			if ( of_get_option( 'custom_css_desktop' ) != '' ) {
				echo "@media only screen and ( min-width: 768px ) { ". of_get_option( 'custom_css_desktop' ) ." }";				
			}
			
			if ( of_get_option( 'custom_css_mobile' ) != '' ) {
				echo "@media only screen and ( max-width: 767px ) { ". of_get_option( 'custom_css_mobile' ) ." }";			
			}
			
		echo "</style>";

	}
	
}
add_action( 'wp_head', 'funky_add_custom_css' );


/*-----------------------------------------------------------------------------------
  CLEAN PROTECTED / PRIVATE POST TITLES
-----------------------------------------------------------------------------------*/

/**
 * Remove "Protected" and "Private" text in passworded page's title.
 *
 * @since SoapBox 1.0
 *
 * @return string Modified page title.
 **/
  
function funky_change_protected_title( $title ) {

	$find = array(
		'#Protected:#',
		'#Private:#'
	);

	$replace = array(
		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with
	);

	$title = preg_replace( $find, $replace, $title );
	
	return $title;
	
}
add_filter( 'the_title', 'funky_change_protected_title' );


/*-----------------------------------------------------------------------------------
  ALLOW EXCERPTS ON POST TYPES
-----------------------------------------------------------------------------------*/

/**
 * Enable post excerpts on pages.
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
 
function funky_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'funky_add_excerpts_to_pages' );


/*-----------------------------------------------------------------------------------
  EXCERPT LENGTH
-----------------------------------------------------------------------------------*/

/**
 * Remove the default more link from excerpts
 *
 * @since SoapBox 1.0
 *
 * @return string
 **/
 
function new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/**
 * Sets generated excerpt length
 *
 * @since SoapBox 1.0
 *
 * @return integer 
 **/

function funky_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'funky_excerpt_length' );


/*-----------------------------------------------------------------------------------
  REGISTER SIDEBARS
-----------------------------------------------------------------------------------*/

/**
 * Register theme sidebar areas
 *
 * @since SoapBox 1.0
 *
 * @return void
 **/
 
function funky_register_sidebars() {

	$funky_sidebar_attr = array(
		'name'          => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	);
	
	// "Sidebar Name" => "Description"
	$funky_sidebars = array(
		_x( "Post", "Post sidebar name", "funky_theme" ) => __( "Appears on posts.", "funky_theme" )		
	);
	
	$i = 1;
	
	foreach ( $funky_sidebars as $sidebar_name => $sidebar_desc ) {
	
		$funky_sidebar_attr['id']			= 'sidebar-'. $i .'-'. strtolower( $sidebar_name );
		$funky_sidebar_attr['name']			= $sidebar_name;
		$funky_sidebar_attr['description']	= $sidebar_desc;
		
		register_sidebar( $funky_sidebar_attr );
		$i++;
		
	};

}
add_action( 'widgets_init', 'funky_register_sidebars' );


/*-----------------------------------------------------------------------------------
	OEMBED
-----------------------------------------------------------------------------------*/

/**
 * Return the URL for the first oEmbed supported link in the content.
 *
 * @since SoapBox 1.0
 *
 * @return string oEmbed supported URL.
 **/
 
if ( !function_exists( 'funky_get_first_oembed_url' ) ) {

	function funky_get_first_oembed_url( $content = false ) {
		
		global $wp_embed, $post;
		
		if ( !$content ) {
			$content = get_the_content();
		}
		
		// create array of URLs found in $content
		$pattern = '%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s';
		preg_match_all( $pattern, $content, $urls );
		
		// Check URLs were found
		if ( !empty( $urls[0][0] ) ) {
			
			// Set success flag to false.
			$oembed_link = false;
			$i = 0;			
			
			// Loop through URLs in content
			while ( $oembed_link == false && $i < count( $urls[0] ) ) {
				
				$the_url = $urls[0][$i];			
				
				// Test URL for an oEmbed end point
				$embed_code = $wp_embed->shortcode( false, $the_url );				
				
				// If oEmbed returns embed code return the URL.
				if ( !preg_match( '/^<a href/', $embed_code ) ) {
					return $the_url;
				}				
				
				$i++;
				
			}
			
		} else {
		
			return false;
		
		}

	}

}


/**
 * Return the feature media content based on post type and post format of current page / post.
 *
 * @since SoapBox 1.0
 *
 * @return string Content markup.
 **/
 
if ( !function_exists( 'funky_embed_feature_content' ) ) {
 
	function funky_embed_feature_content() {

		global $wp_embed, $post;
		
		// Gallery
		if ( 
			(
				get_post_type() == 'portfolio'
				&& (
					get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery' 		// Gallery layout portfolio items
					|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider'	// Slider layout portfolio items 
				)
			)
			|| ( get_post_type() == 'post' && get_post_format() == "gallery" )							// Gallery format posts
		) {
		
			// Find first [gallery] shortcode in content.
			preg_match( '#\[gallery\s*.*?\]#s', get_the_content(), $gallery );
			
			// If there is a [gallery] shortcode...
			if ( !empty( $gallery ) ) {
				
				// Does the gallery shortcode have IDs defined.
				preg_match( '#\ids="(.*)"#s', $gallery[0], $image_ids );
				
				// If image IDs are found in the shortcode.
				if ( !empty( $image_ids[1] ) ) {
					
					// Convert string of IDs into array for WP query.
					$image_id_array = explode( ',', $image_ids[1] );
					
					// Set query args for images from IDs.
					$query_args = array(
						'orderby'				=> 'menu_order',
						'order'					=> 'ASC',
						'post_type'				=> array( 'attachment' ),
						'post_mime_type'		=> 'image',
						'post_status'			=> 'any',
						'posts_per_page'		=> -1,
						'post__in'				=> $image_id_array,
						'ignore_sticky_posts'	=> 1
					);
				
				// If no image IDs are found in the shortcode.
				} else {
					
					// Set query args for images attached to the page.
					$query_args = array(
						'orderby'				=> 'menu_order',
						'order'					=> 'ASC',
						'post_type'				=> array( 'attachment' ),
						'post_mime_type'		=> 'image',
						'post_status'			=> 'any',
						'posts_per_page'		=> -1,
						'post_parent'			=> $post->ID,
						'ignore_sticky_posts'	=> 1
					);
					
				}
			
			// If no [gallery] shortcode is found.
			} else {
				
				// Set query args for images attached to the page.
				$query_args = array(
					'orderby'				=> 'menu_order',
					'order'					=> 'ASC',
					'post_type'				=> array( 'attachment' ),
					'post_mime_type'		=> 'image',
					'post_status'			=> 'any',
					'posts_per_page'		=> -1,
					'post_parent'			=> $post->ID,
					'ignore_sticky_posts'	=> 1
				);
				
			}
			
			// Show captions on posts.
			if ( 
				( get_post_type() == 'post' && get_post_format() == 'gallery' )
				|| ( get_post_type() == 'portfolio' &&  get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery' )
			) {
				$captions = true;
			} else {
				$captions = false;
			}
			
			if ( get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider' ) {
				$gallery = false;
			} else {
				$gallery = true;
			}
			
			// Save parent ID for later use
			$parent_ID = $post->ID;
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			
			// Query for images
			$gallery_query = new WP_Query( $query_args );
			
			if ( $gallery_query->have_posts() ) {
				
				while ( $gallery_query->have_posts() ) {
				
					$gallery_query->the_post();
					
					$full_image_attributes = wp_get_attachment_image_src( $post->ID, 'full' );
					
					// Compare image URL with URL of parent feature image for "exclude feature image" option
					if (
						( get_post_meta( $parent_ID, 'soapbox_exclude_feature_image', true ) == 'on' )
						&& ( $full_image_attributes[0] == $featured_image[0] )
					) {
					
						// Do nothing...
						
					} else {
						
						if ( $gallery == true ) {
						
							echo '<div class="gallery-image">';
								
								$gallery_image_attributes = wp_get_attachment_image_src( $post->ID, 'gallery' );						
						
								echo '<img src="'. $gallery_image_attributes[0] .'" width="'. $gallery_image_attributes[1] .'" height="'. $gallery_image_attributes[2] .'" alt="'. get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) .'" />';
							
								if ( $captions == true && !empty( $post->post_excerpt ) ) {
									echo '<div class="gallery-image-caption">'. $post->post_excerpt .'</div>';							
								}
						
							echo '</div>';
								
						
						} else {
						
							echo '<img src="'. $full_image_attributes[0] .'" width="'. $full_image_attributes[1] .'" height="'. $full_image_attributes[2] .'" alt="'. get_post_meta( $post->ID, '_wp_attachment_image_alt', true ) .'" data-cycle-desc="'. $post->post_excerpt .'" />';						
						
						}
						
					}
				
				}					
				
			}
			
			wp_reset_postdata();
			
		// Audio & Video
		} elseif ( 
			( 
				get_post_type() == 'portfolio' 
				&& ( 
					get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'audio'	// Audio portfolio item
					|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'video' // Video portfolio item
				)
			)
			|| (
				get_post_type() == 'post'
				&& (
					get_post_format() == 'audio'													// Audio post format
					|| get_post_format() == 'video'													// Video portfolio item
				)
			)
		) {
			
			// Find first oEmbed URL
			$url = funky_get_first_oembed_url();
			
			// Check if a URL was found
			if ( $url !== false ) {
				
				// Get the embed code
				$embed_code = $wp_embed->shortcode( false, $url );
				$pattern = get_shortcode_regex();
				
				// Output embed code
				if ( preg_match( '/'. $pattern .'/s', $embed_code, $matches ) ) {
					echo do_shortcode( $embed_code );
				} else {
					echo $embed_code;
				}
				
			}
			
		}
		
	}

}


/**
 * RETURN the remaining post content once oEmbed provider URL has been extracted
 *
 * @since SoapBox 1.0
 *
 * @return string Post content with the first oEmbed URL removed.
 **/
 
function funky_get_remaining_content( $more_link_text = null, $strip_teaser = false ) {
	
	global $post;
	
	$content = get_the_content( $more_link_text, $strip_teaser );
	
	$feature_content = '';
	
	if ( 
		(
			get_post_type() == 'portfolio'
			&& (
				get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery' 		// Gallery layout portfolio items
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider'	// Slider layout portfolio items 
			)
		)
		|| ( get_post_type() == 'post' && get_post_format() == "gallery" )							// Gallery fromat posts
	) {
		
		// Get first [gallery].
		preg_match( '#\[gallery\s*.*?\]#s', get_the_content(), $feature_content );
	
	} elseif (
		(
			get_post_type() == 'post'
			&& (
				get_post_format() == 'video'
				|| get_post_format() == 'audio'
			)
		)
		|| (
			get_post_type() == 'portfolio'
			&& (
				get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'audio'
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'video'
			)
		)
	) {
		
		// Find first URL
		$feature_content = funky_get_first_oembed_url( $content );

	}

	// Remove feature content from post content then tidy up
	$content = str_replace( $feature_content, '', $content );	
	$content = apply_filters( 'the_content', $content ) ;
	$content = str_replace( ']]>', ']]&gt;', $content );	
	
	return $content;
	
}


/**
 * ECHO the remaining post content once oEmbed provider URL has been extracted
 *
 * @since SoapBox 1.0
 *
 * @return string Post content with the first oEmbed URL removed.
 **/

function funky_the_remaining_content( $more_link_text = null, $strip_teaser = false ) {
	
	echo funky_get_remaining_content();
	
}


function funky_excerpt( $output ) {
  
	global $post;
  
	$feature_content = false;
	
	if (
		(
			get_post_type() == 'portfolio'
			&& (
				get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery' 		// Gallery layout portfolio items
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider'	// Slider layout portfolio items 
			)
		)
		|| ( get_post_type() == 'post' && get_post_format() == "gallery" )							// Gallery fromat posts
	) {
		
		// Get first [gallery].
		preg_match( '#\[gallery\s*.*?\]#s', get_the_content(), $feature_content );
	
	} elseif (
		(
			get_post_type() == 'post'
			&& (
				get_post_format() == 'video'
				|| get_post_format() == 'audio'
			)
		)
		|| (
			get_post_type() == 'portfolio'
			&& (
				get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'audio'
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'video'
			)
		)
	) {
		
		// Find first URL
		$feature_content = funky_get_first_oembed_url( $output );

	}
	
	// Remove feature content from post content then tidy up
	$output = str_replace( $feature_content, '', $output );	

	return $output;
  
}
add_filter( 'get_the_excerpt', 'funky_excerpt' );


/*-----------------------------------------------------------------------------------
	ACTIVATE PLUGINS
-----------------------------------------------------------------------------------*/

define( 'THEMENAME', $funky_themename ); 

require_once trailingslashit( get_template_directory() ) .'inc/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'funky_register_required_plugins' );

/**
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 **/
 
function funky_register_required_plugins() {	

	$plugins = array(
		
		// Contact Form 7
		array(
			'name' 					=> 'Contact Form 7',
			'slug' 					=> 'contact-form-7',
			'required'			 	=> false,
			'version'				=> '0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		),		
		
		// Envato WordPress Toolkit
		array(
			'name'					=> 'Envato WordPress Toolkit',
			'slug'					=> 'envato-wordpress-toolkit-master',
			'source'				=> trailingslashit( get_template_directory_uri() ) .'inc/plugins/envato-wordpress-toolkit-master.zip',
			'required'				=> true,
			'version'				=> '1.6',
			'force_activation'		=> true,
			'force_deactivation'	=> false,			
		),
	
		// FitVids
		array(
			'name' 					=> 'FitVids for WordPress',
			'slug' 					=> 'fitvids-for-wordpress',
			'required'			 	=> false,
			'version'				=> '0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		),
		
		// Funky Shortcodes
		array(
			'name'     				=> 'Funky Shortcodes',
			'slug'     				=> 'funky-shortcodes',
			'source'   				=> trailingslashit( get_template_directory_uri() ) .'inc/plugins/funky-shortcodes.zip',
			'required' 				=> false,
			'version' 				=> '2.0.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		),		
		
		// Portfolio Post Type
		array(
			'name'			 		=> 'Portfolio Post Type',
			'slug' 					=> 'portfolio-post-type',
			'required' 				=> false,
			'version'				=> '0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		)
		
	);
	
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'funky_theme';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 **/
	
	$config = array(
		'menu'				=> 'install-required-plugins',
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

} 


/*-----------------------------------------------------------------------------------
	IMAGE RESIZE
-----------------------------------------------------------------------------------*/

/**
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 **/
if ( !function_exists( 'vt_resize') ) {

	function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

		// this is an attachment, so we have the ID
		if ( $attach_id ) {

			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );

		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {

			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

			// Look for Multisite Path
			if(file_exists($file_path) === false){
				global $blog_id;
				$file_path = parse_url( $img_url );
				if (preg_match("/files/", $file_path['path'])) {
					$path = explode('/',$file_path['path']);
					foreach($path as $k=>$v){
						if($v == 'files'){
							$path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
						}
					}
					$path = implode('/',$path);
				}
				$file_path = $_SERVER['DOCUMENT_ROOT'].$path;
			}
			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

			$orig_size = getimagesize( $file_path );

			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}

		$file_info = pathinfo( $file_path );

		// check if file exists
		$base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
		if ( !file_exists($base_file) )
		 return;

		$extension = '.'. $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		
		/* Calculate the eventual height and width for accurate file name */
		if ( $crop == false ) {
		   $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
		   $width = $proportional_size[0];
		   $height = $proportional_size[1];
		}
		$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width ) {

			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {

				$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $cropped_img_url,
					'width' => $width,
					'height' => $height
				);

				return $vt_image;
			}

			// $crop = false or no height set
			if ( $crop == false OR !$height ) {

				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {

					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1]
					);

					return $vt_image;
				}
			}

			// check if image width is smaller than set width
			$img_size = getimagesize( $file_path );
			if ( $img_size[0] <= $width ) $width = $img_size[0];

			// Check if GD Library installed
			if (!function_exists ('imagecreatetruecolor')) {
			    echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
			    return;
			}

			// no cache files - let's finally resize it
			$editor = wp_get_image_editor( $file_path );
			if ( is_wp_error( $editor ) )
				return $editor;
			$editor->set_quality( 100 );
			$resized = $editor->resize( $width, $height, $crop );
			$dest_file = $editor->generate_filename( NULL, NULL );
			$saved = $editor->save( $dest_file );
			if ( is_wp_error( $saved ) )
				return $saved;
			$new_img_path=$dest_file;			
			$new_img_size = getimagesize( $new_img_path );
			$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

			// resized output
			$vt_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);

			return $vt_image;
		}

		// default output - without resizing
		$vt_image = array (
			'url' => $image_src[0],
			'width' => $width,
			'height' => $height
		);

		return $vt_image;
		
	}
	
}

?>