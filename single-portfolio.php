<?php
/**
 * The portfolio custom post type template
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>

<!-- BEGIN .page-buttons -->
<div class="page-buttons">

	<?php // Back to term button
	$terms = get_the_terms( $post->ID, 'portfolio_category' );
	reset($terms);
	$term_id = current($terms)->term_id;

	$parent = get_term_by( 'id', $term_id, 'portfolio_category' );

	while ( $parent->parent != 0 ) {
		$parent = get_term_by( 'id', $parent->parent, 'portfolio_category' );
	} ?>

	<a class="square-icon back-to-archive" href="<?php echo get_term_link( $parent->term_id, 'portfolio_category' ); ?>">
		<span class="funky-icon-back"></span>
	</a>
	
	<?php // WP Query to find adjacent posts 
	$postlist_args = array(
	   'posts_per_page'  => -1,
	   'orderby'         => 'date',
	   'order'           => 'DESC',
		'post_type' => array( 'portfolio' ),
		'tax_query' => array(
			array(
				'taxonomy'	=> 'portfolio_category',
				'field'		=> 'id',
				'terms'		=> $parent->term_id
			)
		)
	);
	
	$postlist = get_posts( $postlist_args );

	// get ids of posts retrieved from get_posts
	$ids = array();
	foreach ($postlist as $thepost) {
	   $ids[] = $thepost->ID;
	}

	// get and echo previous and next post in the same taxonomy
	$thisindex = array_search($post->ID, $ids);
	
	if ( isset( $ids[$thisindex+1] ) ) {
		$previd = $ids[$thisindex+1];
	}
	
	if ( isset( $ids[$thisindex-1] ) ) {
		$nextid = $ids[$thisindex-1];
	}
	
	if ( !empty($previd) ) { ?>
	   <span class="square-icon post-pagination post-pagination-previous-post"><a rel="prev" href="<?php echo get_permalink($previd); ?>"><span class="funky-icon-right"></span></a></span>
	<?php } ?>
	
	<?php if ( !empty($nextid) ) { ?>
		<span class="square-icon post-pagination post-pagination-previous-next"><a rel="next" href="<?php echo get_permalink($nextid); ?>"><span class="funky-icon-left"></span></a></span>
	<?php } ?>
	
	<?php wp_reset_postdata(); ?>

<!-- END .page-buttons -->
</div>

<?php while ( have_posts() ) : the_post(); ?>	

	<!-- BEGIN .feature-content -->
	<div class="feature-content">
		
		<?php if ( get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'audio' || get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'video' ) { ?>
			
			<?php if ( get_post_meta( $post->ID, 'soapbox_media_background_image', true ) != '' ) { ?>
				
				<div class="feature-image fit-to-parent">
					
					<img src="<?php echo get_post_meta( $post->ID, 'soapbox_media_background_image', true ); ?>" alt="" />				
					
				</div>
				
			<?php } ?>
			
			<div class="media-wrapper">
				<?php funky_embed_feature_content(); ?>
			</div>
			
		<?php } elseif ( get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'half' && has_post_thumbnail() ) { ?>
		
			<div class="feature-image fit-to-parent">
			
				<?php if ( get_post_meta( $post->ID, 'soapbox_exclude_feature_image', true ) != 'on') {
					
					the_post_thumbnail( 'full' );
					
				} else {
					
					// Save parent ID for later use
					$parent_ID = $post->ID;
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					
					$query_args = array(
						'post_type'				=> array( 'attachment' ),
						'post_mime_type'		=> 'image',
						'post_status'			=> 'any',
						'posts_per_page'		=> -1,
						'post_parent'			=> $post->ID,
						'ignore_sticky_posts'	=> 1
					);				
					
					// Query for images
					$gallery_query = new WP_Query( $query_args );
					
					if ( $gallery_query->have_posts() ) {						
						
						while ( $gallery_query->have_posts() ) {
							
							$gallery_query->the_post();
					
							$full_image_src = wp_get_attachment_image_src( $post->ID, 'full' );
							
							if ( $full_image_src[0] == $featured_image[0] ) {
							
								// Do nothing...
								
							} else {							
								
								echo wp_get_attachment_image( $post->ID, 'gallery' );						
								break;
								
							}
							
						}
					
					}
					
					wp_reset_postdata();
				
				} ?>
				
			</div>			
			
		<?php } elseif ( get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery' ) { ?>
			
			<div class="post-gallery">
				<?php funky_embed_feature_content(); ?>
			</div>
		
		<?php } elseif ( get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider' ) { ?>
			
			<div class="slideshow fit-to-parent"
				data-cycle-fx="<?php echo get_post_meta( $post->ID, 'soapbox_slider_fx', true ); ?>"
				data-cycle-speed="<?php echo get_post_meta( $post->ID, 'soapbox_slider_speed', true ); ?>"
				data-cycle-timeout="<?php echo get_post_meta( $post->ID, 'soapbox_slider_timeout', true ); ?>"
			>
			
				<?php funky_embed_feature_content(); ?>
				
				<!-- empty element for caption -->
				<div class="cycle-overlay"></div>
				
				<!-- empty element for pager -->
				<div class="cycle-pager"></div>
			
			</div>
		
		<?php } ?>
		
	<!-- END .feature-content -->
	</div>
	
	<!-- BEGIN .page-content -->
	<div <?php post_class( 'page-content clearfix' ); ?>>
		
		<!-- BEGIN .content-padding -->
		<div class="content-padding clearfix">
		
			<?php if (
				get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on'
				|| ( 
					$post->post_excerpt != ''
					&& get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' 
				)				 
			) { ?>
			
				<!-- BEGIN .page-header -->
				<header class="page-header">		
					
					<?php if ( get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on' ) { ?>		
						<h1><?php funky_the_title(); ?></h1>					
					<?php } ?>
					
					<?php if ( 
						( $post->post_excerpt != '' )
						&& ( get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' )
					) { ?>
						<?php the_excerpt(); ?>
					<?php } ?>
					
				<!-- END .page-header -->
				</header>
			
			<?php } ?>
			
			<?php if (
				get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'audio'
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'gallery'
				|| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'slider'
				| get_post_meta( $post->ID, 'soapbox_portfolio_item_layout', true ) == 'video'
			) { 
			   funky_the_remaining_content();
			} else {
			   the_content();
			} ?>	
			
			<?php if ( get_tax_meta( $parent->term_id, 'soapbox_portfolio_share_buttons' ) == 'on' ) { ?>
			
				<!-- share -->
				<div class="post-share-buttons">
					<a class="facebook" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo home_url() ?>/?p=<?php the_ID(); ?><?php if ( has_post_thumbnail() ) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>&p[images][0]=<?php echo $thumb['0']; ?> <?php } ?>&p[title]=<?php echo urlencode( get_the_title() ); ?>&p[summary]=<?php echo urlencode( get_the_excerpt() ); ?>" rel="external" target="_blank">
						<span class="funky-icon-facebook"></span>
					</a>						
					<a class="twitter" href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() .' - '. home_url() .'/?p='. get_the_ID() ); ?>" rel="external" target="_blank">
						<span class="funky-icon-twitter"></span>
					</a>						
					<a class="google" href="https://plus.google.com/share?url=<?php echo home_url() ?>/?p=<?php the_ID(); ?>" rel="external" target="_blank">
						<span class="funky-icon-google-plus"></span>
					</a>					
				</div>
				
			<?php } ?>
			
		<!-- BEGIN .content-padding -->
		</div>
		
	<!-- END .page-content -->
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>