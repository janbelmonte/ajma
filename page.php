<?php
/**
 * The default page template
 *
 * The layout of the page can be further modified using the template options on the page edit screen.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>	

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php if ( 
		( get_post_meta( $post->ID, 'soapbox_page_header', true ) == 'image' ) 
		|| ( get_post_meta( $post->ID, 'soapbox_page_header', true ) == 'video' )
	) { ?>
		
		<!-- BEGIN .feature-content -->
		<div class="feature-content">			
			
			<?php // Background Video
			if ( 
				( get_post_meta( $post->ID, 'soapbox_page_header', true ) == 'video' ) 
				&& ( ( get_post_meta( $post->ID, 'soapbox_header_video_mp4', true ) != '' ) || ( get_post_meta( $post->ID, 'soapbox_header_video_webm', true ) != '' ) )
			) {
				
				// Video Poster
				if ( has_post_thumbnail() ) {
					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$poster = 'poster="'. $src[0] .'"';
				} else {
					$poster = '';
				}
				
				// Video Source
				$src_webm = get_post_meta( $post->ID, 'soapbox_header_video_webm', true );
				$src_mp4  = get_post_meta( $post->ID, 'soapbox_header_video_mp4', true ); ?>
				
				<video class="background-video" <?php echo $poster; ?> preload="auto" autoplay="autoplay" loop="loop" muted="muted">
					<?php if ( $src_webm != "" ) { ?>
						<source src="<?php echo $src_webm; ?>" type="video/webm">
					<?php } ?>
					<?php if ( $src_mp4 != "" ) { ?>
						<source src="<?php echo $src_mp4; ?>" type="video/mp4">
					<?php } ?>
				</video>
				<div class="video-overlay"></div>
				
			<?php } ?>
			
			<?php if ( get_post_meta( $post->ID, 'soapbox_header_style', true ) != 'full' ) {
				$image_sizing_class = 'fit-to-parent';
			} else {
				$image_sizing_class = '';
			} ?>
			
			<!-- BEGIN .feature-image -->
			<div class="feature-image <?php echo $image_sizing_class; ?>">
			
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'full' ); ?>
				<?php } ?>
				
			<!-- END .feature-image -->
			</div>
			
			<?php if (
				get_post_meta( $post->ID, 'soapbox_show_title_in_header', true ) == 'on'
				&& ( get_post_meta( $post->ID, 'soapbox_header_style', true ) == 'full' || get_post_meta( $post->ID, 'soapbox_header_style', true ) == 'fill' )
			) {
				
				get_template_part( 'page-header', 'centered' );
				
			} elseif ( get_post_meta( $post->ID, 'soapbox_show_title_in_header', true ) == 'on' ) {
			
				get_template_part( 'page-header' );
			
			} ?>
		
		<!-- END .feature-content -->
		</div>
		
	<?php } ?>
	
	<?php if (
		get_post_meta( $post->ID, 'soapbox_show_title_in_header', true ) != 'on' && get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on'
		|| !empty( $post->post_content )
	) { ?>
	
		<!-- BEGIN .page-content -->
		<div <?php post_class( 'page-content clearfix' ); ?>>
			
			<!-- BEGIN .content-padding -->
			<div class="content-padding clearfix">
			
				<?php if (
					( get_post_meta( $post->ID, 'soapbox_page_header', true ) != 'image' && get_post_meta( $post->ID, 'soapbox_page_header', true ) != 'video' )
					|| get_post_meta( $post->ID, 'soapbox_show_title_in_header', true ) != 'on'
					&& (
						get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on'
						|| (
							$post->post_excerpt != ''
							&& get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on'
						)
					)
				) { ?>
				
					<!-- BEGIN .page-header -->
					<header class="page-header" align="center">		
						
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
				
				<?php the_content(); ?>		
		
			<!-- END .content-padding -->
			</div>
			
		<!-- END .page-content -->
		</div>
		
	<?php } ?>
	
<?php endwhile; ?>

<?php get_footer(); ?>