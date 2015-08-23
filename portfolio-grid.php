<?php
/**
 * The template for displaying the portfolio category custom taxonomy.
 * 
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/
 
// Custom Taxonomy Options
if ( is_tax() ) {
	
	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id;
	
	$thumbnail_style = get_tax_meta( $term_id, 'soapbox_portfolio_thumbnail_style', true );
	$show_term = get_tax_meta( $term_id, 'soapbox_portfolio_category_label', true );
	
// Portfolio Post Type Archive
} else {
	
	$thumbnail_style = of_get_option( 'portfolio_archive_thumbnail_style' );
	$show_term = of_get_option( 'portfolio_archive_category_label' );
	
}

get_header(); ?>

<?php if ( have_posts() ): ?>
	
	<div id="post-grid">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php // Get portfolio item categories for filtering.
			$post_categories = get_the_terms( $post->ID, 'portfolio_category' );
			$categories_list = array();
		
			if ( $post_categories != NULL ) {
				foreach ( $post_categories as $category ) {
					array_push( $categories_list, urldecode( $category->slug ) ); 
				}
			} else {
				$categories_list = "";
			} ?>
			
			<article <?php post_class( $categories_list ); ?>>
				
				<div class="feature-image">
				
					<?php if ( has_post_thumbnail() ) {
					
						if ( $thumbnail_style == '1' ) {	// Landscape
							$height = 320;
							$cropped = true;
						} elseif ( $thumbnail_style == '2' ) {	// Portrait
							$height = 640;
							$cropped = true;
						} else {								// Landscape + Portrait (disabled)
							
							//$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							
							// Check natural aspect ratio
							//if ( $image_attributes[1] < $image_attributes[2] ) {	// Portrait
							//	$height = 640;							
							//} else {												// Landscape
							//	$height = 320;
							//}
							
							$height = 480;								
							$cropped = true;
							
						} ?>
						
						<!-- image 480xXXX -->
						<?php $image = vt_resize( get_post_thumbnail_id( $post->ID ), '', 480, $height, $cropped ); ?>				
						<img src="<?php echo $image['url']; ?>" alt="" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />
					
					<?php } ?>
					
				</div>
				
				<!-- info -->
				<div class="post-excerpt">
				
					<div class="post-excerpt-content">

						<!-- title -->
						<h1><?php funky_the_title();?></h1>
						
						<?php if ( $show_term == 'on' ) { ?>								
							<div class="portfolio-categories">
								<!-- category -->
								<?php the_terms( $post->ID, 'portfolio_category', '', ', ' ); ?>
							</div>
						<?php } ?>
				
					</div>
					
				</div>				
				
				<!-- Permalink -->
				<a href="<?php the_permalink(); ?>"><?php funky_the_title(); ?></a>
				
			</article>

		<?php endwhile; ?>
		
	</div>
	
	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
	
		<div class="pagination">
		
			<?php // Pagination

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'	=> '?paged=%#%',
				'current'	=> max( 1, get_query_var( 'paged' ) ),
				'total'		=> $wp_query->max_num_pages,
				'prev_text' => '&lsaquo; '. __( "Prev", "funky_theme" ),
				'next_text' => __( "Next", "funky_theme" ) .' &rsaquo;',
			) ); ?>

		</div>
		
	<?php } ?>
	
<?php else : ?>
	
	<!-- BEGIN .page-content -->
	<div class="page-content clearfix">
		
		<p><?php _e( "No posts to show. Check back soon.", "funky_theme" ); ?></p>
		
	<!-- END .entry-content -->
	</div>

<?php endif; ?>

<?php get_footer(); ?>