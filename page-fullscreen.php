<?php
/**
 * Template Name: Fullscreen
 *
 * Page background is filled with either the page feature image or a video. The page content is placed over the background media.
 * The layout of the page can be further modified using the template options on the page edit screen.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>	

<?php while ( have_posts() ) : the_post(); ?>
	
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
		
		<?php switch ( get_post_meta( $post->ID, 'soapbox_header_text_colour', true ) ) {
			case 'light':
				$text_colour = 'text-color-light';
			break;
			case 'dark':
				$text_colour = 'text-color-dark';
			break;
			default:
				if ( of_get_option( 'color_scheme' ) == '1' ) {
					$text_colour = 'text-color-light';
				} else {
					$text_colour = 'text-color-dark';		
				}
			break;
		} ?>

		<div class="element-height">

			<div class="holder">
				
				<div class="cont">
					
					<div <?php post_class( 'page-content clearfix '. $text_colour ); ?>>
						
						<?php if (
							get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on'
							|| ( ( $post->post_excerpt != '' ) && ( get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' ) )
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
						
						<?php the_content(); ?>
						
					</div>
	
				</div>
			
			</div>

		</div>
	
	<!-- END .feature-content -->
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>