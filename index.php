<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>	
	
<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- BEGIN .page-content -->
	<div <?php post_class( 'page-content clearfix' ); ?>>
		
		<!-- BEGIN .content-padding -->
		<div class="content-padding clearfix">
		
			<!-- BEGIN .page-header -->
			<header class="page-header">
				
				<!-- This would be a page title & subtitle -->
				<h1><?php funky_the_title(); ?></h1>
				
			<!-- END .page-header -->
			</header>
		
			<?php the_content(); ?>		
	
		<!-- END .content-padding -->
		</div>
		
	<!-- END .page-content-->
	</div>			
	
<?php endwhile; ?>

<?php get_footer(); ?>