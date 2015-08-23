<?php
/**
 * The template for displaying 404 pages (Not Found).
 * 
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/  
 
get_header(); ?>

<!-- BEGIN .feature-content -->
<div class="feature-content">

	<!-- BEGIN .feature-image -->
	<div class="feature-image fit-to-parent">
	
		<?php if ( of_get_option( '404_background' ) != "" ) { ?>
			<img src="<?php echo of_get_option( '404_background' ); ?>" alt="" />
		<?php } ?>
		
	<!-- END .feature-image -->
	</div>

<!-- END .feature-content -->
</div>

<!-- BEGIN .page-content -->
<div class="page-content clearfix">
	
	<!-- BEGIN .content-padding -->
	<div class="content-padding clearfix">
	
		<!-- BEGIN .page-header -->
		<header class="page-header">		
			
			<h1><?php echo of_get_option( '404_title' ); ?></h1>
			
		<!-- END .page-header -->
		</header>
	
		<?php echo of_get_option( '404_subtitle' ); ?>
	
		<p><a href="<?php echo home_url(); ?>/"><?php _e( "Back to home page &rarr;", "funky_theme" );?></a></p>
	
		<?php get_search_form(); ?>

	<!-- END .content-padding -->
	</div>

<!-- END .page-content -->
</div>

<?php get_footer(); ?>