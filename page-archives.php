<?php
/**
 * Template Name: Archives
 *
 * The template for displaying an archive pages.
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
			
			<div class="two-thirds">
			
				<?php the_content(); ?>
				
				<h2><?php _e( 'Last 30 posts', 'funky_theme' ); ?></h2>
			
				<?php $query_args = array( 
					'post_type'			  => 'post',
					'posts_per_page'	  => 30,
					'ignore_sticky_posts' => 1
				); ?>
				
				<?php $latest_posts = new WP_query( $query_args ); ?>

				<?php if ( $latest_posts->have_posts() ) : ?>
					
					<div class="latest-posts-list">
					
						<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
							
							<article>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( "Permalink to %s", "funky_theme" ), the_title_attribute( 'echo=0' ) ); ?>"><?php funky_the_title(); ?></a></h3>
								<time class="post-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							</article>
							
						<?php endwhile; ?>
						
					</div>
					
				<?php endif; ?>
				
				<?php wp_reset_postdata(); ?>
			
			</div>
			
			<div class="third end">
				
				<aside class="widget">									
					<h4 class="widget-title"><?php _e( "Categories", "funky_theme" ); ?></h4>
					<ul>
						<?php wp_list_categories( array(
							"hierarchical" 	=> 1,
							"title_li" 		=> false,
							"show_count" 	=> 1
						)); ?>
					</ul>
				</aside>
				
				<aside class="widget">
					<h4 class="widget-title"><?php _e( "Archives", "funky_theme" ); ?></h4>
					<ul class="list-style-none">
						<?php wp_get_archives( array(
							"type"				=> "monthly",
							"show_post_count"	=> true
						)); ?>  
					</ul>
					
				</aside>
				
				<aside class="widget">
					<h4 class="widget-title"><?php _e( "Feeds", "funky_theme" ); ?></h4>
					<ul class="list-style-none">
						<li><a title="Full content" href="feed:<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'Main RSS' , 'funky_theme' ); ?></a></li>  
						<li><a title="Comment Feed" href="feed:<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e( 'Comments Feed', 'funky_theme' ); ?></a></li>  
					</ul>
				</aside>
		
			</div>
	
		<!-- END .content-padding -->
		</div>
	
	<!-- END .page-content -->
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>