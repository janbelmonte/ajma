<?php
/**
 * Template Name: Portfolio
 *
 * The page template for displaying a portfolio grid.
 * 
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/

get_header();

// Define some layout options
$thumbnail_style = get_post_meta( $post->ID, 'soapbox_thumbnail_style', true );
$show_term = get_post_meta( $post->ID, 'soapbox_portfolio_category_label', true );

// How many posts to display per page?
if ( intval( get_post_meta( $post->ID, 'soapbox_portfolio_posts_per_page', true ) ) > 0 ) {
	$posts_per_page = intval( get_post_meta( $post->ID, 'soapbox_portfolio_posts_per_page', true ) );
} else {
	$posts_per_page = -1;
}

// Which page of posts are we showing?
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

// Portfolio Loop
if ( get_post_meta( $post->ID, 'soapbox_portfolio_category', true ) != "all" ) { 

	$query_args = array(
		'post_type' => array( 'portfolio' ),
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'slug',
				'terms' => get_post_meta( $post->ID, 'soapbox_portfolio_category', true )
			)
		),
		'posts_per_page' => $posts_per_page,
		'paged'			 => $paged
	);

} else {
	
	$query_args = array(
		'post_type'			=> array( 'portfolio' ),
		'posts_per_page'	=> $posts_per_page,
		'paged'				=> $paged
	);
	
}

$portfolio_query = new WP_query( $query_args );

if ( $portfolio_query->have_posts() ) : ?>
	
	<div id="post-grid">
	
		<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
			
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
	
	<?php if ( $portfolio_query->max_num_pages > 1 ) { ?>
	
		<div class="pagination">
		
			<?php // Pagination
			$big = 999999999;

			echo paginate_links( array(
				'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'	=> '?paged=%#%',
				'current'	=> max( 1, get_query_var( 'paged' ) ),
				'total'		=> $portfolio_query->max_num_pages,
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