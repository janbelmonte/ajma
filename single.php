<?php
/**
 * The default post template
 *
 * The default layout of standard blog posts and custom post types.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>	

<!-- BEGIN .page-buttons -->
<div class="page-buttons">

	<span class="square-icon sidebar-toggle">
		<span class="funky-icon-more"></span>
	</span>
	
	<?php if( get_option( 'show_on_front' ) == 'page' ) {
		$back_url = get_permalink( get_option( 'page_for_posts' ) );
	} else {	
		$back_url = get_bloginfo( 'url' );
	} ?>
	
	<?php if ( get_adjacent_post( false, '', true ) ) {?>
		<span class="square-icon post-pagination post-pagination-previous-post"><?php previous_post_link( '%link', '<span class="funky-icon-right"></span>' ); ?></span>
	<?php } ?>

	<?php if ( get_adjacent_post( false, '', false ) ) { ?>
		<span class="square-icon post-pagination post-pagination-next-post"><?php next_post_link( '%link', '<span class="funky-icon-left"></span>' ); ?></span>
	<?php } ?>
	
	<?php if ( of_get_option( 'post_share_buttons' ) == '1' ) { ?>
				
			<!-- share -->
			<div class="post-share-buttons">
				<a class="facebook" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo home_url() ?>/?p=<?php the_ID(); ?><?php if ( has_post_thumbnail() ) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>&p[images][0]=<?php echo $thumb['0']; ?> <?php } ?>&p[title]=<?php echo urlencode( get_the_title() ); ?>&p[summary]=<?php echo urlencode( get_the_excerpt() ); ?>" rel="external" target="_blank">
					<span class="funky-icon-facebook"></span>
				</a>						
				<a class="twitter" href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() .' - '. home_url() .'/?p='. get_the_ID() ); ?>" rel="external" target="_blank">
					<span class="funky-icon-twitter"></span>
				</a>
			</div>
				
			<?php } ?>


<!-- END .page-buttons -->
</div>

<?php while ( have_posts() ) : the_post(); ?>
	
	<!-- BEGIN .feature-content -->
	<div class="feature-content">

		<?php if (
			has_post_thumbnail()
			|| ( get_post_format() == "audio" )
			|| ( get_post_format() == "video" )		
			|| ( get_post_format() == "gallery" )
		) { ?>
			
			<?php if ( ( get_post_format() == "audio" ) || ( get_post_format() == "video"	) ) { ?>
				
				<div class="post-gallery">
					
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'gallery' );
					} ?>
					
					<?php funky_embed_feature_content(); ?>					
				
				</div>
				
			<?php } elseif ( get_post_format() == "gallery"	) { ?>
			
				<div class="post-gallery">
					<?php funky_embed_feature_content(); ?>
				</div>
				
			<?php } elseif (  has_post_thumbnail() && get_post_format() == "image" ) { ?>
			
				<div class="feature-image fit-to-parent">
					<?php the_post_thumbnail( 'gallery' ); ?>
				</div>
				
			<?php } elseif ( has_post_thumbnail() ) { ?>
			
				<div class="feature-image fit-to-parent">
					<?php the_post_thumbnail( 'gallery' ); ?>
				</div>		
			
			<?php } ?>	

		<?php } ?>
		
	<!-- END .feature-content -->
	</div>
	
	<!-- BEGIN .page-content -->
	<div <?php post_class( 'page-content clearfix' ); ?>>
		
		<!-- BEGIN .content-padding -->
		<div class="content-padding clearfix">
		
			<!-- BEGIN .page-header -->
			<header class="page-header" align="center">		
				
				<h1 class="post-title"><?php the_title(); ?></h1>			
				
				<?php if (
					of_get_option( 'post_date_meta' ) == '1'
				) { ?>
				
					<ul class="post-meta">
						<center>
						<?php if ( of_get_option( 'post_date_meta' ) == '1' ) { ?>
							<li>
								<!-- DATE META -->
								<span class="funky-icon-time"></span>
								<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							</li>
						<?php } ?>
						</center>
					</ul>
				
				<?php } ?>
				
			<!-- END .page-header -->
			</header>			
			
	
			
			<div class="clearfix">
			
				<?php wp_link_pages( array(
					'before'		=> '<div class="wp-link-pages">',
					'after'			=> '</div>',
					'link_before'   => '<span>',
					'link_after'    => '</span>',
				) ); ?>
				
			</div>
			
			<?php if ( ( of_get_option( 'post_tags_meta' ) == '1' ) && has_tag() ) { ?>			
			
				<!-- post tags -->
				<div class="tagcloud">
					<h5><?php _e( "Tags", "funky_theme" ); ?></h5>
					<?php the_tags( false, ' ' ); ?>
				</div>
				
			<?php } ?>
			

			
		<!-- END .content-padding -->
		</div>

		<div class="content-white">
			
			<?php funky_the_remaining_content(); ?>
			<p>&nbsp;</p>
		</div>
		
		<?php comments_template(); ?>		
		
	<!-- END .page-content -->
	</div>
	
<?php endwhile; ?>

<?php get_template_part( 'sidebar' ); ?>

<?php get_footer(); ?>