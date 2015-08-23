<?php
/**
 * Theme header.
 *
 * Displays all of the <head> section and everything up to the main site navigation.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 

/**
 * Add class to allow styling for toolbar.
 **/
 
$html_class = ( is_admin_bar_showing() ) ? 'wp-toolbar' : '';

?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="no-js ie7 <?php echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8 <?php echo $html_class; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE) ]><!--><html class="no-js <?php echo $html_class; ?>" <?php language_attributes(); ?>><!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>	
	
</head>
<body <?php body_class(); ?>>
	
	<!-- BEGIN .wrapper -->
	<div id="wrapper" class="wrapper">	
		
		<!-- Preloader  -->
		<div id="preloader">
			<div id="percent-bar"></div>
		</div>
		
		<?php get_template_part( 'navigation' ); ?>
		
		<?php if (
			is_single()
			|| is_404()
			|| is_search()
			|| is_page_template( 'page-fullscreen.php' )
			|| is_page_template( 'page-contact.php' )
			|| (
				is_page()
				&& ( 
					get_post_meta( $post->ID, 'soapbox_page_header', true ) == 'image'
					|| get_post_meta( $post->ID, 'soapbox_page_header', true ) == 'video'
				)
			)
			|| ( 
				get_post_type() == 'portfolio'
				&& (
					!is_tax()
					&& !is_archive() 
				)
				&& ( 
					get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery'
					|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'half'
					|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider'
				)
			)
		) {
			
			if (
				is_404()
				|| is_search()
				|| is_page_template( 'page-contact.php' )
				|| ( is_single() && get_post_type() == "post" )
				|| ( is_page() && get_post_meta( $post->ID, 'soapbox_header_style', true ) == 'half' )
				|| (
					get_post_type() == "portfolio"
					&& (
						get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery'
						|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'half'
					)
				)
			) {
		
				$split_content_class = 'feature-content-half';
				
			} elseif (
				( is_page() && get_post_meta( $post->ID, 'soapbox_header_style', true ) == 'fill' )
				|| ( is_page() && is_page_template( 'page-fullscreen.php' ) )
				|| ( get_post_type() == "portfolio" && get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider' ) 
			) {
				
				$split_content_class = 'feature-content-fill';	
				
			} else {
				
				// This should never happen.
				$split_content_class = '';
				
			}
			
		} else {
			
			$split_content_class = '';
			
		}?>

		<!-- BEGIN .page-wrapper -->
		<section id="content" class="page-wrapper <?php echo $split_content_class; ?>" role="main">
			
			<a id="top"></a>
			
			<!-- Navigation Menu Toggle -->
			<span class="square-icon menu-toggle">
				<span class="funky-icon-menu"></span>
			</span>